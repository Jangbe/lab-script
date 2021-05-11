<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_tests',function(Blueprint $table){
            $table->dropForeign(['id_hasil_lab']);
            $table->dropForeign(['id_tiper']);
            $table->dropForeign(['no_pendaftaran']);
        });
        Schema::rename('patient_tests','patient_test_results');
        Schema::table('patient_test_results', function(Blueprint $table){
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
        Schema::table('patient_test_results',function(Blueprint $table){
            $table->dropForeign(['id_hasil_lab']);
            $table->dropForeign(['id_tiper']);
            $table->dropForeign(['no_pendaftaran']);
        });
        Schema::rename('patient_tests_results','patient_tests');
        Schema::table('patients', function(Blueprint $table){
            $table->foreign('id_hasil_lab')
                  ->on('hasil_labs')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tiper')
                  ->on('hasil_lab_tipers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('no_pendaftaran')
                  ->on('patient_registrations')->references('no_pendaftaran')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
