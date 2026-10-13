@extends('admin.layouts.main') 
@section('title', 'Set Selling Point')
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
                            <h5>{{ __('Set Selling Point')}}</h5>
                            <span>{{ __('Set Selling Point ')}}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Set Selling Point')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    
    
        <div class="row">
            <div class="col-md-6">
                @if (session()->has('roiMsg'))
                   <div class="alert alert-primary">{{session('roiMsg')}}</div> 
                @endif
                <div class="card">
                    <div class="card-header"><h3>{{ __('Selling Point Update Form')}}</h3></div>
                    <div class="card-body px-5">
                        <form action="{{route('sellingPointUpdate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Selling Point </label>
                                <input type="text" class="form-control" name="sp_rate" value="{{$data['sp_rate']}}" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" >
                            </div>
                            {{-- <div class="form-group">
                                <label>Advance Rate </label>
                                <input type="text" class="form-control" name="advance_rate" value="{{$data['advance_rate']}}" >
                            </div> --}}
                            {{-- <div class="form-group">
                                <label>Refund Rate </label>
                                <input type="text" class="form-control" name="refund_rate" value="{{$data['refund_rate']}}" >
                            </div> --}}
                            <div>
                                <button class="btn btn-primary float-right">Update Rate</button>
                            </div>
                        </form>
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