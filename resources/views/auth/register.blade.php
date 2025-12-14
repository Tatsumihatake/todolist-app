<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - ToDoMaster</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fdf4ff; /* Pink Muda */
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
            max-width: 500px;
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
            <h3 class="fw-bold" style="color: #4a044e;">Buat Akun Baru</h3>
            <p class="text-muted small">Mulai atur produktivitasmu hari ini.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-muted ps-1">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Kamu" value="{{ old('name') }}" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1" />
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-muted ps-1">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="kamu@email.com" value="{{ old('email') }}" required>
                <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-muted ps-1">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" id="regPassword" class="form-control pe-5" placeholder="Minimal 8 karakter" required>
                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" onclick="togglePassword('regPassword', this)"></i>
                </div>
                <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase text-muted ps-1">Konfirmasi Password</label>
                <div class="position-relative">
                    <input type="password" name="password_confirmation" id="regConfirm" class="form-control pe-5" placeholder="Ulangi password..." required onkeyup="checkMatch()">
                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;" onclick="togglePassword('regConfirm', this)"></i>
                </div>
                
                <div id="matchMessage" class="small mt-2 fw-bold" style="display: none;"></div>
            </div>

            <button type="submit" class="btn btn-gradient w-100 mb-3 shadow-sm">Daftar Sekarang</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none small fw-bold" style="color: #8b5cf6;">Sudah punya akun? Login di sini</a>
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

        function checkMatch() {
            const pass = document.getElementById('regPassword').value;
            const confirm = document.getElementById('regConfirm').value;
            const msg = document.getElementById('matchMessage');

            if (confirm.length > 0) {
                msg.style.display = 'block';
                if (pass === confirm) {
                    msg.style.color = '#10b981'; // Hijau
                    msg.innerHTML = '<i class="bi bi-check-circle-fill"></i> Password Cocok!';
                } else {
                    msg.style.color = '#ef4444'; // Merah
                    msg.innerHTML = '<i class="bi bi-x-circle-fill"></i> Password Belum Cocok';
                }
            } else {
                msg.style.display = 'none';
            }
        }
    </script>
</body>
</html>