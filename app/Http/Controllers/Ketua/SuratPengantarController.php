<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use App\Models\KkModel;
use App\Models\SuratPengantarModel;
use App\Models\UserModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class SuratPengantarController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Persuratan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Persuratan']
        ];

        $activeMenu = 'arsip_surat';

        $pengantar = SuratPengantarModel::all();
        return view('ketua.pengantar.index', ['breadcrumb' => $breadcrumb, 'pengantar' => $pengantar, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $pengantar = SuratPengantarModel::all();

        return DataTables::of($pengantar)
            ->addIndexColumn()
            ->addColumn('Action', function ($pengantar) {
                $btn = '<a href="' . url('/ketua/pengantar/' . $pengantar->pengantar_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                $btn .= '<a href="' . url('/ketua/pengantar/cetak_surat_pdf/' . $pengantar->pengantar_id) . '" target="_blank" class="btn btn-sm"><i class="fas fa-print" style="color: #28a745; font-size: 17px;"></i></a>';
                $btn .= '<button class="btn btn-sm delete-btn" data-toggle="modal" data-target="#confirmationDelete" data-pengantar-id="' . $pengantar->pengantar_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';

                return $btn;
            })
            ->rawColumns(['Action'])
            ->make(true);
    }
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Buat Surat Pengantar',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Arsip Surat', 'Buat Surat Pengantar']
        ];

        $user = UserModel::all();

        $activeMenu = 'arsip_surat';

        return view('ketua.pengantar.create', ['breadcrumb' => $breadcrumb, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'pengantar_nama' => 'required|string|max:20',
            'pengantar_no_surat' => 'required|string|max:20',
            'pengantar_isi_nik' => 'required|string|max:20',
            'pengantar_isi_nama' => 'required|string|max:100',
            'pengantar_isi_keperluan' => 'required|string|max:100',
        ]);

        if (!auth()->check()) {
            return redirect('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        $user_id = auth()->user()->user_id;
        $warga = WargaModel::where('nik', $request->pengantar_isi_nik)->first();

        if ($warga) {
            $kk_warga = KkModel::where('kk_id', $warga->kk_id)->first();

            $pengantar = SuratPengantarModel::create([
                'user_id' => $user_id,
                'pengantar_nama' => $request->pengantar_nama,
                'pengantar_no_surat' => $request->pengantar_no_surat,
                'pengantar_isi_nik' => $request->pengantar_isi_nik,
                'pengantar_isi_nama' => $request->pengantar_isi_nama,
                'pengantar_isi_ttl' => $warga->tempat_tgl_lahir,
                'pengantar_isi_jk' => $warga->jenis_kelamin,
                'pengantar_isi_agama' => $warga->agama,
                'pengantar_isi_pekerjaan' => $warga->pekerjaan,
                'pengantar_isi_alamat' => $kk_warga ? $kk_warga->alamat : null, // Check if $kk_warga is not null
                'pengantar_isi_keperluan' => $request->pengantar_isi_keperluan,
            ]);
        } else {
            return response()->json(['error' => 'Warga not found'], 404);
        }

        // Generate PDF
        $user       = UserModel::where('level_id', 2)->first();
        $ketua_id   = $user->warga_id;
        $ketua      = WargaModel::find($ketua_id);

        $pdf            = PDF::loadView('surat.cetak_pengantar', ['pengantar' => $pengantar, 'user' => $user, 'ketua_id' => $ketua_id, 'ketua' => $ketua]);
        $filename = 'Surat_Pengantar_' . $pengantar->user_id . '.pdf';
        $directory = public_path('arsip_surat');

        // Buat direktori jika tidak ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;

        // Save the PDF to the specified path
        try {
            $pdf->save($path);
        } catch (\Exception $e) {
            return redirect('/ketua/pengantar')->with('error', 'Gagal menyimpan PDF: ' . $e->getMessage());
        }

        // Create entry in Arsip Surat as Surat Masuk for Ketua
        ArsipSuratModel::create([
            'nomor_surat' => $pengantar->pengantar_no_surat,
            'tanggal_surat' => now(),
            'pengirim' => $pengantar->pengantar_isi_nama,
            'penerima' => 'Ketua RW',
            'perihal' => 'Permohonan Surat Pengantar',
            'lampiran' => $filename,
            'keterangan' => 'Surat Pengantar submitted by Warga'
        ]);

        return redirect('ketua/pengantar')->with('success', 'Surat Pengantar berhasil dibuat');
    }
    public function show(string $id)
    {
        $pengantar = SuratPengantarModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Formulir Surat Pengantar UMKM RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Surat Pengantar', 'Detail']
        ];

        $page = (object)[
            'title' => 'Surat Pengantar RW 05'
        ];

        $activeMenu = 'surat';

        return view('ketua.pengantar.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'pengantar' => $pengantar, 'activeMenu' => $activeMenu]);
    }
    public function cetak(Request $request, $pengantar_id)
    {
        $user = UserModel::where('level_id', 2)->first();
        $ketua_id = $user->warga_id;
        $ketua = WargaModel::find($ketua_id);
        $pengantar = SuratPengantarModel::find($pengantar_id);

        \Carbon\Carbon::setLocale('id');

        if (!$pengantar) {
            // Handle jika data pengantar tidak ditemukan
        }

        $html = view('surat.cetak_pengantar',  ['pengantar' => $pengantar, 'user' => $user, 'ketua_id' => $ketua_id, 'ketua' => $ketua])->render();

        $pdf = PDF::loadHTML($html);
        return $pdf->stream($pengantar->pengantar_nama . '.pdf');
    }
    public function destroy(string $id)
    {
        $check = SuratPengantarModel::find($id);
        if (!$check) {
            return redirect('/ketua/pengantar')->with('error', 'Surat Pengantar Keuangan tidak ditemukan');
        }
        try {
            SuratPengantarModel::destroy($id);
            return redirect('/ketua/pengantar')->with('success', 'Surat Pengantar RW 05 berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/pengantar')->with('error', 'Surat Pengantar RW 05 gagal dihapus');
        }
    }
}
