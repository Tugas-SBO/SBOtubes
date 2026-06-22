@extends('layouts.app')

@section('title', 'Help Center')

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

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .contact-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #DDE1EA;
        border-radius: 8px;
        padding: 13px 16px;
        text-decoration: none;
        color: #222;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
        transition: background 0.15s;
    }

    .contact-btn:hover {
        background: #cdd3e0;
        color: #111;
    }

    .contact-btn svg, .contact-btn i {
        font-size: 22px;
        flex-shrink: 0;
    }

    .divider-line {
        border: none;
        border-top: 1.5px solid #C0392B;
        margin: 18px 0;
        opacity: 0.4;
    }

    .faq-item {
        background: #DDE1EA;
        border-radius: 8px;
        padding: 13px 16px;
        margin-bottom: 8px;
        font-size: 14px;
        color: #222;
        cursor: pointer;
        transition: background 0.15s;
    }

    .faq-item:hover { background: #cdd3e0; }

    .faq-answer {
        display: none;
        background: #f5f5f5;
        border-radius: 0 0 8px 8px;
        padding: 12px 16px;
        font-size: 13px;
        color: #444;
        margin-top: -8px;
        margin-bottom: 8px;
    }

    .faq-item.active + .faq-answer { display: block; }
</style>
@endpush

@section('content')
<div class="page-grey">
    {{-- Back header --}}
    <div class="back-row">
        <a href="{{ route('profile') }}">
            <i class="bi bi-arrow-left"></i>
            <span class="page-title">Help Center</span>
        </a>
    </div>

    <div style="padding: 10px 60px;">
        {{-- Contact US --}}
        <div class="section-title">Contact US</div>

        <a href="https://wa.me/6281234567890" class="contact-btn" target="_blank">
            {{-- WhatsApp icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="#25D366">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            whatsapp
        </a>

        <a href="https://instagram.com/stayq" class="contact-btn" target="_blank">
            {{-- Instagram icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C13584" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <circle cx="12" cy="12" r="4"/>
                <circle cx="17.5" cy="6.5" r="1" fill="#C13584" stroke="none"/>
            </svg>
            instagram
        </a>

        <hr class="divider-line">

        {{-- FAQ --}}
        <div class="section-title">FAQ</div>

        <div class="faq-item" onclick="toggleFaq(this)">
            Bagaimana cara memesan hotel di StayQ?
        </div>
        <div class="faq-answer">
            Pilih hotel yang diinginkan, tentukan tanggal check-in dan check-out, lalu klik tombol Pesan. Ikuti langkah pembayaran dan booking kamu akan dikonfirmasi via email.
        </div>

        <div class="faq-item" onclick="toggleFaq(this)">
            Bagaimana cara mendaftar akun di StayQ?
        </div>
        <div class="faq-answer">
            Klik tombol "bikin akun" di halaman login. Isi email, username, password, dan konfirmasi password, lalu klik Register.
        </div>

        <div class="faq-item" onclick="toggleFaq(this)">
            Apakah transaksi pembayaran di StayQ aman?
        </div>
        <div class="faq-answer">
            Ya, semua transaksi di StayQ diproteksi dengan enkripsi SSL dan diproses melalui payment gateway terpercaya.
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleFaq(el) {
        el.classList.toggle('active');
    }
</script>
@endpush
