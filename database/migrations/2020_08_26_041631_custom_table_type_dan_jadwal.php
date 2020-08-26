<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomTableTypeDanJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kursus_unit', function (Blueprint $table) {
            $table->foreignId('type_id')->after('unit_id');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');

            $table->enum('status',['aktif', 'nonaktif'])->default('aktif')->after('biaya_kursus');
        });

        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kursus_unit_id');
            $table->foreign('kursus_unit_id')->references('id')->on('kursus_unit')->onDelete('cascade');

            $table->string('hari', 10);
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
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
        Schema::table('kursus_unit', function (Blueprint $table) {
            $table->dropColumn('type_id');
            $table->dropColumn('status');
        });

        Schema::dropIfExists('jadwal');
    }
}
