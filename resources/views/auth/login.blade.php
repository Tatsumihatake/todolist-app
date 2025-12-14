<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ToDoMaster</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fdf4ff;
            background-image: linear-gradient(135deg, #fdf4ff 0%, #f5f3ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px -10px rgba(139, 92, 246, 0.15);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(139, 92, 246, 0.1);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            border: none;
            color: white;
            padding: 12px;
            font-weight: 700;
            border-radius: 12px;
            transition: 0.3s;
        }
        .btn-gradient:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            color: white;
        }
        .form-control {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            border-radius: 12px;
        }
        .form-control:focus {
            background-color: white;
            border-color: #d946ef;
            box-shadow: 0 0 0 4px rgba(217, 70, 239, 0.1);
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="text-center mb-4">
            <img src="{{ asset('logo.png') }}" width="60" class="mb-3" onerror="this.style.display='none'">
            <h3 class="fw-bold" style="color: #4a044e;">Welcome Back!</h3>
            <p class="text-muted small">Silakan login untuk mengelola tugas Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-muted ps-1">Email</label>
                <input type="email" name="email" class="form-control" placeholder="kamu@email.com" value="{{ old('email') }}" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label class="form-label small fw-bold text-uppercase text-muted ps-1">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none small text-muted hover-pink">Lupa Password?</a>
                    @endif
                </div>
                
                <div class="position-relative">
                    <input type="password" name="password" id="loginPass" class="form-control pe-5" placeholder="••••••••" required>
                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" onclick="togglePassword('loginPass', this)"></i>
                </div>
                
                <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label small text-muted" for="remember_me">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-gradient w-100 mb-4 shadow-sm">Masuk Sekarang</button>

            <div class="text-center">
                <span class="text-muted small">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="text-decoration-none small fw-bold ms-1" style="color: #8b5cf6;">Daftar di sini</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>
</body>
</html>