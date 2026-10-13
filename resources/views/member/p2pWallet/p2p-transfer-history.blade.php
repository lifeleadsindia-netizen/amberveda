@extends('member.layouts.main')
@section('title', 'P2P Transfer History')
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
                                        style="text-decoration: none">P2P Transfer History</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">P2P Transfer History</h4>
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
                            <h4>{{ __('P2P Transfer History') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="basic-datatable" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Date</th>
                                            <th>Wallet Type</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <th>Particular</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($passdata as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}</td>
                                                <td>{{ $list['walletType'] }}</td>
                                                <td>₹ {{ $list['debit'] }}</td>
                                                <td>₹ {{ $list['credit'] }}</td>
                                                <td>₹ {{ $list['balance'] }}</td>
                                                <td>{{ $list['particular'] }}</td>
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
