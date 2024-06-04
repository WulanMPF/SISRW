<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanModel;
use App\Models\UserModel;

class KegiatanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Kegiatan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Kegiatan']
        ];

        $activeMenu = 'kegiatan';

        $kegiatan = KegiatanModel::all();
        $user = UserModel::all();

        return view('sekretaris.kegiatan.index', ['breadcrumb' => $breadcrumb, 'kegiatan' => $kegiatan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Kegiatan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Kegiatan', 'Tambah']
        ];

        $kegiatan = KegiatanModel::all();

        $activeMenu = 'kegiatan';

        return view('sekretaris.kegiatan.create', [
            'breadcrumb' => $breadcrumb, //'pengumuman' => $pengumuman, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'nama_kegiatan'      => 'required|string|max:200',
            'deskripsi'          => 'required|string|max:65535', // Menghapus batasan max untuk teks panjang
            'tanggal'            => 'required|date',
            'gambar'             => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // $user_id = auth()->user()->user_id;
        // Mendapatkan nama file yang diacak menggunakan hashName()
        $namaFile = $request->file('gambar')->hashName();

        // Membuat entri baru di model Pengumuman dengan user_id dari session login
        KegiatanModel::create([
            // 'user_id'                 => $user_id, // Mengambil user_id dari session login
            'nama_kegiatan'      => $request->nama_kegiatan,
            'deskripsi'          => $request->deskripsi,
            'tanggal'            => $request->tanggal,
            'gambar'             => $namaFile
        ]);

        // Memindahkan file gambar yang diunggah ke direktori tujuan
        $path = $request->file('gambar')->move('gambar_kegiatan', $namaFile);
        $path = str_replace("\\", "//", $path);

        // Redirect dengan pesan sukses
        return redirect()->route('sekretaris.kegiatan.index')->with('success', 'Data kegiatan berhasil disimpan');
    }


    public function edit($id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return redirect()->route('sekretaris.kegiatan.index')->with('error', 'Kegiatan tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Kegiatan RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Kegiatan', 'Edit']
        ];

        $activeMenu = 'kegiatan';

        return view('sekretaris.kegiatan.edit', [
            'breadcrumb' => $breadcrumb,
            'kegiatan' => $kegiatan,
            'activeMenu' => $activeMenu
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan'      => 'required|string|max:200',
            'deskripsi'          => 'required|string|max:65535', // Menghapus batasan max untuk teks panjang
            'tanggal'            => 'required|date',
            'gambar'             => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->image) {
            $namaFile = $request->file('gambar')->hashName();
            $path = $request->file('gambar')->move('gambar_kegiatan', $namaFile);
            $path = str_replace("\\", "//", $path);
        }

        $kegiatan = KegiatanModel::find($id);
        $kegiatan->update([
            'nama_kegiatan'      => $request->nama_kegiatan,
            'deskripsi'          => $request->deskripsi,
            'tanggal'            => $request->tanggal,
            'gambar' => $request->file('gambar') ? $namaFile : basename(KegiatanModel::find($id)->gambar)
        ]);

        return redirect()->route('sekretaris.kegiatan.index')->with('success', 'Data kegiatan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return redirect()->route('sekretaris.kegiatan.index')->with('error', 'Data kegiatan tidak ditemukan');
        }

        // Menggunakan soft delete
        $kegiatan->delete();

        return redirect()->route('sekretaris.kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus');
    }

    public function show($id)
    {
        $pengumuman = KegiatanModel::findOrFail($id);

        return view('sekretaris.kegiatan.show', compact('kegiatan'));
    }
}
