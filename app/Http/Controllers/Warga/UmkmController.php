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
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Data UMKM RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM']
        ];

        $activeMenu = 'umkm';

        $umkm = UmkmModel::where('status_usaha', 'Aktif')->get();
        $warga = WargaModel::all();

        $jenis_usaha = $request->input('kategori');

        // data UMKM berdasarkan kategori
        if ($jenis_usaha) {
            $umkm = UmkmModel::where('jenis_usaha', $jenis_usaha)->get();
        } else {
            $umkm = UmkmModel::all();
        }

        if ($umkm->isEmpty()) {
            return back()->with('error', 'Data UMKM dengan kategori "' . $jenis_usaha . '" tidak ditemukan.');
        }

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
            'nama_usaha'  => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:30',
            'deskripsi' => 'required|string|max:200',
            'lampiran' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        // Ambil warga_id dari sesi login
        $warga_id = auth()->user()->warga_id;
        // Mendapatkan nama file yang diacak menggunakan hashName()
        $namaFile = $request->file('lampiran')->hashName();

        // Buat entri di database dengan nama file yang dihasilkan oleh hashName()
        UmkmModel::create([
            'warga_id'    =>  $warga_id,
            'nama_usaha'  => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status_usaha' => 'diproses', // Set status_usaha menjadi "diproses"
            'deskripsi' => $request->deskripsi,
            'lampiran' => $namaFile
        ]);

        // Simpan gambar ke dalam direktori lampiran_umkm dengan nama yang dihasilkan oleh hashName()
        // $lampiranPath = $request->file('lampiran')->storeAs('umkm', $namaFile); // direktori storage/umkm
        $path = $request->file('lampiran')->move('lampiran_umkm', $namaFile);
        $path = str_replace("\\", "//", $path);

        return redirect('/warga/umkm')->with('success', 'Data UMKM berhasil diajukan');
    }
    public function show(string $id)
    {
        $umkm = UmkmModel::with('warga')->find($id);
        $warga = WargaModel::with('umkm')->find($id);

        if (!$warga) {
            // Handle case where warga is not found
            abort(404, 'Warga not found');
        }

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
