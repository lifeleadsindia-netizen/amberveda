@extends('member.layouts.main')
@section('title', 'Product Details')
@section('container')
    <link href="{{ asset('adm_assets/vendor/datatables/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adm_assets/vendor/datatables/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li> --}}
                            <li class="breadcrumb-item active">Product Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                @if (session('successMsg'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations!',
                            text: '{{ session('successMsg') }}',
                            confirmButtonText: 'Okay',
                        });
                    </script>
                @endif
                @if (session('failedMsg'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ session('failedMsg') }}',
                            confirmButtonText: 'Try Again'
                        });
                    </script>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product image -->
                                <a href="javascript: void(0);" class="text-center d-block mb-4">
                                    <img src="{{ asset('uploads') }}/{{ $pro_data['image'] }}" class="img-fluid"
                                        style="max-width: 280px;" alt="Product Image">
                                </a>

                                <!--<div class="d-lg-flex d-none justify-content-center">-->
                                <!--    <a href="javascript: void(0);">-->
                                <!--        <img src="{{ asset('uploads') }}/{{ $pro_data['image2'] }}"-->
                                <!--            class="img-fluid img-thumbnail p-2" style="max-width: 75px;"-->
                                <!--            alt="Product-img" />-->
                                <!--    </a>-->
                                <!--    <a href="javascript: void(0);" class="ms-2">-->
                                <!--        <img src="{{ asset('uploads') }}/{{ $pro_data['image3'] }}"-->
                                <!--            class="img-fluid img-thumbnail p-2" style="max-width: 75px;"-->
                                <!--            alt="Product-img" />-->
                                <!--    </a>-->
                                <!--    <a href="javascript: void(0);" class="ms-2">-->
                                <!--        <img src="{{ asset('uploads') }}/{{ $pro_data['image'] }}"-->
                                <!--            class="img-fluid img-thumbnail p-2" style="max-width: 75px;"-->
                                <!--            alt="Product-img" />-->
                                <!--    </a>-->
                                <!--</div>-->
                            </div> <!-- end col -->
                            <div class="col-lg-7">
                                <div class="ps-lg-4">
                                    <!-- Product title -->
                                    <h3 class="mt-0">{{ $pro_data['product'] }}<a href="javascript: void(0);"
                                            class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a>
                                    </h3>
                                    <p class="mb-1">Added Date: {{ $pro_data['created_at'] }}</p>
                                    <p class="font-16">
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                    </p>
                                    @php
                                        // $quantity = getProductQuantity($pro_data['id'], $data->city, $data->state);
                                    @endphp
                                    <!-- Product stock -->
                                    <div class="mt-3">
                                        @if ($pro_data['quantity'] > 0)
                                            <h4><span class="badge badge-success-lighten">Instock</span></h4>
                                        @else
                                            <h4><span class="badge badge-danger-lighten">Out of Stock</span></h4>
                                        @endif
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4 price">
                                        <h6 class="font-14">Price:</h6>
                                        {{-- <h3 class="old">₹{{ number_format($pro_data['price'] + 1000, 0) }}</h3> --}}
                                        <h3 class="new">₹{{ number_format($pro_data['distributor_price'], 0) }}</h3>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Quantity</h6>
                                        <form action="{{ route('addToCart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="pro_id" value="{{ $pro_data['id'] }}">
                                            @if ($pro_data['quantity'] > 0)
                                                <div class="d-flex align-items-center">
                                                    <div class="input-group me-2" style="width: 140px;">
                                                        <button class="btn btn-outline-secondary px-2" type="button"
                                                            onclick="var inp = this.nextElementSibling; if(parseInt(inp.value || 1) > 1) { inp.value = parseInt(inp.value) - 1; }">-</button>
                                                        <input type="number" min="1"
                                                            class="form-control text-center" placeholder="Qty"
                                                            name="qty" value="1">
                                                        <button class="btn btn-outline-secondary px-2" type="button"
                                                            onclick="var inp = this.previousElementSibling; inp.value = parseInt(inp.value || 0) + 1;">+</button>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="mdi mdi-cart me-1"></i>Add to cart</button>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center">
                                                    <div class="input-group me-2" style="width: 140px;">
                                                        <button class="btn btn-outline-secondary px-2" type="button"
                                                            disabled>-</button>
                                                        <input type="number" min="1" value="1"
                                                            class="form-control text-center" placeholder="Qty" disabled>
                                                        <button class="btn btn-outline-secondary px-2" type="button"
                                                            disabled>+</button>
                                                    </div>
                                                    <a class="btn btn-danger disabled"><i class="mdi mdi-cart me-1"></i>
                                                        Add to cart</a>
                                                </div>
                                            @endif
                                        </form>
                                        <!-- Product description -->
                                        <div class="mt-4">
                                            <h6 class="font-14">Description:</h6>
                                            <p>{{ $pro_data['about'] }}</p>
                                        </div>
                                        <!-- Product information -->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container -->

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <!-- END wrapper -->
@endsection
