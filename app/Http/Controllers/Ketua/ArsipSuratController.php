<?php

namespace App\Http\Controllers\Ketua;

use App\DataTables\ArsipSuratDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArsipSuratModel;
use App\Models\SuratUndanganModel;
use App\Models\UserModel;
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
        $arsip_surat = ArsipSuratModel::all();

        // Check if jenis_surat is provided in the request and not empty
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            // Filter data based on jenis_surat
            $arsip_surat->where('jenis_surat', $request->jenis_surat);
        }

        return DataTables::of($arsip_surat)
            ->addIndexColumn()
            ->addColumn('Action', function ($arsip_surat) {
                // Define your action button here
                $btn = '<a href="' . url('/ketua/surat/' . $arsip_surat->arsip_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white;">Lihat Surat</a> ';
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

        SuratUndanganModel::create([
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
