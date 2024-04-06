<?php

namespace App\Http\Controllers\Ketua;

use App\DataTables\WargaDataTable;
use App\Http\Controllers\Controller;
use App\Models\KkModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WargaDataTable $dataTable)
    {
        $breadcrumb = (object) [];

        $activeMenu = 'warga';

        $kk = KkModel::all();

        return view('ketua.warga.index', ['breadcrumb' => $breadcrumb, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $warga = WargaModel::select(
            'kk_id', 'nik', 'nama_warga', 'tempat_tanggal_lahir', 'jenis_kelamin', 
            'rt_rw', 'kel_desa', 'kecamatan', 'agama', 'status_perkawinan', 
            'pekerjaan', 'hubungan_keluarga'
            )
            ->with('kk');

        if ($request->kk_id) {
            $warga->where('kk_id', $request->kk_id);
        }

        return DataTables::of($warga)
            ->addIndexColumn() 
            ->addColumn('Anggota Keluarga', function ($warga) { 
                $btn = '<a href="' . url('/warga/' . $warga->warga_id) . '" class="btn btn-info btn-sm">Lihat</a> ';
                    
                return $btn;
            })
            ->rawColumns(['Anggota Keluarga']) 
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [];

        $kk = KkModel::all();

        $activeMenu = 'warga'; 

        return view('ketua.warga.index', ['breadcrumb' => $breadcrumb, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk_id'                   => 'required|integer',
            'nik'                     => 'required|integer|unique:warga,nik',
            'nama_warga'              => 'required|string|max:100', 
            'tempat_tanggal_lahir'    => 'required|string|max:100',
            'jenis_kelamin'           => 'required|in:L,P',
            'rt_rw'                   => 'required|string|max:10',
            'kel_desa'                => 'required|string|max:50',
            'kecamatan'               => 'required|string|max:50',
            'agama'                   => 'required|string|max:20',
            'status_perkawinan'       => 'required|string|max:50',
            'pekerjaan'               => 'required|string|max:50',
            'hubungan_keluarga'       => 'required|string|max:100',
        ]);

        BarangModel::create([
            'kk_id'                   => $request->kk_id,
            'nik'                     => $request->nik,
            'nama_warga'              => $request->nama_warga,
            'tempat_tanggal_lahir'    => $request->tempat_tanggal_lahir,
            'jenis_kelamin'           => $request->jenis_kelamin,
            'rt_rw'                   => $request->rt_rw,
            'kel_desa'                => $request->kel_desa,
            'kecamatan'               => $request->kecamatan,
            'agama'                   => $request->agama,
            'status_perkawinan'       => $request->status_perkawinan,
            'pekerjaan'               => $request->pekerjaan,
            'hubungan_keluarga'       => $request->hubungan_keluarga
        ]);

        return redirect('/ketua/warga')->with('success', 'Data warga berhasil disimpan');
    }

    public function show(string $id)
    {
        $warga = WargaModel::with('kk')->find($id);

        $breadcrumb = (object) [];

        $activeMenu = 'warga';

        return view('ketua.warga.show', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $warga = WargaModel::find($id);
        $kk = KkModel::all();

        $breadcrumb = (object) [];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id'   => 'required|',
            'barang_kode'   => 'required|string|min:3',
            'barang_nama'   => 'required|string|max:100', 
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer'
        ]);

        BarangModel::find($id)->update([
            'kategori_id'   => $request->kategori_id,
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama, 
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) { 
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id); 

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
}
