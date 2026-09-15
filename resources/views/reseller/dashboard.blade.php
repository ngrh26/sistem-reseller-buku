@extends('layouts.cyber-master')

@section('title', 'Dashboard Reseller')

@push('styles')
<style>
    /* =========================================================
       DASHBOARD RESELLER
       STANDARD ADMIN / RESELLER DESIGN SYSTEM
       ========================================================= */

    .dashboard-page {
        padding-bottom: 40px;
    }

    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .page-header {
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
        margin-bottom: 24px;
    }

    .page-header::after {
        content: '';
        position: absolute;
        width: 210px;
        height: 210px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -65px;
        top: -90px;
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .page-header h2 {
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 5px;
    }

    .page-header p {
        margin: 0;
        opacity: .85;
        font-size: .9rem;
    }

    /* =========================================================
       HEADER ACTIONS
    ========================================================= */

    .header-actions {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 8px;
        width: 185px;
    }

    .profile-action,
    .shopping-action {
        width: 100%;
        min-height: 42px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        font-size: .78rem;
        font-weight: 600;
        transition: all .2s ease;
    }

    .profile-action {
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.22);
        color: #fff;
    }

    .profile-action i {
        font-size: 16px;
    }

    .profile-action:hover {
        background: #fff;
        border-color: #fff;
        color: #1A2B5C;
        transform: translateY(-2px);
    }

    .shopping-action {
        background: #fff;
        border: 1px solid #fff;
        color: #1A2B5C;
    }

    .shopping-action:hover {
        background: #edf3fb;
        border-color: #edf3fb;
        color: #1A2B5C;
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(0,0,0,.12);
    }

    /* =========================================================
       CARD CUSTOM
    ========================================================= */

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    /* =========================================================
       STAT CARD
    ========================================================= */

    .stat-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        padding: 22px;
        height: 100%;
        transition: all .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(26, 43, 92, .09);
    }

    .stat-content {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .stat-label {
        display: block;
        color: #687587;
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .stat-value {
        color: #1A2B5C;
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 0;
        word-break: break-word;
    }

    .stat-subtitle {
        display: block;
        color: #8a94a3;
        font-size: .72rem;
        margin-top: 4px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .stat-icon.blue {
        background: #edf3fb;
        color: #2E5B9C;
    }

    .stat-icon.green {
        background: #e8f7ee;
        color: #18794e;
    }

    .stat-icon.gold {
        background: #fff4d6;
        color: #8a6800;
    }

    .stat-icon.red {
        background: #fdeaea;
        color: #b42318;
    }

    /* =========================================================
       PACKAGE BADGE
    ========================================================= */

    .package-badge {
        display: inline-flex;
        align-items: center;
        background: #edf3fb;
        color: #2E5B9C;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: .68rem;
        font-weight: 700;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .section-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e9edf5;
    }

    .section-header h5 {
        color: #1A2B5C;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .section-header p {
        color: #8a94a3;
        font-size: .76rem;
        margin: 0;
    }

    .section-body {
        padding: 22px;
    }

    /* =========================================================
       PROGRESS PAKET
    ========================================================= */

    .progress-wrapper {
        position: relative;
        padding-top: 4px;
    }

    .progress-modern {
        height: 14px;
        border-radius: 50px;
        background: #edf0f6;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, .05);
    }

    .progress-modern .progress-bar {
        height: 100%;
        border-radius: 50px;
        background: linear-gradient(
            90deg,
            #1A2B5C 0%,
            #2E5B9C 100%
        );
        position: relative;
        width: 0;
        transition: width 1.5s cubic-bezier(
            0.22,
            1,
            0.36,
            1
        );
        overflow: hidden;
    }

    .progress-modern .progress-bar::after {
        content: "";
        position: absolute;
        top: 0;
        left: -50%;
        width: 50%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, .35),
            transparent
        );
        animation: progressShine 2s infinite;
    }

    @keyframes progressShine {

        0% {
            left: -50%;
        }

        100% {
            left: 120%;
        }

    }

    .progress-percentage {
        font-size: .8rem;
        font-weight: 700;
        color: #1A2B5C;
    }

    .progress-count {
        font-size: .82rem;
        font-weight: 600;
        color: #344054;
    }

    .progress-target {
        font-size: .76rem;
        color: #687587;
    }

    .target-badge {
        display: inline-flex;
        align-items: center;
        background: #edf3fb;
        color: #2E5B9C;
        border-radius: 20px;
        padding: 7px 11px;
        font-size: .7rem;
        font-weight: 700;
    }

    .highest-package-badge {
        display: inline-flex;
        align-items: center;
        background: #fff4d6;
        color: #8a6800;
        border-radius: 20px;
        padding: 7px 11px;
        font-size: .7rem;
        font-weight: 700;
    }

    .progress-message {
        background: #f8faff;
        border: 1px solid #e7edf6;
        border-radius: 11px;
        padding: 13px;
        color: #526071;
        font-size: .76rem;
        line-height: 1.5;
    }

    .progress-success {
        background: #e8f7ee;
        border: 1px solid #cce9d6;
        border-radius: 11px;
        padding: 13px;
        color: #18794e;
        font-size: .76rem;
        line-height: 1.5;
    }

    /* =========================================================
       PACKAGE INFORMATION
    ========================================================= */

    .package-info-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 1.15rem;
    }

    .package-info-item {
        background: #f8faff;
        border: 1px solid #e7edf6;
        border-radius: 11px;
        padding: 14px;
        height: 100%;
    }

    .package-info-label {
        display: block;
        color: #8993a2;
        font-size: .72rem;
        margin-bottom: 5px;
    }

    .package-info-value {
        color: #344054;
        font-size: .9rem;
        font-weight: 700;
    }

    .package-info-value.blue {
        color: #2E5B9C;
    }

    /* =========================================================
       PRODUCT CARD
    ========================================================= */

    .product-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 14px;
        overflow: hidden;
        transition: all .25s ease;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(26, 43, 92, .10);
    }

    .product-image-wrapper {
        padding: 12px;
        text-align: center;
    }

    .product-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 9px;
        background: #edf3fb;
        transition: transform .3s ease;
    }

    .product-card:hover img {
        transform: scale(1.03);
    }

    .product-body {
        padding: 0 13px 15px;
    }

    .product-title {
        color: #344054;
        font-size: .82rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .product-author {
        color: #8a94a3;
        font-size: .7rem;
        margin-bottom: 8px;
    }

    .product-price {
        color: #1A2B5C;
        font-size: .8rem;
        font-weight: 700;
    }

    /* =========================================================
       QUICK MENU
    ========================================================= */

    .quick-menu-card {
        border: 1px solid #e9edf5;
        background: #fff;
        border-radius: 14px;
        text-decoration: none;
        color: #1A2B5C;
        display: block;
        padding: 18px;
        height: 100%;
        transition: all .25s ease;
    }

    .quick-menu-card:hover {
        color: #1A2B5C;
        border-color: #cbd9eb;
        background: #fafcff;
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(26, 43, 92, .10);
    }

    .quick-menu-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dce6f3;
        background: #edf3fb;
        color: #2E5B9C;
        font-size: 1.2rem;
        margin-bottom: 13px;
        transition: all .25s ease;
    }

    .quick-menu-card:hover .quick-menu-icon {
        background: #1A2B5C;
        color: #fff;
        border-color: #1A2B5C;
    }

    .quick-menu-card h6 {
        color: #344054;
        font-size: .84rem;
    }

    .quick-menu-card p {
        color: #8a94a3;
        font-size: .74rem;
    }

    .quick-menu-arrow {
        color: #2E5B9C;
        font-size: .9rem;
        opacity: .45;
        transition: all .25s ease;
    }

    .quick-menu-card:hover .quick-menu-arrow {
        opacity: 1;
        transform: translate(3px, -3px);
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        text-align: center;
        padding: 45px 20px;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        margin-bottom: 14px;
    }

    .empty-state h5 {
        color: #344054;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .empty-state p {
        color: #8a94a3;
        font-size: .8rem;
        margin: 0;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .header-actions {
            width: 100%;
        }

        .profile-action,
        .shopping-action {
            width: 100%;
        }

        .stat-card {
            padding: 18px;
        }

        .stat-value {
            font-size: 1.15rem;
        }

        .section-body {
            padding: 18px;
        }

        .section-header {
            padding: 16px 18px;
        }

        .product-card img {
            height: 160px;
        }

        .quick-menu-card {
            padding: 16px;
        }

    }
