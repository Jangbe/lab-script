<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('id_group')
                  ->on('item_groups')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_klasifikasi')
                  ->on('item_clasifications')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_lab_group')
                  ->on('item_lab_groups')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_lab_sample')
                  ->on('item_lab_samples')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['id_group','id_klasifikasi','id_lab_group','id_lab_sample']);
        });
    }
}
