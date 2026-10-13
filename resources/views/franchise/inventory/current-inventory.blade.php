@extends('franchise.layouts.main')
@section('title', 'Current Inventory')
@section('container')
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
                                <li class="breadcrumb-item active" aria-current="page">Current Inventory</li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Current Inventory</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="header-title mb-3">Current Inventory List</h5>
                        <div class="table-responsive" style="overflow: auto">
                            <table id="basic-datatable" class="table  nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Issued Inventory</th>
                                        <th>Booked Inventory</th>
                                        <th>Current Inventory</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $index => $item)
                                        @php
                                            $issued = issuedInventory($data['franchise_id'], $item->id);
                                            $delivered = deliveredInventory($data['franchise_id'], $item->id);
                                            $current = $issued - $delivered;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->product }}</td>
                                            <td>₹ {{ $item->price }}</td>
                                            <td>{{ $issued }}</td>
                                            <td>{{ $delivered }}</td>
                                            <td>{{ $current }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No inventory records found.</td>
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
