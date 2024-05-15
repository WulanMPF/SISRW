<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UMKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get list of warga IDs
        $warga_ids = DB::table('warga')->pluck('warga_id')->toArray();

        // Insert sample data
        DB::table('umkm')->insert([
            [
                'warga_id' => $warga_ids[array_rand($warga_ids)],
                'nama_usaha' => 'Warung Sederhana',
                'alamat_usaha' => 'Jl. Pahlawan No. 1',
                'jenis_usaha' => 'Kuliner',
                'status_usaha' => 'Aktif',
                'deskripsi' => 'Menyediakan makanan rumahan dengan harga terjangkau',
                'lampiran' => 'warung_makan_sederhana.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'warga_id' => $warga_ids[array_rand($warga_ids)],
                'nama_usaha' => 'Bengkel Motor Jaya',
                'alamat_usaha' => 'Jl. Merdeka No. 20',
                'jenis_usaha' => 'Otomotif',
                'status_usaha' => 'Aktif',
                'deskripsi' => 'Melayani perbaikan dan servis motor',
                'lampiran' => 'bengkel_motor_jaya.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'warga_id' => $warga_ids[array_rand($warga_ids)],
                'nama_usaha' => 'Toko Buku Pintar',
                'alamat_usaha' => 'Jl. Pendidikan No. 3',
                'jenis_usaha' => 'Retail',
                'status_usaha' => 'Aktif',
                'deskripsi' => 'Menjual buku-buku pendidikan dan alat tulis',
                'lampiran' => 'toko_buku_pintar.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}
