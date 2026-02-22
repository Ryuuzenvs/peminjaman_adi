@extends('app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Loans
    </div>

    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Tool</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Loan Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($myloan as $loan)
                <tr>

                    <td class="text-start fw-semibold">
                        {{ $loan->tool->name_tools }}
                    </td>

                    <td class="text-center">
                        @if ($loan->status == 'pending')
                            <span class="badge bg-secondary">
                                waiting ACC
                            </span>

                        @elseif($loan->request_return_date)
                            <span class="badge bg-warning text-dark">
                                Request Return
                            </span>

                        @else
                            <span class="badge bg-success">
                                borrowed
                            </span>
                        @endif
                    </td>

                    <td class="text-end text-muted">
                        {{ $loan->created_at->format('d M Y H:i:s') }}
                    </td>

                    <td class="text-center">
                        @if ($loan->status == 'borrow' && !$loan->request_return_date)
                            <form action="{{ route('loans.requestReturn', $loan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Ajukan Pengembalian
                                </button>
                            </form>

                        @elseif($loan->request_return_date)
                            <span class="text-muted small">
                                Menunggu Verifikasi
                            </span>
                        @else
                            -
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Tidak ada pinjaman aktif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
