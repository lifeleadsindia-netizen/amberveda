<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="keywords" content="Amberveda, Ayurvedic, Healthcare, Wellness, MLM, Refer and Earn" />
    <meta name="description"
        content="Amberveda Wellness Pvt Ltd - Nature. Nurture. Wellness. Authentic Ayurvedic healthcare products with a rewarding refer and earn program." />
        <link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('logo/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />
    
    <title>Amberveda Wellness Pvt Ltd</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('front_assets/assets/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        id="bsCDN">
    <script>
        // Only keep CDN if local fails
        var localBS = document.querySelector('link[href*="{{ asset('front_assets/assets/css/lib/bootstrap.min.css') }}"]');
        var testEl = document.createElement('div');
        testEl.className = 'd-flex';
        document.body && document.body.appendChild(testEl);
        if (window.getComputedStyle(testEl).display === 'flex') {
            // local loaded fine — remove CDN duplicate
            document.getElementById('bsCDN') && document.getElementById('bsCDN').remove();
        }
        testEl.remove && testEl.remove();
    </script>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Jost:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front_assets/assets/css/lib/animate.css') }}" />

    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C96A;
            --gold-dark: #9A7A35;
            --green: #3D6B35;
            --green-light: #5A8A50;
            --green-pale: #E8F0E6;
            --cream: #FAF7F0;
            --cream-dark: #F0E8D8;
            --dark: #1A1A1A;
            --text: #3A3A3A;
            --text-light: #666666;
            --white: #FFFFFF;
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
            font-family: 'Jost', sans-serif;
            color: var(--text);
            background: var(--cream);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Cormorant Garamond', serif;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gold);
            border-radius: 3px;
        }

        /* TOP BAR */
        .top-bar {
            background: var(--green);
            color: #fff;
            padding: 8px 0;
            font-size: 13px;
        }

        .top-bar a {
            color: var(--gold-light);
            text-decoration: none;
        }

        .top-bar .social-icons a {
            color: rgba(255, 255, 255, 0.7);
            margin-left: 14px;
            font-size: 14px;
            transition: color 0.3s;
            text-decoration: none;
        }

        .top-bar .social-icons a:hover {
            color: var(--gold-light);
        }

        /* NAVBAR */
        .navbar {
            background: rgba(250, 247, 240, 0.97);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(201, 168, 76, 0.2);
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .navbar.scrolled {
            padding: 6px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand img {
            height: 80px;
        }

        .brand-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--green);
        }

        .brand-text span {
            color: var(--gold);
        }

        /* Mobile toggler — custom gold hamburger */
        .navbar-toggler {
            border: 1.5px solid rgba(201, 168, 76, 0.5);
            border-radius: 8px;
            padding: 6px 10px;
            background: transparent;
            outline: none !important;
            box-shadow: none !important;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='%23C9A84C' stroke-width='2.5' stroke-linecap='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        /* Mobile nav collapse panel */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: var(--white);
                border: 1px solid rgba(201, 168, 76, 0.15);
                border-radius: 16px;
                margin-top: 12px;
                padding: 16px 8px;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            }

            .navbar-nav .nav-link {
                padding: 12px 20px !important;
                border-radius: 10px;
            }

            .navbar-nav .nav-link:hover {
                background: rgba(201, 168, 76, 0.06);
            }

            .navbar-nav .nav-link::after {
                display: none;
            }

            .navbar-collapse .d-flex {
                padding: 12px 20px 4px;
                gap: 10px;
                border-top: 1px solid rgba(201, 168, 76, 0.12);
                margin-top: 8px;
            }

            .btn-nav-login,
            .btn-nav-reg {
                text-align: center;
                flex: 1;
                margin-left: 0 !important;
            }
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            font-size: 13px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 8px 16px !important;
            position: relative;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: all 0.3s;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover {
            color: var(--gold-dark) !important;
        }

        .navbar-nav .nav-link:hover::after {
            width: 60%;
        }

        .btn-nav-login {
            border: 1.5px solid var(--green);
            color: var(--green) !important;
            padding: 7px 18px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
            text-decoration: none;
            margin-left: 6px;
        }

        .btn-nav-login:hover {
            background: var(--green);
            color: #fff !important;
        }

        .btn-nav-reg {
            background: var(--gold);
            color: #fff !important;
            padding: 7px 18px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
            text-decoration: none;
            margin-left: 6px;
            border: 1.5px solid var(--gold);
        }

        .btn-nav-reg:hover {
            background: var(--gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(201, 168, 76, 0.3);
        }

        /* HERO */
        .hero {
            min-height: 90vh;
            background: linear-gradient(135deg, #0f1e0c 0%, #1e3d18 40%, #2d5527 70%, #3D6B35 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 75% 50%, rgba(201, 168, 76, 0.12) 0%, transparent 55%),
                radial-gradient(ellipse at 20% 90%, rgba(201, 168, 76, 0.06) 0%, transparent 40%);
        }

        .hero-dots {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(201, 168, 76, 0.08) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 80px 0;
        }

        .hero-pill {
            display: inline-block;
            background: rgba(201, 168, 76, 0.15);
            border: 1px solid rgba(201, 168, 76, 0.35);
            color: var(--gold-light);
            padding: 8px 22px;
            border-radius: 30px;
            font-size: 12px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 28px;
            font-weight: 500;
        }

        .hero h1 {
            font-size: clamp(2.4rem, 5vw, 4.2rem);
            font-weight: 600;
            line-height: 1.12;
            margin-bottom: 22px;
            color: #fff;
        }

        .hero h1 em {
            color: var(--gold-light);
            font-style: italic;
        }

        .hero p.lead-text {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.85;
            max-width: 500px;
            margin-bottom: 38px;
            font-weight: 300;
        }

        .hero-btns {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-primary-gold {
            background: var(--gold);
            color: #fff;
            border: none;
            padding: 14px 36px;
            border-radius: 35px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-gold:hover {
            background: var(--gold-dark);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(201, 168, 76, 0.35);
        }

        .btn-outline-white {
            background: transparent;
            color: rgba(255, 255, 255, 0.85);
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            padding: 13px 36px;
            border-radius: 35px;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-outline-white:hover {
            border-color: var(--gold-light);
            color: var(--gold-light);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 54px;
            padding-top: 38px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--gold-light);
            line-height: 1;
        }

        .stat-lbl {
            font-size: 11px;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.55);
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .orbit-ring {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            border: 1px solid rgba(201, 168, 76, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: spin 25s linear infinite;
        }

        .orbit-inner {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 168, 76, 0.1) 0%, rgba(45, 85, 39, 0.3) 100%);
            border: 1px solid rgba(201, 168, 76, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .orbit-logo {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgb(255 255 255);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: spin 25s linear infinite reverse;
        }

        .orbit-logo img {
            width: 180px;
            filter: drop-shadow(0 8px 25px rgba(201, 168, 76, 0.5));
        }

        .orbit-dot {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--gold);
            border-radius: 50%;
            box-shadow: 0 0 12px rgba(201, 168, 76, 0.9);
        }

        .d1 {
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .d2 {
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .d3 {
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
        }

        .d4 {
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* FEATURES BAR */
        .feat-bar {
            background: var(--cream);
            border-top: 1px solid rgba(201, 168, 76, 0.12);
            border-bottom: 1px solid rgba(201, 168, 76, 0.12);
            padding: 52px 0;
            position: relative;
            overflow: hidden;
        }

        .feat-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.4), transparent);
        }

        .feat-bar::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.4), transparent);
        }

        .feat-bar-inner {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
        }

        .feat-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 10px 36px;
            position: relative;
            transition: all 0.3s;
        }

        /* Vertical divider lines between items */
        .feat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 10%;
            bottom: 10%;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(201, 168, 76, 0.35), transparent);
        }

        .feat-icon-wrap {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
            transition: transform 0.3s;
        }

        .feat-item:hover .feat-icon-wrap {
            transform: translateY(-4px);
        }

        .feat-icon-wrap i {
            font-size: 28px;
            color: var(--gold);
            transition: color 0.3s;
        }

        .feat-item:hover .feat-icon-wrap i {
            color: var(--gold-dark);
        }

        .feat-text {
            max-width: 220px;
        }

        .feat-text h6 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            font-size: 1.05rem;
            margin: 0 0 6px;
            color: var(--dark);
            letter-spacing: 0.3px;
        }

        .feat-text p {
            font-size: 13px;
            color: var(--text-light);
            margin: 0;
            line-height: 1.6;
        }

        /* Mobile: stack vertically, single column */
        @media (max-width: 767px) {
            .feat-bar {
                padding: 36px 0;
            }

            .feat-bar-inner {
                flex-direction: column;
                align-items: stretch;
            }

            .feat-item {
                padding: 24px 28px;
                flex-direction: row;
                text-align: left;
                gap: 18px;
            }

            .feat-item:not(:last-child)::after {
                right: auto;
                top: auto;
                left: 10%;
                right: 10%;
                bottom: 0;
                top: auto;
                width: auto;
                height: 1px;
                background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.25), transparent);
            }

            .feat-icon-wrap {
                margin: 0;
                flex-shrink: 0;
                width: 52px;
                height: 52px;
            }

            .feat-icon-wrap i {
                font-size: 22px;
            }

            .feat-text {
                max-width: 100%;
            }

            .feat-text h6 {
                font-size: 1rem;
            }

            .feat-item:hover .feat-icon-wrap {
                transform: none;
            }
        }

        /* SECTION HELPERS */
        .sec-label {
            display: inline-block;
            color: var(--gold-dark);
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 10px;
            position: relative;
            padding-left: 28px;
        }

        .sec-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 18px;
            height: 1.5px;
            background: var(--gold);
            transform: translateY(-50%);
        }

        .sec-title {
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            font-weight: 600;
            color: var(--dark);
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .sec-title span {
            color: var(--green);
            font-style: italic;
        }

        .sec-div {
            width: 50px;
            height: 2px;
            background: linear-gradient(to right, var(--gold), var(--gold-light));
            margin: 18px 0;
        }

        .sec-div.c {
            margin: 18px auto;
        }

        /* ABOUT */
        .about-sec {
            padding: 100px 0;
            background: var(--white);
        }

        .about-vis {
            background: linear-gradient(135deg, var(--green-pale), var(--cream-dark));
            border-radius: 20px;
            height: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .about-vis-content {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .about-vis-content .leaf-emoji {
            font-size: 80px;
            display: block;
            margin-bottom: 16px;
        }

        .about-vis-content .tagline {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            color: var(--green);
            font-style: italic;
        }

        .about-badge {
            position: absolute;
            bottom: -25px;
            right: -15px;
            width: 170px;
            height: 170px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 15px 40px rgba(61, 107, 53, 0.38);
        }

        .about-badge .b-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
        }

        .about-badge .b-txt {
            font-size: 12px;
            opacity: 0.88;
            text-align: center;
            line-height: 1.4;
        }

        .about-decor {
            position: absolute;
            top: -18px;
            left: -18px;
            width: 180px;
            height: 180px;
            border: 2px solid rgba(201, 168, 76, 0.3);
            border-radius: 18px;
        }

        .feat-row {
            margin-top: 28px;
        }

        .feat-row-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 20px;
        }

        .fri-icon {
            width: 46px;
            height: 46px;
            background: var(--green-pale);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 18px;
            flex-shrink: 0;
        }

        .fri-icon i {}

        .feat-row-item h6 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .feat-row-item p {
            font-size: 13.5px;
            color: var(--text-light);
            line-height: 1.6;
            margin: 0;
        }

        /* PRODUCTS */
        .prod-sec {
            padding: 100px 0;
            background: var(--cream);
        }

        /* LARGE PRODUCT CARDS */
        .prod-card-large {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(201, 168, 76, 0.15);
            transition: all 0.4s;
            height: 100%;
        }

        .prod-card-large:hover {
            transform: translateY(-10px);
            box-shadow: 0 32px 70px rgba(61, 107, 53, 0.14);
        }

        .prod-large-header {
            padding: 44px 36px 36px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .prod-header-ayur {
            background: linear-gradient(145deg, #1e3d18 0%, #3D6B35 60%, #5A8A50 100%);
        }

        .prod-header-agri {
            background: linear-gradient(145deg, #2a1f05 0%, #8B6914 60%, #C9A84C 100%);
        }

        .prod-large-header::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .prod-large-header::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -30px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .prod-large-badge {
            display: inline-block;
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: rgba(255, 255, 255, 0.75);
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .prod-large-ico {
            font-size: 52px;
            display: block;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .prod-large-header h3 {
            font-size: 1.9rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .prod-large-header p {
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
            position: relative;
            z-index: 1;
            margin: 0;
        }

        .prod-large-body {
            padding: 32px 36px 36px;
        }

        .prod-feature-list {
            margin-bottom: 22px;
        }

        .pfl-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(201, 168, 76, 0.1);
            font-size: 14px;
            color: var(--text);
            line-height: 1.5;
        }

        .pfl-item:last-child {
            border-bottom: none;
        }

        .pfl-dot {
            width: 8px;
            height: 8px;
            background: var(--green);
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .pfl-dot-gold {
            background: var(--gold);
        }

        .prod-tags-row {
            margin-bottom: 24px;
        }

        .prod-tag {
            display: inline-block;
            background: var(--green-pale);
            color: var(--green);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 500;
            margin: 3px 3px;
        }

        .prod-tag-gold {
            background: rgba(201, 168, 76, 0.1);
            color: var(--gold-dark);
        }

        .prod-large-btn {
            display: inline-flex;
            align-items: center;
            background: var(--green);
            color: #fff;
            padding: 12px 28px;
            border-radius: 30px;
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .prod-large-btn:hover {
            background: var(--green-light);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(61, 107, 53, 0.3);
        }

        .prod-large-btn-gold {
            background: var(--gold);
        }

        .prod-large-btn-gold:hover {
            background: var(--gold-dark);
            box-shadow: 0 10px 25px rgba(201, 168, 76, 0.35);
        }

        /* MLM OVERVIEW ROW */
        .mlm-overview-row {
            background: var(--white);
            border: 1px solid rgba(201, 168, 76, 0.2);
            border-radius: 20px;
            padding: 28px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 8px;
        }

        .mlm-overview-item {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .mlm-ov-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--green-pale), rgba(201, 168, 76, 0.1));
            border-radius: 13px;
            border: 1px solid rgba(201, 168, 76, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--green);
            flex-shrink: 0;
        }

        .mlm-ov-label {
            font-size: 11px;
            letter-spacing: 1px;
            color: var(--text-light);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .mlm-ov-val {
            font-weight: 600;
            font-size: 14px;
            color: var(--dark);
        }

        .mlm-overview-divider {
            width: 1px;
            height: 50px;
            background: rgba(201, 168, 76, 0.2);
            flex-shrink: 0;
        }

        @media (max-width: 767px) {
            .mlm-overview-row {
                flex-direction: column;
                padding: 24px;
            }

            .mlm-overview-divider {
                width: 100%;
                height: 1px;
            }
        }

        /* MLM INCOME CARDS */
        .mlm-income-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(201, 168, 76, 0.12);
            transition: all 0.4s;
            height: 100%;
        }

        .mlm-income-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 55px rgba(61, 107, 53, 0.13);
            border-color: rgba(201, 168, 76, 0.25);
        }

        .mic-header {
            padding: 28px 26px 22px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
            overflow: hidden;
        }

        .mic-green {
            background: linear-gradient(135deg, #1e3d18, #3D6B35);
        }

        .mic-gold {
            background: linear-gradient(135deg, #5a3800, #9A7A35);
        }

        .mic-header::after {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .mic-icon {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #fff;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .mic-pct {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            margin-bottom: 4px;
            position: relative;
            z-index: 1;
        }

        .mic-header h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .mic-body {
            padding: 22px 24px 24px;
        }

        .mic-body p {
            font-size: 13.5px;
            color: var(--text-light);
            line-height: 1.7;
            margin-bottom: 14px;
        }

        .mic-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .mic-tag {
            background: var(--cream);
            color: var(--text-light);
            border: 1px solid rgba(201, 168, 76, 0.18);
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        /* MISSION VISION */
        .mv-sec {
            padding: 100px 0;
            background: linear-gradient(135deg, #0f1e0c 0%, #1e3d18 60%, #0f1e0c 100%);
            position: relative;
            overflow: hidden;
        }

        .mv-sec::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(201, 168, 76, 0.04) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .mv-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(201, 168, 76, 0.18);
            border-radius: 20px;
            padding: 44px 32px;
            text-align: center;
            backdrop-filter: blur(8px);
            transition: all 0.4s;
            height: 100%;
        }

        .mv-card:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(201, 168, 76, 0.38);
            transform: translateY(-8px);
        }

        .mv-ico {
            width: 76px;
            height: 76px;
            background: rgba(201, 168, 76, 0.12);
            border: 1px solid rgba(201, 168, 76, 0.28);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            font-size: 28px;
            color: var(--gold-light);
        }

        .mv-card h3 {
            font-size: 1.85rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 14px;
        }

        .mv-card h3 span {
            color: var(--gold-light);
            font-style: italic;
        }

        .mv-card p {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.68);
            line-height: 1.8;
        }

        .mv-sm .mv-card {
            padding: 28px 24px;
        }

        .mv-sm .mv-card .emoji {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .mv-sm .mv-card h3 {
            font-size: 1.3rem;
        }

        .mv-sm .mv-card p {
            font-size: 13.5px;
        }

        /* REFER & EARN */
        .refer-sec {
            padding: 100px 0;
            background: var(--white);
        }

        .refer-hero-box {
            background: linear-gradient(135deg, var(--gold) 0%, #a07020 100%);
            border-radius: 26px;
            padding: 56px 48px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .refer-hero-box::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
        }

        .refer-hero-box::after {
            content: '';
            position: absolute;
            bottom: -70px;
            left: -60px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .ref-pill {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 18px;
            font-weight: 500;
        }

        .refer-hero-box h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .refer-hero-box p {
            font-size: 1rem;
            opacity: 0.88;
            line-height: 1.75;
            margin-bottom: 30px;
        }

        .btn-ref {
            background: #fff;
            color: var(--gold-dark);
            padding: 13px 32px;
            border-radius: 28px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            text-transform: uppercase;
            position: relative;
            z-index: 1;
        }

        .btn-ref:hover {
            background: var(--dark);
            color: #fff;
            transform: translateY(-2px);
        }

        .mlm-step-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 28px;
        }

        .step-num {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(201, 168, 76, 0.32);
        }

        .mlm-step-item h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .mlm-step-item p {
            font-size: 13.5px;
            color: var(--text-light);
            line-height: 1.6;
            margin: 0;
        }

        .earn-card {
            background: var(--cream);
            border-radius: 16px;
            padding: 30px 22px;
            text-align: center;
            border: 1px solid rgba(201, 168, 76, 0.15);
            transition: all 0.3s;
            height: 100%;
        }

        .earn-card:hover {
            background: var(--white);
            border-color: var(--gold);
            transform: translateY(-6px);
            box-shadow: 0 14px 38px rgba(201, 168, 76, 0.14);
        }

        .earn-ico {
            width: 62px;
            height: 62px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 22px;
            color: #fff;
        }

        .earn-card h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .earn-card p {
            font-size: 13.5px;
            color: var(--text-light);
            line-height: 1.65;
        }

        /* WHY US */
        .why-sec {
            padding: 100px 0;
            background: var(--cream);
        }

        .why-card {
            background: var(--white);
            border-radius: 20px;
            padding: 34px 26px;
            border-left: 4px solid var(--gold);
            transition: all 0.3s;
            height: 100%;
        }

        .why-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 50px rgba(0, 0, 0, 0.07);
            border-left-color: var(--green);
        }

        .why-ico {
            font-size: 34px;
            color: var(--gold);
            margin-bottom: 14px;
            display: block;
        }

        .why-card h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .why-card p {
            font-size: 13.5px;
            color: var(--text-light);
            line-height: 1.7;
        }

        /* TESTIMONIALS */
        .test-sec {
            padding: 100px 0;
            background: var(--white);
        }

        .test-card {
            background: var(--cream);
            border-radius: 20px;
            padding: 34px;
            border: 1px solid rgba(201, 168, 76, 0.12);
            position: relative;
        }

        .test-card::before {
            content: '"';
            position: absolute;
            top: 14px;
            left: 22px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 5rem;
            color: var(--gold);
            opacity: 0.18;
            line-height: 1;
        }

        .test-text {
            font-size: 14.5px;
            color: var(--text);
            line-height: 1.8;
            font-style: italic;
            margin-bottom: 22px;
        }

        .test-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .t-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .t-name {
            font-weight: 600;
            font-size: 14.5px;
            color: var(--dark);
        }

        .t-role {
            font-size: 12px;
            color: var(--text-light);
        }

        .t-stars {
            color: var(--gold);
            font-size: 12px;
            margin-bottom: 14px;
        }

        /* CONTACT */
        .contact-sec {
            padding: 100px 0;
            background: var(--cream);
        }

        .contact-wrap {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.07);
        }

        .contact-left {
            background: linear-gradient(160deg, var(--green) 0%, #1c3a17 100%);
            padding: 56px 38px;
            color: #fff;
            height: 100%;
        }

        .contact-left h3 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #fff;
        }

        .contact-left>p {
            color: rgba(255, 255, 255, 0.68);
            font-size: 14.5px;
            line-height: 1.75;
            margin-bottom: 38px;
        }

        .c-detail {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 22px;
        }

        .c-ico {
            width: 38px;
            height: 38px;
            background: rgba(201, 168, 76, 0.18);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-light);
            font-size: 14px;
            flex-shrink: 0;
        }

        .c-detail h6 {
            font-size: 11px;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.45);
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .c-detail p {
            color: rgba(255, 255, 255, 0.82);
            margin: 0;
            font-size: 14.5px;
        }

        .c-socials {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .c-socials a {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .c-socials a:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(201, 168, 76, 0.1);
        }

        .contact-right {
            padding: 56px 46px;
        }

        .contact-right h3 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--dark);
        }

        .contact-right .sub-text {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 28px;
        }

        .f-label {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .f-control {
            border: 1.5px solid rgba(201, 168, 76, 0.18);
            border-radius: 10px;
            padding: 11px 15px;
            font-size: 14px;
            background: var(--cream);
            color: var(--text);
            transition: all 0.3s;
            width: 100%;
            display: block;
            font-family: 'Jost', sans-serif;
        }

        .f-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.1);
            background: var(--white);
        }

        .f-group {
            margin-bottom: 18px;
        }

        .btn-send {
            background: linear-gradient(135deg, var(--green), var(--green-light));
            color: #fff;
            border: none;
            padding: 13px 38px;
            border-radius: 28px;
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
            cursor: pointer;
            font-family: 'Jost', sans-serif;
        }

        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(61, 107, 53, 0.32);
        }

        /* FOOTER */
        footer {
            background: #0e180d;
            color: rgba(255, 255, 255, 0.65);
            padding-top: 64px;
        }

        .f-logo img {
            height: 75px;
        }

        .f-desc {
            font-size: 13.5px;
            line-height: 1.8;
            margin-top: 14px;
            color: rgba(255, 255, 255, 0.45);
        }

        .f-socials {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .f-socials a {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.45);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .f-socials a:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: rgba(201, 168, 76, 0.08);
        }

        .f-head {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--gold-light);
            margin-bottom: 18px;
            padding-bottom: 8px;
            position: relative;
        }

        .f-head::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 28px;
            height: 1.5px;
            background: var(--gold);
        }

        .f-links {
            list-style: none;
            padding: 0;
        }

        .f-links li {
            margin-bottom: 9px;
        }

        .f-links a {
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            font-size: 13.5px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .f-links a:hover {
            color: var(--gold-light);
            padding-left: 5px;
        }

        .f-links a i {
            font-size: 9px;
            color: var(--gold);
        }

        .f-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, 0.45);
            font-size: 13.5px;
        }

        .f-contact-item i {
            color: var(--gold);
            margin-top: 2px;
        }

        .f-hr {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            margin: 38px 0 18px;
        }

        .f-bottom {
            padding-bottom: 28px;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.3);
        }

        .f-bottom a {
            color: rgba(255, 255, 255, 0.3);
            text-decoration: none;
            margin-left: 18px;
            transition: color 0.3s;
        }

        .f-bottom a:hover {
            color: var(--gold-light);
        }

        /* TO TOP */
        .to-top {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 42px;
            height: 42px;
            background: var(--gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 6px 18px rgba(201, 168, 76, 0.4);
            z-index: 999;
        }

        .to-top:hover {
            background: var(--green);
            color: #fff;
            transform: translateY(-4px);
        }

        /* ANIMATE ON SCROLL */
        .anim {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .anim.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .hero {
                min-height: auto;
            }

            .orbit-ring {
                width: 280px;
                height: 280px;
            }

            .orbit-inner {
                width: 210px;
                height: 210px;
            }

            .orbit-logo {
                width: 155px;
                height: 155px;
            }

            .orbit-logo img {
                width: 120px;
            }

            .hero-visual {
                margin-top: 40px;
            }

            .refer-hero-box {
                padding: 36px 28px;
            }

            .contact-right {
                padding: 36px 28px;
            }

            .contact-left {
                padding: 36px 28px;
            }

            .about-badge {
                width: 130px;
                height: 130px;
                bottom: -18px;
                right: -8px;
            }

            .about-decor {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .hero-stats {
                gap: 22px;
            }

            .stat-num {
                font-size: 1.8rem;
            }

            .feat-item {
                margin-bottom: 14px;
            }
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-envelope me-2"></i>
                <a href="mailto:info@ambervedawellness.com">info@ambervedawellness.com</a>
                <span class="d-none d-md-inline">&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fas fa-phone me-2"></i><a
                        href="tel:+919259234438">+91 9259234438</a></span>
            </div>
            <div class="social-icons d-none d-md-flex">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('front_assets/assets/img/logo.png') }}" alt="">
                <span class="brand-text">AMBER<span>VEDA</span></span>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#mission">Mission &amp; Vision</a></li>
                    <li class="nav-item"><a class="nav-link" href="#refer">Refer &amp; Earn</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ url('/member') }}" class="btn-nav-login">Login</a>
                    <a href="{{ url('/member/register/1/side') }}" class="btn-nav-reg">Register</a>
                    <a href="/uploads/apk/amberveda.apk" 
       class="btn-nav-login" 
       download="amberveda.apk">
        <i class="fab fa-android"></i> Download Android APK
    </a>
                    
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero" id="home">
        <div class="hero-dots"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="hero-pill">🌿 Wellness • Nature • Agriculture</span>

                        <h1>Empowering Health<br>Through <em>Nature</em><br>& Farming</h1>

                        <p class="lead-text">
                            Bringing together natural wellness and modern agriculture to create a healthier future.
                            We believe in purity, sustainability, and products inspired by nature for everyday
                            wellbeing.
                        </p>

                        <div class="hero-btns">
    
    <a href="{{ url('/member') }}" class="btn-primary-gold">
        <i class="fas fa-sign-in-alt"></i> Login
    </a>

    <a href="{{ url('/member/register/1/side') }}" class="btn-outline-white">
        <i class="fas fa-user-plus"></i> Register
    </a>

    <!-- Android APK Download Button -->
    <a href="/uploads/apk/amberveda.apk" 
       class="btn-outline-white" 
       download="amberveda.apk">
        <i class="fab fa-android"></i> Download Android APK
    </a>

