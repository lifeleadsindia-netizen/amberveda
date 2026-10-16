@extends('member.layouts.main')
@section('title', 'Product Details')
@section('container')
    <link href="{{ asset('adm_assets/vendor/datatables/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adm_assets/vendor/datatables/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Add any custom styles for the product details page here */
         .old {
            font-size: 13px;
            text-decoration: line-through;
            color: #A1A1AA;
            margin-bottom: 2px
        }
        .text-muted {
            font-size: 12px;
            color: #6C757D;
            margin-bottom: 2px;
            font-weight: 400;
            text-decoration-color: blanchedalmond ;

        }
    </style>


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
                                @php
                                    $galleryImages = [];
                                    $imgKeys = ['image', 'image2', 'image3'];
                                    foreach ($imgKeys as $imgKey) {
                                        if (!empty($pro_data[$imgKey])) {
                                            $val = $pro_data[$imgKey];
                                            if (file_exists(public_path('uploads/' . $val))) {
                                                $galleryImages[] = asset('uploads/' . $val);
                                            } elseif (file_exists(public_path($val))) {
                                                $galleryImages[] = asset($val);
                                            } else {
                                                $galleryImages[] = asset('uploads/' . $val);
                                            }
                                        }
                                    }
                                    if (empty($galleryImages)) {
                                        $galleryImages[] = asset('mem_assets/images/products/product-1.jpg');
                                    }
                                @endphp

                                <!-- Product main display image -->
                                <div class="text-center mb-3">
                                    <div class="d-flex align-items-center justify-content-center bg-white border rounded p-3 shadow-sm mx-auto"
                                         style="height: 350px; max-width: 380px; overflow: hidden; background: #fff;">
                                        <img id="mainProductPreview" 
                                             src="{{ $galleryImages[0] }}" 
                                             class="img-fluid" 
                                             alt="{{ $pro_data['product'] }}"
                                             style="max-height: 100%; max-width: 100%; width: auto; height: auto; object-fit: contain; transition: opacity 0.2s ease-in-out;" />
                                    </div>
                                </div>

                                <!-- Thumbnails (only displayed if multiple images exist) -->
                                @if (count($galleryImages) > 1)
                                    <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap mb-4" id="productThumbContainer">
                                        @foreach ($galleryImages as $index => $imgUrl)
                                            <div class="product-thumb-item {{ $index === 0 ? 'active' : '' }}" 
                                                 onclick="switchProductGalleryImage('{{ $imgUrl }}', this)"
                                                 style="width: 72px; height: 72px; padding: 4px; border: 2px solid {{ $index === 0 ? '#0ab39c' : '#dee2e6' }}; border-radius: 8px; cursor: pointer; background: #ffffff; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                                <img src="{{ $imgUrl }}" 
                                                     alt="Thumbnail {{ $index + 1 }}" 
                                                     style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; display: block;" />
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
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
                                    <div class="mt-4 price product-pricing">
                                        <span class="old">MRP ₹{{ number_format($pro_data['product_price'], 2) }}</span>
                                        <h4 class="font-14">Price:</h4>
                                        {{-- <h3 class="old">₹{{ number_format($pro_data['price'] + 1000, 0) }}</h3> --}}
                                        <h3 class="new">₹{{ number_format($pro_data['distributor_price'], 2) }}  <span class="tax-info">(INCL OF ALL TAXES)</span></h3>
                                        <hr>
                                       <p class="text-muted" >COURIER CHARGES EXTRA AS APPLICABLE.</p>
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

    <style>
        .product-thumb-item {
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }
        .product-thumb-item:hover {
            border-color: #0ab39c !important;
            transform: translateY(-2px);
        }
        .product-thumb-item.active {
            border-color: #0ab39c !important;
            box-shadow: 0 0 0 2px rgba(10, 179, 156, 0.25) !important;
        }
        .product-pricing h2,
        .product-pricing h4 {
            font-size: clamp(0.8rem, 2vw, 0.95rem);
        }
        .product-pricing h3.new {
            font-size: clamp(0.95rem, 3vw, 1.3rem);
            line-height: 1.3;
        }
        .product-pricing .tax-info {
            font-size: 0.65em;
        }
    </style>
    <script>
        function switchProductGalleryImage(src, thumbElement) {
            var mainImg = document.getElementById('mainProductPreview');
            if (!mainImg) return;
            mainImg.style.opacity = '0.25';
            setTimeout(function() {
                mainImg.src = src;
                mainImg.style.opacity = '1';
            }, 150);

            var thumbs = document.querySelectorAll('.product-thumb-item');
            thumbs.forEach(function(item) {
                item.style.borderColor = '#dee2e6';
                item.classList.remove('active');
            });
            thumbElement.style.borderColor = '#0ab39c';
            thumbElement.classList.add('active');
        }
    </script>
@endsection