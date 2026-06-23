@extends('layouts.app')

@section('title', 'Booking Berhasil')
@section('fullpage')

<style>
    body {
        margin: 0;
        background: linear-gradient(180deg, #29B6F6 0%, #1565C0 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        background: white;
        border-radius: 18px;
        padding: 40px 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        max-width: 400px;
        text-align: center;
    }

    .icon {
        font-size: 64px;
        margin-bottom: 16px;
    }

    h1 {
        font-size: 22px;
        font-weight: 700;
        color: #1565C0;
        margin-bottom: 8px;
    }

    p {
        font-size: 14px;
        color: #666;
        margin-bottom: 24px;
    }

    .btn-home {
        display: inline-block;
        padding: 12px 32px;
        background: #1565C0;
        color: white;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
    }
</style>

<div style="display:flex; justify-content:center; align-items:center; min-height:100vh;">
    <div class="card">
        <div class="icon">✅</div>
        <h1>Booking Berhasil!</h1>
        <p>Terima kasih! Pemesanan hotel kamu sudah kami terima dan sedang diproses.</p>
        <a href="{{ route('home') }}" class="btn-home">Kembali ke Beranda</a>
    </div>
</div>

@endsection