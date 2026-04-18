<?php

use App\Models\Admin;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    private const WEB_ROLES = [
        'internal_staff',
        'organisation_admin',
        'organisation_staff',
    ];

    public function up(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (self::WEB_ROLES as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }

        Admin::with('roles')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', self::WEB_ROLES);
            })
            ->get()
            ->each(function (Admin $admin): void {
                $roleName = $admin->roles
                    ->pluck('name')
                    ->first(fn (string $name) => in_array($name, self::WEB_ROLES, true));

                if (! $roleName) {
                    return;
                }

                DB::transaction(function () use ($admin, $roleName): void {
                    $user = User::firstOrNew([
                        'email' => $admin->email,
                    ]);

                    $user->fill([
                        'name' => $admin->name,
                        'username' => $admin->username,
                        'email' => $admin->email,
                        'password' => $admin->password,
                        'phone' => $admin->phone,
                        'organisation_id' => $admin->organisation_id,
                        'status' => $admin->status,
                    ]);
                    $user->save();

                    $user->syncRoles([Role::findOrCreate($roleName, 'web')]);

                    Lead::query()
                        ->where('assigned_to', $admin->id)
                        ->whereNull('assigned_user_id')
                        ->update([
                            'assigned_user_id' => $user->id,
                            'organisation_id' => $user->organisation_id,
                        ]);

                    $admin->syncRoles([]);
                    $admin->forceFill(['status' => false])->save();
                });
            });

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        // Intentionally left empty because this migration converts live account ownership.
    }
};
