<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\SyaratBansosModel;
use Illuminate\Http\Request;

class SyaratBansosController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Syarat  & Ketentuan Penerima Bansos',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'S&K Penerima Bansos']
        ];

        $activeMenu = 'bansos';
        $bansos = SyaratBansosModel::all();
        return view('warga.bansos.index', ['breadcrumb' => $breadcrumb, 'bansos' => $bansos, 'activeMenu' => $activeMenu]);
    }
    public function show(string $id)
    {
        $bansos = SyaratBansosModel::find($id);
        $breadcrumb = (object)[
            'title' => 'S&K dalam Menerima {{bansos->jenis_bansos}}',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Bansos', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail S&K Bansos RW 05'
        ];

        $activeMenu = 'bansos';

        return view('warga.bansos.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'activeMenu' => $activeMenu]);
    }
}
