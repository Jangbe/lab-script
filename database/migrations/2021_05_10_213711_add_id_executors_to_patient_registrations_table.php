<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdExecutorsToPatientRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penanggung_jawab')->nullable()->after('no_rm');
            $table->unsignedBigInteger('id_pengirim')->nullable()->after('id_penanggung_jawab');
            $table->foreign('id_penanggung_jawab')
                ->on('executors')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pengirim')
                ->on('executors')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->dropForeign(['id_penanggung_jawab']);
            $table->dropForeign(['id_pengirim']);
            $table->dropColumn(['id_penanggung_jawab','id_pengirim']);
        });
    }
}
