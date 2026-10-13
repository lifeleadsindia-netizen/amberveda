@extends('member.layouts.main')
@section('title', 'Binary Matching Income')
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
                                        style="text-decoration: none">Binary Matching Income</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Binary Matching Income</h4>
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
                            <h4>{{ __('Binary Matching Income Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="example" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>{{ __('S.No') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Memberid') }}</th>
                                            <th>{{ __('Left New') }}</th>
                                            <th>{{ __('Total Left') }}</th>
                                            <th>{{ __('Right New') }}</th>
                                            <th>{{ __('Total Right') }}</th>
                                            <th>{{ __('Matching') }}</th>
                                            <th>{{ __('Total Amount') }}</th>
                                            <th>{{ __('Flushout') }}</th>
                                            <th>{{ __('Forward_Left') }}</th>
                                            <th>{{ __('Forward_Right') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($bdata as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}</td>
                                                <td>{{ $list['memberid'] }}</td>
                                                <td>₹{{ number_format($list['left_new'], 2) }}</td>
                                                <td>₹{{ number_format($list['total_left'], 2) }}</td>
                                                <td>₹{{ number_format($list['right_new'], 2) }}</td>
                                                <td>₹{{ number_format($list['total_right'], 2) }}</td>
                                                <td>₹{{ number_format($list['matching'], 2) }}</td>
                                                <td>₹{{ number_format($list['total_amount'], 2) }}</td>
                                                <td>₹{{ number_format($list['flushout'], 2) }}</td>
                                                <td>₹{{ number_format($list['forward_left'], 2) }}</td>
                                                <td>₹{{ number_format($list['forward_right'], 2) }}</td>
                                                <td>₹{{ number_format($list['amount'], 2) }}</td>
                                                <td>
                                                    @if (strtolower(trim($list['status'] ?? '')) == 'unpaid')
                                                        <span class="badge badge-danger text-white" style="background-color: #dc3545 !important; font-size: 12px; padding: 5px 10px; border-radius: 4px; display: inline-block;">{{ $list['status'] }}</span>
                                                    @elseif (strtolower(trim($list['status'] ?? '')) == 'paid')
                                                        <span class="badge badge-success text-white" style="background-color: #28a745 !important; font-size: 12px; padding: 5px 10px; border-radius: 4px; display: inline-block;">{{ $list['status'] }}</span>
                                                    @else
                                                        <span class="badge badge-warning text-dark" style="background-color: #ffc107 !important; color: #212529 !important; font-size: 12px; padding: 5px 10px; border-radius: 4px; display: inline-block;">{{ $list['status'] ?? 'Pending' }}</span>
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
