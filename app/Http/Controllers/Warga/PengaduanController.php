<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel; // Assuming this is the correct model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get data from database
        $pengaduan = PengaduanModel::where('status_pengaduan', 'Selesai')->get();

        // Breadcrumbs setup
        $breadcrumb = (object) [
            'title' => 'Formulir Aspirasi dan Pengaduan Warga',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan']
        ];

        // Active menu identifier
        $activeMenu = 'pengaduan';

        // Passing data to the view
        return view('warga.pengaduan.index', ['breadcrumb' => $breadcrumb, 'pengaduan' => $pengaduan, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $warga_id = auth()->user()->warga_id;

        $pengaduan = PengaduanModel::select('*')->where('warga_id', $warga_id);

        if ($request->status_pengaduan) {
            $pengaduan->where('status_pengaduan', $request->status_pengaduan);
        }

        $pengaduan = $pengaduan->with('warga')->get();

        return DataTables::of($pengaduan)
            ->addIndexColumn()
            ->addColumn('status_pengaduan', function ($row) {
                $color = '';
                if ($row->status_pengaduan == 'Ditunda') {
                    $color = 'text-danger';
                } elseif ($row->status_pengaduan == 'Diproses') {
                    $color = 'text-yellow-brown';
                } elseif ($row->status_pengaduan == 'Selesai') {
                    $color = 'text-success';
                }
                return '<span class="' . $color . '">' . $row->status_pengaduan . '</span>';
            })
            ->addColumn('aksi', function ($pengaduan) {
                $btn = '<a href="' . url('/warga/pengaduan/' . $pengaduan->pengaduan_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                return $btn;
            })
            ->rawColumns(['status_pengaduan', 'aksi'])
            ->make(true);
    }
    public function show($id)
    {
        $pengaduan = PengaduanModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Pengaduan',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan', 'Detail']
        ];

        $activeMenu = 'pengaduan';

        return view('warga.pengaduan.show', compact('breadcrumb', 'activeMenu', 'pengaduan'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_pengaduan' => 'required|date',
            'prioritas' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'jenis_pengaduan' => 'required|string|max:255', // Ensure this field exists in your form and database
            'lampiran' => 'required|file|max:2048',
        ]);

        // Ambil warga_id dari sesi login
        $warga_id = auth()->user()->warga_id;

        // Create a new Pengaduan entry using the model
        $pengaduan = new PengaduanModel();
        $pengaduan->warga_id = $warga_id; // Set warga_id from session
        $pengaduan->tgl_pengaduan = $request->tgl_pengaduan;
        $pengaduan->prioritas = $request->prioritas; // Ensure this field exists in your form and database
        $pengaduan->deskripsi = $request->deskripsi;
        $pengaduan->jenis_pengaduan = $request->jenis_pengaduan; // Set the jenis_pengaduan field
        $pengaduan->status_pengaduan = 'Diproses'; // Set status_pengaduan to "Diproses"
        $pengaduan->tindakan_diambil = 'belum ada tindakan'; // Set tindakan_diambil to "belum ada tindakan"

        // Handle file upload with Laravel's Storage facade
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $namaFile = $lampiran->getClientOriginalName();
            $path = $lampiran->move('lampiran', $namaFile);
            $path = str_replace("\\", "//", $path);
            $pengaduan->lampiran = $namaFile;
        }

        $pengaduan->save();

        // Redirect with success message
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diajukan.');
    }
    public function pengaduanSaya()
    {
        // Ambil warga_id dari pengguna yang saat ini diotentikasi
        $warga_id = auth()->user()->warga_id;

        // Cek apakah warga_id tidak kosong dan benar-benar ditemukan
        if (!$warga_id) {
            abort(404, 'Warga not found');
        }

        // Mengambil UMKM berdasarkan warga_id
        $pengaduan = PengaduanModel::with('warga')->where('warga_id', $warga_id)->get();

        // Jika tidak ada UMKM ditemukan untuk warga yang diberikan, mungkin perlu ditangani dengan lebih lanjut
        if ($pengaduan->isEmpty()) {
            abort(404, 'Pengaduan not found for this warga');
        }

        // Data untuk breadcrumb
        $breadcrumb = (object)[
            'title' => 'Pengaduan Saya',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan', 'Detail']
        ];

        $page = (object)[
            'title' => 'List Pengajuan Saya'
        ];

        $activeMenu = 'pengaduan';

        return view('warga.pengaduan.pengaduan_saya', compact('breadcrumb', 'page', 'pengaduan', 'warga_id', 'activeMenu'));
    }
}
