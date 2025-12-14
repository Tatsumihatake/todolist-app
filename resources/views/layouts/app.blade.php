<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ToDoMaster</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            /* --- PALET WARNA LOGO (BERRY THEME) --- */
            --primary-pink: #ec4899; /* Pink Terang */
            --primary-purple: #8b5cf6; /* Ungu Terang */
            --gradient-main: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            --gradient-hover: linear-gradient(135deg, #db2777 0%, #7c3aed 100%);
            
            /* Background yang lebih menyatu (Soft Pink/Purple Tint) */
            --bg-body: #fdf4ff; /* Tidak putih polos lagi, tapi pink sangat muda */
            --card-bg: #ffffff;
            --text-main: #4a044e; /* Teks ungu sangat tua (biar baca enak) */
            --text-muted: #868e96;
            
            --card-shadow: 0 10px 40px -10px rgba(139, 92, 246, 0.15); /* Bayangan bernuansa ungu */
        }

        [data-bs-theme="dark"] {
            --bg-body: #0f172a; 
            --card-bg: #1e293b;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --card-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.5);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: var(--card-bg);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            /* Logo Text Gradient */
            background: var(--gradient-main);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* OVERRIDE BOOTSTRAP BLUE (PENTING!) */
        .btn-primary, .btn-custom {
            background: var(--gradient-main) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4);
            transition: transform 0.2s;
        }
        
        .btn-primary:hover, .btn-custom:hover {
            background: var(--gradient-hover) !important;
            transform: translateY(-2px);
        }

        .text-primary {
            color: #d946ef !important; /* Ganti teks biru jadi fuchsia */
        }

        .bg-primary {
            background-color: #d946ef !important;
        }

        /* Card Styling */
        .custom-card {
            background: var(--card-bg);
            border: 1px solid rgba(139, 92, 246, 0.1); /* Border tipis ungu */
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Dropdown & Form Controls */
        .form-control:focus, .form-select:focus {
            border-color: #d946ef;
            box-shadow: 0 0 0 0.25rem rgba(217, 70, 239, 0.25);
        }
        
        /* Dark Mode Input Fix */
        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background-color: #334155;
            border-color: #475569;
            color: white;
        }
    </style>
</head>
<body>
    <div class="min-h-screen d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('tasks.index') }}">
                    <img src="{{ asset('logo.png') }}" width="42" height="42" style="object-fit: contain;" onerror="this.style.display='none'">
                    <span>ToDoMaster</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center gap-3">
                        <li class="nav-item">
                            <span class="fw-bold" style="color: var(--text-main); opacity: 0.8;">
                                Hi, {{ Auth::user()->name }}
                            </span>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link p-0" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                                    style="width: 42px; height: 42px; background: white; border: 1px solid #e9ecef;">
                                    <i class="bi bi-gear-fill" style="color: #8b5cf6;"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3 rounded-4 mt-2" style="min-width: 240px;">
                                <li>
                                    <a class="dropdown-item fw-bold rounded-3 py-2 mb-2 d-flex align-items-center" href="{{ route('profile.edit') }}" style="color: var(--text-main);">
                                        <i class="bi bi-person-circle me-2 text-primary"></i> Edit Profil
                                    </a>
                                </li>

                                <li class="mb-3 d-flex justify-content-between align-items-center px-2">
                                    <span class="small fw-bold text-muted text-uppercase">Tampilan</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="darkModeSwitch" style="cursor: pointer;">
                                        <label class="form-check-label" for="darkModeSwitch">🌙</label>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger fw-bold rounded-3 py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger fw-bold rounded-3 py-2">
                                            <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 flex-grow-1">
            {{ $slot }}
        </main>

        <footer class="text-center py-4 small text-muted">
            &copy; 2025 ToDoMaster Project
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const html = document.documentElement;
        const switchBtn = document.getElementById('darkModeSwitch');
        
        if (localStorage.getItem('theme') === 'dark') {
            html.setAttribute('data-bs-theme', 'dark');
            switchBtn.checked = true;
        }

        switchBtn.addEventListener('change', function() {
            if(this.checked) {
                html.setAttribute('data-bs-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-bs-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>