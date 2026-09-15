@extends('layouts.cyber-master')

@section('title', 'Laporan Pesanan')

@section('content')
<div class="container-fluid py-4 report-page">

    {{-- =========================
         HEADER
    ========================== --}}
    <div class="page-header mb-4">
        <div class="header-decoration"></div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 position-relative">

            <div>
                <h2 class="mb-1">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    Laporan Pesanan
                </h2>

                <p class="mb-0">
                    Pantau ringkasan transaksi dan laporan pesanan reseller.
                </p>
            </div>

            <div class="header-count">
                <i class="bi bi-cart-check me-1"></i>
                {{ $totalPesanan }} Pesanan
            </div>

        </div>
    </div>

    {{-- =========================
         ALERT SUCCESS
    ========================== --}}
    @if(session('success'))
        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
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

    {{-- =========================
         ALERT ERROR
    ========================== --}}
    @if($errors->any())
        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4"
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

    {{-- =========================
         FILTER LAPORAN
    ========================== --}}
    <div class="card-custom filter-card mb-4">

        <form
            method="GET"
            action="{{ route('admin.reports.index') }}"
        >

            <div class="row g-3 align-items-end">

                {{-- Tanggal Mulai --}}
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">
                        Tanggal Mulai
                    </label>

                    <div class="input-group-custom">
                        <span class="input-icon">
                            <i class="bi bi-calendar3"></i>
                        </span>

                        <input
                            type="date"
                            name="start_date"
                            class="form-control"
                            value="{{ request('start_date') }}"
                        >
                    </div>
                </div>

                {{-- Tanggal Akhir --}}
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">
                        Tanggal Akhir
                    </label>

                    <div class="input-group-custom">
                        <span class="input-icon">
                            <i class="bi bi-calendar3"></i>
                        </span>

                        <input
                            type="date"
                            name="end_date"
                            class="form-control"
                            value="{{ request('end_date') }}"
                        >
                    </div>
                </div>

                {{-- Status Pesanan --}}
                <div class="col-lg-2 col-md-6">
                    <label class="form-label">
                        Status Pesanan
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >
                        <option value="">
                            Semua Status
                        </option>

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
                <div class="col-lg-2 col-md-6">
                    <label class="form-label">
                        Status Pembayaran
                    </label>

                    <select
                        name="payment_status"
                        class="form-select"
                    >
                        <option value="">
                            Semua Status
                        </option>

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

                {{-- Action --}}
                <div class="col-lg-2 col-md-6">

                    <div class="filter-actions">

                        <button
                            type="submit"
                            class="btn-search flex-grow-1"
                        >
                            <i class="bi bi-funnel me-1"></i>
                            Filter
                        </button>

                        <a
                            href="{{ route('admin.reports.index') }}"
                            class="btn-reset-icon"
                            title="Reset Filter"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </div>

            {{-- Filter Aktif --}}
            @if(request()->hasAny([
                'start_date',
                'end_date',
                'status',
                'payment_status'
            ]))
                <div class="active-filter mt-3">

                    <i class="bi bi-funnel-fill me-2"></i>

                    <span>
                        Filter laporan sedang aktif
                    </span>

                    @if(request('start_date') || request('end_date'))
                        <span class="filter-item">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ request('start_date') ?: '...' }}
                            -
                            {{ request('end_date') ?: '...' }}
                        </span>
                    @endif

                    @if(request('status'))
                        <span class="filter-item">
                            Status:
                            {{ ucfirst(request('status')) }}
                        </span>
                    @endif

                    @if(request('payment_status'))
                        <span class="filter-item">
                            Pembayaran:
                            {{ match(request('payment_status')) {
                                'paid' => 'Sudah Dibayar',
                                'pending' => 'Belum Dibayar',
                                'failed' => 'Gagal',
                                default => ucfirst(request('payment_status')),
                            } }}
                        </span>
                    @endif

                </div>
            @endif

        </form>

    </div>

    {{-- =========================
         RINGKASAN LAPORAN
    ========================== --}}
    <div class="row g-4 mb-4">

        {{-- Total Pesanan --}}
        <div class="col-xl-4 col-md-6">

            <div class="summary-card h-100">

                <div class="summary-content">

                    <div>
                        <span class="summary-label">
                            Total Pesanan
                        </span>

                        <h3>
                            {{ number_format($totalPesanan, 0, ',', '.') }}
                        </h3>

                        <small>
                            Sesuai filter laporan
                        </small>
                    </div>

                    <div class="summary-icon blue">
                        <i class="bi bi-cart-check"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- Total Pendapatan --}}
        <div class="col-xl-4 col-md-6">

            <div class="summary-card h-100">

                <div class="summary-content">

                    <div>
                        <span class="summary-label">
                            Total Pendapatan
                        </span>

                        <h3>
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h3>

                        <small>
                            Dari pembayaran terverifikasi
                        </small>
                    </div>

                    <div class="summary-icon green">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- Total Diskon --}}
        <div class="col-xl-4 col-md-6">

            <div class="summary-card h-100">

                <div class="summary-content">

                    <div>
                        <span class="summary-label">
                            Total Diskon
                        </span>

                        <h3>
                            Rp {{ number_format($totalDiskon, 0, ',', '.') }}
                        </h3>

                        <small>
                            Dari pesanan yang sudah dibayar
                        </small>
                    </div>

                    <div class="summary-icon gold">
                        <i class="bi bi-tag"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         TABEL LAPORAN
    ========================== --}}
    <div class="card-custom">

        <div class="table-header">

            <div>
                <h5>
                    <i class="bi bi-file-earmark-bar-graph me-2"></i>
                    Daftar Laporan Pesanan
                </h5>

                <span class="count-pill">
                    {{ $orders->total() }} Data
                </span>
            </div>

            <div class="table-header-right">

                <small>
                    Data pesanan berdasarkan filter yang dipilih
                </small>

                @if(request()->hasAny([
                    'start_date',
                    'end_date',
                    'status',
                    'payment_status'
                ]))
                    <span class="active-badge">
                        <i class="bi bi-funnel-fill me-1"></i>
                        Filter Aktif
                    </span>
                @endif

                {{-- Export Excel --}}
                <a
                    href="{{ route('admin.reports.export.excel', request()->query()) }}"
                    class="btn-export btn-export-excel"
                    title="Export laporan ke Excel"
                >
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    Excel
                </a>

                {{-- Export PDF --}}
                <a
                    href="{{ route('admin.reports.export.pdf', request()->query()) }}"
                    class="btn-export btn-export-pdf"
                    title="Export laporan ke PDF"
                >
                    <i class="bi bi-file-earmark-pdf me-1"></i>
                    PDF
                </a>

            </div>

        </div>

        <div class="table-body">

            @if($orders->count())

                <div class="table-responsive">

                    <table class="report-table">

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
                        <i class="bi bi-bar-chart"></i>
                    </div>

                    <h5>
                        Tidak Ada Data Laporan
                    </h5>

                    <p>
                        Belum ada pesanan yang sesuai dengan tanggal atau
                        filter yang dipilih.
                    </p>

                    @if(request()->hasAny([
                        'start_date',
                        'end_date',
                        'status',
                        'payment_status'
                    ]))

                        <a
                            href="{{ route('admin.reports.index') }}"
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
.report-page {
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

/* =========================
   FILTER
========================= */

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
    pointer-events: none;
}

