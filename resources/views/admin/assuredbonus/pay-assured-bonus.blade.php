@extends('admin.layouts.main')
@section('title', 'Pay Assured Bonus')
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
                            <h5>{{ __('Pay Assured Bonus') }}</h5>
                            <span>{{ __('All Pay Assured Bonus') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Pay Assured Bonus') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
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
                    <div class="card-header">
                        <h3>{{ __('Pay Assured Bonus') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paidAssuredBonus') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Amount </label>
                                <input type="text" class="form-control" name="amount" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                    placeholder="Enter ₹ amount to add">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                <button class="btn btn-primary">Pay</button>
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
        <script src="{{ asset('adm_assets/assets/js/form-components.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script>
            $(document).ready(function() {
                //fund transfer memberid check
                $('#memberid').on('input', function() {
                    var memberid = $(this).val();
                    var csrf = $('#csrf').val();
                    $.ajax({
                        url: '/getMember',
                        type: 'POST',
                        data: {
                            'memberid': memberid,
                            _token: csrf,
                        },
                        success: function(response) {
                            $('#memMsg').html(response['data']);

                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
