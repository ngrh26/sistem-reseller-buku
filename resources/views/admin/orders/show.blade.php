@extends('layouts.cyber-master')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="container-fluid py-4 order-detail-page">

    @php
        $statusClass = match($order->status) {
            'pending' => 'pending',
            'processed' => 'processed',
            'shipped' => 'shipped',
            'completed' => 'completed',
            'cancelled' => 'cancelled',
            default => 'default',
        };

        $paymentClass = match($order->payment_status) {
            'paid' => 'paid',
            'pending' => 'pending',
            'failed' => 'failed',
            default => 'default',
        };

        $paymentLabel = match($order->payment_status) {
            'paid' => 'Sudah Dibayar',
            'pending' => 'Belum Dibayar',
            'failed' => 'Gagal',
            default => ucfirst($order->payment_status),
        };
    @endphp

    {{-- Header --}}
    <div class="page-header mb-4">
        <div class="header-decoration"></div>

        <div class="position-relative">

            <div class="breadcrumb-custom mb-2">
                <a href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-arrow-left me-1"></i>
                    Pesanan
                </a>

                <span>/</span>

                <span>Detail</span>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">

                <div>
                    <h2 class="mb-1">
                        Pesanan #{{ $order->id }}
                    </h2>

                    <p class="mb-0">
                        Detail dan pengelolaan pesanan reseller.
                    </p>
                </div>

                <div class="d-flex flex-wrap gap-2">

                    <span class="status-badge {{ $statusClass }}">
                        {{ $order->statusLabel() }}
                    </span>

                    <span class="status-badge {{ $paymentClass }}">
                        <i class="bi bi-credit-card me-1"></i>
                        {{ $paymentLabel }}
                    </span>

                </div>

            </div>

        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    {{-- Alert Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
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

        {{-- =========================
             LEFT CONTENT
        ========================== --}}
        <div class="col-xl-8">

            {{-- Produk Pesanan --}}
            <div class="card-custom mb-4">

                <div class="section-header">
                    <div>
                        <h5>
                            <i class="bi bi-book me-2"></i>
                            Produk Pesanan
                        </h5>

                        <span class="count-pill">
                            {{ $order->items->sum('quantity') }} Buku
                        </span>
                    </div>

                    <small>
                        Daftar buku dalam pesanan
                    </small>
                </div>

                <div class="section-body p-0">

                    @foreach($order->items as $item)

                        <div class="product-item {{ !$loop->last ? 'border-bottom' : '' }}">

                            <div class="product-cover">

                                @if($item->product && $item->product->cover_image)

                                    <img
                                        src="{{ $item->product->cover_url }}"
                                        alt="{{ $item->product->title }}"
                                    >

                                @else

                                    <div class="cover-placeholder">
                                        <i class="bi bi-book"></i>
                                    </div>

                                @endif

                            </div>

                            <div class="product-information">

                                @if($item->product)

                                    <h6>
                                        {{ $item->product->title }}
                                    </h6>

                                    <small class="author">
                                        {{ $item->product->author }}
                                    </small>

                                @else

                                    <h6>
                                        Produk tidak ditemukan
                                    </h6>

                                @endif

                                <div class="product-price">
                                    {{ $item->quantity }} ×
                                    Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}
                                </div>

                            </div>

                            <div class="product-total">

                                <small>
                                    Total
                                </small>

                                <strong>
                                    Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                </strong>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Informasi Pengiriman --}}
            <div class="card-custom mb-4">

                <div class="section-header">
                    <div>
                        <h5>
                            <i class="bi bi-geo-alt me-2"></i>
                            Informasi Pengiriman
                        </h5>
                    </div>
                </div>

                <div class="section-body">

                    <div class="info-row">

                        <div class="info-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>
                            <div class="info-label">
                                Alamat Pengiriman
                            </div>

                            <div class="info-value muted">
                                {{ $order->shipping_address }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Informasi Pembayaran --}}
            <div class="card-custom">

                <div class="section-header">
                    <div>
                        <h5>
                            <i class="bi bi-credit-card me-2"></i>
                            Informasi Pembayaran
                        </h5>
                    </div>
                </div>

                <div class="section-body">

                    @if($order->payment)

                        <div class="row g-4">

                            {{-- Status Pembayaran --}}
                            <div class="col-md-6">
                                <div class="detail-label">
                                    Status Pembayaran
                                </div>

                                <span class="status-badge {{ $paymentClass }}">
                                    {{ $paymentLabel }}
                                </span>
                            </div>

                            {{-- Nominal --}}
                            <div class="col-md-6">
                                <div class="detail-label">
                                    Nominal Pembayaran
                                </div>

                                <div class="detail-value price">
                                    Rp {{ number_format($order->payment->amount, 0, ',', '.') }}
                                </div>
                            </div>

                            {{-- Verifikasi --}}
                            <div class="col-md-6">
                                <div class="detail-label">
                                    Status Verifikasi
                                </div>

                                <div>
                                    @if($order->payment->status === 'verified')

                                        <span class="verification verified">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Terverifikasi
                                        </span>

                                    @elseif($order->payment->status === 'rejected')

                                        <span class="verification rejected">
                                            <i class="bi bi-x-circle-fill me-1"></i>
                                            Ditolak
                                        </span>

                                    @else

                                        <span class="verification waiting">
                                            <i class="bi bi-clock-fill me-1"></i>
                                            Menunggu Verifikasi
                                        </span>

                                    @endif
                                </div>
                            </div>

                            {{-- Waktu Verifikasi --}}
                            <div class="col-md-6">
                                <div class="detail-label">
                                    Waktu Verifikasi
                                </div>

                                <div class="detail-value">
                                    {{ $order->payment->verified_at?->format('d/m/Y H:i') ?? '-' }}
                                </div>
                            </div>

                        </div>

                    @else

                        <div class="empty-payment">

                            <div class="empty-payment-icon">
                                <i class="bi bi-credit-card-2-front"></i>
                            </div>

                            <p>
                                Belum ada data pembayaran untuk pesanan ini.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- =========================
             RIGHT CONTENT
        ========================== --}}
        <div class="col-xl-4">

            {{-- Informasi Reseller --}}
            <div class="card-custom mb-4">

                <div class="section-header">
                    <div>
                        <h5>
                            <i class="bi bi-person-badge me-2"></i>
                            Informasi Reseller
                        </h5>
                    </div>
                </div>

                <div class="section-body">

                    @if($order->reseller)

                        <div class="reseller-profile">

                            <div class="profile-avatar">
                                {{ strtoupper(substr($order->reseller->name, 0, 1)) }}
                            </div>

                            <div>
                                <div class="profile-name">
                                    {{ $order->reseller->name }}
                                </div>

                                <small>
                                    {{ $order->reseller->email }}
                                </small>
                            </div>

                        </div>

                        <div class="profile-detail">
                            <div class="detail-label">
                                Nomor Telepon
                            </div>

                            <div class="detail-value">
                                {{ $order->reseller->phone ?: '-' }}
                            </div>
                        </div>

                        <div class="profile-detail">
                            <div class="detail-label">
                                Paket Reseller
                            </div>

                            @if($order->reseller->reseller?->package)

                                <span class="package-badge">
                                    {{ $order->reseller->reseller->package->name }}
                                    ·
                                    {{ $order->reseller->reseller->package->discount_percentage }}%
                                </span>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif
                        </div>

                        <div class="profile-detail">
                            <div class="detail-label">
                                Total Purchase
                            </div>

                            <div class="detail-value strong">
                                {{ number_format($order->reseller->reseller?->total_purchase ?? 0, 0, ',', '.') }}
                                buku
                            </div>
                        </div>

                    @else

                        <div class="text-muted">
                            Data reseller tidak ditemukan.
                        </div>

                    @endif

                </div>

            </div>

            {{-- Ringkasan Pesanan --}}
            <div class="card-custom mb-4">

                <div class="section-header">
                    <div>
                        <h5>
                            <i class="bi bi-receipt me-2"></i>
                            Ringkasan Pesanan
                        </h5>
                    </div>
                </div>

                <div class="section-body">

                    <div class="summary-row">
                        <span>Subtotal</span>

                        <strong>
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Diskon</span>

                        <strong class="discount-value">
                            - Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                        </strong>
                    </div>

                    <hr>

                    <div class="summary-total">
                        <span>
                            Total Bayar
                        </span>

                        <strong>
                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                        </strong>
                    </div>

                </div>

            </div>

            {{-- Kelola Status --}}
            <div class="card-custom mb-4">

                <div class="section-header">
                    <div>
                        <h5>
                            <i class="bi bi-arrow-repeat me-2"></i>
                            Kelola Status Pesanan
                        </h5>
                    </div>
                </div>

                <div class="section-body">

                    @php
                        $availableTransitions = [
                            'pending' => [
                                'processed' => 'Diproses',
                                'cancelled' => 'Dibatalkan',
                            ],
                            'processed' => [
                                'shipped' => 'Dikirim',
                                'cancelled' => 'Dibatalkan',
                            ],
                            'shipped' => [
                                'completed' => 'Selesai',
                            ],
                            'completed' => [],
                            'cancelled' => [],
                        ];

                        $nextStatuses = $availableTransitions[$order->status] ?? [];
                    @endphp

                    @if(count($nextStatuses))

                        <form
                            method="POST"
                            action="{{ route('admin.orders.update-status', $order) }}"
                        >
                            @csrf
                            @method('PUT')

                            <label class="form-label">
                                Ubah Status
                            </label>

                            <select
                                name="status"
                                class="form-select status-select mb-3"
                                required
                            >
                                <option value="">
                                    Pilih status berikutnya
                                </option>

                                @foreach($nextStatuses as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            <button
                                type="submit"
                                class="btn-update-status w-100"
                            >
                                <i class="bi bi-arrow-repeat me-1"></i>
                                Perbarui Status
                            </button>

                        </form>

                    @else

                        <div class="status-locked">

                            @if($order->status === 'completed')

                                <div class="locked-icon completed">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>

                                <p>
                                    Pesanan telah selesai.
                                </p>

                            @else

                                <div class="locked-icon cancelled">
                                    <i class="bi bi-slash-circle"></i>
                                </div>

                                <p>
                                    Pesanan sudah tidak dapat diubah.
                                </p>

                            @endif

                        </div>

                    @endif

                </div>

            </div>

            {{-- Waktu Pesanan --}}
            <div class="card-custom">

                <div class="section-body">

                    <div class="order-date-row">
                        <small>
                            Tanggal Pesanan
                        </small>

                        <strong>
                            {{ $order->order_date?->format('d/m/Y') ?? '-' }}
                        </strong>
                    </div>

                    <div class="order-date-row">
                        <small>
                            Waktu
                        </small>

                        <strong>
                            {{ $order->order_date?->format('H:i') ?? '-' }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>
.order-detail-page {
    padding-bottom: 40px;
}

/* =========================
   HEADER
========================= */

.page-header {
    position: relative;
    overflow: hidden;
    background: linear-gradient(
        135deg,
        #1A2B5C 0%,
        #2E5B9C 100%
    );
    border-radius: 20px;
    padding: 25px 30px 28px;
    color: #fff;
}

.page-header h2 {
    font-weight: 700;
    font-size: 1.45rem;
}

.page-header p {
    font-size: .9rem;
    opacity: .85;
}

.header-decoration {
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .06);
    right: -45px;
    top: -75px;
}

.breadcrumb-custom {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, .65);
    font-size: .78rem;
}

