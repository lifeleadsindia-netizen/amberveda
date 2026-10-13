@extends('member.layouts.main')
@section('title', 'Request History')
@section('container')
    <!-- Content wrapper -->
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
                                        style="text-decoration: none">Request History</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Request History</h4>
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
                    <div class="card" style="zoom:90%">
                        <div class="card-header">
                            <h4>{{ __('Request History') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="example" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Date</th>
                                            <th>Memberid</th>
                                            <!--<th>Amount INR</th>-->
                                            <th>Amount</th>
                                            <!--<th>Rate</th>-->
                                            <!--<th>Type</th>-->
                                            <th>Txn Id</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($imdata as $list)
                                            @php
                                                $mdata = getAllData($list['memberid']);
                                            @endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}</td>
                                                <td>{{ $list['memberid'] }}</td>
                                                <!--<td class="text-center">-->
                                                <!--    @if($list['type'] == 'INR')-->
                                                <!--        ₹{{ $list['inr_amount']}}-->
                                                <!--    @else-->
                                                <!--        00-->
                                                <!--    @endif-->
                                                <!--</td>-->
                                                <td>₹ {{number_format($list['amount'], 2) }}</td>
                                                <!--<td>{{ $list['rate'] }}</td>-->
                                                <!--<td>{{ $list['type'] }}</td>-->
                                                <td>{{ $list['tran_id'] }}</td>
                                                <td>
                                                    @if ($list['status'] == 'Accepted')
                                                        <span class="btn btn-sm btn-success">{{ $list['status'] }}</span>
                                                    @elseif ($list['status'] == 'Cancelled')
                                                        <span class="btn btn-sm btn-danger">{{ $list['status'] }}</span>
                                                    @else
                                                        <span class="btn btn-sm btn-primary">{{ $list['status'] }}</span>
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