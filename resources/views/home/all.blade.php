@extends('layouts.app')

@section('title', 'Semua Hotel')

@section('content')
<div class="page-grey">
    <div style="padding: 16px;">

        {{-- Header --}}
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
            <a href="{{ route('home') }}" style="text-decoration:none; color:#222; font-size:22px;">←</a>
            <h2 style="font-size:18px; font-weight:700; margin:0; color:#222;">Semua Hotel</h2>
        </div>

        {{-- Hotel List --}}
        @if($hotels->count() > 0)
        <div style="display:flex; flex-direction:column; gap:12px;">
            @foreach($hotels as $hotel)
            <a href="{{ route('hotel.detail', $hotel) }}" style="text-decoration:none;">
                <div style="background:white; border-radius:12px; padding:12px; display:flex; gap:12px; align-items:center; box-shadow:0 2px 6px rgba(0,0,0,0.08);">
                    {{-- Gambar Hotel --}}
                    <div style="width:70px; height:70px; border-radius:8px; overflow:hidden; flex-shrink:0; background:#E3F2FD; display:flex; align-items:center; justify-content:center;">
                        @if($hotel->image)
                        <img src="{{ asset('storage/'.$hotel->image) }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                        <i class="bi bi-building" style="font-size:28px; color:#90CAF9;"></i>
                        @endif
                    </div>
                    {{-- Info Hotel --}}
                    <div style="flex:1;">
                        <div style="font-size:15px; font-weight:600; color:#222;">{{ $hotel->name }}</div>
                        <div style="font-size:12px; color:#888; margin-top:2px;">{{ ucfirst($hotel->category) }}</div>
                        <div style="font-size:14px; font-weight:700; color:#1565C0; margin-top:4px;">${{ number_format($hotel->price_per_night, 0) }}/malam</div>
                    </div>
                    {{-- Arrow --}}
                    <div style="color:#1565C0; font-size:18px;">›</div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div style="text-align:center; padding:40px; color:#888;">
            <i class="bi bi-building-x" style="font-size:48px;"></i>
            <p style="margin-top:12px;">Belum ada hotel tersedia.</p>
        </div>
        @endif

    </div>
</div>
@endsection