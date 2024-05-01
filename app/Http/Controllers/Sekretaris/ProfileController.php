<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profile',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Profile']
        ];

        $activeMenu = 'profile';

        return view('sekretaris.profile.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
