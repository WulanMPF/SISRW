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

        $activeMenu = 'skBansos';
        $skBansos = SyaratBansosModel::all();
        return view('sekretaris.skBansos.index', [
            'breadcrumb' => $breadcrumb,
            'skBansos' => $skBansos,
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

        $skBansos = SyaratBansosModel::all();
        $activeMenu = 'skBansos'; //set menu yang sedang aktif

        return view('sekretaris.skBansos.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'skBansos' => $skBansos, 'activeMenu' => $activeMenu]);
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

        // Simpan gambar ke dalam direktori syarat_bansos dengan nama yang dihasilkan oleh hashName()
        // $gambarPath = $request->file('gambar')->storeAs('public/syarat_bansos', $namaFile);
        $path = $request->file('gambar')->move('syarat_bansos', $namaFile);
        $path = str_replace("\\", "//", $path);

        return redirect('/sekretaris/skBansos')->with('success', 'Data syarat dan ketentuan bansos telah berhasil diinputkan');
    }
    public function show(string $id)
    {
        $skBansos = SyaratBansosModel::findOrFail($id); // Menggunakan findOrFail agar error 404 jika tidak ditemukan

        $breadcrumb = (object) [
            'title' => 'S&K dalam Menerima ' . $skBansos->jenis_bansos,
            'date' => date('l, d F y'),
            'list' => ['Home', 'S&K Bansos', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail S&K Bansos RW 05'
        ];

        $activeMenu = 'skBansos';

        return view('sekretaris.skBansos.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'skBansos' => $skBansos,
            'activeMenu' => $activeMenu
        ]);
    }
}
