<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    private const MANAGEABLE_ROLES = [
        'internal_staff',
        'organisation_admin',
        'organisation_staff',
    ];

    public function index(): View
    {
        $staffs = User::with(['organisation', 'roles'])
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', self::MANAGEABLE_ROLES)
                    ->where('guard_name', 'web');
            })
            ->latest()
            ->paginate(10);

        return view('admin.staffs.index', [
            'staffs' => $staffs,
            'organisations' => Organisation::where('status', true)->orderBy('name')->get(),
            'roles' => self::MANAGEABLE_ROLES,
            'staffModelClass' => \App\Models\User::class,
        ]);
    }

    public function create(): View
    {
        return view('admin.staffs.create', [
            'staff' => new User(),
            'organisations' => Organisation::where('status', true)->orderBy('name')->get(),
            'roles' => self::MANAGEABLE_ROLES,
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $this->validatedData($request);
        $role = $validated['role'];
        unset($validated['role']);

        $staff = User::create($validated);
        $staff->syncRoles([$this->resolveRole($role)]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff created successfully.',
                'redirect' => route('admin.staffs.index'),
            ]);
        }

        return redirect()
            ->route('admin.staffs.index')
            ->with('success', 'Staff created successfully.');
    }

    public function edit(User $staff): View
    {
        abort_unless($this->isManageableStaff($staff), 404);

        return view('admin.staffs.edit', [
            'staff' => $staff->load('roles'),
            'organisations' => Organisation::where('status', true)->orderBy('name')->get(),
            'roles' => self::MANAGEABLE_ROLES,
        ]);
    }

    public function update(Request $request, User $staff): JsonResponse|RedirectResponse
    {
        abort_unless($this->isManageableStaff($staff), 404);

        $validated = $this->validatedData($request, $staff);
        $role = $validated['role'];
        unset($validated['role']);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $staff->update($validated);
        $staff->syncRoles([$this->resolveRole($role)]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff updated successfully.',
                'redirect' => route('admin.staffs.index'),
            ]);
        }

        return redirect()
            ->route('admin.staffs.index')
            ->with('success', 'Staff updated successfully.');
    }

    public function destroy(User $staff): RedirectResponse
    {
        abort_unless($this->isManageableStaff($staff), 404);

        $staff->delete();

        return redirect()
            ->route('admin.staffs.index')
            ->with('success', 'Staff deleted successfully.');
    }

    protected function validatedData(Request $request, ?User $staff = null): array
    {
        $passwordRules = $staff
            ? ['nullable', 'string', 'min:8']
            : ['required', 'string', 'min:8'];

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($staff?->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($staff?->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'organisation_id' => [
                Rule::requiredIf(fn () => in_array($request->input('role'), ['organisation_admin', 'organisation_staff'], true)),
                'nullable',
                'exists:organisations,id',
            ],
            'role' => ['required', Rule::in(self::MANAGEABLE_ROLES)],
            'password' => $passwordRules,
            'status' => ['required', 'boolean'],
        ]);
    }

    protected function resolveRole(string $roleName): Role
    {
        return Role::findOrCreate($roleName, 'web');
    }

    protected function isManageableStaff(User $staff): bool
    {
        return $staff->roles()
            ->whereIn('name', self::MANAGEABLE_ROLES)
            ->where('guard_name', 'web')
            ->exists();
    }
}
