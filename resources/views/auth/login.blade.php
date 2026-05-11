<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Mosarindo CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, .88), rgba(51, 65, 85, .7)),
                url("{{ asset('image/hero1.png') }}") center/cover no-repeat;
        }
        .login-shell { min-height: 100vh; }
        .login-card {
            width: min(100%, 430px);
            border: 1px solid rgba(255, 255, 255, .18);
            box-shadow: 0 28px 80px rgba(15, 23, 42, .35);
            animation: rise .45s ease both;
        }
        @keyframes rise {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .brand-mark {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: #dba554;
            color: #fff;
        }
    </style>
</head>
<body>
    <main class="login-shell d-flex align-items-center justify-content-center p-3">
        <section class="login-card rounded-4 bg-white p-4 p-sm-5">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="brand-mark"><i class="bi bi-shield-lock fs-4"></i></div>
                <div>
                    <p class="mb-1 text-uppercase fw-bold text-secondary small">Mosarindo CMS</p>
                    <h1 class="h4 fw-bold mb-0">Masuk Admin</h1>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" data-loading-form>
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" autocomplete="email" required autofocus>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group input-group-lg">
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required>
                        <button class="btn btn-outline-secondary" type="button" data-toggle-password aria-label="Tampilkan password">
                            <i class="bi bi-eye"></i>
                        </button>
                        @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <a href="{{ route('home') }}" class="small text-decoration-none">Kembali ke website</a>
                </div>

                <button type="submit" class="btn btn-dark btn-lg w-100" data-loading-button>
                    <span class="button-text">Masuk</span>
                    <span class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                </button>
            </form>
        </section>
    </main>

    <script>
        document.querySelector('[data-toggle-password]')?.addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon = this.querySelector('i');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
        });

        document.querySelector('[data-loading-form]')?.addEventListener('submit', function () {
            const button = this.querySelector('[data-loading-button]');
            button.disabled = true;
            button.querySelector('.button-text').textContent = 'Memproses...';
            button.querySelector('.spinner-border').classList.remove('d-none');
        });
    </script>
</body>
</html>
