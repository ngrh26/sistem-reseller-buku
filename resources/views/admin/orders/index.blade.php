@extends('layouts.cyber-master')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="container-fluid py-4 order-page">

    {{-- Header --}}
    <div class="page-header mb-4">
        <div class="header-decoration"></div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 position-relative">
            <div>
                <h2 class="mb-1">
                    <i class="bi bi-cart-check me-2"></i>
                    Manajemen Pesanan
                </h2>

                <p class="mb-0">
                    Kelola dan pantau seluruh pesanan reseller.
                </p>
            </div>

            <div class="header-count">
                <i class="bi bi-cart-check me-1"></i>
                {{ $orders->total() }} Pesanan
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

    {{-- Filter --}}
    <div class="card-custom filter-card mb-4">
        <form method="GET" action="{{ route('admin.orders.index') }}">

            <div class="row g-3 align-items-end">

                {{-- Search --}}
                <div class="col-lg-5 col-md-6">
                    <label class="form-label">
                        Cari Pesanan
                    </label>

                    <div class="input-group-custom">
                        <span class="input-icon">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="ID pesanan, nama reseller, atau email..."
                        >
                    </div>
                </div>

                {{-- Status Pesanan --}}
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">
                        Status Pesanan
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >
                        <option value="">Semua Status</option>

                        <option
                            value="pending"
                            @selected(request('status') === 'pending')
                        >
                            Menunggu
                        </option>

                        <option
                            value="processed"
                            @selected(request('status') === 'processed')
                        >
                            Diproses
                        </option>

                        <option
                            value="shipped"
                            @selected(request('status') === 'shipped')
                        >
                            Dikirim
                        </option>

                        <option
                            value="completed"
                            @selected(request('status') === 'completed')
                        >
                            Selesai
                        </option>

                        <option
                            value="cancelled"
                            @selected(request('status') === 'cancelled')
                        >
                            Dibatalkan
                        </option>
                    </select>
                </div>

                {{-- Status Pembayaran --}}
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">
                        Status Pembayaran
                    </label>

                    <select
                        name="payment_status"
                        class="form-select"
                    >
                        <option value="">Semua Status</option>

                        <option
                            value="pending"
                            @selected(request('payment_status') === 'pending')
                        >
                            Belum Dibayar
                        </option>

                        <option
                            value="paid"
                            @selected(request('payment_status') === 'paid')
                        >
                            Sudah Dibayar
                        </option>

                        <option
                            value="failed"
                            @selected(request('payment_status') === 'failed')
                        >
                            Gagal
                        </option>
                    </select>
                </div>

                {{-- Button --}}
                <div class="col-lg-1 col-md-6">
                    <button
                        type="submit"
                        class="btn-search w-100"
                        title="Terapkan Filter"
                    >
                        <i class="bi bi-search"></i>
                    </button>
                </div>

            </div>

            @if(request('search') || request('status') || request('payment_status'))
                <div class="mt-3">
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="btn-reset"
                    >
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset Filter
                    </a>
                </div>
            @endif

        </form>
    </div>

    {{-- Table --}}
    <div class="card-custom">

        <div class="table-header">
            <div>
                <h5>
                    <i class="bi bi-cart-check me-2"></i>
                    Daftar Pesanan
                </h5>

                <span class="count-pill">
                    {{ $orders->total() }} Pesanan
                </span>
            </div>

            <small>
                Data pesanan reseller terbaru
            </small>
        </div>

        <div class="table-body">

            @if($orders->count())

                <div class="table-responsive">
                    <table class="order-table">

                        <thead>
                            <tr>
                                <th class="px-4">Pesanan</th>
                                <th>Reseller</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                                <th class="text-end px-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($orders as $order)

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

                                <tr>

                                    {{-- Pesanan --}}
                                    <td class="px-4">
                                        <div class="order-number">
                                            #{{ $order->id }}
                                        </div>

                                        <small class="text-muted">
                                            <i class="bi bi-book me-1"></i>
                                            {{ $order->items->sum('quantity') }} buku
                                        </small>
                                    </td>

                                    {{-- Reseller --}}
                                    <td>
                                        @if($order->reseller)

                                            <div class="reseller-info">
                                                <div class="reseller-avatar">
                                                    {{ strtoupper(substr($order->reseller->name, 0, 1)) }}
                                                </div>

                                                <div>
                                                    <div class="reseller-name">
                                                        {{ $order->reseller->name }}
                                                    </div>

                                                    <small>
                                                        {{ $order->reseller->email }}
                                                    </small>
                                                </div>
                                            </div>

                                        @else

                                            <span class="text-muted">
                                                Reseller tidak ditemukan
                                            </span>

                                        @endif
                                    </td>

                                    {{-- Tanggal --}}
                                    <td>
                                        <div class="date-main">
                                            {{ $order->order_date?->format('d/m/Y') ?? '-' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $order->order_date?->format('H:i') ?? '-' }}
                                        </small>
                                    </td>

                                    {{-- Total --}}
                                    <td>
                                        <div class="total-price">
                                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                        </div>

                                        @if($order->discount_amount > 0)
                                            <small class="discount-text">
                                                Diskon Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Pembayaran --}}
                                    <td>
                                        <span class="status-badge {{ $paymentClass }}">
                                            <i class="bi bi-credit-card me-1"></i>
                                            {{ $paymentLabel }}
                                        </span>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $order->statusLabel() }}
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="text-end px-4">
                                        <a
                                            href="{{ route('admin.orders.show', $order) }}"
                                            class="btn-detail"
                                        >
                                            <i class="bi bi-eye me-1"></i>
                                            Detail
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>

            @else

                {{-- Empty State --}}
                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="bi bi-cart-x"></i>
                    </div>

                    <h5>
                        Belum Ada Pesanan
                    </h5>

                    <p>
                        Belum ada data pesanan yang sesuai dengan pencarian
                        atau filter yang digunakan.
                    </p>

                    @if(request('search') || request('status') || request('payment_status'))
                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="btn-reset"
                        >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset Filter
                        </a>
                    @endif

                </div>

            @endif

        </div>

    </div>

