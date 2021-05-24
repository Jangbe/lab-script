<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_group')->nullable();
            $table->unsignedInteger('id_klasifikasi')->nullable();
            $table->unsignedInteger('id_lab_group')->nullable();
            $table->unsignedInteger('id_lab_sample')->nullable();
            $table->string('nm_item', 200);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('items');
    }
}
