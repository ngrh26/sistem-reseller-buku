@extends('layouts.cyber-master')

@section('title', $product->title)

@section('content')

@php
    $reseller = auth()->user()->reseller;
    $package = $reseller?->package;

    $discountPercentage = $package?->discount_percentage ?? 0;

    $normalPrice = (float) $product->price;

    $resellerPrice = $normalPrice - (
        $normalPrice * ($discountPercentage / 100)
    );
@endphp


<div class="catalog-detail-page container-fluid py-4">


    {{-- =========================================================
        BREADCRUMB
    ========================================================== --}}
    <div class="breadcrumb-wrapper mb-4">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">

                    <a href="{{ route('reseller.dashboard') }}">
                        <i class="bi bi-house-door me-1"></i>
                        Dashboard
                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="{{ route('reseller.catalog.index') }}">
                        Katalog Buku
                    </a>

                </li>

                <li class="breadcrumb-item active"
                    aria-current="page">

                    Detail Produk

                </li>

            </ol>

        </nav>

    </div>


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="page-header mb-4">

        <div class="header-decoration"></div>

        <div class="position-relative">

            <div class="header-label">
                <i class="bi bi-book me-1"></i>
                Detail Katalog
            </div>

            <h2 class="mb-1">
                Detail Produk
            </h2>

            <p class="mb-0">
                Informasi lengkap buku dan harga khusus reseller.
            </p>

        </div>

    </div>


    {{-- =========================================================
        FLASH MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="custom-alert custom-alert-success mb-4">

            <div class="custom-alert-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div class="custom-alert-content">

                <strong>Berhasil!</strong>

                <div>
                    {{ session('success') }}
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        CART ERROR
    ========================================================== --}}
    @if($errors->has('cart'))

        <div class="custom-alert custom-alert-danger mb-4">

            <div class="custom-alert-icon">
                <i class="bi bi-exclamation-circle-fill"></i>
            </div>

            <div class="custom-alert-content">

                <strong>Perhatian!</strong>

                <div>
                    {{ $errors->first('cart') }}
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        PRODUCT DETAIL
    ========================================================== --}}
    <div class="row g-4">


        {{-- =====================================================
            PRODUCT IMAGE
        ====================================================== --}}
        <div class="col-lg-5">

            <div class="card-custom product-image-card h-100">

                <div class="product-image-container">

                    <img
                        src="{{ $product->cover_url }}"
                        alt="{{ $product->title }}"
                        class="product-detail-image"
                    >

                </div>

            </div>

        </div>


        {{-- =====================================================
            PRODUCT INFORMATION
        ====================================================== --}}
        <div class="col-lg-7">

            <div class="card-custom h-100">

                <div class="product-information">


                    {{-- Category --}}
                    @if($product->category)

                        <span class="category-detail-badge mb-3">
                            <i class="bi bi-bookmark-fill me-1"></i>
                            {{ $product->category }}
                        </span>

                    @endif


                    {{-- Title --}}
                    <h1 class="product-detail-title">
                        {{ $product->title }}
                    </h1>


                    {{-- Author --}}
                    @if($product->author)

                        <div class="product-author-detail">

                            <i class="bi bi-person-circle"></i>

                            <span>
                                {{ $product->author }}
                            </span>

                        </div>

                    @endif


                    {{-- =================================================
                        PRICE
                    ================================================== --}}
                    <div class="price-panel mt-4 mb-4">

                        <div class="price-label">
                            Harga normal
                        </div>

                        <div class="normal-price-detail">
                            Rp {{ number_format($normalPrice, 0, ',', '.') }}
                        </div>

                        <div class="reseller-label">
                            <i class="bi bi-tag-fill me-1"></i>
                            Harga reseller
                        </div>

                        <div class="reseller-price-large">
                            Rp {{ number_format($resellerPrice, 0, ',', '.') }}
                        </div>


                        @if($discountPercentage > 0)

                            <div class="discount-row mt-3">

                                <span class="discount-badge">
                                    Diskon {{ $discountPercentage }}%
                                </span>

                                <span class="package-note">
                                    Harga khusus paket
                                    <strong>
                                        {{ $package?->name ?? 'Reseller' }}
                                    </strong>
                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                        STOCK
                    ================================================== --}}
                    <div class="stock-panel mb-4">

                        @if($product->stock > 10)

                            <div class="stock-status stock-status-available">

                                <div class="stock-status-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>

                                <div>
                                    <strong>Stok tersedia</strong>

                                    <small>
                                        Tersedia
                                        <strong>
                                            {{ $product->stock }}
                                        </strong>
                                        buku
                                    </small>
                                </div>

                            </div>

                        @elseif($product->stock > 0)

                            <div class="stock-status stock-status-warning">

                                <div class="stock-status-icon">
                                    <i class="bi bi-exclamation-lg"></i>
                                </div>

                                <div>
                                    <strong>Stok terbatas</strong>

                                    <small>
                                        Tersisa
                                        <strong>
                                            {{ $product->stock }}
                                        </strong>
                                        buku
                                    </small>
                                </div>

                            </div>

                        @else

                            <div class="stock-status stock-status-empty">

                                <div class="stock-status-icon">
                                    <i class="bi bi-x-lg"></i>
                                </div>

                                <div>
                                    <strong>Produk tidak tersedia</strong>

                                    <small>
                                        Buku sedang tidak dapat dipesan.
                                    </small>
                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                        DESCRIPTION
                    ================================================== --}}
                    @if($product->description)

                        <div class="product-description mb-4">

                            <div class="section-title">
                                <i class="bi bi-file-text me-2"></i>
                                Deskripsi Buku
                            </div>

                            <div class="description-text">
                                {!! nl2br(e($product->description)) !!}
                            </div>

                        </div>

                    @endif


                    <hr class="detail-divider">


                    {{-- =================================================
                        ADD TO CART
                    ================================================== --}}
                    @if($product->stock > 0)

                        <form
                            action="{{ route('reseller.cart.add', $product) }}"
                            method="POST"
                        >

                            @csrf

                            <div class="row g-3 align-items-end">

                                <div class="col-sm-4">

                                    <label
                                        for="quantity"
                                        class="form-label"
                                    >
                                        Jumlah
                                    </label>

                                    <div class="quantity-wrapper">

                                        <input
                                            type="number"
                                            id="quantity"
                                            name="quantity"
                                            value="1"
                                            min="1"
                                            max="{{ $product->stock }}"
                                            class="form-control"
                                            required
                                        >

                                        <span>
                                            buku
                                        </span>

                                    </div>

                                </div>


                                <div class="col-sm-8">

                                    <button
                                        type="submit"
                                        class="btn-primary-custom btn-lg-custom w-100"
                                    >
                                        <i class="bi bi-cart-plus me-2"></i>
                                        Tambahkan ke Keranjang
                                    </button>

                                </div>

                            </div>

                        </form>


                        <div class="detail-actions mt-3">

                            <a
                                href="{{ route('reseller.cart.index') }}"
                                class="btn-outline-custom"
                            >
                                <i class="bi bi-cart3 me-1"></i>
                                Lihat Keranjang
                            </a>

                            <a
                                href="{{ route('reseller.catalog.index') }}"
                                class="btn-secondary-custom"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali ke Katalog
                            </a>

                        </div>

                    @else

                        <div class="unavailable-alert">

                            <i class="bi bi-info-circle-fill"></i>

                            <div>
                                <strong>Produk tidak tersedia</strong>

                                <small>
                                    Produk ini sedang tidak tersedia
                                    untuk dipesan.
                                </small>
                            </div>

                        </div>

                        <div class="mt-3">

                            <a
                                href="{{ route('reseller.catalog.index') }}"
                                class="btn-outline-custom"
                            >
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali ke Katalog
                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        RESELLER INFORMATION
    ========================================================== --}}
    <div class="card-custom mt-4">

        <div class="card-custom-header">

            <h5 class="mb-1">
                Informasi Pembelian Reseller
            </h5>

            <p class="mb-0">
                Informasi penting sebelum melakukan pemesanan.
            </p>

        </div>

        <div class="information-grid">


            {{-- Harga --}}
            <div class="information-item">

                <div class="information-icon">
                    <i class="bi bi-tag"></i>
                </div>

                <div>
                    <div class="information-title">
                        Harga Reseller
                    </div>

                    <small>
                        Harga otomatis menyesuaikan paket Anda.
                    </small>
                </div>

            </div>


            {{-- Stok --}}
            <div class="information-item">

                <div class="information-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>
                    <div class="information-title">
                        Stok Terupdate
                    </div>

                    <small>
                        Jumlah pembelian mengikuti stok yang tersedia.
                    </small>
                </div>

            </div>


            {{-- Transaksi --}}
            <div class="information-item">

                <div class="information-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>
                    <div class="information-title">
                        Transaksi Aman
                    </div>

                    <small>
                        Pembayaran akan diverifikasi oleh admin.
                    </small>
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

    .catalog-detail-page {
        padding-bottom: 40px;
    }


    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .breadcrumb-wrapper {
        padding: 0 2px;
    }

    .breadcrumb {
        font-size: .75rem;
    }

    .breadcrumb-item a {
        color: #687587;
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        color: #2E5B9C;
    }

    .breadcrumb-item.active {
        color: #1A2B5C;
        font-weight: 600;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: #b7c0cc;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .catalog-detail-page .page-header {
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

    .catalog-detail-page .page-header h2 {
        color: #fff;
        font-size: 1.45rem;
        font-weight: 700;
    }

    .catalog-detail-page .page-header p {
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
        position: relative;
        z-index: 1;
        margin-bottom: 7px;
        color: rgba(255,255,255,.72);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }


    /* =========================================================
       CUSTOM CARD
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
        font-size: .78rem;
    }


    /* =========================================================
       ALERT
    ========================================================== */

    .custom-alert {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        position: relative;
        padding: 15px 45px 15px 16px;
        border-radius: 12px;
        border: 1px solid;
        font-size: .8rem;
    }

    .custom-alert-success {
        background: #e8f7ee;
        border-color: #c9ebd8;
        color: #18794e;
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

    .custom-alert .btn-close {
        position: absolute;
        right: 14px;
        top: 15px;
    }


    /* =========================================================
       PRODUCT IMAGE
    ========================================================== */

    .product-image-card {
        padding: 16px;
    }

    .product-image-container {
        width: 100%;
        min-height: 540px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fb;
        border-radius: 13px;
        overflow: hidden;
    }

    .product-detail-image {
        width: 100%;
        max-height: 540px;
        object-fit: contain;
        display: block;
        transition: transform .3s ease;
    }

    .product-detail-image:hover {
        transform: scale(1.02);
    }


    /* =========================================================
       PRODUCT INFORMATION
    ========================================================== */

    .product-information {
        padding: 27px 28px;
    }

    .category-detail-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 8px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .67rem;
        font-weight: 700;
    }

    .product-detail-title {
        margin: 0;
        color: #1A2B5C;
        font-size: 1.9rem;
        line-height: 1.28;
        font-weight: 800;
    }

    .product-author-detail {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 10px;
        color: #687587;
        font-size: .8rem;
    }

    .product-author-detail i {
        color: #2E5B9C;
        font-size: .9rem;
    }


    /* =========================================================
       PRICE PANEL
    ========================================================== */

    .price-panel {
        padding: 20px;
        background: #f8faff;
        border: 1px solid #edf1f6;
        border-radius: 14px;
    }

    .price-label {
        color: #687587;
        font-size: .7rem;
        margin-bottom: 2px;
    }

    .normal-price-detail {
        color: #98a2b3;
        font-size: .88rem;
        text-decoration: line-through;
    }

    .reseller-label {
        margin-top: 10px;
        color: #18794e;
        font-size: .7rem;
        font-weight: 700;
    }

    .reseller-price-large {
        color: #1A2B5C;
        font-size: 1.75rem;
        line-height: 1.25;
        font-weight: 800;
    }

    .discount-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
    }

    .discount-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 9px;
        border-radius: 8px;
        background: #e8f7ee;
        color: #18794e;
        font-size: .67rem;
        font-weight: 700;
    }

    .package-note {
        color: #687587;
        font-size: .7rem;
    }

    .package-note strong {
        color: #1A2B5C;
    }


    /* =========================================================
       STOCK
    ========================================================== */

    .stock-panel {
        padding: 14px 15px;
        border: 1px solid #e9edf5;
        border-radius: 12px;
        background: #fff;
    }

    .stock-status {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .stock-status-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 16px;
    }

    .stock-status strong {
        display: block;
        font-size: .78rem;
        font-weight: 700;
    }

    .stock-status small {
        display: block;
        margin-top: 2px;
        font-size: .68rem;
    }

    .stock-status-available {
        color: #18794e;
    }

    .stock-status-available .stock-status-icon {
        background: #e8f7ee;
    }

    .stock-status-warning {
        color: #8a6800;
    }

    .stock-status-warning .stock-status-icon {
        background: #fff4d6;
    }

    .stock-status-empty {
        color: #b42318;
    }

    .stock-status-empty .stock-status-icon {
        background: #fdeaea;
    }


    /* =========================================================
       DESCRIPTION
    ========================================================== */

    .section-title {
        margin-bottom: 12px;
        color: #1A2B5C;
        font-size: .9rem;
        font-weight: 700;
    }

    .section-title i {
        color: #2E5B9C;
    }

    .description-text {
        color: #687587;
        font-size: .8rem;
        line-height: 1.8;
    }

    .detail-divider {
        margin: 22px 0;
        border-color: #eef1f6;
        opacity: 1;
    }


    /* =========================================================
       FORM
    ========================================================== */

    .catalog-detail-page .form-label {
        margin-bottom: 7px;
        color: #344054;
        font-size: .78rem;
        font-weight: 600;
    }

    .catalog-detail-page .form-control {
        min-height: 46px;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        color: #344054;
        box-shadow: none;
        transition: all .2s ease;
    }

    .catalog-detail-page .form-control:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.08);
    }

    .quantity-wrapper {
        position: relative;
    }

    .quantity-wrapper .form-control {
        padding-right: 48px;
    }

    .quantity-wrapper span {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: .7rem;
        pointer-events: none;
    }


    /* =========================================================
       BUTTONS
    ========================================================== */

    .btn-primary-custom {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 14px;
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

    .btn-lg-custom {
        min-height: 46px;
        font-size: .82rem;
    }

    .btn-outline-custom {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 13px;
        border: 1px solid #d7e3f3;
        border-radius: 9px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .76rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .btn-outline-custom:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }

    .btn-secondary-custom {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 13px;
        border: 1px solid #e1e5eb;
        border-radius: 9px;
        background: #fff;
        color: #526071;
        font-size: .76rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .btn-secondary-custom:hover {
        background: #f8faff;
        border-color: #cfd7e2;
        color: #1A2B5C;
    }

    .detail-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }


    /* =========================================================
       UNAVAILABLE
    ========================================================== */

    .unavailable-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px;
        border: 1px solid #e1e5eb;
        border-radius: 11px;
        background: #f8f9fb;
        color: #526071;
    }

    .unavailable-alert > i {
        color: #687587;
        font-size: 16px;
        margin-top: 2px;
    }

    .unavailable-alert strong {
        display: block;
        color: #344054;
        font-size: .78rem;
        margin-bottom: 2px;
    }

    .unavailable-alert small {
        display: block;
        color: #687587;
        font-size: .68rem;
    }


    /* =========================================================
       INFORMATION GRID
    ========================================================== */

    .information-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
    }

    .information-item {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 21px 22px;
    }

    .information-item + .information-item {
        border-left: 1px solid #eef1f6;
    }

    .information-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 17px;
    }

    .information-title {
        margin-bottom: 3px;
        color: #1A2B5C;
        font-size: .78rem;
        font-weight: 700;
    }

    .information-item small {
        color: #687587;
        font-size: .68rem;
        line-height: 1.55;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 991.98px) {

        .product-image-container {
            min-height: 430px;
        }

        .product-detail-image {
            max-height: 430px;
        }

        .information-grid {
            grid-template-columns: 1fr;
        }

        .information-item + .information-item {
            border-left: none;
            border-top: 1px solid #eef1f6;
        }

    }


    @media (max-width: 767.98px) {

        .catalog-detail-page .page-header {
            padding: 23px 20px;
            border-radius: 17px;
        }

        .catalog-detail-page .page-header h2 {
            font-size: 1.25rem;
        }

        .product-information {
            padding: 22px 20px;
        }

        .product-detail-title {
            font-size: 1.55rem;
        }

        .product-image-container {
            min-height: 350px;
        }

        .product-detail-image {
            max-height: 350px;
        }

        .reseller-price-large {
            font-size: 1.5rem;
        }

    }


    @media (max-width: 575px) {

        .product-image-card {
            padding: 11px;
        }

        .product-image-container {
            min-height: 300px;
        }

        .product-detail-image {
            max-height: 300px;
        }

        .discount-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-actions {
            flex-direction: column;
        }

        .detail-actions a {
            width: 100%;
        }

    }

</style>

@endpush

@endsection