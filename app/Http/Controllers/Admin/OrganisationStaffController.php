<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class OrganisationStaffController extends Controller
{
    public function index(): View
    {
        $admin = Auth::guard('web')->user();

        return view('admin.staffs.index', [
            'staffs' => User::with(['organisation', 'roles'])
                ->where('organisation_id', $admin->organisation_id)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'organisation_staff')->where('guard_name', 'web');
                })
                ->latest()
                ->paginate(10),
            'organisations' => collect([$admin->organisation])->filter(),
            'roles' => ['organisation_staff'],
            'routePrefix' => 'organisation',
            'routeParams' => ['organisation' => $admin->organisation],
            'pageTitle' => 'Organisation Staffs',
            'canSelectOrganisation' => false,
            'staffModelClass' => \App\Models\User::class,
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $admin = Auth::guard('web')->user();
        $validated = $this->validatedData($request);
        $validated['organisation_id'] = $admin->organisation_id;

        $staff = User::create($validated);
        $staff->syncRoles([Role::findOrCreate('organisation_staff', 'web')]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff created successfully.',
                'redirect' => route('organisation.staffs.index', ['organisation' => $admin->organisation]),
            ]);
        }

        return redirect()->route('organisation.staffs.index', ['organisation' => $admin->organisation])->with('success', 'Staff created successfully.');
    }

    public function update(Request $request, User $staff): JsonResponse|RedirectResponse
    {
        $admin = Auth::guard('web')->user();
        $this->authorizeStaff($staff, $admin);

        $validated = $this->validatedData($request, $staff);
        $validated['organisation_id'] = $admin->organisation_id;

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $staff->update($validated);
        $staff->syncRoles([Role::findOrCreate('organisation_staff', 'web')]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Staff updated successfully.',
                'redirect' => route('organisation.staffs.index', ['organisation' => $admin->organisation]),
            ]);
        }

        return redirect()->route('organisation.staffs.index', ['organisation' => $admin->organisation])->with('success', 'Staff updated successfully.');
    }

    public function destroy(User $staff): RedirectResponse
    {
        $this->authorizeStaff($staff, Auth::guard('web')->user());
        $staff->delete();

        return redirect()->route('organisation.staffs.index', ['organisation' => Auth::guard('web')->user()->organisation])->with('success', 'Staff deleted successfully.');
    }

    protected function validatedData(Request $request, ?User $staff = null): array
    {
        $passwordRules = $staff ? ['nullable', 'string', 'min:8'] : ['required', 'string', 'min:8'];

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($staff?->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($staff?->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => $passwordRules,
            'status' => ['required', 'boolean'],
            '_modal' => ['nullable', 'string'],
        ]);
    }

    protected function authorizeStaff(User $staff, $admin): void
    {
        abort_if((int) $staff->organisation_id !== (int) $admin->organisation_id, 403);
        abort_unless($staff->roles()->where('name', 'organisation_staff')->where('guard_name', 'web')->exists(), 403);
    }
}
