@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div>
                            <h4 class="card-title mb-1">Organisations</h4>
                            <p class="text-muted mb-0">Create, update, and remove organisations from a single popup flow.</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOrganisationModal">
                            <i class="bx bx-plus me-1"></i> Add Organisation
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Website</th>
                                    <th>Staff Count</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($organisations as $organisation)
                                    <tr>
                                        <td><div class="org-logo overflow-hidden" style="width: 80px;">
                                            <img src="{{ asset('storage/'. $organisation->logo) }}" alt="" width="100%"></div></td>
                                        <td>
                                            <div class="fw-semibold">{{ $organisation->name }}</div>
                                            <div class="text-muted small">{{ $organisation->code ?: 'No code' }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $organisation->email }}</div>
                                            <div class="text-muted small">{{ $organisation->phone ?: 'No phone' }}</div>
                                        </td>
                                        <td>
                                            @if ($organisation->website)
                                                <a href="{{ $organisation->website }}" target="_blank" rel="noopener">{{ $organisation->website }}</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $organisation->users_count }}</td>
                                        <td>
                                            <span class="badge {{ $organisation->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                                {{ $organisation->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <button
                                                type="button"
                                                class="btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editOrganisationModal-{{ $organisation->id }}"
                                            >
                                                <img src="{{ asset('assets/images/edit.svg') }}" alt="Edit">
                                            </button>
                                            <form action="{{ route('admin.organisations.destroy', $organisation) }}" method="POST" class="d-inline delete-record-form" data-item-label="{{ $organisation->name }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn"><img src="{{ asset('assets/images/delete.svg')}}" alt="Delete"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No organisations found yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $organisations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="createOrganisationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Organisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.organisations.store') }}" method="POST" enctype="multipart/form-data" class="ajax-form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_modal" value="createOrganisationModal">
                    @include('admin.organisations._form', [
                        'organisation' => new \App\Models\Organisation(),
                        'submitLabel' => 'Create Organisation',
                        'includeFormWrapper' => false,
                    ])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Organisation</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($organisations as $organisation)
    <div class="modal" id="editOrganisationModal-{{ $organisation->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Organisation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.organisations.update', $organisation) }}" method="POST" enctype="multipart/form-data" class="ajax-form">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_modal" value="editOrganisationModal-{{ $organisation->id }}">
                        @include('admin.organisations._form', [
                            'submitLabel' => 'Update Organisation',
                            'includeFormWrapper' => false,
                        ])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Organisation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
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
