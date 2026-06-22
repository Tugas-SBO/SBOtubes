@extends('layouts.app')

@section('title', 'Account Setting')

@push('styles')
<style>
    .page-grey {
        background-color: #EBEBEB;
        min-height: calc(100vh - 64px);
        padding-bottom: 40px;
    }

    .back-row {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        background: #EBEBEB;
    }

    .back-row a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #222;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
    }

    .back-row a:hover { color: #1565C0; }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #111;
    }

    /* Avatar section */
    .avatar-section {
        display: flex;
        justify-content: center;
        padding: 30px 0 20px;
        position: relative;
    }

    .avatar-wrap {
        position: relative;
        display: inline-block;
    }

    .avatar-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #1565C0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .avatar-circle i {
        font-size: 44px;
        color: white;
    }

    .edit-avatar-btn {
        position: absolute;
        bottom: 0;
        right: -4px;
        background: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        cursor: pointer;
        font-size: 14px;
        color: #333;
        padding: 0;
    }

    /* Field */
    .field-group {
        padding: 0 60px;
        margin-bottom: 20px;
    }

    .field-label {
        font-size: 15px;
        font-weight: 600;
        color: #111;
        margin-bottom: 6px;
    }

    .field-value-row {
        background: #DDE1EA;
        border-radius: 8px;
        padding: 11px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        color: #333;
    }

    .field-icon {
        color: #333;
        font-size: 17px;
        cursor: pointer;
    }

    /* Edit modal input */
    .edit-input {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #1565C0;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
    }

    .edit-input:focus {
        box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.15);
    }
</style>
@endpush

@section('content')
<div class="page-grey">
    {{-- Back header --}}
    <div class="back-row">
        <a href="{{ route('profile') }}">
            <i class="bi bi-arrow-left"></i>
            <span class="page-title">Account Setting</span>
        </a>
    </div>

    {{-- Avatar --}}
    <div class="avatar-section">
        <div class="avatar-wrap">
            <div class="avatar-circle">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                         style="width:100%;height:100%;object-fit:cover;" alt="avatar">
                @else
                    <i class="bi bi-person-fill"></i>
                @endif
            </div>
            <button class="edit-avatar-btn" title="Edit photo">
                <i class="bi bi-pencil-square"></i>
            </button>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success mx-4" style="border-radius:8px; font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Nama --}}
    <div class="field-group">
        <div class="field-label">Nama</div>
        <div class="field-value-row">
            <span>{{ auth()->user()->username }}</span>
            <i class="bi bi-pencil-square field-icon" data-bs-toggle="modal" data-bs-target="#editNamaModal"></i>
        </div>
    </div>

    {{-- No HP --}}
    <div class="field-group">
        <div class="field-label">No HP</div>
        <div class="field-value-row">
            <span>{{ auth()->user()->phone ?? '08xxxxxxxx' }}</span>
            <i class="bi bi-pencil-square field-icon" data-bs-toggle="modal" data-bs-target="#editPhoneModal"></i>
        </div>
    </div>

    {{-- Tanggal Lahir --}}
    <div class="field-group">
        <div class="field-label">Tanggal lahir</div>
        <div class="field-value-row">
            <span>{{ auth()->user()->birth_date ? \Carbon\Carbon::parse(auth()->user()->birth_date)->format('j F Y') : 'Belum diisi' }}</span>
            <i class="bi bi-calendar3 field-icon" data-bs-toggle="modal" data-bs-target="#editBirthModal"></i>
        </div>
    </div>

    {{-- Alamat --}}
    <div class="field-group">
        <div class="field-label">Alamat</div>
        <div class="field-value-row">
            <span>{{ auth()->user()->address ?? 'Belum diisi' }}</span>
            <i class="bi bi-geo-alt-fill field-icon" data-bs-toggle="modal" data-bs-target="#editAddressModal"></i>
        </div>
    </div>
</div>

{{-- ========== MODALS ========== --}}

{{-- Edit Nama Modal --}}
<div class="modal fade" id="editNamaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Nama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label class="form-label fw-semibold">Nama / Username</label>
                    <input type="text" name="username" class="edit-input"
                           value="{{ auth()->user()->username }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Phone Modal --}}
<div class="modal fade" id="editPhoneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit No HP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label class="form-label fw-semibold">Nomor HP</label>
                    <input type="tel" name="phone" class="edit-input"
                           value="{{ auth()->user()->phone }}" placeholder="08xxxxxxxxxx">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Birth Date Modal --}}
<div class="modal fade" id="editBirthModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tanggal Lahir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="birth_date" class="edit-input"
                           value="{{ auth()->user()->birth_date }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Address Modal --}}
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Alamat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="address" class="edit-input" rows="3"
                              placeholder="Jl. contoh no.1, Kota">{{ auth()->user()->address }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
