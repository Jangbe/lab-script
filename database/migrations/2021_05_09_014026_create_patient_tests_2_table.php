<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTests2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->bigInteger('no_pendaftaran',false,true);
            $table->unsignedInteger('id_item');
            $table->string('no_alat',15);
            $table->unsignedInteger('id_pelaksana');
            $table->float('harga');
            $table->timestamps();
            $table->foreign('no_pendaftaran')
                  ->on('patient_registrations')->references('no_pendaftaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_item')
                  ->on('items')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_tests');
    }
}
