@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    @php
        $routeParams = $routeParams ?? [];
        $panelUser = auth('admin')->user() ?: auth('web')->user();
        $canCreateLead = (bool) $panelUser?->can('leads.create') && $canManageLeads;
        $canUpdateLead = (bool) $panelUser?->can('leads.update');
        $canDeleteLead = (bool) $panelUser?->can('leads.delete') && $canManageLeads;
        $canShowLeadActions = $canUpdateLead || $canDeleteLead;
    @endphp
    <div class="row g-3 mb-3">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-2">New Leads</p>
                    <h3 class="mb-0">{{ $stats['new'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-2">Contacted</p>
                    <h3 class="mb-0">{{ $stats['contacted'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-2">Completed</p>
                    <h3 class="mb-0">{{ $stats['completed'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Leads</p>
                    <h3 class="mb-0">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-3">
                        <div>
                            <h4 class="card-title mb-1">{{ $pageTitle }}</h4>
                            <p class="text-muted mb-0">
                                {{ $canManageLeads ? 'Track and manage lead allocation and performance.' : 'These are the leads assigned to you.' }}
                            </p>
                        </div>
                        @if ($canCreateLead)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLeadModal">
                                <i class="bx bx-plus me-1"></i> Add Lead
                            </button>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Date</th>
                                    @if ($canShowLeadActions)
                                        <th class="text-end">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($leads as $lead)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $lead->name }}</div>
                                            <div class="text-muted small">{{ $lead->organisation?->name ?: 'No organisation' }}</div>
                                        </td>
                                        <td>{{ $lead->phone ?: 'N/A' }}</td>
                                        <td>{{ $lead->source ?: 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ ucfirst($lead->status) }}</span>
                                        </td>
                                        <td>{{ $lead->assignedUser?->name ?: 'Unassigned' }}</td>
                                        <td>{{ $lead->lead_date?->format('M d Y') ?: 'N/A' }}</td>
                                        @if ($canShowLeadActions)
                                            <td class="text-end">
                                                @if ($canUpdateLead)
                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editLeadModal-{{ $lead->id }}">
                                                        <img src="{{ asset('assets/images/edit.svg') }}" alt="Edit">
                                                    </button>
                                                @endif
                                                @if ($canDeleteLead)
                                                    <form action="{{ route($routePrefix.'.leads.destroy', array_merge($routeParams, ['lead' => $lead])) }}" method="POST" class="d-inline delete-record-form" data-item-label="{{ $lead->name }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn"><img src="{{ asset('assets/images/delete.svg')}}" alt="Delete"></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $canShowLeadActions ? 7 : 6 }}" class="text-center py-4 text-muted">No leads found yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($canCreateLead)
<div class="modal" id="createLeadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route($routePrefix.'.leads.store', $routeParams) }}" method="POST" class="ajax-form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_modal" value="createLeadModal">
                    @include('admin.leads.partials.form', ['lead' => new \App\Models\Lead(), 'readonlyMode' => false])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Lead</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if ($canUpdateLead)
    @foreach ($leads as $lead)
    <div class="modal" id="editLeadModal-{{ $lead->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $canManageLeads ? 'Edit Lead' : 'Update Lead Status' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route($routePrefix.'.leads.update', array_merge($routeParams, ['lead' => $lead])) }}" method="POST" class="ajax-form">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_modal" value="editLeadModal-{{ $lead->id }}">
                        @include('admin.leads.partials.form', ['readonlyMode' => ! $canManageLeads])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">{{ $canManageLeads ? 'Update Lead' : 'Save Status' }}</button>
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
