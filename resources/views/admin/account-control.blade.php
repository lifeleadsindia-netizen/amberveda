@extends('admin.layouts.main')
@section('title', 'Account Control')
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
                            <h5>{{ __('Account Control') }}</h5>
                            <span>{{ __('Account Control Details') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Account Control Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                @if (session()->has('statusDeact'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('statusDeact') }}
                    </div>
                @endif
                @if (session()->has('statusAct'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('statusAct') }}
                    </div>
                @endif
                <div class="card" style="zoom:90%">
                    <div class="card-header">
                        <h3>{{ __('Account Control Details') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Activation Date') }}</th>
                                    <th>{{ __('Avatar') }}</th>
                                    <th>{{ __('Member Id') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Mobile') }}</th>
                                    <th>{{ __('Sponsor Id') }}</th>
                                    <th>{{ __('Change Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1;  @endphp
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            @if ($list['activated_at'] == null)
                                                --/--/----
                                            @else
                                                {{ date('d-m-Y', strtotime($list['activated_at'])) }}<br>{{ date('H:i:s', strtotime($list['activated_at'])) }}
                                            @endif
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
                                        <td>{{ $list['mobile'] }}</td>
                                        <td>{{ $list['sponsorid'] }}</td>
                                        <td>
                                            @if ($list['status'] == 'Active')
                                                <a href="{{ url('admin/account-control') }}/{{ $list['id'] }}"><button
                                                        class="btn btn-primary">{{ $list['status'] }}</button></a>
                                            @endif
                                            @if ($list['status'] == 'Blocked')
                                                <a href="{{ url('admin/account-control') }}/{{ $list['id'] }}"><button
                                                        class="btn btn-danger">{{ $list['status'] }}</button></a>
                                            @endif
                                        </td>
                                        <td><a href="{{ url('admin/members/member-update') }}/{{ $list['id'] }}"
                                                class="btn btn-primary"><i class="ik ik-edit"></i> Edit</a></td>

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
