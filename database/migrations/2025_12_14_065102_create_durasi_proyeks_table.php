<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDurasiProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('durasi_proyeks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('data_id'); // FK ke proyek
            $table->foreign('data_id')->references('id')->on('data')->onDelete('cascade');

            $table->date('tanggal_mulai');   // misal 2025-05-01
            $table->date('tanggal_selesai'); // misal 2026-02-28

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('durasi_proyeks');
    }
}
