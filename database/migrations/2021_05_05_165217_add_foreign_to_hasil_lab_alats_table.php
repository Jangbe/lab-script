<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToHasilLabAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_lab_alats', function (Blueprint $table) {
            $table->integer('jumlah_koma')->after('nilai_pengali');
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
        Schema::table('hasil_lab_alats', function (Blueprint $table) {
            $table->dropColumn('jumlah_koma');
            $table->dropForeign(['id_hasil_lab']);
        });
    }
}
