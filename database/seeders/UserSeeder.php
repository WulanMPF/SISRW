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
                'level_id' => 5,
                'warga_id' => 1,
                'email' => 'user1@example.com',
                'password' => Hash::make('password1'),
            ],
            [
                'level_id' => 5,
                'warga_id' => 2,
                'email' => 'user2@example.com',
                'password' => Hash::make('password2'),
            ],
            [
                'level_id' => 5,
                'warga_id' => 3,
                'email' => 'user3@example.com',
                'password' => Hash::make('password3'),
            ],
            // Tambahkan data pengguna lain sesuai kebutuhan
        ]);
    }
}
