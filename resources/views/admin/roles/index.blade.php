@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    @php
        $panelUser = auth('admin')->user() ?: auth('web')->user();
        $canCreateRole = (bool) $panelUser?->can('roles.create');
        $canUpdateRole = (bool) $panelUser?->can('roles.update');
        $canDeleteRole = (bool) $panelUser?->can('roles.delete');
        $canShowRoleActions = $canUpdateRole || $canDeleteRole;
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-3">
                        <div>
                            <h4 class="card-title mb-1">Roles</h4>
                            <p class="text-muted mb-0">Create roles and assign permissions per guard.</p>
                        </div>
                        @if ($canCreateRole)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                                <i class="bx bx-plus me-1"></i> Add Role
                            </button>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Guard</th>
                                    <th>Permissions</th>
                                    @if ($canShowRoleActions)
                                        <th class="text-end">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td><span class="badge bg-light text-dark">{{ $role->guard_name }}</span></td>
                                        <td>
                                            @forelse ($role->permissions->sortBy('name')->groupBy(fn ($permission) => \Illuminate\Support\Str::before($permission->name, '.')) as $groupKey => $groupPermissions)
                                                {{-- <div class="mb-1"> --}}
                                                    <span class="fw-normal">{{ \Illuminate\Support\Str::headline(\Illuminate\Support\Str::singular($groupKey)) }}:</span>
                                                    @foreach ($groupPermissions as $permission)
                                                        <span class="badge bg-primary-subtle text-primary me-1">{{ \Illuminate\Support\Str::headline(\Illuminate\Support\Str::after($permission->name, '.')) }}</span>
                                                    @endforeach
                                                {{-- </div> --}}
                                            @empty
                                                <span class="text-muted">No permissions</span>
                                            @endforelse
                                        </td>
                                        @if ($canShowRoleActions)
                                            <td class="text-end">
                                                @if ($canUpdateRole)
                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editRoleModal-{{ $role->id }}">
                                                        <img src="{{ asset('assets/images/edit.svg') }}" alt="Edit">
                                                    </button>
                                                @endif
                                                @if ($canDeleteRole && ! ($role->name === 'Super Admin' && $role->guard_name === 'admin'))
                                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline delete-record-form" data-item-label="{{ $role->name }}">
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
                                        <td colspan="{{ $canShowRoleActions ? 4 : 3 }}" class="text-center py-4 text-muted">No roles found yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($canCreateRole)
    <div class="modal" id="createRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.roles.store') }}" method="POST" class="ajax-form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_modal" value="createRoleModal">
                        @include('admin.roles.partials.form', [
                            'roleModel' => null,
                            'permissionsByGuard' => $permissionsByGuard,
                            'formKey' => 'create',
                        ])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@if ($canUpdateRole)
    @foreach ($roles as $role)
        <div class="modal" id="editRoleModal-{{ $role->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="ajax-form">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_modal" value="editRoleModal-{{ $role->id }}">
                            @include('admin.roles.partials.form', [
                                'roleModel' => $role,
                                'permissionsByGuard' => $permissionsByGuard,
                                'formKey' => 'edit-'.$role->id,
                            ])
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Role</button>
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

