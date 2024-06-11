<?php

namespace App\Charts;

use App\Models\WargaModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AgamaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $warga = WargaModel::get();
        $data = [
            $warga->where('agama', 'Islam')->count(),
            $warga->where('agama', 'Kristen')->count(),
            $warga->where('agama', 'Katolik')->count(),
            $warga->where('agama', 'Hindu')->count(),
        ];
        $labels = ['Islam', 'Kristen', 'Katolik', 'Hindu'];

        return $this->chart->donutChart()
            ->setTitle('Distribusi Agama')
            ->setSubtitle('Jumlah Warga RW 05 Berdasarkan Agama')
            ->addData($data)
            ->setLabels($labels);
    }
}
