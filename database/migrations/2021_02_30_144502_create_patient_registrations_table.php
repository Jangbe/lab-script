<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_registrations', function (Blueprint $table) {
            $table->bigInteger('no_pendaftaran',false,true)->primary();
            $table->string('no_rm',40)->unique();
            $table->unsignedBigInteger('id_penanggung_jawab')->nullable();
            $table->unsignedBigInteger('id_pengirim')->nullable();
            $table->smallInteger('cara_bayar')->default(1);
            $table->integer('no_urut');
            $table->enum('sts_pengunjung',['L','B']);
            $table->enum('sts_kunjungan',['L','B']);
            $table->double('subtotal')->nullable();
            $table->float('nilai_admin')->nullable();
            $table->float('nilai_discount')->nullable();
            $table->float('nilai_uangmuka')->nullable();
            $table->boolean('is_cito')->default(0);
            $table->float('nilai_cito')->nullable();
            $table->string('pembayar',100)->nullable();
            $table->date('tanggal_lunas')->nullable();
            $table->timestamps();
            $table->foreign('no_rm')
                  ->on('patients')->references('noreg')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('patient_registrations');
    }
}
