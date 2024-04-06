<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\LapkeuModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LapkeuController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Laporan Keuangan RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Laporan Keuangan']
        ];
        $page = (object)[
            'title' => 'Daftar laporan keuangan yang terdaftar dalam sistem'
        ];
        $activeMenu = 'laporan';   //set menu yg sdg aktif

        $laporan = LapkeuModel::all();

        return view('ketua.laporan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'laporan' => $laporan, 'activeMenu' => $activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $laporans = LapkeuModel::select('laporan_id', 'nominal', 'keterangan', 'jenis_laporan', 'tgl_laporan');

        if ($request->jenis_laporan) {
            $laporans->where('jenis_laporan', $request->jenis_laporan);
        }

        return DataTables::of($laporans)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($laporan) {
                $btn = '<a href="' . url('/laporan/' . $laporan->laporan_id) . '" class="btn btn-info btn-sm">Lihat Detail</a>  &nbsp;';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function show(string $id)
    {
        $laporan = LapkeuModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Data Laporan Keuangan',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Laporan Keuangan', 'Detail']
        ];

        $activeMenu = 'laporan';

        return view('ketua.laporan.show', ['breadcrumb' => $breadcrumb, 'laporan' => $laporan, 'activeMenu' => $activeMenu]);
    }
}