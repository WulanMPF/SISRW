<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\PenerimaBansosModel;
use App\Models\KkModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penerima Bantuan Sosial RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Penerima Bantuan Sosial']
        ];

        $activeMenu = 'bansos';

        $bansos = PenerimaBansosModel::all();
        $warga = WargaModel::all();

        return view('ketua.bansos.index', ['breadcrumb' => $breadcrumb, 'bansos' => $bansos, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $bansoss = PenerimaBansosModel::select('bansos_id', 'kk_id', 'jenis_bansos')
            ->with('kk');


        if ($request->jenis_bansos) {
            $bansoss->where('jenis_bansos', $request->jenis_bansos);
        }

        return DataTables::of($bansoss)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($bansos) {
                $btn = '<a href="' . url('/ketua/bansos/' . $bansos->bansos_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
                return $btn;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Data Penerima Bansos',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Penerima Bansos', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Data Penerima Bansos'
        ];

        $kk = KkModel::all(); // ambil data kk untuk ditampilkan di form
        $activeMenu = 'bansos'; //set menu yang sedang aktif

        return view('ketua.bansos.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kk_id'         => 'required|integer',
            'jenis_bansos'  => 'required|string|max:25'
        ]);
        PenerimaBansosModel::create([
            'kk_id'           => $request->kk_id,
            'jenis_bansos'    => $request->jenis_bansos
        ]);

        return redirect('/ketua/bansos')->with('success', 'Data barang berhasil disimpan');
    }
    public function show(string $id)
    {
        $bansos = PenerimaBansosModel::with('kk')->find($id);
        $warga = WargaModel::where('kk_id', $bansos->kk_id)->get();
        // $warga = WargaModel::with('kk')->find($id);
        $kk = KkModel::all();

        $breadcrumb = (object)[
            'title' => 'Detail Penerima Bansos',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Bansos', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Penerima Bansos'
        ];

        $activeMenu = 'bansos';

        return view('ketua.bansos.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'kk' => $kk, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $bansos = PenerimaBansosModel::find($id);
        $kk = KkModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Penerima Bansos',
            'list' => ['Home', 'Bansos', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Penerima Bansos'
        ];

        $activeMenu = 'bansos';

        return view('ketua.bansos.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kk_id'         => 'required|integer',
            'jenis_bansos'  => 'required|string|max:25',
        ]);
        PenerimaBansosModel::find($id)->update([
            'kk_id'         => $request->kk_id,
            'jenis_bansos'  => $request->jenis_bansos
        ]);

        return redirect('/ketua/bansos')->with('success', 'Data penerima bansos berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = PenerimaBansosModel::find($id);
        if (!$check) {
            return redirect('/ketua/bansos')->with('error', 'Data penerima bansos tidak ditemukan');
        }

        try {
            WargaModel::destroy($id);

            return redirect('/ketua/bansos')->with('success', 'Data penerima bansos berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/bansos')->with('error', 'Data penerima bansos gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
