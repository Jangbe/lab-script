<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilLabAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_lab_alats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_hasil_lab');
            $table->foreignId('id_alat_lab_rinci')
                ->constrained('alat_lab_rincis')->onUpdate('cascade')->onDelete('cascade');
            $table->smallInteger('nilai_pembagi');
            $table->smallInteger('nilai_pengali');
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
        Schema::dropIfExists('hasil_lab_alats');
    }
}
