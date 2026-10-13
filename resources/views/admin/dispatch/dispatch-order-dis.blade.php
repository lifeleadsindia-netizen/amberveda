@extends('admin.layouts.main')
@section('title', 'Dispatch Order')
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
                            <h5>{{ __('Dispatch Order') }}</h5>
                            <span>{{ __('Dispatch Order to verify') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Orders') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                @if (session()->has('kycMesg'))
                    <div class="alert alert-primary">{{ session('kycMesg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Dispatch Order') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Member Id') }}</th>
                                    <th>{{ __('Order Id') }}</th>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('PV') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1;  @endphp
                                @foreach ($orders as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ date('d-m-Y', strtotime($list['created_at']))}}</td>
                                        <td>{{ $list['memberid'] }}</td>
                                        <td>{{ $list['order_id'] }}</td>
                                        <td>{{ getProductName($list['pro_id']) }}</td>
                                        <td>₹ {{ $list['price'] }}</td>
                                        <td>{{ $list['bv'] }} PV</td>
                                        <td>{{ $list['quantity'] }}</td>
                                        <td>₹ {{ $list['total_amount'] }}</td>
                                        <td>
                                            <div class="badge badge-pill badge-success">{{ __($list['status']) }}</div>
                                        </td>
                                    </tr>
                                    @php $i++;  @endphp
                                @endforeach
                            </tbody>
                        </table>
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
