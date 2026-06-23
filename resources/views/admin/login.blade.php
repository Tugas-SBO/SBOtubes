<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - StayQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1565C0 0%, #0D47A1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }
        .admin-badge {
            background: #1565C0;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .btn-admin {
            background: #1565C0;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
        }
        .btn-admin:hover { background: #0D47A1; color: white; }
        .form-control:focus { border-color: #1565C0; box-shadow: 0 0 0 3px rgba(21,101,192,0.15); }
    </style>
</head>
<body>
<div class="login-card">
    <div class="text-center mb-4">
        <svg width="50" height="50" viewBox="0 0 64 64" fill="none" class="mb-2">
            <path d="M32 8L8 24v32h16V40h16v16h16V24L32 8z" fill="#1565C0"/>
            <circle cx="32" cy="26" r="7" fill="#FFA726"/>
            <path d="M28 26l3 3 5-6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h4 class="fw-bold text-dark mb-1">StayQ</h4>
        <span class="admin-badge">ADMIN PANEL</span>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold small">Username</label>
            <input type="text" name="username" class="form-control"
                   placeholder="Admin username" value="{{ old('username') }}" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold small">Password</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Password" required>
        </div>
        <button type="submit" class="btn-admin">
            <i class="bi bi-shield-lock me-2"></i>Login Admin
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-muted small">← Kembali ke Login User</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
