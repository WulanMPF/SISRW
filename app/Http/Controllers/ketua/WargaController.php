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

        $activeMenu = 'kk';

        $warga = WargaModel::all();
        $kk = KkModel::all();

        return view('ketua.warga.index', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function indexSementara(WargaDataTable $dataTable)
    {
        $warga = WargaModel::where('status_warga', 'sementara')->get();

        $breadcrumb = (object) [
            'title' => 'Data Warga RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga']
        ];

        $activeMenu = 'warga';

        return view('ketua.warga.index-sementara', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $kk = kkModel::select(
            'kk_id',
            'no_kk',
            'nama_kepala_keluarga',
            'rt_rw',
            'alamat'
        );

        if ($request->kk_id) {
            $kk->where('kk_id', $request->kk_id);
        }

        $kkData = $kk->get();

        return DataTables::of($kkData)
            ->addIndexColumn()
            ->addColumn('Anggota Keluarga', function ($kk) {
                $btn = '<a href="' . url('/ketua/warga/' . $kk->kk_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white;">Lihat</a> ';
                return $btn;
            })
            ->rawColumns(['Anggota Keluarga'])
            ->make(true);
    }

    public function listSementara(Request $request)
    {
        // Mengambil data warga dengan status sementara dan kk_id bernilai null
        $warga = WargaModel::where('status_warga', 'sementara')
            ->whereNull('kk_id')
            ->select(
                'warga_id',  // Pastikan 'id' atau primary key dari tabel warga disertakan untuk kebutuhan aksi edit/hapus
                'nik',
                'nama_warga',
                'hubungan_keluarga',
                'tempat_tgl_lahir',
                'jenis_kelamin',
                'rt_rw',
                'kel_desa',
                'kecamatan',
                'agama',
                'status_perkawinan',
                'pekerjaan'
            )
            ->get();

        // Mengembalikan data dalam bentuk DataTables
        return DataTables::of($warga)
            ->addIndexColumn()
            ->addColumn('Aksi', function ($warga) {
                // Periksa jika kk_id adalah null, maka URL edit akan memiliki nilai null untuk kk_id
                $kk_id = is_null($warga->kk_id) ? 'null' : $warga->kk_id;
                $showBtn = '<a href="' . url('/ketua/warga/show/' . $warga->warga_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                $editBtn = '<a href="' . url('/ketua/warga/edit-warga/' . $kk_id . '/' . $warga->warga_id) . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff;" font-size: 17px;></i></a>';
                // $deleteBtn = '<form class="d-inline-block" method="POST" action="' . url('ketua/warga/destroy-wargaSementara/' . $warga->warga_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button></form>'; // Red color for delete
                $deleteBtn = '<button class="btn btn-sm delete-btn" data-toggle="modal" data-target="#confirmDeleteModal" data-id="' . $warga->warga_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';
                return $showBtn . $editBtn . $deleteBtn;
            })
            ->rawColumns(['Aksi'])
            ->make(true);
    }


    public function createKK()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Warga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Tambah Warga Tetap']
        ];

        $kk = KkModel::all();

        $activeMenu = 'warga';

        return view('ketua.warga.create-tetap-kk', ['breadcrumb' => $breadcrumb, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function createWarga($kk_id)
    {
        // Dapatkan data KK berdasarkan ID
        $kk = KkModel::findOrFail($kk_id);

        $breadcrumb = (object) [
            'title' => 'Tambah Data Warga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Tambah Warga Tetap']
        ];

        // Set session data
        session(['kk' => $kk]);

        $activeMenu = 'warga';

        return view('ketua.warga.create-tetap-warga', ['breadcrumb' => $breadcrumb, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }


    public function createSementara()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Warga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Tambah Warga Sementara']
        ];

        $kk = KkModel::all();

        $activeMenu = 'warga';

        return view('ketua.warga.create-sementara', ['breadcrumb' => $breadcrumb, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function storeKK(Request $request)
    {
        // Validasi input data KK
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'nama_kepala_keluarga' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:10',
        ]);

        // Simpan data KK
        $kk = KkModel::create([
            'no_kk' => $request->no_kk,
            'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
            'alamat' => $request->alamat,
            'rt_rw' => $request->rt_rw,
        ]);

        // Redirect ke halaman input data warga dengan membawa ID KK
        return redirect()->route('warga.create', ['kk_id' => $kk->kk_id]);
    }

    public function storeWarga(Request $request)
    {
        // Validasi input data warga
        $request->validate([
            'nik.*' => 'required|string|max:16',
            'nama_warga.*' => 'required|string|max:100',
            'hubungan_keluarga.*' => 'required|string|max:50',
            'tempat_tgl_lahir.*' => 'required|string|max:100',
            'jenis_kelamin.*' => 'required|string|max:10',
            'rt_rw.*' => 'required|string|max:10',
            'kel_desa.*' => 'required|string|max:100',
            'kecamatan.*' => 'required|string|max:100',
            'agama.*' => 'required|string|max:50',
            'status_perkawinan.*' => 'required|string|max:50',
            'pekerjaan.*' => 'required|string|max:100',
        ]);

        // Simpan data warga
        $wargaData = [];
        foreach ($request->nik as $index => $nik) {
            $wargaData[] = [
                'kk_id' => $request->kk_id,
                'nik' => $nik,
                'nama_warga' => $request->nama_warga[$index],
                'hubungan_keluarga' => $request->hubungan_keluarga[$index],
                'tempat_tgl_lahir' => $request->tempat_tgl_lahir[$index],
                'jenis_kelamin' => $request->jenis_kelamin[$index],
                'rt_rw' => $request->rt_rw_warga[$index],
                'kel_desa' => $request->kel_desa[$index],
                'kecamatan' => $request->kecamatan[$index],
                'agama' => $request->agama[$index],
                'status_perkawinan' => $request->status_perkawinan[$index],
                'pekerjaan' => $request->pekerjaan[$index],
                'status_warga' => 'menetap',
            ];
        }
        WargaModel::insert($wargaData);

        return redirect()->back()->with('success', 'Data warga berhasil ditambahkan.');
    }


    // public function storeTetap(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'no_kk' => 'required|string|max:20',
    //         'nama_kepala_keluarga' => 'required|string|max:100',
    //         'alamat' => 'required|string|max:255',
    //         'rt_rw' => 'required|string|max:10',
    //         'nik.*' => 'required|string|max:16',
    //         'nama_warga.*' => 'required|string|max:100',
    //         'hubungan_keluarga.*' => 'required|string|max:50',
    //         'tempat_tgl_lahir.*' => 'required|string|max:100',
    //         'jenis_kelamin.*' => 'required|string|max:10',
    //         'rt_rw_warga.*' => 'required|string|max:10',
    //         'kel_desa.*' => 'required|string|max:100',
    //         'kecamatan.*' => 'required|string|max:100',
    //         'agama.*' => 'required|string|max:50',
    //         'status_perkawinan.*' => 'required|string|max:50',
    //         'pekerjaan.*' => 'required|string|max:100',
    //     ]);

    //     // Simpan data KK dan Warga secara bersamaan
    //     $kk = KKModel::create([
    //         'no_kk' => $request->no_kk,
    //         'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
    //         'alamat' => $request->alamat,
    //         'rt_rw' => $request->rt_rw,
    //     ]);

    //     $wargaData = [];

    //     // Simpan data Warga
    //     foreach ($request->nik as $index => $nik) {
    //         $wargaData[] = [
    //             'kk_id' => $kk->id,
    //             'nik' => $nik,
    //             'nama_warga' => $request->nama_warga[$index],
    //             'hubungan_keluarga' => $request->hubungan_keluarga[$index],
    //             'tempat_tgl_lahir' => $request->tempat_tgl_lahir[$index],
    //             'jenis_kelamin' => $request->jenis_kelamin[$index],
    //             'rt_rw' => $request->rt_rw_warga[$index],
    //             'kel_desa' => $request->kel_desa[$index],
    //             'kecamatan' => $request->kecamatan[$index],
    //             'agama' => $request->agama[$index],
    //             'status_perkawinan' => $request->status_perkawinan[$index],
    //             'pekerjaan' => $request->pekerjaan[$index],
    //             'status_warga' => 'menetap',
    //         ];
    //     }
    //     WargaModel::insert($wargaData);

    //     return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    // }

    public function storeSementara(Request $request)
    {
        $request->validate([
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
        ]);

        WargaModel::create([
            'kk_id'                   => null,
            'nik'                     => $request->nik,
            'nama_warga'              => $request->nama_warga,
            'tempat_tgl_lahir'        => $request->tempat_tgl_lahir,
            'jenis_kelamin'           => $request->jenis_kelamin,
            'rt_rw'                   => $request->rt_rw,
            'kel_desa'                => $request->kel_desa,
            'kecamatan'               => $request->kecamatan,
            'agama'                   => $request->agama,
            'status_perkawinan'       => $request->status_perkawinan,
            'pekerjaan'               => $request->pekerjaan,
            'hubungan_keluarga'       => null,
            'status_warga'            => 'sementara'
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(string $kk_id)
    {
        $kepalaKeluarga = KKModel::findOrFail($kk_id);
        $anggotaKeluarga = WargaModel::where('kk_id', $kk_id)->get();

        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Anggota Keluarga']
        ];

        $activeMenu = 'warga';

        return view('ketua.warga.show', compact('breadcrumb', 'kepalaKeluarga', 'anggotaKeluarga', 'activeMenu'));
    }

    public function showSementara(string $warga_id)
    {
        $warga = WargaModel::where('warga_id', $warga_id)->get();

        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Anggota Keluarga']
        ];

        $activeMenu = 'warga';

        return view('ketua.warga.show-sementara', compact('breadcrumb', 'warga', 'activeMenu'));
    }


    public function editWarga($kk_id, $warga_id)
    {
        if ($kk_id === 'null') {
            // Jika $kk_id bernilai null, maka warga tidak terkait dengan sebuah KK
            // Maka Anda hanya perlu mengambil data warga berdasarkan $warga_id
            $warga = WargaModel::findOrFail($warga_id);
            $kk = null;

            // Selanjutnya, Anda bisa menyiapkan data yang diperlukan untuk view
            $breadcrumb = (object) [
                'title' => 'Anggota Keluarga',
                'date' => date('l, d F Y'),
                'list'  => ['Home', 'Data Warga', 'Anggota Keluarga', 'Edit']
            ];

            $activeMenu = 'warga';

            // Kembalikan view dengan data warga
            return view('ketua.warga.edit-warga', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'kk' => $kk, 'activeMenu' => $activeMenu]);
        } else {
            // Jika $kk_id tidak bernilai null, maka Anda bisa mengambil data KK dan warga berdasarkan $kk_id dan $warga_id
            $warga = WargaModel::findOrFail($warga_id);
            $kk = KkModel::findOrFail($kk_id);

            // Siapkan data yang diperlukan untuk view
            $breadcrumb = (object) [
                'title' => 'Anggota Keluarga',
                'date' => date('l, d F Y'),
                'list'  => ['Home', 'Data Warga', 'Anggota Keluarga', 'Edit']
            ];

            $activeMenu = 'warga';

            // Kembalikan view dengan data warga dan KK
            return view('ketua.warga.edit-warga', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'kk' => $kk, 'activeMenu' => $activeMenu]);
        }
    }

    public function editKK($kk_id)
    {
        $kk = KkModel::findOrFail($kk_id);


        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Warga', 'Kartu Keluarga', 'Edit']
        ];

        $activeMenu = 'warga';

        return view('ketua.warga.edit-kk', ['breadcrumb' => $breadcrumb, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function updateWarga(Request $request)
    {
        // Validasi data inputan
        $validatedData = $request->validate([
            // Atur aturan validasi sesuai kebutuhan
            'nik.*' => 'required',
            'nama_warga.*' => 'required',
            'hubungan_keluarga.*' => 'required',
            'tempat_tgl_lahir.*' => 'required',
            'jenis_kelamin.*' => 'required',
            'rt_rw.*' => 'required',
            'kel_desa.*' => 'required',
            'kecamatan.*' => 'required',
            'agama.*' => 'required',
            'status_perkawinan.*' => 'required',
            'pekerjaan.*' => 'required',
        ]);

        // Mendapatkan kk_id dari form
        $kk_id = $request->input('kk_id');

        // Jika kk_id bernilai null
        if ($kk_id === null) {
            // Loop through the submitted data
            foreach ($request->nik as $key => $value) {
                // Update data warga sesuai dengan id warga
                WargaModel::where('warga_id', $request->warga_id[$key])->update([
                    'kk_id' => null, // Set kk_id menjadi null
                    'nik' => $request->nik[$key],
                    'nama_warga' => $request->nama_warga[$key],
                    'hubungan_keluarga' => null,
                    'tempat_tgl_lahir' => $request->tempat_tgl_lahir[$key],
                    'jenis_kelamin' => $request->jenis_kelamin[$key],
                    'rt_rw' => $request->rt_rw_warga[$key],
                    'kel_desa' => $request->kel_desa[$key],
                    'kecamatan' => $request->kecamatan[$key],
                    'agama' => $request->agama[$key],
                    'status_perkawinan' => $request->status_perkawinan[$key],
                    'pekerjaan' => $request->pekerjaan[$key],
                    'status_warga' => 'sementara',
                ]);
            }

            // Redirect ke index-sementara dengan pesan sukses
            return redirect()->route('warga.indexSementara')->with('success', 'Data warga berhasil diperbarui.');
        } else {
            // Jika kk_id tidak bernilai null
            // Loop through the submitted data
            foreach ($request->nik as $key => $value) {
                // Update data warga sesuai dengan id warga
                WargaModel::where('warga_id', $request->warga_id[$key])->update([
                    'kk_id' => $kk_id, // Set kk_id
                    'nik' => $request->nik[$key],
                    'nama_warga' => $request->nama_warga[$key],
                    'hubungan_keluarga' => $request->hubungan_keluarga[$key],
                    'tempat_tgl_lahir' => $request->tempat_tgl_lahir[$key],
                    'jenis_kelamin' => $request->jenis_kelamin[$key],
                    'rt_rw' => $request->rt_rw_warga[$key],
                    'kel_desa' => $request->kel_desa[$key],
                    'kecamatan' => $request->kecamatan[$key],
                    'agama' => $request->agama[$key],
                    'status_perkawinan' => $request->status_perkawinan[$key],
                    'pekerjaan' => $request->pekerjaan[$key],
                    'status_warga' => 'menetap',
                ]);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('warga.show', ['kk_id' => $kk_id])->with('success', 'Data warga berhasil diperbarui.');
        }
    }


    public function updateKK(Request $request, $kk_id)
    {
        // Validasi input data KK
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'nama_kepala_keluarga' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:10',
        ]);

        // Mendapatkan data KK berdasarkan ID
        $kk = KkModel::find($kk_id);
        if (!$kk) {
            return redirect()->route('kk.index')->with('error', 'Data KK tidak ditemukan');
        }

        try {
            // Update data KK
            $kk->update([
                'no_kk' => $request->no_kk,
                'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
                'alamat' => $request->alamat,
                'rt_rw' => $request->rt_rw,
            ]);

            // Redirect ke halaman detail KK atau halaman lain yang sesuai
            return redirect()->route('warga.show', ['kk_id' => $kk->kk_id])->with('success', 'Data KK berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('warga.index')->with('error', 'Data KK gagal diperbarui karena kesalahan sistem');
        }
    }


    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'kk_id'                   => 'required|',
    //         'nik'                     => 'required|integer|unique:warga,nik',
    //         'nama_warga'              => 'required|string|max:100',
    //         'tempat_tgl_lahir'        => 'required|string|max:100',
    //         'jenis_kelamin'           => 'required|in:L,P',
    //         'rt_rw'                   => 'required|string|max:10',
    //         'kel_desa'                => 'required|string|max:50',
    //         'kecamatan'               => 'required|string|max:50',
    //         'agama'                   => 'required|string|max:20',
    //         'status_perkawinan'       => 'required|string|max:50',
    //         'pekerjaan'               => 'required|string|max:50',
    //         'hubungan_keluarga'       => 'required|string|max:100',
    //     ]);

    //     WargaModel::find($id)->update([
    //         'kk_id'                   => $request->kk_id,
    //         'nik'                     => $request->nik,
    //         'nama_warga'              => $request->nama_warga,
    //         'tempat_tgl_lahir'        => $request->tempat_tanggal_lahir,
    //         'jenis_kelamin'           => $request->jenis_kelamin,
    //         'rt_rw'                   => $request->rt_rw,
    //         'kel_desa'                => $request->kel_desa,
    //         'kecamatan'               => $request->kecamatan,
    //         'agama'                   => $request->agama,
    //         'status_perkawinan'       => $request->status_perkawinan,
    //         'pekerjaan'               => $request->pekerjaan,
    //         'hubungan_keluarga'       => $request->hubungan_keluarga
    //     ]);

    //     return redirect('/ketua/warga.index')->with('success', 'Data warga berhasil diubah');
    // }

    public function destroyWarga(Request $request, $kk_id, $warga_id)
    {
        // Validasi data inputan
        $validatedData = $request->validate([
            'alasan_penghapusan' => 'required|in:pindah,meninggal',
        ]);

        try {
            // Mendapatkan warga berdasarkan ID
            $kk = KkModel::findOrFail($kk_id);
            $warga = WargaModel::findOrFail($warga_id);

            // Ubah status warga
            $warga->status_warga = $validatedData['alasan_penghapusan'];

            $warga->save();
            // Soft delete data warga
            $warga->delete();

            return redirect()->route('warga.show', ['kk_id' => $kk_id])->with('success', 'Data warga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('warga.show', ['kk_id' => $kk_id])->with('error', 'Data warga gagal dihapus karena kesalahan sistem');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->route('warga.show', ['kk_id' => $kk_id])->with('error', 'Data warga tidak ditemukan');
        }
    }

    public function destroyKK(Request $request, $kk_id)
    {
        try {
            // Mendapatkan KK berdasarkan ID
            $kk = KkModel::findOrFail($kk_id);

            // Mengambil semua warga dengan kk_id yang sesuai
            $warga = WargaModel::where('kk_id', $kk_id)->get();

            // Mengubah status warga menjadi 'pindah' untuk semua warga dengan kk_id yang sesuai
            foreach ($warga as $w) {
                $w->status_warga = 'pindah'; // Alasan penghapusan diatur menjadi 'pindah'
                $w->save();
                $w->delete();
            }

            // Soft delete data KK
            $kk->delete();

            return redirect()->route('warga.index')->with('success', 'Data KK dan warga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('warga.index')->with('error', 'Data KK dan warga gagal dihapus karena kesalahan sistem');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->route('warga.index')->with('error', 'Data KK tidak ditemukan');
        }
    }

    public function destroyWargaSementara(Request $request, $warga_id)
    {
        // Validasi data inputan
        $validatedData = $request->validate([
            'alasan_penghapusan' => 'required|in:pindah,meninggal',
        ]);

        try {
            // Mendapatkan warga berdasarkan ID
            $warga = WargaModel::findOrFail($warga_id);

            // Ubah status warga
            $warga->status_warga = $validatedData['alasan_penghapusan'];
            $warga->save();
            $warga->delete();

            return redirect()->route('warga.indexSementara')->with('success', 'Data warga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('warga.indexSementara')->with('error', 'Data warga gagal dihapus karena kesalahan sistem');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->route('warga.indexSementara')->with('error', 'Data warga tidak ditemukan');
        }
    }




    // public function destroy(string $id)
    // {
    //     $check = WargaModel::find($id);
    //     if (!$check) {
    //         return redirect('/ketua/warga.index')->with('error', 'Data warga tidak ditemukan');
    //     }

    //     try {
    //         WargaModel::destroy($id);

    //         return redirect('/ketua/warga.index')->with('success', 'Data warga berhasil dihapus');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         return redirect('/ketua/warga.index')->with('error', 'Data warga gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }
}
