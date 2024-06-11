<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use App\Models\SuratUndanganModel;
use App\Models\UserModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class SuratUndanganController extends Controller
{
    public function indexUndangan()
    {
        $breadcrumb = (object) [
            'title' => 'Persuratan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Persuratan']
        ];

        $activeMenu = 'arsip_surat';

        $undangan = SuratUndanganModel::all();
        return view('ketua.undangan.index', ['breadcrumb' => $breadcrumb, 'undangan' => $undangan, 'activeMenu' => $activeMenu]);
    }
    public function listUndangan(Request $request)
    {
        $undangan = SuratUndanganModel::all();

        return DataTables::of($undangan)
            ->addIndexColumn()
            ->addColumn('Action', function ($undangan) {
                $btn = '<button class="btn btn-sm info-btn" data-toggle="modal" data-target="#lihatSuratUndangan" data-undangan-id="' . $undangan->undangan_id . '"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></button>';
                $btn .= '<a href="' . url('/ketua/undangan/' . $undangan->undangan_id) . '/edit' . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff; font-size: 17px;"></i></a>';
                $btn .= '<a href="' . url('/ketua/undangan/cetak_surat_pdf/' . $undangan->undangan_id) . '" target="_blank" class="btn btn-sm"><i class="fas fa-print" style="color: #28a745; font-size: 17px;"></i></a>';
                $btn .= '<button class="btn btn-sm delete-btn" data-toggle="modal" data-target="#confirmationDelete" data-undangan-id="' . $undangan->undangan_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';

                return $btn;
            })
            ->rawColumns(['Action'])
            ->make(true);
    }
    public function createUndangan()
    {
        $breadcrumb = (object) [
            'title' => 'Buat Surat Undangan',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Arsip Surat', 'Buat Surat Undangan']
        ];

        $user = UserModel::all();

        $activeMenu = 'arsip_surat';

        return view('ketua.undangan.create', ['breadcrumb' => $breadcrumb, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    public function storeUndangan(Request $request)
    {
        $request->validate([
            'undangan_nama' => 'required|string|max:20',
            'undangan_tempat' => 'required|string|max:20',
            'undangan_tanggal' => 'required|date',
            'undangan_no_surat' => 'required|string|max:20',
            'undangan_perihal' => 'required|string|max:20',
            'undangan_isi_hari' => 'required|string|max:20',
            'undangan_isi_tgl' => 'required|date',
            'undangan_isi_waktu' => 'required|date_format:H:i',
            'undangan_isi_tempat' => 'required|string|max:20',
            'undangan_isi_acara' => 'required|string|max:100',
        ]);

        if (!auth()->check()) {
            return redirect('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        $user_id = auth()->user()->user_id;

        $undangan = SuratUndanganModel::create([
            'user_id' => $user_id,
            'undangan_nama' => $request->undangan_nama,
            'undangan_tempat' => $request->undangan_tempat,
            'undangan_tanggal' => $request->undangan_tanggal,
            'undangan_no_surat' => $request->undangan_no_surat,
            'undangan_perihal' => $request->undangan_perihal,
            'undangan_isi_hari' => $request->undangan_isi_hari,
            'undangan_isi_tgl' => $request->undangan_isi_tgl,
            'undangan_isi_waktu' => $request->undangan_isi_waktu,
            'undangan_isi_tempat' => $request->undangan_isi_tempat,
            'undangan_isi_acara' => $request->undangan_isi_acara,
        ]);

        // Retrieve the necessary data for the PDF
        $user = UserModel::where('level_id', 2)->first();
        $ketua_id = $user->warga_id;
        $ketua = WargaModel::find($ketua_id);

        \Carbon\Carbon::setLocale('id');

        if (!$undangan) {
            return redirect('ketua/surat')->with('error', 'Data surat tidak ditemukan');
        }

        // Format the date to ddmmyyyy
        $formattedDate = Carbon::parse($undangan->undangan_tanggal)->format('dmY');
        $filename = $undangan->undangan_nama . '_' . $formattedDate . '.pdf';
        $directory = public_path('arsip_surat');

        // Buat direktori jika tidak ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;

        // Generate and save the PDF to the specified path
        try {
            $pdf = PDF::loadView('surat.cetak_surat', ['undangan' => $undangan, 'user' => $user, 'ketua_id' => $ketua_id, 'ketua' => $ketua]);
            $pdf->save($path);
        } catch (\Exception $e) {
            return redirect('/sekretaris/undangan')->with('error', 'Gagal menyimpan PDF: ' . $e->getMessage());
        }

        // Create entry in Arsip Surat as Surat Masuk for Ketua
        ArsipSuratModel::create([
            'nomor_surat' => $undangan->undangan_no_surat,
            'tanggal_surat' => $undangan->undangan_tanggal,
            'pengirim' => 'RW',
            'penerima' => 'Warga',
            'perihal' => $undangan->undangan_perihal,
            'lampiran' => $filename,
            'keterangan' => $undangan->undangan_isi_acara
        ]);

        // $html = view('surat.cetak_surat', ['undangan' => $undangan, 'user' => $user, 'ketua_id' => $ketua_id, 'ketua' => $ketua])->render();

        // $pdf = PDF::loadHTML($html);
        return $pdf->stream($filename);
    }
    public function editUndangan(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Formulir Surat Undangan UMKM RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', ' Surat Undangan ', 'Edit']
        ];
        $page = (object)[
            'title' => 'Surat Undangan RW 05'
        ];

        $undangan = SuratUndanganModel::find($id);
        $activeMenu = 'arsip_surat';
        return view('ketua.undangan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'undangan' => $undangan, 'activeMenu' => $activeMenu]);
    }

    public function updateUndangan(Request $request, string $id)
    {
        $request->validate([
            'undangan_nama'         => 'nullable|string|max:255',
            'undangan_tempat'       => 'nullable|string|max:255',
            'undangan_tanggal'      => 'nullable|date',
            'undangan_no_surat'     => 'nullable|string|max:255',
            'undangan_perihal'      => 'nullable|string|max:255',
            'undangan_isi_hari'     => 'nullable|string|max:255',
            'undangan_isi_tgl'      => 'nullable|date',
            'undangan_isi_waktu'    => 'nullable',
            'undangan_isi_tempat'   => 'nullable|string|max:255',
            'undangan_isi_acara'    => 'nullable|string|max:255'
        ]);

        SuratUndanganModel::find($id)->update([
            'undangan_nama'         => $request->undangan_nama,
            'undangan_tempat'       => $request->undangan_tempat,
            'undangan_tanggal'      => $request->undangan_tanggal,
            'undangan_no_surat'     => $request->undangan_no_surat,
            'undangan_perihal'      => $request->undangan_perihal,
            'undangan_isi_hari'     => $request->undangan_isi_hari,
            'undangan_isi_tgl'      => $request->undangan_isi_tgl,
            'undangan_isi_waktu'    => $request->undangan_isi_waktu,
            'undangan_isi_tempat'   => $request->undangan_isi_tempat,
            'undangan_isi_acara'    => $request->undangan_isi_acara
        ]);

        return redirect('/ketua/undangan')->with('success', 'Surat Undangan berhasil dibuat');
    }
    public function showUndangan($id)
    {
        $undangan = SuratUndanganModel::findOrFail($id); // Mengambil data undangan berdasarkan ID
        return view('ketua.undangan.show', compact('undangan')); // Menampilkan view dengan data undangan
    }
    public function cetak(Request $request, $undangan_id)
    {
        $user = UserModel::where('level_id', 2)->first();
        $ketua_id = $user->warga_id;
        $ketua = WargaModel::find($ketua_id);
        $undangan = SuratUndanganModel::find($undangan_id);

        \Carbon\Carbon::setLocale('id');

        if (!$undangan) {
            // Handle jika data undangan tidak ditemukan
        }

        $html = view('surat.cetak_surat',  ['undangan' => $undangan, 'user' => $user, 'ketua_id' => $ketua_id, 'ketua' => $ketua])->render();

        $pdf = PDF::loadHTML($html);
        return $pdf->stream($undangan->undangan_nama . '.pdf');
    }
    public function destroyUndangan(string $id)
    {
        $check = SuratUndanganModel::find($id);
        if (!$check) {
            return redirect('/ketua/undangan')->with('error', 'Surat UndanganKeuangan tidak ditemukan');
        }
        try {
            SuratUndanganModel::destroy($id);
            return redirect('/ketua/undangan')->with('success', 'Surat UndanganRW 05 berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/undangan')->with('error', 'Surat Undangan RW 05 gagal dihapus');
        }
    }
}
