<?php

namespace App\Http\Controllers\Ketua;

use App\DataTables\WargaDataTable;
use App\Http\Controllers\Controller;
use App\Models\KkModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WargaDataTable $dataTable)
    {
        $breadcrumb = (object) [
            'title' => 'Data Warga RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga']
        ];

        $activeMenu = 'warga';

        $warga = WargaModel::all();
        $kk = KkModel::all();

        return view('ketua.warga.index', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $warga = WargaModel::select(
            'kk_id',
            'nik',
            'nama_warga',
            'tempat_tgl_lahir',
            'jenis_kelamin',
            'rt_rw',
            'kel_desa',
            'kecamatan',
            'agama',
            'status_perkawinan',
            'pekerjaan',
            'hubungan_keluarga'
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
        $breadcrumb = (object) [
            'title' => 'Tambah Data Warga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Tambah']
        ];

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
            'tempat_tgl_lahir'        => 'required|string|max:100',
            'jenis_kelamin'           => 'required|in:L,P',
            'rt_rw'                   => 'required|string|max:10',
            'kel_desa'                => 'required|string|max:50',
            'kecamatan'               => 'required|string|max:50',
            'agama'                   => 'required|string|max:20',
            'status_perkawinan'       => 'required|string|max:50',
            'pekerjaan'               => 'required|string|max:50',
            'hubungan_keluarga'       => 'required|string|max:100',
        ]);

        WargaModel::create([
            'kk_id'                   => $request->kk_id,
            'nik'                     => $request->nik,
            'nama_warga'              => $request->nama_warga,
            'tempat_tgl_lahir'        => $request->tempat_tanggal_lahir,
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

        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Anggota Keluarga']
        ];

        $activeMenu = 'warga';

        return view('ketua.warga.show', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $warga = WargaModel::find($id);
        $kk = KkModel::all();

        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Anggota Keluarga', 'Edit']
        ];

        $activeMenu = 'warga';

        return view('ketua.warga.edit', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kk_id'                   => 'required|',
            'nik'                     => 'required|integer|unique:warga,nik',
            'nama_warga'              => 'required|string|max:100',
            'tempat_tgl_lahir'        => 'required|string|max:100',
            'jenis_kelamin'           => 'required|in:L,P',
            'rt_rw'                   => 'required|string|max:10',
            'kel_desa'                => 'required|string|max:50',
            'kecamatan'               => 'required|string|max:50',
            'agama'                   => 'required|string|max:20',
            'status_perkawinan'       => 'required|string|max:50',
            'pekerjaan'               => 'required|string|max:50',
            'hubungan_keluarga'       => 'required|string|max:100',
        ]);

        WargaModel::find($id)->update([
            'kk_id'                   => $request->kk_id,
            'nik'                     => $request->nik,
            'nama_warga'              => $request->nama_warga,
            'tempat_tgl_lahir'        => $request->tempat_tanggal_lahir,
            'jenis_kelamin'           => $request->jenis_kelamin,
            'rt_rw'                   => $request->rt_rw,
            'kel_desa'                => $request->kel_desa,
            'kecamatan'               => $request->kecamatan,
            'agama'                   => $request->agama,
            'status_perkawinan'       => $request->status_perkawinan,
            'pekerjaan'               => $request->pekerjaan,
            'hubungan_keluarga'       => $request->hubungan_keluarga
        ]);

        return redirect('/ketua/warga')->with('success', 'Data warga berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = WargaModel::find($id);
        if (!$check) {
            return redirect('/ketua/warga')->with('error', 'Data warga tidak ditemukan');
        }

        try {
            WargaModel::destroy($id);

            return redirect('/ketua/warga')->with('success', 'Data warga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/warga')->with('error', 'Data warga gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
