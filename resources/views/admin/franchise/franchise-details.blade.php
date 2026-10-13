@extends('admin.layouts.main')
@section('title', 'Franchise Details')
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
                            <h5>{{ __('Franchise Details') }}</h5>
                            <span>{{ __('Franchise Details') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Franchise Details') }}</li>
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
                        <h3>{{ __('Franchise Details') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <div class="responsive">
                            <table id="data_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('franchise_id') }}</th>
                                        <th>{{ __('Commission') }}</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('mobile') }}</th>
                                        <th>{{ __('email') }}</th>
                                        <th>{{ __('city') }}</th>
                                        <th>{{ __('state') }}</th>
                                        <th>{{ __('country') }}</th>
                                        <th>{{ __('status') }}</th>
                                        <th colspan="2" class="text-center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1;  @endphp
                                    @foreach ($data as $list)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}<br>{{ date('h:i:s', strtotime($list['created_at'])) }}
                                            </td>
                                            <td>{{ __($list['franchise_id']) }}</td>
                                            <td>{{ __($list['commission']) }}</td>
                                            <td>{{ __($list['name']) }}</td>
                                            <td>{{ __($list['mobile']) }}</td>
                                            <td>{{ __($list['email']) }}</td>
                                            <td>{{ __($list['city']) }}</td>
                                            <td>{{ __($list['state']) }}</td>
                                            <td>{{ __($list['country']) }}</td>
                                            <td>
                                                @if ($list['status'] == 'Active')
                                                    <div class="btn btn-sm btn-success">{{ __($list['status']) }}</div>
                                                @else
                                                    <div class="btn btn-sm btn-danger ">{{ __($list['status']) }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/franchise/inventory-details', $list['franchise_id']) }}"
                                                    class="btn btn-sm btn-info">{{ __('Inventory Details') }}</a>
                                            </td>
                                            <td>
                                                <div class="text-white text-center badge badge-primary">
                                                    <a class="text-white"
                                                        href="{{ url('admin/franchise-login') }}/{{ $list['id'] }}"
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
    </div>

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
    @endpush
@endsection
