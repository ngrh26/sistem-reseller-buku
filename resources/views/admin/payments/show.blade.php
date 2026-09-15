```blade
@extends('layouts.cyber-master')

@section('title', 'Detail Pembayaran #' . $payment->id)

@push('styles')
<style>
    .payment-detail-page {
        padding-bottom: 40px;
    }

    .page-header {
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: '';
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -70px;
        top: -100px;
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,.8);
        text-decoration: none;
        font-size: .84rem;
        margin-bottom: 12px;
    }

    .back-link:hover {
        color: #fff;
    }

    .page-header h2 {
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 5px;
    }

    .page-header p {
        margin: 0;
        opacity: .85;
        font-size: .88rem;
    }

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-header-custom {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .card-header-custom h5 {
        margin: 0;
        color: #1A2B5C;
        font-weight: 700;
        font-size: 1rem;
    }

    .card-body-custom {
        padding: 22px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: .7rem;
        font-weight: 700;
    }

    .status-pending {
        background: #fff4d6;
        color: #8a6800;
    }

    .status-verified {
        background: #e8f7ee;
        color: #18794e;
    }

    .status-rejected {
        background: #fdeaea;
        color: #b42318;
    }

    .payment-total {
        background: linear-gradient(135deg, #f5f8fd 0%, #edf3fb 100%);
        border-radius: 15px;
        padding: 22px;
        text-align: center;
        margin-bottom: 20px;
    }

    .payment-total-label {
        color: #778397;
        font-size: .8rem;
        margin-bottom: 6px;
    }

    .payment-total-value {
        color: #1A2B5C;
        font-size: 1.8rem;
        font-weight: 800;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .info-item {
        background: #f8faff;
        border-radius: 11px;
        padding: 13px;
    }

    .info-label {
        display: block;
        color: #8993a2;
        font-size: .72rem;
        margin-bottom: 5px;
    }

    .info-value {
        color: #344054;
        font-size: .85rem;
        font-weight: 600;
        word-break: break-word;
    }

    .info-value.highlight {
        color: #1A2B5C;
        font-weight: 700;
    }

    .reseller-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px;
        background: #f8faff;
        border-radius: 13px;
    }

    .reseller-avatar {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1A2B5C, #2E5B9C);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
    }

    .reseller-info {
        min-width: 0;
    }

    .reseller-name {
        color: #344054;
        font-weight: 700;
        font-size: .9rem;
    }

    .reseller-email {
        color: #8a94a3;
        font-size: .75rem;
        margin-top: 2px;
        word-break: break-word;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .product-item:first-child {
        padding-top: 0;
    }

    .product-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .product-cover {
        width: 52px;
        height: 68px;
        border-radius: 8px;
        object-fit: cover;
        background: #edf3fb;
        flex: 0 0 52px;
    }

    .product-info {
        min-width: 0;
        flex: 1;
    }

    .product-title {
        color: #344054;
        font-size: .84rem;
        font-weight: 700;
        line-height: 1.35;
    }

    .product-author {
        color: #8a94a3;
        font-size: .72rem;
        margin-top: 3px;
    }

    .product-quantity {
        color: #687587;
        font-size: .76rem;
        margin-top: 6px;
    }

    .product-price {
        text-align: right;
        white-space: nowrap;
    }

    .product-price-unit {
        color: #8a94a3;
        font-size: .7rem;
    }

    .product-price-total {
        color: #1A2B5C;
        font-size: .82rem;
        font-weight: 700;
        margin-top: 3px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 9px 0;
        color: #687587;
        font-size: .82rem;
    }

    .summary-row strong {
        color: #344054;
    }

    .summary-row.discount strong {
        color: #198754;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        border-top: 1px solid #e5eaf1;
        margin-top: 7px;
        padding-top: 15px;
    }

    .summary-total span {
        color: #687587;
        font-size: .83rem;
    }

    .summary-total strong {
        color: #1A2B5C;
        font-size: 1.15rem;
    }

    .shipping-box {
        background: #f8faff;
        border: 1px solid #e7edf6;
        border-radius: 12px;
        padding: 15px;
        color: #526071;
        font-size: .82rem;
        line-height: 1.55;
        white-space: pre-line;
    }

    .proof-container {
        background: #f8faff;
        border: 1px solid #e7edf6;
        border-radius: 14px;
        padding: 15px;
    }

    .proof-preview {
        display: block;
        width: 100%;
        max-height: 500px;
        object-fit: contain;
        border-radius: 10px;
        background: #eef2f7;
    }

    .proof-pdf {
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f1f4f8;
        border-radius: 10px;
        color: #b42318;
    }

    .proof-pdf i {
        font-size: 3rem;
        margin-bottom: 8px;
    }

    .proof-filename {
        color: #687587;
        font-size: .75rem;
        margin-top: 10px;
        word-break: break-all;
    }

    .btn-download {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #edf3fb;
        border: 1px solid #dce8f7;
        color: #2E5B9C;
        border-radius: 9px;
        padding: 9px 14px;
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-download:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }

    .action-card {
        border: 1px solid #e9edf5;
    }

    .action-info {
        background: #fff8e8;
        border: 1px solid #f1dfad;
        border-radius: 11px;
        padding: 13px;
        color: #806d3c;
        font-size: .76rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .btn-verify {
        width: 100%;
        background: #198754;
        border-color: #198754;
        color: #fff;
        border-radius: 10px;
        padding: 11px 15px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .btn-verify:hover {
        background: #157347;
        border-color: #157347;
        color: #fff;
    }

    .btn-reject {
        width: 100%;
        background: #fff;
        border: 1px solid #dc3545;
        color: #dc3545;
        border-radius: 10px;
        padding: 11px 15px;
        font-weight: 700;
    }

    .btn-reject:hover {
        background: #dc3545;
        color: #fff;
    }

    .verified-box {
        background: #e8f7ee;
        border: 1px solid #cce9d6;
        border-radius: 12px;
        padding: 14px;
    }

    .verified-box-title {
        color: #18794e;
        font-weight: 700;
        font-size: .82rem;
        margin-bottom: 5px;
    }

    .verified-box-text {
        color: #4c7b63;
        font-size: .75rem;
        margin: 0;
        line-height: 1.5;
    }

    .rejected-box {
        background: #fdeaea;
        border: 1px solid #f3cccc;
        border-radius: 12px;
        padding: 14px;
    }

    .rejected-box-title {
        color: #b42318;
        font-weight: 700;
        font-size: .82rem;
        margin-bottom: 5px;
    }

    .rejected-box-text {
        color: #8f514c;
        font-size: .75rem;
        margin: 0;
        line-height: 1.5;
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .card-body-custom {
            padding: 18px;
        }

        .card-header-custom {
            padding: 16px 18px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .payment-total-value {
            font-size: 1.5rem;
        }

        .product-item {
            align-items: flex-start;
        }

        .product-price {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid payment-detail-page">

    {{-- Header --}}
    <div class="page-header">

        <div class="page-header-content">

            <a
                href="{{ route('admin.payments.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali ke Pembayaran
            </a>

            <h2>
                Detail Pembayaran #{{ $payment->id }}
            </h2>

            <p>
                Periksa bukti pembayaran sebelum melakukan verifikasi.
            </p>

        </div>

    </div>

    {{-- Flash Success --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show rounded-3"
            role="alert"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    {{-- Errors --}}
    @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show rounded-3"
            role="alert"
        >

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ $errors->first() }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-lg-7">

            {{-- Payment Information --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-credit-card me-2"></i>
                        Informasi Pembayaran
                    </h5>

                    @switch($payment->status)

                        @case('pending')
                            <span class="status-badge status-pending">
                                <i class="bi bi-clock"></i>
                                Menunggu Verifikasi
                            </span>
                            @break

                        @case('verified')
                            <span class="status-badge status-verified">
                                <i class="bi bi-check-circle"></i>
                                Terverifikasi
                            </span>
                            @break

                        @case('rejected')
                            <span class="status-badge status-rejected">
                                <i class="bi bi-x-circle"></i>
                                Ditolak
                            </span>
                            @break

                    @endswitch

                </div>

                <div class="card-body-custom">

                    <div class="payment-total">

                        <div class="payment-total-label">
                            Nominal Pembayaran
                        </div>

                        <div class="payment-total-value">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </div>

                    </div>

                    <div class="info-grid">

                        <div class="info-item">

                            <span class="info-label">
                                ID Pembayaran
                            </span>

                            <span class="info-value highlight">
                                #{{ $payment->id }}
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                ID Pesanan
                            </span>

                            <span class="info-value highlight">
                                #{{ $payment->order_id }}
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                Tanggal Upload
                            </span>

                            <span class="info-value">
                                {{ $payment->created_at?->format('d F Y, H:i') ?? '-' }}
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                Status Pesanan
                            </span>

                            <span class="info-value">
                                {{ $payment->order?->statusLabel() ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Reseller --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-person-badge me-2"></i>
                        Informasi Reseller
                    </h5>

                </div>

                <div class="card-body-custom">

                    @if($payment->reseller)

                        @php
                            $initial = strtoupper(
                                substr($payment->reseller->name, 0, 1)
                            );
                        @endphp

                        <div class="reseller-card">

                            <div class="reseller-avatar">
                                {{ $initial }}
                            </div>

                            <div class="reseller-info">

                                <div class="reseller-name">
                                    {{ $payment->reseller->name }}
                                </div>

                                <div class="reseller-email">
                                    {{ $payment->reseller->email }}
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="text-muted small">
                            Data reseller tidak ditemukan.
                        </div>

                    @endif

                </div>

            </div>

            {{-- Order Items --}}
            @if($payment->order)

                <div class="card-custom">

                    <div class="card-header-custom">

                        <h5>
                            <i class="bi bi-box-seam me-2"></i>
                            Produk dalam Pesanan
                        </h5>

                    </div>

                    <div class="card-body-custom">

                        @forelse($payment->order->items as $item)

                            <div class="product-item">

                                @if($item->product)

                                    <img
                                        src="{{ $item->product->cover_url }}"
                                        alt="{{ $item->product->title }}"
                                        class="product-cover"
                                    >

                                    <div class="product-info">

                                        <div class="product-title">
                                            {{ $item->product->title }}
                                        </div>

                                        <div class="product-author">
                                            {{ $item->product->author ?: 'Penulis tidak tersedia' }}
                                        </div>

                                        <div class="product-quantity">
                                            Jumlah: {{ $item->quantity }} buku
                                        </div>

                                    </div>

                                @else

                                    <div class="product-info">

                                        <div class="product-title">
                                            Produk tidak ditemukan
                                        </div>

                                        <div class="product-quantity">
                                            Jumlah: {{ $item->quantity }} buku
                                        </div>

                                    </div>

                                @endif

                                <div class="product-price">

                                    <div class="product-price-unit">
                                        Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}
                                    </div>

                                    <div class="product-price-total">
                                        Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="text-muted small">
                                Tidak ada item dalam pesanan.
                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- Shipping --}}
                <div class="card-custom">

                    <div class="card-header-custom">

                        <h5>
                            <i class="bi bi-geo-alt me-2"></i>
                            Alamat Pengiriman
                        </h5>

                    </div>

                    <div class="card-body-custom">

                        <div class="shipping-box">
                            {{ $payment->order->shipping_address ?: '-' }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

        {{-- RIGHT --}}
        <div class="col-lg-5">

            {{-- Proof --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-file-earmark-image me-2"></i>
                        Bukti Pembayaran
                    </h5>

                </div>

                <div class="card-body-custom">

                    @if($payment->proof_file)

                        @php
                            $extension = strtolower(
                                pathinfo(
                                    $payment->proof_file,
                                    PATHINFO_EXTENSION
                                )
                            );
                        @endphp

                        <div class="proof-container">

                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))

                                <img
                                    src="{{ route('admin.payments.proof.preview', $payment) }}"
                                    alt="Bukti pembayaran"
                                    class="proof-preview"
                                >

                            @elseif($extension === 'pdf')

                                <div class="proof-pdf">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    <strong>
                                        Dokumen PDF
                                    </strong>

                                    <span class="small text-muted">
                                        Gunakan tombol di bawah untuk membuka file.
                                    </span>

                                </div>

                            @else

                                <div class="proof-pdf">

                                    <i class="bi bi-file-earmark"></i>

                                    <strong>
                                        File Bukti Pembayaran
                                    </strong>

                                </div>

                            @endif

                            <div class="proof-filename">
                                {{ basename($payment->proof_file) }}
                            </div>

                            <div class="mt-3">

                                <a
                                    href="{{ route('admin.payments.proof', $payment) }}"
                                    class="btn-download w-100"
                                >
                                    <i class="bi bi-download"></i>
                                    Download Bukti Pembayaran
                                </a>

                            </div>

                        </div>

                    @else

                        <div class="text-center text-muted py-4">

                            <i class="bi bi-file-earmark-x fs-1 d-block mb-2"></i>

                            <div>
                                Bukti pembayaran tidak tersedia.
                            </div>

                        </div>

                    @endif

                </div>

            </div>

            {{-- Payment Summary --}}
            @if($payment->order)

                <div class="card-custom">

                    <div class="card-header-custom">

                        <h5>
                            <i class="bi bi-receipt me-2"></i>
                            Ringkasan Pesanan
                        </h5>

                    </div>

                    <div class="card-body-custom">

                        <div class="summary-row">

                            <span>
                                Jumlah Buku
                            </span>

                            <strong>
                                {{ $payment->order->items->sum('quantity') }} buku
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span>
                                Subtotal
                            </span>

                            <strong>
                                Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}
                            </strong>

                        </div>

                        <div class="summary-row discount">

                            <span>
                                Diskon Reseller
                            </span>

                            <strong>
                                - Rp {{ number_format($payment->order->discount_amount, 0, ',', '.') }}
                            </strong>

                        </div>

                        <div class="summary-total">

                            <span>
                                Total Pembayaran
                            </span>

                            <strong>
                                Rp {{ number_format($payment->order->final_price, 0, ',', '.') }}
                            </strong>

                        </div>

                    </div>

                </div>

            @endif

            {{-- Action --}}
            <div class="card-custom action-card">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-shield-check me-2"></i>
                        Tindakan Admin
                    </h5>

                </div>

                <div class="card-body-custom">

                    @if($payment->status === 'pending')

                        <div class="action-info">

                            <i class="bi bi-info-circle me-1"></i>

                            Pastikan nominal dan bukti pembayaran sudah
                            sesuai sebelum melakukan verifikasi.

                        </div>

                        <form
                            action="{{ route('admin.payments.verify', $payment) }}"
                            method="POST"
                            id="verify-form"
                            class="mb-2"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-verify"
                                id="verify-button"
                            >
                                <i class="bi bi-check-circle me-1"></i>
                                Verifikasi Pembayaran
                            </button>

                        </form>

                        <form
                            action="{{ route('admin.payments.reject', $payment) }}"
                            method="POST"
                            id="reject-form"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-reject"
                                id="reject-button"
                            >
                                <i class="bi bi-x-circle me-1"></i>
                                Tolak Pembayaran
                            </button>

                        </form>

                    @elseif($payment->status === 'verified')

                        <div class="verified-box">

                            <div class="verified-box-title">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Pembayaran Telah Diverifikasi
                            </div>

                            <p class="verified-box-text">
                                Pembayaran ini sudah diverifikasi oleh admin
                                dan tidak dapat diproses kembali.
                            </p>

                            @if($payment->verifier)

                                <div class="mt-2 small text-success">
                                    Oleh: {{ $payment->verifier->name }}
                                </div>

                            @endif

                            @if($payment->verified_at)

                                <div class="small text-success">
                                    {{ $payment->verified_at->format('d F Y, H:i') }}
                                </div>

                            @endif

                        </div>

                    @elseif($payment->status === 'rejected')

                        <div class="rejected-box">

                            <div class="rejected-box-title">
                                <i class="bi bi-x-circle-fill me-1"></i>
                                Pembayaran Ditolak
                            </div>

                            <p class="rejected-box-text">
                                Pembayaran ini telah ditolak dan reseller
                                dapat mengunggah bukti pembayaran kembali.
                            </p>

                            @if($payment->verifier)

                                <div class="mt-2 small text-danger">
                                    Oleh: {{ $payment->verifier->name }}
                                </div>

                            @endif

                            @if($payment->verified_at)

                                <div class="small text-danger">
                                    {{ $payment->verified_at->format('d F Y, H:i') }}
                                </div>

                            @endif

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const verifyForm = document.getElementById('verify-form');
        const rejectForm = document.getElementById('reject-form');

        const verifyButton = document.getElementById('verify-button');
        const rejectButton = document.getElementById('reject-button');

        if (verifyForm) {

            verifyForm.addEventListener('submit', function (event) {

                const confirmed = confirm(
                    'Apakah Anda yakin ingin memverifikasi pembayaran ini?'
                );

                if (!confirmed) {
                    event.preventDefault();
                    return;
                }

                verifyButton.disabled = true;

                verifyButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span>' +
                    ' Memverifikasi...';

            });

        }

        if (rejectForm) {

            rejectForm.addEventListener('submit', function (event) {

                const confirmed = confirm(
                    'Apakah Anda yakin ingin menolak pembayaran ini?'
                );

                if (!confirmed) {
                    event.preventDefault();
                    return;
                }

                rejectButton.disabled = true;

                rejectButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span>' +
                    ' Menolak...';

            });

        }

    });
</script>
@endpush
```
