<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'nama_level' => 'Admin',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_level' => 'Ketua RW',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_level' => 'Sekretaris RW',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_level' => 'Bendahara RW',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'nama_level' => 'Warga',
                'created_at' => null,
                'updated_at' => null,
            ],
        ];

        // Insert data ke dalam tabel level menggunakan DB facade
        DB::table('level')->insert($data);
    }
}
