<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel; // Assuming this is the correct model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Breadcrumbs setup
          $breadcrumb = (object) [
            'title' => 'Formulir Aspirasi dan Pengaduan Warga',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Pengaduan']
        ];

        // Active menu identifier
        $activeMenu = 'pengaduan';

        // Passing data to the view
        return view('warga.pengaduan.index', compact('breadcrumb', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_pengaduan' => 'required|date',
            'kategori' => 'required|string|max:255', // Ensure this field exists in your form and database
            'deskripsi' => 'required|string|max:255',
            'lampiran' => 'required|file|max:2048', // Limiting file size to 2MB
        ]);

        // Create a new Pengaduan entry using the model
        $pengaduan = new PengaduanModel();
        $pengaduan->tgl_pengaduan = $request->tgl_pengaduan;
        $pengaduan->kategori = $request->kategori; // Handle category field if it's part of your form
        $pengaduan->deskripsi = $request->deskripsi;

        // Handle file upload with Laravel's Storage facade
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $path = $lampiran->store('public/lampiran');
            $pengaduan->lampiran = Storage::url($path);
        }

        $pengaduan->save();

        // Redirect with success message
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil disimpan.');
    }
}
