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
    public function bayar(Request $request, $id)
    {
        $breadcrumb = (object) [
            'title' => 'Data Pembayaran Iuran RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Pembayaran Iuran']
        ];

        $activeMenu = 'iuran';

        $periode = PeriodeIuranModel::findOrFail($id);
        $kk = KkModel::with(['iuran' => function ($query) use ($periode) {
            $query->where('periode_id', $periode->periode_id);
        }])->get();

        $iuran = IuranModel::select()->get();
        if ($request->has('status_pembayaran') && $request->status_pembayaran != '') {
            $iuran->where('status_pembayaran', $request->status_pembayaran);
        }


        return view('bendahara.iuran.pembayaran', compact('breadcrumb', 'periode', 'kk', 'iuran', 'activeMenu'));
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
        ], [
            'periode_id.required' => 'Periode harus diisi.',
            'kk_id.required' => 'Kepala Keluarga harus diisi.',
            'tgl_pembayaran.required' => 'Tanggal pembayaran harus diisi.',
            'tgl_pembayaran.date' => 'Tanggal pembayaran harus berupa tanggal yang valid.',
            'status_pembayaran.required' => 'Status pembayaran harus diisi.',
        ]);

        // Simpan data ke database
        IuranModel::create([
            'periode_id' => $request->periode_id,
            'kk_id' => $request->kk_id,
            'laporan_id' => null,
            'tgl_pembayaran' => $request->tgl_pembayaran,
            'jumlah_bayar' => 55000,
            'status_pembayaran' => $request->status_pembayaran,
            'lampiran' => null,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        $id_periode = $request->periode_id; // or however you obtain the id_periode
        return redirect()->route('bendahara.iuran.bayar', ['id_periode' => $id_periode])->with('success', 'Pembayaran iuran berhasil dilakukan.');
    }


    public function show(string $id)
    {
        $iuran = IuranModel::with('kk')->findOrFail($id); // Load the kk relationship

        $breadcrumb = (object) [
            'title' => 'Data Iuran Warga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Iuran Warga', 'Detail']
        ];

        $activeMenu = 'iuran';

        return view('bendahara.iuran.show', ['breadcrumb' => $breadcrumb, 'iuran' => $iuran, 'activeMenu' => $activeMenu]);
    }

    public function validasi()
    {
        $breadcrumb = (object) [
            'title' => 'Validasi Pembayaran Iuran RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Validasi Pembayaran Iuran']
        ];

        $activeMenu = 'iuran';

        $iurans = IuranModel::all();
        $kk = KkModel::all();
        $periode = PeriodeIuranModel::all();

        return view('bendahara.iuran.validasi', compact('breadcrumb', 'iurans', 'kk', 'periode', 'activeMenu'));
    }

    public function listValidasi(Request $request)
    {
        if ($request->ajax()) {
            $data = IuranModel::join('kk', 'iuran.kk_id', '=', 'kk.kk_id')
                ->join('periode_iuran', 'iuran.periode_id', '=', 'periode_iuran.periode_id')
                ->select([
                    'iuran.iuran_id',
                    'kk.nama_kepala_keluarga',
                    'kk.rt_rw',
                    'iuran.tgl_pembayaran',
                    'periode_iuran.bulan as periode_bulan',
                    'periode_iuran.tahun as periode_tahun'
                ])
                ->where('iuran.status_pembayaran', 'Diproses');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('periode_awal', function ($row) {
                    return $row->periode_bulan . '/' . $row->periode_tahun;
                })
                ->addColumn('periode_akhir', function ($row) {
                    return $row->periode_bulan . '/' . $row->periode_tahun;
                })
                ->addColumn('aksi', function ($row) {
                    // $btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validasiIuran" data-iuran-id="' . $row->iuran_id . '">Validasi</button>';
                    $btn = '<a href="' . url('/bendahara/iuran/validasiDetail/' . $row->iuran_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function validasiDetail($id)
    {
        $iuran = IuranModel::join('kk', 'iuran.kk_id', '=', 'kk.kk_id')
            ->join('periode_iuran', 'iuran.periode_id', '=', 'periode_iuran.periode_id')
            ->select([
                'iuran.iuran_id',
                'kk.nama_kepala_keluarga',
                'kk.rt_rw',
                'iuran.tgl_pembayaran',
                'iuran.jumlah_bayar',  // Pastikan jumlah_bayar termasuk dalam pemilihan kolom
                'iuran.lampiran',      // Pastikan lampiran termasuk dalam pemilihan kolom
                'periode_iuran.bulan as periode_bulan',
                'periode_iuran.tahun as periode_tahun'
            ])
            ->where('iuran.iuran_id', $id)
            ->first();

        if (!$iuran) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $periode_awal = $iuran->periode_bulan . '/' . $iuran->periode_tahun;
        $periode_akhir = $iuran->periode_bulan . '/' . $iuran->periode_tahun;

        $breadcrumb = (object) [
            'title' => 'Data Iuran Warga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Iuran Warga', 'Detail']
        ];

        $activeMenu = 'iuran';

        return view('bendahara.iuran.validasi-detail', [
            'breadcrumb' => $breadcrumb,
            'iuran' => $iuran,
            'activeMenu' => $activeMenu
        ]);
    }

    public function validasiProses(Request $request, $id)
    {
        $iuran = IuranModel::find($id);
        if (!$iuran) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $iuran->status_pembayaran = 'Lunas';
        $iuran->save();

        return redirect()->route('bendahara.iuran.validasi', $id)->with('success', 'Iuran berhasil divalidasi');
    }
}
