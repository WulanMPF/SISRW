<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KkModel;
use App\Models\LapkeuModel;
use App\Models\LaporanKeuanganModel;
use App\Models\PeriodeIuranModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Pembayaran Iuran RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Pembayaran Iuran']
        ];

        $activeMenu = 'iuran';

        $iurans = IuranModel::all();
        $kk = KkModel::all();
        $periode = PeriodeIuranModel::all();

        return view('bendahara.iuran.index', compact('breadcrumb', 'iurans', 'kk', 'periode', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $periodes = PeriodeIuranModel::select('periode_id', 'bulan', 'tahun');


        if ($request->tahun) {
            $periodes->where('tahun', $request->tahun);
        }

        return DataTables::of($periodes)
            ->addIndexColumn()
            ->addColumn('aksi', function ($periode) {
                $btn = '<a href="' . url('/bendahara/iuran/' . $periode->periode_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function bayar($id)
    {
        $breadcrumb = (object) [
            'title' => 'Data Pembayaran Iuran RW 05 Bulan',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Pembayaran Iuran']
        ];

        $activeMenu = 'iuran';

        $periode = PeriodeIuranModel::findOrFail($id);
        $iurans = IuranModel::all();
        $kk = KkModel::all();
        return view('bendahara.iuran.pembayaran', compact('breadcrumb', 'iurans', 'periode', 'kk', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Iuran Baru',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Pembayaran Iuran', 'Tambah Data Baru']
        ];

        $activeMenu = 'iuran';

        $kk = KkModel::all(); // Ambil data KK untuk dropdown atau kebutuhan lainnya

        return view('bendahara.iuran.create', compact('breadcrumb', 'kk', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_kepala_keluarga' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:255',
            'tgl_pembayaran' => 'required|date',
            'jumlah_bayar' => 'required|numeric',
            'status_pembayaran' => 'required|string|max:255',
        ]);

        // Temukan ID KK berdasarkan nama kepala keluarga dan RT/RW
        $kk = KKModel::where('nama_kepala_keluarga', $request->nama_kepala_keluarga)
            ->where('rt_rw', $request->rt_rw)
            ->first();

        if (!$kk) {
            return redirect()->route('iuran.index')->with('error', 'Data KK tidak ditemukan.');
        }

        // Simpan data ke database
        IuranModel::create([
            'kk_id' => $kk->id,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'jumlah_bayar' => $request->jumlah_bayar,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('iuran.index')->with('success', 'Pembayaran iuran berhasil dilakukan.');
    }

    public function show($id)
    {
        // Mengambil data iuran berdasarkan ID
        $iuran = IuranModel::findOrFail($id);

        // Mengembalikan view yang menampilkan detail iuran
        return view('bendahara.iuran.show', compact('iuran'));
    }
}
