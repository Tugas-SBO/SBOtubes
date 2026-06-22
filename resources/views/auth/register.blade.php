@extends('layouts.app')

@section('title', 'Register')
@section('fullpage')

<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(180deg, #29B6F6 0%, #1565C0 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-wrapper {
        width: 100%;
        max-width: 420px;
        padding: 20px;
    }

    .logo-card {
        background: white;
        border-radius: 18px;
        padding: 24px;
        text-align: center;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        display: inline-block;
    }

    .logo-card .brand-name {
        font-size: 18px;
        font-weight: 700;
        color: #1565C0;
        margin-top: 4px;
    }

    .logo-card .brand-sub {
        font-size: 11px;
        color: #888;
    }

    .input-label {
        font-size: 14px;
        font-weight: 600;
        color: #1565C0;
        margin-bottom: 5px;
        display: block;
    }

    .stayq-input {
        width: 100%;
        padding: 11px 14px;
        border: 2px solid #1565C0;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        outline: none;
        transition: border-color 0.2s;
        margin-bottom: 12px;
        box-sizing: border-box;
    }

    .stayq-input:focus {
        border-color: #0D47A1;
        box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.2);
    }

    .stayq-input::placeholder { color: #aaa; }

    .btn-register {
        width: 100%;
        padding: 12px;
        background: white;
        color: #333;
        border: 2px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 4px;
        transition: background 0.2s;
    }

    .btn-register:hover { background: #f0f0f0; }
</style>

<div class="register-wrapper mx-auto text-center">
    {{-- Logo --}}
    <div class="d-flex justify-content-center mb-2">
        <div class="logo-card">
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M32 8L8 24v32h16V40h16v16h16V24L32 8z" fill="#1565C0"/>
                <circle cx="32" cy="26" r="7" fill="#FFA726"/>
                <path d="M28 26l3 3 5-6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="brand-name">StayQ</div>
            <div class="brand-sub">Aplikasi Pemesanan Hotel</div>
        </div>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="alert alert-danger text-start" style="border-radius:8px; font-size:13px;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="text-start">
            <label class="input-label">Email</label>
            <input type="email" name="email" class="stayq-input" placeholder="type here"
                   value="{{ old('email') }}" required>
        </div>
        <div class="text-start">
            <label class="input-label">Username</label>
            <input type="text" name="username" class="stayq-input" placeholder="type here"
                   value="{{ old('username') }}" required>
        </div>
        <div class="text-start">
            <label class="input-label">Password</label>
            <input type="password" name="password" class="stayq-input" placeholder="type here" required>
        </div>
        <div class="text-start">
            <label class="input-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="stayq-input" placeholder="type here" required>
        </div>
        <button type="submit" class="btn-register">Register</button>
    </form>
</div>

@endsection
