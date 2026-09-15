```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title') - PT Cyber Media Teknologi
        @else
            PT Cyber Media Teknologi
        @endif
    </title>

    <meta name="description"
        content="Sistem Reseller Buku PT Cyber Media Teknologi">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- SweetAlert2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css"
        rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --cyber-primary: #1A2B5C;
            --cyber-secondary: #2E5B9C;
            --cyber-gold: #C9A84C;
            --cyber-light: #F5F7FB;
            --cyber-white: #FFFFFF;
            --cyber-dark: #172033;
            --cyber-text: #4B5563;
            --cyber-border: #E5E7EB;
            --cyber-sidebar-width: 260px;
            --cyber-navbar-height: 70px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--cyber-light);
            color: var(--cyber-text);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* ========================================
           NAVBAR
        ======================================== */

        .cyber-navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--cyber-sidebar-width);
            height: var(--cyber-navbar-height);
            z-index: 1030;

            display: flex;
            align-items: center;

            background: var(--cyber-white);
            border-bottom: 1px solid var(--cyber-border);

            padding: 0 24px;

            transition: left 0.3s ease;
        }

        .cyber-navbar-brand {
            display: none;
            align-items: center;
            gap: 10px;

            color: var(--cyber-primary);
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 700;
        }

        .cyber-navbar-brand:hover {
            color: var(--cyber-secondary);
        }

        .cyber-navbar-toggle {
            width: 40px;
            height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 0;
            border-radius: 10px;

            background: transparent;
            color: var(--cyber-primary);

            font-size: 21px;
        }

        .cyber-navbar-toggle:hover {
            background: var(--cyber-light);
        }

        .cyber-navbar-spacer {
            flex: 1;
        }

        .cyber-user-menu {
            position: relative;
        }

        .cyber-user-button {
            display: flex;
            align-items: center;
            gap: 10px;

            border: 0;
            background: transparent;

            padding: 5px 8px;
            border-radius: 12px;

            color: var(--cyber-dark);
        }

        .cyber-user-button:hover {
            background: var(--cyber-light);
        }

        /* ========================================
           USER AVATAR
        ======================================== */

        .cyber-user-avatar {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;

            background: var(--cyber-primary);
            color: var(--cyber-white);

            font-size: 16px;
            font-weight: 700;
        }

        .cyber-user-avatar img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;
            object-position: center;
        }

        .cyber-user-info {
            text-align: left;
            line-height: 1.3;
        }

        .cyber-user-name {
            display: block;

            color: var(--cyber-dark);
            font-size: 13px;
            font-weight: 700;
        }

        .cyber-user-role {
            display: block;

            color: var(--cyber-text);
            font-size: 11px;
        }

        /* ========================================
           SIDEBAR
        ======================================== */

        .cyber-sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;

            width: var(--cyber-sidebar-width);
            z-index: 1040;

            display: flex;
            flex-direction: column;

            background: var(--cyber-primary);
            color: var(--cyber-white);

            overflow-y: auto;

            transition: transform 0.3s ease;
        }

        .cyber-sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .cyber-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .cyber-logo {
            height: var(--cyber-navbar-height);

            display: flex;
            align-items: center;
            gap: 12px;

            padding: 0 22px;

            color: var(--cyber-white);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);

            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            font-weight: 700;
        }

        .cyber-logo:hover {
            color: var(--cyber-white);
        }

        .cyber-logo-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: var(--cyber-gold);
            color: var(--cyber-primary);

            font-size: 19px;
        }

        .cyber-sidebar-content {
            flex: 1;
            padding: 20px 14px;
        }

        .cyber-sidebar-section {
            margin-bottom: 22px;
        }

        .cyber-sidebar-title {
            padding: 0 12px;
            margin-bottom: 8px;

            color: rgba(255, 255, 255, 0.5);

            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .cyber-sidebar-link {
            position: relative;

            display: flex;
            align-items: center;
            gap: 12px;

            width: 100%;

            padding: 11px 13px;
            margin-bottom: 3px;

            border-radius: 10px;

            color: rgba(255, 255, 255, 0.78);

            font-size: 13px;
            font-weight: 500;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }

        .cyber-sidebar-link i {
            width: 20px;

            text-align: center;

            font-size: 17px;
        }

        .cyber-sidebar-link:hover {
            background: rgba(255, 255, 255, 0.09);
            color: var(--cyber-white);
            transform: translateX(2px);
        }

        .cyber-sidebar-link.active {
            background: var(--cyber-secondary);
            color: var(--cyber-white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        .cyber-sidebar-link.active::before {
            content: '';

            position: absolute;
            left: 0;

            width: 3px;
            height: 20px;

            border-radius: 0 4px 4px 0;

            background: var(--cyber-gold);
        }

        .cyber-sidebar-footer {
            padding: 15px 14px;

            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cyber-logout-button {
            width: 100%;

            display: flex;
            align-items: center;
            gap: 12px;

            padding: 11px 13px;

            border: 0;
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.78);

            font-size: 13px;
            font-weight: 500;

            transition: all 0.2s ease;
        }

        .cyber-logout-button:hover {
            background: rgba(255, 255, 255, 0.12);
            color: var(--cyber-white);
        }

        /* ========================================
           MAIN CONTENT
        ======================================== */

        .cyber-main {
            min-height: 100vh;

            margin-left: var(--cyber-sidebar-width);
            padding-top: var(--cyber-navbar-height);

            transition: margin-left 0.3s ease;
        }

        .cyber-content {
            min-height: calc(100vh - var(--cyber-navbar-height));

            padding: 28px;
        }

        /* ========================================
           PAGE HEADER
        ======================================== */

        .cyber-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 24px;
        }

        .cyber-page-title {
            margin: 0;

            color: var(--cyber-dark);

            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 700;
        }

        .cyber-page-subtitle {
            margin: 5px 0 0;

            color: #6B7280;
            font-size: 13px;
        }

        /* ========================================
           CARD
        ======================================== */

        .cyber-card {
            background: var(--cyber-white);

            border: 1px solid var(--cyber-border);
            border-radius: 14px;

            box-shadow: 0 3px 15px rgba(15, 23, 42, 0.04);
        }

        .cyber-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 18px 20px;

            border-bottom: 1px solid var(--cyber-border);
        }

        .cyber-card-title {
            margin: 0;

            color: var(--cyber-dark);

            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
        }

        .cyber-card-body {
            padding: 20px;
        }

        /* ========================================
           BUTTON
        ======================================== */

        .btn-cyber-primary {
            background: var(--cyber-primary);
            border-color: var(--cyber-primary);
            color: var(--cyber-white);
        }

        .btn-cyber-primary:hover,
        .btn-cyber-primary:focus {
            background: var(--cyber-secondary);
            border-color: var(--cyber-secondary);
            color: var(--cyber-white);
        }

        .btn-cyber-gold {
            background: var(--cyber-gold);
            border-color: var(--cyber-gold);
            color: var(--cyber-primary);
            font-weight: 600;
        }

        .btn-cyber-gold:hover,
        .btn-cyber-gold:focus {
            filter: brightness(0.94);
            color: var(--cyber-primary);
        }

        /* ========================================
           ALERT
        ======================================== */

        .cyber-alert {
            border: 0;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
        }

        /* ========================================
           FOOTER
        ======================================== */

        .cyber-footer {
            padding: 18px 28px;

            background: var(--cyber-white);

            border-top: 1px solid var(--cyber-border);

            color: #6B7280;

            font-size: 12px;
        }

        /* ========================================
           MOBILE OVERLAY
        ======================================== */

        .cyber-sidebar-overlay {
            display: none;

            position: fixed;
            inset: 0;

            z-index: 1035;

            background: rgba(15, 23, 42, 0.45);
        }

        /* ========================================
           ANIMATION
        ======================================== */

        .cyber-fade-in {
            animation: cyberFadeIn 0.45s ease both;
        }

        @keyframes cyberFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================
           RESPONSIVE
        ======================================== */

        @media (max-width: 991.98px) {

            .cyber-navbar {
                left: 0;
            }

            .cyber-navbar-brand {
                display: inline-flex;
            }

            .cyber-sidebar {
                transform: translateX(-100%);
            }

            .cyber-sidebar.show {
                transform: translateX(0);
            }

            .cyber-sidebar-overlay.show {
                display: block;
            }

            .cyber-main {
                margin-left: 0;
            }

            .cyber-content {
                padding: 22px 18px;
            }

            .cyber-user-info {
                display: none;
            }
        }

        @media (max-width: 575.98px) {

            .cyber-navbar {
                padding: 0 12px;
            }

            .cyber-navbar-brand {
                font-size: 15px;
            }

            .cyber-navbar-brand .cyber-logo-icon {
                width: 34px;
                height: 34px;
            }

            .cyber-content {
                padding: 18px 12px;
            }

            .cyber-page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            .cyber-page-title {
                font-size: 20px;
            }

            .cyber-card-body {
                padding: 15px;
            }

            .cyber-footer {
                padding: 16px 12px;
                text-align: center;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ========================================
         SIDEBAR
    ======================================== -->

    <aside class="cyber-sidebar" id="cyberSidebar">

        <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : route('reseller.dashboard')) : route('landing') }}"
            class="cyber-logo">

            <span class="cyber-logo-icon">
                <i class="bi bi-book-half"></i>
            </span>

            <span>
                Cyber Media
            </span>

        </a>

        <div class="cyber-sidebar-content">

            @auth

                {{-- =====================================
                     ADMIN MENU
                ====================================== --}}

                @if(auth()->user()->isAdmin())

                    <div class="cyber-sidebar-section">

                        <div class="cyber-sidebar-title">
                            Utama
                        </div>

                        <a href="{{ route('admin.dashboard') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>

                        </a>

                    </div>


                    <div class="cyber-sidebar-section">

                        <div class="cyber-sidebar-title">
                            Manajemen
                        </div>

                        <a href="{{ route('admin.resellers.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('admin.resellers.*') ? 'active' : '' }}">

                            <i class="bi bi-people-fill"></i>
                            <span>Reseller</span>

                        </a>

                        <a href="{{ route('admin.products.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

                            <i class="bi bi-book-fill"></i>
                            <span>Produk Buku</span>

                        </a>

                        <a href="{{ route('admin.orders.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

                            <i class="bi bi-cart-check-fill"></i>
                            <span>Pesanan</span>

                        </a>

                        <a href="{{ route('admin.payments.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">

                            <i class="bi bi-credit-card-fill"></i>
                            <span>Pembayaran</span>

                        </a>

                        <a href="{{ route('admin.reports.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">

                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Laporan</span>

                        </a>

                    </div>

                {{-- =====================================
                     RESELLER MENU
                ====================================== --}}

                @elseif(auth()->user()->isReseller())

                    <div class="cyber-sidebar-section">

                        <div class="cyber-sidebar-title">
                            Utama
                        </div>

                        <a href="{{ route('reseller.dashboard') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('reseller.dashboard') ? 'active' : '' }}">

                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>

                        </a>

                    </div>


                    <div class="cyber-sidebar-section">

                        <div class="cyber-sidebar-title">
                            Belanja
                        </div>

                        <a href="{{ route('reseller.catalog.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('reseller.catalog.*') ? 'active' : '' }}">

                            <i class="bi bi-book-fill"></i>
                            <span>Katalog Buku</span>

                        </a>

                        <a href="{{ route('reseller.cart.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('reseller.cart.*') ? 'active' : '' }}">

                            <i class="bi bi-cart-fill"></i>
                            <span>Keranjang</span>

                        </a>

                        <a href="{{ route('reseller.orders.index') }}"
                            class="cyber-sidebar-link {{ request()->routeIs('reseller.orders.*') || request()->routeIs('reseller.payment.*') ? 'active' : '' }}">

                            <i class="bi bi-receipt-cutoff"></i>
                            <span>Pesanan Saya</span>

                        </a>

                    </div>

                @endif

            @endauth

        </div>


        @auth

            <div class="cyber-sidebar-footer">

                <form action="{{ route('logout') }}" method="POST" id="cyberLogoutForm">
                    @csrf

                    <button type="button"
                        class="cyber-logout-button"
                        onclick="confirmLogout()">

                        <i class="bi bi-box-arrow-right"></i>

                        <span>
                            Keluar
                        </span>

                    </button>

                </form>

            </div>

        @endauth

    </aside>


    <!-- Sidebar Overlay -->
    <div class="cyber-sidebar-overlay" id="cyberSidebarOverlay"></div>


    <!-- ========================================
         NAVBAR
    ======================================== -->

    <header class="cyber-navbar">

        <button type="button"
            class="cyber-navbar-toggle"
            id="cyberSidebarToggle"
            aria-label="Buka menu">

            <i class="bi bi-list"></i>

        </button>


        <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : route('reseller.dashboard')) : route('landing') }}"
            class="cyber-navbar-brand">

            <span class="cyber-logo-icon">
                <i class="bi bi-book-half"></i>
            </span>

            <span>
                Cyber Media
            </span>

        </a>


        <div class="cyber-navbar-spacer"></div>


        @auth

            <div class="dropdown cyber-user-menu">

                <button class="cyber-user-button dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <!-- ========================================
                         USER AVATAR
                    ======================================== -->

                    <span class="cyber-user-avatar">

                        @if(auth()->user()->profile_photo)

                            <img
                                src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                alt="Foto profil {{ auth()->user()->name }}"
                            >

                        @else

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        @endif

                    </span>


                    <span class="cyber-user-info">

                        <span class="cyber-user-name">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="cyber-user-role">
                            {{ auth()->user()->isAdmin() ? 'Administrator' : 'Reseller' }}
                        </span>

                    </span>

                </button>


                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">

                    <li>

                        <span class="dropdown-item-text">

                            <strong>
                                {{ auth()->user()->name }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                {{ auth()->user()->email }}
                            </small>

                        </span>

                    </li>


                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>

                        <button type="button"
                            class="dropdown-item text-danger"
                            onclick="confirmLogout()">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Keluar

                        </button>

                    </li>

                </ul>

            </div>

        @endauth

    </header>


    <!-- ========================================
         MAIN
    ======================================== -->

    <main class="cyber-main">

        <div class="cyber-content cyber-fade-in">

            {{-- Validation errors --}}
            @if($errors->any())

                <div class="alert alert-danger cyber-alert mb-4">

                    <div class="d-flex gap-2">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        <div>

                            <strong>
                                Terjadi kesalahan.
                            </strong>

                            <ul class="mb-0 mt-1">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Flash success --}}
            @if(session('success'))

                <div class="alert alert-success cyber-alert mb-4">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- Flash status --}}
            @if(session('status'))

                <div class="alert alert-info cyber-alert mb-4">

                    <i class="bi bi-info-circle-fill me-2"></i>

                    {{ session('status') }}

                </div>

            @endif


            @yield('content')

        </div>


        <!-- ========================================
             FOOTER
        ======================================== -->

        <footer class="cyber-footer">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                <span>

                    &copy; {{ date('Y') }}

                    <strong>
                        PT Cyber Media Teknologi
                    </strong>.

                    Semua hak dilindungi.

                </span>

                <span>
                    Sistem Reseller Buku
                </span>

            </div>

        </footer>

    </main>


    <!-- ========================================
         JAVASCRIPT
    ======================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const sidebar = document.getElementById('cyberSidebar');
            const toggle = document.getElementById('cyberSidebarToggle');
            const overlay = document.getElementById('cyberSidebarOverlay');

            if (toggle && sidebar && overlay) {

                toggle.addEventListener('click', function () {

                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');

                });

                overlay.addEventListener('click', function () {

                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');

                });

            }

        });


        function confirmLogout() {

            Swal.fire({

                title: 'Keluar dari sistem?',

                text: 'Anda akan keluar dari akun ini.',

                icon: 'question',

                showCancelButton: true,

                confirmButtonText: 'Ya, Keluar',

                cancelButtonText: 'Batal',

                reverseButtons: true,

                confirmButtonColor: '#1A2B5C',

                cancelButtonColor: '#6B7280'

            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('cyberLogoutForm').submit();

                }

            });

        }


        @if(session('success'))

            Swal.fire({

                icon: 'success',

                title: 'Berhasil',

                text: @json(session('success')),

                timer: 2500,

                timerProgressBar: true,

                showConfirmButton: false

            });

        @endif


        @if(session('error'))

            Swal.fire({

                icon: 'error',

                title: 'Gagal',

                text: @json(session('error')),

                confirmButtonText: 'OK',

                confirmButtonColor: '#1A2B5C'

            });

        @endif

    </script>

    @stack('scripts')

</body>

</html>
```
