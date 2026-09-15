<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PT Cyber Media Teknologi | Program Reseller Buku</title>

    <meta
        name="description"
        content="Program reseller buku PT Cyber Media Teknologi dengan keuntungan diskon hingga 30%."
    >

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --primary: #1A2B5C;
            --primary-light: #2E5B9C;
            --primary-soft: #eef4ff;

            --gold: #C9A84C;
            --gold-light: #e8d59a;

            --dark: #14203d;
            --text: #4d5870;
            --muted: #7b8498;

            --white: #ffffff;
            --light: #f7f9fc;
            --border: #e6eaf1;

            --shadow-sm: 0 8px 25px rgba(26, 43, 92, 0.07);
            --shadow-md: 0 18px 50px rgba(26, 43, 92, 0.12);
            --shadow-lg: 0 30px 80px rgba(26, 43, 92, 0.16);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--white);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1180px;
        }


        /* =========================================
           NAVBAR
        ========================================= */

        .main-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;

            z-index: 1000;

            padding: 17px 0;

            background: rgba(255, 255, 255, 0.90);

            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            border-bottom: 1px solid rgba(26, 43, 92, 0.06);

            transition:
                padding 0.35s ease,
                background 0.35s ease,
                box-shadow 0.35s ease;
        }

        .main-navbar.scrolled {
            padding: 10px 0;

            background: rgba(255, 255, 255, 0.97);

            box-shadow:
                0 8px 30px rgba(26, 43, 92, 0.09);
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }


        /* BRAND */

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;

            color: var(--primary);

            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 800;

            white-space: nowrap;

            transition: transform 0.25s ease;
        }

        .navbar-brand:hover {
            color: var(--primary);
            transform: translateY(-1px);
        }

        .brand-icon {
            width: 43px;
            height: 43px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--primary-light)
                );

            box-shadow:
                0 8px 20px rgba(26, 43, 92, 0.20);

            transition:
                width 0.35s ease,
                height 0.35s ease,
                border-radius 0.35s ease;
        }

        .main-navbar.scrolled .brand-icon {
            width: 38px;
            height: 38px;

            border-radius: 11px;
        }

        .brand-icon i {
            font-size: 21px;
        }


        /* DESKTOP NAVIGATION */

        .navbar-navigation {
            display: flex;
            align-items: center;
            gap: 4px;

            margin-left: auto;
            margin-right: 24px;
        }

        .nav-item-custom {
            position: relative;
        }

        .nav-link-custom {
            position: relative;

            display: inline-flex;
            align-items: center;

            padding: 10px 12px;

            color: #59637a;

            font-size: 13px;
            font-weight: 600;

            white-space: nowrap;

            transition:
                color 0.25s ease,
                transform 0.25s ease;
        }

        .nav-link-custom::after {
            content: '';

            position: absolute;

            left: 12px;
            right: 12px;
            bottom: 4px;

            height: 2px;

            border-radius: 999px;

            background: var(--primary-light);

            transform: scaleX(0);
            transform-origin: center;

            transition: transform 0.25s ease;
        }

        .nav-link-custom:hover {
            color: var(--primary);
        }

        .nav-link-custom:hover::after {
            transform: scaleX(1);
        }


        /* NAVBAR ACTIONS */

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .navbar-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 10px 17px;

            border: 1px solid rgba(26, 43, 92, 0.16);
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.7);

            color: var(--primary);

            font-size: 13px;
            font-weight: 700;

            transition:
                background 0.25s ease,
                color 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .navbar-login:hover {
            background: var(--primary);

            border-color: var(--primary);

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px rgba(26, 43, 92, 0.15);
        }

        .navbar-register {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 11px 18px;

            border-radius: 10px;

            background: var(--primary);

            color: white;

            font-size: 13px;
            font-weight: 700;

            box-shadow:
                0 8px 20px rgba(26, 43, 92, 0.18);

            transition:
                background 0.25s ease,
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .navbar-register:hover {
            background: var(--primary-light);

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(26, 43, 92, 0.23);
        }

        .navbar-register i {
            font-size: 12px;

            transition: transform 0.25s ease;
        }

        .navbar-register:hover i {
            transform: translateX(3px);
        }


        /* MOBILE TOGGLE */

        .navbar-toggle {
            width: 43px;
            height: 43px;

            display: none;

            align-items: center;
            justify-content: center;

            border: 1px solid #e2e6ee;
            border-radius: 11px;

            background: white;

            color: var(--primary);

            font-size: 23px;
        }


        /* MOBILE MENU */

        .mobile-menu {
            display: none;
        }


        /* =========================================
           HERO
        ========================================= */

        .hero-section {
            position: relative;
            min-height: 760px;

            padding-top: 160px;
            padding-bottom: 100px;

            overflow: hidden;

            background:
                radial-gradient(
                    circle at 85% 25%,
                    rgba(46, 91, 156, 0.12),
                    transparent 30%
                ),
                linear-gradient(
                    180deg,
                    #f7faff 0%,
                    #ffffff 100%
                );
        }

        .hero-grid {
            position: absolute;
            inset: 0;

            opacity: 0.45;

            background-image:
                linear-gradient(
                    rgba(26, 43, 92, 0.035) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(26, 43, 92, 0.035) 1px,
                    transparent 1px
                );

            background-size: 60px 60px;

            mask-image: linear-gradient(
                to bottom,
                black,
                transparent
            );
        }

        .hero-content {
            position: relative;
            z-index: 5;

            animation: heroFadeUp 0.9s ease both;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 8px 14px;

            margin-bottom: 23px;

            border: 1px solid rgba(201, 168, 76, 0.3);
            border-radius: 999px;

            background: rgba(255, 255, 255, 0.8);

            color: #806720;

            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        .hero-badge i {
            font-size: 14px;
        }

        .hero-title {
            max-width: 720px;

            margin-bottom: 24px;

            font-size: clamp(38px, 5vw, 64px);
            line-height: 1.12;

            font-weight: 800;
            letter-spacing: -1.8px;

            color: var(--dark);
        }

        .hero-title span {
            color: var(--primary-light);
        }

        .hero-description {
            max-width: 610px;

            margin-bottom: 34px;

            color: #687289;

            font-size: 17px;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 13px;

            margin-bottom: 42px;
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            padding: 14px 23px;

            border-radius: 11px;

            background: var(--primary);
            color: white;

            font-size: 14px;
            font-weight: 700;

            box-shadow: 0 12px 25px rgba(26, 43, 92, 0.2);

            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: var(--primary-light);
            color: white;

            transform: translateY(-3px);

            box-shadow: 0 17px 30px rgba(26, 43, 92, 0.25);
        }

        .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            padding: 14px 23px;

            border: 1px solid #dce2ed;
            border-radius: 11px;

            background: white;
            color: var(--primary);

            font-size: 14px;
            font-weight: 700;

            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);

            transform: translateY(-3px);

            box-shadow: var(--shadow-sm);
        }

        .hero-trust {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 22px;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 8px;

            color: #70798e;

            font-size: 12px;
            font-weight: 600;
        }

        .trust-item i {
            color: var(--gold);
            font-size: 16px;
        }


        /* HERO VISUAL */

        .hero-visual {
            position: relative;

            min-height: 470px;

            animation: heroVisual 1s ease 0.15s both;
        }

        .hero-orbit {
            position: absolute;

            width: 440px;
            height: 440px;

            top: 10px;
            right: 20px;

            border: 1px solid rgba(46, 91, 156, 0.1);

            border-radius: 50%;
        }

        .hero-orbit::before {
            content: '';

            position: absolute;

            width: 310px;
            height: 310px;

            top: 65px;
            left: 65px;

            border: 1px dashed rgba(201, 168, 76, 0.3);

            border-radius: 50%;
        }

        .hero-main-card {
            position: absolute;

            width: 300px;

            top: 70px;
            right: 85px;

            padding: 26px;

            border-radius: 28px;

            background: rgba(255, 255, 255, 0.95);

            border: 1px solid rgba(255, 255, 255, 0.8);

            box-shadow: var(--shadow-lg);

            transform: rotate(3deg);

            animation: floatingCard 5s ease-in-out infinite;
        }

        .hero-book-icon {
            width: 72px;
            height: 92px;

            margin-bottom: 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px 15px 15px 10px;

            background:
                linear-gradient(
                    135deg,
                    var(--primary),
                    var(--primary-light)
                );

            color: white;

            box-shadow:
                inset -7px 0 0 rgba(0, 0, 0, 0.12),
                0 15px 25px rgba(26, 43, 92, 0.2);
        }

        .hero-book-icon i {
            font-size: 31px;
        }

        .hero-card-label {
            color: var(--gold);

            font-size: 11px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-card-title {
            margin: 7px 0 10px;

            color: var(--dark);

            font-family: 'Poppins', sans-serif;
            font-size: 21px;
            font-weight: 800;
        }

        .hero-card-text {
            color: #7a8498;

            font-size: 12px;
            line-height: 1.7;
        }

        .floating-card {
            position: absolute;

            display: flex;
            align-items: center;
            gap: 12px;

            padding: 13px 17px;

            border-radius: 15px;

            background: white;

            box-shadow: var(--shadow-md);

            animation: floatingSmall 4s ease-in-out infinite;
        }

        .floating-card-icon {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: var(--primary-soft);

            color: var(--primary-light);
        }

        .floating-card strong {
            display: block;

            color: var(--dark);

            font-size: 13px;
        }

        .floating-card small {
            color: var(--muted);

            font-size: 10px;
        }

        .floating-one {
            top: 65px;
            right: 0;
        }

        .floating-two {
            bottom: 70px;
            left: 25px;

            animation-delay: -1.5s;
        }

        .floating-three {
            right: 30px;
            bottom: 25px;

            animation-delay: -2.5s;
        }

        .hero-decoration {
            position: absolute;

            border-radius: 50%;

            pointer-events: none;
        }

        .decoration-one {
            width: 90px;
            height: 90px;

            left: -35px;
            top: 150px;

            background: rgba(46, 91, 156, 0.07);
        }

        .decoration-two {
            width: 140px;
            height: 140px;

            right: -70px;
            bottom: 80px;

            border: 25px solid rgba(201, 168, 76, 0.07);
        }


        /* =========================================
           STATS
        ========================================= */

        .stats-section {
            position: relative;
            z-index: 10;

            margin-top: -50px;
        }

        .stats-wrapper {
            padding: 30px 35px;

            border-radius: 22px;

            background: white;

            box-shadow: var(--shadow-md);

            border: 1px solid #edf0f5;
        }

        .stat-item {
            text-align: center;

            padding: 5px 20px;
        }

        .stat-number {
            margin-bottom: 4px;

            font-family: 'Poppins', sans-serif;

            color: var(--primary);

            font-size: 30px;
            font-weight: 800;
        }

        .stat-label {
            color: #7a8396;

            font-size: 12px;
            font-weight: 600;
        }


        /* =========================================
           GENERAL SECTION
        ========================================= */

        .section {
            padding: 105px 0;
        }

        .section-soft {
            background: var(--light);
        }

        .section-heading {
            max-width: 700px;

            margin: 0 auto 55px;

            text-align: center;
        }

        .section-eyebrow {
            display: inline-block;

            margin-bottom: 12px;

            color: var(--primary-light);

            font-size: 12px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: 1.7px;
        }

        .section-title {
            margin-bottom: 15px;

            font-size: clamp(29px, 4vw, 43px);

            line-height: 1.2;
            font-weight: 800;

            letter-spacing: -0.8px;
        }

        .section-description {
            margin: 0 auto;

            max-width: 610px;

            color: #7a8498;

            line-height: 1.8;
            font-size: 15px;
        }


        /* =========================================
           FEATURES
        ========================================= */

        .feature-card {
            height: 100%;

            padding: 30px;

            border: 1px solid var(--border);
            border-radius: 20px;

            background: white;

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease,
                border-color 0.35s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);

            border-color: rgba(46, 91, 156, 0.18);

            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            width: 56px;
            height: 56px;

            margin-bottom: 23px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background: var(--primary-soft);

            color: var(--primary-light);

            font-size: 24px;
        }

        .feature-title {
            margin-bottom: 10px;

            font-size: 18px;
            font-weight: 700;
        }

        .feature-text {
            margin: 0;

            color: #7a8498;

            font-size: 13px;
            line-height: 1.8;
        }


        /* =========================================
           PACKAGE
        ========================================= */

        .package-section {
            position: relative;

            overflow: hidden;

            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(46, 91, 156, 0.06),
                    transparent 25%
                ),
                #f7f9fc;
        }

        .package-section::before {
            content: '';

            position: absolute;

            width: 500px;
            height: 500px;

            top: -250px;
            right: -180px;

            border-radius: 50%;

            border: 80px solid rgba(201, 168, 76, 0.035);
        }

        .package-wrapper {
            position: relative;
            z-index: 2;
        }

        .package-card {
            position: relative;

            height: 100%;

            padding: 32px 28px 30px;

            border: 1px solid #e5e9f1;
            border-radius: 25px;

            background: white;

            overflow: hidden;

            transition:
                transform 0.35s ease,
                box-shadow 0.35s ease,
                border-color 0.35s ease;
        }

        .package-card:hover {
            transform: translateY(-10px);

            box-shadow: var(--shadow-lg);

            border-color: rgba(46, 91, 156, 0.2);
        }

        .package-card.popular {
            border: 2px solid var(--primary-light);

            transform: translateY(-12px);

            box-shadow: var(--shadow-lg);
        }

        .package-card.popular:hover {
            transform: translateY(-18px);
        }

        .popular-badge {
            position: absolute;

            top: 0;
            right: 0;

            padding: 8px 17px;

            border-radius: 0 0 0 15px;

            background: var(--primary);

            color: white;

            font-size: 10px;
            font-weight: 800;

            letter-spacing: 0.6px;

            text-transform: uppercase;
        }

        .package-shape {
            position: absolute;

            width: 115px;
            height: 115px;

            top: -50px;
            right: -50px;

            border-radius: 35px;

            transform: rotate(30deg);

            opacity: 0.09;
        }

        .package-starter .package-shape {
            background: var(--primary-light);
        }

        .package-professional .package-shape {
            background: var(--gold);
        }

        .package-distributor .package-shape {
            background: var(--primary);
        }

        .package-top {
            position: relative;
            z-index: 2;

            margin-bottom: 26px;
        }

        .package-icon {
            width: 52px;
            height: 52px;

            margin-bottom: 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;
        }

        .package-starter .package-icon {
            background: #eef4ff;
            color: var(--primary-light);
        }

        .package-professional .package-icon {
            background: #fff8e6;
            color: #a8842c;
        }

        .package-distributor .package-icon {
            background: #edf0f8;
            color: var(--primary);
        }

        .package-name {
            margin-bottom: 5px;

            font-size: 20px;
            font-weight: 800;
        }

        .package-subtitle {
            color: var(--muted);

            font-size: 12px;
        }

        .package-discount {
            margin-bottom: 7px;

            font-family: 'Poppins', sans-serif;

            font-size: 46px;
            line-height: 1;

            font-weight: 800;

            color: var(--primary);
        }

        .package-professional .package-discount {
            color: #a8842c;
        }

        .discount-label {
            color: #8a92a3;

            font-size: 11px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        .package-divider {
            height: 1px;

            margin: 25px 0;

            background: #edf0f4;
        }

        .package-features {
            list-style: none;

            margin: 0 0 28px;
            padding: 0;
        }

        .package-features li {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            margin-bottom: 13px;

            color: #687289;

            font-size: 13px;
            line-height: 1.5;
        }

        .package-features i {
            flex-shrink: 0;

            color: #36a269;

            font-size: 15px;
        }

        .package-minimum {
            padding: 13px 14px;

            margin-bottom: 24px;

            border-radius: 12px;

            background: #f7f9fc;

            color: #69738a;

            font-size: 12px;
            font-weight: 600;
        }

        .package-minimum strong {
            color: var(--dark);
        }

        .package-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            width: 100%;

            padding: 13px 20px;

            border-radius: 11px;

            font-size: 13px;
            font-weight: 700;

            transition: all 0.3s ease;
        }

        .package-starter .package-button,
        .package-distributor .package-button {
            border: 1px solid #dce2ed;

            color: var(--primary);
            background: white;
        }

        .package-starter .package-button:hover,
        .package-distributor .package-button:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .package-professional .package-button {
            background: var(--primary);
            color: white;

            border: 1px solid var(--primary);

            box-shadow: 0 10px 22px rgba(26, 43, 92, 0.18);
        }

        .package-professional .package-button:hover {
            background: var(--primary-light);
            border-color: var(--primary-light);

            transform: translateY(-2px);
        }


        /* =========================================
           HOW IT WORKS
        ========================================= */

        .step-card {
            position: relative;

            text-align: center;

            padding: 15px 25px;
        }

        .step-number {
            width: 62px;
            height: 62px;

            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background: var(--primary);

            color: white;

            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 800;

            box-shadow: 0 12px 25px rgba(26, 43, 92, 0.17);
        }

        .step-title {
            margin-bottom: 9px;

            font-size: 17px;
            font-weight: 700;
        }

        .step-text {
            color: #7b8498;

            font-size: 12px;
            line-height: 1.8;
        }

        .step-line {
            position: absolute;

            top: 46px;
            left: calc(50% + 45px);

            width: calc(100% - 90px);

            height: 1px;

            background: #dfe4ed;
        }


        /* =========================================
           CTA
        ========================================= */

        .cta-section {
            position: relative;

            padding: 90px 0;

            overflow: hidden;

            background: var(--primary);
        }

        .cta-section::before {
            content: '';

            position: absolute;

            width: 500px;
            height: 500px;

            top: -300px;
            left: -150px;

            border-radius: 50%;

            border: 100px solid rgba(255, 255, 255, 0.035);
        }

        .cta-section::after {
            content: '';

            position: absolute;

            width: 350px;
            height: 350px;

            right: -150px;
            bottom: -230px;

            border-radius: 50%;

            background: rgba(201, 168, 76, 0.08);
        }

        .cta-content {
            position: relative;
            z-index: 3;

            text-align: center;
        }

        .cta-title {
            margin-bottom: 17px;

            color: white;

            font-size: clamp(29px, 4vw, 43px);
            font-weight: 800;
        }

        .cta-text {
            max-width: 600px;

            margin: 0 auto 28px;

            color: rgba(255, 255, 255, 0.72);

            font-size: 14px;
            line-height: 1.8;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            padding: 14px 25px;

            border-radius: 11px;

            background: white;
            color: var(--primary);

            font-size: 14px;
            font-weight: 800;

            transition: all 0.3s ease;
        }

        .cta-button:hover {
            color: var(--primary);

            transform: translateY(-3px);

            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.18);
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            padding: 55px 0 25px;

            background: #101b34;

            color: rgba(255, 255, 255, 0.65);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 18px;

            color: white;

            font-family: 'Poppins', sans-serif;
            font-weight: 800;
        }

        .footer-brand-icon {
            width: 37px;
            height: 37px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: rgba(255, 255, 255, 0.1);

            color: var(--gold);
        }

        .footer-description {
            max-width: 360px;

            margin-bottom: 22px;

            font-size: 12px;
            line-height: 1.8;
        }

        .footer-title {
            margin-bottom: 18px;

            color: white;

            font-size: 13px;
            font-weight: 700;
        }

        .footer-links {
            list-style: none;

            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);

            font-size: 12px;

            transition: color 0.25s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            margin-top: 40px;
            padding-top: 20px;

            border-top: 1px solid rgba(255, 255, 255, 0.08);

            text-align: center;

            font-size: 11px;
        }


        /* =========================================
           SCROLL REVEAL
        ========================================= */

        .reveal {
            opacity: 0;

            transform: translateY(30px);

            transition:
                opacity 0.8s ease,
                transform 0.8s ease;
        }

        .reveal.active {
            opacity: 1;

            transform: translateY(0);
        }


        /* =========================================
           ANIMATIONS
        ========================================= */

        @keyframes heroFadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroVisual {
            from {
                opacity: 0;
                transform: translateX(35px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes floatingCard {
            0%,
            100% {
                transform: rotate(3deg) translateY(0);
            }

            50% {
                transform: rotate(3deg) translateY(-12px);
            }
        }

        @keyframes floatingSmall {
            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1199.98px) {

            .navbar-navigation {
                margin-right: 14px;
            }

            .nav-link-custom {
                padding-left: 9px;
                padding-right: 9px;
            }

            .nav-link-custom::after {
                left: 9px;
                right: 9px;
            }

            .navbar-login {
                padding: 9px 13px;
            }

            .navbar-register {
                padding: 10px 14px;
            }
        }


        @media (max-width: 991.98px) {

            .navbar-inner {
                position: relative;
            }

            .navbar-toggle {
                display: flex;
            }

            .navbar-desktop-menu {
                display: none;
            }

            .mobile-menu {
                position: absolute;

                top: calc(100% + 12px);
                left: 0;
                right: 0;

                display: none;

                padding: 15px;

                border: 1px solid #e9edf4;
                border-radius: 18px;

                background: rgba(255, 255, 255, 0.98);

                box-shadow: var(--shadow-md);

                animation: mobileMenuShow 0.25s ease both;
            }

            .mobile-menu.show {
                display: block;
            }

            .mobile-nav-list {
                list-style: none;

                padding: 0;
                margin: 0;
            }

            .mobile-nav-list li {
                margin-bottom: 4px;
            }

            .mobile-nav-link {
                display: flex;
                align-items: center;
                gap: 10px;

                padding: 12px 13px;

                border-radius: 10px;

                color: #59637a;

                font-size: 14px;
                font-weight: 600;

                transition:
                    background 0.25s ease,
                    color 0.25s ease;
            }

            .mobile-nav-link:hover {
                background: var(--primary-soft);
                color: var(--primary);
            }

            .mobile-nav-link i {
                width: 20px;

                color: var(--primary-light);

                font-size: 16px;
            }

            .mobile-actions {
                display: grid;

                grid-template-columns: 1fr 1fr;

                gap: 9px;

                margin-top: 13px;
                padding-top: 13px;

                border-top: 1px solid #edf0f5;
            }

            .mobile-login,
            .mobile-register {
                display: flex;

                align-items: center;
                justify-content: center;
                gap: 7px;

                padding: 11px;

                border-radius: 10px;

                font-size: 13px;
                font-weight: 700;
            }

            .mobile-login {
                border: 1px solid #dce2ed;

                color: var(--primary);
                background: white;
            }

            .mobile-register {
                background: var(--primary);

                color: white;
            }

            .hero-section {
                min-height: auto;

                padding-top: 135px;
                padding-bottom: 80px;
            }

            .hero-content {
                text-align: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons,
            .hero-trust {
                justify-content: center;
            }

            .hero-visual {
                margin-top: 45px;

                min-height: 430px;
            }

            .hero-main-card {
                right: 50%;

                transform: translateX(50%) rotate(3deg);
            }

            .floating-one {
                right: 5%;
            }

            .floating-two {
                left: 5%;
            }

            .floating-three {
                right: 8%;
            }

            .package-card.popular {
                transform: none;
            }

            .package-card.popular:hover {
                transform: translateY(-10px);
            }

            .step-line {
                display: none;
            }
        }


        @media (max-width: 767.98px) {

            .main-navbar {
                padding: 12px 0;
            }

            .navbar-brand {
                font-size: 15px;
            }

            .brand-icon {
                width: 37px;
                height: 37px;
            }

            .navbar-toggle {
                width: 39px;
                height: 39px;
            }

            .hero-title {
                font-size: 38px;

                letter-spacing: -1px;
            }

            .hero-description {
                font-size: 14px;
            }

            .hero-visual {
                min-height: 370px;
            }

            .hero-orbit {
                width: 310px;
                height: 310px;

                top: 25px;
                right: 50%;

                transform: translateX(50%);
            }

            .hero-orbit::before {
                width: 220px;
                height: 220px;

                top: 44px;
                left: 44px;
            }

            .hero-main-card {
                width: 240px;

                top: 70px;
                right: 50%;

                padding: 21px;
            }

            .hero-book-icon {
                width: 57px;
                height: 74px;

                margin-bottom: 14px;
            }

            .hero-card-title {
                font-size: 17px;
            }

            .floating-card {
                padding: 10px 12px;
            }

            .floating-card-icon {
                width: 34px;
                height: 34px;
            }

            .floating-one {
                top: 45px;
                right: 0;
            }

            .floating-two {
                bottom: 60px;
                left: 0;
            }

            .floating-three {
                right: 0;
                bottom: 5px;
            }

            .stats-wrapper {
                padding: 25px 10px;
            }

            .stat-item {
                padding: 10px;
            }

            .stat-number {
                font-size: 24px;
            }

            .section {
                padding: 75px 0;
            }

            .section-heading {
                margin-bottom: 40px;
            }

            .package-card {
                padding: 28px 24px;
            }

            .package-discount {
                font-size: 40px;
            }

            .step-card {
                margin-bottom: 25px;
            }

            .footer {
                padding-top: 45px;
            }
        }


        @media (max-width: 400px) {

            .hero-title {
                font-size: 33px;
            }

            .hero-main-card {
                width: 220px;
            }

            .floating-card {
                transform: scale(0.85);
            }

            .floating-one {
                right: -10px;
            }

            .floating-two {
                left: -10px;
            }

            .mobile-actions {
                grid-template-columns: 1fr;
            }
        }


        @keyframes mobileMenuShow {

            from {
                opacity: 0;
                transform: translateY(-7px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }
    </style>
</head>

<body>


    <!-- =========================================
         NAVBAR
    ========================================= -->

    <nav class="main-navbar" id="mainNavbar">

        <div class="container">

            <div class="navbar-inner">


                <!-- BRAND -->

                <a
                    href="{{ route('landing') }}"
                    class="navbar-brand"
                >

                    <span class="brand-icon">

                        <i class="bi bi-book-half"></i>

                    </span>

                    <span>
                        Cyber Media
                    </span>

                </a>


                <!-- DESKTOP MENU -->

                <div
                    class="navbar-desktop-menu"
                    style="display: flex; align-items: center;"
                >

                    <div class="navbar-navigation">

                        <div class="nav-item-custom">

                            <a
                                href="#beranda"
                                class="nav-link-custom"
                            >
                                Beranda
                            </a>

                        </div>

                        <div class="nav-item-custom">

                            <a
                                href="#keunggulan"
                                class="nav-link-custom"
                            >
                                Keunggulan
                            </a>

                        </div>

                        <div class="nav-item-custom">

                            <a
                                href="#paket"
                                class="nav-link-custom"
                            >
                                Paket Reseller
                            </a>

                        </div>

                        <div class="nav-item-custom">

                            <a
                                href="#cara-kerja"
                                class="nav-link-custom"
                            >
                                Cara Kerja
                            </a>

                        </div>

                    </div>


                    <div class="navbar-actions">

                        <a
                            href="{{ route('login') }}"
                            class="navbar-login"
                        >

                            <i class="bi bi-box-arrow-in-right"></i>

                            Login

                        </a>


                        <a
                            href="{{ route('register') }}"
                            class="navbar-register"
                        >

                            Gabung Mitra

                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </div>


                <!-- MOBILE TOGGLE -->

                <button
                    type="button"
                    class="navbar-toggle"
                    id="navbarToggle"
                    aria-label="Buka menu"
                    aria-expanded="false"
                >

                    <i class="bi bi-list"></i>

                </button>


                <!-- MOBILE MENU -->

                <div
                    class="mobile-menu"
                    id="mobileMenu"
                >

                    <ul class="mobile-nav-list">

                        <li>

                            <a
                                href="#beranda"
                                class="mobile-nav-link"
                            >

                                <i class="bi bi-house"></i>

                                Beranda

                            </a>

                        </li>

                        <li>

                            <a
                                href="#keunggulan"
                                class="mobile-nav-link"
                            >

                                <i class="bi bi-stars"></i>

                                Keunggulan

                            </a>

                        </li>

                        <li>

                            <a
                                href="#paket"
                                class="mobile-nav-link"
                            >

                                <i class="bi bi-grid"></i>

                                Paket Reseller

                            </a>

                        </li>

                        <li>

                            <a
                                href="#cara-kerja"
                                class="mobile-nav-link"
                            >

                                <i class="bi bi-list-check"></i>

                                Cara Kerja

                            </a>

                        </li>

                    </ul>


                    <div class="mobile-actions">

                        <a
                            href="{{ route('login') }}"
                            class="mobile-login"
                        >

                            <i class="bi bi-box-arrow-in-right"></i>

                            Login

                        </a>


                        <a
                            href="{{ route('register') }}"
                            class="mobile-register"
                        >

                            <i class="bi bi-person-plus"></i>

                            Gabung Mitra

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </nav>


    <!-- =========================================
         HERO
    ========================================= -->

    <section
        class="hero-section"
        id="beranda"
    >

        <div class="hero-grid"></div>

        <div class="hero-decoration decoration-one"></div>

        <div class="hero-decoration decoration-two"></div>

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <div class="hero-content">

                        <div class="hero-badge">

                            <i class="bi bi-stars"></i>

                            PROGRAM RESELLER BUKU

                        </div>

                        <h1 class="hero-title">

                            Bangun Bisnis Buku
                            <span>Lebih Menguntungkan.</span>

                        </h1>

                        <p class="hero-description">

                            Bergabung menjadi reseller buku PT Cyber Media
                            Teknologi dan dapatkan harga khusus, diskon
                            bertingkat, serta akses katalog buku untuk
                            mendukung pertumbuhan bisnis Anda.

                        </p>

                        <div class="hero-buttons">

                            <a
                                href="{{ route('register') }}"
                                class="btn-primary-custom"
                            >

                                Mulai Menjadi Reseller

                                <i class="bi bi-arrow-right"></i>

                            </a>

                            <a
                                href="#paket"
                                class="btn-outline-custom"
                            >

                                Lihat Paket

                                <i class="bi bi-grid"></i>

                            </a>

                        </div>

                        <div class="hero-trust">

                            <div class="trust-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Harga khusus reseller

                            </div>

                            <div class="trust-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Diskon hingga 30%

                            </div>

                            <div class="trust-item">

                                <i class="bi bi-check-circle-fill"></i>

                                Sistem online

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-lg-5">

                    <div class="hero-visual">

                        <div class="hero-orbit"></div>


                        <div class="hero-main-card">

                            <div class="hero-book-icon">

                                <i class="bi bi-book"></i>

                            </div>

                            <div class="hero-card-label">

                                PT Cyber Media Teknologi

                            </div>

                            <div class="hero-card-title">

                                Partner Bisnis Buku Anda

                            </div>

                            <div class="hero-card-text">

                                Kelola pembelian buku, diskon,
                                pesanan, dan pembayaran dalam
                                satu platform.

                            </div>

                        </div>


                        <div class="floating-card floating-one">

                            <div class="floating-card-icon">

                                <i class="bi bi-percent"></i>

                            </div>

                            <div>

                                <strong>
                                    Diskon hingga 30%
                                </strong>

                                <small>
                                    Khusus reseller
                                </small>

                            </div>

                        </div>


                        <div class="floating-card floating-two">

                            <div class="floating-card-icon">

                                <i class="bi bi-cart-check"></i>

                            </div>

                            <div>

                                <strong>
                                    Belanja Mudah
                                </strong>

                                <small>
                                    Katalog online
                                </small>

                            </div>

                        </div>


                        <div class="floating-card floating-three">

                            <div class="floating-card-icon">

                                <i class="bi bi-shield-check"></i>

                            </div>

                            <div>

                                <strong>
                                    Sistem Terintegrasi
                                </strong>

                                <small>
                                    Aman & praktis
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         STATS
    ========================================= -->

    <section class="stats-section">

        <div class="container">

            <div class="stats-wrapper">

                <div class="row g-3">

                    <div class="col-6 col-lg-3">

                        <div class="stat-item">

                            <div class="stat-number">
                                3
                            </div>

                            <div class="stat-label">
                                Pilihan Paket Reseller
                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-lg-3">

                        <div class="stat-item">

                            <div class="stat-number">
                                30%
                            </div>

                            <div class="stat-label">
                                Diskon Maksimal
                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-lg-3">

                        <div class="stat-item">

                            <div class="stat-number">
                                40+
                            </div>

                            <div class="stat-label">
                                Minimum Buku Distributor
                            </div>

                        </div>

                    </div>

                    <div class="col-6 col-lg-3">

                        <div class="stat-item">

                            <div class="stat-number">
                                24/7
                            </div>

                            <div class="stat-label">
                                Akses Sistem Online
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         KEUNGGULAN
    ========================================= -->

    <section
        class="section"
        id="keunggulan"
    >

        <div class="container">

            <div class="section-heading reveal">

                <span class="section-eyebrow">
                    Mengapa Kami?
                </span>

                <h2 class="section-title">
                    Dirancang untuk membantu bisnis Anda berkembang
                </h2>

                <p class="section-description">

                    Sistem reseller PT Cyber Media Teknologi memberikan
                    pengalaman yang lebih praktis untuk mengelola pembelian
                    buku secara online.

                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-6 col-lg-4">

                    <div class="feature-card reveal">

                        <div class="feature-icon">
                            <i class="bi bi-tags"></i>
                        </div>

                        <h3 class="feature-title">
                            Harga Khusus Reseller
                        </h3>

                        <p class="feature-text">

                            Nikmati harga dan potongan khusus sesuai
                            dengan paket reseller yang Anda pilih.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card reveal">

                        <div class="feature-icon">
                            <i class="bi bi-percent"></i>
                        </div>

                        <h3 class="feature-title">
                            Diskon Bertingkat
                        </h3>

                        <p class="feature-text">

                            Dapatkan diskon mulai dari 15%, 20%,
                            hingga 30% sesuai paket reseller.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card reveal">

                        <div class="feature-icon">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>

                        <h3 class="feature-title">
                            Katalog Buku Online
                        </h3>

                        <p class="feature-text">

                            Temukan berbagai pilihan buku melalui
                            katalog yang dapat diakses secara online.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card reveal">

                        <div class="feature-icon">
                            <i class="bi bi-cart3"></i>
                        </div>

                        <h3 class="feature-title">
                            Keranjang & Checkout
                        </h3>

                        <p class="feature-text">

                            Pilih buku, atur jumlah pembelian,
                            dan lakukan checkout dengan mudah.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card reveal">

                        <div class="feature-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>

                        <h3 class="feature-title">
                            Pembayaran Terintegrasi
                        </h3>

                        <p class="feature-text">

                            Upload bukti pembayaran langsung melalui
                            sistem dan pantau status verifikasinya.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card reveal">

                        <div class="feature-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>

                        <h3 class="feature-title">
                            Riwayat Pesanan
                        </h3>

                        <p class="feature-text">

                            Pantau pesanan dan status transaksi Anda
                            secara lebih terstruktur.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         PAKET RESELLER
    ========================================= -->

    <section
        class="section package-section"
        id="paket"
    >

        <div class="container package-wrapper">

            <div class="section-heading reveal">

                <span class="section-eyebrow">
                    Pilih Paket Anda
                </span>

                <h2 class="section-title">
                    Paket reseller yang sesuai dengan bisnis Anda
                </h2>

                <p class="section-description">

                    Mulai dari bisnis kecil hingga kebutuhan distribusi,
                    tersedia pilihan paket dengan keuntungan yang berbeda.

                </p>

            </div>


            <div class="row g-4 align-items-stretch">

                @forelse($packages as $index => $package)

                    @php

                        $packageName = strtolower($package->name);

                        $isProfessional =
                            str_contains($packageName, 'profesional') ||
                            str_contains($packageName, 'professional');

                        $isDistributor =
                            str_contains($packageName, 'distributor');

                        $isStarter =
                            str_contains($packageName, 'starter');

                        $packageClass = $isProfessional
                            ? 'package-professional'
                            : ($isDistributor
                                ? 'package-distributor'
                                : 'package-starter');

                        $packageIcon = $isProfessional
                            ? 'bi-gem'
                            : ($isDistributor
                                ? 'bi-building'
                                : 'bi-rocket-takeoff');

                    @endphp


                    <div class="col-lg-4">

                        <div
                            class="package-card {{ $packageClass }} {{ $isProfessional ? 'popular' : '' }} reveal"
                        >

                            @if($isProfessional)

                                <div class="popular-badge">
                                    Paling Populer
                                </div>

                            @endif


                            <div class="package-shape"></div>


                            <div class="package-top">

                                <div class="package-icon">

                                    <i class="bi {{ $packageIcon }}"></i>

                                </div>

                                <h3 class="package-name">
                                    {{ $package->name }}
                                </h3>

                                <div class="package-subtitle">
                                    Paket reseller
                                </div>

                            </div>


                            <div class="package-discount">

                                {{ $package->discount_percentage }}%

                            </div>

                            <div class="discount-label">
                                Diskon reseller
                            </div>


                            <div class="package-divider"></div>


                            <ul class="package-features">

                                <li>

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Harga khusus reseller
                                    </span>

                                </li>

                                <li>

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Akses katalog buku online
                                    </span>

                                </li>

                                <li>

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Sistem keranjang dan checkout
                                    </span>

                                </li>

                                <li>

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Riwayat dan status pesanan
                                    </span>

                                </li>

                                <li>

                                    <i class="bi bi-check-circle-fill"></i>

                                    <span>
                                        Upload bukti pembayaran
                                    </span>

                                </li>

                            </ul>


                            <div class="package-minimum">

                                Minimal pembelian:

                                <strong>

                                    {{ number_format($package->min_purchase, 0, ',', '.') }}

                                    buku

                                </strong>

                            </div>


                            <a
                                href="{{ route('register') }}"
                                class="package-button"
                            >

                                Pilih Paket

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="text-center py-5">

                            <div class="mb-3">

                                <i
                                    class="bi bi-box-seam"
                                    style="font-size: 45px; color: #c9a84c;"
                                ></i>

                            </div>

                            <h4>
                                Paket reseller belum tersedia
                            </h4>

                            <p class="text-muted mb-0">

                                Paket akan ditampilkan setelah data paket
                                tersedia di database.

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    <!-- =========================================
         CARA KERJA
    ========================================= -->

    <section
        class="section"
        id="cara-kerja"
    >

        <div class="container">

            <div class="section-heading reveal">

                <span class="section-eyebrow">
                    Cara Bergabung
                </span>

                <h2 class="section-title">
                    Mulai menjadi reseller dalam beberapa langkah
                </h2>

                <p class="section-description">

                    Proses pendaftaran dirancang sederhana agar Anda
                    dapat segera mulai menggunakan sistem reseller.

                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-4">

                    <div class="step-card reveal">

                        <div class="step-number">
                            01
                        </div>

                        <h3 class="step-title">
                            Daftar Akun
                        </h3>

                        <p class="step-text">

                            Isi data pendaftaran dan pilih paket
                            reseller yang sesuai dengan kebutuhan Anda.

                        </p>

                        <div class="step-line"></div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="step-card reveal">

                        <div class="step-number">
                            02
                        </div>

                        <h3 class="step-title">
                            Verifikasi Admin
                        </h3>

                        <p class="step-text">

                            Admin akan memeriksa data pendaftaran
                            sebelum akun reseller diaktifkan.

                        </p>

                        <div class="step-line"></div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="step-card reveal">

                        <div class="step-number">
                            03
                        </div>

                        <h3 class="step-title">
                            Mulai Berbelanja
                        </h3>

                        <p class="step-text">

                            Setelah aktif, Anda dapat mengakses katalog,
                            membuat pesanan, dan memperoleh diskon reseller.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         CTA
    ========================================= -->

    <section class="cta-section">

        <div class="container">

            <div class="cta-content reveal">

                <h2 class="cta-title">

                    Siap Mengembangkan Bisnis Buku Anda?

                </h2>

                <p class="cta-text">

                    Bergabung sebagai reseller PT Cyber Media Teknologi
                    dan manfaatkan sistem pembelian buku yang praktis,
                    terstruktur, dan mudah digunakan.

                </p>

                <a
                    href="{{ route('register') }}"
                    class="cta-button"
                >

                    Daftar Sebagai Reseller

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>

    </section>


    <!-- =========================================
         FOOTER
    ========================================= -->

    <footer class="footer">

        <div class="container">

            <div class="row g-5">

                <div class="col-lg-6">

                    <div class="footer-brand">

                        <span class="footer-brand-icon">

                            <i class="bi bi-book-half"></i>

                        </span>

                        PT Cyber Media Teknologi

                    </div>

                    <p class="footer-description">

                        Platform reseller buku untuk membantu mitra
                        mendapatkan akses pembelian buku dengan harga
                        khusus dan proses transaksi yang lebih praktis.

                    </p>

                </div>


                <div class="col-6 col-lg-3">

                    <h6 class="footer-title">
                        Navigasi
                    </h6>

                    <ul class="footer-links">

                        <li>
                            <a href="#beranda">
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a href="#keunggulan">
                                Keunggulan
                            </a>
                        </li>

                        <li>
                            <a href="#paket">
                                Paket Reseller
                            </a>
                        </li>

                        <li>
                            <a href="#cara-kerja">
                                Cara Kerja
                            </a>
                        </li>

                    </ul>

                </div>


                <div class="col-6 col-lg-3">

                    <h6 class="footer-title">
                        Akun
                    </h6>

                    <ul class="footer-links">

                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}">
                                Gabung Mitra
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            <div class="footer-bottom">

                &copy; {{ date('Y') }}

                PT Cyber Media Teknologi.

                Semua hak dilindungi.

            </div>

        </div>

    </footer>


    <!-- =========================================
         BOOTSTRAP JS
    ========================================= -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>


    <script>

        /* =========================================
           NAVBAR SCROLL
        ========================================= */

        const navbar =
            document.getElementById('mainNavbar');


        function handleNavbarScroll() {

            if (window.scrollY > 30) {

                navbar.classList.add('scrolled');

            } else {

                navbar.classList.remove('scrolled');

            }

        }


        window.addEventListener(
            'scroll',
            handleNavbarScroll
        );


        handleNavbarScroll();


        /* =========================================
           MOBILE NAVBAR
        ========================================= */

        const navbarToggle =
            document.getElementById('navbarToggle');

        const mobileMenu =
            document.getElementById('mobileMenu');


        navbarToggle.addEventListener(
            'click',
            function () {

                const isOpen =
                    mobileMenu.classList.toggle('show');

                navbarToggle.setAttribute(
                    'aria-expanded',
                    isOpen ? 'true' : 'false'
                );


                const icon =
                    navbarToggle.querySelector('i');


                if (isOpen) {

                    icon.classList.remove(
                        'bi-list'
                    );

                    icon.classList.add(
                        'bi-x-lg'
                    );

                } else {

                    icon.classList.remove(
                        'bi-x-lg'
                    );

                    icon.classList.add(
                        'bi-list'
                    );

                }

            }
        );


        /* =========================================
           CLOSE MOBILE MENU AFTER CLICK
        ========================================= */

        document
            .querySelectorAll('.mobile-nav-link')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        mobileMenu.classList.remove(
                            'show'
                        );

                        navbarToggle.setAttribute(
                            'aria-expanded',
                            'false'
                        );


                        const icon =
                            navbarToggle.querySelector('i');


                        icon.classList.remove(
                            'bi-x-lg'
                        );

                        icon.classList.add(
                            'bi-list'
                        );

                    }
                );

            });


        /* =========================================
           CLOSE MOBILE MENU WHEN CLICK OUTSIDE
        ========================================= */

        document.addEventListener(
            'click',
            function (event) {

                const clickedInsideMenu =
                    mobileMenu.contains(event.target);

                const clickedToggle =
                    navbarToggle.contains(event.target);


                if (
                    !clickedInsideMenu &&
                    !clickedToggle &&
                    mobileMenu.classList.contains('show')
                ) {

                    mobileMenu.classList.remove(
                        'show'
                    );

                    navbarToggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );


                    const icon =
                        navbarToggle.querySelector('i');


                    icon.classList.remove(
                        'bi-x-lg'
                    );

                    icon.classList.add(
                        'bi-list'
                    );

                }

            }
        );


        /* =========================================
           SCROLL REVEAL
        ========================================= */

        const revealElements =
            document.querySelectorAll('.reveal');


        const revealObserver =
            new IntersectionObserver(
                function (entries, observer) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add(
                                'active'
                            );

                            observer.unobserve(
                                entry.target
                            );

                        }

                    });

                },
                {
                    threshold: 0.12
                }
            );


        revealElements.forEach(function (element) {

            revealObserver.observe(element);

        });

    </script>

</body>
</html>