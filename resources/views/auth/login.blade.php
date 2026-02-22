<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Peminjaman</title>
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        #jarak {
            /* margin-bottom: 100px !important; */
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center">

    <div style="width: 100%; max-width: 350px;" class="px-3">
        <img src="https://png.pngtree.com/png-clipart/20240525/original/pngtree-cute-hand-drawn-cartoon-school-stuff-sticker-set-vector-png-image_15177551.png"
            class="img-fluid d-block mx-auto mb-5" id="jarak" style="height: 100px; width: auto; "
            alt="Logo Sekolah">

        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-body p-4">


                <h3 class="text-center mb-4">Login</h3>

                @if (session('success'))
                    <div class="alert alert-success py-2">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger py-2">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="exam" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                            required>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="passwordError" class="invalid-feedback" style="display: none;">
                            Password minimal 8 karakter.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2" id="loginBtn">Login</button>
                </form>

            </div>

        </div>
        <div src="" class="img-fluid d-block mx-auto mb-3" style="height: 300px; width: auto;" alt=""></div>

    </div>

    <script>
        document.getElementById('loginForm').onsubmit = function(e) {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            const btn = document.getElementById('loginBtn');

            if (passwordInput.value.length < 8) {
                e.preventDefault();
                passwordInput.classList.add('is-invalid');
                passwordError.style.display = 'block';
                return false;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
            btn.classList.add('opacity-50');
        };

        document.getElementById('password').oninput = function() {
            this.classList.remove('is-invalid');
            document.getElementById('passwordError').style.display = 'none';
        };
    </script>

</body>

</html>
