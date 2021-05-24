<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('noreg', 40)->unique();
            $table->string('nama', 100);
            $table->string('tempat_lahir', 45)->nullable();
            $table->smallInteger('hub')->nullable();
            $table->text('alamat1')->nullable();
            $table->text('alamat2')->nullable();
            $table->integer('id_dokter')->nullable();
            $table->enum('jenis_kelamin',['L','P']);
            $table->date('tanggal_lahir');
            $table->smallInteger('status')->nullable();
            $table->char('gol_darah', 5)->nullable();
            $table->string('rt_rw_kodepos')->nullable();
            $table->smallInteger('kd_provinsi')->nullable();
            $table->smallInteger('kd_kota')->nullable();
            $table->Integer('kd_kecamatan')->nullable();
            $table->bigInteger('kd_kelurahan')->nullable();
            $table->string('no_identitas')->nullable();
            $table->string('no_telepon', 14)->nullable();
            $table->bigInteger('id_perusahaan')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
