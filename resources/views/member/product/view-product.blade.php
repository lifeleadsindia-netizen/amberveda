@extends('member.layouts.main')
@section('title', 'View Product')
@section('container')
    <link href="{{ asset('adm_assets/vendor/datatables/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adm_assets/vendor/datatables/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">View Product</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">View Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                @php
                                    $galleryImages = [];
                                    $imgKeys = ['image', 'image2', 'image3'];
                                    foreach ($imgKeys as $imgKey) {
                                        if (!empty($pData[$imgKey])) {
                                            $val = $pData[$imgKey];
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
                                             alt="{{ $pData['product'] }}"
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
                                <form class="ps-lg-4">
                                    <!-- Product title -->
                                    <h3 class="mt-0">{{ $pData['product'] }} </h3>
                                    <p class="mb-1">Added Date: {{ date('d/m/Y', strtotime($pData['created_at'])) }}</p>
                                    <p class="font-16">
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                    </p>

                                    <!-- Product stock -->
                                    <div class="mt-3">
                                        <h4><span class="badge badge-success-lighten">Instock</span></h4>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Price:</h6>
                                        <h3> ₹{{ $pData['bv'] }}</h3>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Quantity</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="input-group me-2" style="width: 140px;">
                                                <button class="btn btn-outline-secondary px-2" type="button"
                                                    onclick="var inp = this.nextElementSibling; if(parseInt(inp.value || 1) > 1) { inp.value = parseInt(inp.value) - 1; }">-</button>
                                                <input type="number" min="1" value="1"
                                                    class="form-control text-center" placeholder="Qty">
                                                <button class="btn btn-outline-secondary px-2" type="button"
                                                    onclick="var inp = this.previousElementSibling; inp.value = parseInt(inp.value || 0) + 1;">+</button>
                                            </div>
                                            <button type="button" class="btn btn-danger"><i class="mdi mdi-cart me-1"></i>
                                                Add to cart</button>
                                        </div>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Description:</h6>
                                        <p>{{ $pData['about'] }} </p>
                                    </div>

                                    <!-- Product information -->
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="font-14">Available Stock:</h6>
                                                <p class="text-sm lh-150">1784</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">Number of Orders:</h6>
                                                <p class="text-sm lh-150">5,458</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">Revenue:</h6>
                                                <p class="text-sm lh-150">$8,57,014</p>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end row-->

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="bg-light bg-opacity-50 thead-sm">
                                    <tr>
                                        <th>Outlets</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ASOS Ridley Outlet - NYC</td>
                                        <td>$139.58</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">478 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 56%;" aria-valuenow="56" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$1,89,547</td>
                                    </tr>
                                    <tr>
                                        <td>Marco Outlet - SRT</td>
                                        <td>$149.99</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">73 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 16%;" aria-valuenow="16" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$87,245</td>
                                    </tr>
                                    <tr>
                                        <td>Chairtest Outlet - HY</td>
                                        <td>$135.87</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">781 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 72%;" aria-valuenow="72" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$5,87,478</td>
                                    </tr>
                                    <tr>
                                        <td>Nworld Group - India</td>
                                        <td>$159.89</td>
                                        <td>
                                            <div class="progress-w-percent mb-0">
                                                <span class="progress-value">815 </span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 89%;" aria-valuenow="89" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$55,781</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->


    </div>
    <!-- container -->

    </div>
    <!-- content -->



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