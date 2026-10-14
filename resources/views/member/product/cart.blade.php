@extends('member.layouts.main')
@section('title', 'Cart Details')
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
                                        style="text-decoration: none">Cart Details</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Cart Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            @if (session('failedMsg'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ session('failedMsg') }}',
                        confirmButtonText: 'Ok'
                    });
                </script>
            @endif
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="my-2 card-title">Cart Details</h4>
                                    <input type="hidden" id="csrf" value="{{ csrf_token() }}">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- start page title -->
                        <div class="row justify-content-center">
                            <div class="col-xxl-12 col-lg-12 col-md-12">
                                <div class="table-responsive card-body">
                                    <table class="table mb-0 text-center align-middle">
                                        <thead>
                                            <tr>
                                                {{-- <th class="pt-0 pb-2">S.No.</th> --}}
                                                <th class="pt-0 pb-2 text-start ps-2" style="min-width: 220px;">Product</th>
                                                <th class="pt-0 pb-2 text-end">Price</th>
                                                <!--<th class="pt-0 pb-2 text-center">PV</th>-->
                                                <th class="pt-0 pb-2 text-center">Qty</th>
                                                <th class="pt-0 pb-2 text-center">Amount</th>
                                                <th class="pt-0 pb-2 text-end pe-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pList">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="pt-2 pb-2 text-center font-weight-600" colspan="2">
                                                    <h6>Total</h6></td>
                                                {{-- <td class="pt-2 pb-2 text-center font-weight-600" colspan="1">
                                                    </td> --}}
                                                <!--<td class="pt-2 pb-2 text-center font-weight-600" colspan="1"-->
                                                <!--    id="totBV">0-->
                                                <!--</td>-->
                                                <td class="pt-2 pb-2 text-center font-weight-600" colspan="1"
                                                    id="totQty">0
                                                </td>
                                                <td class="pt-2 pb-2 text-center font-weight-600" colspan="1">
                                                    <h6>Grand Total (Price + GST)</h6></td>
                                                <td class="pt-2 pb-2 text-end font-weight-600" colspan="1"
                                                    id="totAmount">0
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="coupon-form">
                                        <span id="contiBtn2Shop"></span>
                                        <div class="row">
                                            <!-- Checkout -->
                                            <div class="col-6">
                                                <a href="{{ url('/member/account-activation') }}"
                                                    class="btn btn-secondary w-100 mt-4" id="contiBtnShop">Continue
                                                    Shopping</a>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-primary w-100 mt-4" href="{{ url('/member/checkout') }}"
                                                    id="addBtnAddress" onclick="CheckoutStep1()">Checkout</a>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bottom-align-modal" id="addConfirmPrdMdl" tabindex="-1" aria-labelledby="bottomAlignModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-end">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="fullscreenModalLabel">Confirmation</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="txtmodel"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">No</button>
                    <span id="dbtn"></span>
                </div>
            </div>
        </div>
    </div>
    <input id="mpId" type="hidden" />
    <input id="mqty" type="hidden" />

    </div>


    </div>
    <button class="btn btn-dark btn-icon" id="back-to-top">
        <i class="bi bi-caret-up fs-3xl"></i>
    </button>



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


    <script>
        Cart();

        function Cart() {
            var plItem = $('#pList');
            $('#pList').html(
                '<tr><td colspan="10"><center class="p-5 w-100"><div class="spinner-border spinner-border-sm text-primary"></div> fetching cart..</center></tr></td>'
            );
            let token = $('#csrf').val();
            setTimeout(function() {
                $.ajax({
                    type: "post",
                    url: '/member/getCart',
                    data: {
                        '_token': token,
                    },
                    // contentType: 'application/json',
                    success: function(Response) {
                        if (Response != '') {
                            $('#pList').html(Response['itext']);
                            $('#totQty').html(Response['totQty']);
                            $('#totBV').html(Response['totBV'] + ' PV');
                            $('#totAmount').html('₹ ' + Response['totAmount']);
                        } else {
                            var Category = "<tr>";
                            Category = Category +
                                "<td colspan='10'><h3 class='text-muted text-center p-5'>Cart is empty</h3></td>";
                            Category = Category + "</tr>";
                            $('#totQty').html(0);
                            $('#totBV').html('0');
                            $('#totAmount').html('0');
                            var BtnAddress;
                            $("#addBtnAddress").hide();
                            $("#contiBtnShop").hide();
                            $("#contiBtn2Shop").html(
                                "<div class='row col-12'><a href='{{ url('member/account-activation') }}' class='btn btn-primary w-100 mt-4'>Continue Shopping</a></div>"
                            );
                            $("#pList").html(Category);
                        }
                    }
                });
            }, 1500);
        }

        function DeleteCartItem(id) {
            if (confirm('Do you want to delete this item from cart?')) {
                var orderId = id;
                // alert(orderId);
                let token = $('#csrf').val();
                // var loginFrm = new FormData();
                // loginFrm.append("ProductId", id);
                //$.blockUI({ message: '<div class="spinner-border text-light"></div>' });
                $.ajax({
                    url: "/member/deleteCartItem",
                    type: "POST",
                    data: {
                        '_token': token,
                        'order_id': orderId
                    },
                    success: function(Response) {
                        code = Response['code'];
                        data = Response['data'];
                        $('#countCart').html(Response['qty']);
                        $('.noti-icon-badge').html(Response['qty']);
                        if (code == 1) {
                            Cart();
                            toastr(data, 's');
                        } else {
                            toastr(data, 'w');
                        }
                    },
                    error: function(err) {
                        toastr(Response.Message, 'w');
                    }
                });
            }
        }
        function recalculateCart() {
            var totalQty = 0;
            var grandTotal = 0;

            $('.cart-qty').each(function () {
                var $input = $(this);
                var qty = parseInt($input.val(), 10);
                if (isNaN(qty) || qty < 1) {
                    qty = 1;
                }
                var price = parseFloat($input.data('price')) || 0;
                var totalUnit = parseFloat($input.data('total-unit'));
                if (isNaN(totalUnit)) {
                    var gst = parseFloat($input.data('gst')) || 0;
                    totalUnit = price + gst;
                }

                totalQty += qty;
                grandTotal += totalUnit * qty;
            });

            $('#totQty').text(totalQty);
            $('#totAmount').text('₹ ' + grandTotal.toFixed(2));
        }

        var updateTimers = {};
        var pendingRequests = {};

        function sendCartUpdate(itemId, quantity) {
            if (pendingRequests[itemId]) {
                pendingRequests[itemId].abort();
            }

            pendingRequests[itemId] = $.ajax({
                url: '/member/updateCartQuantity',
                type: 'POST',
                data: {
                    '_token': $('#csrf').val(),
                    'itemId': itemId,
                    'quantity': quantity
                },
                success: function (response) {
                    delete pendingRequests[itemId];
                },
                error: function (err) {
                    delete pendingRequests[itemId];
                }
            });
        }

        function applyQtyUpdate($input, qty) {
            // 1. Live Row Amount = Unit Price × Quantity
            var price = parseFloat($input.data('price')) || 0;
            var rowAmount = price * qty;
            $input.closest('tr').find('.row-amount').text('₹ ' + rowAmount.toFixed(2));

            // 2. Live Total Quantity & Grand Total (Price + GST)
            recalculateCart();

            // 3. Persist to backend
            var itemId = $input.data('id');
            if (updateTimers[itemId]) {
                clearTimeout(updateTimers[itemId]);
                delete updateTimers[itemId];
            }
            sendCartUpdate(itemId, qty);
        }

        function changeQty(btn, delta) {
            var $btn = $(btn);
            var $input = $btn.siblings('.cart-qty');
            if (!$input.length) {
                $input = $btn.closest('td').find('.cart-qty');
            }
            var currentVal = parseInt($input.val(), 10) || 1;
            var newVal = currentVal + delta;
            if (newVal < 1) {
                newVal = 1;
            }
            $input.val(newVal);
            applyQtyUpdate($input, newVal);
        }

        function handleQtyChange(input) {
            var $input = $(input);
            var rawVal = $input.val();
            var qty = parseInt(rawVal, 10);
            if (isNaN(qty) || qty < 1) {
                return;
            }
            applyQtyUpdate($input, qty);
        }

        function handleQtyBlur(input) {
            var $input = $(input);
            var rawVal = $input.val();
            var qty = parseInt(rawVal, 10);
            if (isNaN(qty) || qty < 1) {
                $input.val(1);
                qty = 1;
            }
            applyQtyUpdate($input, qty);
        }

        // Ensure checkout receives updated quantity
        $(document).on('click', '#addBtnAddress', function (e) {
            for (var id in updateTimers) {
                if (updateTimers.hasOwnProperty(id)) {
                    clearTimeout(updateTimers[id]);
                    var currentQty = parseInt($('.cart-qty[data-id="' + id + '"]').val(), 10) || 1;
                    sendCartUpdate(id, currentQty);
                }
            }

            var running = [];
            for (var reqId in pendingRequests) {
                if (pendingRequests.hasOwnProperty(reqId) && pendingRequests[reqId]) {
                    running.push(pendingRequests[reqId]);
                }
            }

            if (running.length > 0) {
                e.preventDefault();
                var targetUrl = $(this).attr('href');
                $.when.apply($, running).always(function () {
                    window.location.href = targetUrl;
                });
            }
        });
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
