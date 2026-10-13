@extends('admin.layouts.main') 
@section('title', 'Category Creation')
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
                        <h5>{{ __('Category Creation')}}</h5>
                        <span>{{ __('All Category Creation')}}</span>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Category Creation')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-5">
            @if (session()->has('createMsg'))
                <div class="alert alert-primary" role="alert">
                    <span>{{session('createMsg')}}</span>
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h3>{{ __('Create Categories')}}</h3></div>
                <div class="card-body px-5">
                    <form action="{{route('createCat')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" name="category" placeholder="Enter Category Name">
                            @error('category')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h3>{{ __('All Categories')}}</h3></div>
                <div class="card-body px-5">
                    <table id="data_table" class="table">
                        <thead>
                        <tr>
                            <th>{{ __('S.No')}}</th>
                            <th>{{ __('Category')}}</th>
                            <!--<th>{{ __('Action')}}</th>-->
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($data as $list)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ __($list['category'])}}</td>
                                    <!--<td><a class="btn btn-primary" href="">Edit</a></td>-->
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

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
    @endpush
   
@endsection