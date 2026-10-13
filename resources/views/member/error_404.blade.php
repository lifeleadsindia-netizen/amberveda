<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Error 404 | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />

    <!-- Theme Config Js -->
    <script src="{{ asset('mem_assets/js/hyper-config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('mem_assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('mem_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('mem_assets/css/unicons/css/unicons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mem_assets/css/remixicon/remixicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('mem_assets/css/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" />
    <style>
        body.authentication-bg {
            background: linear-gradient(135deg, #18122B 0%, #6B096B 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            overflow-y: auto;
        }
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }
        .error-card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(8px) saturate(120%);
            border-radius: 2.5rem;
            box-shadow: 0 8px 32px 0 rgba(107,9,107,0.13), 0 2px 8px 0 rgba(14, 9, 107, 0.08);
            max-width: 420px;
            width: 100%;
            margin: 2rem auto;
            padding: 2.5rem 2rem 2rem 2rem;
            text-align: center;
            animation: fadeInUp 1s cubic-bezier(.39,.575,.56,1.000);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .error-404 {
            font-size: 6rem;
            font-weight: 900;
            color: #6B096B;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 24px rgba(107,9,107,0.13);
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            line-height: 1;
            animation: float404 2.5s ease-in-out infinite alternate;
        }
        @keyframes float404 {
            0% { transform: translateY(0); }
            100% { transform: translateY(-12px); }
        }
        .error-icon {
            font-size: 3rem;
            color: #0ea5e9;
            margin-bottom: 0.5rem;
            animation: fadeIn 1.2s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .error-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #18122B;
            margin-bottom: 0.5rem;
        }
        .error-message {
            color: #6B096B;
            font-size: 1.08rem;
            margin-bottom: 1.5rem;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1.2rem;
        }
        .error-actions .btn {
            min-width: 150px;
            font-weight: 700;
            font-size: 1.05rem;
            border-radius: 1rem;
            padding: 0.9rem 1.2rem;
            box-shadow: 0 2px 8px 0 rgba(44, 62, 80, 0.10);
            border: none;
            transition: background 0.2s, box-shadow 0.2s, transform 0.18s;
            outline: none;
        }
        .error-actions .btn-primary {
            background: linear-gradient(90deg, #6B096B 0%, #0ea5e9 100%);
            color: #fff;
        }
        .error-actions .btn-primary:focus, .error-actions .btn-primary:hover {
            background: linear-gradient(90deg, #0ea5e9 0%, #6B096B 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .error-actions .btn-secondary {
            background: #f7f8fa;
            color: #6B096B;
            border: 1.5px solid #e6eef8;
        }
        .error-actions .btn-secondary:focus, .error-actions .btn-secondary:hover {
            background: #e0f2fe;
            color: #0ea5e9;
            transform: translateY(-2px) scale(1.03);
        }
        .error-search {
            margin: 1.5rem 0 0.5rem 0;
            display: flex;
            justify-content: center;
        }
        .error-search input {
            border-radius: 1rem 0 0 1rem;
            border: 1.5px solid #e6eef8;
            padding: 0.7rem 1.1rem;
            font-size: 1.05rem;
            outline: none;
            width: 180px;
            transition: box-shadow .2s;
        }
        .error-search input:focus {
            box-shadow: 0 0 0 2px #e3e8ff;
        }
        .error-search button {
            border-radius: 0 1rem 1rem 0;
            border: 1.5px solid #e6eef8;
            background: #6B096B;
            color: #fff;
            font-size: 1.1rem;
            padding: 0.7rem 1.1rem;
            transition: background .2s;
        }
        .error-search button:focus, .error-search button:hover {
            background: #0ea5e9;
        }
        .error-help {
            margin-top: 0.7rem;
            color: #6B096B;
            font-size: 1.01rem;
        }
        @media (max-width: 600px) {
            .error-card {
                border-radius: 1.2rem;
                padding: 1.2rem 0.7rem 1rem 0.7rem;
            }
            .error-404 {
                font-size: 3.2rem;
            }
            .error-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body class="authentication-bg">

    <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
        <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
            <g fill-opacity='0.22'>
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100' />
            </g>
        </svg>
    </div>

    <div class="error-container">
        <div class="error-card">
            <div class="error-icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div class="error-404">404</div>
            <div class="error-title">Page Not Found</div>
            <div class="error-message">Sorry, the page you are looking for does not exist or has been moved.<br>Try searching or use the buttons below to get back on track.</div>
            <div class="error-actions">
                <a href="/" class="btn btn-primary" tabindex="0"><i class="fa fa-home me-2"></i>Go to Home</a>
                <a href="{{ url('/member') }}" class="btn btn-secondary" tabindex="0"><i class="fa fa-sign-in-alt me-2"></i>Back to Login</a>
            </div>
            {{-- <form class="error-search" action="https://www.google.com/search" method="get" target="_blank" autocomplete="off">
                <input type="text" name="q" placeholder="Search help..." aria-label="Search help">
                <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
            </form> --}}
            {{-- <div class="error-help">
                <a href="mailto:support@example.com"><i class="fa fa-question-circle me-1"></i>Contact Support</a>
            </div> --}}
        </div>
    </div>

    {{-- <footer class="footer footer-alt text-white">
        {{ date('Y') }} © {{ config('detailsApp.name') }}
    </footer> --}}
    <!-- Vendor js -->
    <script src="{{ asset('mem_assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('mem_assets/js/app.js') }}"></script>

</body>

</html>
