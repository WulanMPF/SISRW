<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KkModel;
use App\Models\LapkeuModel;
use App\Models\LaporanKeuanganModel;
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
        // $laporanKeuangan = LaporanKeuanganModel::all();

        return view('bendahara.iuran.index', compact('breadcrumb', 'iurans', 'kk',  'activeMenu'));
    }

    public function list(Request $request)
    {
        $iurans = IuranModel::select('iuran_id', 'kk_id', 'tgl_pembayaran', 'jenis_iuran', 'jumlah_bayar', 'status_pembayaran');

        if ($request->jenis_iuran) {
            $iurans->where('jenis_iuran', $request->jenis_iuran);
        }

        return DataTables::of($iurans)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($iuran) {
                $btn = '<a href="' . url('/iuran/' . $iuran->iuran_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function detail($bulan)
    {
        $breadcrumb = (object) [
            'title' => 'Data Pembayaran Iuran RW 05 Bulan',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Pembayaran Iuran']
        ];

        $activeMenu = 'iuran';

        // Ambil nilai bulan dari URL
        $bulan = request()->input('bulan');

        $iurans = IuranModel::all();
        $kk = KkModel::all();
        return view('bendahara.iuran.detail', compact('breadcrumb', 'iurans', 'kk', 'bulan', 'activeMenu'));
    }
}
