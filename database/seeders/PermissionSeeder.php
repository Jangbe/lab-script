<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        Module::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $modules=[
            'Pelaksana'=>['View','Create','Edit','Delete'],
            'Perusahaan'=>['View','Create','Edit','Delete'],
            'Pasien'=>['View','Create','Edit','Delete'],
            'Pemeriksaan Pasien'=>['View','Create','Edit','Delete','Hasil Pemeriksaan','Pembayaran'],
            'Item'=>['View','Create','Edit','Delete'],
            'Hasil Lab Tipe'=>['View','Create','Edit','Delete'],
            'Hasil Lab Rincian'=>['View','Create','Edit','Delete'],
            'Pemeriksaan'=>['View','Create','Edit','Delete'],
            'Pengurutan Pemeriksaan'=>['View','Edit'],
            'Tarif Item'=>['View','Edit'],
            'Alat Laboratorium'=>['View','Create','Edit','Delete'],
            'Parameter Alat Lab'=>['View','Create','Edit','Delete'],
            'Setting Hasil Alat Lab'=>['View','Create','Edit','Delete'],
            'Roles'=>['View','Create','Edit','Delete'],
            'User'=>['View','Create','Edit','Delete']
        ];

        foreach($modules as $name => $permissions){
            $id=Module::create(['name'=>$name])->id;
            foreach($permissions as $permission){
                Permission::create([
                    'module_id'=>$id,
                    'key'=>str_replace('-','_',Str::slug($permission.'-'.$name)),
                    'name'=>$permission
                ]);
            }
        }

    }
}
