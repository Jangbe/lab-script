<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToItemTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_tarifs', function (Blueprint $table) {
            $table->unsignedInteger('id_item')->change();
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
        Schema::table('item_tarifs', function (Blueprint $table) {
            $table->dropForeign(['id_item']);
        });
    }
}
