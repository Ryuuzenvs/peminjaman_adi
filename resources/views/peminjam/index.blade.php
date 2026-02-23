@extends('app')
@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-uppercase small fw-bold">Total Transaksi Aktif</h6>
                    <h2 class="mb-0">{{ $myloan->where('status', 'borrow')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-uppercase small fw-bold">Total Qty Barang (Sedang Dibawa)</h6>
                    <h2 class="mb-0">{{ $myloan->where('status', 'borrow')->sum('qty') }} <span class="small" style="font-size: 0.5em">Pcs</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pinjaman Saya</h5>
            <i class="fas fa-tools"></i>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Alat</th>
                            <th class="text-center">Qty</th> <th class="text-center">Status</th>
                            <th class="text-end">Tgl Pinjam / Deadline</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myloan as $loan)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $loan->tool->name_tools }}</div>
                                <small class="text-muted">Harga: Rp {{ number_format($loan->tool->price, 0, ',', '.') }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill bg-info text-dark">{{ $loan->qty }}</span>
                            </td>
                            <td class="text-center">
                                @if ($loan->status == 'pending')
                                    <span class="badge bg-secondary">Waiting ACC</span>
                                @elseif($loan->request_return_date)
                                    <span class="badge bg-warning text-dark">Request Return</span>
                                @else
                                    <span class="badge bg-success">Borrowed</span>
                                @endif
                            </td>
                            <td class="text-end text-muted small">
                                <div>{{ $loan->created_at->format('d/m/Y') }}</div>
                                <div class="text-danger fw-bold">Deadline: {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</div>
                            </td>
                            <td class="text-center">
                                @if ($loan->status == 'borrow' && !$loan->request_return_date)
                                    <form action="{{ route('loans.requestReturn', $loan->id) }}" method="POST" onsubmit="return confirm('Ajukan pengembalian sekarang?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Kembalikan
                                        </button>
                                    </form>
                                @elseif($loan->request_return_date)
                                    <i class="fas fa-clock text-warning" title="Menunggu Verifikasi"></i>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open d-block mb-2 fa-2x"></i>
                                Belum ada pinjaman aktif.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
<div class="card shadow-sm border-0 mt-5">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Alat di Tangan (Inventaris Saya)</h5>
        <span class="badge bg-light text-success">{{ $myloan->where('status', 'borrow')->sum('qty') }} Total Pcs</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Jumlah (Qty)</th>
                        <th>Kondisi Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        // Ambil hanya yang statusnya 'borrow', lalu kelompokkan berdasarkan nama alat
                        $toolsInHand = $myloan->where('status', 'borrow')->groupBy('tool_id');
                        $no = 1;
                    @endphp

                    @forelse($toolsInHand as $toolId => $loans)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="fw-bold">{{ $loans->first()->tool->name_tools }}</td>
                        <td class="text-center">
                            <span class="badge border text-dark">{{ $loans->first()->tool->category->name ?? 'Umum' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="h5 mb-0 text-primary">{{ $loans->sum('qty') }}</span> Pcs
                        </td>
                        <td class="text-center">
                            <span class="text-success small"><i class="fas fa-check-circle me-1"></i>Siap Digunakan</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Tidak ada alat yang sedang dibawa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="alert alert-warning mt-3 mb-0 py-2">
            <small><i class="fas fa-info-circle me-1"></i> Pastikan alat dikembalikan dalam kondisi baik sebelum melewati batas waktu (Deadline).</small>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
