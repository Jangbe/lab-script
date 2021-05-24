<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilLabTipersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_lab_tipers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tipe');
            $table->string('nm_tiper',45);
            $table->timestamps();
            $table->foreign('id_tipe')
                ->on('hasil_lab_tipes')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_lab_tipers');
    }
}
