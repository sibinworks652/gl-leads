<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LeadController extends Controller
{
    private const STATUSES = ['new', 'contacted', 'completed'];
    private const SOURCES = ['Facebook', 'Google', 'Website', 'Referral', 'Walk-in'];

    public function index(): View
    {
        $admin = Auth::guard('admin')->user();
        $webUser = Auth::guard('web')->user();
        $query = Lead::with(['organisation', 'assignedUser'])->latest();

        if ($webUser?->hasRole('organisation_admin')) {
            $query->where('organisation_id', $webUser->organisation_id);
        } elseif ($webUser?->hasRole('organisation_staff')) {
            $query->where('assigned_user_id', $webUser->id);
        }

        return view('admin.leads.index', [
            'leads' => $query->paginate(10),
            'statuses' => self::STATUSES,
            'sources' => self::SOURCES,
            'assignableStaffs' => $this->assignableStaffs($admin, $webUser),
            'canManageLeads' => ! $webUser?->hasRole('organisation_staff'),
            'routePrefix' => $this->routePrefix($admin, $webUser),
            'pageTitle' => $webUser?->hasRole('organisation_staff') ? 'Assigned Leads' : 'Lead Reports',
            'stats' => $this->statsFor($admin, $webUser),
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $admin = Auth::guard('admin')->user();
        $webUser = Auth::guard('web')->user();
        abort_unless($admin || $webUser?->hasRole('organisation_admin'), 403);

        Lead::create($this->validatedData($request, $admin, $webUser));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Lead created successfully.',
                'redirect' => route($this->routePrefix($admin, $webUser).'.leads.index'),
            ]);
        }

        return redirect()->route($this->routePrefix($admin, $webUser).'.leads.index')
            ->with('success', 'Lead created successfully.');
    }

    public function update(Request $request, Lead $lead): JsonResponse|RedirectResponse
    {
        $admin = Auth::guard('admin')->user();
        $webUser = Auth::guard('web')->user();
        $this->authorizeLead($lead, $admin, $webUser);

        if ($webUser?->hasRole('organisation_staff')) {
            $lead->update($request->validate([
                'status' => ['required', 'in:'.implode(',', self::STATUSES)],
                'notes' => ['nullable', 'string', 'max:2000'],
                '_modal' => ['nullable', 'string'],
            ]));
        } else {
            $lead->update($this->validatedData($request, $admin, $webUser));
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Lead updated successfully.',
                'redirect' => route($this->routePrefix($admin, $webUser).'.leads.index'),
            ]);
        }

        return redirect()->route($this->routePrefix($admin, $webUser).'.leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();
        $webUser = Auth::guard('web')->user();
        abort_unless($admin || $webUser?->hasRole('organisation_admin'), 403);
        $this->authorizeLead($lead, $admin, $webUser);

        $lead->delete();

        return redirect()->route($this->routePrefix($admin, $webUser).'.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }

    protected function validatedData(Request $request, ?Admin $admin, ?User $webUser): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'source' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
            'assigned_user_id' => ['nullable', 'exists:users,id'],
            'lead_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
            '_modal' => ['nullable', 'string'],
        ]);

        $validated['assigned_user_id'] = $this->resolveAssignedUserId(
            $admin,
            $webUser,
            $validated['assigned_user_id'] ?? null
        );

        if ($webUser?->hasRole('organisation_admin')) {
            $validated['organisation_id'] = $webUser->organisation_id;
        }

        if (! empty($validated['assigned_user_id']) && ! $this->assignableStaffs($admin, $webUser)->contains('id', (int) $validated['assigned_user_id'])) {
            abort(403);
        }

        if (! empty($validated['assigned_user_id'])) {
            $validated['organisation_id'] = User::find($validated['assigned_user_id'])?->organisation_id;
        }

        return $validated;
    }

    protected function resolveAssignedUserId(?Admin $admin, ?User $webUser, mixed $assignedUserId): ?int
    {
        if (! empty($assignedUserId)) {
            return (int) $assignedUserId;
        }

        if (! $webUser?->hasRole('organisation_admin')) {
            return null;
        }

        return $this->assignableStaffQuery($admin, $webUser)
            ->withCount('assignedLeads')
            ->withMax('assignedLeads', 'created_at')
            ->orderBy('assigned_leads_count')
            ->orderBy('assigned_leads_max_created_at')
            ->orderBy('id')
            ->first()?->id;
    }

    protected function assignableStaffs(?Admin $admin, ?User $staffUser)
    {
        return $this->assignableStaffQuery($admin, $staffUser)
            ->orderBy('name')
            ->get();
    }

    protected function assignableStaffQuery(?Admin $admin, ?User $staffUser)
    {
        $query = User::query()->where('status', true);

        if ($staffUser?->hasRole('organisation_admin')) {
            $query->where('organisation_id', $staffUser->organisation_id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'organisation_staff')->where('guard_name', 'web');
                });
        } elseif ($staffUser?->hasRole('organisation_staff')) {
            $query->whereKey($staffUser->id);
        } else {
            $query->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('name', 'organisation_staff')->where('guard_name', 'web');
            });
        }

        return $query;
    }

    protected function authorizeLead(Lead $lead, ?Admin $admin, ?User $staffUser): void
    {
        if ($staffUser?->hasRole('organisation_admin') && (int) $lead->organisation_id !== (int) $staffUser->organisation_id) {
            abort(403);
        }

        if ($staffUser?->hasRole('organisation_staff') && (int) $lead->assigned_user_id !== (int) $staffUser->id) {
            abort(403);
        }
    }

    protected function routePrefix(?Admin $admin, ?User $staffUser): string
    {
        if ($admin?->hasRole('organisation_admin')) {
            return 'admin';
        }

        if ($staffUser?->hasRole('organisation_admin')) {
            return 'organisation';
        }

        if ($staffUser?->hasRole('organisation_staff')) {
            return 'organisation-staff';
        }

        return 'staff';
    }

    protected function statsFor(?Admin $admin, ?User $staffUser): array
    {
        $query = Lead::query();

        if ($staffUser?->hasRole('organisation_admin')) {
            $query->where('organisation_id', $staffUser->organisation_id);
        } elseif ($staffUser?->hasRole('organisation_staff')) {
            $query->where('assigned_user_id', $staffUser->id);
        }

        return [
            'new' => (clone $query)->where('status', 'new')->count(),
            'contacted' => (clone $query)->where('status', 'contacted')->count(),
            'completed' => (clone $query)->where('status', 'completed')->count(),
            'total' => (clone $query)->count(),
        ];
    }
}
