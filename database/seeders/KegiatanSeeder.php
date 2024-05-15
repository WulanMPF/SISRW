<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan')->insert([
            [
                'warga_id' => 1, // Sesuaikan dengan warga_id yang ada di tabel warga
                'nama_kegiatan' => 'Kerja Bakti',
                'deskripsi' => 'Kegiatan kerja bakti di lingkungan RT 01 RW 05.',
                'tanggal' => '2024-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data kegiatan lainnya sesuai kebutuhan
        ]);
    }
}
