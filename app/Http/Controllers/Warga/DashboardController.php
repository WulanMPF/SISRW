<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\UmkmModel;
use App\Models\KkModel;
use App\Models\WargaModel;
use App\Charts\WargaChart;
use App\Charts\AgamaChart;
use App\Charts\PekerjaanChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(WargaChart $wargaChart, AgamaChart $AgamaChart, PekerjaanChart $PekerjaanChart)
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        $namaWarga = $user->warga->nama_warga; // Mengambil nama warga dari relasi user

        $breadcrumb = (object) [
            'title' => "Selamat Datang, $namaWarga",
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        // Initialize the necessary data from models
        $kegiatan = KegiatanModel::orderBy('tanggal', 'asc')->take(5)->get();
        $umkm = UmkmModel::orderBy('created_at', 'asc')->take(5)->get();
        $jumlah_kk = KkModel::count();
        $jumlah_umkm = UmkmModel::count();
        $jumlah_warga = WargaModel::count();

        // It seems there was an incorrect opening parenthesis here
        $activeMenu = 'dashboard';

        // Return the view with all necessary data
        return view('warga.dashboard', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'kegiatan' => $kegiatan,
            'umkm' => $umkm,
            'jumlah_kk' => $jumlah_kk,
            'jumlah_umkm' => $jumlah_umkm,
            'jumlah_warga' => $jumlah_warga,
            'wargaChart' => $wargaChart->build(),
            'AgamaChart' => $AgamaChart->build(),
            'PekerjaanChart' => $PekerjaanChart->build()
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
