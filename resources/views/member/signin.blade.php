<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sign In | {{ config('detailsApp.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('logo/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />

    <!-- App css -->
    <link href="{{ asset('mem_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mem_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('mem_assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" />

    <style>
        :root {
            --premium-primary: #142947;
            --premium-dark: #0b1525;
            --premium-blue: #1e3a61;
            --premium-blue-light: #38557e;
            --premium-gold: #c9aa6f;
            --premium-gold-light: #d9c4a0;
            --premium-cream: #f8eed7;
            --premium-gold-deep: #9f7a3b;
            --premium-gold-shadow: #6f5324;
        }

        body.authentication-bg {
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            overflow-y: auto;
            font-family: 'Nunito Sans', 'Segoe UI', sans-serif;
            background:
                radial-gradient(circle at 12% 16%, rgba(183, 125, 17, 0.16), transparent 22%),
                radial-gradient(circle at 84% 18%, rgba(166, 116, 24, 0.08), transparent 18%),
                radial-gradient(circle at 76% 82%, rgba(56, 85, 126, 0.24), transparent 24%),
                linear-gradient(135deg, #1d1b07 0%, #142947 48%, #1d385d 100%);
            position: relative;
        }

        .space-particles {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .space-scene {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .space-planet {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(242, 220, 167, 0.95) 0%, rgba(201, 170, 111, 0.92) 34%, rgba(159, 122, 59, 0.88) 62%, rgba(111, 83, 36, 0.92) 100%);
            box-shadow: inset -18px -20px 38px rgba(81, 58, 18, 0.5), 0 0 38px rgba(159, 122, 59, 0.2);
            opacity: 0.3;
            animation: planetDrift ease-in-out infinite;
        }

        .space-planet::before {
            content: "";
            position: absolute;
            inset: 12% auto auto 12%;
            width: 22%;
            height: 22%;
            border-radius: 50%;
            background: rgba(255, 244, 214, 0.24);
            filter: blur(4px);
        }

        .space-planet.planet-one {
            width: 190px;
            height: 190px;
            top: 10%;
            left: -48px;
            animation-duration: 18s;
        }

        .space-planet.planet-two {
            width: 130px;
            height: 130px;
            right: 10%;
            bottom: 14%;
            animation-duration: 15s;
            animation-delay: -5s;
        }

        .space-planet.planet-three {
            width: 90px;
            height: 90px;
            right: 4%;
            top: 16%;
            animation-duration: 13s;
            animation-delay: -2s;
        }

        .space-ring {
            position: absolute;
            border: 2px solid rgba(201, 170, 111, 0.28);
            border-radius: 50%;
            transform: rotate(-18deg);
            opacity: 0.45;
        }

        .space-ring.ring-one {
            width: 240px;
            height: 56px;
            top: 16%;
            left: -72px;
        }

        .space-ring.ring-two {
            width: 170px;
            height: 42px;
            right: 4%;
            bottom: 18%;
        }

        .space-astronaut {
            position: absolute;
            left: 8%;
            bottom: 20%;
            color: rgba(217, 196, 160, 0.9);
            font-size: 72px;
            text-shadow: 0 0 20px rgba(159, 122, 59, 0.3);
            animation: astronautFloat 14s ease-in-out infinite;
            opacity: 0.32;
        }

        @keyframes planetDrift {
            0%, 100% {
                transform: translate3d(0, 0, 0) scale(1);
            }
            50% {
                transform: translate3d(20px, -18px, 0) scale(1.04);
            }
        }

        @keyframes astronautFloat {
            0%, 100% {
                transform: translate3d(0, 0, 0) rotate(-8deg);
            }
            50% {
                transform: translate3d(36px, -28px, 0) rotate(8deg);
            }
        }

        .space-particles span {
            position: absolute;
            display: block;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(196, 162, 97, 0.88) 0%, rgba(159, 122, 59, 0.82) 45%, rgba(111, 83, 36, 0) 100%);
            box-shadow: 0 0 10px rgba(159, 122, 59, 0.46), 0 0 22px rgba(111, 83, 36, 0.24);
            opacity: 0.9;
            animation: particleFloat linear infinite;
        }

        .space-particles span:nth-child(1) { width: 8px; height: 8px; left: 4%; top: 82%; animation-duration: 11s; animation-delay: -2s; }
        .space-particles span:nth-child(2) { width: 6px; height: 6px; left: 9%; top: 64%; animation-duration: 9s; animation-delay: -5s; }
        .space-particles span:nth-child(3) { width: 9px; height: 9px; left: 14%; top: 90%; animation-duration: 13s; animation-delay: -1s; }
        .space-particles span:nth-child(4) { width: 5px; height: 5px; left: 20%; top: 70%; animation-duration: 8s; animation-delay: -4s; }
        .space-particles span:nth-child(5) { width: 7px; height: 7px; left: 26%; top: 88%; animation-duration: 10s; animation-delay: -3s; }
        .space-particles span:nth-child(6) { width: 6px; height: 6px; left: 31%; top: 78%; animation-duration: 7s; animation-delay: -6s; }
        .space-particles span:nth-child(7) { width: 8px; height: 8px; left: 36%; top: 92%; animation-duration: 12s; animation-delay: -2s; }
        .space-particles span:nth-child(8) { width: 5px; height: 5px; left: 42%; top: 74%; animation-duration: 8.5s; animation-delay: -4s; }
        .space-particles span:nth-child(9) { width: 7px; height: 7px; left: 47%; top: 86%; animation-duration: 10.5s; animation-delay: -5s; }
        .space-particles span:nth-child(10) { width: 9px; height: 9px; left: 53%; top: 94%; animation-duration: 14s; animation-delay: -2s; }
        .space-particles span:nth-child(11) { width: 6px; height: 6px; left: 58%; top: 72%; animation-duration: 9s; animation-delay: -6s; }
        .space-particles span:nth-child(12) { width: 8px; height: 8px; left: 63%; top: 88%; animation-duration: 11.5s; animation-delay: -1s; }
        .space-particles span:nth-child(13) { width: 5px; height: 5px; left: 68%; top: 68%; animation-duration: 7.5s; animation-delay: -5s; }
        .space-particles span:nth-child(14) { width: 7px; height: 7px; left: 73%; top: 84%; animation-duration: 10s; animation-delay: -3s; }
        .space-particles span:nth-child(15) { width: 8px; height: 8px; left: 78%; top: 93%; animation-duration: 12.5s; animation-delay: -4s; }
        .space-particles span:nth-child(16) { width: 6px; height: 6px; left: 82%; top: 76%; animation-duration: 8.2s; animation-delay: -6s; }
        .space-particles span:nth-child(17) { width: 9px; height: 9px; left: 86%; top: 89%; animation-duration: 13.2s; animation-delay: -2s; }
        .space-particles span:nth-child(18) { width: 5px; height: 5px; left: 90%; top: 66%; animation-duration: 7.2s; animation-delay: -5s; }
        .space-particles span:nth-child(19) { width: 8px; height: 8px; left: 94%; top: 82%; animation-duration: 10.8s; animation-delay: -3s; }
        .space-particles span:nth-child(20) { width: 6px; height: 6px; left: 97%; top: 72%; animation-duration: 9.4s; animation-delay: -4s; }

        @keyframes particleFloat {
            0% {
                transform: translate3d(0, 0, 0) scale(0.7);
                opacity: 0;
            }
            10% {
                opacity: 0.95;
            }
            50% {
                transform: translate3d(-40px, -50vh, 0) scale(1);
                opacity: 0.9;
            }
            100% {
                transform: translate3d(55px, -105vh, 0) scale(0.4);
                opacity: 0;
            }
        }

        .account-pages {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 30px 0 !important;
            position: relative;
            z-index: 1;
        }

        .mouse-glow {
            position: fixed;
            width: 340px;
            height: 340px;
            left: 0;
            top: 0;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.82;
            background:
                radial-gradient(circle, rgba(159, 122, 59, 0.68) 0%, rgba(111, 83, 36, 0.44) 24%, rgba(111, 83, 36, 0.2) 46%, rgba(111, 83, 36, 0) 72%);
            filter: blur(22px);
            transform: translate3d(-50%, -50%, 0);
            transition: opacity 0.2s ease;
            mix-blend-mode: screen;
        }

        .signin-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.08fr) minmax(360px, 470px);
            border-radius: 30px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(201, 170, 111, 0.18);
            box-shadow: 0 32px 90px rgba(4, 11, 22, 0.42);
            backdrop-filter: blur(16px);
        }

        .signin-showcase {
            position: relative;
            padding: 56px 48px;
            color: #fff;
            background:
                linear-gradient(180deg, rgba(10, 22, 40, 0.12), rgba(10, 22, 40, 0.58)),
                linear-gradient(135deg, rgba(201, 170, 111, 0.12) 0%, rgba(20, 41, 71, 0.16) 46%, rgba(201, 170, 111, 0.04) 100%);
        }

        .signin-showcase::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 18% 18%, rgba(201, 170, 111, 0.14), transparent 18%),
                radial-gradient(circle at 80% 70%, rgba(201, 170, 111, 0.09), transparent 18%);
            pointer-events: none;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            padding: 9px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(217, 196, 160, 0.28);
            color: var(--premium-gold-light);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.24em;
            text-transform: uppercase;
        }

        .signin-showcase h1 {
            margin: 24px 0 14px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 56px;
            line-height: 0.95;
            color: #fff7e8;
        }

        .signin-showcase p {
            max-width: 440px;
            margin: 0;
            color: rgba(255, 255, 255, 0.78);
            font-size: 16px;
            line-height: 1.8;
        }

        .signin-points {
            display: grid;
            gap: 14px;
            margin-top: 34px;
        }

        .signin-point {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .signin-point i {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(201, 170, 111, 0.16);
            color: var(--premium-gold-light);
            font-size: 18px;
        }

        .signin-point span {
            color: rgba(255, 255, 255, 0.88);
            font-weight: 700;
        }

        .signin-card {
            position: relative;
            padding: 42px 36px;
            color: #f4ecdc;
            isolation: isolate;
            background: linear-gradient(180deg, rgba(13, 24, 41, 0.98) 0%, rgba(8, 14, 24, 1) 100%);
        }

        .signin-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--premium-gold), transparent);
        }

        .signin-card::after {
            content: "";
            position: absolute;
            inset: -20%;
            background:
                radial-gradient(circle at 18% 22%, rgba(201, 170, 111, 0.18), transparent 18%),
                radial-gradient(circle at 82% 24%, rgba(201, 170, 111, 0.13), transparent 16%),
                radial-gradient(circle at 58% 78%, rgba(201, 170, 111, 0.1), transparent 18%),
                linear-gradient(120deg, rgba(201, 170, 111, 0.03) 0%, rgba(255, 255, 255, 0.02) 40%, rgba(201, 170, 111, 0.08) 100%);
            background-size: 180% 180%;
            animation: premiumCardFlow 12s ease-in-out infinite;
            opacity: 0.95;
            z-index: -1;
            pointer-events: none;
        }

        @keyframes premiumCardFlow {
            0% { transform: translate3d(-2%, -1%, 0) rotate(0deg) scale(1); background-position: 0% 50%; }
            50% { transform: translate3d(2%, 1%, 0) rotate(3deg) scale(1.04); background-position: 100% 50%; }
            100% { transform: translate3d(-2%, -1%, 0) rotate(0deg) scale(1); background-position: 0% 50%; }
        }

        .signin-card > * {
            position: relative;
            z-index: 1;
        }

        .signin-header {
            text-align: center;
            margin-bottom: 26px;
        }

        .signin-header img {
            width: 88px;
            height: auto;
            padding: 12px 14px;
            border-radius: 22px;
            background: linear-gradient(145deg, #fff7e8 0%, #ffffff 100%);
            border: 1px solid rgba(201, 170, 111, 0.25);
            box-shadow: 0 14px 35px rgba(20, 41, 71, 0.12);
        }

        .signin-header h2 {
            margin: 18px 0 8px;
            color: var(--premium-gold-light);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 40px;
            font-weight: 700;
        }

        .signin-header p {
            margin: 0;
            color: rgba(243, 234, 216, 0.72);
            font-size: 14px;
            line-height: 1.7;
        }

        .form-label {
            margin-bottom: 8px;
            color: var(--premium-gold-light);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .input-group {
            display: flex;
            align-items: center;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(201, 170, 111, 0.22);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 6px 18px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            backdrop-filter: blur(10px);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .input-group:focus-within {
            border-color: rgba(201, 170, 111, 0.88);
            box-shadow: 0 0 0 4px rgba(201, 170, 111, 0.12), 0 10px 24px rgba(0, 0, 0, 0.28);
            transform: translateY(-1px);
        }

        .input-group-text {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 52px;
            padding: 0 14px;
            border: none;
            background: transparent;
            color: var(--premium-gold);
            font-size: 16px;
        }

        .form-control {
            border: none;
            min-height: 56px;
            padding: 15px 16px 15px 4px;
            background: transparent;
            color: #f8eed7;
            font-size: 15px;
            box-shadow: none !important;
        }

        .form-control::placeholder {
            color: rgba(248, 238, 215, 0.42);
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            border-color: #ccb17e;
        }

        .form-check-label,
        .text-muted,
        .text-muted small {
            color: rgba(243, 234, 216, 0.72) !important;
        }

        .forgot-link {
            color: var(--premium-gold) !important;
            font-weight: 700;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: var(--premium-gold-light) !important;
            text-decoration: underline;
        }

        .btn-primary {
            width: 100%;
            min-height: 56px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #b89252 0%, #c9aa6f 48%, #e2cc9b 100%);
            color: #111214;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            box-shadow: 0 16px 34px rgba(201, 170, 111, 0.24);
            position: relative;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 80%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 38px rgba(201, 170, 111, 0.32);
        }

        .btn-primary:hover::before {
            left: 140%;
        }

        .btn-primary.loading::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 1.4rem;
            height: 1.4rem;
            border: 2px solid rgba(255, 255, 255, 0.7);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            transform: translate(-50%, -50%);
        }

        .btn-primary.loading span {
            opacity: 0;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .captcha-note {
            font-weight: 800;
            color: var(--premium-gold-light);
        }

        .alert {
            border: 1px solid transparent;
            border-radius: 18px;
            margin-bottom: 20px;
            padding: 16px 18px;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(20, 41, 71, 0.08);
        }

        .alert-danger {
            background: rgba(201, 170, 111, 0.08);
            color: #f4dbc0;
            border-color: rgba(201, 170, 111, 0.18);
        }

        .signup-text {
            margin: 22px 0 0;
            color: rgba(243, 234, 216, 0.72);
            font-size: 14px;
        }

        .signup-text a {
            color: var(--premium-gold);
            font-weight: 800;
            text-decoration: none;
        }

        .signup-text a:hover {
            color: var(--premium-gold-light);
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {

        @media (max-width: 767.98px) {
            .signin-showcase {
                display: none;
            }
        }

            .signin-shell {
                grid-template-columns: 1fr;
                max-width: 680px;
                margin: 0 auto;
            }

            .signin-showcase {
                padding: 36px 30px;
            }

            .signin-showcase h1 {
                font-size: 42px;
            }

            .signin-card {
                padding: 36px 28px;
            }
        }

        @media (max-width: 575.98px) {
            .account-pages {
                padding: 18px 0 !important;
            }

            .signin-shell {
                border-radius: 22px;
            }

            .signin-showcase {
                padding: 28px 20px;
            }

            .signin-showcase h1 {
                font-size: 34px;
            }

            .signin-card {
                padding: 30px 20px;
            }

            .signin-header h2 {
                font-size: 34px;
            }

            .input-group-text {
                min-width: 46px;
                padding: 0 12px;
            }

            .form-control {
                min-height: 52px;
                font-size: 14px;
            }

            .btn-primary {
                min-height: 52px;
                font-size: 14px;
                letter-spacing: 0.12em;
            }
        }
    </style>
</head>

<body class="loading authentication-bg"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="mouse-glow" id="mouseGlow"></div>
    <div class="space-scene">
        <div class="space-planet planet-one"></div>
        <div class="space-ring ring-one"></div>
        <div class="space-planet planet-two"></div>
        <div class="space-ring ring-two"></div>
        <div class="space-planet planet-three"></div>
        <i class="fa-solid fa-user-astronaut space-astronaut"></i>
    </div>
    <div class="space-particles">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xxl-9 col-xl-10 col-lg-11">
                    @if (session()->has('loginmsg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('loginmsg') }}
                        </div>
                    @endif
                    <div class="signin-shell">
                        <div class="signin-showcase">
                            <span class="brand-badge">{{ config('detailsApp.name') }}</span>
                            <h1>Premium Member Access</h1>
                            <p>Enter your panel with the same secure member login flow, restyled to match your premium member dashboard.</p>
                            <div class="signin-points">
                                <div class="signin-point">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <span>Secure member access with your current login process.</span>
                                </div>
                                <div class="signin-point">
                                    <i class="fa-solid fa-wallet"></i>
                                    <span>Quick access to wallet, profile, team and reports.</span>
                                </div>
                                <div class="signin-point">
                                    <i class="fa-solid fa-gem"></i>
                                    <span>Buy product in your member panel.</span>
                                </div>
                            </div>
                        </div>
                        <div class="signin-card">
                            <div class="signin-header">
                                <img src="{{ asset('logo/logo.png') }}" alt="logo">
                                <h2>Sign In</h2>
                                <p>Enter your member ID and password to access the member panel.</p>
                            </div>
                            <form method="POST" action="{{ route('userLogin') }}" autocomplete="off" id="signinForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="memberid" class="form-label">Memberid</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input class="form-control" type="text" name="memberid" id="memberid" placeholder="Enter Your Memberid" required autofocus />
                                    </div>
                                    @error('memberid')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <a href="{{ url('/member-forget-password') }}" class="forgot-link float-end"><small>Forgot your password?</small></a>
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required />
                                        <button type="button" class="input-group-text" id="togglePasswordIcon" tabindex="-1" aria-label="Show/Hide Password"><i class="fa fa-eye-slash" id="eyeIcon"></i></button>
                                    </div>
                                    @error('password')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text captcha-note">
                                            <i>{{ session('str1') }} + {{ session('str2') }}</i>
                                        </span>
                                        <input type="text" class="form-control pe-5 password-input" name="login-captcha" id="login-captcha" placeholder="Enter Answer Here" required />
                                    </div>
                                    <!-- Removed reload/refresh button -->
                                </div>
                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit" id="signinBtn">
                                        <span>Sign In</span>
                                    </button>
                                </div>
                                <p class="signup-text text-center">Don't have account?<a class="ms-1" href="{{ url('/member/register/1/side') }}">Create an Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <footer class="footer footer-alt">
        {{ date('Y') }} © {{ config('detailsApp.name') }}
    </footer> --}}

    <!-- bundle -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('mem_assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('mem_assets/js/app.min.js') }}"></script>
    <script>
        // Show/Hide password toggle
        $(document).ready(function() {
            const mouseGlow = document.getElementById('mouseGlow');

            document.addEventListener('mousemove', function(e) {
                if (mouseGlow) {
                    mouseGlow.style.left = e.clientX + 'px';
                    mouseGlow.style.top = e.clientY + 'px';
                }
            });

            document.addEventListener('mouseleave', function() {
                if (mouseGlow) {
                    mouseGlow.style.opacity = '0';
                }
            });

            document.addEventListener('mouseenter', function() {
                if (mouseGlow) {
                    mouseGlow.style.opacity = '0.55';
                }
            });

            $('#togglePasswordIcon').on('click', function() {
                const passwordInput = $('#password');
                const eyeIcon = $('#eyeIcon');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                eyeIcon.toggleClass('fa-eye fa-eye-slash');
            });
            // Client-side validation and loading animation
            $('#signinForm').on('submit', function(e) {
                var valid = true;
                $(this).find('input[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('is-invalid');
                        valid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                if (!valid) {
                    e.preventDefault();
                    return false;
                }
                $('#signinBtn').addClass('loading').attr('disabled', true);
            });
            $('input[required]').on('input', function() {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>

</body>

</html>

