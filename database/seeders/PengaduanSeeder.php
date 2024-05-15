<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaduanModel;
use App\Models\WargaModel;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengaduan')->insert([
            [
                'pengaduan_id' => 1,
                'warga_id' => 1,
                'jenis_pengaduan' => 'Kebersihan',
                'tgl_pengaduan' => '2024-04-01',
                'prioritas' => 'Tinggi',
                'status_pengaduan' => 'Ditunda',
                'deskripsi' => 'Sampah menumpuk di area RT 01.',
                'lampiran' => 'sampah_rt01.jpg',
                'tindakan_diambil' => 'Belum ada tindakan.'
            ],
            [
                'pengaduan_id' => 2,
                'warga_id' => 2,
                'jenis_pengaduan' => 'Keamanan',
                'tgl_pengaduan' => '2024-04-05',
                'prioritas' => 'Sedang',
                'status_pengaduan' => 'Diproses',
                'deskripsi' => 'Ada orang asing mencurigakan di sekitar RT 03.',
                'lampiran' => 'orang_asing_rt03.jpg',
                'tindakan_diambil' => 'Patroli keamanan dilakukan.'
            ],
            [
                'pengaduan_id' => 3,
                'warga_id' => 3,
                'jenis_pengaduan' => 'Infrastruktur',
                'tgl_pengaduan' => '2024-04-10',
                'prioritas' => 'Rendah',
                'status_pengaduan' => 'Selesai',
                'deskripsi' => 'Jalan rusak di depan rumah nomor 12.',
                'lampiran' => 'jalan_rusak.jpg',
                'tindakan_diambil' => 'Jalan sudah diperbaiki.'
            ],
            [
                'pengaduan_id' => 4,
                'warga_id' => 4,
                'jenis_pengaduan' => 'Kesehatan',
                'tgl_pengaduan' => '2024-04-16',
                'prioritas' => 'Tinggi',
                'status_pengaduan' => 'Diproses',
                'deskripsi' => 'Banyak warga terkena demam berdarah.',
                'lampiran' => 'dbd_warga.jpg',
                'tindakan_diambil' => 'Fogging akan dilakukan.'
            ],
            [
                'pengaduan_id' => 5,
                'warga_id' => 5,
                'jenis_pengaduan' => 'Pelayanan',
                'tgl_pengaduan' => '2024-04-20',
                'prioritas' => 'Sedang',
                'status_pengaduan' => 'Ditunda',
                'deskripsi' => 'Pelayanan administrasi lambat.',
                'lampiran' => 'administrasi_lambat.jpg',
                'tindakan_diambil' => 'Akan ditindaklanjuti.'
            ],
        ]);
    }
}
