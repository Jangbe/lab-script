<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_tarifs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_item')->index();
            $table->integer('tarif_bayar')->default(0);
            $table->integer('tarif_bpjs')->default(0);
            $table->integer('tarif_jaminan')->default(0);
            $table->date('tanggal_berlaku')->default(date('Y-m-d'));
            $table->boolean('is_active');
            $table->timestamps();
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
        Schema::dropIfExists('item_tarifs');
    }
}
