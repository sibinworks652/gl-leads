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
            'routePrefix' => $this->routePrefix(),
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
        $roleNames = $validated['roles'];
        unset($validated['roles']);

        $staff = User::create($validated);
        $staff->syncRoles($this->resolveRoles($roleNames));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff created successfully.',
                'redirect' => route($this->routePrefix().'.staffs.index'),
            ]);
        }

        return redirect()
            ->route($this->routePrefix().'.staffs.index')
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
        $roleNames = $validated['roles'];
        unset($validated['roles']);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $staff->update($validated);
        $staff->syncRoles($this->resolveRoles($roleNames));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff updated successfully.',
                'redirect' => route($this->routePrefix().'.staffs.index'),
            ]);
        }

        return redirect()
            ->route($this->routePrefix().'.staffs.index')
            ->with('success', 'Staff updated successfully.');
    }

    public function destroy(User $staff): RedirectResponse
    {
        abort_unless($this->isManageableStaff($staff), 404);

        $staff->delete();

        return redirect()
            ->route($this->routePrefix().'.staffs.index')
            ->with('success', 'Staff deleted successfully.');
    }

    protected function validatedData(Request $request, ?User $staff = null): array
    {
        $passwordRules = $staff
            ? ['nullable', 'string', 'min:8']
            : ['required', 'string', 'min:8'];
        $roles = collect($request->input('roles', []))->filter()->all();

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
                Rule::requiredIf(fn () => count(array_intersect($roles, ['organisation_admin', 'organisation_staff'])) > 0),
                'nullable',
                'exists:organisations,id',
            ],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', Rule::in(self::MANAGEABLE_ROLES)],
            'password' => $passwordRules,
            'status' => ['required', 'boolean'],
        ],[
            'organisation_id.required' => 'The organisation field is required.',
            'organisation_id.exists' => 'The selected organisation is invalid.',
            'roles.required' => 'The roles field is required.',
            'roles.array' => 'The roles field must be an array.',
            'roles.min' => 'The roles field must have at least :min item.',
            'roles.*.required' => 'The roles field must have at least :min item.',
            'roles.*.in' => 'The selected role is invalid.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password field must be at least :min characters.',
            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status field must be a boolean.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must be at most :max characters.',
            'username.required' => 'The username field is required.',
            'username.string' => 'The username field must be a string.',
            'username.max' => 'The username field must be at most :max characters.',
            'username.unique' => 'The username has already been taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.max' => 'The email field must be at most :max characters.',
            'email.unique' => 'The email has already been taken.',
            'phone.string' => 'The phone field must be a string.',
            'phone.max' => 'The phone field must be at most :max characters.',
        ]);
    }

    protected function resolveRole(string $roleName): Role
    {
        return Role::findOrCreate($roleName, 'web');
    }

    protected function resolveRoles(array $roleNames): array
    {
        return collect($roleNames)
            ->filter()
            ->unique()
            ->map(fn (string $roleName) => $this->resolveRole($roleName))
            ->all();
    }

    protected function isManageableStaff(User $staff): bool
    {
        return $staff->roles()
            ->whereIn('name', self::MANAGEABLE_ROLES)
            ->where('guard_name', 'web')
            ->exists();
    }

    protected function routePrefix(): string
    {
        return auth('web')->check() ? 'staff' : 'admin';
    }
}
