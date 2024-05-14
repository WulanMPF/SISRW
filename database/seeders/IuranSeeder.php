<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_iuran = ['sampah', 'keamanan', 'bulanan'];
        $status_pembayaran = ['Lunas', 'Belum Lunas'];

        for ($i = 1; $i <= 50; $i++) {
            DB::table('iuran')->insert([
                'kk_id' => rand(1, 30),
                'laporan_id' => null,
                'tgl_pembayaran' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                'jenis_iuran' => $jenis_iuran[array_rand($jenis_iuran)],
                'jumlah_bayar' => null,
                'status_pembayaran' => $status_pembayaran[array_rand($status_pembayaran)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
