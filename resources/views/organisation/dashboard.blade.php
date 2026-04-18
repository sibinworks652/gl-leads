@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Organisation Staffs</p><h3 class="mb-0">{{ $staffCount ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">New Leads</p><h3 class="mb-0">{{ $stats['new'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Contacted</p><h3 class="mb-0">{{ $stats['contacted'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Total Leads</p><h3 class="mb-0">{{ $stats['total'] ?? 0 }}</h3></div></div>
        </div>
    </div>
</div>
@endsection
