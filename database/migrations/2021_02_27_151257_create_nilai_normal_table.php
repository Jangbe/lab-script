<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiNormalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_normal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_hasil_lab')->index();
            $table->string('satuan', 20);
            $table->string('min_p', 10);
            $table->string('max_p', 10);
            $table->string('min_w', 10);
            $table->string('max_w', 10);
            $table->string('min_a', 10);
            $table->string('max_a', 10);
            $table->string('min_b', 10);
            $table->string('max_b', 10);
            $table->timestamps();
            $table->foreign('id_hasil_lab')
                ->on('hasil_labs')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_normal');
    }
}
