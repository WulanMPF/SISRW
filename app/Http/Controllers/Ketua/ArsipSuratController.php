<?php

namespace App\Http\Controllers\Ketua;

use App\DataTables\ArsipSuratDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
        $arsip_surat = ArsipSuratModel::select('arsip_surat_id', 'nama_surat', 'jenis_surat');

        // Check if jenis_surat is provided in the request and not empty
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            // Filter data based on jenis_surat
            $arsip_surat->where('jenis_surat', $request->jenis_surat);
        }

        return DataTables::of($arsip_surat)
            ->addIndexColumn()
            ->addColumn('Action', function ($arsip_surat) {
                // Define your action button here
                $btn = '<a href="' . url('/ketua/surat/' . $arsip_surat->arsip_surat_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white;">Lihat Surat</a> ';
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
            'list'  => ['Home', 'Arsip Surat', 'Buat Surat']
        ];

        $activeMenu = 'arsip_surat';

        return view('ketua.surat.create', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_surat'              => 'required|string|max:50',
            'jenis_surat'             => 'required|in:Masuk,Keluar',
        ]);

        ArsipSuratModel::create([
            'nama_surat'              => $request->nama_surat,
            'jenis_surat'             => $request->jenis_surat
        ]);

        return redirect('/ketua/surat.index')->with('success', 'Data surat berhasil disimpan');
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
            return redirect('/ketua/surat.index')->with('error', 'Data surat tidak ditemukan');
        }

        try {
            ArsipSuratModel::destroy($id);

            return redirect('/ketua/surat.index')->with('success', 'Data surat berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/surat.index')->with('error', 'Data surat gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}