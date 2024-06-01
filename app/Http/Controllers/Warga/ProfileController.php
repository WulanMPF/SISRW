<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WargaModel;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Ambil data warga berdasarkan warga_id dari user yang sedang login
        $warga = WargaModel::where('warga_id', $user->warga_id)->first();

        // Buat objek breadcrumb
        $breadcrumb = (object) [
            'title' => 'Profile',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Profile']
        ];

        // Set menu aktif
        $activeMenu = 'profile';

        // Pass data pengguna dan data warga ke view
        return view('warga.profile.index', [
            'user' => $user,
            'warga' => $warga,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
