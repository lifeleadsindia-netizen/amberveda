@php
    $side = $side ?? 'Left';
    $countries = $countries ?? ($country ?? []);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sign Up | {{ config('detailsApp.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
<link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('logo/favicon/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
<link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />
    <link href="{{ asset('mem_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mem_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('mem_assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        crossorigin="anonymous" />
    <style>
        :root {
            --premium-primary: #142947;
            --premium-gold: #c9aa6f;
            --premium-gold-light: #d9c4a0;
            --premium-gold-dark: #a38243;
            --premium-dark-card: #0d1829;
            --premium-border: rgba(201, 170, 111, 0.35);
        }

        body.authentication-bg {
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            overflow-y: auto;
            font-family: 'Nunito Sans', 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at 12% 16%, rgba(183, 125, 17, .16), transparent 22%), 
                        radial-gradient(circle at 84% 18%, rgba(166, 116, 24, .08), transparent 18%), 
                        radial-gradient(circle at 76% 82%, rgba(56, 85, 126, .24), transparent 24%), 
                        linear-gradient(135deg, #1d1b07 0%, #142947 48%, #1d385d 100%);
            position: relative;
        }

        .space-particles,
        .space-scene {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .space-planet {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(242, 220, 167, .95) 0%, rgba(201, 170, 111, .92) 34%, rgba(159, 122, 59, .88) 62%, rgba(111, 83, 36, .92) 100%);
            box-shadow: inset -18px -20px 38px rgba(81, 58, 18, .5), 0 0 38px rgba(159, 122, 59, .2);
            opacity: .3;
            animation: planetDrift ease-in-out infinite;
        }

        .space-planet::before {
            content: "";
            position: absolute;
            inset: 12% auto auto 12%;
            width: 22%;
            height: 22%;
            border-radius: 50%;
            background: rgba(255, 244, 214, .24);
            filter: blur(4px);
        }

        .planet-one { width: 190px; height: 190px; top: 10%; left: -48px; animation-duration: 18s; }
        .planet-two { width: 130px; height: 130px; right: 10%; bottom: 14%; animation-duration: 15s; animation-delay: -5s; }
        .planet-three { width: 90px; height: 90px; right: 4%; top: 16%; animation-duration: 13s; animation-delay: -2s; }

        .space-ring {
            position: absolute;
            border: 2px solid rgba(201, 170, 111, .28);
            border-radius: 50%;
            transform: rotate(-18deg);
            opacity: .45;
        }

        .ring-one { width: 240px; height: 56px; top: 16%; left: -72px; }
        .ring-two { width: 170px; height: 42px; right: 4%; bottom: 18%; }

        @keyframes planetDrift {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(20px, -18px, 0) scale(1.04); }
        }

        .account-pages {
            position: relative;
            z-index: 1;
            padding: 40px 0;
        }

        /* Signup Shell & Layout */
        .signup-shell {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(380px, 540px);
            border-radius: 26px;
            overflow: hidden;
            background: rgba(255, 255, 255, .04);
            border: 1px solid var(--premium-border);
            box-shadow: 0 28px 80px rgba(4, 11, 22, .55);
            backdrop-filter: blur(16px);
            align-items: stretch;
        }

        /* Left Showcase */
        .signup-showcase {
            position: relative;
            padding: 48px 42px;
            color: #fff;
            background: linear-gradient(180deg, rgba(10, 22, 40, .25), rgba(10, 22, 40, .7)), 
                        linear-gradient(135deg, rgba(201, 170, 111, .14) 0%, rgba(20, 41, 71, .25) 46%, rgba(201, 170, 111, .06) 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .showcase-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid rgba(201, 170, 111, .4);
            background: rgba(201, 170, 111, .12);
            color: #f7e2b7;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            width: fit-content;
        }

        .signup-showcase h1 {
            margin: 20px 0 12px;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 46px;
            line-height: 1.05;
            color: #fff7e8;
            font-weight: 700;
        }

        .signup-showcase p {
            max-width: 440px;
            color: rgba(255, 255, 255, .82);
            font-size: 15px;
            line-height: 1.7;
        }

        .showcase-features {
            display: grid;
            gap: 16px;
            margin: 32px 0;
        }

        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 18px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(201, 170, 111, .16);
            backdrop-filter: blur(8px);
        }

        .feature-card i {
            font-size: 18px;
            color: #e5cd9d;
            margin-top: 2px;
            min-width: 22px;
        }

        .feature-card p {
            margin: 0;
            color: rgba(255, 255, 255, .88);
            font-size: 13.5px;
            line-height: 1.5;
            font-weight: 500;
        }

        .showcase-footer {
            margin-top: 10px;
            color: rgba(255, 255, 255, .65);
            font-size: 13px;
        }

        /* Right Signup Card */
        .signup-card {
            position: relative;
            padding: 40px 36px;
            color: #f4ecdc;
            background: linear-gradient(180deg, rgba(13, 24, 41, .98) 0%, rgba(8, 14, 24, 1) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--premium-gold), transparent);
        }

        .signup-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .signup-header img {
            width: 88px;
            height: auto;
            padding: 12px 14px;
            border-radius: 22px;
            background: linear-gradient(145deg, #fff7e8 0%, #ffffff 100%);
            border: 1px solid rgba(201, 170, 111, .25);
            box-shadow: 0 14px 35px rgba(20, 41, 71, .12);
            display: inline-block;
        }

        .signup-header h2 {
            margin: 18px 0 8px;
            color: var(--premium-gold-light, #d9c4a0);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 38px;
            font-weight: 700;
            text-align: center;
        }

        .signup-header p {
            margin: 0;
            color: rgba(243, 234, 216, .72);
            font-size: 14px;
            line-height: 1.7;
            text-align: center;
        }

        /* Stepper Component */
        .signup-stepper {
            position: relative;
            margin-bottom: 26px;
            padding: 0 4px;
        }

        .stepper-line {
            height: 2px !important;
            background: rgba(201, 170, 111, 0.25) !important;
        }

        .stepper-progress {
            height: 2px !important;
            background: #28a745 !important;
        }

        .stepper-step {
            position: relative;
            z-index: 2;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12.5px;
            transition: all 0.25s ease;
        }

        .step-label {
            font-size: 11px;
            letter-spacing: 0.3px;
            white-space: nowrap;
            margin-top: 6px;
        }

        /* CRITICAL INPUT & LABEL STYLING ON SIGNUP CARD (DARK BACKGROUND) */
        .signup-card .form-label {
            color: #f7e2b7 !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.6px !important;
            margin-bottom: 6px !important;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .signup-card .input-group {
            display: flex;
            align-items: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1.5px solid rgba(201, 170, 111, 0.35);
            overflow: hidden;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .signup-card .input-group:focus-within {
            border-color: #c9aa6f !important;
            box-shadow: 0 0 0 3.5px rgba(201, 170, 111, 0.25) !important;
            background: rgba(255, 255, 255, 0.08) !important;
        }

        .signup-card .input-group-text {
            background: transparent !important;
            border: none !important;
            color: #c9aa6f !important;
            font-size: 15px !important;
            min-width: 44px;
            padding: 0 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-card .form-control,
        .signup-card .form-select {
            background: transparent !important;
            border: none !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 14.5px !important;
            padding: 13px 14px 13px 2px !important;
            min-height: 48px !important;
            box-shadow: none !important;
            caret-color: #c9aa6f !important;
        }

        .signup-card .form-select option {
            background: #142947 !important;
            color: #ffffff !important;
            padding: 8px !important;
        }

        .signup-card .form-control::placeholder,
        .signup-card ::placeholder {
            color: rgba(255, 255, 255, 0.42) !important;
            font-weight: 400 !important;
            opacity: 1 !important;
        }

        /* Readonly / Disabled Fields on Signup Card */
        .signup-card .form-control[readonly],
        .signup-card .form-control:disabled {
            background: rgba(255, 255, 255, 0.06) !important;
            color: #ffd885 !important;
            font-weight: 700 !important;
            cursor: default !important;
        }

        /* Autofill on Signup Card (Solid Dark Navy Background + Bright White Text) */
        .signup-card input:-webkit-autofill,
        .signup-card input:-webkit-autofill:hover, 
        .signup-card input:-webkit-autofill:focus,
        .signup-card input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #13243a inset !important;
            box-shadow: 0 0 0 1000px #13243a inset !important;
            -webkit-text-fill-color: #ffffff !important;
            color: #ffffff !important;
            caret-color: #ffffff !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Radio Options */
        .position-radio-card {
            border: 1.5px solid rgba(201, 170, 111, 0.35);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 11px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .position-radio-card:hover {
            border-color: #c9aa6f;
            background: rgba(255, 255, 255, 0.08);
        }

        .position-radio-card input[type="radio"] {
            accent-color: #c9aa6f;
            width: 17px;
            height: 17px;
            margin: 0;
            cursor: pointer;
        }

        .position-radio-card span {
            color: #ffffff;
            font-weight: 600;
            font-size: 13.5px;
        }

        /* Validation Feedback on Dark Card */
        .signup-card .invalid-feedback {
            color: #ff9d9d !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            margin-top: 5px !important;
        }

        /* Action Buttons */
        .btn-gold-action {
            background: linear-gradient(135deg, #c9aa6f 0%, #deb878 100%) !important;
            color: #142947 !important;
            font-weight: 800 !important;
            font-size: 14.5px !important;
            padding: 13px 24px !important;
            border-radius: 12px !important;
            border: none !important;
            letter-spacing: 0.5px !important;
            box-shadow: 0 8px 20px rgba(201, 170, 111, 0.3) !important;
            transition: all 0.2s ease !important;
        }

        .btn-gold-action:hover {
            background: linear-gradient(135deg, #deb878 0%, #ebd09c 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(201, 170, 111, 0.45) !important;
        }

        /* Signin link */
        .signin-text {
            color: rgba(243, 234, 216, .75);
            font-size: 13.5px;
            margin-top: 18px;
        }

        .signin-text a {
            color: #c9aa6f;
            font-weight: 800;
            text-decoration: none;
        }

        .signin-text a:hover {
            color: #ffd885;
            text-decoration: underline;
        }

        /* CRITICAL INPUT & LABEL STYLING INSIDE MODALS (LIGHT/WHITE BACKGROUND) */
        .modal {
            z-index: 1065;
        }

        .kyc-modal-content {
            border-radius: 14px;
            border: 1.5px solid rgba(201, 170, 111, 0.5);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            background: #ffffff;
        }

        .kyc-modal-header {
            background: linear-gradient(135deg, #142947 0%, #1e3a63 100%) !important;
            border-bottom: 2px solid #c9aa6f !important;
            padding: 1.1rem 1.5rem !important;
        }

        .kyc-modal-body {
            max-height: 74vh;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        .kyc-label {
            color: #1e293b !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            letter-spacing: 0.4px !important;
            text-transform: uppercase !important;
            margin-bottom: 6px !important;
            display: block !important;
        }

        .kyc-input,
        .modal .form-control:not(.kyc-file-input):not(#distributor_otp_input),
        .modal .form-select {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 14px !important;
            min-height: 44px !important;
            box-shadow: none !important;
        }

        .kyc-input:focus,
        .modal .form-control:focus,
        .modal .form-select:focus {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border-color: #c9aa6f !important;
            box-shadow: 0 0 0 3px rgba(201, 170, 111, 0.25) !important;
        }

        .kyc-input::placeholder,
        .modal ::placeholder {
            color: #94a3b8 !important;
            font-weight: 400 !important;
            opacity: 1 !important;
        }

        /* Autofill in Modals (Solid White Background + Dark Charcoal Text) */
        .modal input:-webkit-autofill,
        .modal input:-webkit-autofill:hover, 
        .modal input:-webkit-autofill:focus,
        .modal input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            box-shadow: 0 0 0 1000px #ffffff inset !important;
            -webkit-text-fill-color: #0f172a !important;
            color: #0f172a !important;
            caret-color: #0f172a !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .kyc-file-input {
            background: #f8fafc !important;
            border: 1.5px dashed #94a3b8 !important;
            color: #1e293b !important;
            padding: 8px 12px !important;
            font-size: 13px !important;
            border-radius: 8px !important;
        }

        .modal .invalid-feedback {
            color: #dc2626 !important;
            font-size: 11.5px !important;
            font-weight: 600 !important;
            margin-top: 4px !important;
        }

        /* OTP Input */
        #distributor_otp_input {
            background-color: #ffffff !important;
            color: #142947 !important;
            border: 2px solid #c9aa6f !important;
            border-radius: 12px !important;
            font-size: 32px !important;
            font-weight: 800 !important;
            letter-spacing: 10px !important;
            padding: 10px !important;
        }

        #distributor_otp_input:focus {
            box-shadow: 0 0 0 4px rgba(201, 170, 111, 0.3) !important;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .signup-shell {
                grid-template-columns: 1fr;
                max-width: 640px;
                margin: 0 auto;
            }
            .signup-showcase {
                display: none;
            }
            .signup-card {
                padding: 36px 28px;
            }
        }

        @media (max-width: 575.98px) {
            .account-pages {
                padding: 16px 0 !important;
            }
            .signup-card {
                padding: 28px 18px;
            }
            .signup-header h2 {
                font-size: 28px;
            }
            .position-radio-card {
                padding: 9px 12px;
            }
        }

        /* ============================================================
           DIRECT SELLER E-CONTRACT AGREEMENT MODAL STYLES (ORIGINAL PRESERVED)
           ============================================================ */
        .contract-modal {
            z-index: 1060;
        }
        .contract-modal .modal-dialog {
            max-width: 980px;
            margin: 1.5rem auto;
        }
        .contract-modal-content {
            border-radius: 12px;
            border: 1px solid rgba(201, 170, 111, 0.4);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            background-color: #f7f8fa;
        }
        .contract-modal-header {
            background: linear-gradient(135deg, #142947 0%, #1e3a63 100%) !important;
            border-bottom: 2px solid var(--premium-gold, #c9aa6f) !important;
            padding: 1rem 1.5rem !important;
        }
        .contract-modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .contract-notice-bar {
            background-color: #fff9e6;
            border-bottom: 1px solid #fae8b4;
            font-size: 0.875rem;
            color: #856404 !important;
        }
        .contract-modal-body {
            background-color: #e9edf2 !important;
            max-height: 72vh;
            overflow-y: auto;
            scroll-behavior: smooth;
            padding: 1.5rem;
            -webkit-overflow-scrolling: touch;
        }
        .contract-modal-body::-webkit-scrollbar {
            width: 8px;
        }
        .contract-modal-body::-webkit-scrollbar-track {
            background: #e2e7ec;
        }
        .contract-modal-body::-webkit-scrollbar-thumb {
            background: #9faec0;
            border-radius: 4px;
        }
        .contract-modal-body::-webkit-scrollbar-thumb:hover {
            background: #6c7d93;
        }
        .contract-page-card {
            background-color: #ffffff !important;
            border: 1px solid #d4dbe3;
            border-radius: 6px;
            padding: 2.25rem 2.5rem;
            margin-bottom: 2rem;
            font-family: 'Georgia', 'Cambria', 'Times New Roman', serif;
            font-size: 14.5px;
            line-height: 1.7;
            color: #1a1e24 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            position: relative;
        }
        .contract-page-card,
        .contract-page-card p,
        .contract-page-card span:not(.text-primary):not(.text-danger):not(.badge),
        .contract-page-card div,
        .contract-page-card li,
        .contract-page-card ol,
        .contract-page-card ul,
        .contract-page-card td,
        .contract-page-card th {
            color: #1a1e24 !important;
        }
        .contract-page-header {
            font-family: 'Nunito Sans', 'Segoe UI', sans-serif;
            color: #1a1e24 !important;
        }
        .contract-title {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #142947 !important;
        }
        .contract-para {
            margin-bottom: 1rem;
            text-align: justify;
            text-justify: inter-word;
            color: #1a1e24 !important;
        }
        .contract-clause-list {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
            color: #1a1e24 !important;
        }
        .contract-clause-list > li {
            margin-bottom: 0.85rem;
            text-align: justify;
            text-justify: inter-word;
            color: #1a1e24 !important;
        }
        .contract-subclause-list {
            padding-left: 1.5rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            color: #1a1e24 !important;
        }
        .contract-subclause-list > li {
            margin-bottom: 0.5rem;
            text-align: justify;
            color: #1a1e24 !important;
        }
        .contract-sub-subclause-list {
            padding-left: 1.5rem;
            margin-top: 0.35rem;
            margin-bottom: 0.35rem;
            color: #1a1e24 !important;
        }
        .contract-company-docs-list {
            padding-left: 1.5rem;
            margin-top: 0.35rem;
            margin-bottom: 0.35rem;
            color: #1a1e24 !important;
        }
        .contract-bullet-list {
            padding-left: 1.5rem;
            list-style-type: disc;
            color: #1a1e24 !important;
        }
        .contract-bullet-list > li {
            margin-bottom: 0.5rem;
            text-align: justify;
            color: #1a1e24 !important;
        }
        .contract-arrow-list li {
            margin-bottom: 0.4rem;
            text-align: justify;
            color: #1a1e24 !important;
        }
        .contract-fill-blank {
            letter-spacing: -1px;
            font-family: monospace;
            color: #0d6efd !important;
        }
        .contract-stamp-container {
            padding: 0.5rem 1rem;
            display: inline-block;
        }
        .contract-stamp-img {
            max-height: 100px;
            max-width: 260px;
            object-fit: contain;
        }
        .contract-modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 0.85rem 1.5rem;
            background-color: #ffffff !important;
        }
        .contract-consent-acknowledgement {
            color: #495057 !important;
        }
        @media (max-width: 767.98px) {
            .contract-modal .modal-dialog {
                margin: 0.5rem;
                max-width: 100%;
            }
            .contract-page-card {
                padding: 1.25rem 1rem;
                font-size: 13.5px;
                line-height: 1.6;
            }
            .contract-modal-header {
                padding: 0.75rem 1rem;
            }
            .contract-modal-footer {
                padding: 0.75rem 1rem;
            }
            .contract-stamp-img {
                max-height: 75px;
                max-width: 190px;
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
        <div class="space-planet planet-three"></div><i class="fa-solid fa-user-astronaut space-astronaut"></i>
    </div>
    <div class="space-particles">
        <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-10 col-xl-11">
                    @if (session()->has('failedMsg'))
                        <div class="alert alert-danger" role="alert">{{ session('failedMsg') }}</div>
                    @endif
                    <div class="signup-shell">
                        <div class="signup-showcase">
                            <span class="brand-badge">{{ config('detailsApp.name') }}</span>
                            <h1>Create Member Account</h1>
                            <p>Start your ecommerce experience after signup � complete your details to unlock fast
                                checkout and order tracking.</p>
                            <div class="signup-points">
                                <div class="signup-point"><i class="fa-solid fa-shield-halved"></i><span>Secure
                                        checkout, address management, and saved carts for smooth shopping.</span></div>
                                <div class="signup-point"><i class="fa-solid fa-user-plus"></i><span>Wishlist and
                                        curated products in one account.</span></div>
                                <div class="signup-point"><i class="fa-solid fa-gem"></i><span>A cohesive ecommerce
                                        experience with elegant visuals and trusted branding.</span></div>
                            </div>
                            <span class="signup-note">After registration, access orders, wallet, wishlist, and grievance system
                                from your account.</span>
                        </div>
                        <div class="signup-card">
                            <div class="signup-header">
                                <img src="{{ asset('logo/logo.png') }}" alt="logo">
                                <h2>Sign Up</h2>
                                <p>Fill in your details to create a member account.</p>
                            </div>
                            <form id="signupForm" action="{{ route('userRegister') }}" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                @csrf
                                
                                <!-- Progress Stepper -->
                                <div class="signup-stepper mb-4">
                                    <div class="d-flex justify-content-between align-items-center position-relative">
                                        <div class="stepper-line position-absolute top-50 start-0 w-100 translate-middle-y" style="height: 2px; background: rgba(201, 170, 111, 0.25); z-index: 1;"></div>
                                        <div class="stepper-progress position-absolute top-50 start-0 translate-middle-y" id="stepperProgressBar" style="height: 2px; background: #28a745; width: 0%; z-index: 1; transition: width 0.3s ease;"></div>
                                        
                                        <div class="stepper-step text-center position-relative" id="stepIndicator1" style="z-index: 2;">
                                            <div class="step-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 32px; height: 32px; background: #c9aa6f; color: #142947; font-weight: 800; font-size: 13px; border: 2px solid #ffffff; box-shadow: 0 0 10px rgba(201, 170, 111, 0.5);">1</div>
                                            <div class="step-label small fw-bold mt-1 text-white" style="font-size: 11px;">Initial Details</div>
                                        </div>

                                        <div class="stepper-step text-center position-relative" id="stepIndicator2" style="z-index: 2;">
                                            <div class="step-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 32px; height: 32px; background: #15273f; color: #d9c4a0; font-weight: 700; font-size: 13px; border: 1.5px solid rgba(201, 170, 111, 0.4);">2</div>
                                            <div class="step-label small fw-semibold mt-1 text-white-50" style="font-size: 11px;">E-Contract</div>
                                        </div>

                                        <div class="stepper-step text-center position-relative" id="stepIndicator3" style="z-index: 2;">
                                            <div class="step-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 32px; height: 32px; background: #15273f; color: #d9c4a0; font-weight: 700; font-size: 13px; border: 1.5px solid rgba(201, 170, 111, 0.4);">3</div>
                                            <div class="step-label small fw-semibold mt-1 text-white-50" style="font-size: 11px;">KYC &amp; App</div>
                                        </div>

                                        <div class="stepper-step text-center position-relative" id="stepIndicator4" style="z-index: 2;">
                                            <div class="step-circle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 32px; height: 32px; background: #15273f; color: #d9c4a0; font-weight: 700; font-size: 13px; border: 1.5px solid rgba(201, 170, 111, 0.4);">4</div>
                                            <div class="step-label small fw-semibold mt-1 text-white-50" style="font-size: 11px;">Email OTP</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STEP 1: INITIAL REGISTRATION FORM FIELDS -->
                                <div id="step1Container">
                                    <div class="row g-3">
                                        <!-- Introducer ID -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="sponsor">
                                                Introducer ID <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-user-group"></i></span>
                                                <input class="form-control" type="text" name="sponsor" id="sponsor" minlength="9" maxlength="10"
                                                    value="{{ old('sponsor', $sdata != '1' ? $sdata : '') }}"
                                                    placeholder="Enter sponsor ID" required>
                                            </div>
                                            <div class="invalid-feedback" id="sponsorFeedback">Valid Introducer ID (minimum 9 characters) is required.</div>
                                            @error('sponsor')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Introducer Name -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="sponsor_name">
                                                Introducer Name
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-id-badge"></i></span>
                                                <input class="form-control" type="text" name="sponsor_name" id="sponsor_name"
                                                    value="{{ old('sponsor_name', isset($introducer) && $introducer ? $introducer->name : '') }}"
                                                    placeholder="Auto-loaded name" readonly>
                                            </div>
                                            <div class="small mt-1 text-white-50" id="sponhtml"></div>
                                        </div>

                                        <!-- Placement Position -->
                                        <div class="col-12">
                                            <label class="form-label">
                                                Placement Position <span class="text-danger">*</span>
                                            </label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="position-radio-card" for="posLeft">
                                                        <input type="radio" name="position" id="posLeft" value="Left" {{ old('position', (isset($side) && $side == 'Left') ? 'Left' : ((isset($pos) && $pos == 'Left') ? 'Left' : 'Left')) == 'Left' ? 'checked' : '' }}>
                                                        <span><i class="fa-solid fa-arrow-left me-1 text-warning"></i> Left Side</span>
                                                    </label>
                                                </div>
                                                <div class="col-6">
                                                    <label class="position-radio-card" for="posRight">
                                                        <input type="radio" name="position" id="posRight" value="Right" {{ old('position', (isset($side) && $side == 'Right') ? 'Right' : ((isset($pos) && $pos == 'Right') ? 'Right' : '')) == 'Right' ? 'checked' : '' }}>
                                                        <span>Right Side <i class="fa-solid fa-arrow-right ms-1 text-warning"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('position')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Direct Seller Full Name -->
                                        <div class="col-12">
                                            <label class="form-label" for="name">
                                                Direct Seller Full Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <input class="form-control" type="text" name="name" id="name"
                                                    value="{{ old('name') }}" placeholder="Enter full legal name" required>
                                            </div>
                                            <div class="invalid-feedback">Direct Seller full name is required.</div>
                                            @error('name')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="mobile">
                                                Phone Number <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                <input class="form-control" type="tel" name="mobile" id="mobile"
                                                    minlength="10" maxlength="15" value="{{ old('mobile') }}"
                                                    placeholder="Enter phone number" required>
                                            </div>
                                            <div class="invalid-feedback">Valid phone number (10-15 digits) is required.</div>
                                            @error('mobile')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="email">
                                                Email Address <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                                <input class="form-control" type="email" name="email" id="email"
                                                    value="{{ old('email') }}" placeholder="name@example.com" required>
                                            </div>
                                            <div class="invalid-feedback">Valid email address is required.</div>
                                            @error('email')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Country -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="country">
                                                Country <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-earth-americas"></i></span>
                                                <select class="form-select" name="country" id="country" required>
                                                    <option value="India" selected>India</option>
                                                </select>
                                            </div>
                                            @error('country')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="password">
                                                Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                <input class="form-control" type="password" name="password" id="password"
                                                    minlength="6" placeholder="Minimum 6 characters" required>
                                                <button class="btn btn-link text-warning text-decoration-none pe-3" type="button" id="togglePasswordIcon" style="z-index: 5;">
                                                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">Password must be at least 6 characters.</div>
                                            @error('password')
                                                <span style="color: #ff9d9d;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Next Button to open E-Contract Agreement -->
                                        <div class="col-12 mt-4">
                                            <button type="button" class="btn btn-gold-action w-100 py-3" id="btnStep1Next">
                                                Next: Review E-Contract Agreement <i class="fa-solid fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 1. E-CONTRACT AGREEMENT MODAL POPUP -->
    @include('member.partials.contract_modal')

    <!-- 2. KYC DETAILS & APPLICATION FORM MODAL POPUP -->
    @include('member.partials.kyc_modal')

    <!-- 3. EMAIL VERIFICATION OTP MODAL -->
    <div class="modal fade" id="distributorOtpModal" tabindex="-1" aria-labelledby="distributorOtpModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" style="z-index: 1070;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #142947 0%, #1e3a63 100%); border-bottom: 2px solid #c9aa6f;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-envelope-circle-check fs-5 text-warning"></i>
                        <h5 class="modal-title fw-bold text-white mb-0" id="distributorOtpModalLabel">Email Verification</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseOtpModal"></button>
                </div>
                <div class="modal-body p-4 text-center" style="background: #ffffff;">
                    <div class="mb-3">
                        <span class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 58px; height: 58px; background: rgba(201, 170, 111, 0.15); border: 2px solid #c9aa6f;">
                            <i class="fa-solid fa-envelope-open-text fs-3 text-warning"></i>
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Verify Your Email Address</h6>
                    <p class="text-muted small mb-3">
                        A 6-digit verification code has been dispatched to your registered email (<strong id="otpMaskedEmail" class="text-dark">your email</strong>).
                    </p>

                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-uppercase text-muted" for="distributor_otp_input">Enter 6-Digit Email Verification OTP</label>
                        <input type="text" class="form-control text-center" id="distributor_otp_input" maxlength="6" placeholder="______" autocomplete="one-time-code">
                        <div class="invalid-feedback text-center" id="otpInputFeedback">Please enter the 6-digit OTP received on your email.</div>
                    </div>

                    <div class="alert alert-danger py-2 small d-none" id="otpErrorAlert"></div>

                    <div class="mt-2">
                        <span class="text-muted small">Didn't receive the OTP?</span>
                        <button type="button" class="btn btn-link btn-sm text-decoration-none fw-bold" id="btnResendOtp" disabled>
                            Resend OTP (<span id="otpCountdown">60</span>s)
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light d-flex justify-content-between p-3">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal" id="btnCancelOtpModal">Cancel</button>
                    <button type="button" class="btn btn-primary px-4 fw-bold" id="btnVerifyOtpSubmit">
                        <i class="fa-solid fa-check-circle me-1"></i> Verify OTP &amp; Complete Registration
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END EMAIL VERIFICATION OTP MODAL -->

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('mem_assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('mem_assets/js/app.min.js') }}"></script>
    <script>
        $(function() {
            // Password toggle
            $('#togglePasswordIcon').on('click', function() {
                const passwordInput = $('#password');
                const eyeIcon = $('#eyeIcon');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                eyeIcon.toggleClass('fa-eye fa-eye-slash');
            });

            // Auto-fetch sponsor name
            $('#sponsor').on('blur input change', function() {
                const sponsorId = $(this).val().trim();
                if (sponsorId.length >= 9) {
                    $.ajax({
                        url: '/getSponname',
                        type: 'POST',
                        data: {
                            sponsorid: sponsorId,
                            sponsor: sponsorId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response && response.name) {
                                $('#sponsor_name').val(response.name);
                                $('#sponhtml').html('<span class="text-success fw-bold"><i class="fa-solid fa-check-circle me-1"></i> ' + response.name + '</span>');
                                $('#sponsor').removeClass('is-invalid');
                            } else if (response && response.data && response.code === 1) {
                                const match = response.data.match(/Introducer Name\s*:\s*([^<]+)/);
                                const parsedName = match ? match[1].trim() : '';
                                if (parsedName) $('#sponsor_name').val(parsedName);
                                $('#sponhtml').html(response.data);
                                $('#sponsor').removeClass('is-invalid');
                            } else {
                                $('#sponsor_name').val('');
                                $('#sponhtml').html('<span class="text-danger fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i> Invalid Sponsor ID</span>');
                            }
                        }
                    });
                }
            });

            if ($('#sponsor').val().trim().length >= 9 && !$('#sponsor_name').val().trim()) {
                $('#sponsor').trigger('blur');
            }

            // Stepper update helper
            function updateStepper(step) {
                const progressWidths = { 1: '0%', 2: '33%', 3: '66%', 4: '100%' };
                $('#stepperProgressBar').css('width', progressWidths[step] || '0%');

                for (let i = 1; i <= 4; i++) {
                    const stepEl = $('#stepIndicator' + i);
                    const circle = stepEl.find('.step-circle');
                    const label = stepEl.find('.step-label');

                    if (i < step) {
                        circle.css({
                            'background': '#28a745',
                            'color': '#ffffff',
                            'border': '2px solid #ffffff',
                            'box-shadow': '0 0 8px rgba(40, 167, 69, 0.5)'
                        }).html('<i class="fa-solid fa-check" style="font-size: 11px;"></i>');
                        label.removeClass('text-white-50').addClass('text-white fw-bold');
                    } else if (i === step) {
                        circle.css({
                            'background': '#c9aa6f',
                            'color': '#142947',
                            'border': '2px solid #ffffff',
                            'box-shadow': '0 0 12px rgba(201, 170, 111, 0.6)'
                        }).text(i);
                        label.removeClass('text-white-50').addClass('text-white fw-bold');
                    } else {
                        circle.css({
                            'background': '#15273f',
                            'color': '#d9c4a0',
                            'border': '1.5px solid rgba(201, 170, 111, 0.4)',
                            'box-shadow': 'none'
                        }).text(i);
                        label.removeClass('text-white fw-bold').addClass('text-white-50 fw-semibold');
                    }
                }
            }

            // Modals instances
            const contractModalEl = document.getElementById('contractModal');
            const kycModalEl = document.getElementById('kycModal');
            const otpModalEl = document.getElementById('distributorOtpModal');

            const contractModal = contractModalEl ? new bootstrap.Modal(contractModalEl) : null;
            const kycModal = kycModalEl ? new bootstrap.Modal(kycModalEl) : null;
            const otpModal = otpModalEl ? new bootstrap.Modal(otpModalEl) : null;

            // STEP 1 VALIDATION & OPEN E-CONTRACT MODAL
            $('#btnStep1Next').on('click', function(e) {
                e.preventDefault();
                let valid = true;
                let firstInvalid = null;

                const sponsor = $('#sponsor').val().trim();
                if (!sponsor || sponsor.length < 9) {
                    $('#sponsor').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#sponsor');
                } else {
                    $('#sponsor').removeClass('is-invalid');
                }

                const name = $('#name').val().trim();
                if (!name) {
                    $('#name').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#name');
                } else {
                    $('#name').removeClass('is-invalid');
                }

                const mobile = $('#mobile').val().trim();
                if (!mobile || mobile.length < 10 || !/^\d+$/.test(mobile)) {
                    $('#mobile').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#mobile');
                } else {
                    $('#mobile').removeClass('is-invalid');
                }

                const email = $('#email').val().trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email || !emailRegex.test(email)) {
                    $('#email').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#email');
                } else {
                    $('#email').removeClass('is-invalid');
                }

                const password = $('#password').val();
                if (!password || password.length < 6) {
                    $('#password').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#password');
                } else {
                    $('#password').removeClass('is-invalid');
                }

                if (!valid) {
                    if (firstInvalid) firstInvalid.focus();
                    return false;
                }

                // Populate dynamic agreement blanks
                const introducerName = $('#sponsor_name').val().trim() || sponsor;
                $('#contractIntroducerName').text(introducerName);
                $('#contractIntroducerId').text(sponsor);
                $('#contractDirectSellerName').text(name);
                
                const fatherVal = $('#father_name').val() ? $('#father_name').val().trim() : '';
                if (fatherVal) {
                    $('#contractFatherName').text(fatherVal);
                }

                // Prefill bank account holder name
                if (!$('#holder').val().trim()) {
                    $('#holder').val(name);
                }

                // Update stepper and open contract modal
                updateStepper(2);
                if (contractModal) {
                    contractModal.show();
                } else {
                    $('#contractModal').modal('show');
                }
            });

            // STEP 2: E-CONTRACT SCROLL-TO-BOTTOM DETECTION TO UNLOCK KYC STEP BUTTON
            let contractScrolledToBottom = false;

            function unlockKycStepButton() {
                if (contractScrolledToBottom) return;
                contractScrolledToBottom = true;
                $('#contractScrollNotice').hide();
                $('#contractScrollBadge').hide();
                $('#contractUnlockedNotice').fadeIn(200);
                $('#btnContractSkipKyc').fadeIn(300).css('display', 'inline-flex');
                $('#btnContractAccept').fadeIn(300).css('display', 'inline-flex');
            }

            function checkContractScroll() {
                const modalBody = document.getElementById('contractModalBody');
                if (!modalBody) return;
                const scrollRemaining = modalBody.scrollHeight - (modalBody.scrollTop + modalBody.clientHeight);
                if (scrollRemaining <= 100) {
                    unlockKycStepButton();
                }
            }

            if (contractModalEl) {
                contractModalEl.addEventListener('shown.bs.modal', function () {
                    const modalBody = document.getElementById('contractModalBody');
                    if (!modalBody) return;

                    if (!contractScrolledToBottom) {
                        $('#btnContractSkipKyc').hide();
                        $('#btnContractAccept').hide();
                        $('#contractScrollBadge').show();
                        $('#contractScrollNotice').show();
                        $('#contractUnlockedNotice').hide();
                        modalBody.scrollTop = 0;
                    }

                    $(modalBody).off('scroll.contractScrollCheck').on('scroll.contractScrollCheck', checkContractScroll);

                    const sentinel = document.getElementById('contractBottomSentinel');
                    if (sentinel && 'IntersectionObserver' in window) {
                        const observer = new IntersectionObserver(function(entries) {
                            entries.forEach(function(entry) {
                                if (entry.isIntersecting) {
                                    unlockKycStepButton();
                                }
                            });
                        }, {
                            root: modalBody,
                            threshold: 0.1
                        });
                        observer.observe(sentinel);
                    }
                });
            }

            // Bottom AGREE & ACCEPT button on Page 12
            $(document).on('click', '#btnBottomAgreeAccept', function(e) {
                e.preventDefault();
                unlockKycStepButton();
                $('#btnContractAccept').trigger('click');
            });

            // PATH A: SKIP KYC HANDLER
            // Directly submits the form with skip_kyc=1, triggering native browser navigation to account-created
            $(document).on('click', '.btnSkipKycAction, #btnContractSkipKyc, #btnKycModalSkipKyc', function(e) {
                e.preventDefault();
                const skipBtn = $(this);

                // Disable buttons to prevent duplicate submissions
                $('.btnSkipKycAction, #btnContractAccept, #btnKycAgreeAccept').prop('disabled', true);
                skipBtn.html('<span class="spinner-border spinner-border-sm me-2"></span> Skipping KYC & Redirecting...');

                const formEl = document.getElementById('signupForm');
                if (!formEl) {
                    return;
                }

                // Add or update hidden skip_kyc input inside form
                let skipInput = document.getElementById('skip_kyc_input');
                if (!skipInput) {
                    skipInput = document.createElement('input');
                    skipInput.type = 'hidden';
                    skipInput.name = 'skip_kyc';
                    skipInput.id = 'skip_kyc_input';
                    formEl.appendChild(skipInput);
                }
                skipInput.value = '1';

                // Submit form directly -> Browser executes standard POST and redirects to account-created
                formEl.submit();
            });

            // PATH B: E-CONTRACT MODAL ACCEPTANCE -> TRANSITION TO KYC MODAL POPUP
            $('#btnContractAccept, #btnAcceptContract').on('click', function(e) {
                e.preventDefault();
                if (!contractScrolledToBottom) {
                    return false;
                }
                // Close contract modal
                if (contractModal) {
                    contractModal.hide();
                } else {
                    $('#contractModal').modal('hide');
                }

                // Update stepper to 3 (KYC & App)
                updateStepper(3);

                // Open KYC & Application Form modal popup after brief transition
                setTimeout(function() {
                    if (kycModal) {
                        kycModal.show();
                    } else {
                        $('#kycModal').modal('show');
                    }
                }, 350);
            });

            // Reopen contract modal from KYC modal
            $('#btnReopenContractFromKyc, #btnReopenContractFromBar').on('click', function(e) {
                e.preventDefault();
                if (kycModal) kycModal.hide();
                else $('#kycModal').modal('hide');

                updateStepper(2);
                setTimeout(function() {
                    if (contractModal) contractModal.show();
                    else $('#contractModal').modal('show');
                }, 350);
            });

            // OTP Countdown helper
            let otpTimer = null;
            function startOtpCountdown(seconds) {
                clearInterval(otpTimer);
                let remaining = seconds;
                $('#otpCountdown').text(remaining);
                $('#btnResendOtp').prop('disabled', true);

                otpTimer = setInterval(function() {
                    remaining--;
                    $('#otpCountdown').text(remaining);
                    if (remaining <= 0) {
                        clearInterval(otpTimer);
                        $('#btnResendOtp').prop('disabled', false).text('Resend OTP');
                    }
                }, 1000);
            }

            // Request email verification OTP
            function requestDistributorOtp(callback) {
                const email = $('#email').val().trim();
                const name = $('#name').val().trim();
                const sponsorId = $('#sponsor').val().trim();
                $('#otpErrorAlert').addClass('d-none').text('');

                $.ajax({
                    url: "{{ route('sendRegistrationOtp') }}",
                    type: 'POST',
                    data: {
                        email: email,
                        name: name,
                        sponsor: sponsorId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            $('#otpMaskedEmail').text(res.masked_email || res.email);
                            if (callback) callback(true, res);
                        } else {
                            if (callback) callback(false, res.message || 'Failed to dispatch OTP to email');
                        }
                    },
                    error: function(xhr) {
                        const err = xhr.responseJSON?.message || 'Server error while requesting OTP.';
                        if (callback) callback(false, err);
                    }
                });
            }

            // STEP 3: KYC "I AGREE AND ACCEPT" HANDLER
            $('#btnKycAgreeAccept').on('click', function(e) {
                e.preventDefault();
                let valid = true;
                let firstInvalid = null;

                // Validate Bank Name
                const bankVal = $('#bank').val().trim();
                if (!bankVal) {
                    $('#bank').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#bank');
                } else {
                    $('#bank').removeClass('is-invalid');
                }

                // Validate Account Holder Name
                const holderVal = $('#holder').val().trim();
                if (!holderVal) {
                    $('#holder').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#holder');
                } else {
                    $('#holder').removeClass('is-invalid');
                }

                // Validate IFSC
                const ifscVal = $('#ifsc').val().trim().toUpperCase();
                if (!ifscVal || ifscVal.length < 5) {
                    $('#ifsc').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#ifsc');
                } else {
                    $('#ifsc').removeClass('is-invalid');
                }

                // Validate Account Number
                const accVal = $('#account_no').val().trim();
                if (!accVal || !/^\d+$/.test(accVal)) {
                    $('#account_no').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#account_no');
                } else {
                    $('#account_no').removeClass('is-invalid');
                }

                // Validate Aadhaar (12 digits)
                const adharVal = $('#adhar_no').val().trim();
                if (!adharVal || adharVal.length !== 12 || !/^\d{12}$/.test(adharVal)) {
                    $('#adhar_no').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#adhar_no');
                } else {
                    $('#adhar_no').removeClass('is-invalid');
                }

                // Validate PAN (10 characters)
                const panVal = $('#pan_no').val().trim().toUpperCase();
                if (!panVal || panVal.length !== 10 || !/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(panVal)) {
                    $('#pan_no').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#pan_no');
                } else {
                    $('#pan_no').removeClass('is-invalid');
                }

                // Validate Nominee Name
                const nomNameVal = $('#nominee_name').val().trim();
                if (!nomNameVal) {
                    $('#nominee_name').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#nominee_name');
                } else {
                    $('#nominee_name').removeClass('is-invalid');
                }

                // Validate Nominee Relation
                const nomRelVal = $('#nominee_relation').val().trim();
                if (!nomRelVal) {
                    $('#nominee_relation').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#nominee_relation');
                } else {
                    $('#nominee_relation').removeClass('is-invalid');
                }

                // Validate Nominee No (10 digits)
                const nomNoVal = $('#nominee_no').val().trim();
                if (!nomNoVal || nomNoVal.length !== 10 || !/^\d{10}$/.test(nomNoVal)) {
                    $('#nominee_no').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#nominee_no');
                } else {
                    $('#nominee_no').removeClass('is-invalid');
                }

                // Validate Document Images (PAN, Front, Back)
                const panFile = document.getElementById('pan_image');
                if (!panFile || !panFile.files || panFile.files.length === 0) {
                    $('#pan_image').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#pan_image');
                } else {
                    $('#pan_image').removeClass('is-invalid');
                }

                const frontFile = document.getElementById('front_image');
                if (!frontFile || !frontFile.files || frontFile.files.length === 0) {
                    $('#front_image').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#front_image');
                } else {
                    $('#front_image').removeClass('is-invalid');
                }

                const backFile = document.getElementById('back_image');
                if (!backFile || !backFile.files || backFile.files.length === 0) {
                    $('#back_image').addClass('is-invalid');
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#back_image');
                } else {
                    $('#back_image').removeClass('is-invalid');
                }

                // Validate Terms Checkbox
                if (!$('#kyc_terms').is(':checked')) {
                    $('#kyc_terms').addClass('is-invalid');
                    $('#kyc_terms_feedback').show();
                    valid = false;
                    if (!firstInvalid) firstInvalid = $('#kyc_terms');
                } else {
                    $('#kyc_terms').removeClass('is-invalid');
                    $('#kyc_terms_feedback').hide();
                }

                if (!valid) {
                    if (firstInvalid) {
                        firstInvalid[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                    return false;
                }

                // All KYC inputs valid -> Request OTP from distributor
                const btn = $(this);
                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Requesting Email OTP...');

                requestDistributorOtp(function(success, resOrMsg) {
                    btn.prop('disabled', false).html('<i class="fa-solid fa-check-double me-1"></i> I Agree and Accept <i class="fa-solid fa-arrow-right ms-1"></i>');
                    if (success) {
                        // Hide KYC modal
                        if (kycModal) kycModal.hide();
                        else $('#kycModal').modal('hide');

                        // Update Stepper to 4 (Distributor OTP)
                        updateStepper(4);

                        $('#distributor_otp_input').val('').removeClass('is-invalid');
                        $('#otpErrorAlert').addClass('d-none').text('');
                        startOtpCountdown(60);

                        // Open OTP verification modal
                        setTimeout(function() {
                            if (otpModal) {
                                otpModal.show();
                            } else {
                                $('#distributorOtpModal').modal('show');
                            }
                        }, 350);
                    } else {
                        alert(typeof resOrMsg === 'string' ? resOrMsg : 'Failed to send OTP to email.');
                    }
                });
            });

            // Resend OTP
            $('#btnResendOtp').on('click', function(e) {
                e.preventDefault();
                const resendBtn = $(this);
                resendBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Resending...');
                requestDistributorOtp(function(success, resOrMsg) {
                    if (success) {
                        $('#otpErrorAlert').addClass('d-none');
                        startOtpCountdown(60);
                    } else {
                        resendBtn.prop('disabled', false).text('Resend OTP');
                        $('#otpErrorAlert').removeClass('d-none').text(typeof resOrMsg === 'string' ? resOrMsg : 'Failed to resend OTP.');
                    }
                });
            });

            // STEP 4: VERIFY OTP AND COMPLETE REGISTRATION
            $('#btnVerifyOtpSubmit').on('click', function(e) {
                e.preventDefault();
                const otpVal = $('#distributor_otp_input').val().trim();
                if (!otpVal || otpVal.length !== 6 || !/^\d{6}$/.test(otpVal)) {
                    $('#distributor_otp_input').addClass('is-invalid');
                    return false;
                } else {
                    $('#distributor_otp_input').removeClass('is-invalid');
                }

                const submitBtn = $(this);
                submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Verifying OTP & Completing Registration...');
                $('#otpErrorAlert').addClass('d-none').text('');

                // Gather all inputs from Step 1 form + KYC modal inputs & files
                const formEl = document.getElementById('signupForm');
                const formData = new FormData(formEl);

                // Append all inputs, selects, textareas, and file uploads from #kycModal
                $('#kycModal').find('input, select, textarea').each(function() {
                    const name = $(this).attr('name');
                    if (!name) return;
                    if (this.type === 'file') {
                        if (this.files && this.files.length > 0) {
                            formData.set(name, this.files[0]);
                        }
                    } else if (this.type === 'radio' || this.type === 'checkbox') {
                        if (this.checked) {
                            formData.set(name, $(this).val());
                        }
                    } else {
                        formData.set(name, $(this).val());
                    }
                });

                formData.set('distributor_otp', otpVal);

                $.ajax({
                    url: "{{ route('userRegister') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        const targetUrl = (response && response.redirect) ? response.redirect : "{{ url('member/account-created') }}";
                        window.location.href = targetUrl;
                    },
                    error: function(xhr) {
                        // Handle possible parsererror caused by PHP startup notices prepending JSON
                        let resData = xhr.responseJSON;
                        if (!resData && xhr.responseText) {
                            const jsonMatch = xhr.responseText.match(/\{[\s\S]*\}/);
                            if (jsonMatch) {
                                try {
                                    resData = JSON.parse(jsonMatch[0]);
                                } catch(e) {}
                            }
                        }

                        if (resData && resData.success) {
                            const targetUrl = resData.redirect || "{{ url('member/account-created') }}";
                            window.location.href = targetUrl;
                            return;
                        }

                        submitBtn.prop('disabled', false).html('<i class="fa-solid fa-check-circle me-1"></i> Verify OTP & Complete Registration');
                        let errorMsg = 'Verification failed. Please check the entered OTP.';
                        if (resData && resData.message) {
                            errorMsg = resData.message;
                        } else if (resData && resData.errors) {
                            const errs = Object.values(resData.errors);
                            if (errs.length && errs[0].length) errorMsg = errs[0][0];
                        }
                        $('#otpErrorAlert').text(errorMsg).removeClass('d-none');
                    }
                });
            });

            // Clear invalid class on user input
            $(document).on('input change', 'input, select', function() {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>
</html>
