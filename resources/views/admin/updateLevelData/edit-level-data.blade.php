@extends('admin.layouts.main')
@section('title', 'Update Level Deatils')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Update Level Details') }}</h5>
                            <span>{{ __('Details updates') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Level Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6">
                @if (session()->has('updateErr'))
                    <div class="alert alert-success" role="alert">
                        {{ session('updateErr') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between mt-3 pt-0 mb-1">
                        <h5 class="mb-0"> Level No : {{ $ldata['id'] }} Details</h5>
                        <a href="{{ url('admin/level-details') }}"
                            class="text-white text-center btn btn-primary mr-3">Back</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body px-5">
                                <form action="{{ route('levelUpdateDetails') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Commission Level</label>
                                                <input type="text" class="form-control" name="level_commission"
                                                    value="{{ $ldata['level_commission'] }}">

                                                @error('level_commission')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Direct </label>
                                                <input type="number" class="form-control" name="direct"
                                                    value="{{ $ldata['direct'] }}">

                                                @error('direct')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 float-right">
                                            <input type="hidden" class="form-control" name="id"
                                                value="{{ $ldata['id'] }}">
                                            <button class="btn btn-primary float-right mt-4">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
