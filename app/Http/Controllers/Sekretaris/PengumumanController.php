<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use App\Models\PengumumanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengumumanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pengumuman RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Pengumuman']
        ];

        $activeMenu = 'pengumuman';

        $pengumuman = PengumumanModel::all();
        $user = UserModel::all();

        return view('sekretaris.pengumuman.index', ['breadcrumb' => $breadcrumb, 'pengumuman' => $pengumuman, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Pengumuman RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Pengumuman', 'Tambah']
        ];

        $pengumuman = PengumumanModel::all();

        $activeMenu = 'pengumuman';

        return view('sekretaris.pengumuman.create', [
            'breadcrumb' => $breadcrumb, //'pengumuman' => $pengumuman, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'judul'                   => 'required|string|max:200',
            'isi_pengumuman'          => 'required|string|max:65535', // Menghapus batasan max untuk teks panjang
            'gambar'                  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // $user_id = auth()->user()->user_id;
        // Mendapatkan nama file yang diacak menggunakan hashName()
        $namaFile = $request->file('gambar')->hashName();

        // Membuat entri baru di model Pengumuman dengan user_id dari session login
        PengumumanModel::create([
            // 'user_id'                 => $user_id, // Mengambil user_id dari session login
            'judul'                   => $request->judul,
            'isi_pengumuman'          => $request->isi_pengumuman,
            'gambar'                  => $namaFile
        ]);

        // Memindahkan file gambar yang diunggah ke direktori tujuan
        $path = $request->file('gambar')->move('gambar_pengumuman', $namaFile);
        $path = str_replace("\\", "//", $path);

        // Redirect dengan pesan sukses
        return redirect()->route('sekretaris.pengumuman.index')->with('success', 'Data pengumuman berhasil disimpan');
    }


    public function edit($id)
    {
        $pengumuman = PengumumanModel::find($id);

        if (!$pengumuman) {
            return redirect()->route('sekretaris.pengumuman.index')->with('error', 'Pengumuman tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Pengumuman RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Pengumuman', 'Edit']
        ];

        $activeMenu = 'pengumuman';

        return view('sekretaris.pengumuman.edit', [
            'breadcrumb' => $breadcrumb,
            'pengumuman' => $pengumuman,
            'activeMenu' => $activeMenu
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi_pengumuman' => 'required|string|max:65535',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->image) {
            $namaFile = $request->file('gambar')->hashName();
            $path = $request->file('gambar')->move('gambar_pengumuman', $namaFile);
            $path = str_replace("\\", "//", $path);
        }

        $pengumuman = PengumumanModel::find($id);
        $pengumuman->update([
            'judul' => $request->judul,
            'isi_pengumuman' => $request->isi_pengumuman,
            'gambar' => $request->file('gambar') ? $namaFile : basename(PengumumanModel::find($id)->gambar)
        ]);

        return redirect()->route('sekretaris.pengumuman.index')->with('success', 'Data pengumuman berhasil diubah');
    }

    public function destroy(string $id)
    {
        $pengumuman = PengumumanModel::find($id);

        if (!$pengumuman) {
            return redirect()->route('sekretaris.pengumuman.index')->with('error', 'Data pengumuman tidak ditemukan');
        }

        // Menggunakan soft delete
        $pengumuman->delete();

        return redirect()->route('sekretaris.pengumuman.index')->with('success', 'Data pengumuman berhasil dihapus');
    }

    public function show($id)
    {
        $pengumuman = PengumumanModel::findOrFail($id);

        return view('sekretaris.pengumuman.show', compact('pengumuman'));
    }
}
