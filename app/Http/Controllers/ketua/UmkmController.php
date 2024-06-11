<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Carbon\CarbonPeriod;
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

        return view('ketua.umkm.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $umkms = UmkmModel::select('umkm_id', 'warga_id', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'status_usaha', 'deskripsi', 'lampiran');

        if ($request->jenis_usaha) {
            $umkms->where('jenis_usaha', $request->jenis_usaha);
        }

        if ($request->status_usaha) {
            $umkms->where('status_usaha', $request->status_usaha);
        }

        return DataTables::of($umkms)
            ->addIndexColumn()
            ->addColumn('aksi', function ($umkm) {
                $status_usaha = strtolower($umkm->status_usaha);
                $btn = '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id) . '" class="btn btn-sm"><i class="fas fa-eye" style="color: #BB955C; font-size: 17px;"></i></a>';
                if ($status_usaha == 'aktif') {
                    $btn .= '<div class="btn-group mr-2">';
                    $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id . '/edit') . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff;" font-size: 17px;></i></a>';
                    $btn .= '<button type="button" class="btn btn-sm delete-btn" data-toggle="modal" data-target="#deactiveUMKM" data-umkm-id="' . $umkm->umkm_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';
                    $btn .= '</div>';
                } elseif ($status_usaha == 'diproses') {
                    $btn .= '<div class="btn-group mr-2">';
                    $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id . '/accept') . '" class="btn btn-sm" style="border-radius: 6px;"><i class="fas fa-check fa-lg" style="color: #28a745; font-size: 17px;"></i></a>';
                    $btn .= '<a href="' . url('/ketua/umkm/' . $umkm->umkm_id . '/reject') . '" class="btn btn-sm"><i class="fas fa-times fa-lg" style="color: #dc3545;" font-size: 17px;></i></a>';
                    $btn .= '</div>';
                }
                return $btn;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Method untuk mengubah status UMKM menjadi aktif
    public function acceptUmkm($umkm_id)
    {
        try {
            $umkm = UmkmModel::findOrFail($umkm_id);
            $umkm->status_usaha = 'aktif';
            $umkm->save();

            return redirect()->route('umkm.index')->with('success', 'UMKM berhasil diaktifkan');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->route('umkm.index')->with('error', 'Data UMKM tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->route('umkm.index')->with('error', 'Terjadi kesalahan saat mengaktifkan UMKM');
        }
    }

    // Method untuk mengubah status UMKM menjadi nonaktif
    public function rejectUmkm($umkm_id)
    {
        try {
            $umkm = UmkmModel::findOrFail($umkm_id);
            $umkm->status_usaha = 'nonaktif';
            $umkm->save();

            return redirect()->route('umkm.index')->with('success', 'UMKM berhasil dinonaktifkan');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->route('umkm.index')->with('error', 'Data UMKM tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->route('umkm.index')->with('error', 'Terjadi kesalahan saat menonaktifkan UMKM');
        }
    }

    public function create()
    {
        $times = [];
        $periods = CarbonPeriod::create('00:00', '30 minutes', '23:59');

        foreach ($periods as $period) {
            $times[] = $period->format('H:i');
        }

        $breadcrumb = (object) [
            'title' => 'Formulir Pengajuan UMKM RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM', 'Pengajuan']
        ];
        $page = (object)[
            'title' => 'Ajukan UMKM RW 05'
        ];

        $warga = WargaModel::all();
        $activeMenu = 'umkm'; //set menu yang sedang aktif

        return view('ketua.umkm.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'warga' => $warga, 'times' => $times, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'nik'          => 'required|string|max:16',
            'nama_usaha'   => 'required|string|max:200',
            'alamat_usaha' => 'required|string|max:200',
            'jenis_usaha'  => 'required|string|max:200',
            'jam_buka'     => 'required|date_format:H:i',
            'jam_tutup'    => 'required|date_format:H:i',
            'no_telepon'   => 'required|string|max:20',
            'status_usaha' => 'required',
            'deskripsi'    => 'required|string|max:65535',
            'lampiran'     => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        // Find the warga_id by the inputted nik
        $warga = WargaModel::where('nik', $request->nik)->first();

        if (!$warga) {
            return redirect()->back()->with('error', 'NIK tidak ditemukan.');
        }

        $warga_id = $warga->warga_id;

        // Get the random file name using hashName()
        $namaFile = $request->file('lampiran')->hashName();

        // Create a new UMKM entry in the database
        UmkmModel::create([
            'warga_id'     => $warga_id,
            'nama_usaha'   => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha'  => $request->jenis_usaha,
            'jam_buka'     => $request->jam_buka,
            'jam_tutup'    => $request->jam_tutup,
            'no_telepon'   => $request->no_telepon,
            'status_usaha' => $request->status_usaha,
            'deskripsi'    => $request->deskripsi,
            'lampiran'     => $namaFile
        ]);

        // Save the image to the directory lampiran_umkm with the generated hash name
        $path = $request->file('lampiran')->move('lampiran_umkm', $namaFile);
        $path = str_replace("\\", "//", $path);

        return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil ditambahkan');
    }


    public function show(string $id)
    {
        $umkm = UmkmModel::with('warga')->find($id);
        $warga = WargaModel::with('umkm')->find($id);

        $breadcrumb = (object) [
            'title' => 'Data UMKM',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data UMKM', 'Detail']
        ];

        $activeMenu = 'umkm';

        return view('ketua.umkm.show', ['breadcrumb' => $breadcrumb, 'warga' => $warga, 'umkm' => $umkm, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $umkm = UmkmModel::find($id);
        $warga = WargaModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Data UMKM RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'UMKM RW 05', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit UMKM RW 05'
        ];

        $activeMenu = 'umkm';

        return view('ketua.umkm.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'umkm' => $umkm, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'warga_id'    => 'nullable|integer',
            'nama_usaha'  => 'required|string|max:200',
            'alamat_usaha' => 'required|string|max:200',
            'jenis_usaha' => 'required|string|max:200',
            'status_usaha' => 'required',
            'deskripsi' => 'required|string|max:65535',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        if ($request->lampiran) {
            $namaFile = $request->file('lampiran')->hashName();
            $path = $request->file('lampiran')->move('lampiran_umkm', $namaFile);
            $path = str_replace("\\", "//", $path);
        }

        UmkmModel::find($id)->update([
            'warga_id'    => $request->warga_id,
            'nama_usaha'  => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'status_usaha' => $request->status_usaha,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $request->file('lampiran') ? $namaFile : basename(UmkmModel::find($id)->lampiran)
        ]);

        return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil diupdate');
    }


    public function deactive(string $umkm_id)
    {
        $umkm = UmkmModel::find($umkm_id);
        if (!$umkm) {
            return redirect('/ketua/umkm')->with('error', 'Data UMKM tidak ditemukan');
        }
        try {
            // Ubah status UMKM menjadi 'nonaktif'
            $umkm->update(['status_usaha' => 'Nonaktif']);

            return redirect('/ketua/umkm')->with('success', 'Data UMKM berhasil dinonaktifkan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/umkm')->with('error', 'Gagal menonaktifkan data UMKM');
        }
    }
}
