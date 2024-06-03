<?php

namespace App\Charts;

use App\Models\WargaModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WargaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $laporan = WargaModel::get();
        $data = [
            $laporan->where('jenis_kelamin', 'L')->count(),
            $laporan->where('jenis_kelamin', 'P')->count(),
        ];
        $label = [
            'Laki-laki',
            'Perempuan',
        ];

        return $this->chart->donutChart()
            ->setTitle('Distribusi Gender')
            ->setSubtitle('Jumlah Warga Berdasarkan Gender')
            ->addData($data)
            ->setLabels($label);
    }
}
