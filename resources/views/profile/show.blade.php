@extends('app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profile Account</h5>
                    <span class="badge bg-light text-primary text-uppercase">{{ $user->role }}</span>
                </div>
                <div class="card-body p-4">
                    
                    @if(session('info'))
                        <div class="alert alert-info border-0 shadow-sm">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('info') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->username }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->email }}" readonly>
                            </div>

                            <hr class="my-3">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Full Name (Sesuai KTP/Kartu Pelajar)</label>
                                <input type="text" name="name" class="form-control @if(!$isOwner) bg-light @endif" 
                                    value="{{ $user->borrower->name ?? '' }}" 
                                    placeholder="Belum diisi" 
                                    {{ $isOwner ? 'required' : 'readonly' }}>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Class / Division</label>
                                <input type="text" name="class" class="form-control @if(!$isOwner) bg-light @endif" 
                                    value="{{ $user->borrower->class ?? '' }}" 
                                    placeholder="Contoh: XII RPL 1" 
                                    {{ $isOwner ? 'required' : 'readonly' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="javascript:history.back()" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>

                            @if($isOwner)
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save me-2"></i>Update Profile
                                </button>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
