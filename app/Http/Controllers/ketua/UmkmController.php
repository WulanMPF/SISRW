<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar UMKM',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM']
        ];
        $page = (object)[
            'title' => 'Daftar UMKM yang terdaftar dalam sistem'
        ];
        $activeMenu = 'umkm';   //set menu yg sdg aktif

        $umkm = UmkmModel::all();
        $warga = WargaModel::all();

        return view('ketua.umkm.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $umkms = UmkmModel::select('umkm_id', 'warga_id', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'status_usaha', 'deskripsi', 'lampiran');

        if ($request->jenis_usaha) {
            $umkms->where('jenis_usaha', $request->jenis_usaha);
        }

        if ($request->status_usaha) {
            $umkms->where('status_usaha', $request->status_usaha);
        }

        return DataTables::of($umkms)
            ->addIndexColumn()
            ->addColumn('aksi', function ($umkm) {
                $btn = '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
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

        return view('ketua.umkm.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'warga' => $warga, 'activeMenu' => $activeMenu]);
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
        // Mendapatkan nama file yang diacak menggunakan hashName()
        $namaFile = $request->file('lampiran')->hashName();

        // Buat entri di database dengan nama file yang dihasilkan oleh hashName()
        UmkmModel::create([
            'warga_id'    => $request->warga_id,
            'nama_usaha'  => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status_usaha' => $request->status_usaha,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $namaFile
        ]);

        // Simpan gambar ke dalam direktori lampiran_umkm dengan nama yang dihasilkan oleh hashName()
        // $lampiranPath = $request->file('lampiran')->storeAs('umkm', $namaFile); // direktori storage/umkm
        $path = $request->file('lampiran')->move('lampiran_umkm', $namaFile);
        $path = str_replace("\\", "//", $path);

        return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil diajukans');
    }
    public function show(string $id)
    {
        $umkm = UmkmModel::with('warga')->find($id);
        $warga = WargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Data UMKM',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM', 'Detail']
        ];

        $activeMenu = 'umkm';

        return view('ketua.umkm.show', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'umkm' => $umkm, 'activeMenu' => $activeMenu]);
    }
}
