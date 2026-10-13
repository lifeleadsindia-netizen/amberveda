@extends('member.layouts.main')
@section('title', 'Order Details')
@section('container')

    <!-- Datatables css -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        td {
            text-align: center;
        }
    </style>
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
                                        style="text-decoration: none">Order Details</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @if ($cdata['status'] == 'Dispatched')
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body" style="background: #eb2240; color:white">
                            <h4 class="header-title mb-3">Dispatch Order Info</h4>
                            <div class="mx-4">
                                <i class="mdi mdi-truck-fast h2 text-white"></i>
                                <h5><b>Courier Name :</b> {{ $cdata['courier_name'] }}</h5>
                                <p class="mb-1"><b>Tracking ID :</b> {{ $cdata['tracking_id'] }}</p>
                                <p class="mb-0"><b>Date : </b> {{ date('Y-m-d', strtotime($cdata['dispatch_date'])) }}</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            @elseif ($cdata['status'] == 'Completed')
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body" style="background: #eb2240; color:white">
                            <h4 class="header-title mb-3">Completed Order Info</h4>
                            <div class="mx-4">
                                <i class="mdi mdi-truck-fast h2 text-white"></i>
                                {{-- <h5><b>Courier Name :</b> {{ $cdata['courier_name'] }}</h5> --}}
                                <p class="mb-1"><b>Your Order is Booked. Order will be Dispatched Soon.</b></p>
                                {{-- <p class="mb-0"><b>Date : </b> {{ date('Y-m-d', strtotime($cdata['dispatch_date'])) }}</p> --}}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            @endif
        </div>
        <!-- end row -->

    </div>
    <!-- container -->

    </div>

@endsection
