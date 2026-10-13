@extends('admin.layouts.main')
@section('title', 'GST Report')
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
                            <h5>{{ __('GST Report') }}</h5>
                            <span>{{ __('All GST Report') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('GST Report') }}</li>
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
                <div class="card" style="overflow: auto">
                    <div class="card-header">
                        <h3>{{ __('GST Report') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Dispatch Date') }}</th>
                                    <th>{{ __('Member Id') }}</th>
                                    <th>{{ __('Order Id') }}</th>
                                    {{-- <th>{{ __('Tracking Id') }}</th> --}}
                                    {{-- <th>{{ __('Name') }}</th> --}}
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('GST Amount') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    {{-- <th>{{ __('Remark') }}</th> --}}
                                    {{-- <th>{{ __('Invoice No') }}</th> --}}
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1;  @endphp
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ date('d-m-Y', strtotime($list['created_at'])) }}<br>{{ date('H:i:s', strtotime($list['created_at'])) }}
                                        </td>
                                        <td>{{ $list['memberid'] }}</td>
                                        <td>{{ $list['order_id'] }}</td>
                                        {{-- <td>{{ $list['tracking_id'] }}</td> --}}
                                        {{-- <td>{{ $list['courier_name'] }}</td> --}}
                                        <td>{{ $list['quantity'] }}</td>
                                        <td>₹{{ $list['price'] }}</td>
                                        <td>₹ {{ $list['gst_amount'] }}</td>
                                        <td>₹{{ $list['total_amount'] }}</td>
                                        {{-- <td>{{ $list['remark'] }}</td> --}}
                                        {{-- <td>{{ $list['invoice_no'] }}</td> --}}
                                        <td>
                                            @if ($list['status'] == 'Completed')
                                                <span class="btn btn-success">{{ $list['status'] }}</span>
                                            @elseif($list['status'] == 'Temp')
                                                <span class="btn btn-danger">{{ $list['status'] }}</span>
                                            @elseif($list['status'] == 'PENDING')
                                                <span class="btn btn-info">{{ $list['status'] }}</span>
                                            @endif
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
