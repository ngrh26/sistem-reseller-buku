@extends('layouts.cyber-master')

@section('title', 'Pesanan Saya')

@push('styles')
<style>
    .orders-page {
        padding-bottom: 40px;
    }

    /* =========================
       PAGE HEADER
    ========================== */
    .orders-page .page-header-custom {
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .orders-page .page-header-custom::after {
        content: '';
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        right: -55px;
        top: -75px;
    }

    .orders-page .page-header-content {
        position: relative;
        z-index: 1;
    }

    .orders-page .page-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: rgba(255, 255, 255, .13);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 14px;
    }

    .orders-page .page-header-custom h2 {
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 1.55rem;
    }

    .orders-page .page-header-custom p {
        margin: 0;
        opacity: .86;
        font-size: .88rem;
    }

    /* =========================
       CUSTOM CARD
    ========================== */
    .orders-page .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    /* =========================
       FILTER
    ========================== */
    .orders-page .filter-card {
        padding: 20px 22px;
        margin-bottom: 24px;
    }

    .orders-page .filter-label {
        display: block;
        font-size: .8rem;
        font-weight: 600;
        color: #344054;
        margin-bottom: 7px;
    }

    .orders-page .form-select {
        min-height: 44px;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        color: #475467;
        font-size: .82rem;
        box-shadow: none;
    }

    .orders-page .form-select:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 .2rem rgba(46, 91, 156, .10);
    }

    .orders-page .btn-filter {
        min-height: 44px;
        border-radius: 10px;
        background: #2E5B9C;
        border: 1px solid #2E5B9C;
        color: #fff;
        font-size: .82rem;
        font-weight: 600;
    }

    .orders-page .btn-filter:hover {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
    }

    .orders-page .btn-reset {
        min-height: 44px;
        min-width: 44px;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #d7e3f3;
        color: #2E5B9C;
        font-weight: 600;
    }

    .orders-page .btn-reset:hover {
        background: #edf3fb;
        border-color: #c7d8ed;
        color: #1A2B5C;
    }

    /* =========================
       ALERT
    ========================== */
    .orders-page .alert-custom {
        border-radius: 12px;
        padding: 13px 15px;
        font-size: .82rem;
        border: 1px solid transparent;
        margin-bottom: 20px;
    }

    .orders-page .alert-success-custom {
        background: #e8f7ee;
        border-color: #ccebd8;
        color: #18794e;
    }

    .orders-page .alert-danger-custom {
        background: #fdeaea;
        border-color: #f4c7c7;
        color: #b42318;
    }

    /* =========================
       ORDER CARD
    ========================== */
    .orders-page .order-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        margin-bottom: 18px;
        overflow: hidden;
        transition: .25s ease;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .04);
    }

    .orders-page .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(26, 43, 92, .08);
    }

    .orders-page .order-top {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .orders-page .order-number {
        font-weight: 700;
        color: #1A2B5C;
        font-size: .98rem;
    }

    .orders-page .order-date {
        font-size: .78rem;
        color: #7b8798;
        margin-top: 4px;
    }

    .orders-page .status-group {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .orders-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: .68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Order status */
    .orders-page .status-pending,
    .orders-page .payment-pending {
        background: #fff4d6;
        color: #8a6800;
    }

    .orders-page .status-processed {
        background: #edf3fb;
        color: #2E5B9C;
    }

    .orders-page .status-shipped {
        background: #e8f7ee;
        color: #18794e;
    }

    .orders-page .status-completed,
    .orders-page .payment-paid {
        background: #e8f7ee;
        color: #18794e;
    }

    .orders-page .status-cancelled,
    .orders-page .payment-failed {
        background: #fdeaea;
        color: #b42318;
    }

    /* =========================
       ORDER BODY
    ========================== */
    .orders-page .order-body {
        padding: 20px 22px;
    }

    .orders-page .product-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .orders-page .product-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f0f2f6;
    }

    .orders-page .product-item:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .orders-page .product-cover {
        width: 55px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        background: #f2f4f8;
        flex-shrink: 0;
    }

    .orders-page .product-info {
        min-width: 0;
        flex: 1;
    }

    .orders-page .product-title {
        font-weight: 600;
        color: #273449;
        font-size: .84rem;
        line-height: 1.4;
        margin-bottom: 3px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .orders-page .product-meta {
        font-size: .76rem;
        color: #7c8796;
    }

    .orders-page .product-price {
        text-align: right;
        flex-shrink: 0;
    }

    .orders-page .product-price strong {
        display: block;
        color: #1A2B5C;
        font-size: .86rem;
    }

    .orders-page .product-price span {
        color: #7c8796;
        font-size: .72rem;
    }

    /* =========================
       ORDER SUMMARY
    ========================== */
    .orders-page .order-summary {
        border-left: 1px solid #edf0f5;
        padding-left: 22px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .orders-page .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        font-size: .82rem;
        color: #687587;
        margin-bottom: 9px;
    }

    .orders-page .summary-row strong {
        color: #364152;
        font-weight: 600;
    }

    .orders-page .summary-row.discount strong {
        color: #18794e;
    }

    .orders-page .summary-final {
        border-top: 1px solid #edf0f5;
        margin-top: 4px;
        padding-top: 12px;
        display: flex;
        justify-content: space-between;
        gap: 15px;
        align-items: center;
    }

    .orders-page .summary-final span {
        font-size: .78rem;
        color: #687587;
    }

    .orders-page .summary-final strong {
        font-size: 1.08rem;
        color: #1A2B5C;
        font-weight: 700;
    }

    /* =========================
       ACTION
    ========================== */
    .orders-page .order-actions {
        border-top: 1px solid #edf0f5;
        padding: 15px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .orders-page .payment-note {
        font-size: .76rem;
        color: #7c8796;
    }

    .orders-page .payment-note i {
        color: #2E5B9C;
    }

    .orders-page .btn-detail {
        border-radius: 8px;
        padding: 8px 12px;
        font-size: .76rem;
        font-weight: 600;
        background: #edf3fb;
        border: 1px solid #d7e3f3;
        color: #2E5B9C;
    }

    .orders-page .btn-detail:hover {
        background: #e3edf9;
        border-color: #c7d8ed;
        color: #1A2B5C;
    }

    .orders-page .btn-payment {
        border-radius: 8px;
        padding: 8px 12px;
        font-size: .76rem;
        font-weight: 600;
        background: #C9A84C;
        border: 1px solid #C9A84C;
        color: #fff;
    }

    .orders-page .btn-payment:hover {
        background: #b8953e;
        border-color: #b8953e;
        color: #fff;
    }

    /* =========================
       EMPTY STATE
    ========================== */
    .orders-page .empty-state {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        padding: 55px 25px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .04);
    }

    .orders-page .empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 18px;
    }

    .orders-page .empty-state h4 {
        color: #1A2B5C;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .orders-page .empty-state p {
        color: #7c8796;
        margin-bottom: 20px;
        font-size: .84rem;
    }

    .orders-page .btn-primary-custom {
        border-radius: 9px;
        padding: 9px 15px;
        background: #2E5B9C;
        border: 1px solid #2E5B9C;
        color: #fff;
        font-size: .78rem;
        font-weight: 600;
    }

    .orders-page .btn-primary-custom:hover {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
    }

    .orders-page .btn-outline-custom {
        border-radius: 9px;
        padding: 9px 15px;
        background: #fff;
        border: 1px solid #d7e3f3;
        color: #2E5B9C;
        font-size: .78rem;
        font-weight: 600;
    }

    .orders-page .btn-outline-custom:hover {
        background: #edf3fb;
        color: #1A2B5C;
    }

    /* =========================
       PAGINATION
    ========================== */
    .orders-page .pagination-wrapper {
        margin-top: 25px;
    }

    .orders-page .pagination {
        margin-bottom: 0;
        justify-content: center;
    }

    .orders-page .pagination .page-link {
        color: #1A2B5C;
        border-color: #e0e5ec;
        font-size: .78rem;
        border-radius: 8px;
        margin: 0 2px;
    }

    .orders-page .pagination .page-link:hover {
        background: #edf3fb;
        border-color: #d7e3f3;
        color: #2E5B9C;
    }

    .orders-page .pagination .page-item.active .page-link {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 991.98px) {
        .orders-page .order-summary {
            border-left: none;
            border-top: 1px solid #edf0f5;
            padding-left: 0;
            padding-top: 18px;
            margin-top: 4px;
        }
    }

    @media (max-width: 767.98px) {
        .orders-page .page-header-custom {
            padding: 22px;
            border-radius: 16px;
        }

        .orders-page .page-header-custom h2 {
            font-size: 1.3rem;
        }

        .orders-page .filter-card {
            padding: 18px;
        }

        .orders-page .order-top {
            padding: 17px 18px;
            align-items: flex-start;
        }

        .orders-page .status-group {
            justify-content: flex-start;
        }

        .orders-page .order-body {
            padding: 18px;
        }

        .orders-page .order-actions {
            padding: 15px 18px;
            align-items: stretch;
        }

        .orders-page .payment-note {
            width: 100%;
        }

        .orders-page .order-actions > div:last-child {
            width: 100%;
        }

        .orders-page .order-actions .btn {
            flex: 1;
        }

        .orders-page .product-item {
            align-items: flex-start;
        }

        .orders-page .product-price {
            min-width: 90px;
        }
    }

    @media (max-width: 575.98px) {
        .orders-page .order-actions > div:last-child {
            flex-direction: column;
        }

        .orders-page .order-actions .btn {
            width: 100%;
        }

        .orders-page .product-price {
            min-width: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid orders-page">

    {{-- Header --}}
    <div class="page-header-custom">
        <div class="page-header-content">

            <div class="page-header-icon">
                <i class="bi bi-bag-check"></i>
            </div>

            <h2>Pesanan Saya</h2>

            <p>
                Kelola dan pantau seluruh pesanan reseller Anda.
            </p>

        </div>
    </div>

    {{-- Filter --}}
    <div class="card-custom filter-card">

        <form action="{{ route('reseller.orders.index') }}" method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-md-5">

                    <label class="filter-label">
                        Status Pesanan
                    </label>

                    <select name="status" class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="pending"
                            {{ request('status') === 'pending' ? 'selected' : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="processed"
                            {{ request('status') === 'processed' ? 'selected' : '' }}
                        >
                            Diproses
                        </option>

                        <option
                            value="shipped"
                            {{ request('status') === 'shipped' ? 'selected' : '' }}
                        >
                            Dikirim
                        </option>

                        <option
                            value="completed"
                            {{ request('status') === 'completed' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                        <option
                            value="cancelled"
                            {{ request('status') === 'cancelled' ? 'selected' : '' }}
                        >
                            Dibatalkan
                        </option>

                    </select>

                </div>

                <div class="col-md-5">

                    <label class="filter-label">
                        Status Pembayaran
                    </label>

                    <select name="payment_status" class="form-select">

                        <option value="">
                            Semua Pembayaran
                        </option>

                        <option
                            value="pending"
                            {{ request('payment_status') === 'pending' ? 'selected' : '' }}
                        >
                            Belum Dibayar
                        </option>

                        <option
                            value="paid"
                            {{ request('payment_status') === 'paid' ? 'selected' : '' }}
                        >
                            Sudah Dibayar
                        </option>

                        <option
                            value="failed"
                            {{ request('payment_status') === 'failed' ? 'selected' : '' }}
                        >
                            Gagal
                        </option>

                    </select>

                </div>

                <div class="col-md-2 d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-filter flex-fill"
                    >
                        <i class="bi bi-funnel me-1"></i>
                        Filter
                    </button>

                    @if(request()->filled('status') || request()->filled('payment_status'))

                        <a
                            href="{{ route('reseller.orders.index') }}"
                            class="btn btn-reset"
                            title="Reset filter"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>

    {{-- Flash Message --}}
    @if(session('success'))

        <div class="alert-custom alert-success-custom" role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    {{-- Error --}}
    @if($errors->any())

        <div class="alert-custom alert-danger-custom" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ $errors->first() }}

        </div>

    @endif

    {{-- Orders --}}
    @forelse($orders as $order)

        @php
            $totalItems = $order->items->sum('quantity');

            $statusClass = match ($order->status) {
                'pending' => 'status-pending',
                'processed' => 'status-processed',
                'shipped' => 'status-shipped',
                'completed' => 'status-completed',
                'cancelled' => 'status-cancelled',
                default => 'status-pending',
            };

            $paymentClass = match ($order->payment_status) {
                'paid' => 'payment-paid',
                'failed' => 'payment-failed',
                default => 'payment-pending',
            };

            $paymentLabel = match ($order->payment_status) {
                'pending' => 'Belum Dibayar',
                'paid' => 'Sudah Dibayar',
                'failed' => 'Pembayaran Gagal',
                default => $order->payment_status,
            };

            $statusLabel = match ($order->status) {
                'pending' => 'Menunggu',
                'processed' => 'Diproses',
                'shipped' => 'Dikirim',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
                default => ucfirst($order->status),
            };
        @endphp

        <div class="order-card">

            {{-- Order Header --}}
            <div class="order-top">

                <div>
                    <div class="order-number">
                        Pesanan #{{ $order->id }}
                    </div>

                    <div class="order-date">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ $order->order_date?->format('d F Y, H:i') ?? '-' }}
                    </div>
                </div>

                <div class="status-group">

                    <span class="status-badge {{ $statusClass }}">
                        <i class="bi bi-box-seam"></i>
                        {{ $statusLabel }}
                    </span>

                    <span class="status-badge {{ $paymentClass }}">
                        <i class="bi bi-credit-card"></i>
                        {{ $paymentLabel }}
                    </span>

                </div>

            </div>

            {{-- Order Body --}}
            <div class="order-body">

                <div class="row g-4">

                    {{-- Product List --}}
                    <div class="col-lg-7">

                        <div class="product-list">

                            @foreach($order->items->take(3) as $item)

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
                                            Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}
                                        </div>

                                    </div>

                                    <div class="product-price">

                                        <strong>
                                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                        </strong>

                                        <span>
                                            Subtotal
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                            @if($order->items->count() > 3)

                                <div class="product-meta mt-1">

                                    <i class="bi bi-three-dots me-1"></i>

                                    + {{ $order->items->count() - 3 }} produk lainnya

                                </div>

                            @endif

                        </div>

                    </div>

                    {{-- Summary --}}
                    <div class="col-lg-5">

                        <div class="order-summary">

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
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </strong>

                            </div>

                            <div class="summary-row discount">

                                <span>
                                    Diskon reseller
                                </span>

                                <strong>
                                    - Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                                </strong>

                            </div>

                            <div class="summary-final">

                                <span>
                                    Total pembayaran
                                </span>

                                <strong>
                                    Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Actions --}}
            <div class="order-actions">

                <div class="payment-note">

                    @if($order->payment_status === 'pending')

                        <i class="bi bi-info-circle me-1"></i>
                        Silakan lakukan pembayaran dan upload bukti.

                    @elseif($order->payment_status === 'paid')

                        <i class="bi bi-check-circle me-1"></i>
                        Pembayaran telah diverifikasi.

                    @elseif($order->payment_status === 'failed')

                        <i class="bi bi-exclamation-circle me-1"></i>
                        Pembayaran ditolak. Silakan periksa detail pesanan.

                    @endif

                </div>

                <div class="d-flex gap-2 flex-wrap">

                    <a
                        href="{{ route('reseller.orders.show', $order) }}"
                        class="btn btn-detail"
                    >
                        <i class="bi bi-eye me-1"></i>
                        Lihat Detail
                    </a>

                    @if(
                        $order->payment_status === 'pending' &&
                        $order->status !== 'cancelled'
                    )

                        <a
                            href="{{ route('reseller.payment.create', $order) }}"
                            class="btn btn-payment"
                        >
                            <i class="bi bi-upload me-1"></i>
                            Upload Bukti Pembayaran
                        </a>

                    @endif

                </div>

            </div>

        </div>

    @empty

        {{-- Empty State --}}
        <div class="empty-state">

            <div class="empty-icon">
                <i class="bi bi-bag-x"></i>
            </div>

            <h4>
                Belum Ada Pesanan
            </h4>

            @if(request()->filled('status') || request()->filled('payment_status'))

                <p>
                    Tidak ada pesanan yang sesuai dengan filter yang dipilih.
                </p>

                <a
                    href="{{ route('reseller.orders.index') }}"
                    class="btn btn-outline-custom"
                >
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Reset Filter
                </a>

            @else

                <p>
                    Anda belum memiliki pesanan.
                    Yuk mulai belanja buku untuk kebutuhan reseller Anda.
                </p>

                <a
                    href="{{ route('reseller.catalog.index') }}"
                    class="btn btn-primary-custom"
                >
                    <i class="bi bi-book me-1"></i>
                    Lihat Katalog
                </a>

            @endif

        </div>

    @endforelse

    {{-- Pagination --}}
    @if($orders->hasPages())

        <div class="pagination-wrapper">
            {{ $orders->links() }}
        </div>

    @endif

</div>
@endsection