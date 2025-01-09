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
        $permissions = [
            'access_dashboard',
            'manage_users',
            'manage_roles',
            'view_reports',
            'edit_reports',
            'access_hr_module',
            'access_finance_module',
            'access_it_module',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roles = [
            'super_admin' => $permissions,
            'department_head' => [
                'access_dashboard',
                'view_reports',
                'edit_reports',
                'access_hr_module',
                'access_finance_module',
            ],
            'employee' => [
                'access_dashboard',
                'view_reports',
            ],
        ];

        foreach ($roles as $role => $rolePermissions) {
            $role = Role::create(['name' => $role]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}