.breadcrumb-custom a {
    color: rgba(255, 255, 255, .85);
    text-decoration: none;
}

.breadcrumb-custom a:hover {
    color: #fff;
}

/* =========================
   CARD
========================= */

.card-custom {
    background: #fff;
    border: 1px solid #e9edf5;
    border-radius: 18px;
    box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
    overflow: hidden;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 18px 22px;
    border-bottom: 1px solid #e9edf5;
}

.section-header > div {
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-header h5 {
    color: #1A2B5C;
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.section-header > small {
    color: #8a94a3;
    font-size: .76rem;
}

.section-body {
    padding: 22px;
}

/* =========================
   STATUS
========================= */

.status-badge {
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: .68rem;
    font-weight: 700;
}

.page-header .status-badge {
    background: rgba(255, 255, 255, .13);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, .18);
}

.status-badge.pending {
    background: #fff4d6;
    color: #8a6800;
}

.status-badge.processed {
    background: #edf3fb;
    color: #2E5B9C;
}

.status-badge.shipped {
    background: #e8f0ff;
    color: #2856a6;
}

.status-badge.completed,
.status-badge.paid {
    background: #e8f7ee;
    color: #18794e;
}

.status-badge.cancelled,
.status-badge.failed {
    background: #fdeaea;
    color: #b42318;
}

.status-badge.default {
    background: #f1f4f8;
    color: #526071;
}

.page-header .status-badge.pending {
    background: rgba(255, 244, 214, .18);
    color: #fff3c4;
}

.page-header .status-badge.paid,
.page-header .status-badge.completed {
    background: rgba(232, 247, 238, .18);
    color: #d5f3df;
}

.page-header .status-badge.failed,
.page-header .status-badge.cancelled {
    background: rgba(253, 234, 234, .18);
    color: #ffdada;
}

/* =========================
   PRODUCT
========================= */

.product-item {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 20px 22px;
}

.product-cover {
    width: 70px;
    min-width: 70px;
    height: 90px;
    overflow: hidden;
    border-radius: 9px;
    background: #f1f4f8;
}

.product-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cover-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #8a94a3;
    font-size: 1.7rem;
}

