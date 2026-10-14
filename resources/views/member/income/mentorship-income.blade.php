@extends('member.layouts.main')
@section('title', 'Mentorship Income')
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
                                    style="text-decoration: none">Mentorship Income</a></li>
                        </ol>
                    </nav>

                </div>
                <h4 class="page-title">Mentorship Income</h4>
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
                        <h4>{{ __('Mentorship Income Details') }}</h4>
                    </div>
                    <div class="card-body px-3">
                        <div class="responsive" style="overflow: auto">
                            <table id="example" class="table  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Member ID') }}</th>
                                        <th>{{ __('Generation / Level') }}</th>
                                        <th>{{ __('Matching Biz') }}</th>
                                        <th>{{ __('Rate (%)') }}</th>
                                        <th>{{ __('Income Amount') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($mdata as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ !empty($list['created_at']) ? date('d-m-Y h:i A', strtotime($list['created_at'])) : 'N/A' }}</td>
                                        <td>{{ $list['memberid'] }}</td>
                                        <td>{{ $list['level'] }}</td>
                                        <td>₹{{ number_format((float)($list['daily_team_biz'] ?? 0), 2) }}</td>
                                        <td>{{ $list['rate'] }}%</td>
                                        <td>₹{{ number_format((float)($list['amount'] ?? 0), 2) }}</td>
                                        <td>
                                            @if ($list['status'] == 'Unpaid')
                                            <span class="badge badge-danger">{{ $list['status'] }}</span>
                                            @elseif ($list['status'] == 'Paid')
                                            <span class="badge badge-success">{{ $list['status'] }}</span>
                                            @else
                                            <span class="badge badge-warning">{{ $list['status'] }}</span>
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