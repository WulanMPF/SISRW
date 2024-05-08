<?php

namespace App\Http\Controllers\warga;

use App\Models\PersuratanModel; // Update the model namespace
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AjukanPersuratanController extends Controller
{

    public function index()
    {
        // Breadcrumbs setup
        $breadcrumb = (object) [
            'title' => 'Ajukan Persuratan',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Ajukan Persuratan']
        ];

        // Active menu identifier
        $activeMenu = 'surat';

        // Mocked documents data
        $documents = [
            (object) ['id' => 1, 'name' => 'Surat Keterangan Belum Menikah', 'size' => 345],
            (object) ['id' => 2, 'name' => 'Surat Kehilangan', 'size' => 1234],
            (object) ['id' => 3, 'name' => 'Surat Pindah Domisili', 'size' => 645],
            (object) ['id' => 4, 'name' => 'Surat Keterangan Warga Tidak Mampu', 'size' => 987],

        ];

        return view('warga.ajukanpersuratan.index', compact('breadcrumb', 'activeMenu', 'documents'));
    }

    public function create()
    {
        return view('warga.ajukanpersuratan.create');  // Ensure this view file exists
    }

    // Method to store the new document data
    public function store(Request $request)
    {
        // Validate and store the document
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file'
        ]);

        // Assume you have a Document model set up correctly
        $document = new Document([
            'name' => $request->name,
            'file_path' => $request->file('file')->store('documents', 'public')
        ]);
        $document->save();

        return redirect()->route('ajukan-persuratan.index')->with('success', 'Document uploaded successfully.');
    }

    public function download($id)
    {
        $document = PersuratanModel::findOrFail($id); // Use the new model
        $pathToFile = storage_path('app/public/' . $document->file_path);

        if (!file_exists($pathToFile)) {
            abort(404);
        }

        return response()->download($pathToFile, $document->name, ['Content-Length: ' . $document->size]);
    }
}
