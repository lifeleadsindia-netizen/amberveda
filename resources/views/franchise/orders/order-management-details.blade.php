@extends('franchise.layouts.main')
@section('title', 'Order Management Details')
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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('franchise.order.details') }}" style="text-decoration: none;">Order
                                        Details</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Order Management Details</li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Order Management Details</h4>
                </div>
            </div>
        </div>

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

        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title mb-3">Order Info</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th>Franchise ID</th>
                                        <td>{{ $order->franchise_id }}</td>
                                    </tr>
                                    <tr>
                                        <th width="35%">Order Date</th>
                                        <td>{{ date('d-m-Y h:i:s A', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order ID</th>
                                        <td>{{ $order->order_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Invoice No</th>
                                        <td>{{ $order->invoice_no ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Member ID</th>
                                        <td>{{ $order->memberid }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td>{{ $productName ?? $order->pro_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $order->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>₹ {{ $order->price }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>₹ {{ $order->total_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="btn btn-sm btn-success">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm" style="background-image: url({{ asset('/logo/bg.jpeg') }})">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="header-title text-white mb-0">Member Address</h5>
                            <i class="mdi mdi-map-marker-radius h3 mb-0"></i>
                        </div>

                        <div class="mb-2">
                            <h4 class="fw-semibold">City - {{ $member->city }}</h4>
                        </div>
                        <div class="mb-2">
                            <small class="d-block" style="opacity: .8;"></small>
                            <h4 class="fw-semibold">State - {{ $member->state }}</h4>
                        </div>
                        <div class="mb-0">
                            <small class="d-block" style="opacity: .8;"></small>
                            <h4 class="fw-semibold">
                                Address - {{ $member->address }}
                            </h4>
                        </div>
                    </div>
                </div>
                @if ($order->status != 'Pending')
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="header-title mb-3">Delivery Remark</h5>
                            <p>{{ $order->remark ?? 'No remark found for this order.' }}</p>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h5 class="header-title mb-3">Order Details</h5>
                            <form action="{{ route('franchise.update.order.status') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Order ID</label>
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="text" class="form-control" value="{{ $order->order_id }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Order Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="">Select status</option>
                                        <option value="Delivered"
                                            {{ old('status', $order->status) == 'Delivered' ? 'selected' : '' }}>
                                            Delivered
                                        </option>
                                        <option value="Undelivered"
                                            {{ old('status', $order->status) == 'Undelivered' ? 'selected' : '' }}>
                                            Undelivered
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Remark</label>
                                    <textarea name="remark" rows="5" class="form-control @error('remark') is-invalid @enderror"
                                        placeholder="Write remark about this order">{{ old('remark', $order->remark ?? '') }}</textarea>
                                    @error('remark')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary float-end">Save Order</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
