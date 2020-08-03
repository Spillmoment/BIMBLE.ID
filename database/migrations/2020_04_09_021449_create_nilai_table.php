<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_tutor');
            $table->foreign('id_tutor')->references('id')->on('tutor')->onDelete('cascade');

            $table->foreignId('id_kursus');
            $table->foreign('id_kursus')->references('id')->on('kursus')->onDelete('cascade');

            $table->foreignId('id_pendaftar')->nullable();
            $table->foreign('id_pendaftar')->references('id')->on('pendaftar')->onDelete('cascade');
            
            $table->foreignId('id_siswa')->nullable();
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
            
            $table->double('nilai', 8, 2);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('nilai');
    }
}
