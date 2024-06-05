<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        // Ambil data warga berdasarkan warga_id dari user yang sedang login
        $warga = WargaModel::where('warga_id', $user->warga_id)->first();

        $breadcrumb = (object) [
            'title' => 'Profile',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Profile']
        ];

        $activeMenu = 'notifikasi';

        $umkm = UmkmModel::all();

        return view('ketua.notifikasi.index', [
            'user' => $user,
            'warga' => $warga, 'breadcrumb' => $breadcrumb, 'umkm' => $umkm, 'activeMenu' => $activeMenu
        ]);
    }
}
