@extends('app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Users List</h5>
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                <i class='fa-solid fa-plus'></i> Create
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm">
                <i class='fa-solid fa-arrow-left'></i> Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-start">Name</th>
                    <th class="text-start">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr>
                        <td class="text-start">{{ $u->username }}</td>
                        <td class="text-start">{{ $u->email }}</td>
                        <td class="text-center">
                            <span>{{ strtoupper($u->role) }}</span>
                        </td>
                        <td class="text-end">
                            @if ($u->id != auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $u->id) }}?role={{ $u->role }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">
                                        <i class='fa-solid fa-trash-can'></i>
                                    </button>
                                </form>
                                <a href="{{ route('users.edit', [$u->id, 'role' => $u->role]) }}" class="btn btn-warning btn-sm">
                                    <i class='fa-solid fa-pen-to-square'></i>
                                </a>
                            @else
                                <span class="text-muted small fst-italic">Logged In</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
