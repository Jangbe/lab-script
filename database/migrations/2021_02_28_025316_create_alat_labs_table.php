<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_alat',40);
            $table->string('uraian');
            $table->integer('com')->nullable();
            $table->integer('timeout')->nullable();
            $table->integer('buffer')->nullable();
            $table->integer('baudrate')->nullable();
            $table->integer('databits')->nullable();
            $table->integer('parity')->nullable();
            $table->integer('stopbits')->nullable();
            $table->integer('timer')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('alat_labs');
    }
}
