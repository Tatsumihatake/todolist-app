<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - ToDoMaster</title>
    
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
            max-width: 500px;
            border: 1px solid rgba(139, 92, 246, 0.1);
            text-align: center;
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
        .icon-box {
            width: 80px;
            height: 80px;
            background: #fdf4ff;
            color: #d946ef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="icon-box">
            <i class="bi bi-key-fill fs-1"></i>
        </div>

        <h3 class="fw-bold mb-2" style="color: #4a044e;">Lupa Password?</h3>
        <p class="text-muted small mb-4">
            Jangan panik! Masukkan email yang terdaftar, dan kami akan mengirimkan link untuk mereset passwordmu.
        </p>

        @if (session('status'))
            <div class="alert alert-success small text-start mb-4 border-0 bg-success bg-opacity-10 text-success fw-bold">
                <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4 text-start">
                <label class="form-label small fw-bold text-uppercase text-muted ps-1">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="kamu@email.com" value="{{ old('email') }}" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
            </div>

            <button type="submit" class="btn btn-gradient w-100 mb-4 shadow-sm">
                Kirim Link Reset
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none small fw-bold text-muted d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </form>
    </div>

</body>
</html>