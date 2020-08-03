<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tutor', 100);
            $table->text('alamat');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('username', 100);
            $table->string('password', 100);
            $table->rememberToken();
            $table->enum('status', ['1', '0']);
            $table->text('keahlian');
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
        Schema::dropIfExists('tutor');
    }
}