</style>
@endpush

@section('content')

<div class="container-fluid py-4 dashboard-page">

    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="page-header">

        <div class="page-header-content">

            <div class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-md-center
                        gap-4">

                <div>

                    <h2>
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard Reseller
                    </h2>

                    <p>
                        Selamat datang kembali, {{ $user->name }}.
                    </p>

                </div>

                <div class="header-actions">

                    {{-- Profil --}}
                    <a
                        href="{{ route('reseller.profile.index') }}"
                        class="profile-action"
                    >
                        <i class="bi bi-person-circle"></i>
                        <span>Profil Saya</span>
                    </a>

                    {{-- Mulai Belanja --}}
                    <a
                        href="{{ route('reseller.catalog.index') }}"
                        class="shopping-action"
                    >
                        <i class="bi bi-bag-plus"></i>
                        <span>Mulai Belanja</span>
                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         STATISTICS
    ========================================================= --}}

    <div class="row g-4 mb-4">

        {{-- Paket --}}
        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Paket Reseller
                        </span>

                        <h3 class="stat-value">
                            {{ $package?->name ?? 'Belum Ada' }}
                        </h3>

                        <span class="package-badge mt-2">
                            {{ $package?->discount_percentage ?? 0 }}% Diskon
                        </span>

                    </div>

                    <div class="stat-icon blue">
                        <i class="bi bi-box-seam"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Total Buku --}}
        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Total Buku
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($totalBuku, 0, ',', '.') }}
                        </h3>

                        <span class="stat-subtitle">
                            Buku terverifikasi
                        </span>

                    </div>

                    <div class="stat-icon green">
                        <i class="bi bi-book"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Total Pesanan --}}
        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Total Pesanan
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($totalPesanan, 0, ',', '.') }}
                        </h3>

                        <span class="stat-subtitle">
                            Semua pesanan
                        </span>

                    </div>

                    <div class="stat-icon gold">
                        <i class="bi bi-cart-check"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Total Belanja --}}
        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Total Belanja
                        </span>

                        <h3 class="stat-value">
                            Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                        </h3>

                        <span class="stat-subtitle">
                            Transaksi terverifikasi
                        </span>

                    </div>

                    <div class="stat-icon blue">
                        <i class="bi bi-wallet2"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         STATUS PESANAN
    ========================================================= --}}

    <div class="row g-4 mb-4">

        {{-- Menunggu --}}
        <div class="col-md-4">

            <div class="stat-card">

                <div class="d-flex align-items-center">

                    <div class="stat-icon gold me-3">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <div>

                        <span class="stat-label">
                            Pesanan Menunggu
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($pesananPending, 0, ',', '.') }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>


        {{-- Selesai --}}
        <div class="col-md-4">

            <div class="stat-card">

                <div class="d-flex align-items-center">

                    <div class="stat-icon green me-3">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <div>

                        <span class="stat-label">
                            Pesanan Selesai
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($pesananSelesai, 0, ',', '.') }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>


        {{-- Diskon --}}
        <div class="col-md-4">

            <div class="stat-card">

                <div class="d-flex align-items-center">

                    <div class="stat-icon blue me-3">
                        <i class="bi bi-percent"></i>
                    </div>

                    <div>

                        <span class="stat-label">
                            Diskon Anda
                        </span>

                        <h3 class="stat-value">
                            {{ $package?->discount_percentage ?? 0 }}%
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PROGRESS PAKET
    ========================================================= --}}

    <div class="card-custom mb-4">

        <div class="section-body">

            <div class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-md-center
                        gap-3 mb-4">

                <div>

                    <div class="d-flex align-items-center gap-2 mb-1">

                        <h5 class="mb-0"
                            style="color:#1A2B5C;font-size:1rem;font-weight:700;">

                            Progress Paket Reseller

                        </h5>

                        <i
                            class="bi bi-info-circle text-muted"
                            data-bs-toggle="tooltip"
                            title="Progress dihitung berdasarkan total buku dari transaksi yang pembayarannya telah diverifikasi."
                        ></i>

                    </div>

                    <p class="text-muted mb-0"
                       style="font-size:.76rem;">

                        Kumpulkan pembelian untuk membuka paket berikutnya.

                    </p>

                </div>


                @if($nextPackage)

                    <div class="text-md-end">

                        <span class="target-badge">

                            <i class="bi bi-flag me-1"></i>

                            Target
                            {{ number_format($progressTarget) }}
                            Buku

                        </span>

                    </div>

                @else

                    <span class="highest-package-badge">

                        <i class="bi bi-trophy-fill me-1"></i>

                        Paket Tertinggi

                    </span>

                @endif

            </div>


            @if($nextPackage)

                {{-- Progress Label --}}
                <div class="d-flex justify-content-between
                            align-items-center mb-2">

                    <span class="progress-count">

                        {{ number_format($totalBuku) }}

                        <span class="fw-normal text-muted">
                            /
                            {{ number_format($progressTarget) }}
                            buku
                        </span>

                    </span>

                    <span class="progress-percentage">

                        {{ number_format($progressPercentage, 0) }}%

                    </span>

                </div>


                {{-- Progress Bar --}}
                <div class="progress-wrapper">

                    <div class="progress-modern">

                        <div
                            class="progress-bar"
                            id="packageProgressBar"
                            role="progressbar"
                            data-progress="{{ $progressPercentage }}"
                            aria-valuenow="{{ $progressPercentage }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        ></div>

                    </div>

                </div>


                {{-- Package Info --}}
                <div class="d-flex justify-content-between
                            align-items-center mt-3">

                    <div>

                        <small class="text-muted">
                            Paket saat ini:
                        </small>

                        <strong class="ms-1"
                                style="color:#344054;font-size:.8rem;">

                            {{ $package?->name ?? 'Starter' }}

                        </strong>

                    </div>


                    <div class="text-end">

                        <small class="text-muted">
                            Target berikutnya:
                        </small>

                        <strong class="ms-1"
                                style="color:#344054;font-size:.8rem;">

                            {{ $nextPackage['name'] }}

                        </strong>

                    </div>

                </div>


                {{-- Progress Message --}}
                <div class="mt-3">

                    @if($sisaBuku > 0)

                        <div class="progress-message">

                            <div class="d-flex align-items-start">

                                <i
                                    class="bi bi-graph-up-arrow me-2 mt-1"
                                    style="color:#2E5B9C;"
                                ></i>

                                <div>

                                    <strong style="color:#344054;">

                                        Tinggal
                                        {{ number_format($sisaBuku) }}
                                        buku lagi.

                                    </strong>

                                    <div class="mt-1">

                                        Capai
                                        <strong>
                                            {{ $nextPackage['name'] }}
                                        </strong>
                                        untuk mendapatkan keuntungan paket
                                        yang lebih besar.

                                    </div>

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="progress-success">

                            <i class="bi bi-check-circle-fill me-1"></i>

                            Target paket
                            <strong>
                                {{ $nextPackage['name'] }}
                            </strong>
                            telah tercapai.
                            Paket akan diperbarui setelah transaksi
                            diverifikasi admin.

                        </div>

                    @endif

                </div>

            @else

                {{-- Distributor --}}
                <div class="text-center py-3">

                    <div class="stat-icon gold mx-auto mb-3">

                        <i class="bi bi-trophy-fill"></i>

                    </div>

                    <h5 style="color:#344054;font-weight:700;font-size:1rem;">

                        Anda telah mencapai Paket Distributor

                    </h5>

                    <p class="text-muted mb-0"
                       style="font-size:.8rem;">

                        Selamat! Anda telah mencapai paket reseller
                        tertinggi dengan keuntungan maksimal.

                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
         INFORMASI PAKET
    ========================================================= --}}

    <div class="card-custom mb-4">

        <div class="section-body">

            <div class="d-flex align-items-center mb-4">

                <div class="package-info-icon me-3">

                    <i class="bi bi-stars"></i>

                </div>

                <div>

                    <h5
                        style="color:#1A2B5C;font-size:1rem;font-weight:700;margin-bottom:3px;"
                    >
                        Paket Anda
                    </h5>

                    <small style="color:#8a94a3;font-size:.76rem;">
                        Informasi keuntungan reseller Anda.
                    </small>

                </div>

            </div>


            <div class="row g-3">

                {{-- Paket --}}
                <div class="col-md-4">

                    <div class="package-info-item">

                        <span class="package-info-label">
                            Paket Saat Ini
                        </span>

                        <span class="package-info-value">
                            {{ $package?->name ?? 'Belum Ada' }}
                        </span>

                    </div>

                </div>


                {{-- Diskon --}}
                <div class="col-md-4">

                    <div class="package-info-item">

                        <span class="package-info-label">
                            Diskon
                        </span>

                        <span class="package-info-value blue">
                            {{ $package?->discount_percentage ?? 0 }}%
                        </span>

                    </div>

                </div>


                {{-- Minimum --}}
                <div class="col-md-4">

                    <div class="package-info-item">

                        <span class="package-info-label">
                            Minimum Pembelian
                        </span>

                        <span class="package-info-value">

                            {{ $package?->min_purchase ?? 0 }}

                            <small style="color:#8a94a3;font-size:.75rem;font-weight:500;">
                                buku
                            </small>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PRODUK TERBARU
    ========================================================= --}}

    <div class="card-custom mb-4">

        <div class="section-header">

            <div class="d-flex justify-content-between
                        align-items-center
                        gap-3">

                <div>

                    <h5>
                        <i class="bi bi-book me-2"></i>
                        Produk Terbaru
                    </h5>

                    <p>
                        Buku terbaru yang tersedia di katalog.
                    </p>

                </div>

                <a
                    href="{{ route('reseller.catalog.index') }}"
                    class="btn-view-all"
                    style="
                        display:inline-flex;
                        align-items:center;
                        justify-content:center;
                        background:#edf3fb;
                        border:1px solid #d7e3f3;
                        color:#2E5B9C;
                        border-radius:8px;
                        padding:7px 11px;
                        font-size:.72rem;
                        font-weight:600;
                        text-decoration:none;
                        white-space:nowrap;
                    "
                >
                    <i class="bi bi-arrow-right me-1"></i>
                    Lihat Katalog
                </a>

            </div>

        </div>


        <div class="section-body">

            <div class="row g-3">

                @forelse($produkTerbaru as $product)

                    <div class="col-6 col-md-4 col-lg-3">

                        <a
                            href="{{ route('reseller.catalog.show', $product) }}"
                            class="text-decoration-none"
                        >

                            <div class="product-card">

                                <div class="product-image-wrapper">

                                    <img
                                        src="{{ $product->cover_url }}"
                                        alt="{{ $product->title }}"
                                    >

                                </div>

                                <div class="product-body">

                                    <div class="product-title text-truncate">

                                        {{ $product->title }}

                                    </div>

                                    <div class="product-author text-truncate">

                                        {{ $product->author }}

                                    </div>

                                    <div class="product-price">

                                        Rp
                                        {{ number_format($product->price, 0, ',', '.') }}

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-state">

                            <div class="empty-icon">

                                <i class="bi bi-book"></i>

                            </div>

                            <h5>
                                Belum Ada Produk
                            </h5>

                            <p>
                                Belum ada produk tersedia di katalog.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================================================
         QUICK MENU
    ========================================================= --}}

    <div class="card-custom">

        <div class="section-body">

            <div class="mb-4">

                <h5
                    style="color:#1A2B5C;font-size:1rem;font-weight:700;margin-bottom:3px;"
                >
                    <i class="bi bi-grid me-2"></i>
                    Menu Reseller
                </h5>

                <p
                    style="color:#8a94a3;font-size:.76rem;margin:0;"
                >
                    Akses cepat ke aktivitas utama reseller.
                </p>

            </div>


            <div class="row g-3">

                {{-- Katalog --}}
                <div class="col-md-4">

                    <a
                        href="{{ route('reseller.catalog.index') }}"
                        class="quick-menu-card"
                    >

                        <div class="d-flex justify-content-between
                                    align-items-start">

                            <div class="quick-menu-icon">

                                <i class="bi bi-book"></i>

                            </div>

                            <i class="bi bi-arrow-up-right quick-menu-arrow"></i>

                        </div>

                        <h6 class="fw-bold mb-1">
                            Katalog Buku
                        </h6>

                        <p class="mb-0">
                            Lihat dan pilih buku yang tersedia.
                        </p>

                    </a>

                </div>


                {{-- Keranjang --}}
                <div class="col-md-4">

                    <a
                        href="{{ route('reseller.cart.index') }}"
                        class="quick-menu-card"
                    >

                        <div class="d-flex justify-content-between
                                    align-items-start">

                            <div class="quick-menu-icon">

                                <i class="bi bi-cart3"></i>

                            </div>

                            <i class="bi bi-arrow-up-right quick-menu-arrow"></i>

                        </div>

                        <h6 class="fw-bold mb-1">
                            Keranjang
                        </h6>

                        <p class="mb-0">
                            Kelola buku yang akan dibeli.
                        </p>

                    </a>

                </div>


                {{-- Riwayat Pesanan --}}
                <div class="col-md-4">

                    <a
                        href="{{ route('reseller.orders.index') }}"
                        class="quick-menu-card"
                    >

                        <div class="d-flex justify-content-between
                                    align-items-start">

                            <div class="quick-menu-icon">

                                <i class="bi bi-receipt"></i>

                            </div>

                            <i class="bi bi-arrow-up-right quick-menu-arrow"></i>

                        </div>

                        <h6 class="fw-bold mb-1">
                            Riwayat Pesanan
                        </h6>

                        <p class="mb-0">
                            Lihat status dan detail pesanan.
                        </p>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        /*
        |--------------------------------------------------------------------------
        | ANIMASI PROGRESS BAR
        |--------------------------------------------------------------------------
        */

        const progressBar = document.getElementById('packageProgressBar');

        if (progressBar) {

            const progress = parseFloat(
                progressBar.getAttribute('data-progress')
            ) || 0;

            setTimeout(function () {

                progressBar.style.width = progress + '%';

            }, 300);

        }


        /*
        |--------------------------------------------------------------------------
        | BOOTSTRAP TOOLTIP
        |--------------------------------------------------------------------------
        */

        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );

        tooltipTriggerList.forEach(function (tooltipTriggerEl) {

            new bootstrap.Tooltip(tooltipTriggerEl);

        });

    });
</script>

@endsection