<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KkModel;
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

        return view('ketua.iuran.index', compact('breadcrumb', 'iurans', 'kk',  'activeMenu'));
    }

    public function list(Request $request)
    {
        $iurans = IuranModel::select('kk_id', 'tgl_pembayaran', 'jenis_iuran', 'status_pembayaran')
            ->with('kk')
            ->get()
            ->groupBy('kk_id');

        $data = [];
        foreach ($iurans as $kk_id => $iuranGroup) {
            $iuranSampah = $iuranGroup->where('jenis_iuran', 'sampah')->first();
            $iuranKeamanan = $iuranGroup->where('jenis_iuran', 'keamanan')->first();
            $iuranBulanan = $iuranGroup->where('jenis_iuran', 'bulanan')->first();

            $data[] = [
                'DT_RowIndex' => $kk_id,
                'tgl_pembayaran' => optional($iuranGroup->first())->tgl_pembayaran,
                'kk_no_kk' => optional($iuranGroup->first()->kk)->no_kk,
                'iuran_sampah' => optional($iuranSampah)->status_pembayaran ?? 'Belum Lunas',
                'iuran_keamanan' => optional($iuranKeamanan)->status_pembayaran ?? 'Belum Lunas',
                'iuran_bulanan' => optional($iuranBulanan)->status_pembayaran ?? 'Belum Lunas',
            ];
        }

        return DataTables::of(collect($data))
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn = '<a href="' . url('/iuran/' . $row['DT_RowIndex']) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
