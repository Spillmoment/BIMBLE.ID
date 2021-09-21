<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_kursus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mentor_id');
            $table->foreign('mentor_id')->references('id')->on('mentor')->onDelete('cascade');

            $table->foreignId('kursus_unit_id');
            $table->foreign('kursus_unit_id')->references('id')->on('kursus_unit')->onDelete('cascade');

            $table->string('keahlian');
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
        Schema::dropIfExists('mentor_kursus');
    }
}
