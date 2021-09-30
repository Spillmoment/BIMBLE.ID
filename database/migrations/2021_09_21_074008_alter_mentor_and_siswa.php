<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMentorAndSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->string('pengalaman')->after('kompetensi');
        });

        Schema::table('mentor_kursus', function (Blueprint $table) {
            $table->dropColumn('keahlian');
        });

        Schema::table('siswa_kursus', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('keterangan');

            $table->enum('status_sertifikat', ['daftar', 'terima', 'lulus', 'sertifikat'])->after('kursus_unit_id');
            $table->double('nilai', 8, 2)->nullable()->after('status_sertifikat');
            $table->string('predikat')->nullable()->after('nilai');
            $table->string('file')->nullable()->after('predikat');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->dropColumn('pengalaman');
        });
        
        Schema::table('mentor_kursus', function (Blueprint $table) {
            $table->string('keahlian')->after('kursus_unit_id');
        });
        
        Schema::table('siswa_kursus', function (Blueprint $table) {
            $table->dropColumn('status_sertifikat');
            $table->dropColumn('nilai');
            $table->dropColumn('predikat');
            $table->dropColumn('file');

            $table->enum('status', ['0', '1'])->after('kursus_unit_id');
            $table->string('keterangan')->after('status');
        });
    }
}
