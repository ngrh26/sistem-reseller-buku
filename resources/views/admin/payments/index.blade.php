@extends('layouts.cyber-master')

@section('title', 'Manajemen Pembayaran')

@push('styles')
<style>
    .payment-page {
        padding-bottom: 40px;
    }

    .page-header {
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
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

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    .filter-card {
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-label-custom {
        color: #344054;
        font-size: .8rem;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        border-color: #dce3ed;
        border-radius: 9px;
        font-size: .85rem;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 .2rem rgba(46, 91, 156, .1);
    }

    .btn-filter {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .85rem;
        font-weight: 600;
    }

    .btn-filter:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }

    .btn-reset {
        background: #f1f4f8;
        border-color: #e1e6ee;
        color: #526071;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .85rem;
        font-weight: 600;
    }

    .btn-reset:hover {
        background: #e6ebf2;
        color: #344054;
    }

    .table-header {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .table-header h5 {
        margin: 0;
        color: #1A2B5C;
        font-weight: 700;
        font-size: 1rem;
    }

    .payment-count {
        background: #edf3fb;
        color: #2E5B9C;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 700;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .payment-table {
        width: 100%;
        margin: 0;
        min-width: 850px;
    }

    .payment-table thead th {
        background: #f8faff;
        color: #687587;
        border-bottom: 1px solid #e5eaf1;
        padding: 13px 16px;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .payment-table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #edf0f5;
        vertical-align: middle;
        color: #475467;
        font-size: .82rem;
    }

    .payment-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .payment-table tbody tr:hover {
        background: #fafcff;
    }

    .order-number {
        color: #1A2B5C;
        font-weight: 700;
    }

    .reseller-name {
        color: #344054;
        font-weight: 600;
    }

    .reseller-email {
        color: #8a94a3;
        font-size: .72rem;
        margin-top: 2px;
    }

    .amount {
        color: #1A2B5C;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff4d6;
        color: #8a6800;
    }

    .status-verified {
        background: #e8f7ee;
        color: #18794e;
    }

    .status-rejected {
        background: #fdeaea;
        color: #b42318;
    }

    .order-status {
        font-size: .73rem;
        font-weight: 600;
        color: #687587;
    }

    .date-text {
        color: #687587;
        white-space: nowrap;
        font-size: .78rem;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #edf3fb;
        border: 1px solid #dce8f7;
        color: #2E5B9C;
        border-radius: 8px;
        padding: 7px 11px;
        text-decoration: none;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .btn-detail:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }

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

    .pagination-wrapper {
        padding: 18px 22px;
        border-top: 1px solid #edf0f5;
    }

    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        color: #2E5B9C;
        border-color: #dfe5ee;
        font-size: .78rem;
    }

    .pagination .page-item.active .page-link {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .filter-card {
            padding: 16px;
        }

        .table-header {
            padding: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid payment-page">

    <div class="page-header">
        <div class="page-header-content">

            <h2>
                <i class="bi bi-credit-card-2-front me-2"></i>
                Manajemen Pembayaran
            </h2>

            <p>
                Kelola dan verifikasi bukti pembayaran dari reseller.
            </p>

        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ $errors->first() }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>
    @endif

    <div class="card-custom filter-card">

        <form
            method="GET"
            action="{{ route('admin.payments.index') }}"
        >

            <div class="row g-3 align-items-end">

                <div class="col-lg-5 col-md-5">

                    <label class="form-label-custom">
                        Cari Pembayaran
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Nama reseller, email, atau nomor pesanan..."
                    >

                </div>

                <div class="col-lg-3 col-md-3">

                    <label class="form-label-custom">
                        Status Pembayaran
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
                            Menunggu Verifikasi
                        </option>

                        <option
                            value="verified"
                            @selected(request('status') === 'verified')
                        >
                            Terverifikasi
                        </option>

                        <option
                            value="rejected"
                            @selected(request('status') === 'rejected')
                        >
                            Ditolak
                        </option>

                    </select>

                </div>

                <div class="col-lg-4 col-md-4">

                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-filter"
                        >
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>

                        <a
                            href="{{ route('admin.payments.index') }}"
                            class="btn btn-reset"
                        >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset
                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <div class="card-custom">

        <div class="table-header">

            <h5>
                <i class="bi bi-list-ul me-2"></i>
                Daftar Pembayaran
            </h5>

            <span class="payment-count">
                {{ $payments->total() }} pembayaran
            </span>

        </div>

        @if($payments->count() > 0)

            <div class="table-responsive">

                <table class="payment-table">

                    <thead>

                        <tr>
                            <th>Pesanan</th>
                            <th>Reseller</th>
                            <th>Nominal</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($payments as $payment)

                            <tr>

                                <td>

                                    <div class="order-number">
                                        #{{ $payment->order_id }}
                                    </div>

                                    @if($payment->order)

                                        <div class="date-text mt-1">
                                            {{ $payment->order->items->sum('quantity') }} buku
                                        </div>

                                    @endif

                                </td>

                                <td>

                                    @if($payment->reseller)

                                        <div class="reseller-name">
                                            {{ $payment->reseller->name }}
                                        </div>

                                        <div class="reseller-email">
                                            {{ $payment->reseller->email }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="amount">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </div>

                                </td>

                                <td>

                                    @switch($payment->status)

                                        @case('pending')

                                            <span class="status-badge status-pending">
                                                <i class="bi bi-clock"></i>
                                                Menunggu Verifikasi
                                            </span>

                                            @break

                                        @case('verified')

                                            <span class="status-badge status-verified">
                                                <i class="bi bi-check-circle"></i>
                                                Terverifikasi
                                            </span>

                                            @break

                                        @case('rejected')

                                            <span class="status-badge status-rejected">
                                                <i class="bi bi-x-circle"></i>
                                                Ditolak
                                            </span>

                                            @break

                                        @default

                                            <span class="status-badge status-pending">
                                                {{ ucfirst($payment->status) }}
                                            </span>

                                    @endswitch

                                </td>

                                <td>

                                    @if($payment->order)

                                        <div class="order-status">
                                            {{ $payment->order->statusLabel() }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="date-text">
                                        {{ $payment->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </div>

                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.payments.show', $payment) }}"
                                        class="btn-detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                        Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @if($payments->hasPages())

                <div class="pagination-wrapper">
                    {{ $payments->links() }}
                </div>

            @endif

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-credit-card"></i>
                </div>

                <h5>
                    Belum Ada Pembayaran
                </h5>

                <p>
                    Belum terdapat data pembayaran yang sesuai dengan pencarian.
                </p>

            </div>

        @endif

    </div>

</div>
@endsection