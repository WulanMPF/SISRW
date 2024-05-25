<?php

namespace App\Charts;

use App\Models\LapkeuModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LapKeuChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $laporan = LapkeuModel::get();
        $nama = 'Laporan Pemasukan dan Pengeluaran';
        $data = [
            $laporan->where('jenis_laporan', 'pemasukan')->sum('nominal'),
            $laporan->where('jenis_laporan', 'pengeluaran')->sum('nominal'),
        ];
        $label = [
            'Pemasukan',
            'Pengeluaran',
        ];
        return $this->chart->donutChart()
            ->setTitle('Laporan Pemasukan dan Pengeluaran')
            ->setSubtitle('Tahun 2024')
            // ->setWidth(500)
            ->setHeight(300)
            ->addData($data)
            ->setLabels($label);
    }
}
