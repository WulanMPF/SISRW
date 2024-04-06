<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('landingPage.index');
    }

    public function login()
    {
        return view('login.index');
    }

    public function ketua()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Ketua RW',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('ketua.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function sekretaris()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang'
        ];

        $activeMenu = 'dashboard';

        return view('sekretaris.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function bendahara()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('bendahara.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function warga()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('warga.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
