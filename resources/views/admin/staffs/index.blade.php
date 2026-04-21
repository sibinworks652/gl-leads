@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    @php
        $routePrefix = $routePrefix ?? 'admin';
        $pageTitle = $pageTitle ?? 'Staffs';
        $canSelectOrganisation = $canSelectOrganisation ?? true;
        $routeParams = $routeParams ?? [];
        $panelUser = auth('admin')->user() ?: auth('web')->user();
        $canCreateStaff = (bool) $panelUser?->can('staffs.create');
        $canUpdateStaff = (bool) $panelUser?->can('staffs.update');
        $canDeleteStaff = (bool) $panelUser?->can('staffs.delete');
        $canShowStaffActions = $canUpdateStaff || $canDeleteStaff;
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="d-flex flex-wrap justify-content-between align-items-center p-3 gap-2">
                        <div>
                            <h4 class="card-title mb-1">{{ $pageTitle }}</h4>
                            <p class="text-muted mb-0">Manage team accounts from the current role scope.</p>
                        </div>
                        @if ($canCreateStaff)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStaffModal">
                                <i class="bx bx-plus me-1"></i> Add Staff
                            </button>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Organisation</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    @if ($canShowStaffActions)
                                        <th class="text-end">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($staffs as $staff)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $staff->name }}</div>
                                            <div class="text-muted small">{{ $staff->email }}</div>
                                        </td>
                                        <td>{{ $staff->username }}</td>
                                        <td>{{ $staff->organisation?->name ?: 'N/A' }}</td>
                                        <td>
                                            {{ $staff->roles->pluck('name')->isNotEmpty()
                                                ? $staff->roles->pluck('name')->map(fn ($role) => ucwords(str_replace('_', ' ', $role)))->join(', ')
                                                : 'Unassigned' }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $staff->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                                {{ $staff->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        @if ($canShowStaffActions)
                                            <td class="text-end">
                                                @if ($canUpdateStaff)
                                                    <button
                                                        type="button"
                                                        class="btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editStaffModal-{{ $staff->id }}"
                                                    >
                                                        <img src="{{ asset('assets/images/edit.svg') }}" alt="Edit">
                                                    </button>
                                                @endif
                                                @if ($canDeleteStaff)
                                                    <form action="{{ route($routePrefix.'.staffs.destroy', array_merge($routeParams, ['staff' => $staff])) }}" method="POST" class="d-inline delete-record-form" data-item-label="{{ $staff->name }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn"><img src="{{ asset('assets/images/delete.svg') }}" alt="Delete"></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $canShowStaffActions ? 6 : 5 }}" class="text-center py-4 text-muted">No staff records found yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $staffs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($canCreateStaff)
    <div class="modal" id="createStaffModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route($routePrefix.'.staffs.store', $routeParams) }}" method="POST" class="ajax-form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_modal" value="createStaffModal">
                        @include('admin.staffs._form', [
                            'staff' => $staffModelClass::make(),
                            'submitLabel' => 'Create Staff',
                            'includeFormWrapper' => false,
                            'canSelectOrganisation' => $canSelectOrganisation,
                        ])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@if ($canUpdateStaff)
    @foreach ($staffs as $staff)
        <div class="modal" id="editStaffModal-{{ $staff->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route($routePrefix.'.staffs.update', array_merge($routeParams, ['staff' => $staff])) }}" method="POST" class="ajax-form">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_modal" value="editStaffModal-{{ $staff->id }}">
                            @include('admin.staffs._form', [
                                'roles' => $roles,
                                'organisations' => $organisations,
                                'submitLabel' => 'Update Staff',
                                'includeFormWrapper' => false,
                                'canSelectOrganisation' => $canSelectOrganisation,
                            ])
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Staff</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reopenModalId = @json(old('_modal'));

        if (reopenModalId && document.getElementById(reopenModalId)) {
            bootstrap.Modal.getOrCreateInstance(document.getElementById(reopenModalId)).show();
        }
    });
</script>
@endpush
