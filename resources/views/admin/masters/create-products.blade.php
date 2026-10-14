@extends('admin.layouts.main')
@section('title', 'Create Product')
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
                            <h5>{{ __('Create Product') }}</h5>
                            <span>{{ __('Create Product') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Product') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger" role="alert">
                        <span>{{ session('failedMsg') }}</span>
                    </div>
                @endif
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        <span>{{ session('successMsg') }}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Create Product') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <form id="createProductForm" action="{{ route('productInsert') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label for="example-name-input"
                                    class="col-md-12 col-form-label form-control-label">Category</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Select Category</option>
                                        @foreach ($catdata as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['category'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-image-input" class="col-md-12 col-form-label form-control-label">Product
                                    Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="product"
                                        placeholder="Enter Product Name">
                                    @error('product')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="example-image-input"
                                            class="col-md-12 col-form-label form-control-label">Quantity</label>
                                        <div class="col-md-12">
                                            <input type="number" class="form-control" name="quantity"
                                                placeholder="Enter Product Quantity">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="example-image-input"
                                            class="col-md-12 col-form-label form-control-label">MRP Price</label>
                                        <div class="col-md-12">
                                            <input type="number" step="0.01" class="form-control" name="product_price"
                                                placeholder="Enter MRP Price">
                                            @error('product_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="example-image-input"
                                            class="col-md-12 col-form-label form-control-label">Selling Price Value</label>
                                        <div class="col-md-12">
                                            <input type="number" step="0.01" class="form-control" name="sp_value"
                                                placeholder="Enter SP Value">
                                            @error('sp_value')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="example-image-input"
                                            class="col-md-12 col-form-label form-control-label">GST Value</label>
                                        <div class="col-md-12">
                                            <input type="number" step="0.01" class="form-control" name="gst"
                                                placeholder="Enter GST Value ₹">
                                            @error('gst')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="example-image-input"
                                            class="col-md-12 col-form-label form-control-label">Distributor Price</label>
                                        <div class="col-md-12">
                                            <input type="number" step="0.01" class="form-control" name="distributor_price"
                                                placeholder="Distributor Price" value="{{ old('distributor_price') }}"
                                                readonly>
                                            @error('distributor_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label for="example-image-input"
                                            class="col-md-12 col-form-label form-control-label">Model
                                            No</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="model_no"
                                                placeholder="Enter Model Number">
                                            @error('model_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">About</label>
                                <div class="col-md-12">
                                    <textarea type="text" class="form-control" id="about" name="about" placeholder="Enter about for product"></textarea>
                                    @error('about')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label font-weight-bold">Product Image 1 <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" required accept="image/png,image/jpeg,image/jpg">
                                        <small class="text-muted d-block mt-1">Main display image (Required)</small>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label font-weight-bold">Product Image 2</label>
                                        <input type="file" class="form-control" name="image2" accept="image/png,image/jpeg,image/jpg">
                                        <small class="text-muted d-block mt-1">Additional gallery image (Optional)</small>
                                        @error('image2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label font-weight-bold">Product Image 3</label>
                                        <input type="file" class="form-control" name="image3" accept="image/png,image/jpeg,image/jpg">
                                        <small class="text-muted d-block mt-1">Additional gallery image (Optional)</small>
                                        @error('image3')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary my-4 float-right">Create Product</button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(function() {
                var $spValue = $('[name="sp_value"]');
                var $gstValue = $('[name="gst"]');
                var $distributorPrice = $('[name="distributor_price"]');

                function toNumber(value) {
                    var number = parseFloat(value);
                    return isNaN(number) ? 0 : number;
                }

                function formatAmount(amount) {
                    amount = Math.round((amount + Number.EPSILON) * 100) / 100;
                    return amount % 1 === 0 ? amount.toFixed(0) : amount.toFixed(2);
                }

                function updateDistributorPrice() {
                    if ($spValue.val() === '' && $gstValue.val() === '') {
                        $distributorPrice.val('');
                        return;
                    }

                    $distributorPrice.val(formatAmount(toNumber($spValue.val()) + toNumber($gstValue.val())));
                }

                $spValue.add($gstValue).on('input change', updateDistributorPrice);
                $('#createProductForm').on('submit', updateDistributorPrice);
                updateDistributorPrice();
            });
        </script>
    @endpush
@endsection
