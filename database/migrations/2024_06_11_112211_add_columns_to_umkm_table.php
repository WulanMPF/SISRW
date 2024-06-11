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
        Schema::table('umkm', function (Blueprint $table) {
            $table->time('jam_buka')->nullable()->after('jenis_usaha'); // Ganti 'existing_column' dengan kolom yang sudah ada sebelumnya
            $table->time('jam_tutup')->nullable()->after('jam_buka');
            $table->string('no_telepon', 20)->nullable()->after('jam_tutup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['jam_buka', 'jam_tutup', 'no_telepon']);
        });
    }
};
