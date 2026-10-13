@extends('admin.layouts.main') 
@section('title', 'Add Funds Details')
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
                        <h5>{{ __('Add Funds Details')}}</h5>
                        <span>{{ __('All Add Funds Details')}}</span>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Add Funds Details')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if (session()->has('failedMsg'))
                <div class="alert alert-danger" role="alert">
                    {{session('failedMsg')}}
                </div>
            @endif
            @if (session()->has('successMsg'))
                <div class="alert alert-success" role="alert">
                    {{session('successMsg')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h3>{{ __('Add Funds Details')}}</h3>
                    <span class="ml-auto mr-2"><a href="{{url('admin/funds/add-funds')}}" class="btn btn-sm btn-success text-white"> + Add Funds</a></span>
                    <span class="ml-2 mr-0"><a href="{{url('admin/funds/deduct-funds')}}" class="btn btn-sm btn-danger text-white"> - Deduct Funds</a></span>
                </div>
                <div class="card-body px-5">
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('S.No')}}</th>
                                <th>{{ __('Time')}}</th>
                                <th>{{ __('Memberid')}}</th>
                                <th>{{ __('OrderId')}}</th>
                                <th>{{ __('Amount')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Mode')}}</th>
                                <th>{{ __('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1;  @endphp
                            @foreach ($data as $list )
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $list['created_at']}}</td>
                                    <td>{{ $list['memberid']}}</td>
                                    <td>{{ $list['orderid']}}</td>
                                    <td>Rs {{ $list['amount']}}</td>
                                    <td>
                                        @if ($list['type'] == 'Add')
                                           <span class="badge bg-success text-white rounded-pill px-2 py-1">{{ $list['type']}}</span>
                                        @else
                                           <span class="badge bg-danger text-white rounded-pill px-2 py-1">{{ $list['type']}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($list['mode'] == 'Online')
                                           <span class="badge bg-warning  text-white rounded-pill px-2 py-1">{{ $list['mode']}}</span>
                                        @else
                                           <span class="badge bg-dark text-white rounded-pill px-2 py-1">{{ $list['mode']}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn btn-success">
                                            {{ $list['status']}}
                                        </div>
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
        <script src="{{ asset('adm_assets/assets/js/form-components.js') }}"></script>
    @endpush
@endsection