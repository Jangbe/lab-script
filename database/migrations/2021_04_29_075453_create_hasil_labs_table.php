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
            $table->id();
            $table->integer('id_item')->index();
            $table->integer('id_tiper')->index()->nullable();
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
