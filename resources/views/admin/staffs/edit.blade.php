@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-xl-8">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Edit Staff</h4>
                    <form action="{{ route('admin.staffs.update', $staff) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.staffs._form', [
                            'submitLabel' => 'Update Staff',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
