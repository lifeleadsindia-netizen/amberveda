@extends('member.layouts.main')
@section('title', 'Security')
@section('container')
    <div class="main-content">

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                            style="text-decoration: none">Password Change</a></li>
                                </ol>
                            </nav>

                        </div>
                        <h4 class="page-title">Password Change</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    @if (session()->has('successMsg'))
                        <div class="alert alert-success">{{ session('successMsg') }}</div>
                    @endif
                    @if (session()->has('confirm_passError'))
                        <div class="alert alert-danger">{{ session('confirm_passError') }}</div>
                    @endif
                    <div class="card">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="changeTxnPassword" role="tabpanel">

                                <div class="card-header">
                                    <h4 class="card-title my-2">Changes Transaction Password</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('txnpassChange') }}" method="post">
                                        @csrf
                                        <div class="row g-2 justify-content-lg-between align-items-center">
                                            <div class="col-lg-12">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="password-input" class="form-label fs-md">New Transaction
                                                        Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password" id="main_password"
                                                            class="form-control password-input fs-md" name="txn_password"
                                                            minlength="6" placeholder="New Transaction password" />
                                                        @error('txn_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="confirm-password-input" class="form-label fs-md">Confirm
                                                        Transaction Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password" id="main_cofirmation"
                                                            class="form-control password-input fs-md"
                                                            name="txn_password_confirm" placeholder="Confirm Transaction password" />
                                                        @error('txn_password_confirm')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <div class="float-end">
                                                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                    <button type="submit" class="btn btn-info">Change Txn 
                                                        Password</button>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card bg-light shadow-none passwd-bg" id="password-contain">
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <h5 class="fs-sm">Transaction Password must contain:</h5>
                                                        </div>
                                                        <div class="">
                                                            <p id="pass-length" class="invalid fs-xs mb-2">
                                                                -> Minimum <b>6 characters</b></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    @if (session()->has('confirm_pasSuccess'))
                        <div class="alert alert-success">{{ session('confirm_pasSuccess') }}</div>
                    @endif
                    <div class="card">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="changePassword" role="tabpanel">

                                <div class="card-header">
                                    <h4 class="card-title my-2">Changes Password</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('passChange') }}" method="post">
                                        @csrf
                                        <div class="row g-2 justify-content-lg-between align-items-center">
                                            <div class="col-lg-12">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="password-input" class="form-label fs-md">New
                                                        Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password" id="main_password"
                                                            class="form-control password-input fs-md" name="password"
                                                            minlength="6" placeholder="New password" />
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="auth-pass-inputgroup">
                                                    <label for="confirm-password-input" class="form-label fs-md">Confirm
                                                        Password*</label>
                                                    <div class="position-relative">
                                                        <input type="password" id="main_cofirmation"
                                                            class="form-control password-input fs-md"
                                                            name="password_confirmation" placeholder="Confirm password" />
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <div class="float-end">
                                                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                                                    <button type="submit" class="btn btn-info">Change
                                                        Password</button>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card bg-light shadow-none passwd-bg" id="password-contain">
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <h5 class="fs-sm">Password must contain:</h5>
                                                        </div>
                                                        <div class="">
                                                            <p id="pass-length" class="invalid fs-xs mb-2">
                                                                -> Minimum <b>6 characters</b></p>
                                                        </div>
                                                    </div>
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
        </div>

    </div>
    </div>
    {{-- <button class="btn btn-dark btn-icon" id="back-to-top">
        <i class="bi bi-caret-up fs-3xl"></i>
    </button> --}}

    <script src="{{ asset('userassets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('userassets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('userassets/js/plugins.js') }}"></script>
    <script src="{{ asset('userassets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('userassets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ asset('userassets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('userassets/js/pages/dashboard-analytics.init.js') }}"></script>
    <script src="{{ asset('userassets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <script src="{{ asset('userassets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('userassets/js/pages/swiper.init.js') }}"></script>
    <script src="{{ asset('userassets/js/app.js') }}"></script>


    <script src="{{ asset('userassets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('userassets/js/custom.js') }}"></script>
    <script>
        CartQty();

        function CartQty() {
            (document.querySelector(".hamburger-icon").classList.remove("open"))
            // $('#CartQty')
            //     .html('<i class="fa fa-spin fa-spinner" style="font-size:10px !important"></i>').load(
            //         "services/CartQty.ashx");
        }

        function cLogout() {
            $('#logoutModal').modal('show');
        }

        function logout() {
            window.location.href = '/uLogout';
        }
    </script>
    </body>

    </html>
@endsection
