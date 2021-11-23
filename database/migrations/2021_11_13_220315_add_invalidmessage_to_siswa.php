<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvalidmessageToSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa_kursus', function (Blueprint $table) {
            $table->string('invalid_message', 200)->nullable()->after('file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa_kursus', function (Blueprint $table) {
            $table->dropColumn('invalid_message');
        });
    }
}
