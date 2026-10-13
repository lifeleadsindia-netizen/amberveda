@extends('admin.layouts.main')
@section('title', 'Update Link Product')
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
                            <h5>{{ __('Update Link Product') }}</h5>
                            <span>{{ __('Update Link Product') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Update Link Product') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @if (session()->has('updateErr'))
                    <div class="alert alert-primary" role="alert">
                        <span>{{ session('updateErr') }}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Update Link Product') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <form action="{{ route('updateLinkProduct') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="example-name-input"
                                    class="col-md-12 col-form-label form-control-label">Plateform</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="plateform" id="plateform">
                                        <option value="">Select Plateform</option>
                                        <option value="Amazon">Amazon</option>
                                        <option value="Flipkart">Flipkart</option>
                                    </select>
                                    @error('plateform')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Title</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Enter Product Title" value="{{ $udata['title'] }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Price</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="price" placeholder="Enter Price"
                                        value="{{ $udata['price'] }}">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">BV</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="bv" placeholder="Enter BV"
                                        value="{{ $udata['bv'] }}">
                                    @error('bv')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Description</label>
                                <div class="col-md-12">
                                    <textarea type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter Description for product">{{ $udata['description'] }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input" class="col-md-12 col-form-label form-control-label">Product
                                    Link</label>
                                <div class="col-md-12">
                                    {{-- <textarea type="text" class="form-control" id="link" name="link" placeholder="Enter link for product">{{ $udata['link'] }}</textarea> --}}
                                    <input type="text" class="form-control" name="link"
                                        placeholder="Enter Product Link" value="{{ $udata['link'] }}">
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input" class="col-md-12 col-form-label form-control-label">Product
                                    Image</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" value="{{ $udata['id'] }}">
                                <button class="btn btn-primary float-right">Update</button>
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
