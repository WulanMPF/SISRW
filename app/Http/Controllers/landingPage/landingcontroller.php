<?php

namespace App\Http\Controllers\landingPage;

use App\Http\Controllers\Controller;
use App\Models\KegiatanModel;
use App\Models\UmkmModel;
use App\Models\PengumumanModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanModel::orderBy('tanggal', 'asc')->take(10)->get();
        $umkm = UmkmModel::orderBy('created_at', 'asc')->take(10)->get(); // Correct variable name
        $jumlah_umkm = UmkmModel::count();
        $pengumuman = PengumumanModel::orderBy('created_at', 'desc')->take(1)->get();
        $kegiatan = KegiatanModel::orderBy('created_at', 'desc')->take(1)->get();

        return view('landingPage.index', [
            'kegiatan' => $kegiatan,
            'umkm' => $umkm, // Correct variable name
            'jumlah_umkm' => $jumlah_umkm,
            'pengumuman' => $pengumuman,
        ]);
    }
}
