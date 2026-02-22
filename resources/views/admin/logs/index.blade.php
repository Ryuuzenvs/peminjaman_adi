@extends('app')

@section('content')
<div class="card">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Aktivitas Sistem</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="200">Waktu Kejadian</th>
                        <th>Keterangan Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $key => $log)
                    <tr>
                        <td>{{ $logs->firstItem() + $key }}</td>
                        <td>
                            <small class="text-muted">
                                {{ $log->created_at->format('d M Y | H:i:s') }}
                            </small>
                        </td>
                        <td>
                            <span class="text-dark">{{ $log->data }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center italic">Belum ada log aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table> 
        </div>

        <div class="d-flex justify-content-center align-items-center">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
