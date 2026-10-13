@extends('member.layouts.main')
@section('title', 'Update KYC')
@section('container')
    <!-- Content wrapper -->
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">KYC Upload</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">KYC Upload</h4>
                </div>
            </div>
        </div>
        <!--/ Header -->
        <div class="row" style="min-height: 70vh">
            <div class="col-md-7">
                @if (session()->has('kycMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('kycMsg') }}
                    </div>
                @endif
                @if ($data['kyc_status'] == '' || $data['kyc_status'] == null || $data['kyc_status'] == 'Unverified')
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('KYC Form') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('memKyc') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="Name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" name="bank" placeholder="Enter Name">
                                    @error('name')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">Holder Name</label>
                                    <input type="text" class="form-control" name="holder" placeholder="Enter Name">
                                    @error('name')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">IFSC</label>
                                    <input type="text" class="form-control" name="ifsc" placeholder="Enter Name">
                                    @error('name')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">A/C No</label>
                                    <input type="text" class="form-control" name="account_no" placeholder="Enter Name">
                                    @error('name')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                    @error('email')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Aadhar" class="form-label">Aadhar No.</label>
                                    <input type="text" class="form-control" name="adhar_no"
                                        placeholder="Enter Goverment ID No">
                                    @error('adhar_no')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="PAN" class="form-label">PAN No.</label>
                                    <input type="text" class="form-control" name="pan_no" placeholder="Enter PAN No">
                                    @error('pan_no')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                <label for="WalletAdd" class="form-label">Wallet Address</label>
                                <input type="text" name="wallet_address" id="WalletAdd" class="form-control"
                                    placeholder="Enter Wallel Address">
                                @error('wallet_address')
                                    <span class=" text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                                <!--<div class="form-group mb-3">-->
                                <!--    <label class="form-label">QR Image</label>-->
                                <!--    <div class="">-->
                                <!--        <input type="file" class="form-control" name="qr_code">-->
                                <!--    </div>-->
                                <!--    @error('qr_code')
        -->
                                    <!--        <span class=" text-danger">{{ $message }}</span>-->
                                    <!--
    @enderror-->
                                <!--</div>-->
                                <div class="form-group mb-3 ">
                                    <label class="form-label">PAN Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="pan_image">
                                    </div>
                                    @error('pan_image')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label">Aadhar Front Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="front_image">
                                    </div>
                                    @error('front_image')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label">Aadhar Back Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="back_image">
                                    </div>
                                    @error('back_image')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ml-5">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" required>
                                        I agree to all Terms & Conditions
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                                    <button type="submit" class="btn btn-success mt-3 float-end">KYC Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif ($data['kyc_status'] == 'Submitted')
                    <div class="alert alert-warning" role="alert" style="overflow: auto">
                        <h4 class="card-title text-dark">KYC Has Been Submitted</h4>
                        <p class="card-description text-dark">Your KYC is submitted. Please contact to Admin
                            to Verified your KYC.</p>
                    </div>
                @elseif ($data['kyc_status'] == 'Verified')
                    <div class="header" style>
                        <div class="alert alert-primary" role="alert" style="overflow: auto">
                            <h4 class="card-title text-dark">KYC Has Been Verified</h4>
                            <p class="card-description text-dark">Congratulations ! Your KYC has been
                                Verified.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- / Content -->

    <script src="{{ asset('mem_assets/libs/jquery/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.mdi mdi-eye-off').on('click', function() {
                var type = $('#password').attr('type');
                if (type == 'password') {
                    $('#password').attr('type', 'text');
                    $('#eye').removeClass('mdi mdi-eye-off').addClass('mdi mdi-eye-outline')
                } else {
                    $('#password').attr('type', 'password');
                    $('#eye').removeClass('mdi mdi-eye-outline').addClass('mdi mdi-eye-off')
                }
            })
        });

        $('#sponsor').on('input', function() {
            var sponsor = $(this).val();
            var token = $('#csrfToken').val();
            if (sponsor.length == 0) {
                $('#sponhtml').html('');
            }
            $.ajax({
                url: '/getSponname',
                type: 'POST',
                data: {
                    'sponsorid': sponsor,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                    $('#sponhtml').html(response['data'])

                }
            })
        });

        $('#username').on('input', function() {
            var username = $(this).val();
            var token = $('#csrfToken').val();
            if (username.length == 0) {
                $('#userhtml').html('');
            }
            $.ajax({
                url: '/getUsername',
                type: 'POST',
                data: {
                    'username': username,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#userhtml').html(response['data'])
                }
            })
        });
    </script>
@endsection
