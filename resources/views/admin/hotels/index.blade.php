@extends('admin.layout')
@section('title', 'Kelola Hotel')

@section('content')
<div class="topbar">
    <h1>Kelola Hotel</h1>
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> Tambah Hotel
    </a>
</div>

<div class="stat-card">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nama Hotel</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Harga/Malam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hotels as $hotel)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($hotel->image)
                        <img src="{{ asset('storage/' . $hotel->image) }}"
                             style="width:50px;height:50px;object-fit:cover;border-radius:8px;" alt="">
                    @else
                        <div style="width:50px;height:50px;background:#E3F2FD;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-building text-primary"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-medium">{{ $hotel->name }}</td>
                <td class="text-muted">{{ $hotel->location ?? '-' }}</td>
                <td>
                    <span class="badge {{ $hotel->category === 'hotel' ? 'badge-hotel' : 'badge-traveling' }}">
                        {{ ucfirst($hotel->category) }}
                    </span>
                </td>
                <td>${{ number_format($hotel->price_per_night, 0) }}</td>
                <td>
                    <span class="badge {{ $hotel->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $hotel->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.hotels.edit', $hotel) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.hotels.delete', $hotel) }}" method="POST"
                              onsubmit="return confirm('Hapus hotel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-5">
                    <i class="bi bi-building" style="font-size:40px;opacity:0.3;"></i>
                    <p class="mt-2">Belum ada hotel.</p>
                    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary btn-sm">Tambah Hotel</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $hotels->links() }}</div>
</div>
@endsection
