<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KkModel;
use App\Models\WargaModel;
use App\Models\LaporanKeuanganModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        // $laporanKeuangan = LaporanKeuanganModel::all();

        return view('warga.iuran.index', compact('breadcrumb', 'iurans', 'kk',  'activeMenu'));
    }

    public function list(Request $request)
    {
        // Dapatkan warga_id dari sesi pengguna yang login
        $warga_id = auth()->user()->warga_id;

        // Dapatkan kk_id yang sesuai dengan warga yang sedang login
        $kk_id = WargaModel::where('warga_id', $warga_id)->value('kk_id');

        // Ambil data iuran berdasarkan kk_id
        $iurans = IuranModel::select('iuran_id', 'kk_id', 'tgl_pembayaran', 'jumlah_bayar', 'status_pembayaran', 'periode_iuran.bulan', 'periode_iuran.tahun')
            ->leftJoin('periode_iuran', 'iuran.periode_id', '=', 'periode_iuran.periode_id')
            ->where('kk_id', $kk_id);

        return DataTables::of($iurans)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            // ->addColumn('aksi', function ($iuran) {
            //     $btn = '<a href="' . url('warga/iuran/detail/' . $iuran->iuran_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
            //     return $btn;
            // })
            // ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'start_month' => 'required|integer|min:1|max:12',
            'start_year' => 'required|integer',
            'end_month' => 'required|integer|min:1|max:12',
            'end_year' => 'required|integer',
            'file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        // Dapatkan warga_id dari sesi pengguna yang login
        $warga_id = auth()->user()->warga_id;

        // Dapatkan kk_id yang sesuai dengan warga yang sedang login
        $kk_id = WargaModel::where('warga_id', $warga_id)->value('kk_id');

        $namaFile = $request->file('file')->hashName();

        // Hitung total bulan
        $start = Carbon::create($request->start_year, $request->start_month, 1);
        $end = Carbon::create($request->end_year, $request->end_month, 1);

        if ($end->lessThan($start)) {
            return back()->with('error', 'Tanggal akhir harus setelah tanggal mulai');
        }

        $totalMonths = $end->diffInMonths($start) + 1;
        $jumlah_bayar = $totalMonths * 55000;

        // Ambil periode_id untuk setiap bulan dalam rentang waktu yang dipilih
        $periodeIds = [];
        for ($date = $start; $date->lessThanOrEqualTo($end); $date->addMonth()) {
            $periode = DB::table('periode_iuran')
                ->where('tahun', $date->year)
                ->where('bulan', $date->month)
                ->first();

            if ($periode) {
                $periodeIds[] = $periode->periode_id;
            }
        }

        if (empty($periodeIds)) {
            return back()->with('error', 'Tidak ada periode yang ditemukan untuk rentang waktu yang dipilih');
        }

        // Periksa apakah pembayaran untuk kk_id pada periode tersebut sudah lunas
        foreach ($periodeIds as $periodeId) {
            $existingPayment = DB::table('iuran')
                ->where('kk_id', $kk_id)
                ->where('periode_id', $periodeId)
                ->where('status_pembayaran', 'Lunas')
                ->first();

            if ($existingPayment) {
                return back()->with('error', 'Pembayaran untuk periode ini sudah dilakukan.');
            }
        }

        // Simpan data ke database
        foreach ($periodeIds as $periodeId) {
            IuranModel::create([
                'periode_id' => $periodeId,
                'kk_id' => $kk_id,
                'laporan_id' => null,
                'tgl_pembayaran' => Carbon::now(), // Tanggal pembayaran otomatis diisi dengan tanggal saat ini
                'jumlah_bayar' => 55000, // Jumlah bayar per bulan
                'status_pembayaran' => 'Diproses',
                'lampiran' => $namaFile,
            ]);
        }

        $path = $request->file('file')->move('lampiran_pembayaran', $namaFile);
        $path = str_replace("\\", "//", $path);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('warga.iuran.index')->with('success', 'Pembayaran iuran berhasil dilakukan.');
    }
}
