<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Bendahara RW',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('bendahara.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
