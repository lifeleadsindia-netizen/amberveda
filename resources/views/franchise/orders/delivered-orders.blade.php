@extends('franchise.layouts.main')
@section('title', 'Completed Orders')
@section('container')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('franchise_panel/dashboard') }}"
                                        style="text-decoration: none;">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Completed Orders</li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Completed Orders</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if (session()->has('failedMsg'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: @json(session('failedMsg')),
                            confirmButtonText: 'Ok'
                        });
                    </script>
                @endif
                @if (session()->has('successMsg'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: @json(session('successMsg')),
                            confirmButtonText: 'Ok'
                        });
                    </script>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title mb-3">Completed Orders History</h5>
                        <div class="table-responsive" style="overflow: auto">
                            <table id="basic-datatable" class="table  nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Order ID</th>
                                        <th>Member ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item['created_at'])) }}<br>{{ date('h:i:s', strtotime($item['created_at'])) }}
                                            </td>
                                            <td>{{ $item->order_id }}</td>
                                            <td>{{ $item->memberid }}</td>
                                            <td>{{ $products[$item->pro_id] ?? $item->pro_id }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>₹ {{ $item->price }}</td>
                                            <td>
                                                @if ($item['status'] == 'Delivered')
                                                    <span class="btn btn-sm btn-success">{{ $item->status }}</span>
                                                @else
                                                    <span class="btn btn-sm btn-info">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('franchise.order.management.details', $item->id) }}"
                                                    class="btn btn-sm btn-warning">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($order->isEmpty())
                                <div class="text-center text-muted mt-2">No Completed Orders found.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
