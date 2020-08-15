<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id');
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');

            $table->string('nama_mentor', 100);
            $table->string('kompetensi', 100);
            $table->string('foto', 100)->nullable();

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
        Schema::dropIfExists('mentor');
    }
}
