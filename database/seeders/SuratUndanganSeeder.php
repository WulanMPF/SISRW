<?php

namespace Database\Seeders;

use App\Models\SuratUndanganModel;
use Illuminate\Database\Seeder;

class SuratUndanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Start the incrementing number from 1
        $incrementingNumber = 1;

        // Create 20 dummy records for the surat_undangan table
        for ($i = 0; $i < 20; $i++) {
            SuratUndanganModel::create([
                'user_id' => rand(1, 5),  // Adjust this range according to your user table
                'nomor_surat' => $this->generateNomorSurat($incrementingNumber),
                'perihal' => 'Perihal ' . ($i + 1),
                'isi_surat' => 'Isi Surat ' . ($i + 1),
                'nama_surat' => 'Surat Undangan ' . ($i + 1),
            ]);

            // Increment the number for the next iteration
            $incrementingNumber++;
        }
    }

    /**
     * Generate the nomor_surat value.
     */
    private function generateNomorSurat(int $incrementingNumber): string
    {
        // Format the nomor_surat with the incrementing number
        return 'RW05/SEK/UND/' . str_pad($incrementingNumber, 3, '0', STR_PAD_LEFT);
    }
}
