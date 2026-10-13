@extends('admin.layouts.main')
@section('title', 'Release Payment')
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
                            <h5>{{ __('Release Payment') }}</h5>
                            <span>{{ __('All Release Payment') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Release Payment') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                @if (session()->has('successMsg'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('successMsg') }}
                    </div>
                @endif
                @if (session()->has('failedMsg'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('failedMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Accept Payment') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('wAccept') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>UTR </label>
                                <input type="text" class="form-control" name="utr" placeholder="Enter Utr">
                                @error('utr')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Other Detail </label>
                                <input type="text" class="form-control" name="otherdetail" placeholder="Enter Details">
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Screenshot </label>
                                <input type="file" class="form-control " name="image" />
                                @error('image')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <div class="d-grid mt-3">
                                    <input type="hidden" id="csrf" value="{{$wid}}" name="wid">
                                    <button class="btn btn-success" id="subBtn">
                                    <span>Accept</span>

                                    </button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @if (session()->has('successMsg1'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('successMsg1') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Reject Payment') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('wCancel') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Reason </label>
                                <textarea type="text" class="form-control" name="reason" placeholder="Enter Reason"></textarea>
                                @error('reason')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                             <div>
                                <div class="d-grid mt-3">
                                    <input type="hidden" id="csrf" value="{{$rid}}" name="rid">
                                    <button class="btn btn-danger" id="subBtn">
                                    <span>Reject</span>

                                    </button>
                                </div>
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
        <script src="{{ asset('adm_assets/assets/js/form-components.js') }}"></script>
    @endpush
@endsection
