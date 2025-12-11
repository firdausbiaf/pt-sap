<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('kavling');
            $table->enum('lokasi',['DJAGAD LAND BATU','DJAGAD LAND SINGHASARI','DPARK CITY'])->default('DJAGAD LAND BATU');
            $table->string('kluster');
            $table->unsignedBigInteger('tipe');
            $table->string('spk');
            $table->string('ptb');
            $table->unsignedBigInteger('harga_deal');
            $table->unsignedBigInteger('progres');
            $table->string('sales');
            $table->text('ktp')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
