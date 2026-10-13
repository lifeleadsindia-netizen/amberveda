@extends('member.layouts.main')
@section('title', 'Fund Request')
@section('container')


    <!--**************                                                                                                                                                                                                                ******
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <h4 class="fw-bold py-3">
                <span class="text-muted fw-light">{{ config('detailsApp.name') }} /</span> Fund Request
            </h4>
            <!-- row -->
            <div class="card px-3">
                <div class="row">
                    <div class="col-lg-6 card-body border-end p-md-8">
                        <h4 class="mb-2">Deposit Details</h4>
                        <p id="Usdt-text" class="mb-0">Deposit only INR only else your payment may lost.
                        </p>
                        <div class="row g-6">
                            <div class="col-md-12" id="Inr-box">
                                <div class="text-center">
                                    @if ($inr_data)
                                        <img src="{{ asset('uploads') }}/{{ $inr_data->qrcode }}"
                                            style="max-width:80%; max-height:350px " class="my-4">
                                        <h5><b>Bank</b> : {{ $inr_data->bank }}</h5>
                                        <h5><b>IFSC</b> : {{ $inr_data->ifsc }}</h5>
                                        <h5><b>Account</b> : {{ $inr_data->account }}</h5>
                                        <h5><b>UPI</b> : {{ $inr_data->upi }}</h5>
                                    @else
                                        <p style="height:500px; display:flex; justify-content:center; align-items:center;"
                                            class="text-warning mb-0">No payment details available. Please
                                            contact support.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 card-body p-md-8">
                        <h4 class="mb-2">Fund Request</h4>
                        <p class="mb-8">Send payment details after successfull payment.</p>
                        <div class="bg-lighter p-6 rounded">
                            <div class="d-flex align-items-center mb-4">
                                <h1 class="text-heading mb-0" id="fund">₹ 0</h1>
                                <sub class="h6 text-body mb-n3">/request</sub>
                            </div>
                            <div class="d-grid">
                                <button type="button" data-bs-target="#pricingModal" data-bs-toggle="modal"
                                    class="btn btn-primary">Request Amount</button>
                            </div>
                        </div>
                        @if (session()->has('successMsg'))
                            <div class="alert alert-success mt-3" role="alert">
                                <strong>Congratulations! </strong> {{ session('successMsg') }}
                            </div>
                        @endif
                        @if (session()->has('failedMsg'))
                            <div class="alert alert-danger mt-3" role="alert">
                                {{ session('failedMsg') }}
                            </div>
                        @endif
                        <div class="mt-3">
                            <form action="{{ route('FundReq') }}" method="post" enctype="multipart/form-data"
                                id="formSub">
                                @csrf
                                <div class="row g-6">
                                    <div class="col-12 mt-3">
                                        <label class="form-label" for="req_amount">Request INR Amount</label>
                                        <input type="number" id="req_amount" name="amount" class="form-control "
                                            placeholder="Please Enter Amount ₹" />
                                        @error('amount')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label" for="billings-card-name">Txn Id</label>
                                        <input type="text" id="billings-card-name" class="form-control"
                                            placeholder="Enter TxnId" name="txnid" />
                                        @error('txnid')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label" for="billings-card-date">Txn Screenshot</label>
                                        <input type="file" id="billings-card-date" class="form-control "
                                            name="image" />
                                        @error('image')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-grid mt-3">
                                        <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                        <button class="btn btn-success" id="subBtn">
                                            <span class="me-2">Proceed with Payment</span>
                                            <i class="ti ti-arrow-right scaleX-n1-rtl"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p class="mt-2">By continuing, you accept to our Terms of Services and Privacy
                            Policy. Please note that payments are non-refundable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
