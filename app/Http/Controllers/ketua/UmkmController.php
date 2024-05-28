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
                $btn = '';
                if ($umkm->status_usaha == 'Aktif') {
                    $btn .= '<div class="btn-group mr-2">';
                    $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id . '/edit') . '" class="btn btn-xs btn-warning mr-2" style="border-radius: 6px;"><i class="fas fa-edit fa-lg"></i></a>';
                    $btn .= '<button type="button" class="btn btn-xs btn-danger" style="border-radius: 6px;" data-toggle="modal" data-target="#deactiveUMKM"><i class="fas fa-trash fa-lg"></i></button>';

                    // Tampilan localhost
                    // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/ketua/umkm/' . $umkm->umkm_id . '/deactive') . '">'
                    // . csrf_field() . method_field('PUT') .
                    // '<button type="submit" class="btn btn-xs btn-danger" style="border-radius: 6px;" onclick="return confirm(\'Apakah anda yakin ingin menonaktifkan UMKM?\')"><i class="fas fa-trash fa-lg"></i></button>';
                    // $btn .= '</form>';

                    $btn .= '</div>';
                } elseif ($umkm->status_usaha == 'Diproses') {
                    $btn .= '<div class="btn-group mr-2">';
                    $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id . '/accept') . '" class="btn btn-xs btn-success mr-2" style="border-radius: 6px;"><i class="fas fa-check fa-lg"></i></a>';
                    $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id . '/reject') . '" class="btn btn-xs btn-danger" style="border-radius: 6px;"><i class="fas fa-times fa-lg"></i></a>';
                    $btn .= '</div>';
                }

                // Button "Lihat Detail" selalu ditampilkan di tengah
                $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id) . '" class="btn btn-xs btn-primary" style="border-radius: 6px;"><i class="fas fa-info-circle fa-lg"></i></a>';

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

        return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil ditambahkan');
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

        return view('ketua.umkm.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
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

        return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil diupdate');
    }

    public function deactive(string $id)
    {
        $umkm = UmkmModel::find($id);
        if (!$umkm) {
            return redirect('/ketua/umkm')->with('error', 'Data UMKM tidak ditemukan');
        }
        try {
            // Ubah status UMKM menjadi 'nonaktif'
            $umkm->update(['status_usaha' => 'Nonaktif']);

            return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil dinonaktifkan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/umkm')->with('error', 'Gagal menonaktifkan data UMKM');
        }
    }
}
