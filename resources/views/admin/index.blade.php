@extends('app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
<h2>Welcome, {{ Auth::user()?->username }}</h2>

        <p class="text-muted">Role: <span class="badge bg-primary">Admin</span></p>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <h5>Total Tool</h5>
                <h3>{{ \App\Models\tool::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5>Activated loans</h5>
                <h3>{{ \App\Models\loan::where('status', 'borrow')->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h5>Need approve</h5>
                <h3>{{ \App\Models\loan::where('status', 'pending')->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Quick access</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('tools.index') }}" class="btn btn-outline-primary">tools</a>
                <a href="{{route('category.index')}}" class="btn btn-outline-secondary">category</a>
                <a href="{{route('users.index')}}" class="btn btn-outline-warning"> users</a>
                <a href="{{route('admin.loans.index')}}" class="btn btn-outline-primary">loans</a>
                <a href="{{route('admin.logs.index')}}" class="btn btn-outline-secondary">logs</a>
                </div>
        </div>
    </div>
</div>
@endsection
