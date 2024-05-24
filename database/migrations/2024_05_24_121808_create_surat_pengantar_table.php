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
        Schema::create('surat_pengantar', function (Blueprint $table) {
            $table->id('pengantar_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('pengantar_nama', 20);
            $table->string('pengantar_no_surat', 20);
            $table->string('pengantar_isi_nik', 20);
            $table->string('pengantar_isi_nama', 100);
            $table->string('pengantar_isi_ttl', 100);
            $table->enum('pengantar_isi_jk', ['L', 'P']);
            $table->string('pengantar_isi_agama', 20);
            $table->string('pengantar_isi_pekerjaan', 50);
            $table->string('pengantar_isi_alamat', 100);
            $table->string('pengantar_isi_keperluan', 100);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar');
    }
};
