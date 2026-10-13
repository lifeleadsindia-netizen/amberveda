@extends('admin.layouts.main') 
@section('title', 'Withdrawal Requests')
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
                            <h5>{{ __('New Withdrawal Requests')}}</h5>
                            <span>{{ __('New Withdrawal Requests to verify')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Withdrawal Requests')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                @if (session()->has('successMsg'))
                <div class="alert alert-primary">{{session('successMsg')}}</div> 
                @endif
                <div class="card" class="overflow:auto">
                    <div class="card-header"><h3>{{ __('Withdrawal Requests')}}</h3></div>
                    <div class="card-body ">
                        <div class="" style="overflow:auto;">
                            <table id="data_table" class="table px-3" style="zoom: 90%">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No')}}</th>
                                        <th>{{ __('Request Date')}}</th>
                                        <th>{{ __('Member Id')}}</th>
                                        <!--<th>{{ __('Franchise Id')}}</th>-->
                                        <th>{{ __('Name')}}</th>
                                        <th>{{ __('Bank')}}</th>
                                        <th>{{ __('Holder')}}</th>
                                        <th>{{ __('IFSC')}}</th>
                                        <th>{{ __('Account')}}</th>
                                        <th>{{ __('Gross')}}</th>
                                        <th>{{ __('TDS')}}</th>
                                        <th>{{ __('Charges')}}</th>
                                        <th>{{ __('Net ')}}</th>
                                        <th>{{ __('Types ')}}</th>
                                        <th  class="text-center">{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1;  @endphp
                                    @foreach ($data as $list )
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{ date('d-m-Y', strtotime($list['created_at']))}}<br>{{ date('H:i:s', strtotime($list['created_at']))}}</td>
                                            <!--<td>-->
                                            <!--@if ($list['type'] == 'Member Wallet')-->
                                            <!--    {{ $list['memberid']}}-->
                                            <!--@else-->
                                            <!--    ---->
                                            <!--@endif-->
                                            <!--</td>-->
                                            <td>{{ $list['memberid']}}</td>
                                            <!--<td>-->
                                            <!--@if ($list['type'] == 'Franchise Wallet')-->
                                            <!--    {{ $list['franchise_id']}}-->
                                            <!--@else-->
                                            <!--    ---->
                                            <!--@endif-->
                                            <!--</td>-->
                                            <td>{{ $list['name']}}</td>
                                            <td>{{ $list['bank']}}</td>
                                            <td>{{ $list['holder']}}</td>
                                            <td>{{ $list['ifsc']}}</td>
                                            <td>{{ $list['account']}}</td>
                                            <td>₹{{ $list['gross_amount']}}</td>
                                            <td>₹{{ $list['tds']}}</td>
                                            <td>₹{{ $list['service_charge']}}</td>
                                            <td>₹{{ $list['net_amount']}}</td>
                                            <td>{{ $list['type']}}</td>
                                            <td class="px-0">
                                                <a href="{{url('admin/release-payment')}}/{{$list['id']}}" class="btn btn-sm btn-primary mx-0">View</a>
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
    </div>

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
    @endpush
@endsection