<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8" />
    <title>@yield('title') :: {{ config('detailsApp.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- App favicon -->
<link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('logo/favicon/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
<link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />

    <!-- Google Fonts - Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Nunito+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Datatables css -->
    <link href="{{ asset('mem_assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mem_assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="{{ asset('mem_assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ asset('mem_assets/css/geneology.css') }}" rel="stylesheet">
    <link href="{{ asset('mem_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mem_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('mem_assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('mem_assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker css -->
    <link href="{{ asset('mem_assets/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">

    <!-- Vector Map css -->
    <link href="{{ asset('mem_assets/vendor/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="{{ asset('mem_assets/css/style.css') }}">

    <!-- Premium Sidebar & Topbar Styles -->
    <style>
        :root {
            --premium-primary: #142947;
            --premium-dark: #142947;
            --premium-blue: #1e3a61;
            --premium-blue-light: #38557e;
            --premium-gold: #c9aa6f;
            --premium-gold-light: #d9c4a0;
            --premium-cream: #f8eed7;
            --premium-cream-light: #fdf8f0;
        }

        body {
            font-family: 'Nunito Sans', sans-serif;
        }

        /* Premium Sidebar Styles */
        .leftside-menu {
            background: var(--premium-primary);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.25);
            border-right: 1px solid rgba(201, 170, 111, 0.15);
        }

        .leftside-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(201, 170, 111, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(201, 170, 111, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .leftside-menu .logo {
            background: linear-gradient(180deg, #0d1c33 0%, #142947 100%) !important;
            border-bottom: 2px solid #CCB17E;
            padding: 30px 20px 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .leftside-menu .logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(204, 177, 126, 0.25) 0%, transparent 50%),
                radial-gradient(circle at 20% 50%, rgba(204, 177, 126, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 80% 30%, rgba(204, 177, 126, 0.08) 0%, transparent 25%);
            pointer-events: none;
            animation: bgPulse 4s ease-in-out infinite;
        }

        @keyframes bgPulse {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 1;
            }
        }

        /* Animated floating particles */
        .leftside-menu .logo .particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .leftside-menu .logo .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #CCB17E;
            border-radius: 50%;
            opacity: 0;
            animation: floatParticle 6s ease-in-out infinite;
        }

        .leftside-menu .logo .particle:nth-child(1) {
            left: 10%;
            top: 20%;
            animation-delay: 0s;
            width: 3px;
            height: 3px;
        }

        .leftside-menu .logo .particle:nth-child(2) {
            left: 25%;
            top: 60%;
            animation-delay: 1s;
            width: 5px;
            height: 5px;
        }

        .leftside-menu .logo .particle:nth-child(3) {
            left: 45%;
            top: 30%;
            animation-delay: 2s;
            width: 2px;
            height: 2px;
        }

        .leftside-menu .logo .particle:nth-child(4) {
            left: 65%;
            top: 70%;
            animation-delay: 0.5s;
            width: 4px;
            height: 4px;
        }

        .leftside-menu .logo .particle:nth-child(5) {
            left: 80%;
            top: 40%;
            animation-delay: 1.5s;
            width: 3px;
            height: 3px;
        }

        .leftside-menu .logo .particle:nth-child(6) {
            left: 90%;
            top: 80%;
            animation-delay: 2.5s;
            width: 2px;
            height: 2px;
        }

        .leftside-menu .logo .particle:nth-child(7) {
            left: 15%;
            top: 85%;
            animation-delay: 3s;
            width: 4px;
            height: 4px;
        }

        .leftside-menu .logo .particle:nth-child(8) {
            left: 70%;
            top: 15%;
            animation-delay: 3.5s;
            width: 3px;
            height: 3px;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            50% {
                transform: translateY(-30px) scale(1.2);
                opacity: 0.6;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateY(-60px) scale(0.5);
                opacity: 0;
            }
        }

        /* Animated gradient wave */
        .leftside-menu .logo .gradient-wave {
            position: absolute;
            top: 0;
            left: -100%;
            width: 200%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(204, 177, 126, 0.1) 25%,
                    rgba(204, 177, 126, 0.2) 50%,
                    rgba(204, 177, 126, 0.1) 75%,
                    transparent 100%);
            animation: waveMove 8s linear infinite;
            pointer-events: none;
        }

        @keyframes waveMove {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(50%);
            }
        }

        .leftside-menu .logo::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #CCB17E, transparent);
        }

        .leftside-menu .logo .logo-container {
            position: relative;
            z-index: 2;
        }

        .leftside-menu .logo .logo-wrapper {
            background: cornsilk;
            border: 1px solid rgba(204, 177, 126, 0.4);
            border-radius: 24px;
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow:
                0 10px 40px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(204, 177, 126, 0.15) inset,
                0 0 60px rgba(204, 177, 126, 0.08),
                0 2px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(12px);
            position: relative;
            overflow: hidden;
        }

        .leftside-menu .logo .logo-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(204, 177, 126, 0.15) 0%, transparent 60%);
            animation: shimmer 3s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: translate(-10%, -10%);
                opacity: 0.5;
            }

            50% {
                transform: translate(10%, 10%);
                opacity: 1;
            }
        }

        .leftside-menu .logo .logo-wrapper:hover {
            background: linear-gradient(145deg,
                    rgba(204, 177, 126, 0.2) 0%,
                    rgba(204, 177, 126, 0.12) 50%,
                    rgba(204, 177, 126, 0.08) 100%);
            border-color: #CCB17E;
            transform: translateY(-4px) scale(1.03);
            box-shadow:
                0 15px 50px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(204, 177, 126, 0.3) inset,
                0 0 80px rgba(204, 177, 126, 0.2),
                0 4px 15px rgba(0, 0, 0, 0.25);
        }

        .leftside-menu .logo .logo-wrapper:hover::before {
            animation: shimmer 1.5s ease-in-out infinite;
        }

        .leftside-menu .logo .logo-wrapper img {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.45));
            transition: transform 0.4s ease, filter 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .leftside-menu .logo .logo-wrapper:hover img {
            transform: scale(1.08);
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.5));
        }

        .leftside-menu .logo .brand-name {
            font-family: 'Cormorant Garamond', serif;
            color: #CCB17E;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.08em;
            margin-top: 15px;
            text-transform: uppercase;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 10px rgba(204, 177, 126, 0.3);
        }

        .leftside-menu .logo .brand-tagline {
            font-family: 'Nunito Sans', sans-serif;
            color: rgba(255, 255, 255, 0.45);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            margin-top: 6px;
            position: relative;
            z-index: 2;
        }

        .leftside-menu .logo .brand-tagline::before,

        .side-nav {
            padding: 15px 0;
        }

        .side-nav .side-nav-title {
            color: var(--premium-gold);
            font-family: 'Cormorant Garamond', serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            padding: 20px 20px 10px;
            opacity: 0.9;
        }

        .side-nav .side-nav-item>a.side-nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
            font-size: 14px;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 4px 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
        }

        .side-nav .side-nav-item>a.side-nav-link i {
            color: var(--premium-gold);
            font-size: 18px;
            margin-right: 12px;
            transition: all 0.3s ease;
            width: 24px;
            text-align: center;
        }

        .side-nav .side-nav-item>a.side-nav-link:hover {
            background: rgba(201, 170, 111, 0.12);
            color: #fff;
            transform: translateX(4px);
            border-left-color: var(--premium-gold);
        }

        .side-nav .side-nav-item>a.side-nav-link:hover i {
            color: #fff;
        }

        .side-nav .side-nav-item>a.side-nav-link[aria-expanded="true"] {
            background: rgba(201, 170, 111, 0.15);
            color: #fff;
            border-left-color: var(--premium-gold);
        }

        .side-nav .menu-arrow {
            color: var(--premium-gold-light);
            transition: transform 0.3s ease;
        }

        .side-nav .side-nav-link[aria-expanded="true"] .menu-arrow {
            transform: rotate(90deg);
        }

        /* Second Level Menu */
        .side-nav .side-nav-second-level {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            margin: 5px 15px;
            padding: 8px 0;
        }

        .side-nav .side-nav-second-level li a {
            color: rgba(255, 255, 255, 0.65);
            font-size: 13px;
            font-weight: 500;
            padding: 10px 20px 10px 50px;
            transition: all 0.3s ease;
            display: block;
            border-left: 2px solid transparent;
        }

        .side-nav .side-nav-second-level li a:hover {
            color: var(--premium-gold);
            background: rgba(201, 170, 111, 0.08);
            padding-left: 55px;
            border-left-color: var(--premium-gold);
        }

        .side-nav hr {
            border-color: rgba(201, 170, 111, 0.12);
            margin: 15px 20px;
        }

        /* Premium Topbar Styles */
        .navbar-custom {
            background: var(--premium-primary) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0 20px;
            min-height: 70px;
            border-bottom: 1px solid rgba(201, 170, 111, 0.15);
        }

        .navbar-custom .topbar-menu li>a {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .navbar-custom .topbar-menu li>a:hover {
            color: var(--premium-gold) !important;
        }

        .navbar-custom .noti-icon-badge {
            background: linear-gradient(135deg, #c9aa6f 0%, #f1c56f 100%) !important;
            color: var(--premium-primary) !important;
            font-weight: 700;
            font-size: 10px;
        }

        .navbar-custom .account-user-avatar img {
            border: 2px solid var(--premium-gold);
            box-shadow: 0 2px 10px rgba(201, 170, 111, 0.3);
        }

        .navbar-custom .nav-user span.h5,
        .navbar-custom .nav-user span.h6 {
            color: #fff !important;
        }

        /* Profile Dropdown */
        .profile-dropdown {
            background: linear-gradient(180deg, #fffaf1 0%, #ffffff 100%);
            border: 1px solid #e9d7ad;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(15, 33, 59, 0.15);
            padding: 10px 0;
        }

        .profile-dropdown .dropdown-item {
            color: #1a3354;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .profile-dropdown .dropdown-item i {
            color: #1e3a61;
            margin-right: 12px;
            font-size: 16px;
        }

        .profile-dropdown .dropdown-item:hover {
            background: linear-gradient(135deg, #fff9ec 0%, #f5f8fd 100%);
            color: var(--premium-primary);
            padding-left: 25px;
        }

        .profile-dropdown .dropdown-item:hover i {
            color: var(--premium-gold);
        }

        /* Button Menu Mobile */
        .button-menu-mobile {
            background: linear-gradient(135deg, #c9aa6f 0%, #d9c4a0 100%) !important;
            color: var(--premium-primary) !important;
            border-radius: 10px;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(201, 170, 111, 0.3);
            transition: all 0.3s ease;
        }

        .button-menu-mobile:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(201, 170, 111, 0.4);
        }

        /* Page Title in Topbar */
        .navbar-custom .d-none.d-lg-block.pt-2 h3 {
            font-family: 'Cormorant Garamond', serif;
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.03em;
        }

        .navbar-custom .d-none.d-lg-block.pt-2 h3 .text-primary {
            color: var(--premium-gold) !important;
        }

        /* Footer */
        .footer {
            background: linear-gradient(180deg, #fdf8f0 0%, #f5f0e6 100%);
            border-top: 1px solid #e9d7ad;
            padding: 20px 0;
        }

        .footer .col-sm-12 {
            color: #1a3354 !important;
            font-weight: 600;
        }

        /* Card improvements for consistency */
        .card {
            border: 1px solid #e6dac3;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(14, 31, 50, 0.08);
        }

        .card .card-header {
            background: linear-gradient(180deg, #fffaf1 0%, #f7fbff 100%);
            border-bottom: 1px solid #ebdfcc;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .leftside-menu {
                background: var(--premium-primary) !important;
            }
        }

        body[data-leftbar-theme=dark] .leftside-menu {
            background: #142947 !important;
        }

        body[data-leftbar-theme=dark] .leftside-menu .logo {
            background: #142947 !important;
        }

        .simplebar-offset{
            margin-bottom: 200px !important;
        }
    </style>

    <title>@yield('title', '') | {{ config('detailsApp.name') }}</title>
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->
            <a href="{{ url('member/dashboard') }}" class="logo text-center">
                <div class="particles">
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                    <span class="particle"></span>
                </div>
                <div class="gradient-wave"></div>
                <div class="logo-wrapper">
                    <img src="{{ asset('logo/logo.png') }}" alt="" width="100">
                </div>
                {{-- <span class="brand-name">{{ config('detailsApp.name') }}</span> --}}
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title side-nav-item"></li>

                    <li class="side-nav-item">
                        <a href="{{ url('member/dashboard') }}" aria-expanded="false" class="side-nav-link">
                            <i class="uil-layers"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false"
                            aria-controls="sidebarPages" class="side-nav-link">
                            <i class="uil-user-circle"></i>
                            <span>Profile Section</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('member/profile/profile-details') }}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/member-kyc') }}">KYC</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/profile/security') }}">Security</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarfund" aria-expanded="false"
                            aria-controls="sidebarfund" class="side-nav-link">
                            <i class="uil-usd-circle"></i>
                            <span>Import Fund</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarfund">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('member/deposit/fund-requests') }}">Fund Request</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/deposit/request-history') }}">Request History</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages1101" aria-expanded="false"
                            aria-controls="sidebarPages1101" class="side-nav-link">
                            <i class="uil-suitcase"></i>
                            <span> Activation </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages1101">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('member/account-activation') }}">Buy Products</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="{{ url('member/dispatched-order') }}">Dispatched Orders</a>-->
                                <!--</li>-->
                                <li>
                                    <a href="{{ url('member/order-history') }}">Order History</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages100" aria-expanded="false"
                            aria-controls="sidebarPages100" class="side-nav-link">
                            <i class="uil-suitcase"></i>
                            <span> Income Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages100">
                            <ul class="side-nav-second-level">

                               <li>
                                    <a href="{{ url('member/income/binary-matching-income') }}">Binary Matching
                                        Income</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/income/sales-bonus-income') }}">Sales Bonus Income</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="{{ url('member/income/level-income') }}">Level Income</a>-->
                                <!--</li>-->
                                <li>
                                    <a href="{{ url('member/income/travel-fund-income') }}">Travel Fund Income</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/income/club-income') }}">Club Income</a>
                                </li>
                               

                            </ul>
                        </div>
                    </li>
                    
                     <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages101" aria-expanded="false"
                            aria-controls="sidebarPages101" class="side-nav-link">
                            <i class="uil-suitcase"></i>
                            <span> Reward Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages101">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('member/income/reward-income') }}">Reward Income</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/income/reward-details') }}">Reward Details</a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages12" aria-expanded="false"
                            aria-controls="sidebarPages12" class="side-nav-link">
                            <i class="mdi mdi-wallet-outline"></i>
                            <span> P2P Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages12">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('member/p2p-transfer') }}"> P2P Transfer</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/p2p-transfer-hisory') }}"> P2P Transfer History</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages6" aria-expanded="false"
                            aria-controls="sidebarPages6" class="side-nav-link">
                            <i class="mdi mdi-account-group-outline"></i>
                            <span> Team Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages6">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('member/team/geneology') }}">Genealogy
                                        Tree</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/team/direct-members') }}">Direct Members</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/team/level-members-table') }}">Level Member Table</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages7" aria-expanded="false"
                            aria-controls="sidebarPages7" class="side-nav-link">
                            <i class="mdi mdi-wallet-outline"></i>
                            <span> Wallet Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages7">
                            <ul class="side-nav-second-level">
                                <!--<li>-->
                                <!--    <a href="{{ url('member/wallet/main-wallet') }}">Main Wallet</a>-->
                                <!--</li>-->
                                <li>
                                    <a href="{{ url('member/wallet/wallet-transfer') }}">Wallet Transfer</a>
                                </li>
                                <li>
                                    <a href="{{ url('member/wallet/withdrawal-history') }}">Withdrawal History</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages8" aria-expanded="false"
                            aria-controls="sidebarPages8" class="side-nav-link">
                            <i class="uil-money-withdrawal"></i>
                            <span> Support </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages8">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('/member/support/create-ticket') }}">Create New Ticket</a>
                                </li>
                                <li>
                                    <a href="{{ url('/member/support/support-tickets') }}">Support Ticket</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ url('member/logout') }}" class="side-nav-link">
                            <i class="uil-comments-alt"></i>
                            <span> Logout </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">


                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ url('/member/cart') }}">
                                <i class="mdi mdi-shopping-outline"
                                    style="font-size: 22px;vertical-align: middle;line-height: 70px;"></i>
                                <span class="noti-icon-badge"
                                    style=" display: inline-block !important;position: absolute !important;top: 14px !important;border-radius: 50% !important;height: 20px !important;width: 20px !important;background-color: red !important;color: white !important;right: -13px;">{{ countCart() }}</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false"
                                style="background: transparent;border:none !important">
                                <span class="account-user-avatar">
                                    @if ($data['profile_image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $data['profile_image'] }}"
                                            class="rounded-circle header-profile-user" alt="profile"
                                            width="32" />
                                    @else
                                        <img src="{{ asset('uploads/avatar.jpg') }}"
                                            class="rounded-circle header-profile-user" alt="profile"
                                            width="32" />
                                    @endif
                                    {{-- <img src="{{ asset('uploads/avatar.jpg') }}" alt="user-image" width="32"
                                        class="rounded-circle"> --}}
                                </span>
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0">{{ $data['name'] }}</h5>
                                    <h6 class="my-0 fw-normal">{{ $data['memberid'] }}</h6>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                {{-- <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome {{ $data['memberid'] }}! </h6>
                                </div> --}}

                                <!-- item-->
                                <a href="{{ url('/member/profile/profile-details') }}" class="dropdown-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>Profile</span>
                                </a>

                                <!-- item-->
                                <!--<a href="{{ url('/member/buy-product') }}" class="dropdown-item">-->
                                <!--    <i class="mdi mdi-account-edit me-1"></i>-->
                                <!--    <span>Order</span>-->
                                <!--</a>-->

                                <!-- item-->
                                <a href="{{ url('member/logout') }}" class="dropdown-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>



                    </ul>
                    <button class="button-menu-mobile open-left me-2"
                        style="margin-top:15px !important;margin-left:2px">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <div class="d-none d-lg-block pt-2">
                        <h3>{{ config('detailsApp.name') }} / <span class="text-primary">@yield('title')</span></h3>
                    </div>

                </div>
                <!-- end Topbar -->
