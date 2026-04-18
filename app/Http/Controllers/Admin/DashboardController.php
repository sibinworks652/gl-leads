<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function superadmin() {
        return view('admin.dashboard', [
            'stats' => $this->leadStats(),
        ]);
    }

    public function staff() {
        // Logic for your own company staff
        return view('staff.dashboard');
    }

    public function organisationAdmin() {
        $user = Auth::guard('web')->user();

        return view('organisation.dashboard', [
            'stats' => $this->leadStats($user->organisation_id),
            'staffCount' => User::where('organisation_id', $user->organisation_id)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'organisation_staff')->where('guard_name', 'web');
                })
                ->count(),
        ]);
    }

    public function organisationStaff() {
        $user = Auth::guard('web')->user();

        return view('organisation_staff.dashboard', [
            'stats' => $this->leadStats(null, $user->id),
        ]);
    }

    protected function leadStats(?int $organisationId = null, ?int $assignedUserId = null): array
    {
        $query = Lead::query();

        if ($organisationId) {
            $query->where('organisation_id', $organisationId);
        }

        if ($assignedUserId) {
            $query->where('assigned_user_id', $assignedUserId);
        }

        return [
            'new' => (clone $query)->where('status', 'new')->count(),
            'contacted' => (clone $query)->where('status', 'contacted')->count(),
            'completed' => (clone $query)->where('status', 'completed')->count(),
            'total' => (clone $query)->count(),
        ];
    }

}
