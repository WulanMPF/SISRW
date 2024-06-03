<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('umkm')->insert([
            [
                'umkm_id' => 1,
                'warga_id' => 1,
                'nama_usaha' => 'Toko Baju Indah',
                'alamat_usaha' => 'Jl. Merdeka No. 1',
                'jenis_usaha' => 'Retail',
                'jam_buka' => '08:00:00',
                'jam_tutup' => '21:00:00',
                'status_usaha' => 'Aktif',
                'deskripsi' => 'Menjual berbagai macam pakaian',
                'lampiran' => 'lampiran1.pdf',
            ],
            [
                'umkm_id' => 2,
                'warga_id' => 2,
                'nama_usaha' => 'Warung Makan Sederhana',
                'alamat_usaha' => 'Jl. Kenangan No. 12',
                'jenis_usaha' => 'Kuliner',
                'jam_buka' => '06:00:00',
                'jam_tutup' => '22:00:00',
                'status_usaha' => 'diproses',
                'deskripsi' => 'Warung makan dengan menu khas Indonesia',
                'lampiran' => 'lampiran2.pdf',
            ],
            [
                'umkm_id' => 3,
                'warga_id' => 3,
                'nama_usaha' => 'Bengkel Motor Jaya',
                'alamat_usaha' => 'Jl. Raya Selatan No. 5',
                'jenis_usaha' => 'Jasa',
                'jam_buka' => '08:00:00',
                'jam_tutup' => '17:00:00',
                'status_usaha' => 'diproses',
                'deskripsi' => 'Melayani perbaikan dan servis motor',
                'lampiran' => 'lampiran3.pdf',
            ],
            [
                'umkm_id' => 4,
                'warga_id' => 4,
                'nama_usaha' => 'Kedai Kopi Nusantara',
                'alamat_usaha' => 'Jl. Kopi No. 22',
                'jenis_usaha' => 'Kuliner',
                'jam_buka' => '07:00:00',
                'jam_tutup' => '23:00:00',
                'status_usaha' => 'Aktif',
                'deskripsi' => 'Kedai kopi dengan cita rasa nusantara',
                'lampiran' => 'lampiran4.pdf',
            ],
            [
                'umkm_id' => 5,
                'warga_id' => 5,
                'nama_usaha' => 'Salon Cantik',
                'alamat_usaha' => 'Jl. Kecantikan No. 9',
                'jenis_usaha' => 'Jasa',
                'jam_buka' => '09:00:00',
                'jam_tutup' => '20:00:00',
                'status_usaha' => 'Aktif',
                'deskripsi' => 'Menyediakan layanan kecantikan',
                'lampiran' => 'lampiran5.pdf',
            ],
        ]);
    }
}
