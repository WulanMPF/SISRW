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
        Schema::table('user', function (Blueprint $table) {

            // Tambahkan kolom foreign key warga_id
            $table->unsignedBigInteger('warga_id')->index();
            // Definisikan constraint foreign key
            $table->foreign('warga_id')->references('warga_id')->on('warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['warga_id']);

            // Hapus kolom foreign key
            $table->dropColumn('warga_id');
        });
    }
};
