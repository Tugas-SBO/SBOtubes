<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StayQ - @yield('title', 'Aplikasi Pemesanan Hotel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --stayq-blue: #1565C0;
            --stayq-blue-light: #1E88E5;
        }
        body { font-family: 'Segoe UI', sans-serif; }
        .stayq-navbar {
            background-color: var(--stayq-blue);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 64px;
        }
        .stayq-navbar .logo-box {
            background: white;
            border-radius: 10px;
            padding: 6px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stayq-navbar .nav-profile {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 28px;
            text-decoration: none;
        }
    </style>
    @stack('styles')
</head>
<body>

@if(View::hasSection('fullpage'))
    @yield('fullpage')
@else
    <nav class="stayq-navbar">
        <a href="{{ route('home') }}" style="text-decoration:none;">
            <div class="logo-box">
                <svg width="28" height="28" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 6L6 16v18h10v-10h8v10h10V16L20 6z" fill="#1565C0"/>
                    <circle cx="20" cy="17" r="4" fill="#FFA726"/>
                    <path d="M17 17l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </a>
        @auth
        <a href="{{ route('profile') }}" class="nav-profile">
            <i class="bi bi-person-circle"></i>
        </a>
        @endauth
    </nav>
    @yield('content')
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
