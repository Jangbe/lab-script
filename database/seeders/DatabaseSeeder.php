<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        // Item Clasifications
        $path=__DIR__.'/item_clasifications.sql';
        DB::unprepared(file_get_contents($path));
        // Item Groups
        DB::table('item_groups')->insert(['id'=>2,'group_name'=>'Pemeriksaan Labolatorium',
                                          'jns_hasil'=>2,'is_active'=>1,'created_at'=>now(),'updated_at'=>now()
                                        ]);
        // Item Lab Groups
        $path=__DIR__.'/item_lab_groups.sql';
        DB::unprepared(file_get_contents($path));
        // Item Lab Samples
        $path=__DIR__.'/item_lab_samples.sql';
        DB::unprepared(file_get_contents($path));
        // Items
        $path=__DIR__.'/items.sql';
        DB::unprepared(file_get_contents($path));
        // Item Tarifs
        $path=__DIR__.'/item_tarif.sql';
        DB::unprepared(file_get_contents($path));
        // Hasil Lab Tipes
        $path=__DIR__.'/hasil_lab_tipes.sql';
        DB::unprepared(file_get_contents($path));
        // Hasil Lab Tipers
        $path=__DIR__.'/hasil_lab_tipers.sql';
        DB::unprepared(file_get_contents($path));
        // Hasil Labs
        $path=__DIR__.'/hasil_labs.sql';
        DB::unprepared(file_get_contents($path));
        // Alat Labs
        $path=__DIR__.'/alat_labs.sql';
        DB::unprepared(file_get_contents($path));
        // Alat Lab Rincis
        $path=__DIR__.'/alat_lab_rincis.sql';
        DB::unprepared(file_get_contents($path));
        // Hasil Lab Alats
        $path=__DIR__.'/hasil_lab_alats.sql';
        DB::unprepared(file_get_contents($path));
        // Hasil Lab Nilai Normal
        $path=__DIR__.'/nilai_normal.sql';
        DB::unprepared(file_get_contents($path));

        // Settings
        $path=__DIR__.'/settings.sql';
        DB::unprepared(file_get_contents($path));
    }
}
