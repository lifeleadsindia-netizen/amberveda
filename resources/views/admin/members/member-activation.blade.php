@extends('admin.layouts.main')
@section('title', 'Account Activation')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Account Activation') }}</h5>
                            <span>{{ __('Member Account Activation') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Account Activation') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('successMsg') }}
                    </div>
                @endif
                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failedMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5>Member Account Activation</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body px-5" style="overflow: auto">
                                <table id="data_table" class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('S.No') }}</th>
                                            <th>{{ __('Joining') }}</th>
                                            <th>{{ __('Avatar') }}</th>
                                            <th>{{ __('MemberId') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('SponsorId') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Package') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1;  @endphp
                                        @foreach ($mdata as $list)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}<br>{{ date('h:i:s', strtotime($list['created_at'])) }}
                                                </td>
                                                <td>
                                                    @if ($list['profile_image'] == '')
                                                        <img src="{{ asset('uploads/avatar.jpg') }}"
                                                            class="table-user-thumb" alt="">
                                                    @else
                                                        <img src="{{ asset('uploads') }}/{{ $list['profile_image'] }}"
                                                            class="table-user-thumb" alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $list['memberid'] }}</td>
                                                <td>{{ $list['name'] }}</td>
                                                <td>{{ $list['email'] }}</td>
                                                <td>{{ $list['sponsorid'] }}</td>
                                                <td><span class="btn btn-sm btn-warning">{{ $list['status'] }}</span></td>
                                                <td>
                                                    <form action="{{ route('activateMember') }}" method="post">
                                                        @csrf
                                                        <div class="row" style="width:200px ">
                                                            <div class="col-10">
                                                                <select name="package" id="" class="form-control">
                                                                    <option value="">Select Package</option>
                                                                    <option value="25">Boster - $25</option>
                                                                    <option value="50">Basic - $50</option>
                                                                    <option value="100">Premium - $100</option>
                                                                    <option value="450">Elite - $450</option>
                                                                    <option value="900">Platinum - $900</option>
                                                                </select>
                                                                @error('package')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-2">
                                                                <input type="hidden" name="memberid"
                                                                    value="{{ $list['memberid'] }}">
                                                                <button type="submit"
                                                                    class="btn btn-primary ml-2">Activate</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
    </div>
    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/form-components.js') }}"></script>
    @endpush
@endsection
