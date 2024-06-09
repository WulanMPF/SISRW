<?php

namespace App\Http\Controllers\Sekretaris;

use App\DataTables\ArsipSuratDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArsipSuratDataTable $dataTable)
    {
        $breadcrumb = (object) [
            'title' => 'Persuratan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Persuratan']
        ];

        $activeMenu = 'arsip_surat';

        $arsip_surat = ArsipSuratModel::all();

        return view('sekretaris.surat.index', ['breadcrumb' => $breadcrumb, 'arsip_surat' => $arsip_surat, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $arsip_surat = ArsipSuratModel::all();

        if ($request->has('pengirim') && $request->pengirim != '') {
            $arsip_surat->where('pengirim', $request->pengirim);
        }

        return DataTables::of($arsip_surat)
            ->addIndexColumn()
            ->addColumn('Action', function ($arsip_surat) {
                $btn = '<a href="' . url('/sekretaris/surat/' . $arsip_surat->arsip_surat_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                $btn .= '<a href="' . url('/sekretaris/surat/' . $arsip_surat->arsip_surat_id . '/edit') . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff;" font-size: 17px;></i></a>';
                $btn .= '<button class="btn btn-sm delete-btn" data-toggle="modal" data-target="#delete" data-surat-id="' . $arsip_surat->arsip_surat_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';
                return $btn;
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Buat Surat',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Persuratan', 'Buat Surat']
        ];

        $activeMenu = 'arsip_surat';

        return view('sekretaris.surat.create', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
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

        return redirect('/sekretaris/surat')->with('success', 'Data surat berhasil disimpan');
    }
    public function edit(string $id)
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

        return view('sekretaris.surat.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'arsip_surat' => $arsip_surat, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, string $id)
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

        return redirect('/sekretaris/surat')->with('success', 'Data surat berhasil diperbarui');
    }
    public function show(string $id)
    {
        $arsip_surat = ArsipSuratModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Surat',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Persuratan', 'Detail Surat']
        ];

        $activeMenu = 'arsip_surat';

        return view('sekretaris.surat.show', ['breadcrumb' => $breadcrumb, 'arsip_surat' => $arsip_surat, 'activeMenu' => $activeMenu]);
    }

    public function destroy(string $id)
    {
        $check = ArsipSuratModel::find($id);
        if (!$check) {
            return redirect('/sekretaris/surat')->with('error', 'Data surat tidak ditemukan');
        }

        try {
            ArsipSuratModel::destroy($id);

            return redirect('/sekretaris/surat')->with('success', 'Data surat berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sekretaris/surat')->with('error', 'Data surat gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
