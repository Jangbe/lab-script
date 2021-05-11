<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoUrutToHasilLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_labs', function (Blueprint $table) {
            $table->integer('no_urut')->nullable()->after('id_tiper');
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
            $table->dropColumn('no_urut');
        });
    }
}
