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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('nilai_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('bansos_id');
            $table->integer('nilai');

            // Foreign keys
            $table->foreign('kriteria_id')->references('kriteria_id')->on('kriteria_bansos')->onDelete('cascade');
            $table->foreign('bansos_id')->references('bansos_id')->on('penerima_bansos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
