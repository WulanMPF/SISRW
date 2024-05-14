<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LapKeuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan_keuangan')->insert([
            [
                'laporan_id' => 1,
                'nominal' => 10000000,
                'keterangan' => 'Iuran Bulanan Bulan Maret',
                'jenis_laporan' => 'pemasukan',
                'tgl_laporan' => '2024-04-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'laporan_id' => 2,
                'nominal' => 200000,
                'keterangan' => 'Pembelian bahan FC Surat',
                'jenis_laporan' => 'pengeluaran',
                'tgl_laporan' => '2024-04-03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'laporan_id' => 3,
                'nominal' => 10000000,
                'keterangan' => 'Iuran Bulanan Bulan Mei',
                'jenis_laporan' => 'pemasukan',
                'tgl_laporan' => '2024-05-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'laporan_id' => 4,
                'nominal' => 100000,
                'keterangan' => 'Acara Kerja Bakti',
                'jenis_laporan' => 'pengeluaran',
                'tgl_laporan' => '2024-05-07',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'laporan_id' => 5,
                'nominal' => 150000,
                'keterangan' => 'Iuran Sampah',
                'jenis_laporan' => 'pemasukan',
                'tgl_laporan' => '2024-05-09',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
