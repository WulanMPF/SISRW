<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\UmkmModel;
use App\Models\KkModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Warga',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        // Initialize the necessary data from models
        $kegiatan = KegiatanModel::orderBy('tanggal', 'desc')->take(5)->get();
        $umkm = UmkmModel::orderBy('created_at', 'desc')->take(5)->get();
        $jumlah_kk = KkModel::count(); // This assumes you have a KkModel and you want to count all records
        $jumlah_umkm = UmkmModel::count(); // This assumes you have a KkModel and you want to count all records
        $jumlah_warga =WargaModel::count(); // This assumes you have a KkModel and you want to count all records

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
