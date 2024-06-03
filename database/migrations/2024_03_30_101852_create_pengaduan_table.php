<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('pengaduan_id');
            $table->unsignedBigInteger('warga_id')->index();
            $table->string('jenis_pengaduan');
            $table->date('tgl_pengaduan');
            $table->enum('prioritas', ['Tinggi', 'Sedang', 'Rendah']);
            $table->enum('status_pengaduan', ['Ditunda', 'Diproses', 'Selesai']);
            $table->string('deskripsi', 200);
            $table->string('lampiran', 200);
            $table->string('tindakan_diambil', 200);
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('warga_id')->references('warga_id')->on('warga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}
