<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Loop through periode_id from 99 to 115
        for ($periode_id = 99; $periode_id <= 115; $periode_id++) {
            // Calculate the month and year based on periode_id
            $baseYear = 2023; // Assuming periode_id 99 corresponds to January 2023
            $offset = $periode_id - 99;
            $month = ($offset % 12) + 1;
            $year = $baseYear + intdiv($offset, 12);

            // Loop through kk_id from 1 to 30
            for ($kk_id = 1; $kk_id <= 30; $kk_id++) {
                DB::table('iuran')->insert([
                    'periode_id' => $periode_id,
                    'kk_id' => $kk_id,
                    'laporan_id' => null,
                    'tgl_pembayaran' => Carbon::create($year, $month, 1)->toDateString(),
                    'jumlah_bayar' => 55000,
                    'status_pembayaran' => 'Lunas',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
