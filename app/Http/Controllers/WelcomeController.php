<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('landingPage.index');
    }

    // public function ketua()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Selamat Datang, Ketua RW',
    //         'date' => date('l, d F Y'),
    //         'list' => ['Home', 'Dashboard']
    //     ];

    //     $activeMenu = 'dashboard';

    //     return view('ketua.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    // }

    // public function sekretaris()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Selamat Datang, Sekretaris RW',
    //         'date' => date('l, d F Y'),
    //         'list' => ['Home', 'Dashboard']
    //     ];

    //     $activeMenu = 'dashboard';

    //     return view('sekretaris.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    // }

    // public function bendahara()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Selamat Datang, Bendahara RW',
    //         'date' => date('l, d F Y'),
    //         'list' => ['Home', 'Dashboard']
    //     ];

    //     $activeMenu = 'dashboard';

    //     return view('bendahara.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    // }

    // public function warga()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Selamat Datang, Warga',
    //         'date' => date('l, d F Y'),
    //         'list' => ['Home', 'Dashboard']
    //     ];

    //     $activeMenu = 'dashboard';

    //     return view('warga.dashboard', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    // }
}
