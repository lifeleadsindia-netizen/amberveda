@extends('member.layouts.main')
@section('title', 'Account Activation')
@section('container')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper py-3">
                    <div class="container">
                        <div class="row justify-content-left">
                            <div class="row justify-content-center mt-2">
                                <div class="col-xl-10">
                                    <div class="text-center mb-4 pb-2">
                                        <!--@if ($data['status'] == 'Temp')
    -->
                                        <!--   <h4 class="fw-semibold fs-4xl text-capitalize">Account Activation </h4>-->
                                    <!--@else-->
                                        <!--   <h4 class="fw-semibold fs-4xl text-capitalize">Product Repurchase </h4>-->
                                        <!--
    @endif-->
                                        <h4 class="fw-semibold fs-4xl text-capitalize">Account Activation </h4>
                                        <p class="text-muted mb-4 fs-base">Send Request After Do Payment.</p>
                                    </div>
                                    @if (session()->has('successMsg'))
                                        <div class="alert alert-primary" role="alert">{{ session('successMsg') }}</div>
                                    @endif
                                    @if (session()->has('failedMsg'))
                                        <div class="alert alert-danger" role="alert">{{ session('failedMsg') }}</div>
                                    @endif
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($data['status'] == 'Temp')
                                                <div class="row">
                                                    <div class="col-lg-6 text-center">
                                                        <img class="mb-2"
                                                            src="{{ asset('uploads') }}/{{ $addfundData->qrcode }}" width="250" />
                                                        <ul style="list-style: none">
                                                            <li><b>Bank Name</b> : {{ $addfundData->bank }}</li>
                                                            <li><b>Ifsc</b> : {{ $addfundData->ifsc }}</li>
                                                            <li><b>Account</b> : {{ $addfundData->account }}</li>
                                                            <li><b>UPI ID</b> : {{ $addfundData->upi }}</li>
                                                        </ul>
                                                    </div>


                                                    <div class="col-lg-6">
                                                        <form method="post" action="{{ route('FundReq') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label class="form-label">Product Name</label>
                                                                <input type="text" id="txtAmount"
                                                                    class="form-control mb-1" name="product"
                                                                    value="{{ $proData->product }}" readonly />
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Enter Amount</label>
                                                                <input type="text" id="txtAmount"
                                                                    class="form-control mb-1" name="amount"
                                                                    value="5000" />
                                                                @error('amount')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Enter Transaction Number</label>
                                                                <input type="text" id="txtHash"
                                                                    class="form-control mb-1" name="txnid"
                                                                    placeholder="Enter Transaction id" />
                                                                @error('txnid')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label class="form-label" for="customFile">Upload Slip
                                                                    Screenshot</label>
                                                                <input class="form-control" name="FileUpload1"
                                                                    id="FileUpload1" type="file" />
                                                                @error('FileUpload1')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                                <div id="frames" class="mt-2"></div>
                                                            </div>
                                                            <div class="form-group mt-5 text-end">
                                                                <input type="hidden" name="memberid"
                                                                    value="{{ $data['memberid'] }}">
                                                                <button type="submit" id="bbtn1"
                                                                    class="btn btn-info">Send
                                                                    Request</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-lg-12 text-center">
                                                        <h4 class="fw-semibold fs-4xl text-capitalize">Account is already
                                                            activated </h4>
                                                        <img class="mb-2"
                                                            src="{{ asset('logo/account_activate.png') }}" />
                                                    </div>
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>


@endsection
