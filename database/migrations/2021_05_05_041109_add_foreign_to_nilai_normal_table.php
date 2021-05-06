<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToNilaiNormalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_normal', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->unsignedInteger('id_hasil_lab')->change();
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
        Schema::table('nilai_normal', function (Blueprint $table) {
            $table->dropForeign(['id_hasil_lab']);
        });
    }
}
