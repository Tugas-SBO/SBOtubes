@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="topbar">
    <h1>Dashboard</h1>
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> Tambah Hotel
    </a>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="number">{{ $totalHotels }}</div>
            <div class="label">Total Hotel</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="number">{{ $activeHotels }}</div>
            <div class="label">Hotel Aktif</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="number">{{ $hotelCategory }}</div>
            <div class="label">Kategori Hotel</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="number">{{ $travelCategory }}</div>
            <div class="label">Kategori Traveling</div>
        </div>
    </div>
</div>

{{-- Recent Hotels --}}
<div class="stat-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-semibold">Hotel Terbaru</h5>
        <a href="{{ route('admin.hotels') }}" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
    </div>
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>Nama Hotel</th>
                <th>Kategori</th>
                <th>Harga/Malam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentHotels as $hotel)
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        @if($hotel->image)
                            <img src="{{ asset('storage/' . $hotel->image) }}"
                                 style="width:40px;height:40px;object-fit:cover;border-radius:6px;" alt="">
                        @else
                            <div style="width:40px;height:40px;background:#E3F2FD;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-building text-primary"></i>
                            </div>
                        @endif
                        <span class="fw-medium">{{ $hotel->name }}</span>
                    </div>
                </td>
                <td>
                    <span class="badge {{ $hotel->category === 'hotel' ? 'badge-hotel' : 'badge-traveling' }}">
                        {{ ucfirst($hotel->category) }}
                    </span>
                </td>
                <td>${{ number_format($hotel->price_per_night, 0) }}/malam</td>
                <td>
                    <span class="badge {{ $hotel->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $hotel->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.hotels.edit', $hotel) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">Belum ada hotel. <a href="{{ route('admin.hotels.create') }}">Tambah sekarang</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
