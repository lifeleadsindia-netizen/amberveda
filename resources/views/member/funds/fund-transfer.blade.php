@extends('member.layouts.main2')
@section('title', 'Fund Transfer')
@section('container')
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Fund Transfer</h4>
                            </div>
                        </div>
                    </div>
                    <div class="page-content-wrapper py-3">
                        <div class="container">
                            <div class="row justify-content-left">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="standard-tab">
                                                <div class="tab-content rounded-lg" id="affanTabs1Content">
                                                    <div class="tab-pane fade active show" id="bootstrap"
                                                        role="tabpanel" aria-labelledby="bootstrap-tab">
                                                        <div class="invoice-table">
                                                            <div>
                                                                <div class="col-xl-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Select Wallet</label>
                                                                        <select class="form-select" id="ddlWallet">
                                                                            <option value="">Select Wallet
                                                                            </option>
                                                                            <option value="Income">EVG 0.00</option>
                                                                            <option value="Nominee">Partner 0.00
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Amount</label>
                                                                        <input name="ctl00$main$Amount" type="text"
                                                                            id="main_Amount" autocomplete="off"
                                                                            class="form-control mb-1"
                                                                            placeholder="Enter Amount" />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fs-md">Note: </label>
                                                                        <span class="fs-md">Transfer Charge will be
                                                                            applicable 0%.</span>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group col-xl-4 mt-3">
                                                                    <button type="button" id="btncnf2"
                                                                        onclick="Confirm()"
                                                                        class="btn btn-info">Submit</button>
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
                    </div>
                </div>
            </div>


        </div>
    </div>
    <button class="btn btn-dark btn-icon" id="back-to-top">
        <i class="bi bi-caret-up fs-3xl"></i>
    </button>

    <script src="{{asset('userassets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('userassets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('userassets/js/plugins.js')}}"></script>
    <script src="{{asset('userassets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('userassets/libs/list.js')}}/list.min.js')}}"></script>
    <script src="{{asset('userassets/libs/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('userassets/js/pages/dashboard-analytics.init.js')}}"></script>
    <script src="{{asset('userassets/js/pages/dashboard-ecommerce.init.js')}}"></script>

    <script src="{{asset('userassets/libs/prismjs/prism.js')}}"></script>
    <script src="{{asset('userassets/js/pages/swiper.init.js')}}"></script>
    <script src="{{asset('userassets/js/app.js')}}"></script>


    <script src="{{asset('userassets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js')}}">
    </script>
    <script type="text/javascript" language="javascript"
        src="//cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js')}}"></script>
    <script type="text/javascript" language="javascript"
        src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js')}}"></script>

    <script type="text/javascript" src="//cdn.js')}}delivr.net/npm/toastify-js"></script>
    <script src="{{asset('userassets/js/custom.js')}}"></script>
    <script>
        CartQty();

        function CartQty() {
            (document.querySelector(".hamburger-icon").classList.remove("open"))
            $('#CartQty')
                .html('<i class="fa fa-spin fa-spinner" style="font-size:10px !important"></i>').load(
                    "services/CartQty.ashx");
        }

        function cLogout() {
            $('#logoutModal').modal('show');
        }

        function logout() {
            window.location.href = '/uLogout';
        }
    </script>


    <script>
        $("[id*=Amount]").keypress(function(event) {
            return isNumber(event, this)
        });

        function isNumber(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (
                (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
                (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function Confirm() {
            if ($("[id*=ddlWallet]").val() == '') {
                toastr('Please select sending Wallet.', 'w');

                return;
            }
            if ($("[id*=Amount]").val() == '') {
                toastr('Amount is required.', 'w');

                return;
            }
            $('#btncnf2').html('Please wait...').attr('disabled', true);
            var CrFrm = new FormData();
            CrFrm.append("amt", $("#Amount").val());
            CrFrm.append("wallet", $("#ddlWallet").val());
            $.ajax({
                url: "services/FundTransfer.ashx",
                type: "POST",
                contentType: false,
                processData: false,
                data: CrFrm,
                dataType: "json",
                success: function(Response) {
                    if (Response.Success) {
                        $('#btncnf2').html('Submit').attr('disabled', false);
                        toastr(Response.Message, 's');

                        $("[id*=Amount]").val('');
                        $("[id*=ddlWallet]").val('');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $('#btncnf2').html('Submit').attr('disabled', false);
                        toastr(Response.Message, 'w');

                    }
                },
                error: function(err) {
                    $('#btncnf2').html('Submit').attr('disabled', false);
                    toastr(err.statusText, 'w');

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
                    © My Evinnko Global (P) Limited.
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
@endsection