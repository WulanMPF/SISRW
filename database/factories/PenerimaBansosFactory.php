<?php

namespace Database\Factories;

use App\Models\PenerimaBansos;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PenerimaBansosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PenerimaBansos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Definisikan bagaimana data akan digenerate
        return [
            'kk_id' => 1, // Ganti dengan cara Anda memilih kk_id
            'jenis_bansos' => 'Bansos Beras 10 kg',
            'created_at' => null,
            'updated_at' => null,
        ];
    }
}
