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
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id('bansos_id');
            $table->unsignedBigInteger('kk_id');
            $table->string('jenis_bansos');
            $table->decimal('penghasilan', 15, 2);
            $table->integer('jumlah_tanggungan');
            $table->string('dinding_rumah');
            $table->string('atap_rumah');
            $table->string('lantai_rumah');
            $table->timestamps();

            // Foreign keys
            $table->foreign('kk_id')->references('kk_id')->on('kk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_bansos');
    }
};
