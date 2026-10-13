@extends('admin.layouts.main')
@section('title', 'Fund History')
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
                            <h5>{{ __('Fund  History') }}</h5>
                            <span>{{ __('All Fund  History ') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Fund  History') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('fundMsg'))
                    <div class="alert alert-primary" role="alert">{{ session('fundMsg') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Fund  History') }}</h3>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive px-4 text-center">
                            <table id="data_table" class="table ">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Member Id') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Wallet') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1;  @endphp
                                    @foreach ($data as $list)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ date('d-m-Y', strtotime($list['updated_at'])) }}<br>{{ date('H:i:s', strtotime($list['updated_at'])) }}
                                            </td>
                                            <td>{{ $list['memberid'] }}</td>
                                            <td>$ {{ $list['amount'] }}</td>
                                            <td>{{ $list['wallet_type'] }}</td>
                                            <td>
                                                @if ($list['type'] == 'Add')
                                                    <span class="badge badge-success">{{ $list['type'] }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $list['type'] }}</span>
                                                @endif
                                            </td>
                                            <td><button class="btn btn-primary">{{ $list['status'] }} </button></td>

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

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.packView').click(function() {
                    var id = $(this).prop('id');
                    $('.mySecs' + id).toggle();
                });
            })
        </script>
    @endpush
@endsection
