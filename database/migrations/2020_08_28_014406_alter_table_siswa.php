<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('kursus_unit_id');            
            $table->dropColumn('nilai');            
            $table->dropColumn('sertifikat');            

            $table->string('agama', 50)->after('jenis_kelamin');
            $table->enum('status', ['1', '0'])->after('alamat');
            $table->string('email')->unique()->after('status');
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->string('username', 100)->unique()->after('email_verified_at');
            $table->string('password', 100)->after('username');
            $table->rememberToken()->after('password');
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
            $table->foreignId('kursus_unit_id');
            $table->foreign('kursus_unit_id')->references('id')->on('kursus_unit')->onDelete('cascade');
            $table->double('nilai', 8, 2)->nullable();
            $table->string('sertifikat');

            $table->dropColumn('agama');
            $table->dropColumn('status');
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('username');
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
        });
    }
}
