@extends('app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>All Loan Management</h2>
            <span>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                    <i class='fas fa-arrow-left'></i> Back
                </a>
                <a href="{{ route('admin.loans.create') }}" class="btn btn-primary btn-sm">
                    <i class='fa-solid fa-plus'></i> Create
                </a>
            </span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Borrower</th>
                            <th>Tool</th>
                            <th>Loan Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th>Penalty</th>
                            <th>Admin Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $l)
                            <tr>
                                <td><strong>{{ $l->id }}</strong></td>
                                <td><strong>{{ $l->borrower->username }}</strong></td>
                                <td>{{ $l->tool->name_tools ?? 'Deleted Tool' }}</td>
                                <td>{{ \Carbon\Carbon::parse($l->loan_date)->format('d M Y') }}</td>
                                <td>
                                    {{ $l->return_date ? \Carbon\Carbon::parse($l->return_date)->format('d M Y') : 'No Data' }}
                                </td>
                                <td>
                                    @if ($l->status == 'pending')
                                        <span class="text-warning">PENDING</span>
                                    @elseif ($l->status == 'borrow')
                                        <span class="text-primary">BORROWED</span>
                                    @else
                                        <span class="text-success">RETURNED</span>
                                    @endif
                                </td>
                                <td><span class="text-danger">Rp {{ number_format($l->penalty) }}</span></td>
                                <td><small>{{ $l->approver->username ?? 'No Admin' }}</small></td>
                                <td>{{ \Carbon\Carbon::parse($l->created_at)->format('d M Y H:i:s') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('loans.destroy', $l->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this transaction? Stock will be adjusted automatically.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <a href="{{ route('admin.loans.edit', $l->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center align-items-center">
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
