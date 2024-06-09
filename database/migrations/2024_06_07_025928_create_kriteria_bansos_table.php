<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kriteria_bansos', function (Blueprint $table) {
            $table->id('kriteria_id'); // Menggunakan tipe data big integer dengan auto increment
            $table->string('nama_kriteria'); // Menggunakan tipe data string (varchar)
            $table->string('type'); // Menggunakan tipe data string (varchar)
            $table->decimal('bobot', 5, 2); // Menggunakan tipe data decimal dengan total 5 digit, 2 di antaranya adalah digit desimal
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_bansos');
    }
};
