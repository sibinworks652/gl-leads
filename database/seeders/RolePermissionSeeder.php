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
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $adminPermissions = [
            'dashboard.view',
            'organisations.view',
            'organisations.create',
            'organisations.update',
            'organisations.delete',
            'staffs.view',
            'staffs.create',
            'staffs.update',
            'staffs.delete',
            'leads.view',
            'leads.create',
            'leads.update',
            'leads.delete',
            'roles.view',
            'roles.create',
            'roles.update',
            'roles.delete',
            'permissions.view',
            'permissions.create',
            'permissions.update',
            'permissions.delete',
        ];

        $webPermissions = [
            'dashboard.view',
            'staffs.view',
            'staffs.create',
            'staffs.update',
            'staffs.delete',
            'leads.view',
            'leads.create',
            'leads.update',
            'leads.delete',
        ];

        foreach ($adminPermissions as $permission) {
            Permission::findOrCreate($permission, 'admin');
        }

        foreach ($webPermissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdminRole = Role::findOrCreate('Super Admin', 'admin');
        $superAdminRole->syncPermissions($adminPermissions);

        $internalStaffRole = Role::findOrCreate('internal_staff', 'web');
        $internalStaffRole->syncPermissions([
            'dashboard.view',
            'staffs.view',
            'staffs.create',
            'staffs.update',
            'staffs.delete',
            'leads.view',
            'leads.create',
            'leads.update',
            'leads.delete',
        ]);

        $organisationAdminRole = Role::findOrCreate('organisation_admin', 'web');
        $organisationAdminRole->syncPermissions([
            'dashboard.view',
            'staffs.view',
            'staffs.create',
            'staffs.update',
            'staffs.delete',
            'leads.view',
            'leads.create',
            'leads.update',
            'leads.delete',
        ]);

        $organisationStaffRole = Role::findOrCreate('organisation_staff', 'web');
        $organisationStaffRole->syncPermissions([
            'dashboard.view',
            'leads.view',
            'leads.update',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
