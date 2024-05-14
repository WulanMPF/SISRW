<?php

namespace Database\Factories;

use App\Models\PengaduanModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PengaduanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PengaduanModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $namaPelapor = $this->faker->name;
        $jenisPengaduan = $this->faker->sentence;
        $tanggalPengaduan = now()->toDateString();
        $prioritas = $this->faker->randomElement(['Tinggi', 'Sedang', 'Rendah']);
        $statusPengaduan = $this->faker->randomElement(['Ditunda', 'Diproses', 'Selesai']);

        return [
            'nama_pelapor' => $namaPelapor,
            'jenis_pengaduan' => $jenisPengaduan,
            'tanggal_pengaduan' => $tanggalPengaduan,
            'prioritas' => $prioritas,
            'status_pengaduan' => $statusPengaduan,
        ];
    }
}
