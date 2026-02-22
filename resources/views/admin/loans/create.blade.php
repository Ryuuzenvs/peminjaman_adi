@extends('app')

@section('content')
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h3 class="text-center mb-4">Input Peminjaman Baru (Admin)</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pinjam.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Pilih Peminjam</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Alat</label>
                <select name="tool_id" class="form-control" required>
                    <option value="">-- Pilih Alat --</option>
                    @foreach($tools as $t)
                        <option value="{{ $t->id }}">{{ $t->name_tools }} (Stok: {{ $t->stock }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>
@endsection
