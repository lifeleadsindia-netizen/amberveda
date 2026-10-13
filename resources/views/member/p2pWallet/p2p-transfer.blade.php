@extends('member.layouts.main')
@section('title', 'P2P Transfer')
@section('container')

    <!-- Content wrapper -->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">P2P Transfer</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">{{ config('detailsApp.name') }} / P2P Transfer</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if (session()->has('successMsg'))
                    <div class="alert bg-success text-white" role="alert">
                        <strong>Congratulations! </strong> {{ session('successMsg') }}
                    </div>
                @endif
                @if (session()->has('failedMsg'))
                    <div class="alert bg-danger text-white" role="alert">
                        <strong>Watchout! </strong> {{ session('failedMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-end">
                                <h4>{{ __('P2P Transfer Form') }}</h4>
                                <!--<div class="d-flex justify-content-center">-->
                                <!--    <sub class="h5 pricing-currency mb-auto mt-1 text-primary">₹</sub>-->
                                <!--    <h2 class="mb-0 text-primary" id="fund_type">0</h2>-->
                                <!--    <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">balance</sub>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <form action="{{ route('transBvWalletToP2P') }}" method="post" id="subForm">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-12">
                                        <label class="form-label">Wallet</label>
                                        <input type="text" class="form-control" id="p2p_wallet" name="bv_wallet"
                                         value="{{ $data['p2p_wallet'] }}" readonly>
                                        @error('bv_wallet')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            placeholder="Enter Amount" required>
                                        <small id="amountText" class="text-danger"></small>
                                        @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">MemberId</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="memberid"
                                                placeholder="Enter Memberid" id="fundmemberid" maxlength="9"
                                                minlength="9">
                                        </div>
                                        <small id="memMsg" class="text-danger"></small>
                                        @error('memberid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">Transaction Password</label>
                                        <input type="password" class="form-control" name="txn_password"
                                            placeholder="Enter Txn Password" required>
                                        @error('txn_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="balance" id="balance" value="{{ $data['wallet'] }}">
                                        <input type="hidden" name="sender" value="{{ $data['memberid'] }}">
                                        {{-- <input type="hidden" name="url" id="url" value="{{route('getMember')}}"> --}}
                                        <input type="hidden" name="csrf" id="csrf" value="{{ csrf_token() }}">
                                        <button class="btn btn-primary btn-block mt-3 float-end formBtn"
                                            id="transBtn">Transfer Amount</button>
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
