@extends('app')

@section('content')
<div class="card">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Category List</h5>
        <div>
            <a class="btn btn-warning btn-sm me-2" href="{{ route('admin.dashboard') }}">
                <i class='fas fa-arrow-left'></i> Back
            </a>
            <a class="btn btn-primary btn-sm" href="{{ route('category.create') }}">
                <i class='fa-solid fa-plus'></i> Create
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $c)
                    <tr>
                        <td>{{ $c->nama_kategori }}</td>
                        <td>
                            <form method="post" action="{{ route('category.destroy', $c->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class='fa-solid fa-trash-can'></i>
                                </button>
                            </form>
                            <a href="{{ route('category.edit', $c->id) }}" class="btn btn-warning btn-sm">
                                <i class='fa-solid fa-pen-to-square'></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
