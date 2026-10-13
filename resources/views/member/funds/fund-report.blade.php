@extends('member.layouts.main')
@section('title', 'Fund Report')
@section('container')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Fund History</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">

                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped" style="width:100%">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">S.No </th>
                                                        <th scope="col">Date </th>
                                                        <th scope="col">Memberid </th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Transaction No</th>
                                                        <th scope="col">Iamge</th>
                                                        <th scope="col">Status</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($passdata as $list)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($list['date'])) }}</td>
                                                            <td>{{ $list['memberid'] }}</td>
                                                            <td>₹ {{ $list['amount'] }}</td>
                                                            <td>{{ $list['tran_id'] }}</td>
                                                            <td><img src="{{ asset('uploads') }}/{{ $list['image'] }}"
                                                                    height="60"></td>
                                                            <td>
                                                                @if ($list['status'] == 'Requested')
                                                                    <div class="btn btn-sm btn-primary">{{ $list['status'] }}</div>
                                                                @elseif ($list['status'] == 'Cancelled')
                                                                    <div class="btn btn-sm btn-danger">{{ $list['status'] }}</div>
                                                                @else
                                                                    <div class="btn btn-sm btn-success">{{ $list['status'] }}</div>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

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

    <script src="{{ asset('userassets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('userassets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('userassets/js/plugins.js') }}"></script>
    <script src="{{ asset('userassets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('userassets/libs/list.js') }}/list.min.js')}}"></script>
    <script src="{{ asset('userassets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('userassets/js/pages/dashboard-analytics.init.js') }}"></script>
    <script src="{{ asset('userassets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <script src="{{ asset('userassets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('userassets/js/pages/swiper.init.js') }}"></script>
    <script src="{{ asset('userassets/js/app.js') }}"></script>


    <script src="{{ asset('userassets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js')}}">
    </script>
    <script type="text/javascript" language="javascript"
        src="//cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js')}}"></script>
    <script type="text/javascript" language="javascript"
        src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js')}}"></script>

    <script type="text/javascript" src="//cdn.js')}}delivr.net/npm/toastify-js"></script>
    <script src="{{ asset('userassets/js/custom.js') }}"></script>
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
        $(document).ready(function() {
            searchRequest();
        });

        function searchRequest() {
            var dataTable = $('#datatableDefault').DataTable();
            dataTable.clear();
            $.fn.dataTable.ext.errMode = 'none';
            $('#datatableDefault').DataTable({
                dom: "<'row'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
                lengthMenu: [10, 20, 30, 40, 50, 100],
                responsive: true,
                bLengthChange: false,
                bAutoWidth: false,
                processing: true,
                serverSide: true,
                pageLength: 100,
                destroy: true,
                filter: false,
                buttons: [{
                        extend: 'print',
                        className: 'btn btn-default'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-default'
                    }
                ],
                "ajax": {
                    "url": "services/getFundRequest.ashx?date1=" + $("#date1").val() + "&date2=" + $("#date2")
                        .val() + "&s=" + $("#accstatus").val() + "&mode=" + $("#ddlMode").val(),
                    "type": "POST"
                },
                "columns": [{
                        "data": "Date"
                    },
                    {
                        "data": "Amount"
                    },
                    {
                        "data": "TranHash"
                    },
                    {
                        "data": "Status"
                    },
                    {
                        "data": "Mode"
                    },
                    {
                        "data": "userAction"
                    }
                ]
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
