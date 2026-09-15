@extends('layouts.cyber-master')

@section('title', 'Katalog Buku')

@section('content')

<div class="catalog-page container-fluid py-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="page-header mb-4">

        <div class="header-decoration"></div>

        <div class="position-relative d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="header-icon">
                        <i class="bi bi-book"></i>
                    </span>

                    <span class="header-label">
                        Katalog Reseller
                    </span>
                </div>

                <h2 class="mb-1">
                    Katalog Buku
                </h2>

                <p class="mb-0">
                    Temukan buku yang ingin Anda jual kembali.
                </p>
            </div>

            <a href="{{ route('reseller.cart.index') }}"
               class="header-cart-button">
                <i class="bi bi-cart3"></i>
                <span>Keranjang</span>
            </a>

        </div>
    </div>


    {{-- =========================================================
        INFORMATION PACKAGE
    ========================================================== --}}
    @php
        $reseller = auth()->user()->reseller;
        $package = $reseller?->package;
    @endphp

    <div class="package-card mb-4">

        <div class="package-icon">
            <i class="bi bi-box-seam"></i>
        </div>

        <div class="package-content">

            <div class="package-title">
                Paket {{ $package?->name ?? 'Reseller' }}
            </div>

            <div class="package-description">
                Anda mendapatkan diskon
                <strong>{{ $package?->discount_percentage ?? 0 }}%</strong>
                untuk pembelian reseller.
            </div>

        </div>

        <div class="package-discount">
            {{ $package?->discount_percentage ?? 0 }}%
            <small>Diskon</small>
        </div>

    </div>


    {{-- =========================================================
        SEARCH & FILTER
    ========================================================== --}}
    <div class="card-custom mb-4">

        <div class="card-custom-header">

            <div>
                <h5 class="mb-1">
                    <i class="bi bi-search me-2"></i>
                    Cari & Filter Buku
                </h5>

                <p class="mb-0">
                    Gunakan pencarian atau kategori untuk menemukan buku.
                </p>
            </div>

        </div>

        <div class="card-custom-body">

            <form action="{{ route('reseller.catalog.index') }}"
                  method="GET">

                <div class="row g-3">

                    {{-- Search --}}
                    <div class="col-md-7">

                        <label for="search"
                               class="form-label">
                            Cari Buku
                        </label>

                        <div class="search-input-wrapper">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="form-control"
                                placeholder="Cari judul, penulis, atau kategori..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    {{-- Category --}}
                    <div class="col-md-3">

                        <label for="category"
                               class="form-label">
                            Kategori
                        </label>

                        <select
                            name="category"
                            id="category"
                            class="form-select"
                        >

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category }}"
                                    @selected(request('category') === $category)
                                >
                                    {{ $category }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Button --}}
                    <div class="col-md-2 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn-primary-custom w-100"
                        >
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>

                    </div>

                </div>

            </form>


            @if(request('search') || request('category'))

                <div class="filter-reset">

                    <a href="{{ route('reseller.catalog.index') }}">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset pencarian dan filter
                    </a>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
        PRODUCT COUNT
    ========================================================== --}}
    <div class="catalog-toolbar mb-3">

        <div>
            <span class="text-muted">
                Menampilkan
            </span>

            <strong class="product-count">
                {{ $products->total() }}
            </strong>

            <span class="text-muted">
                buku
            </span>
        </div>

    </div>


    {{-- =========================================================
        PRODUCT LIST
    ========================================================== --}}
    @if($products->count() > 0)

        <div class="row g-4">

            @foreach($products as $product)

                @php

                    $discountPercentage =
                        $package?->discount_percentage ?? 0;

                    $discountAmount =
                        $product->price * ($discountPercentage / 100);

                    $resellerPrice =
                        $product->price - $discountAmount;

                @endphp


                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <div class="product-card h-100">

                        {{-- Cover --}}
                        <div class="product-cover">

                            <a href="{{ route('reseller.catalog.show', $product) }}"
                               class="product-image-link">

                                <img
                                    src="{{ $product->cover_url }}"
                                    alt="{{ $product->title }}"
                                >

                            </a>

                            @if($product->category)

                                <span class="category-badge">
                                    {{ $product->category }}
                                </span>

                            @endif

                        </div>


                        {{-- Product Body --}}
                        <div class="product-body d-flex flex-column">

                            {{-- Title --}}
                            <h5 class="product-title">

                                <a
                                    href="{{ route('reseller.catalog.show', $product) }}"
                                >
                                    {{ $product->title }}
                                </a>

                            </h5>


                            {{-- Author --}}
                            @if($product->author)

                                <p class="product-author">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $product->author }}
                                </p>

                            @endif


                            {{-- Price --}}
                            <div class="price-wrapper mt-auto">

                                <div class="normal-price-label">
                                    Harga normal
                                </div>

                                <div class="normal-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                                <div class="reseller-price-label">
                                    <i class="bi bi-tag-fill me-1"></i>
                                    Harga reseller
                                    ({{ $discountPercentage }}%)
                                </div>

                                <div class="reseller-price">
                                    Rp {{ number_format($resellerPrice, 0, ',', '.') }}
                                </div>

                            </div>


                            {{-- Stock --}}
                            <div class="stock-wrapper">

                                @if($product->stock <= 5)

                                    <span class="stock-low">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                        Stok tersisa {{ $product->stock }}
                                    </span>

                                @else

                                    <span class="stock-available">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Stok tersedia: {{ $product->stock }}
                                    </span>

                                @endif

                            </div>


                            {{-- Actions --}}
                            <div class="product-actions">

                                <a
                                    href="{{ route('reseller.catalog.show', $product) }}"
                                    class="btn-outline-custom"
                                >
                                    <i class="bi bi-eye me-1"></i>
                                    Lihat Detail
                                </a>


                                <form
                                    action="{{ route('reseller.cart.add', $product) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="quantity"
                                        value="1"
                                    >

                                    <button
                                        type="submit"
                                        class="btn-primary-custom w-100"
                                    >
                                        <i class="bi bi-cart-plus me-1"></i>
                                        Tambah ke Keranjang
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($products->hasPages())

            <div class="pagination-wrapper mt-5">

                {{ $products->links() }}

            </div>

        @endif

    @else

        {{-- =====================================================
            EMPTY STATE
        ====================================================== --}}
        <div class="card-custom">

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-book"></i>
                </div>

                <h4>
                    Buku tidak ditemukan
                </h4>

                <p>
                    Tidak ada buku yang sesuai dengan pencarian
                    atau kategori yang Anda pilih.
                </p>

                <a
                    href="{{ route('reseller.catalog.index') }}"
                    class="btn-primary-custom"
                >
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Tampilkan Semua Buku
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

    .catalog-page {
        padding-bottom: 40px;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .catalog-page .page-header {
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

    .catalog-page .page-header h2 {
        font-size: 1.45rem;
        font-weight: 700;
        color: #fff;
    }

    .catalog-page .page-header p {
        font-size: .9rem;
        color: rgba(255,255,255,.85);
    }

    .header-decoration {
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        right: -50px;
        top: -80px;
    }

    .header-label {
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: rgba(255,255,255,.72);
    }

    .header-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.16);
        font-size: .9rem;
    }


    /* =========================================================
       HEADER CART BUTTON
    ========================================================== */

    .header-cart-button {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 10px 18px;
        border-radius: 10px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25);
        color: #fff;
        text-decoration: none;
        font-size: .82rem;
        font-weight: 700;
        transition: all .25s ease;
    }

    .header-cart-button:hover {
        color: #1A2B5C;
        background: #fff;
        border-color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,.15);
    }


    /* =========================================================
       PACKAGE CARD
    ========================================================== */

    .package-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
        overflow: hidden;
    }

    .package-card::after {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: rgba(46,91,156,.035);
        right: -30px;
        top: -50px;
    }

    .package-icon {
        position: relative;
        z-index: 1;
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 21px;
    }

    .package-content {
        position: relative;
        z-index: 1;
        flex: 1;
    }

    .package-title {
        color: #1A2B5C;
        font-size: .95rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .package-description {
        color: #687587;
        font-size: .8rem;
    }

    .package-description strong {
        color: #2E5B9C;
    }

    .package-discount {
        position: relative;
        z-index: 1;
        min-width: 70px;
        padding: 9px 12px;
        border-radius: 10px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .95rem;
        font-weight: 800;
        text-align: center;
    }

    .package-discount small {
        display: block;
        font-size: .62rem;
        font-weight: 600;
        color: #687587;
        margin-top: 1px;
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

    .card-custom-body {
        padding: 22px;
    }


    /* =========================================================
       FORM
    ========================================================== */

    .catalog-page .form-label {
        color: #344054;
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .catalog-page .form-control,
    .catalog-page .form-select {
        min-height: 44px;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        color: #344054;
        font-size: .82rem;
        box-shadow: none;
        transition: all .2s ease;
    }

    .catalog-page .form-control:focus,
    .catalog-page .form-select:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.08);
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: .9rem;
        pointer-events: none;
        z-index: 2;
    }

    .search-input-wrapper .form-control {
        padding-left: 40px;
    }

    .filter-reset {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #eef1f6;
    }

    .filter-reset a {
        color: #2E5B9C;
        font-size: .78rem;
        font-weight: 600;
        text-decoration: none;
    }

    .filter-reset a:hover {
        color: #1A2B5C;
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

    .btn-outline-custom {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 14px;
        border: 1px solid #d7e3f3;
        border-radius: 9px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .25s ease;
    }

    .btn-outline-custom:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }


    /* =========================================================
       TOOLBAR
    ========================================================== */

    .catalog-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2px;
        font-size: .82rem;
    }

    .product-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        margin: 0 4px;
        padding: 5px 10px;
        border-radius: 20px;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: .72rem;
        font-weight: 700;
    }


    /* =========================================================
       PRODUCT CARD
    ========================================================== */

    .product-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
        overflow: hidden;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        border-color: #dbe4f1;
        box-shadow: 0 14px 30px rgba(26,43,92,.11);
    }


    /* =========================================================
       PRODUCT COVER
    ========================================================== */

    .product-cover {
        position: relative;
        height: 270px;
        overflow: hidden;
        background: #f5f7fb;
    }

    .product-image-link {
        display: block;
        width: 100%;
        height: 100%;
    }

    .product-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .35s ease;
    }

    .product-card:hover .product-cover img {
        transform: scale(1.04);
    }

    .category-badge {
        position: absolute;
        left: 12px;
        top: 12px;
        max-width: calc(100% - 24px);
        padding: 6px 10px;
        border-radius: 8px;
        background: rgba(255,255,255,.94);
        color: #2E5B9C;
        font-size: .65rem;
        font-weight: 700;
        box-shadow: 0 3px 10px rgba(26,43,92,.08);
    }


    /* =========================================================
       PRODUCT BODY
    ========================================================== */

    .product-body {
        padding: 17px;
    }

    .product-title {
        min-height: 45px;
        margin-bottom: 5px;
        font-size: .95rem;
        line-height: 1.45;
        font-weight: 700;
    }

    .product-title a {
        color: #1A2B5C;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-title a:hover {
        color: #2E5B9C;
    }

    .product-author {
        min-height: 20px;
        margin-bottom: 15px;
        color: #687587;
        font-size: .73rem;
    }


    /* =========================================================
       PRICE
    ========================================================== */

    .price-wrapper {
        padding-top: 12px;
        border-top: 1px solid #eef1f6;
    }

    .normal-price-label {
        color: #687587;
        font-size: .67rem;
        margin-bottom: 2px;
    }

    .normal-price {
        color: #98a2b3;
        font-size: .75rem;
        text-decoration: line-through;
    }

    .reseller-price-label {
        margin-top: 9px;
        color: #18794e;
        font-size: .68rem;
        font-weight: 700;
    }

    .reseller-price {
        margin-top: 2px;
        color: #1A2B5C;
        font-size: 1.18rem;
        line-height: 1.3;
        font-weight: 800;
    }


    /* =========================================================
       STOCK
    ========================================================== */

    .stock-wrapper {
        min-height: 27px;
        margin: 9px 0 12px;
    }

    .stock-low,
    .stock-available {
        font-size: .68rem;
        font-weight: 600;
    }

    .stock-low {
        color: #b42318;
    }

    .stock-available {
        color: #18794e;
    }


    /* =========================================================
       PRODUCT ACTIONS
    ========================================================== */

    .product-actions {
        display: grid;
        gap: 8px;
    }


    /* =========================================================
       PAGINATION
    ========================================================== */

    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }

    .pagination {
        gap: 5px;
    }

    .pagination .page-link {
        min-width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e3e8f0;
        border-radius: 8px !important;
        background: #fff;
        color: #1A2B5C;
        font-size: .75rem;
        font-weight: 600;
        box-shadow: none;
    }

    .pagination .page-link:hover {
        background: #edf3fb;
        border-color: #d7e3f3;
        color: #2E5B9C;
    }

    .pagination .active .page-link {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .empty-state {
        padding: 55px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 28px;
    }

    .empty-state h4 {
        color: #1A2B5C;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-state p {
        max-width: 500px;
        margin: 0 auto 20px;
        color: #687587;
        font-size: .82rem;
        line-height: 1.6;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 767.98px) {

        .catalog-page .page-header {
            padding: 23px 20px;
            border-radius: 17px;
        }

        .catalog-page .page-header h2 {
            font-size: 1.25rem;
        }

        .header-cart-button {
            width: 100%;
        }

        .package-card {
            align-items: flex-start;
        }

        .package-discount {
            display: none;
        }

        .card-custom-body {
            padding: 18px;
        }

    }


    @media (max-width: 575px) {

        .product-cover {
            height: 240px;
        }

        .product-body {
            padding: 14px;
        }

        .reseller-price {
            font-size: 1.05rem;
        }

    }

</style>

@endpush

@endsection