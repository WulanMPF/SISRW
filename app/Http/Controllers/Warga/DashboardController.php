<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\UmkmModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< Updated upstream
        // Ambil data kegiatan dan UMKM terbaru
        $kegiatan = KegiatanModel::orderBy('tanggal', 'desc')->take(5)->get();
        $umkm = UmkmModel::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('warga.dashboard.index', compact('kegiatan', 'umkm'));
=======
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Warga',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('warga.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
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
>>>>>>> Stashed changes
    }
}
