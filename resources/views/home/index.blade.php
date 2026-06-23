@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<style>
    .page-blue {
        background: linear-gradient(180deg, #1E88E5 0%, #1565C0 100%);
        min-height: calc(100vh - 64px);
        padding: 30px 40px 60px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 900;
        color: white;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .hotel-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        display: block;
        text-decoration: none;
        transition: transform 0.2s;
    }

    .hotel-card:hover {
        transform: translateY(-4px);
    }

    .hotel-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
    }

    .hotel-card .card-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px 14px;
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.65) 0%, transparent 100%);
        color: white;
        font-size: 15px;
        font-weight: 600;
    }

    .travel-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        display: block;
        text-decoration: none;
        transition: transform 0.2s;
    }

    .travel-card:hover {
        transform: translateY(-4px);
    }

    .travel-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .travel-card .card-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 14px;
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.65) 0%, transparent 100%);
        color: white;
        font-size: 20px;
        font-weight: 900;
        letter-spacing: 1px;
    }

    .placeholder-img {
        width: 100%;
        height: 160px;
        background: rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.5);
        font-size: 40px;
    }

    .placeholder-img-travel {
        height: 220px;
    }
</style>
@endpush

@section('content')
<div class="page-blue">

    {{-- REKOMENDASI --}}
    <div class="section-title">REKOMENDASI</div>
    <div class="row g-3 mb-2">
        @forelse($recommended as $hotel)
        <div class="col-4">
            <a href="{{ route('hotel.detail', $hotel) }}" class="hotel-card">
                @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}" alt="{{ $hotel->name }}">
                @else
                <div class="placeholder-img"><i class="bi bi-building"></i></div>
                @endif
                <div class="card-label">{{ $hotel->name }}</div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center text-white opacity-50 py-4">
            <i class="bi bi-building" style="font-size:40px;"></i>
            <p class="mt-2">Belum ada hotel rekomendasi.</p>
        </div>
        @endforelse
    </div>

    {{-- Lihat Semua --}}
    <div style="text-align:right; margin-bottom:32px;">
        <a href="{{ route('hotels.all') }}" style="color:white; font-size:13px; text-decoration:none; font-weight:600;">
            Lihat Semua →
        </a>
    </div>

</div>
@endsection