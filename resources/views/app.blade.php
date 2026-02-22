<link href={{ asset('bootstrap.min.css') }} rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('fas/css/all.min.css') }}">
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="{{ asset('bootstrap.bundle.min.js') }}"></script>



<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">

        <div class="container">
            @php
                $user = Auth::user();
            @endphp
            <a class="navbar-brand" href="{{ $user ? route($user->role . '.dashboard') : '#' }}">
                PinjamAlat
            </a>

            <div class="navbar-nav">
                @if ($user && $user->role === 'admin')
                    <a class="nav-link" href="{{ route('category.index') }}">Category</a>
                    <a class="nav-link" href="{{ route('tools.index') }}">Tool</a>
                    <a class="nav-link" href="{{ route('users.index') }}">User</a>
                    <a class="nav-link" href="{{ route('admin.loans.index') }}">Loan</a>
                    <a class="nav-link" href="{{ route('admin.logs.index') }}">Logs</a>
                @elseif($user && $user->role === 'officer')
                    <a class="nav-link" href="{{ route('officer.dashboard') }}">Manegement</a>
                    <a class="nav-link" href="{{ route('officer.report') }}">Report</a>
                @elseif($user && $user->role === 'borrower')
                    <a class="nav-link" href="{{ route('borrower.dashboard') }}">My Loans</a>
                    <a class="nav-link" href="{{ route('borrower.pinjam') }}">Get Loans</a>
                    <a class="nav-link" href="{{ route('borrower.history') }}">Get Return</a>
                @endif
                <form action="{{ route('logout') }}" method="post" class="d-inline">
                    @auth
                        <form action="{{ route('logout') }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout ({{ $user->username }})</button>
                        </form>
                    @endauth
                </form>
            </div>
        </div>

    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