.product-information {
    flex: 1;
    min-width: 0;
}

.product-information h6 {
    color: #344054;
    font-size: .9rem;
    font-weight: 700;
    margin-bottom: 4px;
}

.author {
    color: #8a94a3;
    font-size: .76rem;
}

.product-price {
    color: #687587;
    font-size: .76rem;
    margin-top: 10px;
}

.product-total {
    text-align: right;
    min-width: 150px;
}

.product-total small {
    display: block;
    color: #8a94a3;
    font-size: .7rem;
    margin-bottom: 3px;
}

.product-total strong {
    color: #1A2B5C;
    font-size: .88rem;
}

/* =========================
   INFORMATION
========================= */

.info-row {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.info-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 10px;
    background: #edf3fb;
    color: #2E5B9C;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.05rem;
}

.info-label,
.detail-label {
    color: #687587;
    font-size: .72rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.info-value {
    font-size: .82rem;
    line-height: 1.6;
}

.info-value.muted {
    color: #475467;
}

/* =========================
   PAYMENT
========================= */

.detail-value {
    color: #475467;
    font-size: .82rem;
}

.detail-value.price {
    color: #1A2B5C;
    font-weight: 700;
}

.verification {
    font-size: .8rem;
    font-weight: 600;
}

.verification.verified {
    color: #18794e;
}

.verification.rejected {
    color: #b42318;
}

.verification.waiting {
    color: #8a6800;
}

.empty-payment {
    text-align: center;
    padding: 20px 10px;
}

.empty-payment-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: #edf3fb;
    color: #2E5B9C;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 1.35rem;
}

