@extends('layouts.cyber-master')

@section('title', 'Detail Pesanan #' . $order->id)

@push('styles')
<style>
    .order-detail-page {
        padding-bottom: 40px;
    }

    /* =========================
       PAGE HEADER
    ========================== */
    .order-detail-page .page-header-custom {
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .order-detail-page .page-header-custom::after {
        content: '';
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -55px;
        top: -75px;
    }

    .order-detail-page .page-header-content {
        position: relative;
        z-index: 1;
    }

    .order-detail-page .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,.82);
        text-decoration: none;
        font-size: .78rem;
        margin-bottom: 12px;
        transition: .2s ease;
    }

    .order-detail-page .back-link:hover {
        color: #fff;
    }

    .order-detail-page .page-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(255,255,255,.13);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }

    .order-detail-page .page-header-custom h2 {
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1.5rem;
    }

    .order-detail-page .page-header-custom p {
        margin: 0;
        opacity: .85;
        font-size: .82rem;
    }

    /* =========================
       CARD
    ========================== */
    .order-detail-page .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .order-detail-page .card-header-custom {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .order-detail-page .card-header-custom h5 {
        margin: 0;
        color: #1A2B5C;
        font-weight: 700;
        font-size: .98rem;
    }

    .order-detail-page .card-header-custom h5 i {
        color: #2E5B9C;
    }

    .order-detail-page .card-body-custom {
        padding: 22px;
    }

    /* =========================
       STATUS
    ========================== */
    .order-detail-page .status-group {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .order-detail-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: .68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .order-detail-page .status-pending,
    .order-detail-page .payment-pending {
        background: #fff4d6;
        color: #8a6800;
    }

    .order-detail-page .status-processed {
        background: #edf3fb;
        color: #2E5B9C;
    }

    .order-detail-page .status-shipped,
    .order-detail-page .status-completed,
    .order-detail-page .payment-paid {
        background: #e8f7ee;
        color: #18794e;
    }

    .order-detail-page .status-cancelled,
    .order-detail-page .payment-failed {
        background: #fdeaea;
        color: #b42318;
    }

    /* =========================
       INFO GRID
    ========================== */
    .order-detail-page .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }

    .order-detail-page .info-item {
        padding: 14px 15px;
        background: #f8faff;
        border: 1px solid #eef2f7;
        border-radius: 12px;
    }

    .order-detail-page .info-label {
        display: block;
        color: #7c8796;
        font-size: .72rem;
        margin-bottom: 5px;
    }

    .order-detail-page .info-value {
        color: #273449;
        font-weight: 600;
        font-size: .84rem;
    }

    /* =========================
       PRODUCT LIST
    ========================== */
    .order-detail-page .product-list {
        display: flex;
        flex-direction: column;
    }

    .order-detail-page .product-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .order-detail-page .product-item:first-child {
        padding-top: 0;
    }

    .order-detail-page .product-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .order-detail-page .product-cover {
        width: 65px;
        height: 82px;
        object-fit: cover;
        border-radius: 9px;
        background: #f2f4f8;
        flex-shrink: 0;
    }

    .order-detail-page .product-info {
        flex: 1;
        min-width: 0;
    }

    .order-detail-page .product-title {
        color: #273449;
        font-weight: 600;
        font-size: .86rem;
        margin-bottom: 5px;
    }

    .order-detail-page .product-meta {
        color: #7c8796;
        font-size: .76rem;
        line-height: 1.5;
    }

    .order-detail-page .product-total {
        text-align: right;
        flex-shrink: 0;
    }

    .order-detail-page .product-total strong {
        display: block;
        color: #1A2B5C;
        font-size: .88rem;
    }

    .order-detail-page .product-total small {
        color: #7c8796;
        font-size: .72rem;
    }

    /* =========================
       SUMMARY
    ========================== */

    /*
     * Tidak menggunakan position: sticky
     * agar Ringkasan Pembayaran tidak bertabrakan
     * dengan card Status Proses ketika halaman di-scroll.
     */
    .order-detail-page .summary-card {
        position: static;
    }

    .order-detail-page .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 9px 0;
        color: #687587;
        font-size: .82rem;
    }

    .order-detail-page .summary-row strong {
        color: #364152;
        font-weight: 600;
    }

    .order-detail-page .summary-row.discount strong {
        color: #18794e;
    }

    .order-detail-page .summary-total {
        background: #f8faff;
        border: 1px solid #edf1f7;
        border-radius: 12px;
        margin-top: 10px;
        padding: 14px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .order-detail-page .summary-total span {
        color: #687587;
        font-size: .76rem;
    }

    .order-detail-page .summary-total strong {
        color: #1A2B5C;
        font-size: 1.12rem;
        font-weight: 700;
    }

    /* =========================
       SHIPPING
    ========================== */
    .order-detail-page .shipping-box {
        background: #f8faff;
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 16px;
        color: #4f5d70;
        font-size: .82rem;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* =========================
       PAYMENT
    ========================== */
    .order-detail-page .payment-box {
        border-radius: 13px;
        padding: 17px;
        background: #f8faff;
        border: 1px solid #eef2f7;
    }

    .order-detail-page .payment-status {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 13px;
    }

    .order-detail-page .payment-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #edf3fb;
        color: #2E5B9C;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .order-detail-page .payment-title {
        color: #273449;
        font-weight: 600;
        font-size: .84rem;
        margin-bottom: 2px;
    }

    .order-detail-page .payment-subtitle {
        color: #7c8796;
        font-size: .72rem;
    }

    .order-detail-page .payment-info {
        border-top: 1px solid #e5eaf1;
        padding-top: 12px;
        margin-top: 5px;
    }

    .order-detail-page .payment-info-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 7px;
        font-size: .76rem;
    }

    .order-detail-page .payment-info-row span {
        color: #7c8796;
    }

    .order-detail-page .payment-info-row strong {
        color: #364152;
    }

    /* =========================
       BANK TRANSFER
    ========================== */
    .order-detail-page .bank-transfer-box {
        margin-top: 14px;
        padding-top: 13px;
        border-top: 1px solid #e5eaf1;
    }

    .order-detail-page .bank-transfer-title {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #1A2B5C;
        font-size: .78rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .order-detail-page .bank-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 11px;
        background: #fff;
        border: 1px solid #e4e9f1;
        border-radius: 10px;
        margin-bottom: 8px;
    }

    .order-detail-page .bank-option:last-child {
        margin-bottom: 0;
    }

    .order-detail-page .bank-name {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .order-detail-page .bank-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: #edf3fb;
        color: #2E5B9C;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .78rem;
        flex-shrink: 0;
    }

    .order-detail-page .bank-name strong {
        display: block;
        color: #364152;
        font-size: .75rem;
        line-height: 1.3;
    }

    .order-detail-page .bank-name small {
        display: block;
        color: #8a94a3;
        font-size: .65rem;
        margin-top: 2px;
    }

    .order-detail-page .bank-number {
        text-align: right;
        flex-shrink: 0;
    }

    .order-detail-page .bank-number strong {
        display: block;
        color: #1A2B5C;
        font-size: .76rem;
        letter-spacing: .02em;
    }

    .order-detail-page .bank-number small {
        display: block;
        color: #8a94a3;
        font-size: .63rem;
        margin-top: 2px;
    }

    .order-detail-page .bank-note {
        margin-top: 9px;
        color: #7c8796;
        font-size: .65rem;
        line-height: 1.5;
    }

    .order-detail-page .alert-info-custom {
        background: #eef5ff;
        border: 1px solid #dce9fb;
        color: #31577f;
        border-radius: 10px;
        padding: 12px 13px;
        font-size: .76rem;
    }

    /* =========================
       ACTION CARD
    ========================== */
    .order-detail-page .action-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        margin-bottom: 20px;
    }

    .order-detail-page .action-card h6 {
        color: #1A2B5C;
        font-weight: 700;
        font-size: .92rem;
        margin-bottom: 7px;
    }

    .order-detail-page .action-card p {
        color: #7c8796;
        font-size: .76rem;
        line-height: 1.55;
        margin-bottom: 16px;
    }

    .order-detail-page .btn-action {
        border-radius: 9px;
        padding: 9px 14px;
        font-size: .76rem;
        font-weight: 600;
    }

    .order-detail-page .btn-payment {
        background: #C9A84C;
        border: 1px solid #C9A84C;
        color: #fff;
    }

    .order-detail-page .btn-payment:hover {
        background: #b8953e;
        border-color: #b8953e;
        color: #fff;
    }

    .order-detail-page .btn-cancel {
        color: #b42318;
        border: 1px solid #f0c8c5;
        background: #fff;
    }

    .order-detail-page .btn-cancel:hover {
        background: #fdeaea;
        color: #a51d13;
        border-color: #e9aaa5;
    }

    /* =========================
       ALERT
    ========================== */
    .order-detail-page .alert-custom {
        border-radius: 12px;
        padding: 13px 15px;
        font-size: .82rem;
        margin-bottom: 20px;
    }

    .order-detail-page .alert-success-custom {
        background: #e8f7ee;
        border: 1px solid #ccebd8;
        color: #18794e;
    }

    .order-detail-page .alert-danger-custom {
        background: #fdeaea;
        border: 1px solid #f4c7c7;
        color: #b42318;
    }

    /* =========================
       TIMELINE
    ========================== */
    .order-detail-page .timeline {
        position: relative;
        padding-left: 31px;
    }

    .order-detail-page .timeline::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e5eaf1;
    }

    .order-detail-page .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }

    .order-detail-page .timeline-item:last-child {
        padding-bottom: 0;
    }

    .order-detail-page .timeline-dot {
        position: absolute;
        left: -31px;
        top: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #e9edf5;
        border: 4px solid #fff;
        box-shadow: 0 0 0 1px #dfe5ed;
    }

    .order-detail-page .timeline-item.active .timeline-dot {
        background: #2E5B9C;
        box-shadow: 0 0 0 1px #2E5B9C;
    }

    .order-detail-page .timeline-title {
        color: #364152;
        font-size: .82rem;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .order-detail-page .timeline-item.active .timeline-title {
        color: #1A2B5C;
    }

    .order-detail-page .timeline-desc {
        color: #8a94a3;
        font-size: .72rem;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 767.98px) {

        .order-detail-page .page-header-custom {
            padding: 22px;
            border-radius: 16px;
        }

        .order-detail-page .page-header-custom h2 {
            font-size: 1.3rem;
        }

        .order-detail-page .card-header-custom {
            padding: 16px 18px;
        }

        .order-detail-page .card-body-custom {
            padding: 18px;
        }

        .order-detail-page .info-grid {
            grid-template-columns: 1fr;
        }

        .order-detail-page .product-item {
            align-items: flex-start;
        }

        .order-detail-page .product-cover {
            width: 55px;
            height: 70px;
        }

        .order-detail-page .product-total {
            min-width: 90px;
        }

        .order-detail-page .action-card .btn {
            width: 100%;
        }

        .order-detail-page .status-group {
            justify-content: flex-start;
        }
    }

    @media (max-width: 575.98px) {

        .order-detail-page .product-item {
            flex-wrap: wrap;
        }

        .order-detail-page .product-total {
            width: 100%;
            text-align: left;
            padding-left: 70px;
            margin-top: -5px;
        }

        .order-detail-page .summary-total strong {
            font-size: 1rem;
        }

        .order-detail-page .bank-option {
            align-items: flex-start;
            flex-direction: column;
        }

        .order-detail-page .bank-number {
            text-align: left;
            padding-left: 38px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid order-detail-page">

    {{-- Header --}}
    <div class="page-header-custom">

        <div class="page-header-content">

            <a
                href="{{ route('reseller.orders.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali ke Pesanan Saya
            </a>

            <div class="page-header-icon">
                <i class="bi bi-receipt"></i>
            </div>

            <h2>
                Detail Pesanan #{{ $order->id }}
            </h2>

            <p>
                {{ $order->order_date?->format('d F Y, H:i') ?? '-' }}
            </p>

        </div>

    </div>

    {{-- Flash Message --}}
    @if(session('success'))

        <div
            class="alert-custom alert-success-custom"
            role="alert"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    {{-- Error --}}
    @if($errors->any())

        <div
            class="alert-custom alert-danger-custom"
            role="alert"
        >

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ $errors->first() }}

        </div>

    @endif

    @php

        $statusClass = match ($order->status) {

            'pending' =>
                'status-pending',

            'processed' =>
                'status-processed',

            'shipped' =>
                'status-shipped',

            'completed' =>
                'status-completed',

            'cancelled' =>
                'status-cancelled',

            default =>
                'status-pending',

        };

        $statusLabel = match ($order->status) {

            'pending' =>
                'Menunggu',

            'processed' =>
                'Diproses',

            'shipped' =>
                'Dikirim',

            'completed' =>
                'Selesai',

            'cancelled' =>
                'Dibatalkan',

            default =>
                ucfirst($order->status),

        };

        $paymentClass = match ($order->payment_status) {

            'paid' =>
                'payment-paid',

            'failed' =>
                'payment-failed',

            default =>
                'payment-pending',

        };

        $paymentLabel = match ($order->payment_status) {

            'pending' =>
                'Belum Dibayar',

            'paid' =>
                'Sudah Dibayar',

            'failed' =>
                'Pembayaran Gagal',

            default =>
                ucfirst($order->payment_status),

        };

        $totalItems =
            $order->items->sum('quantity');

    @endphp

    <div class="row g-4">

        {{-- =====================================================
             LEFT
        ====================================================== --}}
        <div class="col-lg-8">

            {{-- Order Information --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>

                        <i class="bi bi-info-circle me-2"></i>

                        Informasi Pesanan

                    </h5>

                    <div class="status-group">

                        <span
                            class="status-badge {{ $statusClass }}"
                        >

                            <i class="bi bi-box-seam"></i>

                            {{ $statusLabel }}

                        </span>

                        <span
                            class="status-badge {{ $paymentClass }}"
                        >

                            <i class="bi bi-credit-card"></i>

                            {{ $paymentLabel }}

                        </span>

                    </div>

                </div>

                <div class="card-body-custom">

                    <div class="info-grid">

                        <div class="info-item">

                            <span class="info-label">
                                Nomor Pesanan
                            </span>

                            <span class="info-value">
                                #{{ $order->id }}
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                Tanggal Pesanan
                            </span>

                            <span class="info-value">
                                {{ $order->order_date?->format('d F Y, H:i') ?? '-' }}
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                Jumlah Buku
                            </span>

                            <span class="info-value">
                                {{ $totalItems }} buku
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                Status Pembayaran
                            </span>

                            <span class="info-value">
                                {{ $paymentLabel }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Products --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>

                        <i class="bi bi-book me-2"></i>

                        Produk Pesanan

                    </h5>

                    <span
                        style="
                            background:#edf3fb;
                            color:#2E5B9C;
                            padding:5px 10px;
                            border-radius:20px;
                            font-size:.68rem;
                            font-weight:700;
                        "
                    >
                        {{ $totalItems }} buku
                    </span>

                </div>

                <div class="card-body-custom">

                    <div class="product-list">

                        @foreach($order->items as $item)

                            <div class="product-item">

                                <img
                                    src="{{ $item->product?->cover_url ?? asset('images/book-placeholder.png') }}"
                                    alt="{{ $item->product?->title ?? 'Produk' }}"
                                    class="product-cover"
                                >

                                <div class="product-info">

                                    <div class="product-title">

                                        {{ $item->product?->title ?? 'Produk tidak tersedia' }}

                                    </div>

                                    <div class="product-meta">

                                        {{ $item->quantity }} buku

                                        ×

                                        Rp
                                        {{ number_format($item->price_per_unit, 0, ',', '.') }}

                                    </div>

                                    @if($item->product?->author)

                                        <div class="product-meta">

                                            Penulis:
                                            {{ $item->product->author }}

                                        </div>

                                    @endif

                                </div>

                                <div class="product-total">

                                    <strong>

                                        Rp
                                        {{ number_format($item->total_price, 0, ',', '.') }}

                                    </strong>

                                    <small>
                                        Subtotal
                                    </small>

                                </div>

                            </div>

                        @endforeach

                    </div>

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

                        {{ $order->shipping_address }}

                    </div>

                </div>

            </div>

        </div>

        {{-- =====================================================
             RIGHT
        ====================================================== --}}
        <div class="col-lg-4">

            {{-- Summary --}}
            <div class="card-custom summary-card">

                <div class="card-header-custom">

                    <h5>

                        <i class="bi bi-receipt me-2"></i>

                        Ringkasan Pembayaran

                    </h5>

                </div>

                <div class="card-body-custom">

                    <div class="summary-row">

                        <span>
                            Jumlah buku
                        </span>

                        <strong>
                            {{ $totalItems }} buku
                        </strong>

                    </div>

                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>

                            Rp
                            {{ number_format($order->total_price, 0, ',', '.') }}

                        </strong>

                    </div>

                    <div class="summary-row discount">

                        <span>
                            Diskon reseller
                        </span>

                        <strong>

                            - Rp
                            {{ number_format($order->discount_amount, 0, ',', '.') }}

                        </strong>

                    </div>

                    <div class="summary-total">

                        <span>
                            Total Pembayaran
                        </span>

                        <strong>

                            Rp
                            {{ number_format($order->final_price, 0, ',', '.') }}

                        </strong>

                    </div>

                </div>

            </div>

            {{-- Payment --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>

                        <i class="bi bi-credit-card-2-front me-2"></i>

                        Pembayaran

                    </h5>

                </div>

                <div class="card-body-custom">

                    <div class="payment-box">

                        <div class="payment-status">

                            <div class="payment-icon">

                                <i class="bi bi-wallet2"></i>

                            </div>

                            <div>

                                <div class="payment-title">

                                    {{ $paymentLabel }}

                                </div>

                                <div class="payment-subtitle">

                                    Status pembayaran pesanan

                                </div>

                            </div>

                        </div>

                        @if($order->payment)

                            <div class="payment-info">

                                <div class="payment-info-row">

                                    <span>
                                        Nominal
                                    </span>

                                    <strong>

                                        Rp
                                        {{ number_format($order->payment->amount, 0, ',', '.') }}

                                    </strong>

                                </div>

                                <div class="payment-info-row">

                                    <span>
                                        Status bukti
                                    </span>

                                    <strong>

                                        {{ ucfirst($order->payment->status) }}

                                    </strong>

                                </div>

                                @if($order->payment->verified_at)

                                    <div class="payment-info-row">

                                        <span>
                                            Diproses pada
                                        </span>

                                        <strong>

                                            {{ $order->payment->verified_at->format('d F Y, H:i') }}

                                        </strong>

                                    </div>

                                @endif

                            </div>

                        @else

                            <div class="alert-info-custom">

                                <i class="bi bi-info-circle me-1"></i>

                                Belum ada data pembayaran untuk pesanan ini.

                            </div>

                        @endif

                        {{-- Rekening Transfer --}}
                        @if(
                            $order->payment_status !== 'paid' &&
                            $order->status !== 'cancelled'
                        )

                            <div class="bank-transfer-box">

                                <div class="bank-transfer-title">

                                    <i class="bi bi-bank"></i>

                                    Rekening Tujuan Transfer

                                </div>

                                {{-- BRI --}}
                                <div class="bank-option">

                                    <div class="bank-name">

                                        <div class="bank-icon">

                                            <i class="bi bi-building"></i>

                                        </div>

                                        <div>

                                            <strong>
                                                Bank BRI
                                            </strong>

                                            <small>
                                                PT Cyber Media Teknologi
                                            </small>

                                        </div>

                                    </div>

                                    <div class="bank-number">

                                        {{-- Nomor rekening dummy --}}
                                        <strong>
                                            123456789012345
                                        </strong>

                                        <small>
                                            Rekening BRI
                                        </small>

                                    </div>

                                </div>

                                {{-- BCA --}}
                                <div class="bank-option">

                                    <div class="bank-name">

                                        <div class="bank-icon">

                                            <i class="bi bi-building"></i>

                                        </div>

                                        <div>

                                            <strong>
                                                Bank BCA
                                            </strong>

                                            <small>
                                                PT Cyber Media Teknologi
                                            </small>

                                        </div>

                                    </div>

                                    <div class="bank-number">

                                        {{-- Nomor rekening dummy --}}
                                        <strong>
                                            9876543210
                                        </strong>

                                        <small>
                                            Rekening BCA
                                        </small>

                                    </div>

                                </div>

                                <div class="bank-note">

                                    <i class="bi bi-info-circle me-1"></i>

                                    Silakan transfer sesuai nominal

                                    <strong>
                                        Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                    </strong>

                                    kemudian upload bukti pembayaran.

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

            {{-- Actions --}}
            @if(
                $order->status === 'pending' &&
                $order->payment_status !== 'paid'
            )

                <div class="action-card">

                    <h6>

                        <i class="bi bi-lightning-charge me-1"></i>

                        Tindakan Pesanan

                    </h6>

                    <p>

                        Selesaikan pembayaran atau batalkan pesanan
                        apabila Anda tidak ingin melanjutkannya.

                    </p>

                    <div class="d-grid gap-2">

                        <a
                            href="{{ route('reseller.payment.create', $order) }}"
                            class="btn btn-payment btn-action"
                        >

                            <i class="bi bi-upload me-1"></i>

                            Upload Bukti Pembayaran

                        </a>

                        <form
                            action="{{ route('reseller.orders.cancel', $order) }}"
                            method="POST"
                            class="cancel-order-form"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-cancel btn-action w-100"
                            >

                                <i class="bi bi-x-circle me-1"></i>

                                Batalkan Pesanan

                            </button>

                        </form>

                    </div>

                </div>

            @elseif($order->payment_status === 'paid')

                <div class="action-card">

                    <h6>

                        <i
                            class="bi bi-check-circle-fill me-1"
                            style="color:#18794e;"
                        ></i>

                        Pembayaran Berhasil

                    </h6>

                    <p class="mb-0">

                        Pembayaran untuk pesanan ini telah diverifikasi
                        oleh admin.

                    </p>

                </div>

            @elseif($order->status === 'cancelled')

                <div class="action-card">

                    <h6>

                        <i
                            class="bi bi-x-circle-fill me-1"
                            style="color:#b42318;"
                        ></i>

                        Pesanan Dibatalkan

                    </h6>

                    <p class="mb-0">

                        Pesanan ini sudah dibatalkan dan tidak dapat
                        diproses kembali.

                    </p>

                </div>

            @endif

            {{-- Progress --}}
            <div class="card-custom mt-4">

                <div class="card-header-custom">

                    <h5>

                        <i class="bi bi-clock-history me-2"></i>

                        Status Proses

                    </h5>

                </div>

                <div class="card-body-custom">

                    @php

                        $statuses = [

                            'pending' => [

                                'title' =>
                                    'Menunggu',

                                'desc' =>
                                    'Pesanan berhasil dibuat.',

                            ],

                            'processed' => [

                                'title' =>
                                    'Diproses',

                                'desc' =>
                                    'Pesanan sedang diproses.',

                            ],

                            'shipped' => [

                                'title' =>
                                    'Dikirim',

                                'desc' =>
                                    'Pesanan telah dikirim.',

                            ],

                            'completed' => [

                                'title' =>
                                    'Selesai',

                                'desc' =>
                                    'Pesanan telah selesai.',

                            ],

                        ];

                        $statusOrder = [

                            'pending' =>
                                1,

                            'processed' =>
                                2,

                            'shipped' =>
                                3,

                            'completed' =>
                                4,

                        ];

                        $currentStep =
                            $statusOrder[$order->status] ?? 0;

                    @endphp

                    @if($order->status === 'cancelled')

                        <div class="timeline">

                            <div class="timeline-item active">

                                <div class="timeline-dot"></div>

                                <div class="timeline-title">

                                    Pesanan Dibatalkan

                                </div>

                                <div class="timeline-desc">

                                    Pesanan tidak akan diproses lebih lanjut.

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="timeline">

                            @foreach($statuses as $key => $status)

                                @php

                                    $step =
                                        $statusOrder[$key];

                                    $active =
                                        $currentStep >= $step;

                                @endphp

                                <div
                                    class="timeline-item {{ $active ? 'active' : '' }}"
                                >

                                    <div class="timeline-dot"></div>

                                    <div class="timeline-title">

                                        {{ $status['title'] }}

                                    </div>

                                    <div class="timeline-desc">

                                        {{ $status['desc'] }}

                                    </div>

                                </div>

                            @endforeach

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

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const cancelForm =
                document.querySelector(
                    '.cancel-order-form'
                );

            if (cancelForm) {

                cancelForm.addEventListener(
                    'submit',
                    function (event) {

                        event.preventDefault();

                        if (
                            typeof Swal !==
                            'undefined'
                        ) {

                            Swal.fire({

                                title:
                                    'Batalkan pesanan?',

                                text:
                                    'Stok produk akan dikembalikan dan pesanan tidak dapat diproses kembali.',

                                icon:
                                    'warning',

                                showCancelButton:
                                    true,

                                confirmButtonText:
                                    'Ya, batalkan',

                                cancelButtonText:
                                    'Tidak',

                                reverseButtons:
                                    true

                            }).then(
                                (result) => {

                                    if (
                                        result.isConfirmed
                                    ) {

                                        cancelForm.submit();

                                    }

                                }
                            );

                        } else {

                            if (
                                confirm(
                                    'Apakah Anda yakin ingin membatalkan pesanan ini?'
                                )
                            ) {

                                cancelForm.submit();

                            }

                        }

                    }
                );

            }

        }
    );

</script>

@endpush