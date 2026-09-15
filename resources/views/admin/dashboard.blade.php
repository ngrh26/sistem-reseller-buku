@extends('layouts.cyber-master')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    .dashboard-page {
        padding-bottom: 40px;
    }

    /* =========================
       PAGE HEADER
    ========================== */

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

    .header-date {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        color: #fff;
        border-radius: 10px;
        padding: 9px 14px;
        font-size: .8rem;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================
       CARD
    ========================== */

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    /* =========================
       STATISTIC CARDS
    ========================== */

    .stat-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        padding: 22px;
        height: 100%;
        transition: .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(26, 43, 92, .08);
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

    .stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
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

    /* =========================
       PENDING ALERT
    ========================== */

    .pending-alert {
        background: #fff8e8;
        border: 1px solid #f1dfad;
        border-radius: 15px;
        padding: 16px 18px;
        color: #806d3c;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .04);
    }

    .pending-alert-title {
        color: #705d2f;
        font-size: .86rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .pending-alert-text {
        color: #8a7950;
        font-size: .76rem;
        margin: 0;
    }

    .btn-pending {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #8a6800;
        border: 1px solid #8a6800;
        color: #fff;
        border-radius: 9px;
        padding: 8px 13px;
        font-size: .76rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-pending:hover {
        background: #705500;
        border-color: #705500;
        color: #fff;
    }

    /* =========================
       TABLE HEADER
    ========================== */

    .table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        border-bottom: 1px solid #e9edf5;
    }

    .table-header > div:first-child {
        min-width: 0;
    }

    .table-header h5 {
        color: #1A2B5C;
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 3px;
    }

    .table-header p {
        color: #8a94a3;
        font-size: .76rem;
        margin: 0;
    }

    .btn-view-all {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #edf3fb;
        border: 1px solid #d7e3f3;
        color: #2E5B9C;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: .72rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-view-all:hover {
        background: #e2ebf8;
        border-color: #c8d8ed;
        color: #1A2B5C;
    }

    /* =========================
       TABLE
    ========================== */

    .dashboard-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .dashboard-table thead th {
        background: #f8faff;
        color: #687587;
        padding: 13px 16px;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
        border-bottom: 1px solid #e9edf5;
    }

    .dashboard-table tbody td {
        padding: 15px 16px;
        color: #475467;
        font-size: .82rem;
        border-bottom: 1px solid #edf0f5;
        vertical-align: middle;
    }

    .dashboard-table tbody tr:hover {
        background: #fafcff;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .order-number {
        color: #1A2B5C;
        font-weight: 700;
    }

    .reseller-name {
        color: #344054;
        font-weight: 600;
    }

    .date-main {
        color: #475467;
        font-weight: 500;
    }

    .date-sub {
        color: #8a94a3;
        font-size: .7rem;
        margin-top: 2px;
    }

    .total-price {
        color: #1A2B5C;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================
       STATUS BADGES
    ========================== */

    .status-badge {
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
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

    /* =========================
       EMPTY STATE
    ========================== */

    .empty-state {
        text-align: center;
        padding: 65px 20px;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 15px;
    }

    .empty-state h5 {
        color: #344054;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .empty-state p {
        color: #8a94a3;
        font-size: .82rem;
        margin: 0;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 767.98px) {

        .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .header-date {
            margin-top: 10px;
        }

        .stat-card {
            padding: 18px;
        }

        .stat-value {
            font-size: 1.15rem;
        }

        .table-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 16px;
        }

        .btn-view-all {
            width: 100%;
        }

        .dashboard-table {
            min-width: 850px;
        }

        .pending-alert {
            padding: 15px;
        }

        .btn-pending {
            width: 100%;
            margin-top: 12px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid py-4 dashboard-page">

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="page-header">

        <div class="page-header-content">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div>

                    <h2>
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard Admin
                    </h2>

                    <p>
                        Selamat datang di Sistem Reseller Buku PT Cyber Media Teknologi.
                    </p>

                </div>

                <div class="header-date">

                    <i class="bi bi-calendar3 me-2"></i>

                    {{ now()->translatedFormat('d F Y') }}

                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         STATISTIK
    ========================== --}}

    <div class="row g-4 mb-4">

        {{-- Reseller Aktif --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Reseller Aktif
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($totalReseller, 0, ',', '.') }}
                        </h3>

                    </div>

                    <div class="stat-icon blue">
                        <i class="bi bi-people"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- Total Pesanan --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Total Pesanan
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($totalPesanan, 0, ',', '.') }}
                        </h3>

                    </div>

                    <div class="stat-icon blue">
                        <i class="bi bi-cart-check"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- Pendapatan --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Pendapatan
                        </span>

                        <h3 class="stat-value">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h3>

                    </div>

                    <div class="stat-icon green">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- Total Produk --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <span class="stat-label">
                            Total Produk
                        </span>

                        <h3 class="stat-value">
                            {{ number_format($totalProduk, 0, ',', '.') }}
                        </h3>

                    </div>

                    <div class="stat-icon gold">
                        <i class="bi bi-book"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         PENDING RESELLER
    ========================== --}}

    @if($pendingReseller > 0)

        <div class="pending-alert mb-4">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div>

                    <div class="pending-alert-title">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        Ada {{ $pendingReseller }} reseller menunggu verifikasi.

                    </div>

                    <p class="pending-alert-text">
                        Silakan periksa dan verifikasi pendaftaran reseller.
                    </p>

                </div>

                <a
                    href="{{ route('admin.resellers.pending') }}"
                    class="btn-pending"
                >
                    <i class="bi bi-person-check me-1"></i>
                    Periksa Sekarang
                </a>

            </div>

        </div>

    @endif

    {{-- =========================
         PESANAN TERBARU
    ========================== --}}

    <div class="card-custom">

        <div class="table-header">

            <div>

                <h5>
                    <i class="bi bi-cart-check me-2"></i>
                    Pesanan Terbaru
                </h5>

                <p>
                    Lima pesanan terbaru dalam sistem.
                </p>

            </div>

            <a
                href="{{ route('admin.orders.index') }}"
                class="btn-view-all"
            >
                <i class="bi bi-arrow-right me-1"></i>
                Lihat Semua
            </a>

        </div>

        <div>

            @if($pesananTerbaru->count() > 0)

                <div class="table-responsive">

                    <table class="dashboard-table">

                        <thead>

                            <tr>

                                <th class="px-4">
                                    ID
                                </th>

                                <th>
                                    Reseller
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Pembayaran
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($pesananTerbaru as $order)

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
                                        'failed' => 'failed',
                                        'pending' => 'pending',
                                        default => 'default',
                                    };

                                    $paymentLabel = match($order->payment_status) {
                                        'paid' => 'Sudah Dibayar',
                                        'failed' => 'Gagal',
                                        'pending' => 'Belum Dibayar',
                                        default => ucfirst($order->payment_status),
                                    };

                                @endphp

                                <tr>

                                    {{-- ID --}}
                                    <td class="px-4">

                                        <div class="order-number">
                                            #{{ $order->id }}
                                        </div>

                                    </td>

                                    {{-- Reseller --}}
                                    <td>

                                        @if($order->reseller)

                                            <div class="reseller-name">
                                                {{ $order->reseller->name }}
                                            </div>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Tanggal --}}
                                    <td>

                                        <div class="date-main">

                                            {{ $order->order_date
                                                ? \Carbon\Carbon::parse($order->order_date)->format('d/m/Y')
                                                : '-' }}

                                        </div>

                                        @if($order->order_date)

                                            <div class="date-sub">

                                                {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }}

                                            </div>

                                        @endif

                                    </td>

                                    {{-- Total --}}
                                    <td>

                                        <div class="total-price">
                                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                        </div>

                                    </td>

                                    {{-- Status Pesanan --}}
                                    <td>

                                        <span class="status-badge {{ $statusClass }}">

                                            {{ $order->statusLabel() }}

                                        </span>

                                    </td>

                                    {{-- Status Pembayaran --}}
                                    <td>

                                        <span class="status-badge {{ $paymentClass }}">

                                            {{ $paymentLabel }}

                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="bi bi-cart-x"></i>

                    </div>

                    <h5>
                        Belum Ada Pesanan
                    </h5>

                    <p>
                        Data pesanan akan muncul di sini ketika reseller melakukan pembelian.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection