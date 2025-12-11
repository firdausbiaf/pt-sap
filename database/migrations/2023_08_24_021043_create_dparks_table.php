<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDparksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dparks', function (Blueprint $table) {
            $table->id();
            $table->enum('cluster',['ALEXANDRIA','SEVILLA','ANDALUSIA', 'GRANADA'])->default('ALEXANDRIA');
            $table->string('kavling');
            $table->unsignedTinyInteger('status')->default(1); // Tambahkan kolom status
            $table->string('keterangan'); // Tambahkan kolom komplain
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
        Schema::dropIfExists('dparks');
    }
}
