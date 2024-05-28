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

        //$pengumuman = PengumumanModel::all();

        $activeMenu = 'pengumuman';

        return view('sekretaris.pengumuman.create', ['breadcrumb' => $breadcrumb, //'pengumuman' => $pengumuman, 
        'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id'                 => 'required|integer',
        'judul'                   => 'required|string|max:100',
        'isi_pengumuman'          => 'required|string|max:200',
        'gambar'                  => 'required|string|max:200',
    ]);

    PengumumanModel::create([
        'user_id'                 => $request->user_id,
        'judul'                   => $request->judul,
        'isi_pengumuman'          => $request->isi_pengumuman,
        'gambar'                  => $request->gambar,
    ]);

    return redirect()->route('sekretaris.pengumuman.index')->with('success', 'Data pengumuman berhasil disimpan');
}


    public function edit(string $id)
    {
        $pengumuman = PengumumanModel::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Pengumuman RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Pengumuman', 'Edit']
        ];

        $activeMenu = 'pengumuman';

        return view('sekretaris.pengumuman.edit', ['breadcrumb' => $breadcrumb, 'pengumuman' => $pengumuman, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'                 => 'required|',
            'judul'                   => 'required|string|max:100',
            'isi_pengumuman'          => 'required|string|max:200',
            'gambar'                  => 'required|string|max:200',
        ]);

        PengumumanModel::find($id)->update([
            'user_id'                 => $request->user_id,
            'judul'                   => $request->judul,
            'isi_pengumuman'          => $request->isi_pengumuman,
            'gambar'                  => $request->gambar,
        ]);

        return redirect('/sekretaris/pengumuman.index')->with('success', 'Data pengumuman berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = PengumumanModel::find($id);
        if (!$check) {
            return redirect('/sekretaris/pengumuman.index')->with('error', 'Data pengumuman tidak ditemukan');
        }
    }
    public function show($id)
    {
    $pengumuman = PengumumanModel::findOrFail($id);

    return view('sekretaris.pengumuman.show', compact('pengumuman'));
    }

    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $pengumuman = PengumumanModel::where('judul', 'like', "%$keyword%")
        ->orWhere('isi_pengumuman', 'like', "%$keyword%")
        ->get();

    return response()->json($pengumuman);
}

}
