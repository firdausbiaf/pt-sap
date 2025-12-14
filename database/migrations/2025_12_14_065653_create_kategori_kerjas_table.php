<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');        // pondasi, struktur, finishing, interior
            $table->string('warna');       // red, yellow, blue, green atau hex #FF0000
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
        Schema::dropIfExists('kategori_kerjas');
    }
}
