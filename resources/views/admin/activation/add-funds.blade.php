@extends('admin.layouts.main') 
@section('title', 'Add Funds')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Funds')}}</h5>
                            <span>{{ __('Add Funds ')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add Funds')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    
    
        <div class="row">
            <div class="col-md-6">
                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger" role="alert">
                        {{session('failedMsg')}}
                    </div>
                @endif
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        {{session('successMsg')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header"><h3>{{ __('Add Member Funds')}}</h3></div>
                    <div class="card-body px-5">
                        <form action="{{route('addMemFunds')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Memberid </label>
                                <input type="text" class="form-control" id="memberid" name="memberid" placeholder="Enter Memberid">
                                <span id="memMsg"></span>
                                @error('memberid')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Wallet Type</label>
                                <select class="form-control" name="wallet_type">
                                    <option value="">Select Wallet Type</option>
                                    <option value="p2p_wallet">P2P Wallet</option>
                                    <option value="wallet"> Wallet</option>
                                </select>
                                @error('wallet_type')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Amount </label>
                                <input type="text" class="form-control" name="amount" placeholder="Enter ₹ amount to add">
                                @error('amount')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <input type="hidden" id="csrf" value="{{csrf_token()}}">
                                <button class="btn btn-primary float-right">Add Fund</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @endpush
    <script>
        $(document).ready(function(){
               //fund transfer memberid check
           $('#memberid').on('input', function () {
                var memberid = $(this).val();
                var csrf = $('#csrf').val();
               
                $.ajax({
                    url: '/getMember',
                    type: 'POST',
                    data: {
                        'memberid': memberid,
                        _token:csrf,
                    },
                    success: function (response) {
                        $('#memMsg').html(response['data']);
                        
                    }
                });
            });
        });  
    </script>  
@endsection