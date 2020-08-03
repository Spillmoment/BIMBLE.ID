<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_order');
            $table->foreign('id_order')->references('id')->on('order')->onDelete('cascade');

            $table->foreignId('id_pendaftar');
            $table->foreign('id_pendaftar')->references('id')->on('pendaftar')->onDelete('cascade');
            
            $table->foreignId('id_kursus');
            $table->foreign('id_kursus')->references('id')->on('kursus')->onDelete('cascade');

            $table->integer('biaya_kursus');
            $table->enum('status', ['PENDING', 'SUCCESS' , 'PROCESS', 'CANCEL' ,'FAILED']);
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
        Schema::dropIfExists('temp_detail');
    }
}
