@extends('admin.layouts.main')
@section('title', 'Mentorship Income')
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
                        <h5>{{ __('Mentorship Income') }}</h5>
                        <span>{{ __('Mentorship Income') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Admin') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Mentorship Income') }}</li>
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
                    <h3>{{ __('Mentorship Income') }}</h3>
                </div>
                <div class="card-body px-5" style="overflow: auto">
                    <div class="responsive">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Member ID') }}</th>
                                    <th>{{ __('Generation / Level') }}</th>
                                    <th>{{ __('Total Matching') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Share') }}</th>
                                    <th>{{ __('Total Members') }}</th>
                                    <th>{{ __('Income Amount') }}</th>
                                    <th>{{ __('Downline') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($data as $list)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ !empty($list['created_at']) ? date('d-m-Y h:i A', strtotime($list['created_at'])) : 'N/A' }}</td>
                                    <td>{{ $list['memberid'] }}</td>
                                    <td>{{ $list['level'] }}</td>
                                    <td>{{ $list['total_matching'] }}</td>
                                    <td>{{ $list['rate'] }}%</td>
                                    <td>{{ $list['share'] }}</td>
                                    <td>{{ $list['total_members'] }}</td>
                                    <td>₹{{ number_format((float)($list['amount'] ?? 0), 2) }}</td>
                                    <td>{{ $list['downline'] }}</td>
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
                                @php $i++; @endphp
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