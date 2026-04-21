<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')
            ->orderBy('guard_name')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.roles.index', [
            'roles' => $roles,
            'permissionsByGuard' => Permission::query()
                ->orderBy('guard_name')
                ->orderBy('name')
                ->get()
                ->groupBy('guard_name'),
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $this->validatedData($request);
        $permissionNames = $validated['permissions'] ?? [];
        unset($validated['permissions']);

        $role = Role::create($validated);
        $role->syncPermissions($permissionNames);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Role created successfully.',
                'redirect' => route('admin.roles.index'),
            ]);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role): JsonResponse|RedirectResponse
    {
        $validated = $this->validatedData($request, $role);
        $permissionNames = $validated['permissions'] ?? [];
        unset($validated['permissions']);

        $role->update($validated);
        $role->syncPermissions($permissionNames);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Role updated successfully.',
                'redirect' => route('admin.roles.index'),
            ]);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === 'Super Admin' && $role->guard_name === 'admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Super Admin role cannot be deleted.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

    protected function validatedData(Request $request, ?Role $role = null): array
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->where(
                    fn ($query) => $query->where('guard_name', $request->input('guard_name'))
                )->ignore($role?->id),
            ],
            'guard_name' => ['required', Rule::in(['admin', 'web'])],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string'],
        ]);

        $availablePermissions = Permission::query()
            ->where('guard_name', $validated['guard_name'])
            ->pluck('name')
            ->all();

        $validated['permissions'] = collect($validated['permissions'] ?? [])
            ->intersect($availablePermissions)
            ->values()
            ->all();

        return $validated;
    }
}