.input-group-custom .form-control {
    padding-left: 38px;
}

.filter-actions {
    display: flex;
    gap: 8px;
}

.btn-search {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    border: 0;
    border-radius: 9px;
    background: #1A2B5C;
    color: #fff;
    font-size: .85rem;
    font-weight: 600;
    padding: 10px 14px;
    text-decoration: none;
    transition: .2s ease;
}

.btn-search:hover {
    background: #142249;
    color: #fff;
}

.btn-reset-icon {
    width: 42px;
    min-width: 42px;
    min-height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f1f4f8;
    border: 1px solid #e1e6ee;
    color: #526071;
    border-radius: 9px;
    text-decoration: none;
    transition: .2s ease;
}

.btn-reset-icon:hover {
    background: #e8edf4;
    color: #344054;
}

.active-filter {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    color: #2E5B9C;
    font-size: .76rem;
    font-weight: 600;
}

.filter-item {
    display: inline-flex;
    align-items: center;
    background: #edf3fb;
    color: #2E5B9C;
    border-radius: 20px;
    padding: 5px 9px;
    font-size: .7rem;
    font-weight: 600;
}

/* =========================
   SUMMARY CARDS
========================= */

.summary-card {
    background: #fff;
    border: 1px solid #e9edf5;
    border-radius: 18px;
    box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
    padding: 22px;
}

