@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Add Organisation</h4>
                    <form action="{{ route('admin.organisations.store') }}" method="POST">
                        @include('admin.organisations._form', [
                            'submitLabel' => 'Create Organisation',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
