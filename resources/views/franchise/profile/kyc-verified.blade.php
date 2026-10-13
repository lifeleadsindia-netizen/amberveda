@extends('franchise.layouts.main')
@section('title', 'Update KYC')
@section('container')
    <style>
        .kyc-verified-card {
            position: relative;
            padding: 28px 26px;
            border-radius: 20px;
            color: #5b2440;
            background: linear-gradient(135deg, rgba(255, 214, 232, 0.7) 0%, rgba(255, 255, 255, 0.98) 45%, rgba(255, 228, 240, 0.6) 100%);
            background-size: 180% 180%;
            border: 1px solid rgba(255, 182, 213, 0.55);
            box-shadow: 0 18px 40px rgba(120, 40, 80, 0.12);
            overflow: hidden;
            animation: kycGlow 10s ease-in-out infinite;
        }

        .kyc-verified-card::after {
            content: "";
            position: absolute;
            inset: -40% -20% 0 -20%;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.2), rgba(255, 182, 213, 0.28), rgba(255, 255, 255, 0));
            opacity: 0.6;
            transform: translateX(-40%);
            animation: kycSheen 6s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes kycGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes kycSheen {
            0% { transform: translateX(-40%) rotate(0deg); }
            50% { transform: translateX(20%) rotate(2deg); }
            100% { transform: translateX(-40%) rotate(0deg); }
        }        .kyc-verified-particles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(circle, rgba(255, 148, 200, 0.7) 2px, transparent 4px),
                radial-gradient(circle, rgba(255, 148, 200, 0.5) 2px, transparent 4px),
                radial-gradient(circle, rgba(255, 220, 235, 0.6) 2px, transparent 4px);
            background-size: 100px 100px, 150px 150px, 200px 200px;
            background-position: 0 0, 40px 60px, 20px 30px;
            opacity: 0.85;
            animation: kycParticles 12s linear infinite;
        }

        @keyframes kycParticles {
            0% { background-position: 0 0, 40px 60px, 20px 30px; }
            100% { background-position: -160px -240px, -200px -120px, -120px -180px; }
        }
        .kyc-verified-card::before {
            content: "";
            position: absolute;
            top: -40px;
            right: -60px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 182, 213, 0.55), transparent 70%);
            opacity: 0.8;
        }

        .kyc-submitted .kyc-verified-badge {
            background: rgba(255, 214, 130, 0.5);
            color: #7a4a00;
        }

        .kyc-submitted .kyc-verified-icon {
            background: rgba(255, 214, 130, 0.45);
        }

        .kyc-submitted .kyc-verified-icon svg {
            color: #b06a00;
        }

                .kyc-submitted {
            background: linear-gradient(135deg, rgba(255, 236, 186, 0.85) 0%, rgba(255, 255, 255, 0.98) 45%, rgba(255, 224, 150, 0.7) 100%);
            border-color: rgba(255, 214, 130, 0.75);
            box-shadow: 0 18px 40px rgba(160, 120, 20, 0.14);
        }

        .kyc-submitted::before {
            background: radial-gradient(circle, rgba(255, 214, 130, 0.7), transparent 70%);
        }
.kyc-submitted .kyc-verified-chip {
            background: rgba(255, 214, 130, 0.4);
            color: #7a4a00;
        }
        .kyc-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(255, 182, 213, 0.22);
            color: #5b2440;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .kyc-verified-title {
            margin: 18px 0 10px;
            font-size: 24px;
            font-weight: 800;
            color: #5b2440;
        }

        .kyc-verified-text {
            margin: 0;
            color: rgba(91, 36, 64, 0.78);
            font-size: 14px;
            line-height: 1.7;
        }

        .kyc-verified-meta {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .kyc-verified-chip {
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(255, 182, 213, 0.22);
            color: #5b2440;
            font-size: 12px;
            font-weight: 700;
        }

        .kyc-verified-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 182, 213, 0.45);
        }

        .kyc-verified-icon svg {
            width: 24px;
            height: 24px;
            color: #b83b6d;
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
                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failedMsg') }}
                    </div>
                @endif
                @if ($data['kyc_status'] == '' || $data['kyc_status'] == null || $data['kyc_status'] == 'Unverified')
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('KYC Form') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('franchiseKyc') }}" enctype="multipart/form-data">
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
                                        <input type="file" class="form-control " name="pan_image" accept=".jpg,.jpeg,.png">
                                    </div>
                                    @error('pan_image')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label">Aadhar Front Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="front_image" accept=".jpg,.jpeg,.png">
                                    </div>
                                    @error('front_image')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label">Aadhar Back Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="back_image" accept=".jpg,.jpeg,.png">
                                    </div>
                                    @error('back_image')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 ">
                                    <label class="form-label">Cheque/Passbook Image</label>
                                    <div class="">
                                        <input type="file" class="form-control " name="cheque_image" accept=".jpg,.jpeg,.png">
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
                            <div class="kyc-verified-card kyc-submitted">
            <span class="kyc-verified-particles" aria-hidden="true"></span>
            <div class="d-flex align-items-center gap-2">
                <span class="kyc-verified-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 6v6l3 3"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>
                </span>
                <span class="kyc-verified-badge">KYC Submitted</span>
            </div>
            <h4 class="kyc-verified-title">KYC Has Been Submitted</h4>
            <p class="kyc-verified-text">Your KYC is submitted. Please wait for admin verification.</p>
            <div class="kyc-verified-meta">
                <span class="kyc-verified-chip">In Review</span>
                <span class="kyc-verified-chip">Pending Approval</span>
                <span class="kyc-verified-chip">We Will Notify You</span>
            </div>
        </div>
        
                @elseif ($data['kyc_status'] == 'Verified')
                            <div class="kyc-verified-card">
            <span class="kyc-verified-particles" aria-hidden="true"></span>
            <div class="d-flex align-items-center gap-2">
                <span class="kyc-verified-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>
                </span>
                <span class="kyc-verified-badge">KYC Verified</span>
            </div>
            <h4 class="kyc-verified-title">KYC Has Been Verified</h4>
            <p class="kyc-verified-text">Congratulations! Your KYC is approved and your franchise profile is fully active.</p>
            <div class="kyc-verified-meta">
                <span class="kyc-verified-chip">Secure</span>
                <span class="kyc-verified-chip">Verified Access</span>
                <span class="kyc-verified-chip">Full Features</span>
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









