<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SyaratBansos;
use App\Models\PenerimaBansosModel; // Menggunakan model PenerimaBansos untuk mendapatkan bansos_id
use App\Models\SyaratBansosModel;
use Carbon\Carbon;

class SyaratBansosSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Ambil ID bansos untuk digunakan sebagai foreign key
        $bansosBeras = PenerimaBansosModel::where('jenis_bansos', 'Bansos Beras 10kg')->first();
        $bansosDTKS = PenerimaBansosModel::where('jenis_bansos', 'Bansos DTKS')->first();
        $bansosPKH = PenerimaBansosModel::where('jenis_bansos', 'Bansos PKH')->first();
        $bansosCovid = PenerimaBansosModel::where('jenis_bansos', 'Bansos Tunai Akibat Covid 19')->first();

        if ($bansosBeras) {
            $bansosBerasId = $bansosBeras->id;

            SyaratBansosModel::create([
                'tgl_syarat_ketentuan' => Carbon::now(),
                'jenis_bansos' => 'Bansos Beras 10kg',
                'deskripsi' => 'Syarat bansos beras 10kg',
                'gambar' => 'gambar_syarat_1.jpg',
            ]);
        }

        if ($bansosDTKS) {
            $bansosDTKSId = $bansosDTKS->id;

            SyaratBansosModel::create([
                'tgl_syarat_ketentuan' => Carbon::now(),
                'jenis_bansos' => 'Bansos DTKS',
                'deskripsi' => 'Syarat bansos DTKS',
                'gambar' => 'gambar_syarat_2.jpg',
            ]);
        }

        if ($bansosPKH) {
            $bansosPKHId = $bansosPKH->id;

            SyaratBansosModel::create([
                'tgl_syarat_ketentuan' => Carbon::now(),
                'jenis_bansos' => 'Bansos PKH',
                'deskripsi' => 'Syarat bansos PKH',
                'gambar' => 'gambar_syarat_3.jpg',
            ]);
        }

        if ($bansosCovid) {
            $bansosCovidId = $bansosCovid->id;

            SyaratBansosModel::create([
                'tgl_syarat_ketentuan' => Carbon::now(),
                'jenis_bansos' => 'Bansos Tunai Akibat Covid 19',
                'deskripsi' => 'Syarat bansos tunai akibat Covid-19',
                'gambar' => 'gambar_syarat_4.jpg',
            ]);
        }
    }
}
