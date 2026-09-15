@extends('layouts.cyber-master')

@section('title', 'Keranjang Belanja')

@section('content')

@php
    $reseller = auth()->user()->reseller;
    $package = $reseller?->package;

    $discountPercentage = $package?->discount_percentage ?? 0;
    $minimumPurchase = (int) ($package?->min_purchase ?? 0);

    /*
     * Diskon hanya berlaku jika minimum pembelian
     * paket sudah terpenuhi.
     */
    $minimumPurchaseMet = $totalQuantity >= $minimumPurchase;

    $discountAmount = $minimumPurchaseMet
        ? $subtotal * ($discountPercentage / 100)
        : 0;

    $finalTotal = $subtotal - $discountAmount;

    $remainingQuantity = max(
        0,
        $minimumPurchase - $totalQuantity
    );

    $progressPercentage = $minimumPurchase > 0
        ? min(
            100,
            ($totalQuantity / $minimumPurchase) * 100
        )
        : 100;
@endphp


<div class="cart-page container-fluid py-4">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="page-header mb-4">

        <div class="header-decoration"></div>

        <div class="position-relative d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>

                <div class="header-label mb-2">
                    <i class="bi bi-cart3 me-1"></i>
                    Belanja Reseller
                </div>

                <h2 class="mb-1">
                    Keranjang Belanja
                </h2>

                <p class="mb-0">
                    Periksa kembali buku yang ingin Anda pesan.
                </p>

            </div>


            <a
                href="{{ route('reseller.catalog.index') }}"
                class="header-action"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Kembali ke Katalog
            </a>

        </div>

    </div>


    {{-- =========================================================
        FLASH ERROR CART
    ========================================================== --}}
    @if($errors->has('cart'))

        <div class="custom-alert custom-alert-danger mb-4">

            <div class="custom-alert-icon">
                <i class="bi bi-exclamation-circle-fill"></i>
            </div>

            <div class="custom-alert-content">

                <strong>Perhatian!</strong>

                <span>
                    {{ $errors->first('cart') }}
                </span>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        FLASH ERROR CHECKOUT
    ========================================================== --}}
    @if($errors->has('checkout'))

        <div class="custom-alert custom-alert-danger mb-4">

            <div class="custom-alert-icon">
                <i class="bi bi-exclamation-circle-fill"></i>
            </div>

            <div class="custom-alert-content">

                <strong>Checkout tidak dapat dilanjutkan.</strong>

                <span>
                    {{ $errors->first('checkout') }}
                </span>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        PACKAGE INFORMATION
    ========================================================== --}}
    <div class="package-card mb-4">

        <div class="package-icon">
            <i class="bi bi-box-seam"></i>
        </div>

        <div class="package-content">

            <div class="package-title">
                Paket {{ $package?->name ?? 'Reseller' }}
            </div>

            <div class="package-description">

                Diskon
                <strong>{{ $discountPercentage }}%</strong>

                <span class="package-separator">•</span>

                Minimum pembelian
                <strong>{{ $minimumPurchase }} buku</strong>

            </div>


            {{-- Progress Minimum Pembelian --}}
            @if($totalQuantity > 0)

                <div class="purchase-progress-wrapper mt-3">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <span class="progress-label">
                            Progress minimum pembelian
                        </span>

                        <span class="progress-percentage">
                            {{ number_format($progressPercentage, 0) }}%
                        </span>

                    </div>

                    <div class="purchase-progress">

                        <div
                            class="purchase-progress-bar"
                            role="progressbar"
                            style="width: {{ $progressPercentage }}%"
                            aria-valuenow="{{ $totalQuantity }}"
                            aria-valuemin="0"
                            aria-valuemax="{{ $minimumPurchase }}"
                        ></div>

                    </div>


                    <div class="progress-message mt-2">

                        @if($minimumPurchaseMet)

                            <span class="progress-success">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Minimum pembelian terpenuhi.
                                Anda dapat melanjutkan checkout.
                            </span>

                        @else

                            <span class="progress-warning">
                                <i class="bi bi-info-circle-fill me-1"></i>
                                Tambahkan
                                <strong>{{ $remainingQuantity }} buku</strong>
                                lagi untuk memenuhi minimum pembelian.
                            </span>

                        @endif

                    </div>

                </div>

            @endif

        </div>


        <div class="package-discount">

            <strong>
                {{ $discountPercentage }}%
            </strong>

            <span>
                Diskon
            </span>

        </div>

    </div>


    @if(count($items) > 0)

        <div class="row g-4">

            {{-- =================================================
                CART ITEMS
            ================================================== --}}
            <div class="col-lg-8">

                <div class="card-custom cart-items-card">

                    <div class="card-custom-header">

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">

                            <div>

                                <div class="d-flex align-items-center gap-2">

                                    <h5 class="mb-1">
                                        Buku Pilihan Anda
                                    </h5>

                                    <span class="count-pill">
                                        {{ $totalQuantity }}
                                    </span>

                                </div>

                                <p class="mb-0">
                                    {{ $totalQuantity }} buku dalam keranjang
                                </p>

                            </div>


                            {{-- Clear Cart --}}
                            <form
                                action="{{ route('reseller.cart.clear') }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-clear-cart"
                                >
                                    <i class="bi bi-trash3 me-1"></i>
                                    Kosongkan
                                </button>

                            </form>

                        </div>

                    </div>


                    <div class="cart-items-body">

                        @foreach($items as $item)

                            @php

                                $product = $item['product'];

                                $quantity = $item['quantity'];

                                $itemTotal = $item['item_total'];

                                /*
                                 * Diskon item hanya ditampilkan jika
                                 * minimum transaksi terpenuhi.
                                 */
                                $itemDiscount = $minimumPurchaseMet
                                    ? $itemTotal * ($discountPercentage / 100)
                                    : 0;

                                $itemFinal = $itemTotal - $itemDiscount;

                            @endphp


                            <div class="cart-item">

                                <div class="row align-items-center g-3">

                                    {{-- Product Image --}}
                                    <div class="col-4 col-sm-3 col-md-2">

                                        <a
                                            href="{{ route('reseller.catalog.show', $product) }}"
                                            class="cart-image-link"
                                        >

                                            <img
                                                src="{{ $product->cover_url }}"
                                                alt="{{ $product->title }}"
                                                class="cart-product-image"
                                            >

                                        </a>

                                    </div>


                                    {{-- Product Information --}}
                                    <div class="col-8 col-sm-9 col-md-5">

                                        <span class="category-badge">

                                            <i class="bi bi-bookmark-fill me-1"></i>

                                            {{ $product->category ?? 'Buku' }}

                                        </span>


                                        <h5 class="product-title">

                                            <a
                                                href="{{ route('reseller.catalog.show', $product) }}"
                                            >
                                                {{ $product->title }}
                                            </a>

                                        </h5>


                                        @if($product->author)

                                            <div class="product-author">

                                                <i class="bi bi-person me-1"></i>

                                                {{ $product->author }}

                                            </div>

                                        @endif


                                        <div class="stock-info">

                                            <i class="bi bi-box-seam me-1"></i>

                                            Stok tersedia:
                                            <strong>
                                                {{ $product->stock }}
                                            </strong>

                                        </div>

                                    </div>


                                    {{-- Quantity --}}
                                    <div class="col-7 col-md-2">

                                        <label class="field-label">
                                            Jumlah
                                        </label>


                                        <form
                                            action="{{ route('reseller.cart.update', $product) }}"
                                            method="POST"
                                            class="quantity-form"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <div class="quantity-control">

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $quantity }}"
                                                    min="1"
                                                    max="{{ $product->stock }}"
                                                    class="form-control"
                                                    required
                                                >

                                                <button
                                                    type="submit"
                                                    class="quantity-update"
                                                    title="Perbarui jumlah"
                                                >
                                                    <i class="bi bi-check-lg"></i>
                                                </button>

                                            </div>

                                        </form>

                                    </div>


                                    {{-- Price --}}
                                    <div class="col-5 col-md-3 text-md-end">

                                        <div class="price-label">
                                            Subtotal
                                        </div>


                                        <div class="original-price">

                                            Rp {{ number_format($itemTotal, 0, ',', '.') }}

                                        </div>


                                        <div class="item-final-price">

                                            Rp {{ number_format($itemFinal, 0, ',', '.') }}

                                        </div>


                                        @if($minimumPurchaseMet)

                                            <div class="discount-info">

                                                <i class="bi bi-tag-fill me-1"></i>
                                                Diskon {{ $discountPercentage }}%

                                            </div>

                                        @else

                                            <div class="discount-pending">

                                                <i class="bi bi-info-circle me-1"></i>
                                                Diskon setelah minimum terpenuhi

                                            </div>

                                        @endif


                                        <form
                                            action="{{ route('reseller.cart.remove', $product) }}"
                                            method="POST"
                                            class="remove-form"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="remove-button"
                                                onclick="return confirm('Hapus buku ini dari keranjang?');"
                                            >
                                                <i class="bi bi-trash3 me-1"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =================================================
                ORDER SUMMARY
            ================================================== --}}
            <div class="col-lg-4">

                <div class="card-custom summary-card">

                    <div class="summary-header">

                        <div class="summary-header-icon">
                            <i class="bi bi-receipt"></i>
                        </div>

                        <div>

                            <h5>
                                Ringkasan Belanja
                            </h5>

                            <p>
                                Rincian pesanan Anda
                            </p>

                        </div>

                    </div>


                    <div class="summary-body">

                        {{-- Total Quantity --}}
                        <div class="summary-row">

                            <span>
                                Total Buku
                            </span>

                            <strong>
                                {{ $totalQuantity }} buku
                            </strong>

                        </div>


                        {{-- Minimum Purchase --}}
                        <div class="summary-row">

                            <span>
                                Minimum Pembelian
                            </span>

                            <strong>
                                {{ $minimumPurchase }} buku
                            </strong>

                        </div>


                        {{-- Package --}}
                        <div class="summary-row">

                            <span>
                                Paket Reseller
                            </span>

                            <strong>
                                {{ $package?->name ?? '-' }}
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


                        {{-- Discount --}}
                        <div class="summary-row">

                            <span>
                                Diskon ({{ $discountPercentage }}%)
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


                        <hr class="summary-divider">


                        {{-- Final Total --}}
                        <div class="final-total-row">

                            <div>

                                <span>
                                    Total Pembayaran
                                </span>

                                <small>
                                    Harga setelah diskon
                                </small>

                            </div>

                            <strong>
                                Rp {{ number_format($finalTotal, 0, ',', '.') }}
                            </strong>

                        </div>


                        {{-- =========================
                            CHECKOUT BUTTON
                        ========================== --}}
                        @if($minimumPurchaseMet)

                            <a
                                href="{{ route('reseller.checkout.index') }}"
                                class="checkout-button"
                            >
                                <span>
                                    <i class="bi bi-credit-card me-2"></i>
                                    Lanjut ke Checkout
                                </span>

                                <i class="bi bi-arrow-right"></i>

                            </a>


                            <div class="checkout-success">

                                <i class="bi bi-check-circle-fill me-1"></i>

                                Minimum pembelian telah terpenuhi.

                            </div>

                        @else

                            <button
                                type="button"
                                class="checkout-button checkout-disabled"
                                disabled
                                title="Minimum pembelian belum terpenuhi"
                            >
                                <span>
                                    <i class="bi bi-lock-fill me-2"></i>
                                    Checkout Terkunci
                                </span>

                                <i class="bi bi-lock"></i>

                            </button>


                            <div class="checkout-warning">

                                <div class="warning-icon">
                                    <i class="bi bi-exclamation-lg"></i>
                                </div>

                                <div>

                                    <div class="warning-title">
                                        Minimum pembelian belum terpenuhi
                                    </div>

                                    <small>

                                        Tambahkan
                                        <strong>
                                            {{ $remainingQuantity }} buku
                                        </strong>
                                        lagi untuk dapat melanjutkan checkout.

                                    </small>

                                </div>

                            </div>

                        @endif


                        <div class="checkout-note">

                            <i class="bi bi-info-circle me-1"></i>

                            Harga akhir akan dikonfirmasi
                            pada halaman checkout.

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ORDER INFORMATION
                ================================================== --}}
                <div class="card-custom information-card mt-4">

                    <div class="card-custom-header">

                        <h5 class="mb-1">
                            Informasi Pesanan
                        </h5>

                        <p class="mb-0">
                            Hal penting sebelum checkout.
                        </p>

                    </div>


                    <div class="information-body">

                        <div class="information-item">

                            <div class="info-icon">
                                <i class="bi bi-tag-fill"></i>
                            </div>

                            <div>

                                <div class="info-title">
                                    Harga Reseller
                                </div>

                                <small>
                                    Diskon otomatis sesuai paket Anda.
                                </small>

                            </div>

                        </div>


                        <div class="information-item">

                            <div class="info-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>

                                <div class="info-title">
                                    Minimum Pembelian
                                </div>

                                <small>

                                    Paket {{ $package?->name ?? 'Reseller' }}
                                    membutuhkan minimal
                                    {{ $minimumPurchase }} buku per transaksi.

                                </small>

                            </div>

                        </div>


                        <div class="information-item">

                            <div class="info-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <div>

                                <div class="info-title">
                                    Stok Terjamin
                                </div>

                                <small>
                                    Jumlah pembelian mengikuti stok yang tersedia.
                                </small>

                            </div>

                        </div>


                        <div class="information-item">

                            <div class="info-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>

                                <div class="info-title">
                                    Pembayaran Aman
                                </div>

                                <small>
                                    Bukti pembayaran akan diverifikasi admin.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    @else

        {{-- =========================================================
            EMPTY CART
        ========================================================== --}}
        <div class="card-custom">

            <div class="empty-cart">

                <div class="empty-cart-icon">
                    <i class="bi bi-cart-x"></i>
                </div>


                <h3>
                    Keranjang Masih Kosong
                </h3>


                <p>

                    Anda belum memiliki buku di dalam keranjang.
                    Silakan pilih buku dari katalog terlebih dahulu.

                </p>


                <a
                    href="{{ route('reseller.catalog.index') }}"
                    class="btn-primary-custom"
                >
                    <i class="bi bi-book me-1"></i>
                    Lihat Katalog Buku
                </a>

            </div>

        </div>

    @endif

