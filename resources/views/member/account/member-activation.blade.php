@extends('member.layouts.main')
@section('title', 'Member Activation')
@section('container')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">{{ config('detailsApp.name') }} /</span> Member Activation

            </h4>
            <div class="row">
                <div class="col-md-6 ">
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
                    <div class="card">
                        <div class="card" id="actBox">
                            <div class="card-body">
                                <h4 class="card-title">Member Activation</h4>
                                <p class="card-description">Member Activation Form Layout </p>
                                <form action="{{ route('memberActivate') }}" method="post" id="formSub">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1">Memberid</label>
                                        <input type="text" class="form-control" id="memberid" name="memberid"
                                            placeholder="Enter Memberid">
                                        <span id="sponhtml1"></span>
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
                                                <input type="text" class="form-control" value="{{ $data['p2p_wallet'] }}"
                                                    name="p2p_wallet" id="wallet" readonly>
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
                                        <button type="submit" class="btn btn-primary me-2 float-end " id="subBtn">Member
                                            Activation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script>
            // current logged-in member id (used to prevent self-activation)
            const currentMemberId = '{{ $data['memberid'] ?? '' }}';

            $(function() {
                // Debounced member lookup and form validation
                let memberTimer = null;
                let memberFound = false;

                function clearMemberHtml() {
                    $('#sponhtml1').html('');
                    memberFound = false;
                }

                $('#memberid').on('input', function() {
                    const member = $(this).val().trim();
                    clearTimeout(memberTimer);
                    if (!member) {
                        clearMemberHtml();
                        return;
                    }
                    // Prevent using own id for activation
                    if (currentMemberId && member.toUpperCase() === String(currentMemberId).toUpperCase()) {
                        clearTimeout(memberTimer);
                        $('#sponhtml1').html('<span class="text-danger">You cannot use your own Member ID for activation</span>');
                        memberFound = false;
                        return;
                    }
                    memberTimer = setTimeout(function() {
                        $.post('/getMember', {
                                memberid: member,
                                _token: '{{ csrf_token() }}'
                            })
                            .done(function(response) {
                                $('#sponhtml1').html(response.data || '');
                                memberFound = response.code && response.code === 1;
                            })
                            .fail(function() {
                                $('#sponhtml1').html('<span class="text-danger">Lookup failed</span>');
                                memberFound = false;
                            });
                    }, 350);
                });

                // Validate before submit: ensure member exists
                $('#formSub').on('submit', function(e) {
                    const memberVal = $('#memberid').val().trim();
                    if (!memberVal) {
                        e.preventDefault();
                        $('#sponhtml1').html('<span class="text-danger">Please enter Member ID</span>');
                        return false;
                    }
                    // Prevent using own id for activation
                    if (currentMemberId && memberVal.toUpperCase() === String(currentMemberId).toUpperCase()) {
                        e.preventDefault();
                        $('#sponhtml1').html('<span class="text-danger">You cannot use your own Member ID for activation</span>');
                        return false;
                    }
                    if (!memberFound) {
                        // Prevent submit and trigger immediate lookup to give feedback
                        e.preventDefault();
                        $.post('/getMember', {
                                memberid: memberVal,
                                _token: '{{ csrf_token() }}'
                            })
                            .done(function(response) {
                                $('#sponhtml1').html(response.data || '');
                                memberFound = response.code && response.code === 1;
                                if (memberFound) {
                                    // submit form programmatically once valid
                                    $('#formSub')[0].submit();
                                }
                            })
                            .fail(function() {
                                $('#sponhtml1').html('<span class="text-danger">Lookup failed</span>');
                            });
                        return false;
                    }
                    // allow submit when memberFound is true
                });
            });
        </script>
    @endsection