.empty-payment p {
    color: #8a94a3;
    font-size: .8rem;
    margin: 0;
}

/* =========================
   RESELLER
========================= */

.reseller-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #edf0f5;
}

.profile-avatar {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 50%;
    background: #edf3fb;
    color: #2E5B9C;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    font-weight: 700;
}

.profile-name {
    color: #344054;
    font-size: .88rem;
    font-weight: 700;
    margin-bottom: 3px;
}

.reseller-profile small {
    color: #8a94a3;
    font-size: .72rem;
}

.profile-detail {
    margin-bottom: 17px;
}

.profile-detail:last-child {
    margin-bottom: 0;
}

.detail-value.strong {
    color: #1A2B5C;
    font-weight: 700;
}

.package-badge {
    display: inline-flex;
    align-items: center;
    background: #edf3fb;
    color: #2E5B9C;
    border-radius: 20px;
    padding: 6px 10px;
    font-size: .68rem;
    font-weight: 700;
}

/* =========================
   SUMMARY
========================= */

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 14px;
    font-size: .8rem;
}

.summary-row span {
    color: #687587;
}

.summary-row strong {
    color: #475467;
    font-weight: 600;
}

.discount-value {
    color: #18794e !important;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.summary-total span {
    color: #344054;
    font-size: .85rem;
    font-weight: 700;
}

.summary-total strong {
    color: #2E5B9C;
    font-size: 1.05rem;
    font-weight: 700;
}

/* =========================
   STATUS MANAGEMENT
========================= */

.status-select {
    border: 1px solid #dce3ed;
    border-radius: 9px;
    font-size: .82rem;
    padding: 10px 12px;
    min-height: 42px;
}

.status-select:focus {
    border-color: #2E5B9C;
    box-shadow: 0 0 0 3px rgba(46, 91, 156, .08);
}

.status-section .form-label,
.section-body .form-label {
    color: #344054;
    font-size: .8rem;
    font-weight: 600;
}

.btn-update-status {
    min-height: 42px;
    border: 0;
    border-radius: 9px;
    background: #1A2B5C;
    color: #fff;
    font-size: .82rem;
    font-weight: 600;
    padding: 10px 15px;
    transition: .2s ease;
}

.btn-update-status:hover {
    background: #142249;
    color: #fff;
}

.status-locked {
    text-align: center;
    padding: 10px 0;
}

.locked-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 1.35rem;
}

.locked-icon.completed {
    background: #e8f7ee;
    color: #18794e;
}

.locked-icon.cancelled {
    background: #fdeaea;
    color: #b42318;
}

.status-locked p {
    color: #8a94a3;
    font-size: .8rem;
    margin: 0;
}

/* =========================
   ORDER DATE
========================= */

.order-date-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.order-date-row + .order-date-row {
    margin-top: 10px;
}

.order-date-row small {
    color: #8a94a3;
    font-size: .72rem;
}

.order-date-row strong {
    color: #475467;
    font-size: .76rem;
}

/* =========================
   COUNT PILL
========================= */

.count-pill {
    background: #edf3fb;
    color: #2E5B9C;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: .72rem;
    font-weight: 700;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 767.98px) {

    .page-header {
        padding: 22px 20px;
        border-radius: 16px;
    }

    .page-header h2 {
        font-size: 1.25rem;
    }

    .section-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 16px;
    }

    .section-header > div {
        flex-wrap: wrap;
    }

    .section-body {
        padding: 18px;
    }

    .product-item {
        align-items: flex-start;
        flex-wrap: wrap;
        padding: 18px;
    }

    .product-information {
        width: calc(100% - 88px);
    }

    .product-total {
        width: 100%;
        text-align: left;
        padding-left: 88px;
        min-width: 0;
    }

    .breadcrumb-custom {
        margin-bottom: 12px !important;
    }

}
</style>
@endsection