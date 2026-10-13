@extends('admin.layouts.main')
@section('title', 'Club Income')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Club Income') }}</h5>
                            <span>{{ __('Club Income') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Club Income') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                @if (session()->has('wMessage'))
                    <div class="alert alert-primary">{{ session('wMessage') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Club Income') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <div class="responsive">
                            <table id="data_table" class="table">
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
                                    @foreach ($data as $list)
                                        <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $list['memberid'] }}</td>
                                                <td>{{ $list['club_rank'] ?? '-' }}</td>
                                                <!--<td>₹ {{ number_format((float) $list['monthly_cto'], 2) }}</td>-->
                                                <!--<td>{{ $list['left'] ?? '-' }}</td>-->
                                                <!--<td>{{ $list['right'] ?? '-' }}</td>-->
                                                <td>
                                                    {{ isset($list['total_amount']) ? number_format((float) $list['total_amount'], 2) : '-' }}
                                                </td>
                                                <td>{{ $list['members'] ?? '-' }}</td>
                                                <td> {{ number_format((float) $list['amount'], 2) }}</td>
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
        </div>
    </div>

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
    @endpush
@endsection
