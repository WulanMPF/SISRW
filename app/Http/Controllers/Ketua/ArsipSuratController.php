<?php

namespace App\Http\Controllers\Ketua;

use App\DataTables\ArsipSuratDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use App\Models\SuratUndanganModel;
use App\Models\UserModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ArsipSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArsipSuratDataTable $dataTable)
    {
        $breadcrumb = (object) [
            'title' => 'Arsip Surat RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Arsip surat']
        ];

        $activeMenu = 'arsip_surat';

        $arsip_surat = ArsipSuratModel::all();

        return view('ketua.surat.index', ['breadcrumb' => $breadcrumb, 'arsip_surat' => $arsip_surat, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $arsip_surat = ArsipSuratModel::all();

        /*// Check if jenis_surat is provided in the request and not empty
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            // Filter data based on jenis_surat
            $arsip_surat->where('jenis_surat', $request->jenis_surat);
        }*/

        if ($request->has('pengirim') && $request->pengirim != '') {
            $arsip_surat->where('pengirim', $request->pengirim);
        }

        return DataTables::of($arsip_surat)
            ->addIndexColumn()
            ->addColumn('Action', function ($arsip_surat) {
                $btn = '<a href="' . url('/ketua/surat/' . $arsip_surat->arsip_surat_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                $btn .= '<a href="' . url('/ketua/surat/' . $arsip_surat->arsip_surat_id . '/edit') . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff;" font-size: 17px;></i></a>';
                $btn .= '<button class="btn btn-sm delete-btn" data-toggle="modal" data-target="#delete" data-surat-id="' . $arsip_surat->arsip_surat_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';
                return $btn;
            })
            ->rawColumns(['Action'])
            ->make(true);
    }
    public function createArsipSurat()
    {
        $breadcrumb = (object) [
            'title' => 'Buat Surat',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Persuratan', 'Buat Surat']
        ];

        $activeMenu = 'arsip_surat';

        return view('ketua.surat.create', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function storeArsipSurat(Request $request)
    {
        $request->validate([
            'nomor_surat'       => 'required|string|max:50',
            'tanggal_surat'     => 'required|date',
            'pengirim'          => 'required|string|max:25',
            'penerima'          => 'required|string|max:25',
            'perihal'           => 'required|string|max:50',
            'lampiran'          => 'nullable|file',
            'keterangan'        => 'required|string'
        ]);

        if ($request->file) {
            $namaFile = $request->file('lampiran')->hashName();
            $path = $request->file('lampiran')->move('arsip_surat', $namaFile);
            $path = str_replace("\\", "//", $path);
        } else {
            $namaFile = null;
        }

        ArsipSuratModel::create([
            'nomor_surat'       => $request->nomor_surat,
            'tanggal_surat'     => $request->tanggal_surat,
            'pengirim'          => $request->pengirim,
            'penerima'          => $request->penerima,
            'perihal'           => $request->perihal,
            'lampiran'          => $namaFile,
            'keterangan'        => $request->keterangan,
        ]);

        return redirect('/ketua/surat')->with('success', 'Data surat berhasil disimpan');
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

        return view('ketua.surat.create-undangan', ['breadcrumb' => $breadcrumb, 'user' => $user, 'activeMenu' => $activeMenu]);
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

        $undangan = SuratUndanganModel::create([
            'user_id' => auth()->user()->id,
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

        $html = view('sekretaris.undangan.cetak_surat', ['undangan' => $undangan, 'user' => $user, 'ketua_id' => $ketua_id, 'ketua' => $ketua])->render();

        $pdf = PDF::loadHTML($html);
        return $pdf->stream($undangan->undangan_nama . '.pdf');
    }
    public function editArsipSurat(string $id)
    {
        $arsip_surat = ArsipSuratModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Data UMKM RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM RW 05', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit UMKM RW 05'
        ];

        $activeMenu = 'arsip_surat';

        return view('ketua.surat.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'arsip_surat' => $arsip_surat, 'activeMenu' => $activeMenu]);
    }
    public function updateArsipSurat(Request $request, string $id)
    {
        $request->validate([
            'nomor_surat'       => 'required|string|max:50',
            'tanggal_surat'     => 'required|date',
            'pengirim'          => 'required|string|max:25',
            'penerima'          => 'required|string|max:25',
            'perihal'           => 'required|string|max:50',
            'lampiran'          => 'nullable|file',
            'keterangan'        => 'required|string'
        ]);

        if ($request->file) {
            $namaFile = $request->file('lampiran')->hashName();
            $path = $request->file('lampiran')->move('arsip_surat', $namaFile);
            $path = str_replace("\\", "//", $path);
        }

        ArsipSuratModel::find($id)->update([
            'nomor_surat'       => $request->nomor_surat,
            'tanggal_surat'     => $request->tanggal_surat,
            'pengirim'          => $request->pengirim,
            'penerima'          => $request->penerima,
            'perihal'           => $request->perihal,
            'lampiran'          => $request->file('lampiran') ? $namaFile : basename(ArsipSuratModel::find($id)->lampiran),
            'keterangan'        => $request->keterangan,
        ]);

        return redirect('/ketua/surat')->with('success', 'Data surat berhasil diperbarui');
    }
    public function show(string $id)
    {
        $arsip_surat = ArsipSuratModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Surat',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Arsip Surat', 'Detail Surat']
        ];

        $activeMenu = 'arsip_surat';

        return view('ketua.surat.show', ['breadcrumb' => $breadcrumb, 'arsip_surat' => $arsip_surat, 'activeMenu' => $activeMenu]);
    }

    public function destroy(string $id)
    {
        $check = ArsipSuratModel::find($id);
        if (!$check) {
            return redirect('/ketua/surat')->with('error', 'Data surat tidak ditemukan');
        }

        try {
            ArsipSuratModel::destroy($id);

            return redirect('/ketua/surat')->with('success', 'Data surat berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/surat')->with('error', 'Data surat gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
