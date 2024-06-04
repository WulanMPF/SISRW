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
        Schema::create('iuran', function (Blueprint $table) {
            $table->id('iuran_id');
            $table->unsignedBigInteger('periode_id')->index();
            $table->unsignedBigInteger('kk_id')->index();
            $table->unsignedBigInteger('laporan_id')->index();
            $table->date('tgl_pembayaran');
            $table->enum('status_pembayaran', ['Lunas', 'Diproses', 'Belum Lunas']);
            $table->timestamps();

            $table->foreign('periode_id')->references('periode_id')->on('periode_iuran');
            $table->foreign('kk_id')->references('kk_id')->on('kk');
            $table->foreign('laporan_id')->references('laporan_id')->on('laporan_keuangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran');
    }
};
