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
            'periode_id' => 'required|integer',
            'kk_id' => 'required|integer',
            'tgl_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|string|max:20',
        ]);

        // Simpan data ke database
        IuranModel::create([
            'periode_id' => $request->periode_id,
            'kk_id' => $request->kk_id,
            'laporan_id' => null,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('bendahara.iuran.index')->with('success', 'Pembayaran iuran berhasil dilakukan.');
    }

    public function show($id)
    {
        // Mengambil data iuran berdasarkan ID
        $iuran = IuranModel::findOrFail($id);

        // Mengembalikan view yang menampilkan detail iuran
        return view('bendahara.iuran.show', compact('iuran'));
    }
}