</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="orbit-ring">
                            <div class="orbit-dot d1"></div>
                            <div class="orbit-dot d2"></div>
                            <div class="orbit-dot d3"></div>
                            <div class="orbit-dot d4"></div>
                            <div class="orbit-inner">
                                <div class="orbit-logo">
                                    <img src="{{ asset('front_assets/assets/img/logo.png') }}" alt="Amberveda"
                                        onerror="this.parentElement.innerHTML='<div style=\'font-family:Cormorant Garamond,serif; font-size:1.4rem; font-weight:700; color:#fff; text-align:center; line-height:1.3;\'>AMBER<br><span style=\'color:#E8C96A;\'>VEDA</span><br><small style=\'font-size:0.6rem; letter-spacing:2px; opacity:0.7;\'>WELLNESS</small></div>'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES BAR -->
    <div class="feat-bar">
        <div class="container">
            <div class="feat-bar-inner">
                <div class="feat-item">
                    <div class="feat-icon-wrap">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <div class="feat-text">
                        <h6>Direct Selling</h6>
                        <p>High-quality, product-based direct selling structure</p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon-wrap">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="feat-text">
                        <h6>Nature-First Wellness</h6>
                        <p>Elegant, nature-first wellness brand rooted in Ayurveda</p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon-wrap">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <div class="feat-text">
                        <h6>India &amp; Global Vision</h6>
                        <p>India-focused community growth with a strong global vision</p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon-wrap">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feat-text">
                        <h6>24/7 Support</h6>
                        <p>Always here for you — every step of your wellness journey</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT -->
    <section class="about-sec" id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div style="position: relative; padding-right: 24px; padding-bottom: 30px;">

                        <div class="about-decor"></div>

                        <div class="about-vis" style="overflow:hidden; padding:0;">

                            <!-- ABOUT IMAGE -->
                            <img src="{{ asset('front_assets/assets/img/about-img.jpg') }}" alt="Amberveda Wellness"
                                style="width:100%; height:100%; object-fit:cover; border-radius:28px;">

                            <!-- OPTIONAL OVERLAY CONTENT -->
                            <div class="about-vis-content"
                                style="position:absolute; bottom:35px; left:35px; background:rgba(255,255,255,0.75); padding:18px 24px; border-radius:18px; backdrop-filter:blur(4px);">

                                <span class="leaf-emoji">🌿</span>

                                <p class="tagline" style="margin-bottom:6px;">
                                    Wellness Inspired by Nature
                                </p>

                                <p style="font-size:13px; color:var(--text-light); margin:0;">
                                    Amberveda Wellness Pvt Ltd
                                </p>
                            </div>

                            <!-- SVG DECOR -->
                            <svg style="position:absolute; bottom:-10px; left:-10px; opacity:0.08;" width="180"
                                height="180" viewBox="0 0 180 180">
                                <circle cx="90" cy="90" r="75" fill="none" stroke="#3D6B35"
                                    stroke-width="1.5" />
                                <circle cx="90" cy="90" r="55" fill="none" stroke="#C9A84C"
                                    stroke-width="1" />
                            </svg>

                        </div>

                        <!-- BADGE -->


                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="sec-label">About Us</span>

                    <h2 class="sec-title">Welcome to <span>Amberveda</span> Wellness</h2>

                    <div class="sec-div"></div>

                    <p style="font-size: 14.5px; color: var(--text-light); line-height: 1.9; margin-bottom: 20px;">
                        Amberveda Wellness Pvt Ltd is a wellness and lifestyle company dedicated to bringing quality
                        healthcare, herbal, and agriculture-based products to people across India. We focus on promoting
                        healthier living through trusted and naturally inspired products.
                    </p>

                    <p style="font-size: 14.5px; color: var(--text-light); line-height: 1.9; margin-bottom: 28px;">
                        Our mission is to connect customers with reliable wellness solutions sourced from trusted brands
                        and partners while encouraging a balanced and sustainable lifestyle.
                    </p>

                    <div class="feat-row">

                        <div class="feat-row-item anim">
                            <div class="fri-icon">
                                <i class="fas fa-heart"></i>
                            </div>

                            <div>
                                <h6>Wellness Focused</h6>
                                <p>Committed to supporting healthier lifestyles with everyday wellness products.</p>
                            </div>
                        </div>

                        <div class="feat-row-item anim">
                            <div class="fri-icon">
                                <i class="fas fa-leaf"></i>
                            </div>

                            <div>
                                <h6>Nature Inspired Products</h6>
                                <p>Offering products influenced by natural wellness and agricultural values.</p>
                            </div>
                        </div>

                        <div class="feat-row-item anim">
                            <div class="fri-icon">
                                <i class="fas fa-users"></i>
                            </div>

                            <div>
                                <h6>Customer Commitment</h6>
                                <p>Focused on delivering quality service and building long-term customer trust.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS -->
    <section class="prod-sec" id="products">
        <div class="container">
            <div class="text-center" style="margin-bottom: 60px;">
                <span class="sec-label">Our Offerings</span>
                <h2 class="sec-title">Two Pillars of <span>Natural Excellence</span></h2>
                <div class="sec-div c"></div>
                <p
                    style="max-width: 520px; margin: 0 auto; color: var(--text-light); font-size: 14.5px; line-height: 1.8;">
                    From ancient Ayurvedic healing to sustainable agriculture — we bring nature's best directly to you.
                </p>
            </div>
            <div class="row g-5 justify-content-center">

                <!-- AYURVEDIC WELLNESS -->
                <div class="col-lg-6">
                    <div class="prod-card-large anim">
                        <div class="prod-large-header prod-header-ayur">
                            <div class="prod-large-badge">Category 01</div>
                            <div class="prod-large-ico">🌿</div>
                            <h3>Ayurvedic Wellness</h3>
                            <p>Ancient science. Modern results. Products that heal from within.</p>
                        </div>
                        <div class="prod-large-body">
                            <div class="prod-feature-list">
                                <div class="pfl-item">
                                    <span class="pfl-dot"></span>
                                    <div><strong>Herbal Supplements</strong> — Immunity boosters, adaptogens, digestive
                                        care</div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot"></span>
                                    <div><strong>Ayurvedic Skincare</strong> — Face serums, herbal oils, body care
                                        rituals</div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot"></span>
                                    <div><strong>Nutraceuticals</strong> — Ashwagandha, Turmeric Gold, Moringa blends
                                    </div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot"></span>
                                    <div><strong>Wellness Therapies</strong> — Detox kits, massage oils, aromatherapy
                                    </div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot"></span>
                                    <div><strong>Herbal Teas &amp; Drinks</strong> — Tulsi, detox brews, golden milk
                                    </div>
                                </div>
                            </div>

                            <a href="#contact" class="prod-large-btn">Explore Wellness Range <i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <!-- AGRICULTURE PRODUCTS -->
                <div class="col-lg-6">
                    <div class="prod-card-large anim">
                        <div class="prod-large-header prod-header-agri">
                            <div class="prod-large-badge">Category 02</div>
                            <div class="prod-large-ico">🌾</div>
                            <h3>Agriculture Products</h3>
                            <p>Farm-fresh. Sustainably grown. Directly from soil to soul.</p>
                        </div>
                        <div class="prod-large-body">
                            <div class="prod-feature-list">
                                <div class="pfl-item">
                                    <span class="pfl-dot pfl-dot-gold"></span>
                                    <div><strong>Organic Fertilizers</strong> — Bio-based nutrients for healthier yields
                                    </div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot pfl-dot-gold"></span>
                                    <div><strong>Herbal Pesticides</strong> — Natural crop protection, zero chemicals
                                    </div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot pfl-dot-gold"></span>
                                    <div><strong>Medicinal Herb Seeds</strong> — Ashwagandha, Tulsi, Neem, Shatavari
                                    </div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot pfl-dot-gold"></span>
                                    <div><strong>Soil Enrichment</strong> — Vermicompost, bio-enzymes, micronutrients
                                    </div>
                                </div>
                                <div class="pfl-item">
                                    <span class="pfl-dot pfl-dot-gold"></span>
                                    <div><strong>Farm-to-Table Foods</strong> — Cold-pressed oils, raw honey, organic
                                        grains</div>
                                </div>
                            </div>

                            <a href="#contact" class="prod-large-btn prod-large-btn-gold">Explore Agriculture Range <i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MISSION VISION -->
    <section class="mv-sec" id="mission">
        <div class="container">
            <div class="text-center" style="margin-bottom: 60px;">
                <span class="sec-label" style="color:var(--gold-light);">Our Purpose</span>
                <h2 class="sec-title" style="color:#fff;">Mission &amp; <span
                        style="color:var(--gold-light); font-style:italic;">Vision</span></h2>
                <div class="sec-div c"></div>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mv-card anim">
                        <div class="mv-ico"><i class="fas fa-eye"></i></div>
                        <h3>Our <span>Vision</span></h3>
                        <p>To become India's most trusted Ayurvedic wellness brand — making authentic, science-backed
                            herbal healthcare accessible to every household. We envision a healthier India where ancient
                            wisdom and modern living coexist in beautiful harmony.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mv-card anim">
                        <div class="mv-ico"><i class="fas fa-bullseye"></i></div>
                        <h3>Our <span>Mission</span></h3>
                        <p>To empower individuals and families through high-quality, natural Ayurvedic products — while
                            building a thriving community of wellness ambassadors through our rewarding and
                            refer-and-earn ecosystem.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-2 mv-sm">
                <div class="col-lg-4">
                    <div class="mv-card anim">
                        <div class="emoji">🌿</div>
                        <h3>Nature First</h3>
                        <p>Every product begins with nature's finest, ethically sourced ingredients.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mv-card anim">
                        <div class="emoji">🔬</div>
                        <h3>Science Backed</h3>
                        <p>Modern science validates ancient formulations for proven efficacy and safety.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mv-card anim">
                        <div class="emoji">🤝</div>
                        <h3>Community Driven</h3>
                        <p>We grow together — building a wellness community that earns and thrives as one.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- REFER & EARN -->
    <section class="refer-sec" id="refer" style="display:none;">
        <div class="container">
            <div class="row g-5 align-items-center" style="margin-bottom: 70px;">
                <div class="col-lg-6">
                    <div class="refer-hero-box">
                        <span class="ref-pill">&#128176; MLM Opportunity</span>
                        <h2>Refer Friends.<br>Earn Rewards.<br>Build Wealth.</h2>
                        <p>Join Amberveda's revolutionary refer-and-earn program and unlock a powerful income stream
                            while promoting wellness. The more you share, the more you earn — with multi-level
                            commissions, bonuses, and rewards.</p>
                        <a href="dashboard/register.html" class="btn-ref">Start Earning Today</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="sec-label">How It Works</span>
                    <h2 class="sec-title">Your Path to <span>Financial Wellness</span></h2>
                    <div class="sec-div"></div>
                    <div>
                        <div class="mlm-step-item anim">
                            <div class="step-num">1</div>
                            <div>
                                <h5>Register as a Wellness Ambassador</h5>
                                <p>Sign up for free and create your personal Amberveda ambassador account in minutes.
                                </p>
                            </div>
                        </div>
                        <div class="mlm-step-item anim">
                            <div class="step-num">2</div>
                            <div>
                                <h5>Share Your Unique Referral Link</h5>
                                <p>Share your personalized link with friends, family, and your network across social
                                    media.</p>
                            </div>
                        </div>
                        <div class="mlm-step-item anim">
                            <div class="step-num">3</div>
                            <div>
                                <h5>Earn on Every Purchase &amp; Referral</h5>
                                <p>Earn direct commissions on sales, plus multi-level bonuses from your team's
                                    performance.</p>
                            </div>
                        </div>
                        <div class="mlm-step-item anim">
                            <div class="step-num">4</div>
                            <div>
                                <h5>Grow Your Network &amp; Income</h5>
                                <p>Build a thriving downline and unlock leadership bonuses, travel incentives, and
                                    exclusive rewards.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-12 text-center" style="margin-bottom: 20px;">
                    <h3 class="sec-title">MLM <span>Compensation Plan</span></h3>
                    <div class="sec-div c"></div>
                    <p
                        style="max-width:560px; margin:0 auto; color:var(--text-light); font-size:14.5px; line-height:1.8;">
                        A powerful hybrid income system designed to reward every level of your wellness business.</p>
                </div>

                <!-- Plan Overview Row -->
                <div class="col-12">
                    <div class="mlm-overview-row anim">
                        <div class="mlm-overview-item">
                            <div class="mlm-ov-icon"><i class="fas fa-sitemap"></i></div>
                            <div>
                                <div class="mlm-ov-label">Hybrid Model</div>
                                <div class="mlm-ov-val">Binary Level Income System</div>
                            </div>
                        </div>
                        <div class="mlm-overview-divider"></div>
                        <div class="mlm-overview-item">
                            <div class="mlm-ov-icon"><i class="fas fa-coins"></i></div>
                            <div>
                                <div class="mlm-ov-label">Sales Point (SP) System</div>
                                <div class="mlm-ov-val">ISP. 2100 DP range 2750–23,750</div>
                            </div>
                        </div>
                        <div class="mlm-overview-divider"></div>
                        <div class="mlm-overview-item">
                            <div class="mlm-ov-icon"><i class="fas fa-user-plus"></i></div>
                            <div>
                                <div class="mlm-ov-label">Joining Method</div>
                                <div class="mlm-ov-val">Product Purchase Based Registration</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6 Income Cards -->
                <div class="col-lg-4 col-md-6">
                    <div class="mlm-income-card anim">
                        <div class="mic-header mic-green">
                            <div class="mic-icon"><i class="fas fa-layer-group"></i></div>
                            <div class="mic-pct">30%</div>
                            <h5>Level Income</h5>
                        </div>
                        <div class="mic-body">
                            <p>18 Levels depth. LI: 10%, LZ 5%, L: 3%, LG-5: 2% scaling down to 0.25% at LIG-18.</p>
                            <div class="mic-tags">
                                <span class="mic-tag">18 Levels</span>
                                <span class="mic-tag">Up to 10%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mlm-income-card anim">
                        <div class="mic-header mic-gold">
                            <div class="mic-icon"><i class="fas fa-code-branch"></i></div>
                            <div class="mic-pct">~10%</div>
                            <h5>Binary Matching</h5>
                        </div>
                        <div class="mic-body">
                            <p>1st pair Zor ZI, then II. Rank rewards from Starter (Rik) to Crown Diamond (265L).</p>
                            <div class="mic-tags">
                                <span class="mic-tag">Binary System</span>
                                <span class="mic-tag">Rank Rewards</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mlm-income-card anim">
                        <div class="mic-header mic-green">
                            <div class="mic-icon"><i class="fas fa-gift"></i></div>
                            <div class="mic-pct">5%</div>
                            <h5>Sales Bonus</h5>
                        </div>
                        <div class="mic-body">
                            <p>Milestone matches from Starter (21,500) scaling massively up to Legend Star (225.6 Cr).
                            </p>
                            <div class="mic-tags">
                                <span class="mic-tag">Milestone Based</span>
                                <span class="mic-tag">225.6 Cr Max</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mlm-income-card anim">
                        <div class="mic-header mic-gold">
                            <div class="mic-icon"><i class="fas fa-crown"></i></div>
                            <div class="mic-pct">~8%</div>
                            <h5>Club Income</h5>
                        </div>
                        <div class="mic-body">
                            <p>Share of company turnover. Silver: 2% (ILSP), Gold: 3% (5LSP), Diamond: 5% (IOLSP).</p>
                            <div class="mic-tags">
                                <span class="mic-tag">Silver / Gold / Diamond</span>
                                <span class="mic-tag">Profit Share</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mlm-income-card anim">
                        <div class="mic-header mic-green">
                            <div class="mic-icon"><i class="fas fa-store"></i></div>
                            <div class="mic-pct">6%</div>
                            <h5>Franchise Income</h5>
                        </div>
                        <div class="mic-body">
                            <p>Investments from RIL (Starter) to 225L (Ruby). Yields 4% to 8% plus marketing support.
                            </p>
                            <div class="mic-tags">
                                <span class="mic-tag">4%–8% Yield</span>
                                <span class="mic-tag">Marketing Support</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mlm-income-card anim">
                        <div class="mic-header mic-gold">
                            <div class="mic-icon"><i class="fas fa-plane"></i></div>
                            <div class="mic-pct">5%</div>
                            <h5>Travel Fund</h5>
                        </div>
                        <div class="mic-body">
                            <p>Achieve ZL SP for Domestic Trip, up to 1 Cr SP for Luxury World Tour Fund.</p>
                            <div class="mic-tags">
                                <span class="mic-tag">Domestic Trips</span>
                                <span class="mic-tag">World Tour</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="col-12 text-center" style="margin-top: 16px;">
                    <a href="dashboard/register.html" class="btn-primary-gold"
                        style="font-size:14px; padding:15px 42px;">
                        Join &amp; Start Earning <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section class="why-sec">
        <div class="container">
            <div class="text-center" style="margin-bottom: 60px;">
                <span class="sec-label">Our Advantage</span>
                <h2 class="sec-title">Why Choose <span>Amberveda?</span></h2>
                <div class="sec-div c"></div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="why-card anim">
                        <span class="why-ico"><i class="fas fa-flask"></i></span>
                        <h5>Pure &amp; Authentic Formulations</h5>
                        <p>Every product is crafted with genuine Ayurvedic herbs, free from harmful additives — backed
                            by rigorous quality testing.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="why-card anim">
                        <span class="why-ico"><i class="fas fa-rupee-sign"></i></span>
                        <h5>Affordable Wellness</h5>
                        <p>Luxury Ayurvedic wellness should not be a privilege. Our pricing ensures quality healthcare
                            for every Indian household.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="why-card anim">
                        <span class="why-ico"><i class="fas fa-hands-helping"></i></span>
                        <h5>Empowering Community</h5>
                        <p>Our model is built on genuine product value — creating real income opportunities for
                            thousands of ambassadors.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="why-card anim">
                        <span class="why-ico"><i class="fas fa-shipping-fast"></i></span>
                        <h5>Pan-India Delivery</h5>
                        <p>Fast, reliable shipping to every corner of India. Track your wellness journey from warehouse
                            to doorstep.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="why-card anim">
                        <span class="why-ico"><i class="fas fa-user-md"></i></span>
                        <h5>Expert Guidance</h5>
                        <p>Personalized wellness consultations from certified Ayurvedic practitioners guiding you toward
                            the right products.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="why-card anim">
                        <span class="why-ico"><i class="fas fa-shield-alt"></i></span>
                        <h5>Quality Guarantee</h5>
                        <p>We stand behind every product with a satisfaction guarantee. Your trust is our most precious
                            asset.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="test-sec" style="display:none;">
        <div class="container">
            <div class="text-center" style="margin-bottom: 60px;">
                <span class="sec-label">Success Stories</span>
                <h2 class="sec-title">What Our <span>Community Says</span></h2>
                <div class="sec-div c"></div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="test-card anim">
                        <div class="t-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="test-text">The Ashwagandha supplements changed my life. I sleep better, feel calmer,
                            and my energy levels have improved dramatically within just 30 days of use.</p>
                        <div class="test-author">
                            <div class="t-avatar">P</div>
                            <div>
                                <div class="t-name">Priya Sharma</div>
                                <div class="t-role">Wellness Ambassador, Delhi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="test-card anim">
                        <div class="t-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="test-text">I joined as an ambassador 6 months ago. The products sell themselves
                            because they genuinely work, and my monthly earnings have crossed &#8377;50,000!</p>
                        <div class="test-author">
                            <div class="t-avatar">R</div>
                            <div>
                                <div class="t-name">Rajesh Kumar</div>
                                <div class="t-role">Diamond Ambassador, Mumbai</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="test-card anim">
                        <div class="t-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="test-text">The herbal skincare range is extraordinary. My skin has never looked
                            better, and I love knowing exactly what ingredients I'm putting on my face — all natural.
                        </p>
                        <div class="test-author">
                            <div class="t-avatar">A</div>
                            <div>
                                <div class="t-name">Anita Verma</div>
                                <div class="t-role">Customer, Bangalore</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact-sec" id="contact">
        <div class="container">
            <div class="text-center" style="margin-bottom: 60px;">
                <span class="sec-label">Reach Out</span>
                <h2 class="sec-title">Get In <span>Touch</span></h2>
                <div class="sec-div c"></div>
            </div>
            <div class="contact-wrap">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <div class="contact-left">
                            <h3>Let's Connect</h3>
                            <p>Whether you have questions about our products, want to become a wellness ambassador, or
                                need support — we are here for you.</p>
                            <div class="c-detail">
                                <div class="c-ico"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <h6>Address</h6>
                                    <p>Hall no 5
                                        Second floor Shakumbhari Plaza
                                        Near DPS Baghpat Road 
                                        Meerut-250002</p>
                                </div>
                            </div>
                            <div class="c-detail">
                                <div class="c-ico"><i class="fas fa-envelope"></i></div>
                                <div>
                                    <h6>Email</h6>
                                    <p>info@ambervedawellness.com</p>
                                </div>
                            </div>
                            <div class="c-detail">
                                <div class="c-ico"><i class="fas fa-phone-alt"></i></div>
                                <div>
                                    <h6>Phone</h6>
                                    <p>+91 9259234438</p>
                                </div>
                            </div>
                            <div class="c-detail">
                                <div class="c-ico"><i class="fas fa-clock"></i></div>
                                <div>
                                    <h6>Business Hours</h6>
                                    <p>Mon–Sat: 9:00 AM – 6:00 PM</p>
                                </div>
                            </div>
                            <div class="c-socials">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-right">
                            <h3>Send a Message</h3>
                            <p class="sub-text">We'll get back to you within 24 hours.</p>

                            @if (session('successMsg'))
                                <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-radius: 10px; background-color: #d4edda; border-color: #c3e6cb; color: #155724; font-size: 14.5px; padding: 12px 18px;">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <div>{{ session('successMsg') }}</div>
                                </div>
                            @endif

                            @if (session('errorMsg'))
                                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert" style="border-radius: 10px; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; font-size: 14.5px; padding: 12px 18px;">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <div>{!! session('errorMsg') !!}</div>
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="f-group">
                                            <label class="f-label">Your Name</label>
                                            <input type="text" name="name" class="f-control" placeholder="Arjun Sharma" value="{{ old('name') }}" style="@error('name') border-color: #dc3545; @enderror">
                                            @error('name')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="f-group">
                                            <label class="f-label">Email Address</label>
                                            <input type="email" name="email" class="f-control" placeholder="arjun@email.com" value="{{ old('email') }}" style="@error('email') border-color: #dc3545; @enderror">
                                            @error('email')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="f-group">
                                            <label class="f-label">Phone Number</label>
                                            <input type="tel" name="phone" id="contact_phone" class="f-control" placeholder="9876543210" value="{{ old('phone') }}" maxlength="10" inputmode="numeric" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="@error('phone') border-color: #dc3545; @enderror">
                                            @error('phone')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="f-group">
                                            <label class="f-label">Subject</label>
                                            <select name="subject" class="f-control" style="@error('subject') border-color: #dc3545; @enderror">
                                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a subject</option>
                                                <option value="Product Inquiry" {{ old('subject') == 'Product Inquiry' ? 'selected' : '' }}>Product Inquiry</option>
                                                <option value="Ambassador Program" {{ old('subject') == 'Ambassador Program' ? 'selected' : '' }}>Ambassador Program</option>
                                                <option value="Order Support" {{ old('subject') == 'Order Support' ? 'selected' : '' }}>Order Support</option>
                                                <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('subject')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="f-group">
                                            <label class="f-label">Message</label>
                                            <textarea name="message" class="f-control" rows="5" placeholder="Tell us how we can help you..." style="@error('message') border-color: #dc3545; @enderror">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-send">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="f-logo">
                        <span
                            style="font-family:'Cormorant Garamond',serif; font-size:2rem; font-weight:700; color:#fff;">AMBER<span
                                style="color:var(--gold-light);">VEDA</span></span>
                    </div>
                    <p class="f-desc">Amberveda Wellness Pvt Ltd — rooting ancient Ayurvedic wisdom in modern wellness.
                        Nature. Nurture. Wellness.</p>
                    <div class="f-socials">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 offset-lg-1">
                    <h5 class="f-head">Quick Links</h5>
                    <ul class="f-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#products"><i class="fas fa-chevron-right"></i> Products</a></li>
                        <li><a href="#mission"><i class="fas fa-chevron-right"></i> Mission &amp; Vision</a></li>
                        <li><a href="#refer"><i class="fas fa-chevron-right"></i> Refer &amp; Earn</a></li>
                        <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="f-head">Member Area</h5>
                    <ul class="f-links">
                        <li><a href="{{ url('/member') }}"><i class="fas fa-chevron-right"></i> Member Login</a></li>
                        <li><a href="{{ url('/member/register/1/side') }}"><i class="fas fa-chevron-right"></i>
                                Register Now</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Ambassador Portal</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Earnings Dashboard</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> My Referrals</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="f-head">Contact Info</h5>
                    <div class="f-contact-item"><i class="fas fa-map-marker-alt mt-1"></i> Amberveda Wellness Pvt Ltd,
                        India</div>
                    <div class="f-contact-item"><i class="fas fa-envelope mt-1"></i> info@ambervedawellness.com</div>
                    <div class="f-contact-item"><i class="fas fa-phone mt-1"></i> +91 9259234438</div>
                    <div class="f-contact-item"><i class="fas fa-clock mt-1"></i> Mon–Sat, 9AM – 6PM</div>
                </div>
            </div>
            <hr class="f-hr">
            <div class="f-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span>&#169; 2026 Amberveda Wellness Pvt Ltd. All Rights Reserved.</span>
                <div>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms &amp; Conditions</a>
                    <a href="#">Refund Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="to-top"><i class="fas fa-chevron-up"></i></a>

    <script src="{{ asset('front_assets/assets/js/lib/jquery-3.0.0.min.js') }}"></script>
    <!-- Bootstrap Bundle with Popper - CDN fallback for mobile toggler -->
    <script src="{{ asset('front_assets/assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Bootstrap CDN fallback if local file fails
        if (typeof bootstrap === 'undefined') {
            var s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
            document.head.appendChild(s);
        }
    </script>
    <script>
        // Navbar scroll
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const h = a.getAttribute('href');
                if (h === '#') return;
                e.preventDefault();
                // Close mobile nav if open
                const navCollapse = document.getElementById('navbarNav');
                if (navCollapse && navCollapse.classList.contains('show')) {
                    navCollapse.classList.remove('show');
                }
                const t = document.querySelector(h);
                if (t) t.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Close mobile nav when clicking outside
        document.addEventListener('click', function(e) {
            const nav = document.getElementById('navbarNav');
            const toggler = document.querySelector('.navbar-toggler');
            if (nav && nav.classList.contains('show') && !nav.contains(e.target) && !toggler.contains(e.target)) {
                nav.classList.remove('show');
            }
        });

        // Animate on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.12
        });
        document.querySelectorAll('.anim').forEach(el => observer.observe(el));

        // Restrict contact phone input to digits only, max 10 digits
        const contactPhone = document.getElementById('contact_phone');
        if (contactPhone) {
            contactPhone.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
            });
        }
    </script>
</body>

</html>