</div>

<style>
.order-page {
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
    padding: 28px 30px;
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

.header-count {
    position: relative;
    background: rgba(255, 255, 255, .12);
    border: 1px solid rgba(255, 255, 255, .18);
    border-radius: 10px;
    padding: 9px 14px;
    font-size: .8rem;
    font-weight: 600;
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

.filter-card {
    padding: 20px;
}

.filter-card .form-label {
    font-size: .8rem;
    font-weight: 600;
    color: #344054;
    margin-bottom: 7px;
}

.filter-card .form-control,
.filter-card .form-select {
    border: 1px solid #dce3ed;
    border-radius: 9px;
    font-size: .85rem;
    padding: 10px 12px;
    min-height: 42px;
}

.filter-card .form-control:focus,
.filter-card .form-select:focus {
    border-color: #2E5B9C;
    box-shadow: 0 0 0 3px rgba(46, 91, 156, .08);
}

.input-group-custom {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #8a94a3;
    z-index: 3;
}

.input-group-custom .form-control {
    padding-left: 38px;
}

.btn-search {
    min-height: 42px;
    border: 0;
    border-radius: 9px;
    background: #1A2B5C;
    color: #fff;
    font-size: .85rem;
    font-weight: 600;
    padding: 10px 12px;
    transition: .2s ease;
}

.btn-search:hover {
    background: #142249;
    color: #fff;
}

.btn-reset {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    background: #f1f4f8;
    border: 1px solid #e1e6ee;
    color: #526071;
    border-radius: 9px;
    padding: 8px 13px;
    font-size: .78rem;
    font-weight: 600;
}

.btn-reset:hover {
    background: #e8edf4;
    color: #344054;
}

/* =========================
   TABLE HEADER
========================= */

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 22px;
    border-bottom: 1px solid #e9edf5;
    gap: 15px;
}

.table-header > div {
    display: flex;
    align-items: center;
    gap: 10px;
}

.table-header h5 {
    color: #1A2B5C;
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.table-header small {
    color: #8a94a3;
    font-size: .78rem;
}

.count-pill {
    background: #edf3fb;
    color: #2E5B9C;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: .72rem;
    font-weight: 700;
}

/* =========================
   TABLE
========================= */

.order-table {
    width: 100%;
    min-width: 1050px;
    border-collapse: collapse;
}

.order-table thead th {
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

.order-table tbody td {
    padding: 15px 16px;
    color: #475467;
    font-size: .82rem;
    border-bottom: 1px solid #edf0f5;
    vertical-align: middle;
}

.order-table tbody tr:hover {
    background: #fafcff;
}

.order-table tbody tr:last-child td {
    border-bottom: 0;
}

.order-number {
    color: #1A2B5C;
    font-weight: 700;
    margin-bottom: 3px;
}

.reseller-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.reseller-avatar {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    background: #edf3fb;
    color: #2E5B9C;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    font-weight: 700;
}

.reseller-name {
    color: #344054;
    font-weight: 600;
    margin-bottom: 2px;
}

.reseller-info small {
    color: #8a94a3;
    font-size: .72rem;
}

.date-main {
    color: #475467;
    font-weight: 500;
}

.total-price {
    color: #1A2B5C;
    font-weight: 700;
}

.discount-text {
    color: #18794e;
    font-size: .7rem;
}

/* =========================
   STATUS
========================= */

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
   BUTTON
========================= */

.btn-detail {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    background: #edf3fb;
    border: 1px solid #d7e3f3;
    color: #2E5B9C;
    border-radius: 8px;
    padding: 7px 11px;
    font-size: .72rem;
    font-weight: 600;
    transition: .2s ease;
}

.btn-detail:hover {
    background: #e2ebf8;
    border-color: #c8d8ed;
    color: #1A2B5C;
}

/* =========================
   EMPTY STATE
========================= */

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
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    font-size: 1.8rem;
}

.empty-state h5 {
    color: #344054;
    font-weight: 700;
    margin-bottom: 7px;
}

.empty-state p {
    color: #8a94a3;
    font-size: .82rem;
    margin-bottom: 20px;
}

/* =========================
   PAGINATION
========================= */

.pagination-wrapper {
    padding: 18px 22px;
    border-top: 1px solid #e9edf5;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 767.98px) {

    .page-header {
        padding: 23px 20px;
        border-radius: 16px;
    }

    .page-header h2 {
        font-size: 1.25rem;
    }

    .filter-card {
        padding: 16px;
    }

    .table-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 16px;
    }

    .table-header > div {
        flex-wrap: wrap;
    }

    .order-table {
        min-width: 1050px;
    }

    .pagination-wrapper {
        padding: 15px;
        overflow-x: auto;
    }
}
</style>
@endsection