<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'admin';

        // Ensure the Super Admin role exists
        $role = Role::where('name', 'Super Admin')->where('guard_name', $guard)->first();

        $admin = Admin::firstOrCreate(
            ['email' => 'admin@glseoleads.com'],
            [
                'name'      => 'Super Admin',
                'username'  => 'superadmin',
                'password'  => Hash::make('Admin@12345'),
                'status' => true,
            ]
        );

        // Assign Role
        if ($role && !$admin->hasRole($role)) {
            $admin->assignRole($role);
        }

        // Ensure user is active if they already existed but were disabled
        if (!$admin->status) {
            $admin->update(['status' => true]);
        }
    }
}
