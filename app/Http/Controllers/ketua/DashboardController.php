<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\KkModel;
use App\Models\PenerimaBansosModel;
use App\Models\PengaduanModel;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Ketua RW',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        $jumlah_penerima_bansos = PenerimaBansosModel::count();
        $jumlah_pengaduan = PengaduanModel::count();
        $jumlah_kk = KkModel::count();
        $jumlah_umkm = UmkmModel::count();
        $jumlah_warga = WargaModel::count();

        $activeMenu = 'dashboard';

        return view('ketua.dashboard', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jumlah_penerima_bansos' => $jumlah_penerima_bansos,
            'jumlah_pengaduan' => $jumlah_pengaduan,
            'jumlah_kk' => $jumlah_kk,
            'jumlah_umkm' => $jumlah_umkm,
            'jumlah_warga' => $jumlah_warga
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
