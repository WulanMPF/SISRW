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
        $pengaduan = PengaduanModel::join('warga', 'warga.warga_id', '=', 'pengaduan.warga_id')
            ->select([
                'pengaduan.*',
                'warga.nama_warga as nama_pelapor',
            ]);

        if ($request->status_pengaduan) {
            $pengaduan->where('status_pengaduan', $request->status_pengaduan);
        }

        $pengaduan->orderBy('tgl_pengaduan', 'desc');

        return DataTables::of($pengaduan)
            ->addIndexColumn()
            ->addColumn('prioritas', function ($row) {
                $color = '';
                if ($row->prioritas == 'Tinggi') {
                    $color = 'text-danger'; // Merah
                } elseif ($row->prioritas == 'Sedang') {
                    $color = 'text-yellow-brown'; // Kuning sedikit coklat
                } elseif ($row->prioritas == 'Rendah') {
                    $color = 'text-success'; // Hijau
                }
                return '<span class="' . $color . '">' . $row->prioritas . '</span>';
            })
            ->addColumn('action', function ($row) {
                $showUrl = route('ketua.pengaduan.show', $row->pengaduan_id);
                $editUrl = url('/ketua/pengaduan/' . $row->pengaduan_id . '/edit');

                $btn = '<a href="' . $showUrl . '" class="btn btn-xs btn-primary" style="border-radius: 6px;"><i class="fas fa-info-circle fa-lg"></i></a>';

                if ($row->status_pengaduan == 'Diproses' || $row->status_pengaduan == 'Ditunda') {
                    $btn = '<a href="' . $editUrl . '" class="btn btn-xs btn-warning mr-2" style="border-radius: 6px;"><i class="fas fa-edit fa-lg"></i></a>' . $btn;
                }

                return $btn;
            })
            ->rawColumns(['prioritas', 'action'])
            ->make(true);
    }


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

    public function edit(string $id)
    {
        $pengaduan = PengaduanModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Pengaduan',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Pengaduan'
        ];

        $activeMenu = 'pengaduan';

        return view('ketua.pengaduan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'pengaduan' => $pengaduan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tindakan_diambil' => 'required|string|max:200',
            'status_pengaduan' => 'required|string|in:Diproses,Ditunda,Selesai'
        ]);

        $pengaduan = PengaduanModel::find($id);
        $pengaduan->update([
            'tindakan_diambil' => $request->tindakan_diambil,
            'status_pengaduan' => $request->status_pengaduan,
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Data pengaduan berhasil diupdate');
    }
}