</div>


{{-- =============================================================
    CUSTOM STYLE
============================================================== --}}
@push('styles')

<style>

    /* =========================================================
       PAGE
    ========================================================== */

    .cart-page {
        padding-bottom: 40px;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .cart-page .page-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(
            135deg,
            #1A2B5C 0%,
            #2E5B9C 100%
        );
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
    }

    .cart-page .page-header h2 {
        color: #fff;
        font-size: 1.45rem;
        font-weight: 700;
    }

    .cart-page .page-header p {
        color: rgba(255,255,255,.85);
        font-size: .9rem;
    }

    .header-decoration {
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        right: -45px;
        top: -75px;
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
        border-radius: 10px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.24);
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
        border-radius: 12px;
        border: 1px solid;
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
        line-height: 1.6;
    }

    .custom-alert-content strong {
        display: block;
        margin-bottom: 1px;
        font-weight: 700;
    }

    .custom-alert-content span {
        display: block;
    }

    .custom-alert .btn-close {
        position: absolute;
        right: 14px;
        top: 15px;
    }


    /* =========================================================
       PACKAGE CARD
    ========================================================== */

    .package-card {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 19px 20px;
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
        overflow: hidden;
    }

    .package-card::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: rgba(46,91,156,.035);
        right: -35px;
        top: -60px;
    }

    .package-icon {
        position: relative;
        z-index: 1;
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 21px;
    }

    .package-content {
        position: relative;
        z-index: 1;
        flex: 1;
        min-width: 0;
    }

    .package-title {
        margin-bottom: 3px;
        color: #1A2B5C;
        font-size: .95rem;
        font-weight: 700;
    }

    .package-description {
        color: #687587;
        font-size: .77rem;
    }

    .package-description strong {
        color: #2E5B9C;
    }

    .package-separator {
        margin: 0 5px;
        color: #b7c0cc;
    }

    .package-discount {
        position: relative;
        z-index: 1;
        min-width: 70px;
        padding: 9px 11px;
        border-radius: 10px;
        background: #edf3fb;
        color: #2E5B9C;
        text-align: center;
    }

    .package-discount strong {
        display: block;
        font-size: .95rem;
        line-height: 1.1;
        font-weight: 800;
    }

    .package-discount span {
        display: block;
        margin-top: 2px;
        color: #687587;
        font-size: .61rem;
        font-weight: 600;
    }


    /* =========================================================
       PURCHASE PROGRESS
    ========================================================== */

    .purchase-progress-wrapper {
        max-width: 700px;
    }

    .progress-label {
        color: #687587;
        font-size: .68rem;
        font-weight: 600;
    }

    .progress-percentage {
        color: #1A2B5C;
        font-size: .7rem;
        font-weight: 700;
    }

    .purchase-progress {
        height: 9px;
        overflow: hidden;
        border-radius: 50px;
        background: #edf0f6;
        box-shadow: inset 0 1px 3px rgba(0,0,0,.04);
    }

    .purchase-progress-bar {
        height: 100%;
        border-radius: 50px;
        background: linear-gradient(
            90deg,
            #1A2B5C 0%,
            #2E5B9C 100%
        );
        transition: width .5s ease;
    }

    .progress-message {
        font-size: .68rem;
    }

    .progress-success {
        color: #18794e;
        font-weight: 600;
    }

    .progress-warning {
        color: #8a6800;
        font-weight: 600;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
        overflow: hidden;
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
        font-size: .75rem;
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
       CART ITEMS
    ========================================================== */

    .cart-items-body {
        background: #fff;
    }

    .cart-item {
        padding: 22px;
        border-top: 1px solid #eef1f6;
        transition: background .2s ease;
    }

    .cart-item:first-child {
        border-top: none;
    }

    .cart-item:hover {
        background: #fafcff;
    }

    .cart-image-link {
        display: block;
        overflow: hidden;
        border-radius: 11px;
        background: #f5f7fb;
    }

    .cart-product-image {
        width: 100%;
        height: 145px;
        display: block;
        object-fit: cover;
        background: #f5f7fb;
        transition: transform .3s ease;
    }

    .cart-image-link:hover .cart-product-image {
        transform: scale(1.04);
    }


    /* =========================================================
       PRODUCT INFO
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
        font-size: .92rem;
        line-height: 1.45;
        font-weight: 700;
    }

    .product-title a {
        color: #1A2B5C;
        text-decoration: none;
    }

    .product-title a:hover {
        color: #2E5B9C;
    }

    .product-author {
        margin-bottom: 7px;
        color: #687587;
        font-size: .7rem;
    }

    .stock-info {
        color: #687587;
        font-size: .68rem;
    }

    .stock-info strong {
        color: #344054;
    }


    /* =========================================================
       QUANTITY
    ========================================================== */

    .field-label {
        display: block;
        margin-bottom: 7px;
        color: #687587;
        font-size: .68rem;
        font-weight: 600;
    }

    .quantity-control {
        display: flex;
        align-items: stretch;
    }

    .quantity-control .form-control {
        min-width: 0;
        min-height: 38px;
        border: 1px solid #dfe4ec;
        border-radius: 9px 0 0 9px;
        color: #344054;
        font-size: .76rem;
        box-shadow: none;
    }

    .quantity-control .form-control:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.07);
    }

    .quantity-update {
        width: 39px;
        flex-shrink: 0;
        border: 1px solid #d7e3f3;
        border-left: none;
        border-radius: 0 9px 9px 0;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .8rem;
        transition: all .2s ease;
    }

    .quantity-update:hover {
        background: #2E5B9C;
        color: #fff;
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
        font-size: .68rem;
        text-decoration: line-through;
    }

    .item-final-price {
        margin-top: 3px;
        color: #1A2B5C;
        font-size: .98rem;
        font-weight: 800;
    }

    .discount-info {
        margin-top: 4px;
        color: #18794e;
        font-size: .63rem;
        font-weight: 700;
    }

    .discount-pending {
        margin-top: 4px;
        color: #8a6800;
        font-size: .62rem;
        font-weight: 600;
    }

    .remove-form {
        margin-top: 7px;
    }

    .remove-button {
        padding: 0;
        border: none;
        background: transparent;
        color: #b42318;
        font-size: .67rem;
        font-weight: 600;
        transition: color .2s ease;
    }

    .remove-button:hover {
        color: #8e1b12;
        text-decoration: underline;
    }


    /* =========================================================
       CLEAR CART
    ========================================================== */

    .btn-clear-cart {
        min-height: 34px;
        padding: 7px 11px;
        border: 1px solid #f0caca;
        border-radius: 8px;
        background: #fdeaea;
        color: #b42318;
        font-size: .7rem;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-clear-cart:hover {
        background: #b42318;
        border-color: #b42318;
        color: #fff;
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
        font-size: .68rem;
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
       FINAL TOTAL
    ========================================================== */

    .final-total-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .final-total-row span {
        display: block;
        color: #1A2B5C;
        font-size: .78rem;
        font-weight: 700;
    }

    .final-total-row small {
        display: block;
        margin-top: 2px;
        color: #98a2b3;
        font-size: .62rem;
    }

    .final-total-row strong {
        color: #1A2B5C;
        font-size: 1.18rem;
        font-weight: 800;
        text-align: right;
    }


    /* =========================================================
       CHECKOUT BUTTON
    ========================================================== */

    .checkout-button {
        min-height: 47px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 14px;
        border: 1px solid #1A2B5C;
        border-radius: 10px;
        background: #1A2B5C;
        color: #fff;
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .checkout-button:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 7px 17px rgba(26,43,92,.16);
    }

    .checkout-disabled {
        border-color: #dfe4ec;
        background: #eef1f5;
        color: #98a2b3;
        cursor: not-allowed;
        opacity: 1;
    }

    .checkout-disabled:hover {
        transform: none;
        box-shadow: none;
        border-color: #dfe4ec;
        background: #eef1f5;
        color: #98a2b3;
    }

    .checkout-success {
        margin-top: 11px;
        color: #18794e;
        font-size: .66rem;
        font-weight: 600;
        text-align: center;
    }

    .checkout-warning {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 12px;
        padding: 12px;
        border: 1px solid #ffe8a1;
        border-radius: 10px;
        background: #fff8e6;
    }

    .warning-icon {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff0c2;
        color: #8a6800;
        font-size: .8rem;
    }

    .warning-title {
        margin-bottom: 2px;
        color: #6f5600;
        font-size: .7rem;
        font-weight: 700;
    }

    .checkout-warning small {
        color: #687587;
        font-size: .65rem;
        line-height: 1.5;
    }

    .checkout-warning small strong {
        color: #6f5600;
    }

    .checkout-note {
        margin-top: 13px;
        color: #98a2b3;
        font-size: .62rem;
        line-height: 1.5;
        text-align: center;
    }


    /* =========================================================
       INFORMATION CARD
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
        font-size: .72rem;
        font-weight: 700;
    }

    .information-item small {
        color: #687587;
        font-size: .64rem;
        line-height: 1.55;
    }


    /* =========================================================
       EMPTY CART
    ========================================================== */

    .empty-cart {
        padding: 65px 25px;
        text-align: center;
    }

    .empty-cart-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 30px;
    }

    .empty-cart h3 {
        margin-bottom: 8px;
        color: #1A2B5C;
        font-size: 1.15rem;
        font-weight: 700;
    }

    .empty-cart p {
        max-width: 510px;
        margin: 0 auto 22px;
        color: #687587;
        font-size: .8rem;
        line-height: 1.7;
    }

    .btn-primary-custom {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 15px;
        border: 1px solid #1A2B5C;
        border-radius: 9px;
        background: #1A2B5C;
        color: #fff;
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .btn-primary-custom:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(26,43,92,.15);
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

        .cart-page .page-header {
            padding: 23px 20px;
            border-radius: 17px;
        }

        .cart-page .page-header h2 {
            font-size: 1.25rem;
        }

        .header-action {
            width: 100%;
        }

        .package-card {
            padding: 17px;
        }

        .package-discount {
            display: none;
        }

        .cart-item {
            padding: 18px;
        }

        .cart-product-image {
            height: 125px;
        }

    }


    @media (max-width: 575px) {

        .cart-item {
            padding: 15px;
        }

        .cart-product-image {
            height: 115px;
        }

        .card-custom-header {
            padding: 18px;
        }

        .summary-body {
            padding: 18px;
        }

        .information-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        .item-final-price {
            font-size: .9rem;
        }

    }

</style>

@endpush

@endsection