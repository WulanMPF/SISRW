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
        // Ambil data kegiatan dan UMKM terbaru
        $kegiatan = KegiatanModel::orderBy('tanggal', 'desc')->take(5)->get();
        $umkm = UmkmModel::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('warga.dashboard.index', compact('kegiatan', 'umkm'));
    }
}
