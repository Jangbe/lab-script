<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToHasilLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_labs', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->unsignedInteger('id_tipe')->nullable()->after('id');
            $table->unsignedInteger('id_item')->nullable()->change();
            $table->unsignedInteger('id_tiper')->change();
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
        Schema::table('hasil_labs', function (Blueprint $table) {
            $table->dropForeign(['id_item']);
            $table->dropForeign(['id_tipe']);
            $table->dropForeign(['id_tiper']);
        });

        Schema::table('hasil_labs', function (Blueprint $table) {
            $table->dropColumn('id_tipe');
        });

    }
}
