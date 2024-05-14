<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengumuman;
use App\Models\PengumumanModel;
use App\Models\User;
use Carbon\Carbon;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua user dari database
        $users = User::all();

        // Data dummy pengumuman
        $pengumuman = [];

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $judul = "Pengumuman " . ($i + 1);
                $isi_pengumuman = "Ini adalah deskripsi pengumuman" . ($i + 1) . " dari " . $user->name . ".";
                $tgl_pengumuman = Carbon::now()->subDays(rand(1, 30));

                $pengumuman[] = [
                    'user_id' => $user->id,
                    'judul' => $judul,
                    'isi_pengumuman' => $isi_pengumuman,
                    'gambar' => 'gambar_pengumuman.jpg', // Ganti dengan nama gambar yang sesuai
                    'created_at' => $tgl_pengumuman,
                    'updated_at' => $tgl_pengumuman,
                ];
            }
        }

        // Masukkan data pengumuman ke dalam tabel menggunakan model Pengumuman
        PengumumanModel::insert($pengumuman);
    }
}
