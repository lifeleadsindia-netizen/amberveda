@extends('admin.layouts.main')
@section('title', 'Inventory Details')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Inventory Details') }}</h5>
                            <span>{{ __('Inventory Details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Inventory Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                @if (session()->has('wMessage'))
                    <div class="alert alert-primary">{{ session('wMessage') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Inventory Details') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <div class="responsive">
                            <table id="data_table" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Product Name') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Prize') }}</th>
                                        <th>{{ __('Issued Inventory') }}</th>
                                        <th>{{ __('Delevered Inventory') }}</th>
                                        <th>{{ __('Current Inventory') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product as $index => $item)
                                    @php
                                        $issued = issuedInventory($data->franchise_id, $item->id);
                                        $delivered = deliveredInventory($data->franchise_id ?? '', $item->id);
                                        $current = $issued - $delivered ?? 0;
                                    @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->product }}</td>
                                            <td>{{ $item->quantity }}</td>
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

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
    @endpush
@endsection
