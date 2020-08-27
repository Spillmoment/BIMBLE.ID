<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalerikursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GaleriKursus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_id');
            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('GaleriKursus');
    }
}
