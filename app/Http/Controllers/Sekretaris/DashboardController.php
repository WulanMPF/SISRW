<?php

namespace App\Http\Controllers\Sekretaris;

use App\Http\Controllers\Controller;
use App\Models\KkModel;
use App\Models\PenerimaBansosModel;
use App\Models\PengaduanModel;
use App\Models\UmkmModel;
use App\Models\WargaModel;
use App\Models\LapkeuModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Tambahkan namespace DB

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Sekretaris RW',
            'date' => date('l, d F Y'),
            'list' => ['Home', 'Dashboard']
        ];

        // Mengambil data pemasukan dan pengeluaran dari Januari 2024 sampai bulan ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $startMonth = 1; // Januari
        $startYear = 2024;

        // Menggunakan array untuk menyimpan data pemasukan dan pengeluaran per bulan
        $pemasukanPerBulan = [];
        $pengeluaranPerBulan = [];
        $bulanLabels = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $endMonth = ($year == $currentYear) ? $currentMonth : 12;
            $start = ($year == $startYear) ? $startMonth : 1;

            for ($month = $start; $month <= $endMonth; $month++) {
                // Mengambil data pemasukan dan pengeluaran per bulan
                $pemasukan = LapKeuModel::where('jenis_laporan', 'pemasukan')
                    ->whereYear('tgl_laporan', $year)
                    ->whereMonth('tgl_laporan', $month)
                    ->sum('nominal');

                $pengeluaran = LapKeuModel::where('jenis_laporan', 'pengeluaran')
                    ->whereYear('tgl_laporan', $year)
                    ->whereMonth('tgl_laporan', $month)
                    ->sum('nominal');

                // Menyimpan data pemasukan dan pengeluaran per bulan dalam array
                $pemasukanPerBulan[] = $pemasukan;
                $pengeluaranPerBulan[] = $pengeluaran;
                $bulanLabels[] = Carbon::createFromDate($year, $month)->translatedFormat('F Y');
            }
        }

        $jumlah_penerima_bansos = PenerimaBansosModel::count();
        $jumlah_pengaduan = PengaduanModel::count();
        $jumlah_kk = KkModel::count();
        $jumlah_umkm = UmkmModel::count();
        $jumlah_warga = WargaModel::count();

        // Menghitung jumlah warga berdasarkan jenis kelamin
        $jumlah_laki_laki = WargaModel::where('jenis_kelamin', 'L')->count();
        $jumlah_perempuan = WargaModel::where('jenis_kelamin', 'P')->count();

        // Menghitung jumlah UMKM berdasarkan jenis usaha
        $jenis_usaha_counts = UmkmModel::select('jenis_usaha', DB::raw('count(*) as total'))
            ->groupBy('jenis_usaha')
            ->pluck('total', 'jenis_usaha')->all();

        // Menghitung persentase status pengaduan
        $status_counts = PengaduanModel::select('status_pengaduan', DB::raw('count(*) as total'))
            ->groupBy('status_pengaduan')
            ->pluck('total', 'status_pengaduan')->all();

        $total_pengaduan = array_sum($status_counts); // Total pengaduan

        $persentase_selesai = ($total_pengaduan > 0) ? ($status_counts['Selesai'] / $total_pengaduan) * 100 : 0;
        $persentase_diproses = ($total_pengaduan > 0) ? ($status_counts['Diproses'] / $total_pengaduan) * 100 : 0;
        $persentase_ditunda = ($total_pengaduan > 0) ? ($status_counts['Ditunda'] / $total_pengaduan) * 100 : 0;

        // Menghitung jumlah warga berdasarkan pekerjaannya
        $pekerjaan_counts = WargaModel::select('pekerjaan', DB::raw('count(*) as total'))
            ->groupBy('pekerjaan')
            ->pluck('total', 'pekerjaan')->all();

        $activeMenu = 'dashboard';

        return view('sekretaris.dashboard', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jumlah_penerima_bansos' => $jumlah_penerima_bansos,
            'jumlah_pengaduan' => $jumlah_pengaduan,
            'jumlah_kk' => $jumlah_kk,
            'jumlah_umkm' => $jumlah_umkm,
            'jumlah_warga' => $jumlah_warga,
            'pemasukanPerBulan' => $pemasukanPerBulan, // Mengirimkan data pemasukan per bulan ke view
            'pengeluaranPerBulan' => $pengeluaranPerBulan, // Mengirimkan data pengeluaran per bulan ke view
            'bulanLabels' => $bulanLabels,
            'jumlah_laki_laki' => $jumlah_laki_laki,
            'jumlah_perempuan' => $jumlah_perempuan,
            'jenis_usaha_counts' => $jenis_usaha_counts,
            'persentase_selesai' => $persentase_selesai,
            'persentase_diproses' => $persentase_diproses,
            'persentase_ditunda' => $persentase_ditunda,
            'pekerjaan_counts' => $pekerjaan_counts, // Menambahkan data jumlah warga berdasarkan pekerjaan
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
