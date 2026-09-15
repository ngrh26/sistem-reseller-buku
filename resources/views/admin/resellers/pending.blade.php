@extends('layouts.cyber-master')

@section('title', 'Verifikasi Reseller')

@push('styles')
<style>
    .reseller-page {
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
        background: rgba(255, 255, 255, .08);
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

    .btn-header {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .35);
        color: #fff;
        border-radius: 9px;
        padding: 10px 16px;
        font-size: .82rem;
        font-weight: 700;
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .btn-header:hover {
        background: #fff;
        border-color: #fff;
        color: #1A2B5C;
    }

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    .summary-card {
        padding: 20px;
        margin-bottom: 20px;
    }

    .summary-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: #fff4d6;
        color: #8a6800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.35rem;
    }

    .summary-label {
        color: #687587;
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .summary-value {
        color: #1A2B5C;
        font-size: 1.45rem;
        font-weight: 700;
        margin: 0;
    }

    .table-header {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .table-header-content h5 {
        margin: 0;
        color: #1A2B5C;
        font-weight: 700;
        font-size: 1rem;
    }

    .table-header-content p {
        margin: 3px 0 0;
        color: #8a94a3;
        font-size: .75rem;
    }

    .table-count {
        background: #fff4d6;
        color: #8a6800;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .reseller-table {
        width: 100%;
        margin: 0;
        min-width: 1150px;
    }

    .reseller-table thead th {
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

    .reseller-table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #edf0f5;
        vertical-align: middle;
        color: #475467;
        font-size: .82rem;
    }

    .reseller-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .reseller-table tbody tr:hover {
        background: #fafcff;
    }

    .reseller-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #2E5B9C;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: .85rem;
        font-weight: 700;
    }

    .reseller-name {
        color: #344054;
        font-weight: 600;
    }

    .reseller-id {
        color: #8a94a3;
        font-size: .72rem;
        margin-top: 2px;
    }

    .contact-main {
        color: #475467;
        font-size: .8rem;
    }

    .contact-secondary {
        color: #8a94a3;
        font-size: .72rem;
        margin-top: 3px;
    }

    .address-text {
        display: block;
        min-width: 220px;
        max-width: 280px;
        color: #475467;
        line-height: 1.45;
    }

    .package-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #edf3fb;
        color: #2E5B9C;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .discount-value {
        color: #1A2B5C;
        font-weight: 700;
        white-space: nowrap;
    }

    .minimum-value {
        color: #475467;
        white-space: nowrap;
        font-size: .8rem;
    }

    .date-text {
        color: #687587;
        white-space: nowrap;
        font-size: .78rem;
    }

    .btn-approve {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e8f7ee;
        border: 1px solid #ccebd9;
        color: #18794e;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .btn-approve:hover {
        background: #18794e;
        border-color: #18794e;
        color: #fff;
    }

    .btn-reject {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fdeaea;
        border: 1px solid #f5d0ce;
        color: #b42318;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .btn-reject:hover {
        background: #b42318;
        border-color: #b42318;
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
        background: #e8f7ee;
        color: #18794e;
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
        margin: 0 0 16px;
    }

    .btn-empty {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #edf3fb;
        border: 1px solid #dce8f7;
        color: #2E5B9C;
        border-radius: 8px;
        padding: 8px 13px;
        text-decoration: none;
        font-size: .75rem;
        font-weight: 700;
    }

    .btn-empty:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .page-header h2 {
            font-size: 1.35rem;
        }

        .table-header {
            padding: 16px;
        }

        .summary-card {
            padding: 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid reseller-page">

    <div class="page-header">

        <div class="page-header-content">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>

                    <h2>
                        <i class="bi bi-person-check-fill me-2"></i>
                        Verifikasi Reseller
                    </h2>

                    <p>
                        Periksa dan proses pendaftaran reseller yang masih menunggu persetujuan.
                    </p>

                </div>

                <a
                    href="{{ route('admin.resellers.index') }}"
                    class="btn-header"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Manajemen Reseller
                </a>

            </div>

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

    <div class="card-custom summary-card">

        <div class="d-flex align-items-center">

            <div class="summary-icon me-3">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div>

                <div class="summary-label">
                    Pendaftaran Menunggu Verifikasi
                </div>

                <h3 class="summary-value">
                    {{ $pending->count() }} Reseller
                </h3>

            </div>

        </div>

    </div>

    <div class="card-custom">

        <div class="table-header">

            <div class="table-header-content">

                <h5>
                    <i class="bi bi-person-lines-fill me-2"></i>
                    Daftar Pendaftaran
                </h5>

                <p>
                    Berikut adalah reseller yang belum mendapatkan persetujuan admin.
                </p>

            </div>

            <span class="table-count">
                {{ $pending->count() }} pending
            </span>

        </div>

        @if($pending->count() > 0)

            <div class="table-responsive">

                <table class="reseller-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Reseller</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th>Paket</th>
                            <th>Diskon</th>
                            <th>Minimal Pembelian</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($pending as $index => $reseller)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="reseller-avatar me-3">
                                            {{ strtoupper(substr($reseller->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="reseller-name">
                                                {{ $reseller->name }}
                                            </div>

                                            <div class="reseller-id">
                                                ID #{{ $reseller->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="contact-main">
                                        <i class="bi bi-envelope me-1"></i>
                                        {{ $reseller->email }}
                                    </div>

                                    @if($reseller->phone)

                                        <div class="contact-secondary">
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $reseller->phone }}
                                        </div>

                                    @else

                                        <div class="contact-secondary">
                                            Nomor telepon tidak tersedia
                                        </div>

                                    @endif

                                </td>

                                <td>

                                    @if($reseller->address)

                                        <span
                                            class="address-text"
                                            title="{{ $reseller->address }}"
                                        >
                                            {{ Str::limit($reseller->address, 70) }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($reseller->reseller && $reseller->reseller->package)

                                        <span class="package-badge">
                                            <i class="bi bi-box"></i>
                                            {{ $reseller->reseller->package->name }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($reseller->reseller && $reseller->reseller->package)

                                        <span class="discount-value">
                                            {{ $reseller->reseller->package->discount_percentage }}%
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($reseller->reseller && $reseller->reseller->package)

                                        <span class="minimum-value">
                                            {{ number_format($reseller->reseller->package->min_purchase, 0, ',', '.') }}
                                            buku
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($reseller->reseller && $reseller->reseller->join_date)

                                        <div class="date-text">
                                            {{ $reseller->reseller->join_date->format('d/m/Y') }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <form
                                            action="{{ route('admin.resellers.approve', $reseller) }}"
                                            method="POST"
                                            class="form-approve"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn-approve"
                                                title="Setujui reseller"
                                            >
                                                <i class="bi bi-check-lg"></i>
                                                Setujui
                                            </button>

                                        </form>

                                        <form
                                            action="{{ route('admin.resellers.reject', $reseller) }}"
                                            method="POST"
                                            class="form-reject"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn-reject"
                                                title="Tolak pendaftaran"
                                            >
                                                <i class="bi bi-x-lg"></i>
                                                Tolak
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <h5>
                    Tidak Ada Pendaftaran Pending
                </h5>

                <p>
                    Saat ini tidak ada reseller yang menunggu verifikasi.
                </p>

                <a
                    href="{{ route('admin.resellers.index') }}"
                    class="btn-empty"
                >
                    <i class="bi bi-people"></i>
                    Lihat Semua Reseller
                </a>

            </div>

        @endif

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.form-approve').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Setujui Reseller?',
                text: 'Reseller yang disetujui akan dapat login dan menggunakan sistem.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(function (result) {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

    document.querySelectorAll('.form-reject').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            Swal.fire({
                title: 'Tolak Pendaftaran?',
                text: 'Pendaftaran reseller akan diubah menjadi tidak aktif.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(function (result) {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});
</script>
@endpush

@endsection