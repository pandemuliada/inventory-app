<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'read categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        Role::create(['name' => 'super-admin'])->syncPermissions(Permission::all());
        Role::create(['name' => 'admin'])->syncPermissions(['create categories', 'read categories', 'edit categories', 'delete categories']);
        Role::create(['name' => 'user'])->syncPermissions(['read categories', 'edit categories']);
    }
}
