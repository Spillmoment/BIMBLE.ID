<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKomentarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_komentar', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_kursus');
            $table->foreign('id_kursus')->references('id')->on('kursus')->onDelete('cascade');
            
            $table->foreignId('id_pendaftar');
            $table->foreign('id_pendaftar')->references('id')->on('pendaftar')->onDelete('cascade');
            
            $table->text('isi_komentar');
            $table->date('tanggal_komentar');
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
        Schema::dropIfExists('detail_komentar');
    }
}
