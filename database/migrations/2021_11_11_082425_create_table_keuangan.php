<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKeuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('unit_id');
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');
            
            $table->foreignId('rule_gaji_id');
            $table->foreign('rule_gaji_id')->references('id')->on('rule_gaji')->onDelete('cascade');

            $table->integer('nominal');
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('keuangan');
    }
}
