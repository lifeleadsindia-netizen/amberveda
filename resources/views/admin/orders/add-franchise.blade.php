@extends('admin.layouts.main')
@section('title', 'Add Franchise')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Franchise') }}</h5>
                            <span>{{ __('Add Franchise') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add Franchise') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Add Franchise Form') }}</h3>
                    </div>
                    <div class="card-body">
                        @if (session()->has('successMsg'))
                            <div class="alert alert-success">{{ session('successMsg') }}</div>
                        @endif
                        @if (session()->has('failedMsg'))
                            <div class="alert alert-danger">{{ session('failedMsg') }}</div>
                        @endif

                        <form method="POST" action="{{ route('addFranchiseStore') }}">
                            @csrf
                            <input type="hidden" name="order_detail_id" value="{{ $order->id ?? '' }}">
                            <div class="form-group">
                                <label for="order_id">{{ __('Order ID') }}</label>
                                <input type="text" id="order_id" class="form-control"
                                    value="{{ $order->order_id ?? '' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="product">{{ __('Product') }}</label>
                                <input type="text" id="product" class="form-control"
                                    value="{{ $data->product ?? '' }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="franchise_id">{{ __('Franchise ID') }}</label>
                                <select class="form-control" id="franchise_id" name="franchise_id" required>
                                    <option value="">{{ __('Select Franchise ID') }}</option>
                                    @foreach ($fdata as $franchise)
                                        <option value="{{ $franchise->franchise_id }}" data-name="{{ $franchise->name }}"
                                            data-mobile="{{ $franchise->mobile }}" data-email="{{ $franchise->email }}"
                                            data-city="{{ $franchise->city }}" data-state="{{ $franchise->state }}"
                                            data-status="{{ $franchise->status }}"
                                            {{ old('franchise_id') == $franchise->franchise_id ? 'selected' : '' }}>
                                            {{ $franchise->franchise_id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('franchise_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="franchiseDetailBox" class="alert alert-warning d-none">
                                <strong>Selected Franchise Details:</strong>
                                <div id="franchiseDetailText" class="mt-1"></div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">{{ __('Add Franchise') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function() {
            const franchiseSelect = document.getElementById('franchise_id');
            const detailBox = document.getElementById('franchiseDetailBox');
            const detailText = document.getElementById('franchiseDetailText');

            function setFranchiseDetails() {
                const selectedOption = franchiseSelect.options[franchiseSelect.selectedIndex];
                if (!selectedOption || !selectedOption.value) {
                    detailBox.classList.add('d-none');
                    detailText.innerHTML = '';
                    return;
                }

                const franchiseId = selectedOption.value || '';
                const name = selectedOption.dataset.name || '';
                const mobile = selectedOption.dataset.mobile || '';
                const email = selectedOption.dataset.email || '';
                const city = selectedOption.dataset.city || '';
                const state = selectedOption.dataset.state || '';
                const status = selectedOption.dataset.status || '';

                detailText.innerHTML =
                    'ID: <b>' + franchiseId + '</b> | Name: <b>' + name + '</b> | Mobile: <b>' + mobile +
                    '</b> | Email: <b>' + email + '</b> | City: <b>' + city + '</b> | State: <b>' + state +
                    '</b> | Status: <b>' + status + '</b>';
                detailBox.classList.remove('d-none');
            }

            franchiseSelect.addEventListener('change', setFranchiseDetails);
            setFranchiseDetails();
        })();
    </script>
@endpush
