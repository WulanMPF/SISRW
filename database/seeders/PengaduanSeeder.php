<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaduanModel;
use App\Models\WargaModel;
use Faker\Factory as Faker;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua ID dari model WargaModel
        $wargaIds = WargaModel::pluck('warga_id')->toArray();

        $data = [];

        // Generate dummy data untuk PengaduanModel
        for ($i = 0; $i < 10; $i++) {
            $wargaId = $faker->randomElement($wargaIds);
            $namaPelapor = $faker->name;
            $jenisPengaduan = $faker->randomElement(['Kerusakan Jalan', 'Kebisingan', 'Pencurian']);
            $tanggalPengaduan = $faker->dateTimeBetween('-30 days', 'now');
            $prioritas = $faker->randomElement(['Tinggi', 'Sedang', 'Rendah']);
            $statusPengaduan = $faker->randomElement(['Ditunda', 'Diproses', 'Selesai']);
            $deskripsi = $faker->sentence;
            $lampiran = $faker->fileExtension;
            $tindakanDiambil = $faker->sentence;
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

            $data[] = [
                'warga_id' => $wargaId,
                'nama_pelapor' => $namaPelapor,
                'jenis_pengaduan' => $jenisPengaduan,
                'tgl_pengaduan' => $tanggalPengaduan,
                'prioritas' => $prioritas,
                'status_pengaduan' => $statusPengaduan,
                'deskripsi' => $deskripsi,
                'lampiran' => $lampiran,
                'tindakan_diambil' => $tindakanDiambil,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ];
        }

        // Insert data ke dalam tabel pengaduan menggunakan model PengaduanModel
        PengaduanModel::insert($data);
    }
}
