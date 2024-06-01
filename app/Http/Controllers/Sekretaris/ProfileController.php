<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WargaModel;

class ProfileController extends Controller
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

        $activeMenu = 'profile';

        return view('sekretaris.profile.index', [
            'user' => $user,
            'warga' => $warga, 'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu
        ]);
    }
}
