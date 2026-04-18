@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Assigned New</p><h3 class="mb-0">{{ $stats['new'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-4">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Assigned Contacted</p><h3 class="mb-0">{{ $stats['contacted'] ?? 0 }}</h3></div></div>
        </div>
        <div class="col-md-4">
            <div class="card"><div class="card-body"><p class="text-muted mb-2">Assigned Total</p><h3 class="mb-0">{{ $stats['total'] ?? 0 }}</h3></div></div>
        </div>
    </div>
</div>
@endsection
