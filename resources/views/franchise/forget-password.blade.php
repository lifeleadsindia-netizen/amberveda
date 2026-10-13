<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Forget Password | {{ config('detailsApp.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="VoxabitGenix Admin Panel" name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg')}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png')}}" />
    <link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest')}}" />

    <!-- App css -->
    <link href="{{ asset('franchise_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('franchise_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('franchise_assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    <style>
        body.authentication-bg {
            background: linear-gradient(135deg, #18122B 0%, #6B096B 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            overflow-y: auto;
        }
        .account-pages {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem 0 1rem !important;
        }
        .modern-card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(8px) saturate(120%);
            border-radius: 2rem 2rem 2rem 2rem;
            box-shadow: 0 8px 32px 0 rgba(107,9,107,0.13), 0 2px 8px 0 rgba(14, 9, 107, 0.08);
            max-width: 420px;
            margin: auto auto 2.5rem auto;
            padding: 0;
            transition: box-shadow .25s, transform .25s;
            border: 1.5px solid rgba(107,9,107,0.10);
        }
        .modern-card:hover {
            box-shadow: 0 16px 48px 0 rgba(107,9,107,0.18), 0 4px 16px 0 rgba(14, 9, 107, 0.12);
            transform: translateY(-4px) scale(1.012);
        }
        .modern-header {
            background: linear-gradient(90deg,#f8fafc,#e0f2fe 80%,#fff 100%);
            padding: 2rem 2rem 1.2rem 2rem;
            text-align: center;
            border-radius: 2rem 2rem 0 0;
        }
        .modern-header img {
            width: 90px;
            height: auto;
            margin-bottom: 0.7rem;
            background: linear-gradient(90deg,#ffffff,#f8fafc);
            padding: 10px;
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgba(2,6,23,0.12);
        }
        .modern-header h2 {
            color: #6B096B;
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 0.2rem;
            letter-spacing: 1px;
        }
        .modern-body {
            padding: 2rem 2rem 1.5rem 2rem;
        }
        .form-label {
            font-weight: 700;
            color: #18122B;
            margin-bottom: 0.5rem;
            font-size: 1.01rem;
        }
        .input-group {
            display: flex;
            align-items: center;
            border-radius: 1rem;
            background: #f7f8fa;
            border: 1.5px solid #e6eef8;
            box-shadow: 0 1px 4px rgba(107,9,107,0.04);
            margin-bottom: 0.5rem;
        }
        .input-group-text {
            background: transparent;
            border: none;
            color: #6B096B;
            font-size: 1.2rem;
            padding-left: 1rem;
            padding-right: 0.5rem;
        }
        .form-control {
            border: none;
            background: transparent;
            font-size: 1.08rem;
            padding: 0.9rem 1rem;
            border-radius: 1rem;
            outline: none;
            width: 100%;
        }
        .form-control:focus {
            background: #fff;
            box-shadow: 0 0 0 2px #e3e8ff;
        }
        .btn-primary {
            width: 100%;
            padding: 1.08rem;
            border-radius: 1rem;
            border: none;
            background: linear-gradient(90deg,#6B096B,#0ea5e9);
            color: #fff;
            font-weight: 900;
            letter-spacing: 0.7px;
            font-size: 1.11rem;
            box-shadow: 0 8px 30px rgba(14,165,233,0.18);
            transition: all .25s cubic-bezier(.4,0,.2,1);
            position: relative;
            overflow: hidden;
        }
        .btn-primary:active {
            transform: scale(0.98);
        }
        .btn-primary.loading::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 1.5rem;
            height: 1.5rem;
            border: 3px solid #fff;
            border-top: 3px solid #6B096B;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            transform: translate(-50%, -50%);
        }
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        .btn-link {
            color: #6B096B;
            font-weight: 700;
            font-size: 1.01rem;
            text-decoration: none;
            transition: color .2s;
        }
        .btn-link:hover {
            color: #0ea5e9;
            text-decoration: underline;
        }
        .alert {
            border-radius: 12px;
            font-size: 1.03rem;
            margin-bottom: 1.2rem;
            padding: 1rem 1.2rem;
            font-weight: 500;
        }
        .alert-success {
            background: #e7fbe7;
            color: #1a7f37;
            border: 1.5px solid #b6e7b6;
        }
        .alert-danger {
            background: #fbe7e7;
            color: #a71d2a;
            border: 1.5px solid #e7b6b6;
        }
        .modern-footer {
            text-align: center;
            color: #6B096B;
            font-size: 1rem;
            margin-top: 2rem;
            font-weight: 600;
        }
        @media (max-width: 600px) {
            .modern-card { border-radius: 1rem 1rem 1rem 1rem; }
            .modern-header { border-radius: 1rem 1rem 0 0; }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" />
</head>

<body class="loading authentication-bg"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mx-lg-0 mx-3">
                        <div class="modern-card">
                            <div class="modern-header">
                                <img src="{{ asset('logo/logo.png') }}" alt="logo">
                                <h2>Forgot Password</h2>
                            </div>
                            <div class="modern-body">
                                @if (session()->has('successMsg'))
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-check-circle me-2"></i>{{ session('successMsg') }}
                                    </div>
                                @endif
                                @if (session()->has('failedMsg'))
                                    <div class="alert alert-danger text-center">
                                        <i class="fa fa-exclamation-circle me-2"></i>{{ session('failedMsg') }}
                                    </div>
                                @endif
                                <form action="{{ route('franchiseRetrievePassword') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="franchise_id" class="form-label">Franchise ID</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input class="form-control" type="text" placeholder="Enter Franchise ID" name="franchise_id" id="franchise_id" required autofocus />
                                        </div>
                                        <small class="text-muted">Password will be sent to your registered email Id</small>
                                        @error('franchise_id')
                                            <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mb-0 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            <span>Retrieve Password</span>
                                        </button>
                                    </div>
                                </form>
                                <div class="mt-4 text-center">
                                    <a href="{{ url('/franchise_panel') }}" class="btn btn-link"><i class="fa fa-arrow-left me-1"></i>Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page -->

    <footer class="modern-footer">
        {{ date('Y') }} © {{ config('detailsApp.name') }}
    </footer>

    <!-- bundle -->
    <script src="{{ asset('franchise_assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('franchise_assets/js/app.min.js') }}"></script>

</body>

</html>
