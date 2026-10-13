@extends('member.layouts.main')
@section('title', 'Level income')
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
                                        style="text-decoration: none">Level Income</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Level Income</h4>
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
                            <h4>{{ __('Level Income Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="example" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>{{ __('S.No') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Member Id') }}</th>
                                            <th>{{ __('Level') }}</th>
                                            <th>{{ __('Level ID') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Package') }}</th>
                                            <th>{{ __('Rate') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <!--<th>{{ __('Staking Income') }}</th>-->
                                            <!--<th>{{ __('Level Status') }}</th>-->
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($ldata as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}<br>{{ date('h:i:s', strtotime($list['created_at'])) }}
                                                </td>
                                                <td>{{ __($list['memberid']) }}</td>
                                                <td>{{ __($list['level']) }}</td>
                                                <td>{{ __($list['level_id']) }}</td>
                                                <td>{{ __($list['name']) }}</td>
                                                <td>₹ {{ __($list['package']) }}</td>
                                                <td>{{ __($list['rate']) }}%</td>
                                                <td>₹ {{ __($list['amount']) }}</td>
                                                <!--<td>{{ __($list['staking_income']) }}</td>-->
                                                <!--<td>{{ __($list['level_status']) }}</td>-->
                                                <td>
                                                    @if ($list['status'] == 'Paid')
                                                        <div class="btn btn-sm btn-success">{{ __($list['status']) }}</div>
                                                    @else
                                                        <div class="btn btn-sm btn-danger ">{{ __($list['status']) }}</div>
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
