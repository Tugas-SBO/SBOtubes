@extends('layouts.app')

@section('title', 'Booking Hotel')
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

    .booking-wrapper {
        width: 100%;
        max-width: 440px;
        padding: 20px;
    }

    .card {
        background: white;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .hotel-name {
        font-size: 20px;
        font-weight: 700;
        color: #1565C0;
        margin-bottom: 4px;
    }

    .hotel-price {
        font-size: 14px;
        color: #888;
        margin-bottom: 20px;
    }

    .input-label {
        font-size: 14px;
        font-weight: 600;
        color: #1565C0;
        display: block;
        margin-bottom: 5px;
    }

    .stayq-input {
        width: 100%;
        padding: 11px 14px;
        border: 2px solid #1565C0;
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 14px;
        box-sizing: border-box;
    }

    .btn-book {
        width: 100%;
        padding: 12px;
        background: #1565C0;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 12px;
        color: white;
        font-size: 13px;
        text-decoration: none;
    }
</style>

<div class="booking-wrapper mx-auto">
    <div class="card">
        <div class="hotel-name">{{ $hotel->name }}</div>
        <div class="hotel-price">${{ number_format($hotel->price_per_night, 0) }}/malam</div>

        @if($errors->any())
        <div style="background:#fee; border:1px solid red; padding:10px; border-radius:8px; margin-bottom:1rem; font-size:13px; color:red;">
            @foreach($errors->all() as $error)
            <p>• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('hotel.book', $hotel) }}">
            @csrf
            <div>
                <label class="input-label">Check-in</label>
                <input type="date" name="check_in" class="stayq-input" value="{{ old('check_in') }}" required>
            </div>
            <div>
                <label class="input-label">Check-out</label>
                <input type="date" name="check_out" class="stayq-input" value="{{ old('check_out') }}" required>
            </div>
            <div>
                <label class="input-label">Jumlah Tamu</label>
                <input type="number" name="guests" class="stayq-input" value="{{ old('guests', 1) }}" min="1" max="10" required>
            </div>
            <button type="submit" class="btn-book">Konfirmasi Booking</button>
        </form>
    </div>
    <a href="{{ route('hotel.detail', $hotel) }}" class="back-link">← Kembali ke detail hotel</a>
</div>

@endsection