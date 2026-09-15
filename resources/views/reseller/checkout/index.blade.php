@extends('layouts.cyber-master')

@section('title', 'Checkout')

@section('content')

<div class="checkout-page container-fluid py-4">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="page-header mb-4">

        <div class="header-decoration"></div>

        <div class="position-relative d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>

                <div class="header-label mb-2">
                    <i class="bi bi-credit-card me-1"></i>
                    Penyelesaian Pesanan
                </div>

                <h2 class="mb-1">
                    Checkout
                </h2>

                <p class="mb-0">
                    Periksa kembali pesanan dan lengkapi alamat pengiriman.
                </p>

            </div>


            <a
                href="{{ route('reseller.cart.index') }}"
                class="header-action"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Kembali ke Keranjang
            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="custom-alert custom-alert-danger mb-4">

            <div class="custom-alert-icon">
                <i class="bi bi-exclamation-circle-fill"></i>
            </div>

            <div class="custom-alert-content">

                <strong>
                    Checkout tidak dapat diproses.
                </strong>

                <ul class="mb-0 ps-3">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        CHECKOUT CONTENT
    ========================================================== --}}
    <div class="row g-4">

        {{-- =====================================================
            LEFT COLUMN
        ====================================================== --}}
        <div class="col-lg-8">


            {{-- =================================================
                ORDER ITEMS
            ================================================== --}}
            <div class="card-custom mb-4">

                <div class="card-custom-header">

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">

                        <div>

                            <div class="d-flex align-items-center gap-2">

                                <h5 class="mb-1">
                                    Detail Pesanan
                                </h5>

                                <span class="count-pill">
                                    {{ $totalQuantity }}
                                </span>

                            </div>

                            <p class="mb-0">
                                {{ $totalQuantity }} buku
                                dari {{ count($items) }} produk
                            </p>

                        </div>


                        <span class="package-badge">

                            <i class="bi bi-box-seam me-1"></i>

                            Paket {{ $package->name }}

                        </span>

                    </div>

                </div>


                <div class="order-items-body">

                    @foreach($items as $item)

                        @php
                            $product = $item['product'];
                            $quantity = $item['quantity'];
                            $itemTotal = $item['item_total'];

                            $itemDiscount = $minimumPurchaseMet
                                ? $itemTotal * ($discountPercentage / 100)
                                : 0;

                            $itemFinal = $itemTotal - $itemDiscount;
                        @endphp


                        <div class="checkout-item">

                            <div class="row align-items-center g-3">

                                {{-- Product Image --}}
                                <div class="col-4 col-sm-3 col-md-2">

                                    <div class="checkout-image-wrapper">

                                        <img
                                            src="{{ $product->cover_url }}"
                                            alt="{{ $product->title }}"
                                            class="checkout-product-image"
                                        >

                                    </div>

                                </div>


                                {{-- Product Information --}}
                                <div class="col-8 col-sm-9 col-md-6">

                                    <span class="category-badge">

                                        <i class="bi bi-bookmark-fill me-1"></i>

                                        {{ $product->category ?? 'Buku' }}

                                    </span>


                                    <h6 class="product-title">
                                        {{ $product->title }}
                                    </h6>


                                    @if($product->author)

                                        <div class="product-author">

                                            <i class="bi bi-person me-1"></i>

                                            {{ $product->author }}

                                        </div>

                                    @endif


                                    <div class="unit-price">

                                        Harga satuan:

                                        <strong>
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- Quantity --}}
                                <div class="col-5 col-md-2">

                                    <div class="field-label">
                                        Jumlah
                                    </div>

                                    <div class="quantity-display">

                                        <i class="bi bi-box-seam me-1"></i>

                                        {{ $quantity }} buku

                                    </div>

                                </div>


                                {{-- Total --}}
                                <div class="col-7 col-md-2 text-md-end">

                                    <div class="price-label">
                                        Total
                                    </div>


                                    @if($minimumPurchaseMet)

                                        <div class="original-price">

                                            Rp {{ number_format($itemTotal, 0, ',', '.') }}

                                        </div>


                                        <div class="checkout-price">

                                            Rp {{ number_format($itemFinal, 0, ',', '.') }}

                                        </div>


                                        <div class="discount-info">

                                            <i class="bi bi-tag-fill me-1"></i>
                                            Diskon {{ $discountPercentage }}%

                                        </div>

                                    @else

                                        <div class="checkout-price">

                                            Rp {{ number_format($itemTotal, 0, ',', '.') }}

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =================================================
                SHIPPING ADDRESS
            ================================================== --}}
            <div class="card-custom">

                <div class="card-custom-header">

                    <div class="d-flex align-items-center gap-3">

                        <div class="section-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>

                            <h5 class="mb-1">
                                Alamat Pengiriman
                            </h5>

                            <p class="mb-0">
                                Pesanan akan dikirim ke alamat berikut.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="card-body-custom">

                    <form
                        action="{{ route('reseller.checkout.store') }}"
                        method="POST"
                        id="checkoutForm"
                    >

                        @csrf


                        {{-- Shipping Address --}}
                        <div class="mb-4">

                            <label
                                for="shipping_address"
                                class="form-label-custom"
                            >
                                Alamat Lengkap
                                <span class="required-mark">*</span>
                            </label>


                            <textarea
                                name="shipping_address"
                                id="shipping_address"
                                rows="6"
                                class="form-control-custom @error('shipping_address') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap pengiriman..."
                                maxlength="1000"
                                required
                            >{{ old('shipping_address', $user->address) }}</textarea>


                            @error('shipping_address')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                            @enderror


                            <div class="form-help">

                                <i class="bi bi-info-circle me-1"></i>

                                Maksimal 1000 karakter.

                            </div>

                        </div>


                        {{-- Customer Information --}}
                        <div class="customer-info">

                            <div class="customer-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            <div class="customer-content">

                                <div class="customer-label">
                                    Informasi Reseller
                                </div>

                                <div class="customer-name">
                                    {{ $user->name }}
                                </div>

                                <div class="customer-detail">

                                    <span>
                                        <i class="bi bi-envelope me-1"></i>
                                        {{ $user->email }}
                                    </span>

                                    @if($user->phone)

                                        <span>
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $user->phone }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Submit --}}
                        <div class="checkout-actions">

                            <a
                                href="{{ route('reseller.cart.index') }}"
                                class="btn-secondary-custom"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali
                            </a>


                            <button
                                type="submit"
                                class="btn-primary-custom"
                                id="submitCheckout"
                            >
                                <span class="button-text">
                                    Buat Pesanan
                                </span>

                                <i class="bi bi-arrow-right ms-2"></i>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT COLUMN
        ====================================================== --}}
        <div class="col-lg-4">


            {{-- =================================================
                ORDER SUMMARY
            ================================================== --}}
            <div class="card-custom summary-card">

                <div class="summary-header">

                    <div class="summary-header-icon">
                        <i class="bi bi-receipt"></i>
                    </div>

                    <div>

                        <h5>
                            Ringkasan Pembayaran
                        </h5>

                        <p>
                            Rincian biaya pesanan
                        </p>

                    </div>

                </div>


                <div class="summary-body">

                    {{-- Total Books --}}
                    <div class="summary-row">

                        <span>
                            Total Buku
                        </span>

                        <strong>
                            {{ $totalQuantity }} buku
                        </strong>

                    </div>


                    {{-- Normal Price --}}
                    <div class="summary-row">

                        <span>
                            Total Harga
                        </span>

                        <strong>
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </strong>

                    </div>


                    {{-- Package --}}
                    <div class="summary-row">

                        <span>
                            Paket
                        </span>

                        <strong>
                            {{ $package->name }}
                        </strong>

                    </div>


                    {{-- Minimum --}}
                    <div class="summary-row">

                        <span>
                            Minimum Pembelian
                        </span>

                        <strong>
                            {{ $minimumPurchase }} buku
                        </strong>

                    </div>


                    <hr class="summary-divider">


                    {{-- Discount --}}
                    <div class="summary-row">

                        <span>
                            Diskon {{ $discountPercentage }}%
                        </span>

                        @if($minimumPurchaseMet)

                            <strong class="discount-total">

                                - Rp
                                {{ number_format($discountAmount, 0, ',', '.') }}

                            </strong>

                        @else

                            <strong class="zero-discount">
                                Rp 0
                            </strong>

                        @endif

                    </div>


                    {{-- Final Total --}}
                    <div class="final-summary">

                        <div class="final-summary-label">
                            Total Pembayaran
                        </div>

                        <div class="final-total">

                            Rp {{ number_format($finalPrice, 0, ',', '.') }}

                        </div>

                        <div class="final-summary-note">

                            <i class="bi bi-check-circle me-1"></i>

                            Harga setelah diskon reseller

                        </div>

                    </div>


                    {{-- Minimum Status --}}
                    <div class="minimum-status">

                        @if($minimumPurchaseMet)

                            <div class="status-icon success">
                                <i class="bi bi-check-lg"></i>
                            </div>

                            <div class="status-content">

                                <div class="status-title success-text">
                                    Minimum terpenuhi
                                </div>

                                <small>
                                    Pesanan dapat diproses.
                                </small>

                            </div>

                        @else

                            <div class="status-icon warning">
                                <i class="bi bi-exclamation-lg"></i>
                            </div>

                            <div class="status-content">

                                <div class="status-title warning-text">
                                    Minimum belum terpenuhi
                                </div>

                                <small>
                                    Minimal {{ $minimumPurchase }} buku.
                                </small>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =================================================
                ORDER PROCESS
            ================================================== --}}
            <div class="card-custom mt-4">

                <div class="card-custom-header">

                    <h5 class="mb-1">
                        Proses Pesanan
                    </h5>

                    <p class="mb-0">
                        Tahapan pesanan setelah checkout.
                    </p>

                </div>


                <div class="process-body">

                    <div class="process-step">

                        <div class="process-number active">
                            1
                        </div>

                        <div class="process-content">

                            <div class="process-title">
                                Checkout
                            </div>

                            <small>
                                Periksa pesanan dan alamat.
                            </small>

                        </div>

                    </div>


                    <div class="process-line"></div>


                    <div class="process-step">

                        <div class="process-number">
                            2
                        </div>

                        <div class="process-content">

                            <div class="process-title">
                                Pembayaran
                            </div>

                            <small>
                                Upload bukti pembayaran.
                            </small>

                        </div>

                    </div>


                    <div class="process-line"></div>


                    <div class="process-step">

                        <div class="process-number">
                            3
                        </div>

                        <div class="process-content">

                            <div class="process-title">
                                Verifikasi
                            </div>

                            <small>
                                Admin memverifikasi pembayaran.
                            </small>

                        </div>

                    </div>


                    <div class="process-line"></div>


                    <div class="process-step">

                        <div class="process-number">
                            4
                        </div>

                        <div class="process-content">

                            <div class="process-title">
                                Pengiriman
                            </div>

                            <small>
                                Pesanan diproses dan dikirim.
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                IMPORTANT INFORMATION
            ================================================== --}}
            <div class="card-custom mt-4">

                <div class="card-custom-header">

                    <h5 class="mb-1">
                        Informasi Penting
                    </h5>

                    <p class="mb-0">
                        Perhatikan sebelum membuat pesanan.
                    </p>

                </div>


                <div class="information-body">

                    <div class="information-item">

                        <div class="info-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>

                            <div class="info-title">
                                Alamat Pengiriman
                            </div>

                            <small>
                                Pastikan alamat pengiriman sudah benar
                                sebelum membuat pesanan.
                            </small>

                        </div>

                    </div>


                    <div class="information-item">

                        <div class="info-icon">
                            <i class="bi bi-tag"></i>
                        </div>

                        <div>

                            <div class="info-title">
                                Harga Reseller
                            </div>

                            <small>
                                Harga reseller dihitung otomatis berdasarkan
                                paket Anda.
                            </small>

                        </div>

                    </div>


                    <div class="information-item">

                        <div class="info-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>

                        <div>

                            <div class="info-title">
                                Pembayaran
                            </div>

                            <small>
                                Setelah pesanan dibuat, Anda dapat mengunggah
                                bukti pembayaran pada halaman pesanan.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    CUSTOM STYLE
