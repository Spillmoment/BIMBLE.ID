<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('nilai');
            $table->dropColumn('agama');
            $table->dropColumn('sertifikat');
            $table->dropColumn('username');
            $table->dropColumn('alamat');

            $table->string('alamat_province')->after('jenis_kelamin');
            $table->string('alamat_district')->after('alamat_province');
            $table->string('alamat_sub_district')->after('alamat_district');
            $table->string('alamat_village')->after('alamat_sub_district');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {            
            $table->double('nilai', 8, 2)->nullable();
            $table->string('agama', 50);
            $table->string('sertifikat');
            $table->string('username', 100)->unique();
            $table->text('alamat')->nullable();

            $table->dropColumn('alamat_province');
            $table->dropColumn('alamat_district');
            $table->dropColumn('alamat_sub_district');
            $table->dropColumn('alamat_village');
        });
    }
}
