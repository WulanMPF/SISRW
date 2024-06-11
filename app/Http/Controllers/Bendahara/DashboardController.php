<?php

namespace App\Http\Controllers\Bendahara;

use App\Charts\LapKeuChart;
use App\Charts\PemasukanPengeluaranChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LapkeuModel;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang, Bendahara RW',
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

        // Mengambil data pemasukan dan pengeluaran bulan ini
        $pemasukanBulanIni = LapKeuModel::where('jenis_laporan', 'pemasukan')
            ->whereYear('tgl_laporan', $currentYear)
            ->whereMonth('tgl_laporan', $currentMonth)
            ->sum('nominal');

        $pengeluaranBulanIni = LapKeuModel::where('jenis_laporan', 'pengeluaran')
            ->whereYear('tgl_laporan', $currentYear)
            ->whereMonth('tgl_laporan', $currentMonth)
            ->sum('nominal');


        $activeMenu = 'dashboard';
        return view('bendahara.dashboard', [
            'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu,
            'pemasukanPerBulan' => $pemasukanPerBulan, // Mengirimkan data pemasukan per bulan ke view
            'pengeluaranPerBulan' => $pengeluaranPerBulan, // Mengirimkan data pengeluaran per bulan ke view
            'bulanLabels' => $bulanLabels,
            'pemasukanBulanIni' => $pemasukanBulanIni, // Mengirimkan data pemasukan bulan ini ke view
            'pengeluaranBulanIni' => $pengeluaranBulanIni, // Mengirimkan data pengeluaran bulan ini ke view
        ]);
    }
}
