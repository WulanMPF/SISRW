<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaBansosSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        // Ambil semua kk_id dari tabel kk
        $kkIds = DB::table('kk')->pluck('kk_id')->toArray();

        // Daftar jenis bansos yang ingin digunakan
        $jenisBansos = [
            'Bansos Beras 10kg',
            'Bansos DTKS',
            'Bansos PKH',
            'Bansos Tunai Akibat Covid 19',
        ];

        // Batasan jumlah data yang diinginkan
        $jumlahData = 10;

        // Generate data secara acak
        for ($i = 1; $i <= $jumlahData; $i++) {
            $randomKkId = $kkIds[array_rand($kkIds)]; // Ambil kk_id secara acak dari daftar kk_ids
            $randomJenisBansos = $jenisBansos[array_rand($jenisBansos)]; // Ambil jenis bansos secara acak

            // Tambahkan data ke dalam array $data
            $data[] = [
                'kk_id' => $randomKkId,
                'jenis_bansos' => $randomJenisBansos,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data ke dalam tabel penerima_bansos menggunakan DB facade
        DB::table('penerima_bansos')->insert($data);
    }
}
