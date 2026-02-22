@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Tools List</h5>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm me-2">
                <i class='fa-solid fa-arrow-left'></i> Back
            </a>
            <a href="{{ route('tools.create') }}" class="btn btn-primary btn-sm">
                <i class='fa-solid fa-plus'></i> Create
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th class="text-start">Tool Name</th>
                    <th class="text-start">Category</th>
                    <th class="text-end">Stock</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tools as $t)
                <tr>
                    <td class="text-start">{{ $t->name_tools }}</td>
                    <td class="text-start">{{ $t->category->nama_kategori ?? '-' }}</td>
                    <td class="text-end">{{ $t->stock }}</td>
                    <td class="text-end">
                        <form method="POST" action="{{ route('tools.destroy', $t->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class='fa-solid fa-trash-can'></i> Delete
                            </button>
                        </form>
                        <a href="{{ route('tools.edit', $t->id) }}" class="btn btn-warning btn-sm">
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No tools found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
