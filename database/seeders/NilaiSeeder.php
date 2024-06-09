<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kriteria_id' => 1, 'bansos_id' => 1, 'nilai' => 1],
            ['kriteria_id' => 2, 'bansos_id' => 1, 'nilai' => 3],
            ['kriteria_id' => 3, 'bansos_id' => 1, 'nilai' => 3],
            ['kriteria_id' => 4, 'bansos_id' => 1, 'nilai' => 3],
            ['kriteria_id' => 5, 'bansos_id' => 1, 'nilai' => 3],
            ['kriteria_id' => 1, 'bansos_id' => 2, 'nilai' => 3],
            ['kriteria_id' => 2, 'bansos_id' => 2, 'nilai' => 1],
            ['kriteria_id' => 3, 'bansos_id' => 2, 'nilai' => 2],
            ['kriteria_id' => 4, 'bansos_id' => 2, 'nilai' => 2],
            ['kriteria_id' => 5, 'bansos_id' => 2, 'nilai' => 1],
            ['kriteria_id' => 1, 'bansos_id' => 3, 'nilai' => 1],
            ['kriteria_id' => 2, 'bansos_id' => 3, 'nilai' => 2],
            ['kriteria_id' => 3, 'bansos_id' => 3, 'nilai' => 1],
            ['kriteria_id' => 4, 'bansos_id' => 3, 'nilai' => 2],
            ['kriteria_id' => 5, 'bansos_id' => 3, 'nilai' => 1],
            ['kriteria_id' => 1, 'bansos_id' => 4, 'nilai' => 3],
            ['kriteria_id' => 2, 'bansos_id' => 4, 'nilai' => 1],
            ['kriteria_id' => 3, 'bansos_id' => 4, 'nilai' => 2],
            ['kriteria_id' => 4, 'bansos_id' => 4, 'nilai' => 3],
            ['kriteria_id' => 5, 'bansos_id' => 4, 'nilai' => 1],
            ['kriteria_id' => 1, 'bansos_id' => 5, 'nilai' => 1],
            ['kriteria_id' => 2, 'bansos_id' => 5, 'nilai' => 2],
            ['kriteria_id' => 3, 'bansos_id' => 5, 'nilai' => 1],
            ['kriteria_id' => 4, 'bansos_id' => 5, 'nilai' => 2],
            ['kriteria_id' => 5, 'bansos_id' => 5, 'nilai' => 1],
            ['kriteria_id' => 1, 'bansos_id' => 6, 'nilai' => 2],
            ['kriteria_id' => 2, 'bansos_id' => 6, 'nilai' => 1],
            ['kriteria_id' => 3, 'bansos_id' => 6, 'nilai' => 1],
            ['kriteria_id' => 4, 'bansos_id' => 6, 'nilai' => 2],
            ['kriteria_id' => 5, 'bansos_id' => 6, 'nilai' => 3],
            ['kriteria_id' => 1, 'bansos_id' => 7, 'nilai' => 1],
            ['kriteria_id' => 2, 'bansos_id' => 7, 'nilai' => 3],
            ['kriteria_id' => 3, 'bansos_id' => 7, 'nilai' => 1],
            ['kriteria_id' => 4, 'bansos_id' => 7, 'nilai' => 2],
            ['kriteria_id' => 5, 'bansos_id' => 7, 'nilai' => 1],
            ['kriteria_id' => 1, 'bansos_id' => 8, 'nilai' => 3],
            ['kriteria_id' => 2, 'bansos_id' => 8, 'nilai' => 1],
            ['kriteria_id' => 3, 'bansos_id' => 8, 'nilai' => 1],
            ['kriteria_id' => 4, 'bansos_id' => 8, 'nilai' => 1],
            ['kriteria_id' => 5, 'bansos_id' => 8, 'nilai' => 2],
            ['kriteria_id' => 1, 'bansos_id' => 9, 'nilai' => 1],
            ['kriteria_id' => 2, 'bansos_id' => 9, 'nilai' => 3],
            ['kriteria_id' => 3, 'bansos_id' => 9, 'nilai' => 3],
            ['kriteria_id' => 4, 'bansos_id' => 9, 'nilai' => 2],
            ['kriteria_id' => 5, 'bansos_id' => 9, 'nilai' => 3],
            ['kriteria_id' => 1, 'bansos_id' => 10, 'nilai' => 1],
            ['kriteria_id' => 2, 'bansos_id' => 10, 'nilai' => 3],
            ['kriteria_id' => 3, 'bansos_id' => 10, 'nilai' => 2],
            ['kriteria_id' => 4, 'bansos_id' => 10, 'nilai' => 3],
            ['kriteria_id' => 5, 'bansos_id' => 10, 'nilai' => 1],
        ];

        DB::table('nilai')->insert($data);
    }
}
