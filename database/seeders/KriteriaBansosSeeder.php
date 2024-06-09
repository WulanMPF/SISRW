<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriteria_bansos')->insert([
            [
                'nama_kriteria' => 'Penghasilan',
                'type' => 'Cost',
                'bobot' => 0.30,
            ],
            [
                'nama_kriteria' => 'Jumlah Tanggungan',
                'type' => 'Benefit',
                'bobot' => 0.25,
            ],
            [
                'nama_kriteria' => 'Kondisi Dinding Rumah',
                'type' => 'Benefit',
                'bobot' => 0.15,
            ],
            [
                'nama_kriteria' => 'Kondisi Atap Rumah',
                'type' => 'Benefit',
                'bobot' => 0.15,
            ],
            [
                'nama_kriteria' => 'Kondisi Lantai Rumah',
                'type' => 'Benefit',
                'bobot' => 0.15,
            ],

        ]);
    }
}
