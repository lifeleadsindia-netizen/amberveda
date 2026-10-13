@extends('admin.layouts.main')
@section('title', 'Member Details')
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
                            <h5>{{ __('Member Details') }}</h5>
                            <span>{{ __('All Member Details') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Member Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Data Table') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
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
                                    <th>{{ __('Left SP') }}</th>
                                    <th>{{ __('Right SP') }}</th>
                                    <th>{{ __('Sponsor Id') }}</th>
                                    <th>{{ __('Team Biz') }}</th>
                                    <th>{{ __('Wallet') }}</th>
                                    <th>{{ __('Fund Wallet') }}</th>
                                    <th>{{ __('Club') }}</th>
                                    <th>{{ __('Activated By') }}</th>
                                    <th>{{ __('Status') }}</th>
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
                                        <td>{{ $list['left_amount'] }}</td>
                                        <td>{{ $list['right_amount'] }}</td>
                                        <td>{{ $list['sponsorid'] }}</td>
                                        <td>₹{{ $list['team_biz'] }} </td>
                                        <td>₹{{ $list['wallet'] }}</td>
                                        <td>₹{{ $list['p2p_wallet'] }}</td>
                                        <td>Club {{ $list['club_status'] }}</td>
                                        <td>{{ $list['activated_by'] }}</td>
                                        <td>{{ $list['status'] }}</td>
                                        <td>
                                            <div class="text-white text-center badge badge-primary">
                                                <a class="text-white"
                                                    href="{{ url('admin/member-login') }}/{{ $list['id'] }}"
                                                    target="_blank"><i class="ik ik-eye"></i> View</a>
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
