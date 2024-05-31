<?php

namespace App\Http\Controllers\Sekretaris;

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

        return view('sekretaris.umkm.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
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
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($umkm) {
                $btn = '<a href="' . url('/sekretaris/umkm/' . $umkm->umkm_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';

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

        return view('sekretaris.umkm.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'warga' => $warga, 'activeMenu' => $activeMenu]);
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

        return redirect('/sekretaris/umkm')->with('success', 'Data UMKM berhasil ditambahkan');
    }
    public function show(string $id)
    {
        $umkm = UmkmModel::with('warga')->find($id);
        $warga = WargaModel::with('umkm')->find($id);

        $breadcrumb = (object) [
            'title' => 'Data UMKM',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM', 'Detail']
        ];

        $activeMenu = 'umkm';

        return view('sekretaris.umkm.show', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'umkm' => $umkm, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $umkm = UmkmModel::find($id);
        $warga = WargaModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Data UMKM RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM RW 05', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit UMKM RW 05'
        ];

        $activeMenu = 'umkm';

        return view('sekretaris.umkm.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'warga_id'    => 'nullable|integer',
            'nama_usaha'  => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:30',
            'status_usaha' => 'required',
            'deskripsi' => 'required|string|max:200',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        if ($request->image) {
            $namaFile = $request->file('lampiran')->hashName();
            $path = $request->file('lampiran')->move('lampiran_umkm', $namaFile);
            $path = str_replace("\\", "//", $path);
        }

        UmkmModel::find($id)->update([
            'warga_id'    => $request->warga_id,
            'nama_usaha'  => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status_usaha' => $request->status_usaha,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $request->file('lampiran') ? $namaFile : basename(UmkmModel::find($id)->lampiran)
        ]);

        return redirect('/sekretaris/umkm')->with('success', 'Data UMKM berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $check = UmkmModel::find($id);
        if (!$check) {
            return redirect('/sekretaris/umkm')->with('error', 'Data UMKM Warga 05 tidak ditemukan');
        }
        try {
            UmkmModel::destroy($id);
            return redirect('/sekretaris/umkm')->with('success', 'Data UMKM Warga 05 berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sekretaris/umkm')->with('error', 'Data UMKM Warga 05 gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
