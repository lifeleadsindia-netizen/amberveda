@extends('member.layouts.main')
@section('title', 'Main Wallet')
@section('container')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">Main Wallet</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Main Wallet</h4>
                </div>
            </div>
        </div>
        <div class="row g-6">

            <!-- Browser Default -->
            <div class="col-md-6 mb-md-0">
                @if (session()->has('successMsg'))
                    <div class="alert bg-success text-white" role="alert">
                        {{ session('successMsg') }}
                    </div>
                @endif
                @if (session()->has('failedMsg'))
                    <div class="alert bg-danger text-white" role="alert">
                        {{ session('failedMsg') }}
                    </div>
                @endif

                <div class="card mb-6 border border-2 border-primary rounded primary-shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="badge bg-primary px-2 py-1">{{ config('detailsApp.name') }} Wallet</span>
                            <div class="d-flex justify-content-center">
                                <sub class="h5 pricing-currency mb-auto mt-1 text-primary">₹</sub>
                                <h2 class="mb-0 text-primary">{{ $data['wallet'] }}</h2>
                                <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">balance</sub>
                            </div>
                        </div>
                        <ul class="list-unstyled g-2 my-6">
                            <li class="mb-2 d-flex align-items-center"><i
                                    class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span
                                    style="margin-right: 10px">Total
                                    Income</span> - <span style="margin-left: 10px">₹
                                    {{ totalIncome($data['memberid']) }}</span>
                            </li>
                            <li class="mb-2 d-flex align-items-center"><i
                                    class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span
                                    style="margin-right: 10px">Total
                                    Withdrawal</span> - <span style="margin-left: 10px">₹
                                    {{ totalWithdrawals($data['memberid']) }}</span>
                            </li>
                        </ul>
                        <form class="browser-default-validation mt-4" action="{{ route('initWithdrawal') }}" method="post"
                            id="withForm">
                            @csrf
                            {{-- <div class="mb-3">
                                <label class="form-label" for="type">Type</label>
                                <input class="form-control flatpickr-validation" name="type" id="with_type" value="INR" readonly/>
                                    <option value="">Select Type</option>
                                    <option value="USDT">USDT</option>
                                    <option value="INR">INR</option>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="mb-3" id="inr_input">
                                <label class="form-label" for="inr_amount">INR Amount</label>
                                <input type="text" id="inr_amount" class="form-control flatpickr-validation"
                                    name="inr_amount" placeholder="Enter Amount ₹" min="1" />
                                @error('inr_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>
                            
                            {{-- <div class="mb-3" id="inr_input" style="display: none">
                                <label class="form-label" for="inr_amount">INR Amount</label>
                                <input type="text" id="inr_amount" class="form-control flatpickr-validation"
                                    name="inr_amount" readonly />
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label class="form-label" for="req_amount">USDT Amount</label>
                                <input type="text" id="with_amount" class="form-control flatpickr-validation"
                                    name="amount" placeholder="Enter USDT Amount" min="1"
                                     />
                                <span class="text-danger" id="usdtAmounthtml"></span>
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-upload-file">Transaction
                                    Password</label>
                                <input type="password" class="form-control" placeholder="Enter Transaction Password"
                                    name="txn_password" />
                                @error('txn_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-grid w-100 mt-6">
                                        <input type="hidden" name="memberid" value="{{ $data['memberid'] }}">
                                        <input type="hidden" id="wallet" value="{{ $data['wallet'] }}">
                                        <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                        {{-- <input type="hidden" id="rate" value="{{ $rate['rate'] }}"> --}}
                                        <button class="btn btn-primary" id="withdrawBtn">Withdrawal Amount</button>
                                    </div>
                                    <span id="wMesg" class="text-danger text-center"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- @else
                        <div class="card mb-6 border border-2 border-secondary rounded secondary-shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="badge bg-label-secondary">{{ config('detailsApp.name') }} Wallet</span>
                                    <div class="d-flex justify-content-center">
                                        <sub class="h5 pricing-currency mb-auto mt-1 text-secondary">$</sub>
                                        <h2 class="mb-0 text-secondary">{{ $data['wallet'] }}</h2>
                                        <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">balance</sub>
                                    </div>
                                </div>
                                <ul class="list-unstyled g-2 my-6">
                                    <li class="mb-2 d-flex align-items-center"><i
                                            class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span
                                            style="margin-right: 10px">Total
                                            Income</span> - <span
                                            style="margin-left: 10px">{{ totalIncome($data['memberid']) }}</span>
                                    </li>
                                    <li class="mb-2 d-flex align-items-center"><i
                                            class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span
                                            style="margin-right: 10px">Total
                                            Withdrawal</span> - <span
                                            style="margin-left: 10px">{{ totalWithdrawals($data['memberid']) }}</span></li>
                                </ul>


                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="h6 mb-0 text-danger">Withdrawal Pending</span>
                                    <span class="h6 mb-0 text-danger">{{ $left_days }} of 30 Days</span>
                                </div>
                                <div class="progress mb-1 bg-label-danger" style="height: 6px;">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width:{{ $ratio }}%;" aria-valuenow="65" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <small class="text-danger">{{ $left_days }} days remaining</small>



                                <form class="browser-default-validation mt-5">
                                    <div class="mb-6">
                                        <label class="form-label" for="basic-default-dob">Amount</label>
                                        <input type="text" class="form-control flatpickr-validation" name="amount"
                                            placeholder="Enter Amount" id="withAmount" min="1" />
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="basic-default-upload-file">Transaction
                                            Password</label>
                                        <input type="password" class="form-control"
                                            placeholder="Enter Transaction Password" name="txn_password" />
                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="d-grid w-100 mt-6">
                                                <a class="btn btn-secondary text-white" disabled>Withdrawal Amount Off</a>
                                            </div>

                                        </div> 
                                </form>
                            </div>
                        </div>
                    @endif --}}

            </div>
        </div>
    </div>
    </div>

@endsection
