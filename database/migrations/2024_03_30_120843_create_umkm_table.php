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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('umkm_id');
            $table->unsignedBigInteger('warga_id')->index();
            $table->string('nama_usaha', 50);
            $table->string('alamat_usaha', 50);
            $table->string('jenis_usaha', 50);
            $table->enum('jenis_usaha', ['Agribisnis', 'Hobi-Olahraga', 'Fashion', 'Kecantikan', 'Kerajinan', 'Kuliner', 'Teknologi', 'Jasa', 'Lainnya']);
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->string('no_telepon', 20);
            $table->enum('status_usaha', ['Aktif', 'Nonaktif', 'Diproses']);
            $table->string('deskripsi', 200);
            $table->string('lampiran', 200);
            $table->timestamps();

            $table->foreign('warga_id')->references('warga_id')->on('warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
