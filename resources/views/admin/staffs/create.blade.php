@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Add Staff</h4>
                    <form action="{{ route('admin.staffs.store') }}" method="POST">
                        @include('admin.staffs._form', [
                            'submitLabel' => 'Create Staff',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
