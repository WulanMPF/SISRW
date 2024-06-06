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
        Schema::table('laporan_keuangan', function (Blueprint $table) {
            $table->string('periode')->nullable()->after('jenis_laporan'); // Sesuaikan posisi kolom
            $table->integer('tahun')->nullable()->after('periode'); // Sesuaikan posisi kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_keuangan', function (Blueprint $table) {
            $table->dropColumn('periode');
            $table->dropColumn('tahun');
        });
    }
};
