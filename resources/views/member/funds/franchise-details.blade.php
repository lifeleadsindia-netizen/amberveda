@extends('member.layouts.main')
@section('title', 'Franchise Details')
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
                                        style="text-decoration: none">franchise Details</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Franchise Details</h4>
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
                            <h4>{{ __('Franchise Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="basic-datatable" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Mobile no.</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Pin code</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                                <td>{{ $list['name'] }}</td>
                                                <td>{{ $list['mobile'] }}</td>
                                                <td>{{ $list['address'] }}</td>
                                                <td>{{ $list['city'] }}</td>
                                                <td>{{ $list['state'] }}</td>
                                                <td>{{ $list['pin_code'] }}</td>
                                                <td>{{ $list['country'] }}</td>
                                                <td>
                                                    @if ($list['status'] == 'Active')
                                                        <span class="btn btn-sm btn-success">{{ $list['status'] }}</span>
                                                    @elseif ($list['status'] == 'Temp')
                                                        <span class="btn btn-sm btn-danger">{{ $list['status'] }}</span>
                                                    @else
                                                        <span class="btn btn-sm btn-primary">{{ $list['status'] }}</span>
                                                    @endif
                                                </td>
                                                <td><a href="{{url('member/deposit/fund-requests')}}"><button class="btn btn-sm btn-primary">Request</button></a></td>
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
