<?php

namespace Database\Seeders;

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
        // Data jenis iuran dan status pembayaran
        $jenis_iuran = ['sampah', 'keamanan', 'bulanan'];
        $status_pembayaran = ['Lunas', 'Belum Lunas'];

        // Ambil semua kk_id dari tabel kk
        $kk_ids = DB::table('kk')->pluck('kk_id')->toArray();

        // Ambil semua laporan_id dari tabel laporan_keuangan
        $laporan_ids = DB::table('laporan_keuangan')->pluck('laporan_id')->toArray();

        // Pastikan ada data di tabel kk dan laporan_keuangan
        if (empty($kk_ids)) {
            // Jika tidak ada data, tambahkan data dummy ke tabel kk terlebih dahulu
            DB::table('kk')->insert([
                ['kk_id' => 1, 'nama' => 'Keluarga A', 'alamat' => 'Alamat A'],
                ['kk_id' => 2, 'nama' => 'Keluarga B', 'alamat' => 'Alamat B'],
                // Tambahkan data sesuai kebutuhan
            ]);

            // Refresh kk_ids setelah insert
            $kk_ids = DB::table('kk')->pluck('kk_id')->toArray();
        }

        if (empty($laporan_ids)) {
            // Jika tidak ada data, tambahkan data dummy ke tabel laporan_keuangan terlebih dahulu
            DB::table('laporan_keuangan')->insert([
                ['laporan_id' => 1, 'nama_laporan' => 'Laporan Januari'],
                ['laporan_id' => 2, 'nama_laporan' => 'Laporan Februari'],
                // Tambahkan data sesuai kebutuhan
            ]);

            // Refresh laporan_ids setelah insert
            $laporan_ids = DB::table('laporan_keuangan')->pluck('laporan_id')->toArray();
        }

        // Loop untuk memasukkan data ke tabel iuran
        for ($i = 1; $i <= 50; $i++) {
            DB::table('iuran')->insert([
                'kk_id' => $kk_ids[array_rand($kk_ids)], // Pilih kk_id yang valid secara acak
                'laporan_id' => $laporan_ids[array_rand($laporan_ids)], // Pilih laporan_id yang valid secara acak
                'tgl_pembayaran' => Carbon::now()->subDays(rand(1, 365))->format('Y-m-d'),
                'jenis_iuran' => $jenis_iuran[array_rand($jenis_iuran)],
                'jumlah_bayar' => rand(10000, 100000), // Jumlah bayar acak
                'status_pembayaran' => $status_pembayaran[array_rand($status_pembayaran)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
