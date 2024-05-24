<?php

namespace Database\Seeders;

use App\Models\ArsipSuratModel;
use App\Models\SuratUndanganModel;
use Illuminate\Database\Seeder;

class ArsipSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suratUndanganRecords = SuratUndanganModel::all();

        // Membuat 20 data dummy untuk jenis surat 'Masuk'
        for ($i = 0; $i < 20; $i++) {
            // Randomly assign a surat_undangan_id for undangan-related records
            $suratUndangan = $suratUndanganRecords->random();

            ArsipSuratModel::create([
                'nama_surat' => 'Undangan ' . ($i + 1),
                'jenis_surat' => 'Masuk',
                'surat_undangan_id' => $suratUndangan->surat_undangan_id,
            ]);
        }

        // Membuat 20 data dummy untuk jenis surat 'Keluar'
        for ($i = 0; $i < 20; $i++) {
            ArsipSuratModel::create([
                'nama_surat' => $this->generateRandomSuratName(),
                'jenis_surat' => 'Keluar',
            ]);
        }
    }

    /**
     * Generate a random name for the surat.
     */
    private function generateRandomSuratName(): string
    {
        // Daftar kata yang bisa digunakan sebagai nama surat
        $possibleNames = [
            'Surat Undangan',
            'Surat Pengantar'
            // Tambahkan kata-kata lain sesuai kebutuhan
        ];

        // Pilih satu kata secara acak dari daftar kata di atas
        $randomName = $possibleNames[array_rand($possibleNames)];

        // Tambahkan angka acak sebagai tambahan untuk membedakan nama surat
        $randomNumber = mt_rand(1, 100);

        // Gabungkan nama surat dengan angka acak
        return $randomName . ' ' . $randomNumber;
    }
}
