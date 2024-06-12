<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Models\PenerimaBansosModel;
use App\Models\KkModel;
use App\Models\KriteriaBansosModel;
use App\Models\WargaModel;
use App\Models\NilaiModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penerima Bantuan Sosial RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Penerima Bantuan Sosial']
        ];

        $activeMenu = 'bansos';

        $bansos = PenerimaBansosModel::all();
        $warga = WargaModel::all();

        return view('ketua.bansos.index', ['breadcrumb' => $breadcrumb, 'bansos' => $bansos, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $bansoss = PenerimaBansosModel::select(
            'bansos_id',
            'kk_id',
            'jenis_bansos',
            'penghasilan',
            'jumlah_tanggungan',
            'dinding_rumah',
            'atap_rumah',
            'lantai_rumah'
        )->with('kk');


        if ($request->jenis_bansos) {
            $bansoss->where('jenis_bansos', $request->jenis_bansos);
        }

        return DataTables::of($bansoss)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($bansos) {
                //     $btn = '<a href="' . url('/ketua/bansos/' . $bansos->bansos_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Lihat Detail</a>  &nbsp;';
                //     return $btn;
                $btn = '<div class="btn-group mr-2">';
                $editBtn = '<a href="' . url('/ketua/bansos/edit/' . $bansos->bansos_id) . '" class="btn btn-sm"><i class="fas fa-edit" style="color: #007bff;" font-size: 17px;></i></a>';
                $deleteBtn = '<button class="btn btn-sm delete-btn" data-toggle="modal" data-target="#confirmDeleteModal" data-id="' . $bansos->bansos_id . '"><i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i></button>';
                $btn2 = '</div>';
                return  $btn . $editBtn . $deleteBtn . $btn2;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Data Penerima Bansos',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Penerima Bansos', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Data Penerima Bansos'
        ];

        $kk = KkModel::all(); // ambil data kk untuk ditampilkan di form
        $activeMenu = 'bansos'; //set menu yang sedang aktif

        return view('ketua.bansos.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kk_id'             => 'required|integer',
            'jenis_bansos'      => 'required|string|max:25',
            'penghasilan'       => 'required|numeric',
            'jumlah_tanggungan' => 'required|integer',
            'dinding_rumah'     => 'required|string|max:50',
            'atap_rumah'        => 'required|string|max:50',
            'lantai_rumah'      => 'required|string|max:50',
        ]);

        $penerimaBansos = PenerimaBansosModel::create([
            'kk_id'             => $request->kk_id,
            'jenis_bansos'      => $request->jenis_bansos,
            'penghasilan'       => $request->penghasilan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'dinding_rumah'     => $request->dinding_rumah,
            'atap_rumah'        => $request->atap_rumah,
            'lantai_rumah'      => $request->lantai_rumah,
        ]);

        $bansosId = $penerimaBansos->bansos_id;

        // Determining the values based on input
        $nilaiPenghasilan = $request->penghasilan < 500000 ? 1 : ($request->penghasilan == 500000 ? 2 : 3);
        $nilaiJumlahTanggungan = $request->jumlah_tanggungan > 3 ? 1 : ($request->jumlah_tanggungan == 3 ? 2 : 3);

        // Determining nilai for dinding_rumah
        switch ($request->dinding_rumah) {
            case 'Anyaman':
                $nilaiDindingRumah = 1;
                break;
            case 'Triplek':
                $nilaiDindingRumah = 2;
                break;
            case 'Tembok':
                $nilaiDindingRumah = 3;
                break;
            default:
                $nilaiDindingRumah = 0; // Default value if none matches
                break;
        }

        // Determining nilai for atap_rumah
        switch ($request->atap_rumah) {
            case 'Ijuk':
                $nilaiAtapRumah = 1;
                break;
            case 'Seng':
                $nilaiAtapRumah = 2;
                break;
            case 'Genteng':
                $nilaiAtapRumah = 3;
                break;
            default:
                $nilaiAtapRumah = 0; // Default value if none matches
                break;
        }

        // Determining nilai for lantai_rumah
        switch ($request->lantai_rumah) {
            case 'Tanah':
                $nilaiLantaiRumah = 1;
                break;
            case 'Bambu':
                $nilaiLantaiRumah = 2;
                break;
            case 'Semen':
                $nilaiLantaiRumah = 3;
                break;
            default:
                $nilaiLantaiRumah = 0; // Default value if none matches
                break;
        }

        // Storing values in the nilai table
        NilaiModel::create(['kriteria_id' => 1, 'bansos_id' => $bansosId, 'nilai' => $nilaiPenghasilan]);
        NilaiModel::create(['kriteria_id' => 2, 'bansos_id' => $bansosId, 'nilai' => $nilaiJumlahTanggungan]);
        NilaiModel::create(['kriteria_id' => 3, 'bansos_id' => $bansosId, 'nilai' => $nilaiDindingRumah]);
        NilaiModel::create(['kriteria_id' => 4, 'bansos_id' => $bansosId, 'nilai' => $nilaiAtapRumah]);
        NilaiModel::create(['kriteria_id' => 5, 'bansos_id' => $bansosId, 'nilai' => $nilaiLantaiRumah]);

        return redirect('/ketua/bansos')->with('success', 'Data penerima bansos berhasil disimpan');
    }

    public function show(string $id)
    {
        $bansos = PenerimaBansosModel::with('kk')->find($id);
        $warga = WargaModel::where('kk_id', $bansos->kk_id)->get();
        // $warga = WargaModel::with('kk')->find($id);
        $kk = KkModel::all();

        $breadcrumb = (object)[
            'title' => 'Detail Penerima Bansos',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Bansos', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Penerima Bansos'
        ];

        $activeMenu = 'bansos';

        return view('ketua.bansos.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'kk' => $kk, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $bansos = PenerimaBansosModel::find($id);
        $kk = KkModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Penerima Bansos',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Bansos', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Penerima Bansos'
        ];

        $activeMenu = 'bansos';

        return view('ketua.bansos.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'kk' => $kk, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kk_id'             => 'required|integer',
            'jenis_bansos'      => 'required|string|max:25',
            'penghasilan'       => 'required|numeric',
            'jumlah_tanggungan' => 'required|integer',
            'dinding_rumah'     => 'required|string|max:50',
            'atap_rumah'        => 'required|string|max:50',
            'lantai_rumah'      => 'required|string|max:50',
        ]);

        $penerimaBansos = PenerimaBansosModel::findOrFail($id);

        $penerimaBansos->update([
            'kk_id'             => $request->kk_id,
            'jenis_bansos'      => $request->jenis_bansos,
            'penghasilan'       => $request->penghasilan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'dinding_rumah'     => $request->dinding_rumah,
            'atap_rumah'        => $request->atap_rumah,
            'lantai_rumah'      => $request->lantai_rumah,
        ]);

        $bansosId = $penerimaBansos->id;

        // Determining the values based on input
        $nilaiPenghasilan = $request->penghasilan < 500000 ? 1 : ($request->penghasilan == 500000 ? 2 : 3);
        $nilaiJumlahTanggungan = $request->jumlah_tanggungan > 3 ? 1 : ($request->jumlah_tanggungan == 3 ? 2 : 3);

        // Determining nilai for dinding_rumah
        switch ($request->dinding_rumah) {
            case 'Anyaman':
                $nilaiDindingRumah = 1;
                break;
            case 'Triplek':
                $nilaiDindingRumah = 2;
                break;
            case 'Tembok':
                $nilaiDindingRumah = 3;
                break;
            default:
                $nilaiDindingRumah = 0; // Default value if none matches
                break;
        }

        // Determining nilai for atap_rumah
        switch ($request->atap_rumah) {
            case 'Ijuk':
                $nilaiAtapRumah = 1;
                break;
            case 'Seng':
                $nilaiAtapRumah = 2;
                break;
            case 'Genteng':
                $nilaiAtapRumah = 3;
                break;
            default:
                $nilaiAtapRumah = 0; // Default value if none matches
                break;
        }

        // Determining nilai for lantai_rumah
        switch ($request->lantai_rumah) {
            case 'Tanah':
                $nilaiLantaiRumah = 1;
                break;
            case 'Bambu':
                $nilaiLantaiRumah = 2;
                break;
            case 'Semen':
                $nilaiLantaiRumah = 3;
                break;
            default:
                $nilaiLantaiRumah = 0; // Default value if none matches
                break;
        }

        // Updating values in the nilai table
        NilaiModel::where('kriteria_id', 1)->where('bansos_id', $bansosId)->update(['nilai' => $nilaiPenghasilan]);
        NilaiModel::where('kriteria_id', 2)->where('bansos_id', $bansosId)->update(['nilai' => $nilaiJumlahTanggungan]);
        NilaiModel::where('kriteria_id', 3)->where('bansos_id', $bansosId)->update(['nilai' => $nilaiDindingRumah]);
        NilaiModel::where('kriteria_id', 4)->where('bansos_id', $bansosId)->update(['nilai' => $nilaiAtapRumah]);
        NilaiModel::where('kriteria_id', 5)->where('bansos_id', $bansosId)->update(['nilai' => $nilaiLantaiRumah]);

        return redirect('/ketua/bansos')->with('success', 'Data penerima bansos berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $bansos = PenerimaBansosModel::find($id); // Cari data bansos berdasarkan bansos_id
        if (!$bansos) {
            return redirect('/ketua/bansos')->with('error', 'Data bansos tidak ditemukan');
        }

        try {
            // Hapus data dari tabel penerima_bansos yang memiliki bansos_id tersebut
            PenerimaBansosModel::where('bansos_id', $id)->delete();

            // Hapus data dari tabel nilai yang memiliki bansos_id tersebut
            NilaiModel::where('bansos_id', $id)->delete();

            // Hapus data dari tabel bansos
            $bansos->delete();

            return redirect('/ketua/bansos')->with('success', 'Data bansos berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/ketua/bansos')->with('error', 'Data bansos gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }


    public function kriteria()
    {
        $breadcrumb = (object) [
            'title' => 'Data Kriteria Penerima Bantuan Sosial RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Penerima Bantuan Sosial']
        ];

        $activeMenu = 'bansos';

        $kriteria = KriteriaBansosModel::all();

        return view('ketua.bansos.kriteria', ['breadcrumb' => $breadcrumb, 'kriteria' => $kriteria, 'activeMenu' => $activeMenu]);
    }

    public function listKriteria(Request $request)
    {
        $bansoss = KriteriaBansosModel::all();


        return DataTables::of($bansoss)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->addColumn('aksi', function ($bansos) {
                $btn = '<a href="' . url('/ketua/bansos/editKriteria/' . $bansos->kriteria_id) . '" class="btn btn-sm" style="background-color: #BB955C; color: white; border-radius: 9px;">Edit</a>  &nbsp;';
                return $btn;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function editKriteria(string $id)
    {
        $kriteria = KriteriaBansosModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Kriteria Penerima Bansos',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Bansos', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Kriteria Penerima Bansos'
        ];

        $activeMenu = 'kriteria';

        return view('ketua.bansos.edit-kriteria', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kriteria' => $kriteria, 'activeMenu' => $activeMenu]);
    }

    public function updateKriteria(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'type' => 'required|string|max:25',
            'bobot' => 'required|numeric',
        ]);

        // Temukan kriteria berdasarkan ID dan lakukan update
        KriteriaBansosModel::find($id)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'type' => $request->type,
            'bobot' => $request->bobot,
        ]);

        // Redirect ke halaman kriteria bansos dengan pesan sukses
        return redirect('/ketua/bansos/kriteria')->with('success', 'Data kriteria bansos berhasil diubah');
    }

    public function perangkingan()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penerima Bantuan Sosial RW 05',
            'date' => date('l, d F Y'),
            'list'  => ['Home', 'Data Penerima Bantuan Sosial']
        ];

        $activeMenu = 'bansos';

        $bansos = PenerimaBansosModel::all();
        $warga = WargaModel::all();

        return view('ketua.bansos.perangkingan', ['breadcrumb' => $breadcrumb, 'bansos' => $bansos, 'warga' => $warga, 'activeMenu' => $activeMenu]);
    }

    public function listRangking(Request $request)
    {
        $bansoss = PenerimaBansosModel::select(
            'bansos_id',
            'kk_id',
            'jenis_bansos',
            'penghasilan',
            'jumlah_tanggungan',
            'dinding_rumah',
            'atap_rumah',
            'lantai_rumah'
        )->with('kk');


        if ($request->jenis_bansos) {
            $bansoss->where('jenis_bansos', $request->jenis_bansos);
        }

        return DataTables::of($bansoss)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default nmaa kolom: DT_RowINdex)
            ->make(true);
    }

    public function moora()
    {
        // Mengambil data kriteria
        $kriteria = KriteriaBansosModel::all()->keyBy('kriteria_id');

        // Mengambil data penerima bansos
        $penerimaBansos = PenerimaBansosModel::all()->keyBy('bansos_id');

        // Mengambil nilai
        $sample = NilaiModel::orderBy('bansos_id')->orderBy('kriteria_id')->get()->groupBy('bansos_id');

        // Proses normalisasi matrix
        $normal = [];
        foreach ($kriteria as $id_kriteria => $k) {
            $pembagi = sqrt($sample->map(fn ($values) => pow($values->where('kriteria_id', $id_kriteria)->first()->nilai, 2))->sum());
            foreach ($penerimaBansos as $id_bansos => $a) {
                $normal[$id_bansos][$id_kriteria] = $sample[$id_bansos]->where('kriteria_id', $id_kriteria)->first()->nilai / $pembagi;
            }
        }

        // Menghitung nilai optimasi
        $optimasi = [];
        foreach ($penerimaBansos as $id_bansos => $a) {
            $benefit = 0;
            $cost = 0;
            foreach ($kriteria as $id_kriteria => $k) {
                if ($k->type == 'benefit') {
                    $benefit += $normal[$id_bansos][$id_kriteria] * $k->bobot;
                } else {
                    $cost += $normal[$id_bansos][$id_kriteria] * $k->bobot;
                }
            }
            $optimasi[$id_bansos] = $benefit - $cost;
        }

        // Normalisasi nilai optimasi agar tidak negatif
        $minOptimasi = min($optimasi);
        foreach ($optimasi as &$value) {
            $value = $value - $minOptimasi; // Tidak perlu menambah 1
        }
        unset($value);

        // Merangking
        arsort($optimasi);

        // Menampilkan hasil peringkat
        $rank = 1;
        $results = collect($optimasi)->map(function ($value, $id_optimasi) use ($penerimaBansos, &$rank) {
            return [
                'rank' => $rank++,
                'kk_id' => $penerimaBansos[$id_optimasi]->kk_id,
                'id_optimasi' => $id_optimasi,
                'nilai' => $value,
            ];
        })->sortByDesc('nilai')->values()->all();

        // Menambahkan breadcrumb dan active menu
        $breadcrumb = (object) [
            'title' => 'Data Penerima Bantuan Sosial RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Data Penerima Bantuan Sosial']
        ];

        $activeMenu = 'bansos';

        return view('ketua.bansos.moora', compact('kriteria', 'penerimaBansos', 'sample', 'normal', 'optimasi', 'results', 'breadcrumb', 'activeMenu'));
    }

    public function saw()
    {
        // Mengambil data kriteria
        $kriteria = KriteriaBansosModel::all()->keyBy('kriteria_id');

        // Mengambil data penerima bansos
        $penerimaBansos = PenerimaBansosModel::all()->keyBy('bansos_id');

        // Mengambil nilai
        $sample = NilaiModel::orderBy('bansos_id')->orderBy('kriteria_id')->get()->groupBy('bansos_id');

        // Proses normalisasi matrix
        $normal = [];
        foreach ($kriteria as $id_kriteria => $k) {
            $maxValue = $sample->map(fn ($values) => $values->where('kriteria_id', $id_kriteria)->first()->nilai)->max();
            foreach ($penerimaBansos as $id_bansos => $a) {
                $normal[$id_bansos][$id_kriteria] = $sample[$id_bansos]->where('kriteria_id', $id_kriteria)->first()->nilai / $maxValue;
            }
        }

        // Menghitung nilai preferensi
        $preferensi = [];
        foreach ($penerimaBansos as $id_bansos => $a) {
            $totalNilai = 0;
            foreach ($kriteria as $id_kriteria => $k) {
                $totalNilai += $normal[$id_bansos][$id_kriteria] * $k->bobot;
            }
            $preferensi[$id_bansos] = $totalNilai;
        }

        // Merangking
        arsort($preferensi);

        // Menampilkan hasil peringkat
        $rank = 1;
        $results = collect($preferensi)->map(function ($value, $id_preferensi) use ($penerimaBansos, &$rank) {
            return [
                'rank' => $rank++,
                'kk_id' => $penerimaBansos[$id_preferensi]->kk_id,
                'id_preferensi' => $id_preferensi,
                'nilai' => $value,
            ];
        })->sortByDesc('nilai')->values()->all();

        // Menambahkan breadcrumb dan active menu
        $breadcrumb = (object) [
            'title' => 'Data Penerima Bantuan Sosial RW 05',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Data Penerima Bantuan Sosial']
        ];

        $activeMenu = 'bansos';

        return view('ketua.bansos.saw', compact('kriteria', 'penerimaBansos', 'sample', 'normal', 'preferensi', 'results', 'breadcrumb', 'activeMenu'));
    }
}
