@extends('member.layouts.main')
@section('title','Package Details')
@section('container')
          <!-- Content wrapper -->
          <div class="content-wrapper">

            <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
                
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">{{config('detailsApp.name')}}  /</span> Package Details
                
            </h4>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Packages Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example4" class="table table-bordered" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>{{ __('S.No')}}</th>
                                            <th>{{ __('Date')}}</th>
                                            <th>{{ __('OrderId')}}</th>
                                            {{-- <th>{{ __('Package')}}</th> --}}
                                            <th>{{ __('Package Type')}}</th>
                                            <th>{{ __('Value')}}</th>
                                            {{-- <th>{{ __('Mode')}}</th> --}}
                                            <th>{{ __('Status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($package_data as $list)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td> {{ __( date('d-m-Y', strtotime($list['created_at'])))}}</td>
                                                <td>{{ __($list['order_id'])}}</td>
                                                {{-- <td>{{ __($list['package_name'])}}</td> --}}
                                                <td>{{ __($list['package_type'])}}</td>
                                                <td>{{ __($list['package_value'])}} PV</td>
                                                {{-- <td>{{ __($list['payment_mode'])}}</td> --}}
                                                <td>
                                                    @if ($list['status']=='Active')
                                                        <button class="btn btn-success">{{ __($list['status'])}}</button>
                                                    @else
                                                        <button class="btn btn-danger ">{{ __($list['status'])}}</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                            $i++;
                                            @endphp
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection