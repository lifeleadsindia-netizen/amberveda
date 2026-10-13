@extends('member.layouts.main')
@section('title', 'Checkout')
@section('container')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">Checkout</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Checkout</h4>
                </div>
            </div>
        </div>

        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <!-- User Meta Data-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                    <h4 class="header-title mb-3">Cart Summary</h4>

                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-centered mb-0">
                                            <tbody id="ordersData">
                                                @if (count($pendOrders) > 0)
                                                    @foreach ($pendOrders as $item)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset('uploads') }}/{{ getProductImage($item['pro_id']) }}"
                                                                    alt="contact-img" title="contact-img"
                                                                    class="rounded me-2" style="height:60px;width:80px">
                                                                <p class="m-0 d-inline-block align-middle">
                                                                    <a
                                                                        class="text-body fw-semibold">{{ getProductName($item['pro_id']) }}</a>
                                                                    <br>
                                                                    <small>({{ $item['quantity'] }} x ₹
                                                                        {{ $item['price'] }}) + GST</small>
                                                                </p>
                                                            </td>
                                                            <td class="text-end">
                                                                ₹ {{ $item['total_amount'] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="text-end">
                                                        <td>
                                                            <h6 class="m-0">Quantity:</h6>
                                                        </td>
                                                        <td class="text-end">
                                                            {{ $total_quantity }}
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr class="text-end">
                                                        <td>
                                                            <h5 class="m-0">Total:</h5>
                                                        </td>
                                                        <td class="text-end fw-semibold">
                                                            ₹ {{ number_format($total_amount, 2) }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="12">No Product Found</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div>
                            </div>

                            <div class="row mt-3 mx-0" style="justify-content: space-between">
                                <div class="col-6 text-start">
                                    <a href="{{ url('/member/account-activation') }}" class="btn text-muted btn-link fw-semibold"
                                        style="color:grey !important">
                                        <i class="mdi mdi-arrow-left"></i> Back to Shopping </a>
                                </div>
                                <div class="col-6 text-end">
                                    <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                                    @if (count($pendOrders) > 0)
                                        <button class="btn btn-primary" type="submit" id="cpay"
                                            onclick="Requestpayment()">Confirm Order</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>



    </div>
    </div>

    <script src="{{ asset('userassets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('userassets/js/custom.js') }}"></script>
    <script type="text/javascript" language="javascript"
        src="//cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js')}}"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js')}}"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
    
        function Requestpayment() {
            var totAmount = parseFloat($('#totAmount').html());
            var walBalance = parseFloat($('#walBalance').val());
            let token = $('#csrf').val();
            $("#cpay").html(
                '<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>'
            ).attr('disabled', true);
            $.ajax({
                url: "/member/finalCheckout",
                type: "POST",
                data: {
                    '_token': token,
                },
                success: function(Response) {
                    code = Response['code'];
                    data = Response['data'];
                    if (code == 1) {
                        $('#ordersData').html(`<tr> <td colspan="12">All Product Purchased.</td> </tr>`);
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations!',
                            text: data,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/member/account-activation"
                            }
                            setTimeout(() => {
                                window.location.href = "/member/account-activation"
                            }, 200);
                        });;
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data,
                            confirmButtonText: 'Try Again'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#cpay").html('Confirm Order').attr('disabled', false);
                            }
                            setTimeout(() => {
                                $("#cpay").html('Confirm Order').attr('disabled', false);
                            }, 200);
                        });

                    }
                },
                error: function(err) {
                    //alert('error');
                     Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something error in this code',
                    });
                    $("#cpay").html('Confirm Order').attr('disabled', false);
                }
            });
        }
    </script>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    © {{ config('detailsApp.name') }}.
                </div>
            </div>
        </div>
    </footer>
    </body>

    </html>
@endsection
