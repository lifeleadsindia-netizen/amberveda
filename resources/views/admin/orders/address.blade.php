@extends('admin.layouts.main') 
@section('title', 'Order Address')
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
                        <h5>{{ __('Order Address')}}</h5>
                        <span>{{ __('Order Address ')}}</span>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Orders')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if (session()->has('kycMesg'))
               <div class="alert alert-primary">{{session('kycMesg')}}</div> 
            @endif
            <div class="card">
                <div class="card-header"><h3>{{ __('Orders Address')}}</h3> <span class="ml-auto mr-0"><a class=" btn btn-primary" href="{{url('admin/new-orders')}}">Back</a></span></div>
                <div class="card-body px-5">
                    <table id="data_table" class="table">
                       
                        <tbody>
                            <tr>
                                <th>Memberid</th>
                                <td>{{ $add['memberid']}}</td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td>{{ $add['first_name']}}</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>{{ $add['last_name']}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $add['email']}}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $add['mobile']}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $add['address_1']}}<br>{{ $add['address_2']}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $add['city']}}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $add['state']}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $add['country']}}</td>
                            </tr>
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