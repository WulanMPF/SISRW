<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\KkModel;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $umkm = UmkmModel::where('status_usaha', 'Aktif');
        $warga = WargaModel::all();

        $jenis_usaha = $request->input('kategori');

        // data UMKM berdasarkan kategori
        if ($jenis_usaha) {
            $umkm = $umkm->where('jenis_usaha', $jenis_usaha)->get();
        } else {
            $umkm = $umkm->get();
        }

        return view('warga.umkm.index', ['breadcrumb' => $breadcrumb, 'umkm' => $umkm, 'warga' => $warga, 'jenis_usaha' => $jenis_usaha, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $warga_id = auth()->user()->warga_id;

        $umkm = UmkmModel::select('*')->where('warga_id', $warga_id);

        if ($request->jenis_usaha) {
            $umkm->where('jenis_usaha', $request->jenis_usaha);
        } elseif ($request->status_usaha) {
            $umkm->where('status_usaha', $request->status_usaha);
        }

        $umkm = $umkm->with('warga')->get();

        return DataTables::of($umkm)
            ->addIndexColumn()
            ->addColumn('aksi', function ($umkm) {
                $status_usaha = strtolower($umkm->status_usaha);
                $btn = '';
                if ($status_usaha == 'aktif') {
                    $btn .= '<div class="btn-group mr-2">';
                    $btn .= '<a href="' . url('/warga/umkm/' . $umkm->umkm_id . '/edit') . '" class="btn btn-xs btn-warning mr-2" style="border-radius: 6px;"><i class="fas fa-edit fa-lg"></i></a>';
                    $btn .= '<button type="button" class="btn btn-xs btn-danger" style="border-radius: 6px;" data-toggle="modal" data-target="#deactiveUMKM" data-umkm-id="' . $umkm->umkm_id . '"><i class="fas fa-trash fa-lg"></i></button>';
                    $btn .= '</div>';
                }
                $btn .= '<a href="' . url('/warga/umkm/' . $umkm->umkm_id) . '" class="btn btn-xs btn-primary" style="border-radius: 6px;"><i class="fas fa-info-circle fa-lg"></i></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        $times = [];
        $periods = CarbonPeriod::create('00:00', '30 minutes', '23:59');

        foreach ($periods as $period) {
            $times[] = $period->format('H:i');
        }

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

        return view('warga.umkm.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'warga' => $warga, 'times' => $times, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha'  => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:50',
            'jenis_usaha' => 'required|string|max:30',
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i',
            'no_telepon' => 'required|string|max:20',
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
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'no_telepon' => $request->no_telepon,
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
    public function umkmSaya()
    {
        // Ambil warga_id dari pengguna yang saat ini diotentikasi
        $warga_id = auth()->user()->warga_id;

        // Cek apakah warga_id tidak kosong dan benar-benar ditemukan
        if (!$warga_id) {
            abort(404, 'Warga not found');
        }

        // Mengambil UMKM berdasarkan warga_id
        $umkm = UmkmModel::with('warga')->where('warga_id', $warga_id)->get();

        // Jika tidak ada UMKM ditemukan untuk warga yang diberikan, mungkin perlu ditangani dengan lebih lanjut
        if ($umkm->isEmpty()) {
            abort(404, 'UMKM not found for this warga');
        }

        // Data untuk breadcrumb
        $breadcrumb = (object)[
            'title' => 'Detail UMKM RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail UMKM Saya'
        ];

        $activeMenu = 'umkm';

        return view('warga.umkm.umkm_saya', compact('breadcrumb', 'page', 'umkm', 'warga_id', 'activeMenu'));
    }
}
