<?php

use App\Models\Usuario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'redirect1']);
        Permission::create(['name' => 'redirect2']);

        //admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'redirect1',
            'redirect2',
        ]);
        //usernormal
        $admin = Role::create(['name' => 'usernormal']);
        $admin->givePermissionTo([
            'redirect1',
        ]);
        
        $user = Usuario::find(1); // 1
        $user->assignRole('admin');
        $user = Usuario::find(2); // 2
        $user->assignRole('usernormal');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('roles')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('users')->truncate();
        DB::statement("SET foreign_key_checks=1");
    }
}
