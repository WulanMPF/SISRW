<?php

namespace App\Http\Controllers\landingPage;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\UmkmModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanModel::orderBy('tanggal', 'asc')->take(5)->get();
        $umkm = UmkmModel::orderBy('created_at', 'asc')->take(5)->get(); // Correct variable name
        $jumlah_umkm = UmkmModel::count();

        return view('landingPage.index', [
            'kegiatan' => $kegiatan,
            'umkm' => $umkm, // Correct variable name
            'jumlah_umkm' => $jumlah_umkm
        ]);
    }
}
