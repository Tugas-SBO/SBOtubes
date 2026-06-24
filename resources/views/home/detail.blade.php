@extends('layouts.app')
@section('title', $hotel->name)

@push('styles')
<style>
    .page-blue {
        background: linear-gradient(180deg, #1E88E5 0%, #1565C0 100%);
        min-height: calc(100vh - 64px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    .payment-title {
        font-size: 48px;
        font-weight: 900;
        color: white;
        text-align: center;
        margin-bottom: 40px;
        letter-spacing: 2px;
    }
    .hotel-photo {
        width: 100%;
        max-width: 460px;
        height: 320px;
        object-fit: cover;
        border-radius: 12px;
    }
    .facility-title {
        font-size: 28px;
        font-weight: 900;
        color: white;
        margin-bottom: 16px;
    }
    .facility-item {
        color: white;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .price-text {
        font-size: 32px;
        font-weight: 900;
        color: white;
        margin-bottom: 20px;
    }
    .btn-book {
        background: white;
        color: #333;
        border: none;
        padding: 12px 40px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-book:hover { background: #f0f0f0; }
    .photo-placeholder {
        width: 100%;
        max-width: 460px;
        height: 320px;
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.4);
        font-size: 60px;
    }
</style>
@endpush

@section('content')
<div class="page-blue">
    <div style="width: 100%; max-width: 900px;">
        <div class="payment-title">PAYMENT</div>
        <div class="d-flex gap-5 align-items-start flex-wrap">
            <div>
                @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}"
                    class="hotel-photo" alt="{{ $hotel->name }}">
                @else
                <div class="photo-placeholder"><i class="bi bi-building"></i></div>
                @endif
            </div>
            <div class="flex-grow-1">
                <div class="facility-title">FACILITY</div>
                @php $facilities = $hotel->facilities; @endphp
                @if(count($facilities) > 0)
                <div class="row">
                    <div class="col-6">
                        @foreach(array_slice($facilities, 0, 4) as $f)
                        <div class="facility-item">{{ $f }}</div>
                        @endforeach
                    </div>
                    <div class="col-6">
                        @foreach(array_slice($facilities, 4) as $f)
                        <div class="facility-item">{{ $f }}</div>
                        @endforeach
                    </div>
                </div>
                @else
                <p class="text-white opacity-75">Fasilitas belum diisi.</p>
                @endif
                <div class="price-text mt-4">
                    ${{ number_format($hotel->price_per_night, 0) }}/night
                </div>
                <a href="{{ route('booking.create', $hotel) }}" class="btn-book" style="text-decoration:none; display:inline-block; text-align:center;">BOOK NOW</a>
            </div>
        </div>
    </div>
</div>
@endsection