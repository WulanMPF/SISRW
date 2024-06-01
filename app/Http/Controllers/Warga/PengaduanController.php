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
            'prioritas' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'jenis_pengaduan' => 'required|string|max:255', // Ensure this field exists in your form and database
            'lampiran' => 'required|file|max:2048',
        ]);

        // Ambil warga_id dari sesi login
        $warga_id = auth()->user()->warga_id;

        // Create a new Pengaduan entry using the model
        $pengaduan = new PengaduanModel();
        $pengaduan->warga_id = $warga_id; // Set warga_id from session
        $pengaduan->tgl_pengaduan = $request->tgl_pengaduan;
        $pengaduan->prioritas = $request->prioritas; // Ensure this field exists in your form and database
        $pengaduan->deskripsi = $request->deskripsi;
        $pengaduan->jenis_pengaduan = $request->jenis_pengaduan; // Set the jenis_pengaduan field
        $pengaduan->status_pengaduan = 'Diproses'; // Set status_pengaduan to "Diproses"
        $pengaduan->tindakan_diambil = 'belum ada tindakan'; // Set tindakan_diambil to "belum ada tindakan"

        // Handle file upload with Laravel's Storage facade
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran');
            $path = $lampiran->store('public/lampiran');
            $pengaduan->lampiran = Storage::url($path);
        }

        $pengaduan->save();

        // Redirect with success message
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diajukan.');
    }
}
