<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\KkModel;
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
        // $laporanKeuangan = LaporanKeuanganModel::all();

        return view('ketua.iuran.index', compact('breadcrumb', 'iurans', 'kk',  'activeMenu'));
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
                $btn = '<a href="' . url('/ketua/iuran/show/' . $periode->periode_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(Request $request, $id)
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


        return view('ketua.iuran.show', compact('breadcrumb', 'periode', 'kk', 'iuran', 'activeMenu'));
    }
}
