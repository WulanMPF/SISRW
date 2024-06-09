<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PenerimaBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penerima_bansos')->insert([
            [
                'bansos_id' => 1,
                'kk_id' => 10,
                'jenis_bansos' => 'Bansos Beras 10Kg',
                'penghasilan' => 350000.00,
                'jumlah_tanggungan' => 2,
                'dinding_rumah' => 'Tembok',
                'atap_rumah' => 'Genteng',
                'lantai_rumah' => 'Semen',
            ],
            [
                'bansos_id' => 2,
                'kk_id' => 12,
                'jenis_bansos' => 'Bansos DTKS',
                'penghasilan' => 600000.00,
                'jumlah_tanggungan' => 4,
                'dinding_rumah' => 'Triplek',
                'atap_rumah' => 'Seng',
                'lantai_rumah' => 'Tanah',
            ],
            [
                'bansos_id' => 3,
                'kk_id' => 13,
                'jenis_bansos' => 'Bansos DTKS',
                'penghasilan' => 450000.00,
                'jumlah_tanggungan' => 3,
                'dinding_rumah' => 'Anyaman',
                'atap_rumah' => 'Seng',
                'lantai_rumah' => 'Tanah',
            ],
            [
                'bansos_id' => 4,
                'kk_id' => 4,
                'jenis_bansos' => 'Bansos Beras 10Kg',
                'penghasilan' => 700000.00,
                'jumlah_tanggungan' => 4,
                'dinding_rumah' => 'Triplek',
                'atap_rumah' => 'Genteng',
                'lantai_rumah' => 'Tanah',
            ],
            [
                'bansos_id' => 5,
                'kk_id' => 5,
                'jenis_bansos' => 'Bansos PKH',
                'penghasilan' => 250000.00,
                'jumlah_tanggungan' => 3,
                'dinding_rumah' => 'Anyaman',
                'atap_rumah' => 'Seng',
                'lantai_rumah' => 'Tanah',
            ],
            [
                'bansos_id' => 6,
                'kk_id' => 6,
                'jenis_bansos' => 'Bansos DTKS',
                'penghasilan' => 500000.00,
                'jumlah_tanggungan' => 4,
                'dinding_rumah' => 'Anyaman',
                'atap_rumah' => 'Seng',
                'lantai_rumah' => 'Semen',
            ],
            [
                'bansos_id' => 7,
                'kk_id' => 7,
                'jenis_bansos' => 'Bansos Tunai Akibat COVID 19',
                'penghasilan' => 300000.00,
                'jumlah_tanggungan' => 1,
                'dinding_rumah' => 'Anyaman',
                'atap_rumah' => 'Seng',
                'lantai_rumah' => 'Tanah',
            ],
            [
                'bansos_id' => 8,
                'kk_id' => 8,
                'jenis_bansos' => 'Bansos PKH',
                'penghasilan' => 750000.00,
                'jumlah_tanggungan' => 5,
                'dinding_rumah' => 'Anyaman',
                'atap_rumah' => 'Ijuk',
                'lantai_rumah' => 'Bambu',
            ],
            [
                'bansos_id' => 9,
                'kk_id' => 9,
                'jenis_bansos' => 'Bansos PKH',
                'penghasilan' => 375000.00,
                'jumlah_tanggungan' => 2,
                'dinding_rumah' => 'Tembok',
                'atap_rumah' => 'Seng',
                'lantai_rumah' => 'Semen',
            ],
            [
                'bansos_id' => 10,
                'kk_id' => 10,
                'jenis_bansos' => 'Bansos Beras 10Kg',
                'penghasilan' => 300000.00,
                'jumlah_tanggungan' => 2,
                'dinding_rumah' => 'Triplek',
                'atap_rumah' => 'Genteng',
                'lantai_rumah' => 'Tanah',
            ],
        ]);
    }
}
