<?php

namespace App\Http\Controllers\Bendahara;

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

        return view('bendahara.laporan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'laporan' => $laporan, 'activeMenu' => $activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $laporans = LapkeuModel::select('laporan_id', 'nominal', 'keterangan', 'jenis_laporan', 'tgl_laporan');

        if ($request->has('jenis_laporan') && $request->jenis_laporan != '') {
            $laporans->where('jenis_laporan', $request->jenis_laporan);
        }

        return DataTables::of($laporans)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('pemasukan', function ($laporan) {
                return $laporan->jenis_laporan == 'pemasukan' ? $laporan->nominal : 0;
            })
            ->addColumn('pengeluaran', function ($laporan) {
                return $laporan->jenis_laporan == 'pengeluaran' ? $laporan->nominal : 0;
            })
            ->addColumn('aksi', function ($laporan) {
                $btn = '<a href="' . url('/bendahara/laporan/' . $laporan->laporan_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                $btn .= '<a href="' . url('/bendahara/laporan/' . $laporan->laporan_id . '/edit') . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff;" font-size: 17px;></i></a>';
                $btn .= '<button type="button" class="btn btn-sm" onclick="showConfirmationModal(' . $laporan->laporan_id . ')"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';

                // delete default -- localhost
                /* $btn .= '<form class="d-inline-block" method="POST" action="' . url('/bendahara/laporan/' . $laporan->laporan_id) . '">'
                 . csrf_field() . method_field('DELETE') .
                 '<button type="submit" class="btn btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button></form>'; */

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Formulir Pelaporan Keuangan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Laporan Keuangan', 'Laporkan']
        ];
        $page = (object)[
            'title' => 'Pelaporan Keuangan RW 05'
        ];

        $laporan = LapkeuModel::all();
        $activeMenu = 'laporan'; //set menu yang sedang aktif

        return view('bendahara.laporan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'laporan' => $laporan, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nominal'    => 'required|integer',
            'keterangan'  => 'required|string|max:200',
            'jenis_laporan' => 'required|string|max:50',
            'tgl_laporan' => 'required|date',
        ]);

        LapkeuModel::create([
            'nominal'    => $request->nominal,
            'keterangan'  => $request->keterangan,
            'jenis_laporan' => $request->jenis_laporan,
            'tgl_laporan' => $request->tgl_laporan,
        ]);

        return redirect('/bendahara/laporan')->with('success', 'Pelaporan keuangan RW 05 berhasil ditambahkan');
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

        return view('bendahara.laporan.show', ['breadcrumb' => $breadcrumb, 'laporan' => $laporan, 'activeMenu' => $activeMenu]);
    }
    public function destroy(string $id)
    {
        $check = LapkeuModel::find($id);
        if (!$check) {
            return redirect('/bendahara/laporan')->with('error', 'Data UMKM Warga 05 tidak ditemukan');
        }
        try {
            LapkeuModel::destroy($id);
            return redirect('/bendahara/laporan')->with('success', 'Pelaporan keuangan RW 05 berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/bendahara/laporan')->with('error', 'Data Pelaporan keuangan RW 05 gagal dihapus');
        }
    }
}
