@extends('admin.layouts.main')
@section('title', 'Create Payouts')
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
                            <h5>{{ __('Create Payouts') }}</h5>
                            <span>{{ __('All Create Payouts') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Payouts') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                @if (session()->has('successMsg'))
                  <div class="alert alert-success" role="alert">
                      {{session('successMsg')}}
                  </div>
                @endif
                @if (session()->has('failedMsg'))
                  <div class="alert alert-danger" role="alert">
                      {{session('failedMsg')}}
                  </div>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h3 style=" width:100%">{{ __('Members Payout Details') }} <span class="btn btn-primary float-right "><a href="{{url('admin/create-member-payouts')}}" class="text-white">Create Payout</a></span></h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <table id="data_table" class="table text-center">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Joining') }}</th>
                                    <th>{{ __('Avatar') }}</th>
                                    <th>{{ __('Member Id') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Sponsor Id') }}</th>
                                    <th>{{ __('KYC Status') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Wallet') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1;  @endphp
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}<br>{{ date('h:i:s', strtotime($list['created_at'])) }}
                                        </td>
                                        <td>
                                            @if ($list['profile_image'] == '')
                                                <img src="{{ asset('uploads/avatar.jpg') }}" class="table-user-thumb"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('uploads') }}/{{ $list['profile_image'] }}"
                                                    class="table-user-thumb" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $list['memberid'] }}</td>
                                        <td>{{ $list['name'] }}</td>
                                        <td>{{ $list['email'] }}</td>
                                        <td>{{ $list['sponsorid'] }}</td>
                                        <td><span></span>{{ $list['kyc_status'] }}</td>
                                        <td><span class="text-success">{{ $list['status'] }}</span></td>
                                        <td><span class="badge badge-warning">₹ {{ $list['wallet'] }}</span></td>
                                        <td>
                                            <div class="table-actions text-center">
                                                <a href="{{ url('admin/member-login') }}/{{ $list['id'] }}"
                                                    target="_blank"><button class="btn btn-sm btn-secondary"><i
                                                            class="ik ik-eye"></i> View </button></a>
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
    @endpush
@endsection
