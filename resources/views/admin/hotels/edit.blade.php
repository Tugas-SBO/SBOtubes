@extends('admin.layout')
@section('title', 'Edit Hotel')

@section('content')
<div class="topbar">
    <h1>Edit Hotel</h1>
    <a href="{{ route('admin.hotels') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="stat-card" style="max-width: 700px;">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.hotels._form')
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-lg me-1"></i> Update Hotel
        </button>
    </form>
</div>
@endsection
