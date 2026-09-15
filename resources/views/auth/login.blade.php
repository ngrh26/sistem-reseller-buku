<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cyber Media Teknologi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1A2B5C;
            --primary-light: #2E5B9C;
            --gold: #C9A84C;
            --bg: #f5f7fb;
            --text: #1f2937;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(46, 91, 156, .15), transparent 35%),
                linear-gradient(135deg, #f5f7fb 0%, #eef2f8 100%);
            color: var(--text);
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .auth-card {
            width: 100%;
            max-width: 1050px;
            min-height: 600px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(26, 43, 92, .15);
            display: flex;
        }

        .auth-brand {
            width: 45%;
            background: linear-gradient(145deg, var(--primary), var(--primary-light));
            color: white;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-brand::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .auth-brand::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 50%;
            bottom: -90px;
            left: -80px;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
            margin-bottom: 25px;
        }

        .brand-title {
            font-size: 34px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .brand-description {
            color: rgba(255,255,255,.78);
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 14px;
            color: rgba(255,255,255,.9);
        }

        .feature-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(201,168,76,.2);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .auth-form {
            width: 55%;
            padding: 55px;
            display: flex;
            align-items: center;
        }

        .form-container {
            width: 100%;
            max-width: 430px;
            margin: auto;
        }

        .form-title {
            font-size: 30px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            height: 50px;
            border: 1px solid #d9dee8;
            border-radius: 10px;
            padding: 0 15px;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(46,91,156,.1);
        }

        .btn-login {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            font-weight: 700;
            transition: .2s ease;
        }

        .btn-login:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
        }

        .remember {
            font-size: 14px;
            color: #6b7280;
        }

        .auth-link {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 700;
        }

        .auth-link:hover {
            color: var(--primary);
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                min-height: auto;
            }

            .auth-brand,
            .auth-form {
                width: 100%;
            }

            .auth-brand {
                padding: 40px 30px;
            }

            .auth-form {
                padding: 40px 30px;
            }

            .brand-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-brand">
            <div class="brand-content">
                <div class="brand-logo">CM</div>

                <div class="brand-title">
                    Cyber Media<br>
                    Teknologi
                </div>

                <p class="brand-description">
                    Platform reseller buku untuk membantu mitra mengembangkan
                    bisnis dengan sistem yang mudah, terstruktur, dan terpercaya.
                </p>

                <div class="brand-feature">
                    <div class="feature-icon">✓</div>
                    <span>Harga khusus reseller</span>
                </div>

                <div class="brand-feature">
                    <div class="feature-icon">✓</div>
                    <span>Pilihan paket reseller fleksibel</span>
                </div>

                <div class="brand-feature">
                    <div class="feature-icon">✓</div>
                    <span>Pengelolaan pesanan terintegrasi</span>
                </div>
            </div>
        </div>

        <div class="auth-form">
            <div class="form-container">

                <div class="form-title">Selamat Datang</div>

                <p class="form-subtitle">
                    Silakan masuk ke akun Anda untuk melanjutkan.
                </p>

                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <strong>Login gagal.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            autocomplete="email"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <label class="remember d-flex align-items-center gap-2">
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                            >
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn-login">
                        Masuk
                    </button>
                </form>

                <div class="text-center mt-4">
                    <span class="text-muted small">
                        Belum memiliki akun?
                    </span>
                    <a href="{{ route('register') }}" class="auth-link small">
                        Daftar sebagai Reseller
                    </a>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('landing') }}" class="text-muted small text-decoration-none">
                        ← Kembali ke halaman utama
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>