@extends('layouts.cyber-master')

@section('title', 'Edit Reseller')

@push('styles')
<style>
    .reseller-edit-page {
        padding-bottom: 40px;
    }

    /* =========================
       PAGE HEADER
    ========================= */
    .reseller-edit-page .page-header {
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .reseller-edit-page .page-header::after {
        content: '';
        position: absolute;
        width: 210px;
        height: 210px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        right: -65px;
        top: -90px;
    }

    .reseller-edit-page .page-header-content {
        position: relative;
        z-index: 1;
    }

    .reseller-edit-page .page-header h2 {
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 5px;
        color: #fff;
    }

    .reseller-edit-page .page-header p {
        margin: 0;
        opacity: .85;
        font-size: .9rem;
    }

    /* =========================
       HEADER BUTTON
    ========================= */
    .reseller-edit-page .btn-header {
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
        white-space: nowrap;
        transition: all .2s ease;
    }

    .reseller-edit-page .btn-header:hover {
        background: #fff;
        border-color: #fff;
        color: #1A2B5C;
    }

    /* =========================
       CARD
    ========================= */
    .reseller-edit-page .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    .reseller-edit-page .card-header-custom {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .reseller-edit-page .card-header-custom h5 {
        margin: 0;
        color: #1A2B5C;
        font-weight: 700;
        font-size: 1rem;
    }

    .reseller-edit-page .card-body-custom {
        padding: 22px;
    }

    /* =========================
       FORM
    ========================= */
    .reseller-edit-page .form-group {
        margin-bottom: 18px;
    }

    .reseller-edit-page .form-label-custom {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: .8rem;
        font-weight: 600;
    }

    .reseller-edit-page .form-control-custom,
    .reseller-edit-page .form-select-custom {
        width: 100%;
        min-height: 42px;
        padding: 9px 12px;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        background: #fff;
        color: #344054;
        font-size: .82rem;
        outline: none;
        transition: all .2s ease;
    }

    .reseller-edit-page textarea.form-control-custom {
        min-height: 110px;
        resize: vertical;
    }

    .reseller-edit-page .form-control-custom:focus,
    .reseller-edit-page .form-select-custom:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46, 91, 156, .1);
    }

    .reseller-edit-page .form-text-custom {
        color: #8a94a3;
        font-size: .72rem;
        line-height: 1.5;
    }

    .reseller-edit-page .invalid-feedback-custom {
        margin-top: 5px;
        color: #b42318;
        font-size: .72rem;
    }

    /* =========================
       BUTTONS
    ========================= */
    .reseller-edit-page .btn-primary-custom,
    .reseller-edit-page .btn-outline-custom,
    .reseller-edit-page .btn-danger-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border-radius: 8px;
        padding: 9px 14px;
        font-size: .76rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
        cursor: pointer;
    }

    .reseller-edit-page .btn-primary-custom {
        background: #2E5B9C;
        border: 1px solid #2E5B9C;
        color: #fff;
    }

    .reseller-edit-page .btn-primary-custom:hover {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
    }

    .reseller-edit-page .btn-outline-custom {
        background: #edf3fb;
        border: 1px solid #d7e3f3;
        color: #2E5B9C;
    }

    .reseller-edit-page .btn-outline-custom:hover {
        background: #e2ecf8;
        color: #1A2B5C;
    }

    .reseller-edit-page .btn-danger-custom {
        background: #fdeaea;
        border: 1px solid #f5d0ce;
        color: #b42318;
    }

    .reseller-edit-page .btn-danger-custom:hover {
        background: #b42318;
        border-color: #b42318;
        color: #fff;
    }

    /* =========================
       FORM ACTION
    ========================= */
    .reseller-edit-page .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        padding-top: 5px;
    }

    /* =========================
       SUMMARY
    ========================= */
    .reseller-edit-page .summary-box {
        background: #f8faff;
        border: 1px solid #e9edf5;
        border-radius: 12px;
        padding: 16px;
    }

    .reseller-edit-page .summary-item {
        padding-bottom: 13px;
        margin-bottom: 13px;
        border-bottom: 1px solid #e5eaf1;
    }

    .reseller-edit-page .summary-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: 0;
    }

    .reseller-edit-page .summary-label {
        color: #8a94a3;
        font-size: .7rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .reseller-edit-page .summary-value {
        color: #1A2B5C;
        font-size: .84rem;
        font-weight: 700;
        word-break: break-word;
    }

    .reseller-edit-page .package-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #edf3fb;
        color: #2E5B9C;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
    }

    /* =========================
       STATUS BADGE
    ========================= */
    .reseller-edit-page .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
    }

    .reseller-edit-page .status-active {
        background: #e8f7ee;
        color: #18794e;
    }

    .reseller-edit-page .status-inactive {
        background: #fdeaea;
        color: #b42318;
    }

    .reseller-edit-page .status-pending {
        background: #fff4d6;
        color: #8a6800;
    }

    /* =========================
       DANGER ZONE
    ========================= */
    .reseller-edit-page .danger-zone {
        border: 1px solid #f2c7c7;
        border-radius: 14px;
        background: #fffafa;
        overflow: hidden;
    }

    .reseller-edit-page .danger-header {
        padding: 14px 16px;
        background: #fff5f5;
        border-bottom: 1px solid #f2c7c7;
        color: #b42318;
        font-size: .82rem;
        font-weight: 700;
    }

    .reseller-edit-page .danger-body {
        padding: 16px;
    }

    .reseller-edit-page .danger-text {
        margin: 0 0 14px;
        color: #667085;
        font-size: .76rem;
        line-height: 1.6;
    }

    /* =========================
       ALERT
    ========================= */
    .reseller-edit-page .alert-custom {
        border-radius: 12px;
        font-size: .8rem;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 767.98px) {

        .reseller-edit-page .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .reseller-edit-page .page-header h2 {
            font-size: 1.35rem;
        }

        .reseller-edit-page .card-body-custom {
            padding: 18px;
        }

        .reseller-edit-page .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .reseller-edit-page .form-actions a,
        .reseller-edit-page .form-actions button {
            width: 100%;
        }

        .reseller-edit-page .btn-header {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush


@section('content')

<div class="container-fluid reseller-edit-page">

    {{-- =========================
         PAGE HEADER
    ========================== --}}
    <div class="page-header">

        <div class="page-header-content">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>

                    <h2>
                        <i class="bi bi-person-gear me-2"></i>
                        Edit Reseller
                    </h2>

                    <p>
                        Kelola informasi, paket, status, dan akses akun reseller.
                    </p>

                </div>

                {{-- KEMBALI KE MANAJEMEN RESELLER --}}
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


    {{-- =========================
         SUCCESS MESSAGE
    ========================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-3 alert-custom" role="alert">

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
         ERROR MESSAGE
    ========================== --}}
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show rounded-3 alert-custom" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ $errors->first() }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="row g-4">

        {{-- =====================================================
             LEFT COLUMN
        ====================================================== --}}
        <div class="col-lg-8">


            {{-- =========================
                 INFORMASI RESELLER
            ========================== --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-person-vcard me-2"></i>
                        Informasi Reseller
                    </h5>

                </div>


                <div class="card-body-custom">

                    <form
                        action="{{ route('admin.resellers.update', $user) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="row">

                            {{-- NAMA --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Nama Lengkap
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control-custom"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                    >

                                    @error('name')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control-custom"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                    >

                                    @error('email')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- NOMOR TELEPON --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Nomor Telepon
                                    </label>

                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control-custom"
                                        value="{{ old('phone', $user->phone) }}"
                                    >

                                    @error('phone')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Status
                                    </label>

                                    <select
                                        name="status"
                                        class="form-select-custom"
                                        required
                                    >

                                        <option
                                            value="active"
                                            {{ old('status', $user->status) === 'active' ? 'selected' : '' }}
                                        >
                                            Aktif
                                        </option>

                                        <option
                                            value="inactive"
                                            {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}
                                        >
                                            Nonaktif
                                        </option>

                                        <option
                                            value="pending"
                                            {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}
                                        >
                                            Pending
                                        </option>

                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- PAKET --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Paket Reseller
                                    </label>

                                    <select
                                        name="package_id"
                                        class="form-select-custom"
                                        required
                                    >

                                        @foreach($packages as $package)

                                            <option
                                                value="{{ $package->id }}"
                                                {{ old('package_id', $user->reseller?->package_id) == $package->id ? 'selected' : '' }}
                                            >
                                                {{ $package->name }}
                                                — Diskon {{ $package->discount_percentage }}%
                                                — Minimal {{ $package->min_purchase }} buku
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('package_id')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- ALAMAT --}}
                            <div class="col-12">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Alamat
                                    </label>

                                    <textarea
                                        name="address"
                                        class="form-control-custom"
                                        rows="4"
                                    >{{ old('address', $user->address) }}</textarea>

                                    @error('address')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- ACTION --}}
                        <div class="form-actions">

                            <a
                                href="{{ route('admin.resellers.index') }}"
                                class="btn-outline-custom"
                            >
                                <i class="bi bi-arrow-left"></i>
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="btn-primary-custom"
                            >
                                <i class="bi bi-check-lg"></i>
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- =========================
                 RESET PASSWORD
            ========================== --}}
            <div class="card-custom mt-4">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-key me-2"></i>
                        Reset Password
                    </h5>

                </div>


                <div class="card-body-custom">

                    <p class="form-text-custom mb-3">
                        Gunakan fitur ini jika reseller lupa password.
                        Password baru harus terdiri dari minimal 8 karakter.
                    </p>


                    <form
                        action="{{ route('admin.resellers.reset-password', $user) }}"
                        method="POST"
                    >

                        @csrf


                        <div class="row">

                            {{-- PASSWORD BARU --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Password Baru
                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control-custom"
                                        minlength="8"
                                        required
                                    >

                                    @error('password')
                                        <div class="invalid-feedback-custom">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- KONFIRMASI --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="form-label-custom">
                                        Konfirmasi Password
                                    </label>

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control-custom"
                                        minlength="8"
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        <button
                            type="submit"
                            class="btn-primary-custom"
                        >
                            <i class="bi bi-shield-lock"></i>
                            Reset Password
                        </button>

                    </form>

                </div>

            </div>


            {{-- =========================
                 DANGER ZONE
            ========================== --}}
            <div class="danger-zone mt-4">

                <div class="danger-header">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Zona Berbahaya
                </div>


                <div class="danger-body">

                    <p class="danger-text">
                        Menghapus reseller bersifat permanen.
                        Jika reseller sudah memiliki riwayat transaksi,
                        sistem akan mencegah penghapusan untuk menjaga
                        riwayat data transaksi.
                    </p>


                    <form
                        action="{{ route('admin.resellers.destroy', $user) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus reseller ini? Data yang terkait akan dihapus secara permanen.')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn-danger-custom"
                        >
                            <i class="bi bi-trash"></i>
                            Hapus Reseller
                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
             RIGHT COLUMN
        ====================================================== --}}
        <div class="col-lg-4">


            {{-- =========================
                 RINGKASAN RESELLER
            ========================== --}}
            <div class="card-custom">

                <div class="card-header-custom">

                    <h5>
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Ringkasan Reseller
                    </h5>

                </div>


                <div class="card-body-custom">

                    <div class="summary-box">


                        {{-- NAMA --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Nama
                            </div>

                            <div class="summary-value">
                                {{ $user->name }}
                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Email
                            </div>

                            <div class="summary-value">
                                {{ $user->email }}
                            </div>

                        </div>


                        {{-- NOMOR TELEPON --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Nomor Telepon
                            </div>

                            <div class="summary-value">
                                {{ $user->phone ?? '-' }}
                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Status
                            </div>

                            <div class="summary-value">

                                @if($user->status === 'active')

                                    <span class="status-badge status-active">
                                        Aktif
                                    </span>

                                @elseif($user->status === 'inactive')

                                    <span class="status-badge status-inactive">
                                        Nonaktif
                                    </span>

                                @else

                                    <span class="status-badge status-pending">
                                        Pending
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- PAKET --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Paket
                            </div>

                            <div class="summary-value">

                                @if($user->reseller?->package)

                                    <span class="package-badge">
                                        <i class="bi bi-box"></i>
                                        {{ $user->reseller->package->name }}
                                    </span>

                                @else

                                    -

                                @endif

                            </div>

                        </div>


                        {{-- TANGGAL BERGABUNG --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Bergabung
                            </div>

                            <div class="summary-value">
                                {{ $user->reseller?->join_date?->format('d/m/Y') ?? '-' }}
                            </div>

                        </div>


                        {{-- TOTAL PEMBELIAN --}}
                        <div class="summary-item">

                            <div class="summary-label">
                                Total Pembelian
                            </div>

                            <div class="summary-value">
                                Rp {{ number_format($user->reseller?->total_purchase ?? 0, 0, ',', '.') }}
                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection