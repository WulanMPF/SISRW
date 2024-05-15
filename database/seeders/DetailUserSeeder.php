<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'detail_user_id' => 1,
                'level_id' => 1,
                'user_id' => 1
            ],
            [
                'detail_user_id' => 2,
                'level_id' => 2,
                'user_id' => 2
            ],
            [
                'detail_user_id' => 3,
                'level_id' => 3,
                'user_id' => 3
            ],
            [
                'detail_user_id' => 4,
                'level_id' => 4,
                'user_id' => 4
            ],[
                'detail_user_id' => 5,
                'level_id' => 5,
                'user_id' => 5
            ]
        ];
        DB::table('detail_user')->insert($data);
    }
}
