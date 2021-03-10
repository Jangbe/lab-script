<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executors', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 6);
            $table->string('nip', 13)->nullable();
            $table->string('nama', 100);
            $table->string('alamat', 100)->nullable();
            $table->string('telp', 13)->nullable();
            $table->boolean('aktif')->nullable();
            $table->boolean('pengirim')->nullable();
            $table->boolean('pjawab')->nullable();
            $table->boolean('pelaksana')->nullable();
            $table->string('jenis_pelaksana', 50);
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
        Schema::dropIfExists('executors');
    }
}
