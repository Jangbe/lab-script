<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\UserRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Role::truncate();
        RolePermission::truncate();
        UserRole::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user=User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $role=Role::create([
            'name'=>'super_admin'
        ]);

        //asign permissions to role
        $permissions=Permission::all();
        foreach($permissions as $permission)
        {
            RolePermission::create([
                'role_id'=>$role['id'],
                'permission_id'=>$permission['id']
            ]);
        }

        //asign role to user
        UserRole::create([
            'role_id'=>$role['id'],
            'user_id'=>$user['id']
        ]);
    }
}
