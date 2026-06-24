<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard') | StayQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --admin-blue: #1565C0; }
        body { background: #F5F7FA; font-family: 'Segoe UI', sans-serif; }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--admin-blue);
            position: fixed;
            top: 0; left: 0;
            padding: 0;
            z-index: 100;
        }
        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }
        .sidebar-brand .badge-admin {
            background: rgba(255,255,255,0.2);
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 500;
        }
        .sidebar-nav { padding: 16px 0; }
        .nav-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.15s;
        }
        .nav-item a:hover, .nav-item a.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        .nav-item a i { font-size: 18px; }

        .main-content {
            margin-left: 240px;
            padding: 24px;
            min-height: 100vh;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .topbar h1 { font-size: 22px; font-weight: 700; color: #111; margin: 0; }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .stat-card .number { font-size: 32px; font-weight: 700; color: var(--admin-blue); }
        .stat-card .label { font-size: 13px; color: #888; }
        .btn-primary { background: var(--admin-blue); border-color: var(--admin-blue); }
        .btn-primary:hover { background: #0D47A1; border-color: #0D47A1; }
        .table th { background: #F8F9FA; font-size: 13px; font-weight: 600; }
        .table td { font-size: 14px; vertical-align: middle; }
        .badge-hotel { background: #E3F2FD; color: #1565C0; }
        .badge-traveling { background: #E8F5E9; color: #2E7D32; }
    </style>
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <div class="sidebar-brand">
        <svg width="28" height="28" viewBox="0 0 64 64" fill="none">
            <path d="M32 8L8 24v32h16V40h16v16h16V24L32 8z" fill="white"/>
            <circle cx="32" cy="26" r="7" fill="#FFA726"/>
        </svg>
        StayQ
        <span class="badge-admin">ADMIN</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.hotels') }}" class="{{ request()->routeIs('admin.hotels*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Kelola Hotel
            </a>
        </div>
        <div class="nav-item" style="margin-top: auto; position: absolute; bottom: 20px; width: 100%;">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none;border:none;width:100%;text-align:left;">
                    <a href="#" style="color:rgba(255,255,255,0.7);">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </button>
            </form>
        </div>
    </nav>
</div>

{{-- Main Content --}}
<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
