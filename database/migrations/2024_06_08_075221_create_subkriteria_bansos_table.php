<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subkriteria_bansos', function (Blueprint $table) {
            $table->id('subkriteria_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->string('sub_kriteria');
            $table->string('keterangan');
            $table->integer('bobot');
            $table->timestamps();

            $table->foreign('kriteria_id')->references('kriteria_id')->on('kriteria_bansos')->onDelete('cascade');
        });

        // Insert data
        DB::table('subkriteria_bansos')->insert([
            // Penghasilan (Cost)
            ['kriteria_id' => 1, 'sub_kriteria' => '< Rp 500.000,00', 'keterangan' => 'Sangat Buruk', 'bobot' => 1],
            ['kriteria_id' => 1, 'sub_kriteria' => 'Rp500.000,00', 'keterangan' => 'Buruk', 'bobot' => 2],
            ['kriteria_id' => 1, 'sub_kriteria' => '> Rp 500.000,00', 'keterangan' => 'Cukup', 'bobot' => 3],
            // Jumlah Tanggungan (Benefit)
            ['kriteria_id' => 2, 'sub_kriteria' => '> 3 orang', 'keterangan' => 'Sangat Buruk', 'bobot' => 1],
            ['kriteria_id' => 2, 'sub_kriteria' => '3 orang', 'keterangan' => 'Buruk', 'bobot' => 2],
            ['kriteria_id' => 2, 'sub_kriteria' => '< 3 orang', 'keterangan' => 'Cukup', 'bobot' => 3],
            // Kondisi Dinding Rumah (Benefit)
            ['kriteria_id' => 3, 'sub_kriteria' => 'Anyaman', 'keterangan' => 'Sangat Buruk', 'bobot' => 1],
            ['kriteria_id' => 3, 'sub_kriteria' => 'Triplek', 'keterangan' => 'Buruk', 'bobot' => 2],
            ['kriteria_id' => 3, 'sub_kriteria' => 'Tembok', 'keterangan' => 'Cukup', 'bobot' => 3],
            // Kondisi Atap Rumah (Benefit)
            ['kriteria_id' => 4, 'sub_kriteria' => 'Ijuk', 'keterangan' => 'Sangat Buruk', 'bobot' => 1],
            ['kriteria_id' => 4, 'sub_kriteria' => 'Seng', 'keterangan' => 'Buruk', 'bobot' => 2],
            ['kriteria_id' => 4, 'sub_kriteria' => 'Genteng', 'keterangan' => 'Cukup', 'bobot' => 3],
            // Kondisi Lantai Rumah (Benefit)
            ['kriteria_id' => 5, 'sub_kriteria' => 'Tanah', 'keterangan' => 'Sangat Buruk', 'bobot' => 1],
            ['kriteria_id' => 5, 'sub_kriteria' => 'Bambu', 'keterangan' => 'Buruk', 'bobot' => 2],
            ['kriteria_id' => 5, 'sub_kriteria' => 'Semen', 'keterangan' => 'Cukup', 'bobot' => 3],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkriteria_bansos');
    }
};
