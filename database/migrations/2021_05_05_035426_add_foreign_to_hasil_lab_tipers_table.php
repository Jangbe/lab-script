<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToHasilLabTipersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_lab_tipers', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->unsignedInteger('id_tipe')->change();
            $table->foreign('id_tipe')
                ->on('hasil_lab_tipes')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_lab_tipers', function (Blueprint $table) {
            $table->dropForeign(['id_tipe']);
        });
    }
}
