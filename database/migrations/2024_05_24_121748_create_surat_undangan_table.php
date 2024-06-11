<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_undangan', function (Blueprint $table) {
            $table->id('undangan_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('undangan_nama', 50);
            $table->string('undangan_tempat', 25);
            $table->date('undangan_tanggal');
            $table->string('undangan_no_surat', 20);
            $table->string('undangan_perihal', 100);
            $table->string('undangan_isi_hari', 6);
            $table->date('undangan_isi_tgl');
            $table->time('undangan_isi_waktu');
            $table->string('undangan_isi_tempat', 255);
            $table->text('undangan_isi_acara');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_undangan');
    }
};
