<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatLabRincisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat_lab_rincis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_alat');
            $table->string('parameter',40);
            $table->integer('nilai')->default(0);
            $table->integer('satuan')->default(0);
            $table->smallInteger('tipe_nilai')->default(1);
            $table->timestamps();
            $table->foreign('id_alat')
                ->on('alat_labs')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat_lab_rincis');
    }
}
