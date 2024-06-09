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
            $table->id('arsip_surat_id');
            $table->string('nomor_surat', 50);
            $table->date('tanggal_surat');
            $table->string('pengirim', 25);
            $table->string('penerima', 25);
            $table->string('perihal', 50);
            $table->string('lampiran', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
