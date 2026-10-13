@extends('franchise.layouts.main')
@section('title', 'Withdrawal Detail')
@section('container')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3">
                <span class="text-muted fw-light">{{ config('detailsApp.name') }} /</span> withdrawal Detail

            </h4>
            <div class="row">
                <div class="col-md-6 ">

                    <div class="card">
                        @if ($data['status'] == 'Cancelled')
                            <div class="card-body bg-warning">
                                <h4 class="card-title" style="color:rgb(101, 46, 76)">Rejected Reason</h4>
                                <p class="card-description text-dark">{{ $data['reason'] }} </p>

                            </div>
                        @else
                             <div class="col-md-12" id="Inr-box">
                                <div class="text-center mb-4">
                                    
                                    <img src="{{ asset('uploads') }}/{{ $data['image'] }}"
                                        style="max-width:80%; max-height:300px " class="my-4">
                                    <h3 class="card-title" style="margin-top: 20px;color:green">Approved</h3>    
                                    <h5><b>UTR</b> : {{  $data['utr'] }}</h5>
                                    <h5"><b>Other Detail</b> : {{ $data['other_detail'] }}</h5>
                                    
                                </div>
                            </div>
                            
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
