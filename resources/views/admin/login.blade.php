<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | {{ config('detailsApp.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- App favicon -->
<link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
<link rel="shortcut icon" href="{{ asset('logo/favicon/favicon.ico') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
<link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/ionicons/dist/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('adm_assets/assets/dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adm_assets/assets/css/style.css') }}">
    <script src="{{ asset('adm_assets/assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <style>
        body {
            background: #000 !important;
            min-height: 100vh;
            font-family: 'Nunito Sans', 'Segoe UI', Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div class="auth-wrapper" style="background: #000">
        <div class="container-fluid">
            <div class="row flex-row">
                <div class="col-xl-4 col-lg-4 col-md-4 m-auto">

                    <div class="authentication-form mx-auto">
                       
                        <div class="logo-centered">
                            <img src="{{ asset('logo/logo.png') }}" alt="" style="width:100px" />
                            <h4 class="mt-2" style="font-weight:700">Admin Login</h4>
                        </div>
                        <p>Welcome back! </p>
                         @if (session()->has('successMsg'))
                            <span class="text-danger text-center">{{ session('accessMsg') }}</span>
                        @endif
                        @if (session()->has('failedMsg'))
                            <div class="alert alert-danger mb-3">{{ session('failedMsg') }}</div>
                        @endif
                        @if (session()->has('OtpMsg'))
                            <div class="alert alert-success mb-3">{{ session('OtpMsg') }}</div>
                        @endif
                        <form method="POST" action="{{ route('adminLogin') }}">
                            @csrf

                             <div class="form-group">
                                <a href="{{ url('/send-admin-otp') }}" class="btn btn-custom text-white pt-2">Send
                                    OTP</a>
                            </div>

                            <div class="form-group">
                            
                                <input type="number" placeholder="Enter OTP" class="form-control" name="otp"
                                    required>
                                <i class="ik ik-mail"></i>
                                @error('otp')
                                    <span style="margin-top: .25rem;font-size: 80%;color: #dc3545;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <input id="email" type="email" placeholder="Enter Email" class="form-control"
                                    name="email" required autocomplete="email" autofocus>
                                <i class="ik ik-user"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" placeholder="Password" class="form-control"
                                    name="password" placeholder="Enter Password" required>
                                <i class="ik ik-lock"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="mr-2">{{ session('str1') }} +
                                            {{ session('str2') }}</i>
                                        <input type="text" class="form-control password-input" name="login-captcha"
                                            id="login-captcha" placeholder="Enter Answer Here" required>
                                    </span>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="row">
                                <div class="col text-right">
                                    <a class="btn text-danger" href="{{ url('forget-password') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                </div>
                            </div>
                            @if (session()->has('accessMsg'))
                                <span class="text-danger text-center">{{ session('accessMsg') }}</span>
                            @endif
                            @if (session()->has('loginmsg'))
                                <div class="alert alert-danger mb-3">{{ session('loginmsg') }}</div>
                            @endif
                            <div class="sign-btn text-center">
                                <button class="btn btn-custom">Sign In</button>
                            </div>

                            {{-- <div class="register">
                                <p>{{ __('No account?') }} <a href="#">{{ __('Sign Up') }}</a></p>
                            </div> --}}

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adm_assets/assets/src/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('adm_assets/assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('adm_assets/assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adm_assets/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('adm_assets/assets/plugins/screenfull/dist/screenfull.js') }}"></script>

</body>

</html>
