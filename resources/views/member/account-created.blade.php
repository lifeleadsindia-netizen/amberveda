<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Account Created | {{ config('detailsApp.name') }}</title>
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

        .space-particles,
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

        @keyframes planetDrift {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(20px, -18px, 0) scale(1.04); }
        }

        @keyframes astronautFloat {
            0%, 100% { transform: translate3d(0, 0, 0) rotate(-8deg); }
            50% { transform: translate3d(36px, -28px, 0) rotate(8deg); }
        }

        @keyframes particleFloat {
            0% { transform: translate3d(0, 0, 0) scale(0.7); opacity: 0; }
            10% { opacity: 0.95; }
            50% { transform: translate3d(-40px, -50vh, 0) scale(1); opacity: 0.9; }
            100% { transform: translate3d(55px, -105vh, 0) scale(0.4); opacity: 0; }
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
            background: radial-gradient(circle, rgba(159, 122, 59, 0.68) 0%, rgba(111, 83, 36, 0.44) 24%, rgba(111, 83, 36, 0.2) 46%, rgba(111, 83, 36, 0) 72%);
            filter: blur(22px);
            transform: translate3d(-50%, -50%, 0);
            transition: opacity 0.2s ease;
            mix-blend-mode: screen;
        }

        .signin-shell {
            max-width: 560px;
            margin: 0 auto;
            border-radius: 30px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(3, 3, 2, 0.18);
            box-shadow: 0 32px 90px rgba(4, 11, 22, 0.42);
            backdrop-filter: blur(16px);
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
            display: block;
            margin: 0 auto;
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

        .welcome-name {
            color: #fff7e8;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 28px;
            text-align: center;
            margin: 0 0 6px;
        }

        .helper-text {
            color: rgba(243, 234, 216, 0.72);
            font-size: 14px;
            line-height: 1.7;
            text-align: center;
            margin-bottom: 22px;
        }

        .summary-card {
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(201, 170, 111, 0.2);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 6px 18px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .summary-row {
            display: grid;
            grid-template-columns: 190px 1fr;
            gap: 14px;
            padding: 14px 16px;
            border-bottom: 1px solid rgba(201, 170, 111, 0.14);
        }

        .summary-row:last-child {
            border-bottom: 0;
        }

        .summary-label {
            color: var(--premium-gold-light);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .summary-value {
            color: #f8eed7;
            font-size: 15px;
            font-weight: 700;
            word-break: break-word;
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(201, 170, 111, 0.08);
            border: 1px solid rgba(201, 170, 111, 0.18);
            color: rgba(243, 234, 216, 0.82);
            margin-bottom: 22px;
        }

        .security-note i {
            color: var(--premium-gold);
            font-size: 18px;
            margin-top: 2px;
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-premium,
        .btn-outline-premium {
            min-height: 56px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .btn-premium {
            background: linear-gradient(135deg, #b89252 0%, #c9aa6f 48%, #e2cc9b 100%);
            color: #111214;
            box-shadow: 0 16px 34px rgba(201, 170, 111, 0.24);
            border: none;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 38px rgba(201, 170, 111, 0.32);
            color: #111214;
        }

        .btn-outline-premium {
            border: 1px solid rgba(201, 170, 111, 0.28);
            background: rgba(255, 255, 255, 0.04);
            color: var(--premium-gold-light);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.04), 0 6px 18px rgba(0, 0, 0, 0.18);
        }

        .btn-outline-premium:hover {
            transform: translateY(-2px);
            background: rgba(201, 170, 111, 0.1);
            color: #fff3d3;
        }

        .foot-note {
            margin-top: 18px;
            color: rgba(243, 234, 216, 0.62);
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 991.98px) {
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

            .signin-card {
                padding: 30px 20px;
            }

            .signin-header h2 {
                font-size: 34px;
            }

            .welcome-name {
                font-size: 24px;
            }

            .summary-row {
                grid-template-columns: 1fr;
                gap: 6px;
                padding: 13px 14px;
            }

            .actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="loading authentication-bg">
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
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="signin-shell">
                        <div class="signin-card">
                            <div class="signin-header">

                                <img src="{{ asset('logo/logo.png') }}" alt="logo">
                                <h2>Account Created Successfully</h2>
                                <p>Your member profile has been created successfully and is ready for access.</p>
                            </div>

                            <h3 class="welcome-name">{{ session('name') }}</h3>
                            <!--<div class="helper-text">Use the credentials below to sign in to your member panel and keep both passwords secure.</div>-->

                            <div class="summary-card">
                                <div class="summary-row">
                                    <div class="summary-label"><i class="fa-regular fa-id-badge me-2"></i>Member ID</div>
                                    <div class="summary-value">{{ session('memberid') }}</div>
                                </div>
                                <div class="summary-row">
                                    <div class="summary-label"><i class="fa-regular fa-envelope me-2"></i>Email</div>
                                    <div class="summary-value">{{ session('email') }}</div>
                                </div>
                                <div class="summary-row">
                                    <div class="summary-label"><i class="fa-solid fa-phone me-2"></i>Mobile</div>
                                    <div class="summary-value">{{ session('mobile') }}</div>
                                </div>
                                <div class="summary-row">
                                    <div class="summary-label"><i class="fa-solid fa-lock me-2"></i>Password</div>
                                    <div class="summary-value">{{ session('password') }}</div>
                                </div>
                                <!--<div class="summary-row">-->
                                <!--    <div class="summary-label"><i class="fa-solid fa-key me-2"></i>Transaction Password</div>-->
                                <!--    <div class="summary-value">{{ session('txn_password') }}</div>-->
                                <!--</div>-->
                            </div>


                            <div class="actions">
                                <a href="{{ url('/member') }}" class="btn-premium"><i class="fa-solid fa-right-to-bracket me-2"></i>Login Now</a>
                                <a href="{{ url('/member/register/1/side') }}" class="btn-outline-premium"><i class="fa-solid fa-user-plus me-2"></i>New Register</a>
                            </div>

                            <div class="foot-note">If needed, you can return and create another member account from the registration page.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('mem_assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('mem_assets/js/app.min.js') }}"></script>
    <script>
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
        });
    </script>
</body>

</html>





