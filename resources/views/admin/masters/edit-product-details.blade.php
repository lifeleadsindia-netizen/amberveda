@extends('admin.layouts.main')
@section('title', 'Edit Product Details')
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
                            <h5>{{ __('Edit Product Details') }}</h5>
                            <span>{{ __('Edit Product Details') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Product Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                @if (session()->has('createMsg'))
                    <div class="alert alert-primary" role="alert">
                        <span>{{ session('createMsg') }}</span>
                    </div>
                @endif
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        <span>{{ session('successMsg') }}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Edit Product Details') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <form id="editProductForm" action="{{ route('editProduct') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="{{ $data['cat_id'] }}">{{ categoryName($data['cat_id']) }}</option>
                                    <option value="">----------------------</option>
                                    @foreach ($catdata as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['category'] }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="product" placeholder="Enter Product Name"
                                    value="{{ $data['product'] }}">
                                @error('product')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control"
                                        placeholder="Enter Product Quantity" value="{{ $data['quantity'] }}">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>MRP Price</label>
                                    <input type="number" step="0.01" name="product_price" class="form-control"
                                        placeholder="Enter Price" min="0" value="{{ $data['product_price'] }}">
                                    @error('product_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Selling Price Value</label>
                                    <input type="number" step="0.01" name="sp_value" class="form-control"
                                        placeholder="Enter SP Value" value="{{ $data['sp_value'] }}">
                                    @error('sp_value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>GST Value</label>
                                    <input type="number" step="0.01" name="gst" class="form-control"
                                        placeholder="Enter GST Rate" value="{{ $data['gst'] }}">
                                    @error('gst')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Distributor Price</label>
                                    <input type="number" step="0.01" name="distributor_price" class="form-control"
                                        placeholder="Distributor Price" value="{{ $data['distributor_price'] }}" readonly>
                                    @error('distributor_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Model No</label>
                                    <input type="text" class="form-control" name="model_no"
                                        placeholder="Enter Model Number" value="{{ $data['model_no'] }}">
                                    @error('model_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>



                            <div class="form-group">
                                <label>About</label>
                                <textarea name="about" id="about" class="form-control" placeholder="Enter about for product"
                                    value="{{ $data['about'] }}">{{ $data['about'] }}</textarea>
                                @error('model_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Product
                                    Image</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="hidden" value="{{ $data['id'] }}" name="id">
                                <button class="btn btn-primary float-right">Update Product</button>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var spValue = document.querySelector('[name="sp_value"]');
                var gstValue = document.querySelector('[name="gst"]');
                var distributorPrice = document.querySelector('[name="distributor_price"]');
                var editProductForm = document.getElementById('editProductForm');

                function toNumber(value) {
                    var number = parseFloat(value);
                    return isNaN(number) ? 0 : number;
                }

                function formatAmount(amount) {
                    amount = Math.round((amount + Number.EPSILON) * 100) / 100;
                    return amount % 1 === 0 ? amount.toFixed(0) : amount.toFixed(2);
                }

                function updateDistributorPrice() {
                    if (spValue.value === '' && gstValue.value === '') {
                        distributorPrice.value = '';
                        return;
                    }

                    distributorPrice.value = formatAmount(toNumber(spValue.value) + toNumber(gstValue.value));
                }

                spValue.addEventListener('input', updateDistributorPrice);
                spValue.addEventListener('change', updateDistributorPrice);
                gstValue.addEventListener('input', updateDistributorPrice);
                gstValue.addEventListener('change', updateDistributorPrice);
                editProductForm.addEventListener('submit', updateDistributorPrice);
                updateDistributorPrice();
            });
        </script>
    @endpush

@endsection
