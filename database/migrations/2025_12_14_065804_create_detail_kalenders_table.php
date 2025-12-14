<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kalenders', function (Blueprint $table) {
            $table->id();
            // relasi proyek
            $table->unsignedBigInteger('data_id');
            $table->foreign('data_id')
                ->references('id')
                ->on('data')
                ->onDelete('cascade');

            // relasi header (durasi proyek)
            $table->unsignedBigInteger('durasi_proyek_id');
            $table->foreign('durasi_proyek_id')
                ->references('id')
                ->on('durasi_proyeks')
                ->onDelete('cascade');

            // tanggal spesifik
            $table->date('tanggal');

            // klasifikasi pekerjaan
            $table->unsignedBigInteger('kategori_kerja_id');
            $table->foreign('kategori_kerja_id')
                ->references('id')
                ->on('kategori_kerjas');

            // PIC (bebas, bisa nama atau FK ke users nanti)
            $table->string('pic_nama');

            // catatan tambahan (opsional)
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // agar 1 tanggal hanya 1 aktivitas per proyek
            $table->unique(['data_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_kalenders');
    }
}
