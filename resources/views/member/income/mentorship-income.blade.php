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
                                            <th>{{ __('Matching') }}</th>
                                            <th>{{ __('Rate (%)') }}</th>
                                            <th>{{ __('Share') }}</th>
                                            <th>{{ __('Total Members') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Downline') }}</th>
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
                                                <td>{{ !empty($list['created_at']) ? date('d-m-Y', strtotime($list['created_at'])) : 'N/A' }}@if (!empty($list['created_at']))<br>{{ date('h:i A', strtotime($list['created_at'])) }}@endif
                                                </td>
                                                <td>{{ $list['memberid'] }}</td>
                                                <td class="text-center">{{ $list['level'] }}</td>
                                                <td>₹{{ number_format((float) ($list['total_matching'] ?? 0), 2) }}</td>
                                                <td>{{ $list['rate'] }}%</td>
                                                <td>₹{{ number_format((float) ($list['share'] ?? 0), 2) }}</td>
                                                <td class="text-center">{{ $list['total_members'] }}</td>
                                                <td>₹{{ number_format((float) ($list['amount'] ?? 0), 2) }}</td>
                                                <td class="text-center">{{ $list['downline'] }}</td>
                                                <td>
                                                    @if (strtolower(trim($list['status'] ?? '')) == 'unpaid')
                                                        <span class="badge badge-danger text-white"
                                                            style="background-color: #dc3545 !important; font-size: 12px; padding: 5px 10px; border-radius: 4px; display: inline-block;">{{ $list['status'] }}</span>
                                                    @elseif (strtolower(trim($list['status'] ?? '')) == 'paid')
                                                        <span class="badge badge-success text-white"
                                                            style="background-color: #28a745 !important; font-size: 12px; padding: 5px 10px; border-radius: 4px; display: inline-block;">{{ $list['status'] }}</span>
                                                    @else
                                                        <span class="badge badge-warning text-dark"
                                                            style="background-color: #ffc107 !important; color: #212529 !important; font-size: 12px; padding: 5px 10px; border-radius: 4px; display: inline-block;">{{ $list['status'] ?? 'Pending' }}</span>
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
