@extends('franchise.layouts.main')
@section('title', 'Withdrawal History')
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
                                        style="text-decoration: none">Withdrawal History</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Withdrawal History</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="col-md-12">
                    @if (session()->has('wMessage'))
                        <div class="alert alert-primary">{{ session('wMessage') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Withdrawal History Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="basic-datatable" class="table  nowrap w-100">
                                    <thead >
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Date</th>
                                            <th>RequestId</th>
                                            <th>Name</th>
                                            <th>Gross Amount</th>
                                            <th>TDS</th>
                                            <th>Net Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($reqdata as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}</td>
                                                <td>{{ $list['request_id'] }}</td>
                                                <td>{{ $list['name'] }}</td>
                                                <td>₹ {{ $list['gross_amount'] }}</td>
                                                <td>₹ {{ $list['service_charge'] }}</td>
                                                <td>₹ {{ $list['net_amount'] }}</td>
                                                <td>{{ $list['type'] }}</td>
                                                <td>
                                                    @if ($list['status'] == 'Approved')
                                                        <div class="btn btn-sm btn-success">{{ __($list['status']) }}</div>
                                                    @elseif ($list['status'] == 'Cancelled')
                                                        <div class="btn btn-sm btn-danger">{{ __($list['status']) }}</div>
                                                    @else
                                                        <div class="btn btn-sm btn-blue ">{{ __($list['status']) }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($list['status'] == 'PENDING')
                                                        <a class="btn btn-sm btn-primary mx-0 disabled">Details</a>
                                                    @else
                                                        <a href="{{url('franchise_panel/view-detail')}}/{{$list['id']}}" class="btn btn-sm btn-primary mx-0">Details</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->

    </div>
    <!-- content -->


@endsection
