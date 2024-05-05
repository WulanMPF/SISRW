<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\KkModel;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UmkmController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data UMKM RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM']
        ];

        $activeMenu = 'umkm';

        $umkm = UmkmModel::all();
        $warga = WargaModel::all();

        return view('warga.umkm.index', ['breadcrumb' => $breadcrumb, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    /*public function list(Request $request)
    {
        $umkm = UmkmModel::select('nama_usaha', 'alamat_usaha', 'jenis_usaha', 'status_usaha', 'deskripsi', 'lampiran')
            ->with('warga_id');


        if ($request->jenis_usaha) {
            $umkm->where('jenis_usaha', $request->jenis_usaha);
        }

        return DataTables::of($umkm)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($umkm) {
                $btn = '<a href="' . url('/umkm/' . $umkm->umkm_id) . '" class="btn btn-info btn-sm">Lihat Detail</a>  &nbsp;';
                return $btn;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }*/
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Formulir Pengajuan UMKM RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM', 'Pengajuan']
        ];
        $page = (object)[
            'title' => 'Ajukan UMKM RW 05'
        ];

        $warga = WargaModel::all();
        $activeMenu = 'umkm'; //set menu yang sedang aktif

        return view('warga.umkm.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'warga_id'    => 'required|integer',
            'nama_usaha'  => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:30',
            'status_usaha' => 'required',
            'deskripsi' => 'required|string|max:200',
            'lampiran' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        UmkmModel::create([
            'warga_id'    => $request->warga_id,
            'nama_usaha'  => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status_usaha' => $request->status_usaha,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $request->lampiran->hashName()
        ]);

        return redirect('/warga/umkm')->with('success', 'Data UMKM berhasil diajukans');
    }
    public function show(string $id)
    {
        $umkm = UmkmModel::with('warga')->find($id);
        $warga = WargaModel::all();

        $breadcrumb = (object)[
            'title' => 'Detail UMKM RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail UMKM RW 05'
        ];

        $activeMenu = 'umkm';

        return view('warga.umkm.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
}
