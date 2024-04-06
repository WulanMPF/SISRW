<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengaduanController extends Controller
{
    /**
     * Menampilkan halaman index pengaduan.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengaduan',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan']
        ];

        $activeMenu = 'pengaduan';

        return view('ketua.pengaduan.index', compact('breadcrumb', 'activeMenu'));
    }

    /**
     * Menampilkan data pengaduan dalam format JSON untuk DataTables.
     */
    public function list(Request $request)
    {
        $pengaduan = PengaduanModel::query();

        return DataTables::of($pengaduan)
            ->addColumn('action', function ($row) {
                return '<a href="' . route('pengaduan.show', $row->id) . '" class="btn btn-info btn-sm">Detail</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Menampilkan halaman detail pengaduan.
     */
    public function show($id)
    {
        $pengaduan = PengaduanModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Pengaduan',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan', 'Detail']
        ];

        $activeMenu = 'pengaduan';

        return view('ketua.pengaduan.show', compact('breadcrumb', 'activeMenu', 'pengaduan'));
    }
}
