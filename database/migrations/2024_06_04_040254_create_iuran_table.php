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
            $table->id('iuran_id'); // Primary key
            $table->unsignedBigInteger('periode_id'); // Foreign key from periode_iuran
            $table->unsignedBigInteger('kk_id'); // Foreign key from kk
            $table->unsignedBigInteger('laporan_id')->nullable(); // Foreign key from laporan_keuangan
            $table->date('tgl_pembayaran')->nullable();
            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas', 'Pending']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('periode_id')->references('periode_id')->on('periode_iuran')->onDelete('cascade');
            $table->foreign('kk_id')->references('kk_id')->on('kk')->onDelete('cascade');
            $table->foreign('laporan_id')->references('laporan_id')->on('laporan_keuangan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iuran', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['periode_id']);
            $table->dropForeign(['kk_id']);
            $table->dropForeign(['laporan_id']);
        });

        Schema::dropIfExists('iuran');
    }
};
