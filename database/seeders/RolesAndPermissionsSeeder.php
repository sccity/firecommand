<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage fires']);
        Permission::create(['name' => 'manage assignments']);
        Permission::create(['name' => 'view fires']);
        Permission::create(['name' => 'create fires']);
        Permission::create(['name' => 'edit fires']);
        Permission::create(['name' => 'delete fires']);

        // Create roles and assign permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $commander = Role::create(['name' => 'commander']);
        $commander->givePermissionTo([
            'manage fires',
            'manage assignments',
            'view fires',
            'create fires',
            'edit fires'
        ]);

        $dispatcher = Role::create(['name' => 'dispatcher']);
        $dispatcher->givePermissionTo([
            'view fires',
            'create fires',
            'edit fires'
        ]);
    }
}
