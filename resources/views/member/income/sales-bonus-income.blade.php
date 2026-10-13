@extends('member.layouts.main')
@section('title', 'Sales Bonus income')
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
                                        style="text-decoration: none">Sales Bonus Income</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Sales Bonus Income</h4>
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
                            <h4>{{ __('Sales Bonus Income Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="example" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>{{ __('S.No') }}</th>
                                            <th>{{ __('Member Id') }}</th>
                                            <th>{{ __('Left SP') }}</th>
                                            <th>{{ __('Right SP') }}</th>
                                            <!--<th>{{ __('Package') }}</th>-->
                                            <th>{{ __('Amount') }}</th>
                                            <!--<th>{{ __('Total Amount') }}</th>-->
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($udata as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ __($list['memberid']) }}</td>
                                                <td>{{ __($list['left_sp']) }}</td>
                                                <td>{{ __($list['right_sp']) }}</td>
                                                <!--<td>₹ {{ __($list['package']) }}</td>-->
                                                <td>₹ {{ number_format($list['amount'], 2) }}</td>
                                                <!--<td>{{ number_format($list['total_amount'], 2) }}</td>-->
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
