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
        Schema::table('warga', function (Blueprint $table) {

            // Tambahkan kolom foreign key warga_id
            $table->unsignedBigInteger('level_id')->index()->nullable();
            // Definisikan constraint foreign key
            $table->foreign('level_id')->references('level_id')->on('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['level_id']);

            // Hapus kolom foreign key
            $table->dropColumn('level_id');
        });
    }
};
