@extends('admin.layouts.main')
@section('title', 'Create Admin')
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
                            <h5>{{ __('Create Admin') }}</h5>
                            <span>{{ __('Create Admin') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Admin') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                @if (session()->has('createMsg'))
                    <div class="alert alert-primary" role="alert">
                        <span>{{ session('createMsg') }}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Create Admin') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <form action="{{ route('createAdmin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="example-name-input"
                                    class="col-md-12 col-form-label form-control-label">Roll</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="roll" id="roll">
                                        <option value="">Select Roll</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Sub Admin">Sub Admin</option>
                                    </select>
                                    @error('roll')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Email-ID</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email ID">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Password</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if (session()->has('successMsg'))
                    <div class="alert alert-primary" role="alert">
                        <span>{{ session('successMsg') }}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('All Admin Details') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <div class="responsive">
                            <table id="data_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Roll') }}</th>
                                        <th>{{ __('Email-ID') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($adata as $list)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ __(date('d-m-Y', strtotime($list['created_at']))) }}<br>{{ __(date('h:i:s', strtotime($list['created_at']))) }}
                                            <td>{{ __($list['roll']) }}</td>
                                            <td>{{ __($list['email']) }}</td>
                                            <td>
                                                <div class="text-white text-center badge badge-primary">
                                                    <a class="text-white"
                                                        href="{{ url('admin/edit-admin-details') }}/{{ $list['id'] }}"><i
                                                            class="ik ik-edit"></i>Edit</a>
                                                </div>
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

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
    @endpush

@endsection
