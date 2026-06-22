@extends('layouts.app')

@section('title', 'Profile')

@push('styles')
<style>
    .page-blue {
        background: linear-gradient(180deg, #1E88E5 0%, #1565C0 100%);
        min-height: calc(100vh - 64px);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 40px 20px;
    }

    .avatar-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #E0E0E0;
        border: 3px solid #1E3A8A;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        overflow: hidden;
    }

    .avatar-circle i {
        font-size: 52px;
        color: #1E3A8A;
    }

    .username-badge {
        background: white;
        border-radius: 8px;
        padding: 8px 40px;
        font-size: 16px;
        font-weight: 600;
        color: #222;
        margin-bottom: 32px;
        display: inline-block;
    }

    .menu-btn {
        display: flex;
        align-items: center;
        gap: 14px;
        background: white;
        border: none;
        border-radius: 8px;
        padding: 14px 20px;
        width: 260px;
        font-size: 15px;
        font-weight: 500;
        color: #222;
        cursor: pointer;
        text-decoration: none;
        margin-bottom: 12px;
        transition: background 0.15s, transform 0.1s;
    }

    .menu-btn:hover {
        background: #f0f0f0;
        transform: translateY(-1px);
        color: #111;
    }

    .menu-btn i {
        font-size: 20px;
        color: #333;
    }
</style>
@endpush

@section('content')
<div class="page-blue">
    {{-- Avatar --}}
    <div class="avatar-circle">
        @if(auth()->user()->avatar)
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                 style="width:100%;height:100%;object-fit:cover;" alt="avatar">
        @else
            <i class="bi bi-person"></i>
        @endif
    </div>

    {{-- Username --}}
    <div class="username-badge">{{ auth()->user()->username }}</div>

    {{-- Menu Buttons --}}
    <a href="{{ route('account.setting') }}" class="menu-btn">
        <i class="bi bi-gear"></i>
        Account settings
    </a>

    <a href="{{ route('help.center') }}" class="menu-btn">
        <i class="bi bi-question-circle"></i>
        Help and Support
    </a>

    {{-- Sign Out triggers modal --}}
    <button class="menu-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="bi bi-box-arrow-right"></i>
        Sign Out
    </button>
</div>

{{-- Logout Confirmation Modal --}}
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px; overflow:hidden;">
            <div class="modal-header border-bottom" style="padding:14px 20px;">
                <div class="d-flex align-items-center gap-2">
                    <svg width="28" height="28" viewBox="0 0 64 64" fill="none">
                        <path d="M32 8L8 24v32h16V40h16v16h16V24L32 8z" fill="#1565C0"/>
                        <circle cx="32" cy="26" r="7" fill="#FFA726"/>
                        <path d="M28 26l3 3 5-6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <strong style="font-size:15px;">StayQ</strong>
                </div>
            </div>
            <div class="modal-body" style="padding:20px 24px 10px;">
                <p style="font-size:16px; font-weight:600; margin-bottom:10px;">Are you sure you want to log out?</p>
                <p style="font-size:13px; color:#555; margin-bottom:0;">Your session will be ended and you will need to log in again to access your bookings.</p>
            </div>
            <div class="modal-footer border-0 justify-content-end" style="padding:16px 24px;">
                <button type="button" class="btn btn-dark px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-dark px-4">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
