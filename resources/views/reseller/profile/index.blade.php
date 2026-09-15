@extends('layouts.cyber-master')

@section('title', 'Profil Saya')

@push('styles')
<style>
    .profile-page {
        padding-bottom: 40px;
    }

    /* =========================================================
       COLOR SYSTEM
    ========================================================= */

    .profile-page {
        --navy: #1A2B5C;
        --blue: #2E5B9C;
        --blue-light: #edf3fb;
        --blue-border: #d7e3f3;
        --border: #e9edf5;
        --border-soft: #edf0f5;
        --text: #273449;
        --text-secondary: #475467;
        --muted: #687587;
        --muted-light: #7c8796;
        --gold: #C9A84C;
        --success-bg: #e8f7ee;
        --success-text: #18794e;
        --danger-bg: #fdeaea;
        --danger-text: #b42318;
        --warning-bg: #fff4d6;
        --warning-text: #8a6800;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .profile-page .page-header-custom {
        background: linear-gradient(
            135deg,
            #1A2B5C 0%,
            #2E5B9C 100%
        );

        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .profile-page .page-header-custom::after {
        content: '';
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -55px;
        top: -75px;
    }

    .profile-page .page-header-content {
        position: relative;
        z-index: 1;
    }

    .profile-page .page-header-custom h2 {
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 6px;
    }

    .profile-page .page-header-custom p {
        margin: 0;
        opacity: .85;
        font-size: .88rem;
    }

    .profile-page .header-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 9px;
        color: #fff;
        border: 1px solid rgba(255,255,255,.35);
        background: rgba(255,255,255,.10);
        text-decoration: none;
        font-size: .8rem;
        font-weight: 600;
        transition: .2s ease;
    }

    .profile-page .header-back-btn:hover {
        color: #fff;
        background: rgba(255,255,255,.18);
        border-color: rgba(255,255,255,.5);
    }


    /* =========================================================
       CARD
    ========================================================= */

    .profile-page .card-custom {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .profile-page .card-header-custom {
        padding: 18px 22px;
        border-bottom: 1px solid var(--border-soft);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .profile-page .card-header-content {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .profile-page .card-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 11px;
        background: var(--blue-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .profile-page .card-header-icon.gold {
        background: rgba(201,168,76,.12);
        color: var(--gold);
    }

    .profile-page .card-header-icon.danger {
        background: var(--danger-bg);
        color: var(--danger-text);
    }

    .profile-page .card-header-custom h5 {
        margin: 0 0 3px;
        color: var(--navy);
        font-weight: 700;
        font-size: 1rem;
    }

    .profile-page .card-header-custom p {
        margin: 0;
        color: var(--muted);
        font-size: .76rem;
    }

    .profile-page .card-body-custom {
        padding: 22px;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .profile-page .alert-custom {
        border-radius: 12px;
        padding: 13px 15px;
        font-size: .82rem;
        margin-bottom: 20px;
        border: 1px solid transparent;
    }

    .profile-page .alert-success-custom {
        background: var(--success-bg);
        border-color: #c9ead7;
        color: var(--success-text);
    }

    .profile-page .alert-danger-custom {
        background: var(--danger-bg);
        border-color: #f3c8c8;
        color: var(--danger-text);
    }

    .profile-page .alert-danger-custom ul {
        color: var(--danger-text);
    }


    /* =========================================================
       FORM
    ========================================================= */

    .profile-page .form-label-custom {
        display: block;
        font-size: .8rem;
        font-weight: 600;
        color: #344054;
        margin-bottom: 7px;
    }

    .profile-page .form-control,
    .profile-page .form-select {
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        color: var(--text-secondary);
        font-size: .82rem;
        min-height: 43px;
        box-shadow: none;
    }

    .profile-page textarea.form-control {
        min-height: auto;
        resize: vertical;
    }

    .profile-page .form-control::placeholder {
        color: #a0a8b4;
    }

    .profile-page .form-control:focus,
    .profile-page .form-select:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 .2rem rgba(46,91,156,.12);
    }

    .profile-page .input-group-custom {
        display: flex;
        width: 100%;
    }

    .profile-page .input-icon {
        width: 43px;
        min-width: 43px;
        min-height: 43px;
        border: 1px solid #dfe4ec;
        border-right: none;
        border-radius: 10px 0 0 10px;
        background: #f8faff;
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-page .input-group-custom .form-control {
        border-radius: 0 10px 10px 0;
    }

    .profile-page .form-control.is-invalid {
        border-color: #dc3545;
    }


    /* =========================================================
       PROFILE PHOTO
    ========================================================= */

    .profile-page .photo-box {
        background: #f8faff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
    }

    .profile-page .photo-layout {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .profile-page .profile-photo-wrapper {
        width: 110px;
        height: 110px;
        flex-shrink: 0;
    }

    .profile-page .profile-photo,
    .profile-page .profile-initial {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-page .profile-photo {
        border: 4px solid #fff;
        box-shadow: 0 4px 15px rgba(26,43,92,.10);
    }

    .profile-page .profile-initial {
        background: var(--blue);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        font-weight: 700;
        border: 4px solid #fff;
        box-shadow: 0 4px 15px rgba(26,43,92,.10);
    }

    .profile-page .photo-info {
        flex: 1;
        min-width: 0;
    }

    .profile-page .photo-info h6 {
        color: var(--navy);
        font-weight: 700;
        margin-bottom: 6px;
    }

    .profile-page .photo-info p {
        color: var(--muted);
        font-size: .78rem;
        margin-bottom: 13px;
        line-height: 1.5;
    }

    .profile-page .file-name {
        color: var(--blue);
        font-size: .76rem;
        font-weight: 600;
        margin-top: 8px;
    }

    .profile-page .file-info {
        color: var(--muted-light);
        font-size: .74rem;
        margin-top: 8px;
    }

    .profile-page .file-info i {
        color: var(--blue);
    }


    /* =========================================================
       BUTTON
    ========================================================= */

    .profile-page .btn-primary-custom {
        background: var(--blue);
        border: 1px solid var(--blue);
        color: #fff;
        border-radius: 9px;
        font-weight: 600;
        font-size: .82rem;
        padding: 9px 15px;
        transition: .2s ease;
    }

    .profile-page .btn-primary-custom:hover {
        background: var(--navy);
        border-color: var(--navy);
        color: #fff;
    }

    .profile-page .btn-outline-custom {
        background: #fff;
        border: 1px solid var(--blue-border);
        color: var(--blue);
        border-radius: 9px;
        font-weight: 600;
        font-size: .82rem;
        padding: 9px 15px;
        transition: .2s ease;
    }

    .profile-page .btn-outline-custom:hover {
        background: var(--blue-light);
        border-color: #c5d7ed;
        color: var(--navy);
    }

    .profile-page .btn-danger-custom {
        background: #fff;
        border: 1px solid #f0c8c5;
        color: var(--danger-text);
        border-radius: 9px;
        font-weight: 600;
        font-size: .78rem;
        padding: 8px 13px;
        transition: .2s ease;
    }

    .profile-page .btn-danger-custom:hover {
        background: var(--danger-bg);
        border-color: #e9aaa5;
        color: #a51d13;
    }

    .profile-page .btn-gold-custom {
        background: var(--gold);
        border: 1px solid var(--gold);
        color: #fff;
        border-radius: 9px;
        font-weight: 600;
        font-size: .8rem;
        padding: 9px 15px;
    }

    .profile-page .btn-gold-custom:hover {
        background: #b8953e;
        border-color: #b8953e;
        color: #fff;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .profile-page .status-field {
        min-height: 43px;
        background: #f8faff;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
    }

    .profile-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 700;
        background: var(--success-bg);
        color: var(--success-text);
    }


    /* =========================================================
       RESELLER INFO
    ========================================================= */

    .profile-page .reseller-profile {
        text-align: center;
        padding-bottom: 18px;
        margin-bottom: 18px;
        border-bottom: 1px solid var(--border-soft);
    }

    .profile-page .reseller-avatar {
        width: 76px;
        height: 76px;
        margin: 0 auto 12px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 12px rgba(26,43,92,.08);
    }

    .profile-page .reseller-avatar-initial {
        width: 76px;
        height: 76px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: var(--blue-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
    }

    .profile-page .reseller-profile h5 {
        color: var(--navy);
        font-weight: 700;
        margin-bottom: 3px;
    }

    .profile-page .reseller-profile small {
        color: var(--muted);
        font-size: .76rem;
    }

    .profile-page .reseller-stat {
        background: #f8faff;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 13px 14px;
        margin-bottom: 10px;
        transition: .2s ease;
    }

    .profile-page .reseller-stat:hover {
        border-color: var(--blue-border);
        background: #fbfcff;
    }

    .profile-page .reseller-stat:last-child {
        margin-bottom: 0;
    }

    .profile-page .reseller-stat-content {
        min-width: 0;
    }

    .profile-page .reseller-stat-label {
        display: block;
        color: var(--muted-light);
        font-size: .72rem;
        margin-bottom: 3px;
    }

    .profile-page .reseller-stat-value {
        display: block;
        color: var(--text);
        font-size: .88rem;
        font-weight: 700;
    }

    .profile-page .reseller-stat-value.blue {
        color: var(--blue);
    }

    .profile-page .reseller-stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: var(--blue-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }


    /* =========================================================
       JOIN DATE
    ========================================================= */

    .profile-page .join-date-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
    }

    .profile-page .join-date-icon {
        width: 44px;
        height: 44px;
        border-radius: 11px;
        background: rgba(201,168,76,.12);
        color: var(--gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .profile-page .join-date-label {
        display: block;
        color: var(--muted);
        font-size: .72rem;
        margin-bottom: 3px;
    }

    .profile-page .join-date-value {
        color: var(--navy);
        font-size: .88rem;
        font-weight: 700;
    }


    /* =========================================================
       SECURITY
    ========================================================= */

    .profile-page .password-info {
        background: var(--blue-light);
        border: 1px solid var(--blue-border);
        border-radius: 11px;
        padding: 12px 14px;
        color: #31577f;
        font-size: .78rem;
    }

    .profile-page .password-info i {
        color: var(--blue);
    }

    .profile-page .password-info strong {
        color: var(--navy);
    }


    /* =========================================================
       ERROR
    ========================================================= */

    .profile-page .field-error {
        color: var(--danger-text);
        font-size: .74rem;
        margin-top: 5px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {

        .profile-page .photo-layout {
            align-items: flex-start;
        }

    }

    @media (max-width: 767.98px) {

        .profile-page .page-header-custom {
            padding: 22px;
            border-radius: 16px;
        }

        .profile-page .page-header-custom h2 {
            font-size: 1.35rem;
        }

        .profile-page .page-header-actions {
            width: 100%;
        }

        .profile-page .header-back-btn {
            width: 100%;
            justify-content: center;
        }

        .profile-page .card-header-custom,
        .profile-page .card-body-custom {
            padding: 18px;
        }

        .profile-page .photo-layout {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-page .photo-info {
            width: 100%;
        }

        .profile-page .profile-photo-wrapper {
            margin: 0 auto;
        }

        .profile-page .photo-info .btn {
            width: auto;
        }

        .profile-page .status-field {
            min-height: 43px;
        }

        .profile-page .join-date-card {
            padding: 18px;
        }

    }
</style>
@endpush


@section('content')

<div class="container-fluid profile-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="page-header-custom">

        <div class="page-header-content">

            <div class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-md-center
                        gap-3">

                <div>

                    <h2>
                        Profil Saya
                    </h2>

                    <p>
                        Kelola informasi akun dan keamanan akun reseller Anda.
                    </p>

                </div>

                <div class="page-header-actions">

                    <a
                        href="{{ route('reseller.dashboard') }}"
                        class="header-back-btn"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Dashboard
                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FLASH SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div
            class="alert-custom alert-success-custom alert-dismissible fade show"
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


    {{-- =========================================================
         VALIDATION ERROR
    ========================================================== --}}

    @if($errors->any())

        <div
            class="alert-custom alert-danger-custom alert-dismissible fade show"
            role="alert"
        >

            <div class="fw-semibold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                Terjadi kesalahan:

            </div>

            <ul class="mb-0 ps-4">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
         MAIN GRID
    ========================================================== --}}

    <div class="row g-4">


        {{-- =====================================================
             LEFT COLUMN
        ====================================================== --}}

        <div class="col-xl-8">

            <div class="card-custom">

                {{-- CARD HEADER --}}

                <div class="card-header-custom">

                    <div class="card-header-content">

                        <div class="card-header-icon">

                            <i class="bi bi-person"></i>

                        </div>

                        <div>

                            <h5>
                                Informasi Akun
                            </h5>

                            <p>
                                Informasi dasar akun reseller Anda.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- CARD BODY --}}

                <div class="card-body-custom">

                    <form
                        action="{{ route('reseller.profile.update') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')


                        <div class="row g-3">


                            {{-- =================================================
                                 FOTO PROFIL
                            ================================================== --}}

                            <div class="col-12">

                                <div class="photo-box">

                                    <div class="photo-layout">


                                        {{-- FOTO / AVATAR --}}

                                        <div class="profile-photo-wrapper">

                                            @if($user->profile_photo)

                                                <img
                                                    src="{{ asset('storage/' . $user->profile_photo) }}"
                                                    alt="Foto Profil {{ $user->name }}"
                                                    id="profilePreview"
                                                    class="profile-photo"
                                                >

                                            @else

                                                <div
                                                    id="profileInitial"
                                                    class="profile-initial"
                                                >

                                                    {{ collect(explode(' ', trim($user->name)))
                                                        ->filter()
                                                        ->take(2)
                                                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                        ->implode('') }}

                                                </div>

                                                <img
                                                    src=""
                                                    alt="Preview Foto Profil"
                                                    id="profilePreview"
                                                    class="profile-photo d-none"
                                                >

                                            @endif

                                        </div>


                                        {{-- INFORMASI FOTO --}}

                                        <div class="photo-info">

                                            <h6>
                                                Foto Profil
                                            </h6>

                                            <p>
                                                Gunakan foto profil yang jelas agar akun
                                                Anda lebih mudah dikenali.
                                            </p>


                                            {{-- FILE INPUT --}}

                                            <div>

                                                <label
                                                    for="profile_photo"
                                                    class="btn btn-primary-custom"
                                                >

                                                    <i class="bi bi-camera me-1"></i>

                                                    {{ $user->profile_photo
                                                        ? 'Ganti Foto'
                                                        : 'Pilih Foto' }}

                                                </label>

                                                <input
                                                    type="file"
                                                    class="d-none @error('profile_photo') is-invalid @enderror"
                                                    id="profile_photo"
                                                    name="profile_photo"
                                                    accept=".jpg,.jpeg,.png,.webp"
                                                >

                                            </div>


                                            {{-- INFO FILE --}}

                                            <div class="file-info">

                                                <i class="bi bi-info-circle me-1"></i>

                                                JPG, JPEG, PNG, atau WEBP.
                                                Maksimal 2 MB.

                                            </div>


                                            {{-- NAMA FILE --}}

                                            <div
                                                id="selectedFileName"
                                                class="file-name d-none"
                                            >
                                            </div>


                                            {{-- HAPUS FOTO --}}

                                            @if($user->profile_photo)

                                                <div class="mt-3">

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger-custom"
                                                        id="removePhotoButton"
                                                    >

                                                        <i class="bi bi-trash me-1"></i>

                                                        Hapus Foto

                                                    </button>

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                @error('profile_photo')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                 NAMA
                            ================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="name"
                                    class="form-label-custom"
                                >
                                    Nama Lengkap
                                </label>

                                <div class="input-group-custom">

                                    <span class="input-icon">

                                        <i class="bi bi-person"></i>

                                    </span>

                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="Masukkan nama lengkap"
                                        required
                                    >

                                </div>

                                @error('name')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                 EMAIL
                            ================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="email"
                                    class="form-label-custom"
                                >
                                    Email
                                </label>

                                <div class="input-group-custom">

                                    <span class="input-icon">

                                        <i class="bi bi-envelope"></i>

                                    </span>

                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="Masukkan email"
                                        required
                                    >

                                </div>

                                @error('email')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                 PHONE
                            ================================================== --}}

                            <div class="col-md-6">

                                <label
                                    for="phone"
                                    class="form-label-custom"
                                >
                                    Nomor HP
                                </label>

                                <div class="input-group-custom">

                                    <span class="input-icon">

                                        <i class="bi bi-telephone"></i>

                                    </span>

                                    <input
                                        type="text"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="Contoh: 08123456789"
                                        required
                                    >

                                </div>

                                @error('phone')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                 STATUS
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label-custom">
                                    Status Akun
                                </label>

                                <div class="status-field">

                                    <span class="status-badge">

                                        <i class="bi bi-check-circle"></i>

                                        Aktif

                                    </span>

                                </div>

                            </div>


                            {{-- =================================================
                                 ALAMAT
                            ================================================== --}}

                            <div class="col-12">

                                <label
                                    for="address"
                                    class="form-label-custom"
                                >
                                    Alamat
                                </label>

                                <textarea
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    name="address"
                                    rows="4"
                                    placeholder="Masukkan alamat lengkap"
                                    required
                                >{{ old('address', $user->address) }}</textarea>

                                @error('address')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- =================================================
                                 BUTTON SIMPAN
                            ================================================== --}}

                            <div class="col-12 pt-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary-custom"
                                >

                                    <i class="bi bi-check-lg me-1"></i>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
             RIGHT COLUMN
        ====================================================== --}}

        <div class="col-xl-4">


            {{-- =================================================
                 INFORMASI RESELLER
            ================================================== --}}

            <div class="card-custom">

                <div class="card-header-custom">

                    <div>

                        <h5>
                            Informasi Reseller
                        </h5>

                        <p>
                            Detail paket reseller Anda.
                        </p>

                    </div>

                </div>


                <div class="card-body-custom">


                    {{-- AVATAR --}}

                    <div class="reseller-profile">

                        @if($user->profile_photo)

                            <img
                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                alt="Foto Profil {{ $user->name }}"
                                class="reseller-avatar"
                            >

                        @else

                            <div class="reseller-avatar-initial">

                                {{ collect(explode(' ', trim($user->name)))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                    ->implode('') }}

                            </div>

                        @endif

                        <h5>
                            {{ $user->name }}
                        </h5>

                        <small>
                            {{ $user->email }}
                        </small>

                    </div>


                    {{-- PACKAGE --}}

                    <div class="reseller-stat">

                        <div class="d-flex justify-content-between align-items-center gap-3">

                            <div class="reseller-stat-content">

                                <span class="reseller-stat-label">
                                    Paket Saat Ini
                                </span>

                                <span class="reseller-stat-value">
                                    {{ $user->reseller?->package?->name ?? 'Belum Ada' }}
                                </span>

                            </div>

                            <div class="reseller-stat-icon">

                                <i class="bi bi-box-seam"></i>

                            </div>

                        </div>

                    </div>


                    {{-- DISCOUNT --}}

                    <div class="reseller-stat">

                        <div class="d-flex justify-content-between align-items-center gap-3">

                            <div class="reseller-stat-content">

                                <span class="reseller-stat-label">
                                    Diskon
                                </span>

                                <span class="reseller-stat-value blue">
                                    {{ $user->reseller?->package?->discount_percentage ?? 0 }}%
                                </span>

                            </div>

                            <div class="reseller-stat-icon">

                                <i class="bi bi-percent"></i>

                            </div>

                        </div>

                    </div>


                    {{-- MINIMUM PURCHASE --}}

                    <div class="reseller-stat">

                        <div class="d-flex justify-content-between align-items-center gap-3">

                            <div class="reseller-stat-content">

                                <span class="reseller-stat-label">
                                    Minimum Pembelian
                                </span>

                                <span class="reseller-stat-value">
                                    {{ $user->reseller?->package?->min_purchase ?? 0 }}
                                    Buku
                                </span>

                            </div>

                            <div class="reseller-stat-icon">

                                <i class="bi bi-cart-check"></i>

                            </div>

                        </div>

                    </div>


                    {{-- TOTAL PURCHASE --}}

                    <div class="reseller-stat">

                        <div class="d-flex justify-content-between align-items-center gap-3">

                            <div class="reseller-stat-content">

                                <span class="reseller-stat-label">
                                    Total Pembelian
                                </span>

                                <span class="reseller-stat-value">
                                    {{ $user->reseller?->total_purchase ?? 0 }}
                                    Buku
                                </span>

                            </div>

                            <div class="reseller-stat-icon">

                                <i class="bi bi-book"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 JOIN DATE
            ================================================== --}}

            <div class="join-date-card">

                <div class="d-flex align-items-center gap-3">

                    <div class="join-date-icon">

                        <i class="bi bi-calendar-check"></i>

                    </div>

                    <div>

                        <span class="join-date-label">
                            Bergabung Sejak
                        </span>

                        <span class="join-date-value">

                            @if($user->reseller?->join_date)

                                {{ $user->reseller->join_date->format('d F Y') }}

                            @else

                                -

                            @endif

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SECURITY
        ====================================================== --}}

        <div class="col-12">

            <div class="card-custom">

                <div class="card-header-custom">

                    <div class="card-header-content">

                        <div class="card-header-icon danger">

                            <i class="bi bi-shield-lock"></i>

                        </div>

                        <div>

                            <h5>
                                Keamanan Akun
                            </h5>

                            <p>
                                Ubah password untuk menjaga keamanan akun Anda.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="card-body-custom">

                    <form
                        action="{{ route('reseller.profile.password.update') }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="row g-3">


                            {{-- PASSWORD LAMA --}}

                            <div class="col-md-4">

                                <label
                                    for="current_password"
                                    class="form-label-custom"
                                >
                                    Password Lama
                                </label>

                                <input
                                    type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password"
                                    name="current_password"
                                    placeholder="Masukkan password lama"
                                    required
                                >

                                @error('current_password')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- PASSWORD BARU --}}

                            <div class="col-md-4">

                                <label
                                    for="password"
                                    class="form-label-custom"
                                >
                                    Password Baru
                                </label>

                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                    minlength="8"
                                    required
                                >

                                @error('password')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- KONFIRMASI --}}

                            <div class="col-md-4">

                                <label
                                    for="password_confirmation"
                                    class="form-label-custom"
                                >
                                    Konfirmasi Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Ulangi password baru"
                                    minlength="8"
                                    required
                                >

                            </div>


                            {{-- INFO PASSWORD --}}

                            <div class="col-12">

                                <div class="password-info">

                                    <div class="d-flex align-items-start">

                                        <i class="bi bi-info-circle me-2 mt-1"></i>

                                        <div>

                                            Password baru harus memiliki minimal
                                            <strong>8 karakter</strong>.

                                            Pastikan Anda mengingat password baru
                                            sebelum menyimpan perubahan.

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- BUTTON --}}

                            <div class="col-12 pt-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary-custom"
                                >

                                    <i class="bi bi-key me-1"></i>

                                    Ubah Password

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT FOTO PROFIL
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const photoInput = document.getElementById('profile_photo');
    const preview = document.getElementById('profilePreview');
    const initial = document.getElementById('profileInitial');
    const selectedFileName = document.getElementById('selectedFileName');
    const removePhotoButton = document.getElementById('removePhotoButton');


    /*
    |--------------------------------------------------------------------------
    | PREVIEW FOTO
    |--------------------------------------------------------------------------
    */

    if (photoInput) {

        photoInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | VALIDASI UKURAN CLIENT
            |--------------------------------------------------------------------------
            */

            const maxSize = 2 * 1024 * 1024;

            if (file.size > maxSize) {

                alert('Ukuran foto maksimal 2 MB.');

                photoInput.value = '';

                if (selectedFileName) {
                    selectedFileName.classList.add('d-none');
                }

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | VALIDASI TIPE FILE
            |--------------------------------------------------------------------------
            */

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {

                alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');

                photoInput.value = '';

                if (selectedFileName) {
                    selectedFileName.classList.add('d-none');
                }

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | TAMPILKAN NAMA FILE
            |--------------------------------------------------------------------------
            */

            if (selectedFileName) {

                selectedFileName.textContent =
                    'File dipilih: ' + file.name;

                selectedFileName.classList.remove('d-none');

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIEW IMAGE
            |--------------------------------------------------------------------------
            */

            const reader = new FileReader();

            reader.onload = function (e) {

                if (preview) {

                    preview.src = e.target.result;

                    preview.classList.remove('d-none');

                }


                if (initial) {

                    initial.classList.add('d-none');

                }

            };

            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS FOTO PROFIL
    |--------------------------------------------------------------------------
    */

    if (removePhotoButton) {

        removePhotoButton.addEventListener('click', function () {

            const confirmed = confirm(
                'Apakah Anda yakin ingin menghapus foto profil?'
            );


            if (!confirmed) {
                return;
            }


            const form = document.createElement('form');

            form.method = 'POST';

            form.action =
                "{{ route('reseller.profile.photo.remove') }}";


            const csrf = document.createElement('input');

            csrf.type = 'hidden';

            csrf.name = '_token';

            csrf.value =
                "{{ csrf_token() }}";


            const method = document.createElement('input');

            method.type = 'hidden';

            method.name = '_method';

            method.value = 'DELETE';


            form.appendChild(csrf);

            form.appendChild(method);


            document.body.appendChild(form);

            form.submit();

        });

    }

});

</script>

@endsection