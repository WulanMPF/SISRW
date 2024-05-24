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
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id('arsip_id');
            $table->unsignedBigInteger('undangan_id')->index();
            $table->unsignedBigInteger('pengantar_id')->index();
            $table->enum('jenis_surat', ['Masuk', 'Keluar']);
            $table->timestamps();

            $table->foreign('undangan_id')->references('undangan_id')->on('surat_undangan');
            $table->foreign('pengantar_id')->references('pengantar_id')->on('surat_pengantar');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
