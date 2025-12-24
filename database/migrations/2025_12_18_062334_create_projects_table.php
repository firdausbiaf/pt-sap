<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // data utama proyek
            $table->string('name');              // nama proyek
            $table->string('location');          // lokasi proyek
            $table->decimal('project_value', 18, 2); // nilai proyek

            // durasi proyek
            $table->date('start_date');
            $table->date('end_date');

            // flag penggunaan subcon
            $table->boolean('use_subcon')->default(false);

            // status proyek
            $table->string('status')->default('planning');

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
        Schema::dropIfExists('projects');
    }
}
