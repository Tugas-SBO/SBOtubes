<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>StayQ - @yield('title', 'Aplikasi Pemesanan Hotel')</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --stayq-blue: #1565C0;
            --stayq-blue-light: #1E88E5;
            --stayq-bg: #1976D2;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
        }

        /* Navbar */
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

        .stayq-navbar .logo-box img {
            height: 32px;
            width: auto;
        }

        .stayq-navbar .logo-text {
            color: var(--stayq-blue);
            font-weight: 700;
            font-size: 13px;
            line-height: 1;
        }

        .stayq-navbar .nav-profile {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 28px;
            text-decoration: none;
            cursor: pointer;
        }

        /* Page wrapper with grey bg */
        .page-grey {
            background-color: #EBEBEB;
            min-height: calc(100vh - 64px);
        }

        /* Page wrapper with blue bg */
        .page-blue {
            background: linear-gradient(180deg, var(--stayq-blue-light) 0%, var(--stayq-bg) 100%);
            min-height: 100vh;
        }

        /* Back button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #222;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            padding: 14px 16px;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover { color: var(--stayq-blue); }

        /* Field card style */
        .field-card {
            background: #fff;
            border-radius: 0;
            padding: 0;
        }

        .field-label {
            font-size: 15px;
            font-weight: 600;
            color: #222;
            margin-bottom: 6px;
        }

        .field-value {
            background: #E8EAF0;
            border-radius: 6px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
            color: #333;
        }

        .field-value .icon {
            color: #444;
            font-size: 18px;
        }
    </style>

    @stack('styles')
</head>
<body>

@hasSection('fullpage')
    @yield('content')
@else
    {{-- Navbar --}}
    <nav class="stayq-navbar">
        <div class="logo-box">
            {{-- Inline SVG logo (simplified StayQ icon) --}}
            <svg width="28" height="28" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="8" fill="white"/>
                <path d="M20 6L6 16v18h10v-10h8v10h10V16L20 6z" fill="#1565C0" stroke="#1565C0" stroke-width="0.5"/>
                <circle cx="20" cy="17" r="4" fill="#FFA726" stroke="white" stroke-width="1"/>
                <path d="M17 17l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        @auth
        <a href="{{ route('profile') }}" class="nav-profile">
            <i class="bi bi-person-circle"></i>
        </a>
        @endauth
    </nav>

    {{-- Page Content --}}
    @yield('content')
@endsection

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
