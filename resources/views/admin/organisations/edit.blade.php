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
                    <h4 class="card-title mb-3">Edit Organisation</h4>
                    <form action="{{ route('admin.organisations.update', $organisation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.organisations._form', [
                            'submitLabel' => 'Update Organisation',
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
