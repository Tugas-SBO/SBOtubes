{{-- Hotel Name --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Nama Hotel <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $hotel->name ?? '') }}" required>
</div>

{{-- Category --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
    <select name="category" class="form-select" required>
        <option value="hotel" {{ old('category', $hotel->category ?? '') === 'hotel' ? 'selected' : '' }}>Hotel (Rekomendasi)</option>
        <option value="traveling" {{ old('category', $hotel->category ?? '') === 'traveling' ? 'selected' : '' }}>Traveling (Destinasi)</option>
    </select>
</div>

{{-- Location --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Lokasi</label>
    <input type="text" name="location" class="form-control"
           placeholder="Contoh: Bandung, Indonesia"
           value="{{ old('location', $hotel->location ?? '') }}">
</div>

{{-- Price --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Harga per Malam ($) <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <input type="number" name="price_per_night" class="form-control"
               step="0.01" min="0" placeholder="50"
               value="{{ old('price_per_night', $hotel->price_per_night ?? '') }}" required>
    </div>
</div>

{{-- Description --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Deskripsi</label>
    <textarea name="description" class="form-control" rows="3"
              placeholder="Deskripsi singkat hotel...">{{ old('description', $hotel->description ?? '') }}</textarea>
</div>

{{-- Image --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Foto Hotel</label>
    @if(isset($hotel) && $hotel->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $hotel->image) }}"
                 style="width:120px;height:80px;object-fit:cover;border-radius:8px;" alt="Current">
            <small class="text-muted d-block mt-1">Foto saat ini. Upload baru untuk mengganti.</small>
        </div>
    @endif
    <input type="file" name="image" class="form-control" accept="image/*">
</div>

{{-- Facilities --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Fasilitas</label>
    <div class="row g-2">
        @php
            $facilities = [
                'has_ac'          => 'AC',
                'has_wifi'        => 'Wi-Fi',
                'has_restaurant'  => 'Restaurant',
                'has_front_desk'  => '24-Hour Front Desk',
                'has_parking'     => 'Parking',
                'has_pool'        => 'Swimming Pool',
                'has_gym'         => 'Gym',
                'has_laundry'     => 'Laundry',
            ];
        @endphp
        @foreach($facilities as $key => $label)
        <div class="col-6 col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{ $key }}" id="{{ $key }}"
                       {{ old($key, isset($hotel) ? $hotel->$key : false) ? 'checked' : '' }}>
                <label class="form-check-label small" for="{{ $key }}">{{ $label }}</label>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Status --}}
<div class="mb-4">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
               {{ old('is_active', isset($hotel) ? $hotel->is_active : true) ? 'checked' : '' }}>
        <label class="form-check-label fw-semibold" for="is_active">Hotel Aktif (tampil di homepage)</label>
    </div>
</div>
