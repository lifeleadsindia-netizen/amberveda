@extends('member.layouts.main')
@section('title', 'Update KYC')
@section('container')
    <style>
        .member-kyc-card {
            position: relative;
            padding: 26px 24px;
            border-radius: 20px;
            color: #142947;
            background: linear-gradient(135deg, rgba(201, 170, 111, 0.6) 0%, rgba(255, 244, 214, 0.92) 30%, rgba(20, 41, 71, 0.35) 100%);
            border: 1px solid rgba(201, 170, 111, 0.6);
            box-shadow: 0 18px 38px rgba(160, 110, 10, 0.14);
            overflow: hidden;
        }

        .member-kyc-particles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(circle, rgba(201, 170, 111, 0.65) 2px, transparent 4px),
                radial-gradient(circle, rgba(217, 196, 160, 0.5) 2px, transparent 4px),
                radial-gradient(circle, rgba(255, 244, 214, 0.55) 2px, transparent 4px);
            background-size: 100px 100px, 150px 150px, 200px 200px;
            background-position: 0 0, 40px 60px, 20px 30px;
            opacity: 0.8;
            animation: memberKycParticles 12s linear infinite;
        }

        @keyframes memberKycParticles {
            0% { background-position: 0 0, 40px 60px, 20px 30px; }
            100% { background-position: -160px -240px, -200px -120px, -120px -180px; }
        }
        .member-kyc-card::before {
            content: "";
            position: absolute;
            top: -30px;
            right: -40px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 170, 111, 0.6), transparent 70%);
            opacity: 0.8;
        }

        .member-kyc-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(201, 170, 111, 0.35);
            color: #142947;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .member-kyc-title {
            margin: 18px 0 10px;
            font-size: 22px;
            font-weight: 800;
            color: #142947;
        }

        .member-kyc-text {
            margin: 0;
            color: rgba(20, 41, 71, 0.78);
            font-size: 14px;
            line-height: 1.7;
        }

        .member-kyc-meta {
            margin-top: 16px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .member-kyc-chip {
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(20, 41, 71, 0.12);
            color: #142947;
            font-size: 12px;
            font-weight: 700;
        }

        .member-kyc-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(201, 170, 111, 0.35);
        }

        .member-kyc-submitted {
            color: #5c3a00;
            background: linear-gradient(135deg, rgba(217, 176, 92, 0.7) 0%, rgba(255, 244, 214, 0.92) 35%, rgba(20, 41, 71, 0.22) 100%);
            border-color: rgba(217, 176, 92, 0.8);
            box-shadow: 0 18px 36px rgba(140, 90, 10, 0.16);
            border-left: 4px solid rgba(217, 176, 92, 0.9);
        }

        .member-kyc-submitted::before {
            background: radial-gradient(circle, rgba(217, 176, 92, 0.7), transparent 70%);
        }

        .member-kyc-submitted .member-kyc-badge {
            background: rgba(217, 176, 92, 0.35);
            color: #5c3a00;
        }

        .member-kyc-submitted .member-kyc-chip {
            background: rgba(217, 176, 92, 0.3);
            color: #5c3a00;
        }

        .member-kyc-submitted .member-kyc-icon {
            background: rgba(217, 176, 92, 0.35);
        }

        .member-kyc-submitted .member-kyc-icon svg {
            color: #b87400;
        }

        .member-kyc-submitted .member-kyc-title {
            color: #5c3a00;
        }

        .member-kyc-submitted .member-kyc-text {
            color: rgba(92, 58, 0, 0.78);
        }
        .member-kyc-verified {
            color: #0f1f3a;
            background: linear-gradient(135deg, rgba(201, 170, 111, 0.6) 0%, rgba(255, 244, 214, 0.92) 30%, rgba(20, 41, 71, 0.4) 100%);
            border-color: rgba(201, 170, 111, 0.7);
            box-shadow: 0 18px 38px rgba(8, 20, 40, 0.18);
        }

        .member-kyc-verified::before {
            background: radial-gradient(circle, rgba(201, 170, 111, 0.7), transparent 70%);
        }

        .member-kyc-verified .member-kyc-badge {
            background: rgba(20, 41, 71, 0.12);
            color: #142947;
        }

        .member-kyc-verified .member-kyc-chip {
            background: rgba(20, 41, 71, 0.12);
            color: #142947;
        }

        .member-kyc-verified .member-kyc-icon {
            background: rgba(201, 170, 111, 0.35);
        }

        .member-kyc-verified .member-kyc-icon svg {
            color: #c9aa6f;
        }

        .member-kyc-verified .member-kyc-title {
            color: #142947;
        }

        .member-kyc-verified .member-kyc-text {
            color: rgba(20, 41, 71, 0.78);
        }
        .member-kyc-icon svg {
            width: 22px;
            height: 22px;
            color: #c9aa6f;
        }
    </style>
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
                    <div class="alert bg-success text-white" role="alert">
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
                                    <input type="text" class="form-control" name="bank" placeholder="Enter Bank Name">
                                    @error('bank')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">Holder Name</label>
                                    <input type="text" class="form-control" name="holder" placeholder="Enter Holder Name">
                                    @error('holder')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc" placeholder="Enter IFSC Code">
                                    @error('ifsc')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">A/C No</label>
                                    <input type="text" class="form-control" name="account_no" placeholder="Enter A/C No.">
                                    @error('account_no')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--<div class="mb-3">-->
                                <!--    <label for="email" class="form-label">Email</label>-->
                                <!--    <input type="text" class="form-control" name="email" placeholder="Enter Email">-->
                                <!--    @error('email')-->
                                <!--        <span class=" text-danger">{{ $message }}</span>-->
                                <!--    @enderror-->
                                <!--</div>-->
                                <div class="mb-3">
                                    <label for="Aadhar" class="form-label">Aadhar No.</label>
                                    <input type="text" class="form-control" name="adhar_no"
                                        placeholder="Enter Aadhar No">
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
                                <div class="mb-3">
                                    <label for="Name" class="form-label">Nominee Name</label>
                                    <input type="text" class="form-control" name="nominee_name" placeholder="Enter Nominee Name">
                                    @error('nominee_name')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Name" class="form-label">Nominee Relation</label>
                                    <input type="text" class="form-control" name="nominee_relation" placeholder="Enter Nominee Relation">
                                    @error('nominee_relation')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Aadhar" class="form-label">Nominee No.</label>
                                    <input type="text" class="form-control" name="nominee_no"
                                        placeholder="Enter Nominee No">
                                    @error('nominee_no')
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
                                <div class="form-group mb-3 ">
                                    <label class="form-label">Cheque/Passbook Image (Optional)</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="cheque_image">
                                    </div>
                                    @error('cheque_image')
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
                    <div class="member-kyc-card member-kyc-submitted">
                        <span class="member-kyc-particles" aria-hidden="true"></span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="member-kyc-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 6v6l3 3"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                </svg>
                            </span>
                            <span class="member-kyc-badge">KYC Submitted</span>
                        </div>
                        <h4 class="member-kyc-title">KYC Has Been Submitted</h4>
                        <p class="member-kyc-text">Your KYC is submitted. Please wait for admin verification.</p>
                        <div class="member-kyc-meta">
                            <span class="member-kyc-chip">In Review</span>
                            <span class="member-kyc-chip">Pending Approval</span>
                            <span class="member-kyc-chip">We Will Notify You</span>
                        </div>
                    </div>
                                @elseif ($data['kyc_status'] == 'Verified')
                    <div class="member-kyc-card member-kyc-verified">
                        <span class="member-kyc-particles" aria-hidden="true"></span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="member-kyc-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 12l2 2 4-4"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                </svg>
                            </span>
                            <span class="member-kyc-badge">KYC Verified</span>
                        </div>
                        <h4 class="member-kyc-title">KYC Has Been Verified</h4>
                        <p class="member-kyc-text">Congratulations! Your KYC is approved and your member profile is fully active.</p>
                        <div class="member-kyc-meta">
                            <span class="member-kyc-chip">Verified</span>
                            <span class="member-kyc-chip">Secure Access</span>
                            <span class="member-kyc-chip">Full Features</span>
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









