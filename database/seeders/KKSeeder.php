<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KKSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        // Generate 30 data dummy untuk tabel kk
        for ($i = 1; $i <= 30; $i++) {
            $no_kk = $this->generateNoKK(); // Generate nomor KK
            $nama_kepala_keluarga = $this->generateNama(); // Generate nama kepala keluarga
            $rt_rw = $this->generateRtRw(); // Generate RT/RW

            // Generate alamat secara acak
            $alamat = $this->generateAlamat();

            // Tambahkan data ke dalam array $data
            $data[] = [
                'kk_id' => $i,
                'no_kk' => $no_kk,
                'nama_kepala_keluarga' => $nama_kepala_keluarga,
                'rt_rw' => $rt_rw,
                'alamat' => $alamat,
            ];
        }

        // Insert data ke dalam tabel kk menggunakan DB facade
        DB::table('kk')->insert($data);
    }

    /**
     * Generate nomor KK secara acak.
     *
     * @return string
     */
    private function generateNoKK()
    {
        return mt_rand(1000000000000000, 9999999999999999); // Generate nomor KK acak dengan 16 digit (tipe data bigint)
    }

    /**
     * Generate nama kepala keluarga secara acak.
     *
     * @return string
     */
    private function generateNama()
    {
        $names = ['Budi', 'Irwan', 'Joko', 'Nugroho', 'Agus', 'Herman', 'Eko', 'Firmansyah', 'Hadi', 'Susilo'];

        // Pilih dua nama acak yang berbeda
        $randomIndex1 = array_rand($names);
        $randomIndex2 = array_rand($names);

        while ($randomIndex2 == $randomIndex1) {
            // Jika indeks kedua sama dengan indeks pertama, pilih indeks kedua baru
            $randomIndex2 = array_rand($names);
        }

        $firstName = $names[$randomIndex1];
        $lastName = $names[$randomIndex2];

        $fullName = $firstName . ' ' . $lastName;

        return $fullName;
    }


    /**
     * Generate RT/RW secara acak.
     *
     * @return string
     */
    private function generateRtRw()
    {
        $rt = str_pad(mt_rand(1, 10), 2, '0', STR_PAD_LEFT); // Generate RT antara 01-10
        $rw = '05'; // Tetapkan nilai RW

        return $rt . '/' . $rw; // Format RT/RW seperti 01/05, 02/05, dst.
    }

    /**
     * Generate alamat secara acak.
     *
     * @return string
     */
    private function generateAlamat()
    {
        $streets = ['Jl. Ikan Sepat', 'Jl. Ikan Nus', 'Jl. Ikan Paus', 'Jl. Ikan Lele', 'Jl. Ikan Lodan', 'Jl. Ikan Nus Indah'];
        $randomStreet = $streets[array_rand($streets)];
        $houseNumber = mt_rand(1, 100);
        return $randomStreet . ' No. ' . $houseNumber;
    }
}
