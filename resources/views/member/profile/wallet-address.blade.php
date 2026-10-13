@extends('member.layouts.main')
@section('title', 'Wallet Address')
@section('container')

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
                                        style="text-decoration: none">Wallet Address</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Wallet Address</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-6">
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('successMsg') }}
                    </div>
                @endif
                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failedMsg') }}
                    </div>
                @endif
                @if ($data['kyc_status'] == 'Submitted')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title my-2">Wallet Address</h4>
                        </div>
                        <div class="card-body">
                            {{-- <p class="card-description">User Payment Receving Wallet Address</p> --}}
                            <form class="forms-sample">
                                @csrf
                                <div class="form-group ">
                                    <label for="exampleInputUsername2">Wallet Address</label>
                                    <div class="my-3">
                                        <input type="text" class="form-control" name="wallet"
                                            value="{{ $data['wallet_address'] }}">
                                    </div>
                                </div>
                            </form>
                            <p class="card-description text-danger">* Please contact to Admin, if you want to change Wallet Address</p>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title my-2">Wallet Address</h4>
                        </div>
                        <div class="card-body">
                            {{-- <p class="card-description">User Payment Receving Wallet Address</p> --}}
                            <form class="forms-sample" action="{{ route('insertWalletAddress') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 ">
                                    <label class="form-label">Wallet Address USDT Only</label>
                                    <div class="">
                                        <input type="text" class="form-control" name="wallet_address"
                                            placeholder="Enter Wallet Address USDT BEP 20 Only">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Transaction Password</label>
                                    <input type="password" class="form-control " placeholder="Enter Transaction Password"
                                        name="txn_password" id="txn_password">
                                    @error('txn_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" value="{{ $data['id'] }}" name="id">
                                <button class="btn btn-primary me-2 float-end" type="submit">Update Wallet
                                    Address</button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
