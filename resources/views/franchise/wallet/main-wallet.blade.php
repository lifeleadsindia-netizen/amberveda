@extends('franchise.layouts.main')
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
                            <span class="badge bg-primary px-2 py-1">{{ config('detailsApp.name') }} Franchise Wallet</span>
                            <div class="d-flex justify-content-center">
                                <sub class="h5 pricing-currency mb-auto mt-1 text-primary">₹</sub>
                                <h2 class="mb-0 text-primary">{{ $data['wallet'] }}</h2>
                                <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">balance</sub>
                            </div>
                        </div>
                        <form class="browser-default-validation mt-4" action="{{ route('mainWithdrawal') }}" method="post"
                            id="withForm">
                            @csrf
                            <div class="mb-3" id="inr_input">
                                <label class="form-label" for="inr_amount">INR Amount</label>
                                <input type="text" id="inr_amount" class="form-control flatpickr-validation"
                                    name="inr_amount" placeholder="Enter Amount ₹" min="1" />
                                @error('inr_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-upload-file">Password</label>
                                <input type="password" class="form-control" placeholder="Enter Password"
                                    name="password" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-grid w-100 mt-6">
                                        <input type="hidden" name="franchise_id" value="{{ $data['franchise_id'] }}">
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

            </div>
        </div>
    </div>
    </div>

@endsection
