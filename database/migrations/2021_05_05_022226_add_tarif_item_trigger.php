<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTarifItemTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER tarif_after_insert AFTER INSERT ON items
            FOR EACH ROW
                INSERT INTO item_tarifs (`id_item`,`is_active`,`created_at`,`updated_at`)
                VALUES (NEW.id, NEW.is_active,NEW.created_at,NEW.updated_at);
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER tarif_after_insert');
    }
}
