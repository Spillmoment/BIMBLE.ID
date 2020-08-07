<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit', 100);
            $table->string('slug')->nullable()->unique();
            $table->text('alamat');
            $table->text('deskripsi');
            $table->string('gambar_unit', 100)->nullable();
            $table->enum('status', ['1', '0']);
            $table->string('whatsapp', 100)->nullable();
            $table->string('telegram', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username', 100);
            $table->string('password', 100);
            $table->rememberToken();
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
        Schema::dropIfExists('unit');
    }
}
