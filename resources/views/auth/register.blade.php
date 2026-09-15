<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Reseller - Cyber Media Teknologi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --primary: #1A2B5C;
            --primary-light: #2E5B9C;
            --gold: #C9A84C;
            --bg: #f5f7fb;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e2e7ef;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--text);

            background:
                radial-gradient(
                    circle at top left,
                    rgba(46, 91, 156, .15),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #f5f7fb 0%,
                    #eef2f8 100%
                );
        }

        /* =========================================================
           WRAPPER
        ========================================================= */

        .register-wrapper {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 15px;
        }

        /* =========================================================
           CARD
        ========================================================= */

        .register-card {
            width: 100%;
            max-width: 1100px;

            background: #fff;

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(26, 43, 92, .15);

            display: flex;
        }

        /* =========================================================
           LEFT SIDE
        ========================================================= */

        .register-info {
            width: 40%;

            padding: 50px;

            color: #fff;

            background:
                linear-gradient(
                    145deg,
                    var(--primary),
                    var(--primary-light)
                );

            position: relative;

            overflow: hidden;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-info::before {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border: 1px solid rgba(255,255,255,.12);

            border-radius: 50%;

            top: -120px;
            right: -120px;
        }

        .register-info::after {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border: 1px solid rgba(201,168,76,.20);

            border-radius: 50%;

            bottom: -110px;
            left: -100px;
        }

        .brand {
            position: relative;
            z-index: 2;

            margin-bottom: 50px;
        }

        .brand-name {
            font-size: 25px;
            font-weight: 800;

            margin-bottom: 5px;
        }

        .brand-subtitle {
            font-size: 12px;
            color: rgba(255,255,255,.68);
        }

        .register-info-content {
            position: relative;
            z-index: 2;
        }

        .register-info-content h1 {
            font-size: 32px;
            line-height: 1.25;

            font-weight: 800;

            margin-bottom: 18px;
        }

        .register-info-content > p {
            font-size: 14px;
            line-height: 1.7;

            color: rgba(255,255,255,.78);

            margin-bottom: 35px;
        }

        /* =========================================================
           BENEFITS
        ========================================================= */

        .benefit {
            display: flex;
            align-items: flex-start;

            gap: 13px;

            margin-bottom: 22px;
        }

        .benefit-icon {
            width: 36px;
            height: 36px;

            min-width: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: rgba(255,255,255,.12);

            font-weight: 800;
            font-size: 14px;
        }

        .benefit-title {
            font-size: 13px;
            font-weight: 700;

            margin-bottom: 4px;
        }

        .benefit-text {
            font-size: 11px;
            line-height: 1.55;

            color: rgba(255,255,255,.65);
        }

        /* =========================================================
           RIGHT SIDE
        ========================================================= */

        .register-form {
            width: 60%;

            padding: 45px 50px;
        }

        .form-header {
            margin-bottom: 25px;
        }

        .form-header h2 {
            color: var(--primary);

            font-size: 27px;
            font-weight: 800;

            margin-bottom: 7px;
        }

        .form-header p {
            margin: 0;

            color: var(--muted);

            font-size: 13px;
        }

        /* =========================================================
           SECTION
        ========================================================= */

        .section-title {
            color: var(--primary-light);

            font-size: 11px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .08em;

            margin-top: 25px;
            margin-bottom: 13px;

            padding-bottom: 8px;

            border-bottom: 1px solid #edf0f4;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-label {
            color: #374151;

            font-size: 12px;
            font-weight: 700;

            margin-bottom: 6px;
        }

        .required {
            color: #dc3545;
        }

        .form-control,
        .form-select {
            min-height: 44px;

            border: 1px solid var(--border);

            border-radius: 9px;

            padding: 9px 12px;

            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-light);

            box-shadow:
                0 0 0 3px rgba(46,91,156,.10);
        }

        textarea.form-control {
            min-height: 82px;

            resize: vertical;
        }

        /* =========================================================
           PACKAGE
        ========================================================= */

        .package-wrapper {
            position: relative;
        }

        .package-radio {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }

        .package-card {
            display: block;

            height: 100%;

            padding: 16px;

            border: 1px solid var(--border);

            border-radius: 12px;

            background: #fff;

            cursor: pointer;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease,
                background .2s ease;
        }

        .package-card:hover {
            border-color: var(--primary-light);

            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(26,43,92,.08);
        }

        .package-radio:checked + .package-card {
            border-color: var(--primary-light);

            background: #f4f7fc;

            box-shadow:
                0 0 0 2px rgba(46,91,156,.10);
        }

        .package-radio:checked + .package-card::after {
            content: "✓";

            position: absolute;

            top: 10px;
            right: 10px;

            width: 22px;
            height: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--primary-light);

            color: #fff;

            font-size: 11px;
            font-weight: 800;
        }

        .package-name {
            color: var(--primary);

            font-size: 14px;
            font-weight: 800;

            margin-bottom: 8px;
        }

        .package-discount {
            display: inline-block;

            padding: 4px 8px;

            border-radius: 20px;

            background: rgba(201,168,76,.14);

            color: #80621d;

            font-size: 10px;
            font-weight: 800;

            margin-bottom: 8px;
        }

        .package-min {
            color: var(--muted);

            font-size: 10px;

            line-height: 1.5;
        }

        /* =========================================================
           ALERT
        ========================================================= */

        .alert {
            border-radius: 10px;

            font-size: 12px;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-register {
            width: 100%;

            min-height: 47px;

            border: 0;

            border-radius: 10px;

            background: var(--primary);

            color: #fff;

            font-size: 13px;
            font-weight: 700;

            transition: all .2s ease;
        }

        .btn-register:hover {
            background: var(--primary-light);

            color: #fff;

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(26,43,92,.18);
        }

        /* =========================================================
           LOGIN LINK
        ========================================================= */

        .login-link {
            text-align: center;

            margin-top: 17px;

            color: var(--muted);

            font-size: 12px;
        }

        .login-link a {
            color: var(--primary-light);

            font-weight: 700;

            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .register-card {
                max-width: 700px;

                flex-direction: column;
            }

            .register-info,
            .register-form {
                width: 100%;
            }

            .register-info {
                padding: 35px;
            }

            .register-form {
                padding: 35px;
            }

            .brand {
                margin-bottom: 30px;
            }

            .register-info-content h1 {
                font-size: 27px;
            }
        }

        @media (max-width: 576px) {

            .register-wrapper {
                padding: 15px;
            }

            .register-card {
                border-radius: 17px;
            }

            .register-info {
                padding: 28px 22px;
            }

            .register-form {
                padding: 28px 22px;
            }

            .register-info-content h1 {
                font-size: 24px;
            }

            .form-header h2 {
                font-size: 23px;
            }

            .package-card {
                padding: 14px;
            }
        }
    </style>
</head>

<body>

<div class="register-wrapper">

    <div class="register-card">

        {{-- =====================================================
             LEFT INFORMATION
        ====================================================== --}}

        <div class="register-info">

            <div class="brand">
                <div class="brand-name">
                    Cyber Media
                </div>

                <div class="brand-subtitle">
                    PT Cyber Media Teknologi
                </div>
            </div>

            <div class="register-info-content">

                <h1>
                    Bergabung Sebagai Reseller
                </h1>

                <p>
                    Dapatkan harga khusus reseller dan kembangkan
                    bisnis penjualan buku Anda bersama
                    PT Cyber Media Teknologi.
                </p>

                <div class="benefit">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <div class="benefit-title">
                            Harga Khusus Reseller
                        </div>

                        <div class="benefit-text">
                            Nikmati potongan harga berdasarkan
                            tingkat reseller Anda.
                        </div>
                    </div>

                </div>

                <div class="benefit">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <div class="benefit-title">
                            Paket Bertingkat
                        </div>

                        <div class="benefit-text">
                            Mulai dari Starter hingga Distributor
                            sesuai perkembangan pembelian Anda.
                        </div>
                    </div>

                </div>

                <div class="benefit">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>
                        <div class="benefit-title">
                            Upgrade Otomatis
                        </div>

                        <div class="benefit-text">
                            Tingkat reseller akan meningkat secara
                            otomatis berdasarkan akumulasi pembelian.
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             RIGHT FORM
        ====================================================== --}}

        <div class="register-form">

            <div class="form-header">

                <h2>
                    Daftar Reseller
                </h2>

                <p>
                    Lengkapi informasi berikut untuk mengajukan
                    pendaftaran reseller.
                </p>

            </div>


            {{-- VALIDATION ERROR --}}

            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Data belum dapat diproses.
                    </strong>

                    <ul class="mb-0 mt-2 ps-3">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('register') }}"
            >

                @csrf


                {{-- =================================================
                     INFORMASI PRIBADI
                ================================================== --}}

                <div class="section-title">
                    Informasi Pribadi
                </div>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label
                            for="name"
                            class="form-label"
                        >
                            Nama Lengkap
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap"
                            required
                            autofocus
                        >

                        @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="email"
                            class="form-label"
                        >
                            Email
                            <span class="required">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="contoh@email.com"
                            required
                        >

                        @error('email')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="phone"
                            class="form-label"
                        >
                            Nomor Telepon
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="08xxxxxxxxxx"
                            required
                        >

                        @error('phone')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-12">

                        <label
                            for="address"
                            class="form-label"
                        >
                            Alamat Lengkap
                            <span class="required">*</span>
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="Masukkan alamat lengkap"
                            required
                        >{{ old('address') }}</textarea>

                        @error('address')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     KEAMANAN AKUN
                ================================================== --}}

                <div class="section-title">
                    Keamanan Akun
                </div>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label
                            for="password"
                            class="form-label"
                        >
                            Password
                            <span class="required">*</span>
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter"
                            required
                        >

                        @error('password')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label
                            for="password_confirmation"
                            class="form-label"
                        >
                            Konfirmasi Password
                            <span class="required">*</span>
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password"
                            required
                        >

                    </div>

                </div>


                {{-- =================================================
                     PAKET RESELLER
                ================================================== --}}

                <div class="section-title">
                    Pilih Paket Reseller
                </div>

                <div class="row g-3">

                    @foreach ($packages as $package)

                        <div class="col-md-4 package-wrapper">

                            <input
                                type="radio"
                                id="package_{{ $package->id }}"
                                name="package_id"
                                value="{{ $package->id }}"
                                class="package-radio"
                                {{ old('package_id') == $package->id ? 'checked' : '' }}
                                required
                            >

                            <label
                                for="package_{{ $package->id }}"
                                class="package-card"
                            >

                                <div class="package-name">
                                    {{ $package->name }}
                                </div>

                                <div class="package-discount">
                                    Diskon {{ $package->discount_percentage }}%
                                </div>

                                <div class="package-min">
                                    Minimal pembelian awal
                                    <strong>
                                        {{ number_format($package->min_purchase, 0, ',', '.') }}
                                        buku
                                    </strong>
                                </div>

                            </label>

                        </div>

                    @endforeach

                </div>

                @error('package_id')

                    <div class="text-danger mt-2" style="font-size: 12px;">
                        {{ $message }}
                    </div>

                @enderror


                {{-- =================================================
                     SUBMIT
                ================================================== --}}

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn-register"
                    >
                        Daftar Sebagai Reseller
                    </button>

                </div>

            </form>


            <div class="login-link">

                Sudah memiliki akun?

                <a href="{{ route('login') }}">
                    Masuk ke akun
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>