.summary-content {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
}

.summary-label {
    display: block;
    color: #687587;
    font-size: .78rem;
    font-weight: 600;
    margin-bottom: 6px;
}

.summary-content h3 {
    color: #1A2B5C;
    font-size: 1.35rem;
    font-weight: 700;
    margin-bottom: 5px;
    word-break: break-word;
}

.summary-content small {
    color: #8a94a3;
    font-size: .72rem;
}

.summary-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.summary-icon.blue {
    background: #edf3fb;
    color: #2E5B9C;
}

.summary-icon.green {
    background: #e8f7ee;
    color: #18794e;
}

.summary-icon.gold {
    background: #fff4d6;
    color: #8a6800;
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

.table-header > div:first-child {
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

.table-header-right {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 10px;
}

.table-header-right small {
    color: #8a94a3;
    font-size: .76rem;
}

.count-pill {
    background: #edf3fb;
    color: #2E5B9C;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: .72rem;
    font-weight: 700;
}

.active-badge {
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
   EXPORT BUTTON
========================= */

.btn-export {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 8px;
    padding: 7px 11px;
    font-size: .72rem;
    font-weight: 600;
    transition: .2s ease;
    white-space: nowrap;
}

.btn-export-excel {
    background: #e8f7ee;
    border: 1px solid #ccebd9;
    color: #18794e;
}

.btn-export-excel:hover {
    background: #d9f1e3;
    border-color: #b8e2c9;
    color: #12633f;
}

.btn-export-pdf {
    background: #fdeaea;
    border: 1px solid #f5cece;
    color: #b42318;
}

.btn-export-pdf:hover {
    background: #f9dcdc;
    border-color: #efbaba;
    color: #8f1c14;
}

/* =========================
   TABLE
========================= */

.report-table {
    width: 100%;
    min-width: 1050px;
    border-collapse: collapse;
}

.report-table thead th {
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

.report-table tbody td {
    padding: 15px 16px;
    color: #475467;
    font-size: .82rem;
    border-bottom: 1px solid #edf0f5;
    vertical-align: middle;
}

.report-table tbody tr:hover {
    background: #fafcff;
}

.report-table tbody tr:last-child td {
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
   BUTTON DETAIL
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
   RESET BUTTON
========================= */

.empty-state .btn-reset {
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

.empty-state .btn-reset:hover {
    background: #e8edf4;
    color: #344054;
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

    .filter-actions {
        width: 100%;
    }

    .btn-search {
        flex: 1;
    }

    .active-filter {
        align-items: flex-start;
        flex-direction: column;
    }

    .summary-card {
        padding: 18px;
    }

    .summary-content h3 {
        font-size: 1.15rem;
    }

    .table-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 16px;
    }

    .table-header-right {
        width: 100%;
        justify-content: flex-start;
    }

    .table-header-right .btn-export {
        flex: 1;
    }

    .report-table {
        min-width: 1050px;
    }

    .pagination-wrapper {
        padding: 15px;
        overflow-x: auto;
    }
}
</style>
@endsection