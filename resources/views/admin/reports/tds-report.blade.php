@extends('admin.layouts.main')
@section('title', 'TDS Report')
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
                            <h5>{{ __('TDS Report') }}</h5>
                            <span>{{ __('All TDS Report') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('TDS Report') }}</li>
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
                        <h3>{{ __('TDS Report') }}</h3>
                    </div>
                    <div class="card-body px-5 pr-2">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Request Date') }}</th>
                                    <th>{{ __('Payment Date') }}</th>
                                    <th>{{ __('Request Id') }}</th>
                                    <th>{{ __('Member Id') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Gross Amount') }}</th>
                                    <th>{{ __('TDS') }}</th>
                                    <th>{{ __('Service Charge') }}</th>
                                    <th>{{ __('Net Amount') }}</th>
                                    <th>{{ __('PAN No') }}</th>
                                    <th>{{ __('Bank') }}</th>
                                    <th>{{ __('IFSC') }}</th>
                                    <th>{{ __('Holder') }}</th>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('UTR') }}</th>
                                    <th>{{ __('Reason') }}</th>
                                    {{-- <th>{{ __('Other Detail') }}</th> --}}
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1;  @endphp
                                @foreach ($Wdata as $list)
                                @php  
                                $mdata = $data->where('memberid', $list['memberid'])->first();
                                $pan_id = isset($mdata) ? $mdata->pan_no : 'N/A';
                                 @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ date('d-m-Y', strtotime($list['request_date'])) }}<br>{{ date('H:i:s', strtotime($list['request_date'])) }}
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($list['payment_date'])) }}<br>{{ date('H:i:s', strtotime($list['payment_date'])) }}
                                        </td>
                                        <td>{{ $list['request_id'] }}</td>
                                        <td>{{ $list['memberid'] }}</td>
                                        <td>{{ $list['name'] }}</td>
                                        <td>₹{{ $list['gross_amount'] }}</td>
                                        <td>₹{{ $list['tds'] }}</td>
                                        <td>₹{{ $list['service_charge'] }}</td>
                                        <td>₹{{ $list['net_amount'] }}</td>
                                        <td>{{ $pan_id }}</td>
                                        <td>{{ $list['bank'] }}</td>
                                        <td>{{ $list['ifsc'] }}</td>
                                        <td>{{ $list['holder'] }}</td>
                                        <td>₹{{ $list['account'] }}</td>
                                        <td>{{ !empty($list['utr']) ? $list['utr'] : '--' }}</td>
                                        <td>{{ !empty($list['reason']) ? $list['reason'] : '--' }}</td>
                                        {{-- <td>{{ $list['other_detail'] }}</td> --}}
                                        <td>
                                            @if ($list['status'] == 'Cancelled')
                                                <span class="btn btn-danger">{{ $list['status'] }}</span>
                                            @elseif($list['status'] == 'Approved')
                                                <span class="btn btn-success">{{ $list['status'] }}</span>
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
