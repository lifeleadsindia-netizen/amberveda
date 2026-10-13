@extends('member.layouts.main')
@section('title', 'Order History')
@section('container')
 
    <!-- Datatables css -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

      <style>
        td{
            text-align:center;
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
                                        style="text-decoration: none">Order History</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Order History</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="col-md-12">
                    @if (session()->has('wMessage'))
                        <div class="alert alert-primary">{{ session('wMessage') }}</div>
                    @endif
                    <div class="card" style="zoom:90%">
                        <div class="card-header">
                            <h4>{{ __('Order History Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="my-datatable" class="table nowrap w-100 text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No.</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">OrderId</th>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Total Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data as $list)
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td class="text-center">
                                                    {{ date('d-m-Y', strtotime($list['created_at'])) }}<br>{{ date('H:i:s', strtotime($list['created_at'])) }}
                                                </td>
                                                <td class="text-center">{{ $list['order_id'] }}</td>
                                                <td class="text-center">{{ getproductName($list['pro_id']) }}</td>
                                                <td class="text-center">₹ {{ $list['price'] }}</td>
                                                <td class="text-center">{{ $list['quantity'] }}</td>
                                                <td class="text-center">₹ {{ $list['total_amount'] }}</td>
                                                <td class="text-center">
                                                    @if ($list['status'] == 'Completed')
                                                        <label class="btn btn-sm btn-success">{{ $list['status'] }}</label>
                                                    @elseif ($list['status'] == 'Pending')
                                                        <label class="btn btn-sm btn-blue">{{ $list['status'] }}</label>
                                                    @else
                                                        <label class="btn btn-sm btn-danger">{{ $list['status'] }}</label>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
    <!-- container -->

    </div>
  
    <!-- content -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <!-- Buttons Extension -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


    <script>
        var token = "{{ csrf_token() }}";
        var table = $('#my-datatable').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"row mb-3"' +
                '<"col-sm-6"l>' +
                '<"col-sm-6 text-end"f>' +
                '>' +
                '<"row mb-3"' +
                '<"col-sm-12"B>' +
                '>' +
                'rtip',
            buttons: [{
                    extend: 'copy',
                    className: 'btn btn-rounded px-3 text-white bg-secondary'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-rounded px-3 text-white bg-info'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-rounded px-3 text-white bg-success'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-rounded px-3 text-white bg-danger'
                },
                {
                    extend: 'print',
                    className: 'btn btn-rounded px-3 text-white bg-primary'
                }
            ],
            responsive: true,
            ajax: {
                url: "{{ route('getOrderHistory') }}",
                method: 'POST',
                data: function(d) {
                    d._token = token;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: 'S.No.',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'order_id',
                    name: 'order_id'
                },
                {
                    data: 'pro_id',
                    name: 'pro_id'
                },
                {
                    data: 'price',
                    name: 'price',
                    render: data => '₹ ' + data
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    render: data => data
                },
                {
                    data: 'total_amount',
                    name: 'total_amount',
                    render: data => '₹ ' + data
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data) {
                        if (data === 'Completed') {
                            return '<span class="btn btn-sm text-white bg-success">' + data + '</span>';
                        } else if (data === 'Pending') {
                            return '<span class="btn btn-sm text-white bg-primary">' + data + '</span>';
                        } else {
                            return '<span class="btn btn-sm text-white bg-danger">' + data + '</span>';
                        }
                    }
                },
                 {
                    data: 'invoice_no',
                    name: 'invoice_no',
                    render: function(data) {
                        return '<a href="{{ url('member/print-invoice') }}/' + data + '" class="btn btn-sm text-white bg-primary">Invoice</a>';
                    }
                },
            ]
        });
    </script>

@endsection
