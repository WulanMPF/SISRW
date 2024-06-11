<?php

namespace App\Charts;

use App\Models\WargaModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PekerjaanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $warga = WargaModel::select('pekerjaan')->get();

        $data = [
            $warga->where('pekerjaan', 'Petani')->count(),
            $warga->where('pekerjaan', 'Wiraswasta')->count(),
            $warga->where('pekerjaan', 'Buruh')->count(),
            $warga->where('pekerjaan', 'Swasta')->count(),
            $warga->where('pekerjaan', 'Pelajar')->count(),
            $warga->where('pekerjaan', 'PNS')->count()
        ];

        $categories = ['Petani', 'Wiraswasta', 'Buruh', 'Swasta', 'Pelajar', 'PNS'];

        return $this->chart->barChart()
            ->setTitle('Distribusi Pekerjaan Warga RW 05')
            ->setSubtitle('Perbandingan berdasarkan jenis pekerjaan')
            ->addData('Jumlah Warga', $data)
            ->setXAxis($categories)
            ->setColors(['#DC3545', '#007BFF', '#6610F2', '#E83E8C']);
    }
}
