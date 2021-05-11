<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTestsTable extends Migration
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
            $table->unsignedInteger('id_hasil_lab');
            $table->unsignedInteger('id_tiper')->nullable();
            $table->float('nilai')->nullable();
            $table->text('hasil_teks')->nullable();
            $table->boolean('is_duplo')->default(0);
            $table->text('keterangan')->nullable();
            $table->longText('kesimpulan')->nullable();
            $table->boolean('is_input')->default(0);
            $table->timestamps();
            $table->foreign('id_hasil_lab')
                  ->on('hasil_labs')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tiper')
                  ->on('hasil_lab_tipers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('no_pendaftaran')
                  ->on('patient_registrations')->references('no_pendaftaran')->onDelete('cascade')->onUpdate('cascade');
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
