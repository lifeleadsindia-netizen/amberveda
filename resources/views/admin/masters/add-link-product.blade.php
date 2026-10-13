@extends('admin.layouts.main')
@section('title', 'Add Link Product')
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
                            <h5>{{ __('Add Link Product') }}</h5>
                            <span>{{ __('Add Link Product') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add Link Product') }}</li>
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
                        <h3>{{ __('Add Link Product') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <form action="{{ route('createLink') }}" method="post" enctype="multipart/form-data">
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
                                        placeholder="Enter Product Title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Price</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="price" placeholder="Enter Price">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">PV</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" name="bv" placeholder="Enter PV">
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
                                        placeholder="Enter Description for product"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input" class="col-md-12 col-form-label form-control-label">Product
                                    Link</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="link"
                                        placeholder="Enter Product Link">
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
                        <h3>{{ __('All products link') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <div class="responsive">
                            <table id="data_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Plateform') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('BV') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Link') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($linkdata as $list)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><img src="{{ asset('uploads') }}/{{ $list['image'] }}" alt=""
                                                    width="50"> </td>
                                            <td>{{ __($list['plateform']) }}</td>
                                            <td>{{ __($list['title']) }}</td>
                                            <td>{{ __($list['price']) }}</td>
                                            <td>{{ __($list['bv']) }}</td>
                                            <td>{{ __($list['description']) }}</td>
                                            <td>{{ __($list['link']) }}</td>
                                            <td>
                                                @if ($list['status'] == 'Not Live')
                                                    <a class="btn btn-danger"
                                                        href="{{ url('admin/product-status') }}/{{ $list['id'] }}">{{ $list['status'] }}</a>
                                                @endif
                                                @if ($list['status'] == 'Live')
                                                    <a class="btn btn-success"
                                                        href="{{ url('admin/product-status') }}/{{ $list['id'] }}">{{ $list['status'] }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="text-white text-center badge badge-primary">
                                                    <a class="text-white"
                                                        href="{{ url('admin/edit-link-product') }}/{{ $list['id'] }}"><i
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
