<?php

namespace App\Http\Controllers\warga;

use App\Models\SuratPengantarModel;
use App\Models\ArsipSuratModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AjukanPersuratanController extends Controller
{

    public function index()
    {
        // Breadcrumbs setup
        $breadcrumb = (object) [
            'title' => 'Ajukan Persuratan',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Daftar Template Surat']
        ];

        // Active menu identifier
        $activeMenu = 'surat';

        // // Mocked documents data
        // $documents = [
        //     (object) ['id' => 1, 'name' => 'Surat Keterangan Belum Menikah', 'size' => 345],
        //     (object) ['id' => 2, 'name' => 'Surat Kehilangan', 'size' => 1234],
        //     (object) ['id' => 3, 'name' => 'Surat Pindah Domisili', 'size' => 645],
        //     (object) ['id' => 4, 'name' => 'Surat Keterangan Warga Tidak Mampu', 'size' => 987],

        // ];

        return view('warga.ajukanpersuratan.index', compact('breadcrumb', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Formulir Pengajuan Surat',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Daftar Template Surat', 'Pengajuan']
        ];

        // $surats = persuratanmodel::all();
        $activeMenu = 'surat'; //set menu yang sedang aktif
        return view('warga.ajukanpersuratan.create-pengantar', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengantar_nama' => 'required|string|max:20',
            'pengantar_no_surat' => 'required|string|max:20',
            'pengantar_isi_nik' => 'required|string|max:20',
            'pengantar_isi_nama' => 'required|string|max:100',
            'pengantar_isi_ttl' => 'required|string|max:100',
            'pengantar_isi_jk' => 'required|in:L,P',
            'pengantar_isi_agama' => 'required|string|max:20',
            'pengantar_isi_pekerjaan' => 'required|string|max:50',
            'pengantar_isi_alamat' => 'required|string|max:100',
            'pengantar_isi_keperluan' => 'required|string|max:100',
        ]);

        if (!auth()->check()) {
            return redirect('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        $user_id = auth()->user()->user_id;


        $pengantar = SuratPengantarModel::create([
            'user_id' => $user_id,
            'pengantar_nama' => $request->pengantar_nama,
            'pengantar_no_surat' => $request->pengantar_no_surat,
            'pengantar_isi_nik' => $request->pengantar_isi_nik,
            'pengantar_isi_nama' => $request->pengantar_isi_nama,
            'pengantar_isi_ttl' => $request->pengantar_isi_ttl,
            'pengantar_isi_jk' => $request->pengantar_isi_jk,
            'pengantar_isi_agama' => $request->pengantar_isi_agama,
            'pengantar_isi_pekerjaan' => $request->pengantar_isi_pekerjaan,
            'pengantar_isi_alamat' => $request->pengantar_isi_alamat,
            'pengantar_isi_keperluan' => $request->pengantar_isi_keperluan,
        ]);

        // // Log data sebelum proses penyimpanan PDF
        // \Log::info('Data Pengantar Lengkap:', [
        //     'Nama Pengantar' => $pengantar->pengantar_nama,
        //     'Nomor Surat' => $pengantar->pengantar_no_surat,
        //     'NIK' => $pengantar->pengantar_isi_nik,
        //     'Nama Lengkap' => $pengantar->pengantar_isi_nama,
        //     'Tempat/Tanggal Lahir' => $pengantar->pengantar_isi_ttl,
        //     'Jenis Kelamin' => $pengantar->pengantar_isi_jk,
        //     'Agama' => $pengantar->pengantar_isi_agama,
        //     'Pekerjaan' => $pengantar->pengantar_isi_pekerjaan,
        //     'Alamat' => $pengantar->pengantar_isi_alamat,
        //     'Keperluan' => $pengantar->pengantar_isi_keperluan
        // ]);


        $pdf = PDF::loadView('surat.cetak_pengantar', ['pengantar' => $pengantar]);
        $filename = 'Surat_Pengantar_' . $pengantar->user_id . '.pdf';
        $directory = public_path('surat_pengantar');

        // Buat direktori jika tidak ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;

        // Save the PDF to the specified path
        $pdf->save($path);

        // Save the path to the model if necessary
        $pengantar->update(['file_path' => $path]);

        // Create entry in Arsip Surat as Surat Masuk for Ketua
        ArsipSuratModel::create([
            'nomor_surat' => $pengantar->pengantar_no_surat,
            'tanggal_surat' => now(),
            'pengirim' => 'Warga',
            'penerima' => 'Ketua RW',
            'perihal' => 'Permohonan Surat Pengantar',
            'file_path' => $path,
            'keterangan' => 'Surat Pengantar submitted by Warga'
        ]);

        return redirect()->back()->with('success', 'Surat Pengantar berhasil dibuat dan dikirim ke Ketua RW.');
    }

    public function download($id)
    {
        $document = SuratPengantarModel::findOrFail($id); // Use the new model
        $pathToFile = storage_path('app/public/' . $document->file_path);

        if (!file_exists($pathToFile)) {
            abort(404);
        }

        return response()->download($pathToFile, $document->name, ['Content-Length: ' . $document->size]);
    }
}
