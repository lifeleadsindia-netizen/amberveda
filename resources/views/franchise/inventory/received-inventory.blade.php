@extends('franchise.layouts.main')
@section('title', 'Received Inventory')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('franchise_panel/dashboard') }}" style="text-decoration: none;">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Received Inventory</li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Received Inventory</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title mb-3">Received Inventory History</h5>
                        <div class="table-responsive" style="overflow: auto">
                            <table id="basic-datatable" class="table  nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Franchise ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($issues as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item['created_at'])) }}<br>{{ date('h:i:s', strtotime($item['created_at'])) }}</td>
                                            <td>{{ $item->franchise_id }}</td>
                                            <td>{{ $item->product }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>₹ {{ $item->price }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No received inventory records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
