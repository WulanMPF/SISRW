<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use App\Models\SyaratBansosModel;
use Illuminate\Http\Request;

class SyaratBansosController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Syarat & Ketentuan Penerima Bansos',
            'date' => date('l, d F y'),
            'list' => ['Home', 'S&K Penerima Bansos']
        ];

        $activeMenu = 'bansos';
        $bansos = SyaratBansosModel::all();
        return view('sekretaris.bansos.index', [
            'breadcrumb' => $breadcrumb,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Formulir Syarat  & Ketentuan dalam Menerima Bansos',
            'date' => date('l, d F y'),
            'list'  => ['Home', 'Data S&K Penerima Bansos', 'Formulir']
        ];
        $page = (object)[
            'title' => 'Formulir Syarat & Ketentuan dalam Menerima Bansos'
        ];

        $bansos = SyaratBansosModel::all();
        $activeMenu = 'bansos'; //set menu yang sedang aktif

        return view('sekretaris.bansos.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tgl_syarat_ketentuan'  => 'required|date',
            'jenis_bansos' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:200',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $namaFile = $request->file('gambar')->hashName();

        SyaratBansosModel::create([
            'bansos_id' => null,
            'tgl_syarat_ketentuan' => $request->tgl_syarat_ketentuan,
            'jenis_bansos' => $request->jenis_bansos,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaFile
        ]);
        $gambarPath = $request->file('gambar')->storeAs('public/syarat_bansos', $namaFile);

        return redirect('/sekretaris/bansos')->with('success', 'Data syarat dan ketentuan bansos telah berhasil diinputkan');
    }
    public function show(string $id)
    {
        $bansos = SyaratBansosModel::findOrFail($id); // Menggunakan findOrFail agar error 404 jika tidak ditemukan

        $breadcrumb = (object) [
            'title' => 'S&K dalam Menerima ' . $bansos->jenis_bansos,
            'date' => date('l, d F y'),
            'list' => ['Home', 'Bansos', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail S&K Bansos RW 05'
        ];

        $activeMenu = 'bansos';

        return view('sekretaris.bansos.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }
}
