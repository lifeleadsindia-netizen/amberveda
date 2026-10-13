@extends('member.layouts.main')
@section('title', 'Club Income')
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
                                        style="text-decoration: none">Club Income</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Club Income</h4>
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
                            <h4>{{ __('Club Income Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="example" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>{{ __('S.No') }}</th>
                                            <th>{{ __('Member ID') }}</th>
                                            <th>{{ __('Club Rank') }}</th>
                                            <!--<th>{{ __('Monthly CTO') }}</th>-->
                                            <th>{{ __('Total Amount') }}</th>
                                            <!--<th>{{ __('Left') }}</th>-->
                                            <!--<th>{{ __('Right') }}</th>-->
                                            <th>{{ __('Members') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($clubData as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $list['memberid'] }}</td>
                                                <td>{{ $list['club_rank'] ?? '-' }}</td>
                                                <!--<td>₹ {{ number_format((float) $list['monthly_cto'], 2) }}</td>-->
                                                <!--<td>{{ $list['left'] ?? '-' }}</td>-->
                                                <!--<td>{{ $list['right'] ?? '-' }}</td>-->
                                                <td>
                                                    {{ isset($list['total_amount']) ? '₹ ' . number_format((float) $list['total_amount'], 2) : '-' }}
                                                </td>
                                                <td>{{ $list['members'] ?? '-' }}</td>
                                                <td>₹ {{ number_format((float) $list['amount'], 2) }}</td>
                                                <td>
                                                    @if ($list['status'] == 'Paid')
                                                        <div class="btn btn-sm btn-success">{{ $list['status'] }}</div>
                                                    @else
                                                        <div class="btn btn-sm btn-danger ">{{ $list['status'] }}</div>
                                                    @endif
                                                </td>
                                            </tr>
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
