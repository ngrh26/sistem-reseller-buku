@extends('layouts.cyber-master')

@section('title', 'Manajemen Reseller')

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
        background: #fff;
        border: 1px solid rgba(255, 255, 255, .7);
        color: #1A2B5C;
        border-radius: 9px;
        padding: 10px 16px;
        font-size: .82rem;
        font-weight: 700;
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .btn-header:hover {
        background: #f1f5fb;
        color: #1A2B5C;
    }

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    .stat-card {
        padding: 22px;
        height: 100%;
    }

    .stat-label {
        color: #687587;
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .stat-value {
        color: #1A2B5C;
        font-size: 1.45rem;
        font-weight: 700;
        margin: 0;
    }

    .stat-description {
        color: #8a94a3;
        font-size: .72rem;
        margin-top: 3px;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.35rem;
    }

    .stat-warning {
        background: #fff4d6;
        color: #8a6800;
    }

    .stat-success {
        background: #e8f7ee;
        color: #18794e;
    }

    .stat-primary {
        background: #edf3fb;
        color: #2E5B9C;
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
        background: #edf3fb;
        color: #2E5B9C;
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
        min-width: 950px;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: .85rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .avatar-primary {
        background: #2E5B9C;
    }

    .avatar-success {
        background: #18794e;
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

    .purchase-value {
        color: #1A2B5C;
        font-weight: 700;
        white-space: nowrap;
    }

    .date-text {
        color: #687587;
        white-space: nowrap;
        font-size: .78rem;
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

    .status-active {
        background: #e8f7ee;
        color: #18794e;
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

    .section-gap {
        margin-bottom: 20px;
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

        .stat-card {
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
                        <i class="bi bi-people-fill me-2"></i>
                        Manajemen Reseller
                    </h2>

                    <p>
                        Kelola pendaftaran dan status reseller PT Cyber Media Teknologi.
                    </p>
                </div>

                <a
                    href="{{ route('admin.resellers.pending') }}"
                    class="btn-header"
                >
                    <i class="bi bi-person-check"></i>
                    Verifikasi Reseller
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

    <div class="row g-3 section-gap">

        <div class="col-xl-4 col-md-6">
            <div class="card-custom stat-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">
                            Menunggu Verifikasi
                        </div>

                        <h3 class="stat-value">
                            {{ $pending->count() }}
                        </h3>

                        <div class="stat-description">
                            Pendaftaran baru
                        </div>
                    </div>

                    <div class="stat-icon stat-warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card-custom stat-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">
                            Reseller Aktif
                        </div>

                        <h3 class="stat-value">
                            {{ $active->count() }}
                        </h3>

                        <div class="stat-description">
                            Sudah mendapatkan persetujuan
                        </div>
                    </div>

                    <div class="stat-icon stat-success">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-xl-4 col-md-12">
            <div class="card-custom stat-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-label">
                            Total Reseller
                        </div>

                        <h3 class="stat-value">
                            {{ $pending->count() + $active->count() }}
                        </h3>

                        <div class="stat-description">
                            Pending dan aktif
                        </div>
                    </div>

                    <div class="stat-icon stat-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <div class="card-custom section-gap">

        <div class="table-header">

            <div class="table-header-content">

                <h5>
                    <i class="bi bi-person-exclamation me-2"></i>
                    Menunggu Verifikasi
                </h5>

                <p>
                    Reseller yang baru melakukan pendaftaran.
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
                            <th>Paket</th>
                            <th>Diskon</th>
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

                                        <div class="reseller-avatar avatar-primary me-3">
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

                                    @if($reseller->reseller)

                                        <div class="date-text">
                                            {{ optional($reseller->reseller->join_date)->format('d/m/Y') ?? '-' }}
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
                                                title="Tolak reseller"
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
                    Semua pendaftaran reseller sudah diproses.
                </p>

            </div>

        @endif

    </div>

    <div class="card-custom">

        <div class="table-header">

            <div class="table-header-content">

                <h5>
                    <i class="bi bi-people-fill me-2"></i>
                    Reseller Aktif
                </h5>

                <p>
                    Daftar reseller yang sudah mendapatkan persetujuan.
                </p>

            </div>

            <span class="table-count">
                {{ $active->count() }} aktif
            </span>

        </div>

        @if($active->count() > 0)

            <div class="table-responsive">

                <table class="reseller-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Reseller</th>
                            <th>Kontak</th>
                            <th>Paket</th>
                            <th>Diskon</th>
                            <th>Total Pembelian</th>
                            <th>Tanggal Bergabung</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($active as $index => $reseller)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="reseller-avatar avatar-success me-3">
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

                                    @if($reseller->reseller)

                                        <div class="purchase-value">
                                            {{ number_format($reseller->reseller->total_purchase, 0, ',', '.') }} buku
                                        </div>

                                    @else

                                        <span class="purchase-value">
                                            0 buku
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($reseller->reseller)

                                        <div class="date-text">
                                            {{ optional($reseller->reseller->join_date)->format('d/m/Y') ?? '-' }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="status-badge status-active">
                                        <i class="bi bi-check-circle"></i>
                                        Aktif
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
                    <i class="bi bi-people"></i>
                </div>

                <h5>
                    Belum Ada Reseller Aktif
                </h5>

                <p>
                    Reseller yang telah disetujui akan muncul di sini.
                </p>

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
                text: 'Reseller ini akan mendapatkan akses ke sistem.',
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
                text: 'Status reseller akan diubah menjadi tidak aktif.',
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