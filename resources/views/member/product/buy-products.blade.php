@extends('member.layouts.main')
@section('title', 'Products')
@section('container')
    <link href="{{ asset('adm_assets/vendor/datatables/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adm_assets/vendor/datatables/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, rgba(226, 226, 226, 1) 0%, rgba(219, 219, 219, 1) 50%, rgba(209, 209, 209, 1) 50%, rgba(209, 209, 209, 1) 50%, rgba(254, 254, 254, 1) 100%) center/cover no-repeat;
            min-height: 100vh
        }

        .card {
            max-width: 300px;
            max-height: 510px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
            transition: .3s;
            font-family: 'Segoe UI', sans-serif;
            margin: 20px auto;
            overflow: hidden;
            position: relative;
            cursor: pointer
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15)
        }

        .badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(to right, rgba(169, 3, 41, 1) 0%, rgba(196, 72, 72, 1) 44%, rgba(170, 34, 56, 1) 100%);
            color: #fff;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
            z-index: 10
        }

        .tilt {
            overflow: hidden
        }

        .img {
            height: 250px;
            overflow: hidden
        }

        .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s
        }

        .card:hover .img img {
            transform: scale(1.05)
        }

        .info {
            padding: 20px
        }

        .cat {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #71717A;
            margin-bottom: 5px
        }

        .title {
            font-size: 18px;
            font-weight: 700;
            color: #18181B;
            margin: 0 0 10px;
            letter-spacing: -.5px
        }

        .desc {
            font-size: 13px;
            color: #52525B;
            line-height: 1.4;
            margin-bottom: 12px
        }

        .feats {
            display: flex;
            gap: 6px;
            margin-bottom: 15px
        }

        .feat {
            font-size: 10px;
            background: #F4F4F5;
            color: #71717A;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: 500
        }

        .bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px
        }

        .price {
            display: flex;
            flex-direction: column
        }

        .old {
            font-size: 13px;
            text-decoration: line-through;
            color: #A1A1AA;
            margin-bottom: 2px
        }

        .new {
            font-size: 20px;
            font-weight: 700;
            color: #18181B
        }

        .btn {
            background: linear-gradient(45deg, #18181B, #27272A);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 15px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: .3s;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .1)
        }

        .btn:hover {
            background: linear-gradient(45deg, #27272A, #3F3F46);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .15)
        }

        .btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .1), transparent);
            transition: .5s
        }

        .btn:hover:before {
            left: 100%
        }

        .icon {
            transition: transform .3s
        }

        .btn:hover .icon {
            transform: rotate(-10deg) scale(1.1)
        }

        .meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #F4F4F5;
            padding-top: 12px
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 2px
        }

        .rcount {
            margin-left: 6px;
            font-size: 11px;
            color: #71717A
        }

        .stock {
            font-size: 11px;
            font-weight: 600;
            color: #22C55E
        }

        @media (max-width:400px) {
            .card {
                width: 90%
            }

            .title {
                font-size: 16px
            }

            .img {
                height: 180px
            }

            .bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px
            }

            .price {
                margin-bottom: 5px
            }

            .btn {
                width: 100%;
                justify-content: center
            }
        }
    </style>
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
                                        style="text-decoration: none">Products</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Products</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            {{-- @if (session()->has('successMsg'))
                <div class="alert bg-success text-white" role="alert">
                    {{ session('successMsg') }}
                </div>
            @endif --}}
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
            @foreach ($products as $item)
                @php
                    // $quantity = getProductQuantity($item['id'], $data->city, $data->state);
                @endphp

                <div class="col-md-4">
                    <div class="card">
                        <div class="badge">HOT SALE</div>
                        <div class="tilt">
                            <div class="img"><img src="{{ asset('uploads') }}/{{ $item['image'] }}" alt="Product Image">
                            </div>
                        </div>
                        <div class="info">
                            <div class="cat">High-Rated Product</div>
                            <h2 class="title">{{ $item['product'] }}</h2>
                            <p class="desc">{{ $item['about'] }}</p>
                            <div class="feats">
                                <span class="feat">Best Quality</span>
                                <span class="feat">Affordable Price</span>
                            </div>
                            <div class="bottom">
                                <div class="price">
                                    <span class="old">MRP ₹{{ number_format($item['product_price'], 0) }}</span>
                                    <span class="new">DP ₹{{ number_format($item['distributor_price'], 0) }}</span>
                                    <p class="tax-info">(INCL OF ALL TAXES)</p>
                                </div>
                                {{-- <form action="{{ route('addToCart') }}" method="POST"> --}}
                                @csrf
                                <input type="hidden" name="pro_id" value="{{ $item['id'] }}">
                                <a href="{{ url('member/product-details') }}/{{ $item['id'] }}">
                                    @if ($item->quantity > 0)
                                        <button type="submit" class="btn">
                                            <span>View</span>
                                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4" />
                                                <line x1="3" y1="6" x2="21" y2="6" />
                                                <path d="M16 10a4 4 0 01-8 0" />
                                            </svg>
                                        </button>
                                    @endif
                                </a>
                                {{-- </form> --}}

                            </div>
                            <div class="meta">
                                <div class="rating">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700"
                                        stroke-width="0.5">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700"
                                        stroke-width="0.5">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700"
                                        stroke-width="0.5">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700"
                                        stroke-width="0.5">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#FFD700" stroke="#FFD700"
                                        stroke-width="0.5">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    <span class="rcount">High Rating</span>
                                </div>
                                @if ($item->quantity > 0)
                                    <div class="stock">In Stock</div>
                                @else
                                    <div class="stock text-danger">Out of Stock</div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end row -->


    </div>
    <!-- container -->

    </div>
    <!-- content -->

@endsection
