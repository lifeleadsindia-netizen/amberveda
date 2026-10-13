@extends('member.layouts.main')
@section('title', 'Account Activation')
@section('container')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3">
                <span class="text-muted fw-light">{{ config('detailsApp.name') }} /</span> Account Activation

            </h4>
            <div class="row">
                <div class="col-md-6 ">
                    @if (session()->has('failedMsg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failedMsg') }}
                        </div>
                    @endif
                    @if (session()->has('successMsg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('successMsg') }}
                        </div>
                    @endif
                    <div class="card">
                        @if ($data['status'] == 'Active' || $data['status'] == 'Deactive')
                            <div class="card-body bg-success">
                                <h4 class="card-title text-dark">Account Activation Approved</h4>
                                <p class="card-description text-dark">Your account is activated. Please go to Upgrade
                                    section to activate other Packages</p>
                            </div>
                        @else
                            <div class="card" id="actBox">
                                <div class="card-body">
                                    <h4 class="card-title">Account Activation</h4>
                                    <p class="card-description">Account Activation Form Layout </p>
                                    <form action="{{ route('activateUser') }}" method="post" id="formSub">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Memberid</label>
                                            <input type="text" class="form-control bg-light" id="memberid"
                                                name="memberid" value="{{ $data['memberid'] }}" readonly>
                                            @error('memberid')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div id="usdt">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1">Amount</label>
                                                    {{-- <input type="text" class="form-control" name="amount" id="amount"
                                                    placeholder="Enter PV "> --}}
                                                    <select class="form-control" name="amount" id="amount">
                                                        <option value="">--Select Amount--</option>
                                                        <option value="1000">₹ 1000</option>
                                                        <option value="2500">₹ 2500</option>
                                                        <option value="5000">₹ 5000</option>
                                                    </select>
                                                    <span class="text-danger" id="amountHtml"></span>
                                                    @error('amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1">P2P Wallet</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data['p2p_wallet'] }}" name="p2p_wallet" id="wallet" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1">Transaction Password</label>
                                                <input type="password" class="form-control "
                                                    placeholder="Enter Transaction Password" name="txn_password"
                                                    id="txn_password">
                                                @error('txn_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary me-2 float-end "
                                                id="subBtn">Account Activation</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
