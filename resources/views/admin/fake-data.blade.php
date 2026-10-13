@extends('admin.layouts.main') 
@section('title', 'User Data')
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
                            <h5>{{ __('User Data')}}</h5>
                            <span>{{ __('User Data')}}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('User Data')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    
    
        <div class="row">
            <div class="col-md-6">
                @if (session()->has('userMsg'))
                   <div class="alert alert-primary">{{session('userMsg')}}</div> 
                @endif
                <div class="card">
                    <div class="card-header"><h3>{{ __('User Data Update Form')}}</h3></div>
                    <div class="card-body px-5">
                        <form action="{{route('userDataUpdate')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="form-group">
                                <label>Total Users </label>
                                <input type="number" class="form-control" name="total_user" value="{{$data['total_user']}}">
                                @error('total_user')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group">
                                <label>User 24 Hours </label>
                                <input type="number" class="form-control" name="user_24hour" value="{{$data['user_24hour']}}">
                                @error('user_24hour')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> --}}
                            <div>
                                <button class="btn btn-primary float-right">Update Data</button>
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