============================================================== --}}
@push('styles')

<style>

    /* =========================================================
       PAGE
    ========================================================== */

    .checkout-page {
        padding-bottom: 40px;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .checkout-page .page-header {
        position: relative;
        overflow: hidden;
        padding: 28px 30px;
        border-radius: 20px;
        background: linear-gradient(
            135deg,
            #1A2B5C 0%,
            #2E5B9C 100%
        );
        color: #fff;
    }

    .checkout-page .page-header h2 {
        color: #fff;
        font-size: 1.45rem;
        font-weight: 700;
    }

    .checkout-page .page-header p {
        color: rgba(255,255,255,.85);
        font-size: .9rem;
    }

    .header-decoration {
        position: absolute;
        width: 180px;
        height: 180px;
        right: -45px;
        top: -75px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }

    .header-label {
        color: rgba(255,255,255,.72);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .header-action {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 10px 17px;
        border: 1px solid rgba(255,255,255,.24);
        border-radius: 10px;
        background: rgba(255,255,255,.12);
        color: #fff;
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .header-action:hover {
        background: #fff;
        border-color: #fff;
        color: #1A2B5C;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,.14);
    }


    /* =========================================================
       ALERT
    ========================================================== */

    .custom-alert {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 15px 45px 15px 16px;
        border: 1px solid;
        border-radius: 12px;
        font-size: .8rem;
    }

    .custom-alert-danger {
        background: #fdeaea;
        border-color: #f4caca;
        color: #b42318;
    }

    .custom-alert-icon {
        font-size: 17px;
        line-height: 1.4;
    }

    .custom-alert-content {
        min-width: 0;
        line-height: 1.6;
    }

    .custom-alert-content strong {
        display: block;
        margin-bottom: 3px;
        font-weight: 700;
    }

    .custom-alert-content ul {
        margin-top: 3px;
    }

    .custom-alert-content li {
        margin-bottom: 2px;
    }

    .custom-alert .btn-close {
        position: absolute;
        top: 15px;
        right: 14px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .card-custom {
        overflow: hidden;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
    }

    .card-custom-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eef1f6;
    }

    .card-custom-header h5 {
        color: #1A2B5C;
        font-size: 1rem;
        font-weight: 700;
    }

    .card-custom-header p {
        color: #687587;
        font-size: .72rem;
    }

    .count-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        padding: 4px 9px;
        border-radius: 20px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .67rem;
        font-weight: 700;
    }


    /* =========================================================
       SECTION ICON
    ========================================================== */

    .section-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 17px;
    }


    /* =========================================================
       PACKAGE BADGE
    ========================================================== */

    .package-badge {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        border: 1px solid #d7e3f3;
        border-radius: 8px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .67rem;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       ORDER ITEMS
    ========================================================== */

    .order-items-body {
        background: #fff;
    }

    .checkout-item {
        padding: 22px;
        border-top: 1px solid #eef1f6;
        transition: background .2s ease;
    }

    .checkout-item:first-child {
        border-top: none;
    }

    .checkout-item:hover {
        background: #fafcff;
    }

    .checkout-image-wrapper {
        overflow: hidden;
        border-radius: 11px;
        background: #f5f7fb;
    }

    .checkout-product-image {
        width: 100%;
        height: 135px;
        display: block;
        object-fit: cover;
        background: #f5f7fb;
    }


    /* =========================================================
       PRODUCT INFORMATION
    ========================================================== */

    .category-badge {
        display: inline-flex;
        align-items: center;
        margin-bottom: 8px;
        padding: 5px 8px;
        border-radius: 7px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .62rem;
        font-weight: 700;
    }

    .product-title {
        margin-bottom: 4px;
        color: #1A2B5C;
        font-size: .9rem;
        line-height: 1.45;
        font-weight: 700;
    }

    .product-author {
        margin-bottom: 7px;
        color: #687587;
        font-size: .69rem;
    }

    .unit-price {
        color: #687587;
        font-size: .67rem;
    }

    .unit-price strong {
        color: #344054;
    }


    /* =========================================================
       QUANTITY
    ========================================================== */

    .field-label {
        margin-bottom: 7px;
        color: #687587;
        font-size: .67rem;
        font-weight: 600;
    }

    .quantity-display {
        display: inline-flex;
        align-items: center;
        min-height: 35px;
        padding: 7px 10px;
        border: 1px solid #e1e6ee;
        border-radius: 8px;
        background: #f8faff;
        color: #344054;
        font-size: .7rem;
        font-weight: 700;
    }


    /* =========================================================
       ITEM PRICE
    ========================================================== */

    .price-label {
        margin-bottom: 2px;
        color: #687587;
        font-size: .65rem;
    }

    .original-price {
        color: #98a2b3;
        font-size: .66rem;
        text-decoration: line-through;
    }

    .checkout-price {
        margin-top: 3px;
        color: #1A2B5C;
        font-size: .96rem;
        font-weight: 800;
    }

    .discount-info {
        margin-top: 4px;
        color: #18794e;
        font-size: .62rem;
        font-weight: 700;
    }


    /* =========================================================
       SHIPPING ADDRESS
    ========================================================== */

    .card-body-custom {
        padding: 22px;
    }

    .form-label-custom {
        display: block;
        margin-bottom: 8px;
        color: #344054;
        font-size: .78rem;
        font-weight: 700;
    }

    .required-mark {
        color: #b42318;
    }

    .form-control-custom {
        width: 100%;
        min-height: 45px;
        padding: 10px 12px;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        background: #fff;
        color: #344054;
        font-size: .78rem;
        line-height: 1.6;
        outline: none;
        resize: vertical;
        transition: all .2s ease;
    }

    .form-control-custom:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.08);
    }

    .form-control-custom::placeholder {
        color: #98a2b3;
    }

    .form-control-custom.is-invalid {
        border-color: #d92d20;
    }

    .form-help {
        margin-top: 7px;
        color: #98a2b3;
        font-size: .64rem;
    }

    .invalid-feedback {
        color: #b42318;
        font-size: .68rem;
    }


    /* =========================================================
       CUSTOMER INFO
    ========================================================== */

    .customer-info {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px;
        border: 1px solid #e4e9f0;
        border-radius: 12px;
        background: #f8faff;
    }

    .customer-icon {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 18px;
    }

    .customer-content {
        min-width: 0;
    }

    .customer-label {
        margin-bottom: 2px;
        color: #98a2b3;
        font-size: .62rem;
        font-weight: 600;
    }

    .customer-name {
        margin-bottom: 3px;
        color: #1A2B5C;
        font-size: .8rem;
        font-weight: 700;
    }

    .customer-detail {
        display: flex;
        flex-wrap: wrap;
        gap: 5px 15px;
        color: #687587;
        font-size: .65rem;
    }


    /* =========================================================
       CHECKOUT ACTIONS
    ========================================================== */

    .checkout-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 22px;
    }

    .btn-primary-custom,
    .btn-secondary-custom {
        min-height: 43px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 15px;
        border-radius: 9px;
        font-size: .76rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .btn-primary-custom {
        border: 1px solid #1A2B5C;
        background: #1A2B5C;
        color: #fff;
    }

    .btn-primary-custom:hover {
        border-color: #2E5B9C;
        background: #2E5B9C;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(26,43,92,.15);
    }

    .btn-primary-custom:disabled {
        cursor: not-allowed;
        opacity: .7;
        transform: none;
        box-shadow: none;
    }

    .btn-secondary-custom {
        border: 1px solid #dfe4ec;
        background: #fff;
        color: #526071;
    }

    .btn-secondary-custom:hover {
        border-color: #cbd5e1;
        background: #f8faff;
        color: #1A2B5C;
    }


    /* =========================================================
       SUMMARY CARD
    ========================================================== */

    .summary-card {
        position: sticky;
        top: 90px;
    }

    .summary-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 22px;
        border-bottom: 1px solid #eef1f6;
    }

    .summary-header-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 17px;
    }

    .summary-header h5 {
        margin: 0 0 2px;
        color: #1A2B5C;
        font-size: .98rem;
        font-weight: 700;
    }

    .summary-header p {
        margin: 0;
        color: #687587;
        font-size: .67rem;
    }

    .summary-body {
        padding: 21px 22px;
    }

    .summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
        font-size: .76rem;
    }

    .summary-row span {
        color: #687587;
    }

    .summary-row strong {
        color: #344054;
        font-weight: 700;
        text-align: right;
    }

    .summary-divider {
        margin: 19px 0;
        border-color: #eef1f6;
        opacity: 1;
    }

    .discount-total {
        color: #18794e !important;
    }

    .zero-discount {
        color: #98a2b3 !important;
    }


    /* =========================================================
       FINAL SUMMARY
    ========================================================== */

    .final-summary {
        margin-top: 20px;
        padding: 17px;
        border: 1px solid #dce6f3;
        border-radius: 13px;
        background: #f6f9fd;
    }

    .final-summary-label {
        margin-bottom: 3px;
        color: #687587;
        font-size: .67rem;
        font-weight: 600;
    }

    .final-total {
        color: #1A2B5C;
        font-size: 1.4rem;
        font-weight: 800;
        line-height: 1.3;
    }

    .final-summary-note {
        margin-top: 5px;
        color: #687587;
        font-size: .61rem;
    }

    .final-summary-note i {
        color: #18794e;
    }


    /* =========================================================
       MINIMUM STATUS
    ========================================================== */

    .minimum-status {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 13px;
        padding: 13px;
        border-radius: 11px;
        background: #f8faff;
        border: 1px solid #edf0f5;
    }

    .status-icon {
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: .8rem;
        font-weight: 800;
    }

    .status-icon.success {
        background: #e8f7ee;
        color: #18794e;
    }

    .status-icon.warning {
        background: #fff4d6;
        color: #8a6800;
    }

    .status-content {
        min-width: 0;
    }

    .status-title {
        margin-bottom: 2px;
        font-size: .7rem;
        font-weight: 700;
    }

    .success-text {
        color: #18794e;
    }

    .warning-text {
        color: #8a6800;
    }

    .status-content small {
        color: #687587;
        font-size: .63rem;
    }


    /* =========================================================
       PROCESS
    ========================================================== */

    .process-body {
        padding: 17px 22px 20px;
    }

    .process-step {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .process-number {
        width: 32px;
        height: 32px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #edf0f5;
        color: #687587;
        font-size: .72rem;
        font-weight: 700;
    }

    .process-number.active {
        background: #2E5B9C;
        color: #fff;
        box-shadow: 0 4px 10px rgba(46,91,156,.18);
    }

    .process-content {
        min-width: 0;
    }

    .process-title {
        margin-bottom: 2px;
        color: #1A2B5C;
        font-size: .72rem;
        font-weight: 700;
    }

    .process-content small {
        color: #687587;
        font-size: .63rem;
        line-height: 1.45;
    }

    .process-line {
        width: 1px;
        height: 22px;
        margin-left: 16px;
        background: #dfe3eb;
    }


    /* =========================================================
       INFORMATION
    ========================================================== */

    .information-body {
        padding: 6px 22px;
    }

    .information-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px 0;
        border-bottom: 1px solid #eef1f6;
    }

    .information-item:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .82rem;
    }

    .info-title {
        margin-bottom: 2px;
        color: #1A2B5C;
        font-size: .7rem;
        font-weight: 700;
    }

    .information-item small {
        color: #687587;
        font-size: .63rem;
        line-height: 1.55;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 991.98px) {

        .summary-card {
            position: static;
        }

    }


    @media (max-width: 767.98px) {

        .checkout-page .page-header {
            padding: 23px 20px;
            border-radius: 17px;
        }

        .checkout-page .page-header h2 {
            font-size: 1.25rem;
        }

        .header-action {
            width: 100%;
        }

        .checkout-item {
            padding: 18px;
        }

        .checkout-product-image {
            height: 120px;
        }

        .card-body-custom {
            padding: 18px;
        }

        .checkout-actions {
            justify-content: stretch;
        }

        .btn-primary-custom,
        .btn-secondary-custom {
            flex: 1;
        }

    }


    @media (max-width: 575.98px) {

        .checkout-item {
            padding: 15px;
        }

        .checkout-product-image {
            height: 110px;
        }

        .card-custom-header {
            padding: 18px;
        }

        .summary-body {
            padding: 18px;
        }

        .process-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        .information-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        .customer-info {
            align-items: flex-start;
        }

        .customer-detail {
            flex-direction: column;
            gap: 3px;
        }

        .package-badge {
            align-self: flex-start;
        }

    }

</style>

@endpush


{{-- =============================================================
    CHECKOUT SCRIPT
============================================================== --}}
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('checkoutForm');
    const submitButton = document.getElementById('submitCheckout');

    if (!form || !submitButton) {
        return;
    }

    form.addEventListener('submit', function (event) {

        const addressInput = document.getElementById('shipping_address');

        if (!addressInput) {
            return;
        }

        const address = addressInput.value.trim();

        if (!address) {

            event.preventDefault();

            alert('Alamat pengiriman wajib diisi.');

            addressInput.focus();

            return;
        }


        const confirmed = confirm(
            'Apakah Anda yakin data pesanan dan alamat pengiriman sudah benar?'
        );


        if (!confirmed) {

            event.preventDefault();

            return;
        }


        submitButton.disabled = true;

        submitButton.innerHTML =
            '<span><i class="bi bi-hourglass-split me-2"></i>Memproses Pesanan...</span>';

    });

});

</script>

@endpush

@endsection