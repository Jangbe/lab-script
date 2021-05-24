<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_labs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tipe')->nullable();
            $table->unsignedInteger('id_item')->nullable();
            $table->unsignedInteger('id_tiper')->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('nm_hasil',45);
            $table->integer('level_hasil')->nullable();
            $table->boolean('is_judul')->default(0);
            $table->boolean('is_nilai_normal')->default(0);
            $table->boolean('is_teks')->default(0);
            $table->boolean('is_kesimpulan')->default(0);
            $table->integer('jml_koma')->nullable();
            $table->text('ket_tambahan')->nullable();
            $table->boolean('is_rumus')->default(0)->nullable();
            $table->text('ket_rumus')->nullable();
            $table->timestamps();
            $table->foreign('id_tipe')
                  ->on('hasil_lab_tipes')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tiper')
                  ->on('hasil_lab_tipers')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('hasil_labs');
    }
}
