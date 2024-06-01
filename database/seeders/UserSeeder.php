<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'user_id' => 3,
                'level_id' => 2,
                'warga_id' => 1,
                'nik' => '6950452900237864',
                'password' => Hash::make('ketua'),
            ],
            [
                'user_id' => 4,
                'level_id' => 3,
                'warga_id' => 2,
                'nik' => '7239141999266455',
                'password' => Hash::make('sekretaris'),
            ],
            [
                'user_id' => 5,
                'level_id' => 4,
                'warga_id' => 3,
                'nik' => '7772301997320154',
                'password' => Hash::make('bendahara'),
            ],


        ]);
    }
}
