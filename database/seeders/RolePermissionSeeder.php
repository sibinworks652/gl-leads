<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = 'admin';
        $permissions = [
            'dashboard.view',
            'admins.view',
            'admins.create',
            'admins.update',
            'admins.delete',
            'admins.restore',
            'admins.status',
            'admins.password',
            'roles.view',
            'roles.create',
            'roles.update',
            'roles.delete',
            'permissions.view',
            'permissions.create',
            'permissions.update',
            'permissions.delete',
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, $guard);
        }

        // Create Super Admin Role and assign all permissions
        $role = Role::findOrCreate('Super Admin', $guard);
        $role->syncPermissions($permissions);

        Role::findOrCreate('internal_staff', 'web');
        Role::findOrCreate('organisation_admin', 'web');
        Role::findOrCreate('organisation_staff', 'web');
    }
}
