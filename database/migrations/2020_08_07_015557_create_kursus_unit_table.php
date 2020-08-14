<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursusUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kursus_unit', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('kursus_id');
            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');

            $table->foreignId('unit_id');
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');

            $table->integer('biaya_kursus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kursus_unit');
    }
}
