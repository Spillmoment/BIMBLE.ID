<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kursus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_kategori');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');

            $table->foreignId('id_tutor');
            $table->foreign('id_tutor')->references('id')->on('tutor')->onDelete('cascade');

            $table->string('nama_kursus', 100);
            $table->string('slug')->nullable()->unique();
            $table->string('gambar_kursus', 100)->nullable();
            $table->integer('biaya_kursus');
            $table->tinyInteger('diskon_kursus')->nullable();
            $table->tinyInteger('lama_kursus')->nullable();
            $table->decimal('latitude', 10, 2)->nullable();
            $table->decimal('longitude', 11, 2)->nullable();
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
        Schema::dropIfExists('kursus');
    }
}
