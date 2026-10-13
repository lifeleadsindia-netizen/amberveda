@extends('member.layouts.main')
@section('title', 'Create Request')
@section('container')


    <!--**********************************
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Content body start
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ***********************************-->

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <h4 class="fw-bold py-3">
                <span class="text-muted fw-light">{{ config('detailsApp.name') }} /</span> Create Request
            </h4>
            <!-- row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body p-md-8">
                            <h4 class="mb-2">Create Request</h4>
                            <p class="mb-8">Send order details after successfull order placement.</p>
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
                                <div class="">
                                    <form action="{{ route('linkordrDetails') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12 mt-3 ">
                                            <label class="form-label" for="req_amount">Plateform</label>
                                            <select name="ecommers" class="form-control" id="ecommers">
                                                <option value="">Select Plateform</option>
                                                <option value="Flipkart">Flipkart</option>
                                                <option value="Amazon">Amazon</option>
                                            </select>
                                            @error('ecommers')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-3 ">
                                            <label class="form-label" for="req_amount">Product</label>
                                            <select name="product" class="form-control" id="product">
                                                <option value="">Select Product</option>
                                                {{-- Options will be populated dynamically --}}
                                            </select>
                                            @error('product')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label" for="req_amount">Order Amount</label>
                                            <input type="text" id="req_amount" name="amount" class="form-control "
                                                placeholder="Please Enter Amount" />
                                            @error('amount')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="form-label" for="billings-card-name1">Order Id</label>
                                            <input type="text" id="billings-card-name1" class="form-control"
                                                placeholder="Enter orderid" name="order_id" />
                                            @error('order_id')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="form-label" for="billings-card-date1">Order Screenshot</label>
                                            <input type="file" id="billings-card-date1" class="form-control "
                                                name="image" />
                                            @error('image')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="d-grid mt-3">
                                            <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                            <input type="hidden" name="memberid" value="{{ $data['memberid'] }}">
                                            <button class="btn btn-success">
                                                <span class="me-2">Proceed with Details</span>
                                                <i class="ti ti-arrow-right scaleX-n1-rtl"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="" id="INR-form" style="display: none">
                                    <form action="{{ route('INRFundReq') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-6">
                                            <div class="col-12 mt-3">
                                                <label class="form-label" for="req_amount">Request USDT Amount</label>
                                                <input type="text" id="usdt_amount" name="amount" class="form-control "
                                                    placeholder="Please Enter Amount $" />
                                                @error('amount')
                                                <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div style="display: none" id="inr-input">
                                                <div class="col-12 mt-3">
                                                    <label class="form-label" for="inr_amount">Required Amount (INR)</label>
                                                    <input type="text" id="inr_amount" name="inr_amount"
                                                        class="form-control " placeholder="Please Enter Amount ₹" />
                                                    @error('amount')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
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
                                                <input type="hidden" name="memberid" value="{{ $data['memberid'] }}">
                                                <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                                <input type="hidden" id="rate" value="{{ $rate['rate'] }}">
                                                <button class="btn btn-success">
                                                    <span class="me-2">Proceed with Details</span>
                                                    <i class="ti ti-arrow-right scaleX-n1-rtl"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}
                            </div>
                            <p class="mt-2">By continuing, you accept to our Terms of Services and Privacy
                                Policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
