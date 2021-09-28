<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRelationToMateri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropForeign('materi_kursus_unit_id_foreign');
            $table->dropColumn('kursus_unit_id');

            $table->foreignId('kursus_id')->after('id')->nullable();
            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
            
            $table->foreignId('unit_id')->after('kursus_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->foreignId('kursus_unit_id');
            $table->foreign('kursus_unit_id')->references('id')->on('kursus_unit')->onDelete('cascade');

            $table->dropColumn('kursus_id');
            $table->dropColumn('unit_id');
        });
    }
}
