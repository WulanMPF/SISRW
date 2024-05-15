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
        $data = [
            [
                'user_id' => 1,
                'level_id' => 1,
                'warga_id' => 1,
                'username' => 'admin',
                'password' => Hash::make('admin')
            ],
            [
                'user_id' => 2,
                'level_id' => 2,
                'warga_id' => 2,
                'username' => 'ketua',
                'password' => Hash::make('ketua')
            ],
            [
                'user_id' => 3,
                'level_id' => 3,
                'warga_id' => 3,
                'username' => 'sekretaris',
                'password' => Hash::make('sekretaris')
            ],
            [
                'user_id' => 4,
                'level_id' => 4,
                'warga_id' => 4,
                'username' => 'bendahara',
                'password' => Hash::make('bendahara')
            ],
            [
                'user_id' => 5,
                'level_id' => 5,
                'warga_id' => 5,
                'username' => 'warga',
                'password' => Hash::make('warga')
            ]
        ];
        DB::table('user')->insert($data);
    }
}
