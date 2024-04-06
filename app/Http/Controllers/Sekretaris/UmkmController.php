<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar UMKM',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM']
        ];
        $page = (object)[
            'title' => 'Daftar UMKM yang terdaftar dalam sistem'
        ];
        $activeMenu = 'umkm';   //set menu yg sdg aktif

        $umkm = UmkmModel::all();
        $warga = WargaModel::all();

        return view('sekretaris.umkm.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $umkms = UmkmModel::select('umkm_id', 'warga_id', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'status_usaha', 'deskripsi', 'lampiran');

        if ($request->jenis_usaha) {
            $umkms->where('jenis_usaha', $request->jenis_usaha);
        }

        return DataTables::of($umkms)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($umkm) {
                $btn = '<a href="' . url('/umkm/' . $umkm->umkm_id) . '" class="btn btn-info btn-sm">Lihat Detail</a>  &nbsp;';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function show(string $id)
    {
        $umkm = UmkmModel::with('warga')->find($id);
        $warga = WargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Data UMKM',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM', 'Detail']
        ];

        $activeMenu = 'umkm';

        return view('sekretaris.umkm.show', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'umkm' => $umkm, 'activeMenu' => $activeMenu]);
    }
}
