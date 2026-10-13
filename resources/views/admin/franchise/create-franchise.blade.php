@extends('admin.layouts.main')
@section('title', 'Create Franchise')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Create Franchise') }}</h5>
                            <span>{{ __('Create new franchise account') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Franchise') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6">
                @if (session()->has('successMsg'))
                    <div class="alert alert-success">{{ session('successMsg') }}</div>
                @endif

                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger">{{ session('failedMsg') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Create Franchise Form') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeFranchise') }}" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="franchise_id">{{ __('Franchise ID') }}</label>
                                <input type="text" class="form-control @error('franchise_id') is-invalid @enderror"
                                    id="franchise_id" name="franchise_id" 
                                    placeholder="Enter franchise id">
                                @error('franchise_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter franchise name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mobile">{{ __('Mobile') }}</label>
                                <input type="number" class="form-control @error('mobile') is-invalid @enderror"
                                    id="mobile" name="mobile" placeholder="Enter mobile number">
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter email address">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="state">{{ __('State') }}</label>
                                <select class="form-control @error('state') is-invalid @enderror" id="state"
                                    name="state">
                                    <option value="">Select state</option>
                                    @foreach ($idata as $state)
                                        <option value="{{ $state->state_name }}"
                                            {{ old('state') == $state->state_name ? 'selected' : '' }}>
                                            {{ $state->state_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <select class="form-control @error('city') is-invalid @enderror"
                                    id="city" name="city">
                                    <option value="">Select city</option>
                                    @foreach ($cdata as $city)
                                        <option value="{{ $city->city }}"
                                            data-state="{{ $cityStateColumn ? ($city->{$cityStateColumn} ?? '') : '' }}"
                                            {{ old('city') == $city->city ? 'selected' : '' }}>
                                            {{ $city->city }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    id="country" name="country" value="India" readonly>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                         
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label for="commission">{{ __('Commission (₹)') }}</label>
                                <input type="number" step="0.01" min="0" class="form-control @error('commission') is-invalid @enderror"
                                    id="commission" name="commission" value="{{ old('commission', 50) }}"
                                    placeholder="Enter commission percentage">
                                @error('commission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" style="float: right"
                                class="btn btn-primary">{{ __('Create Franchise') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            if (!stateSelect || !citySelect) return;

            const defaultOption = citySelect.querySelector('option[value=""]');
            const allCityOptions = Array.from(citySelect.querySelectorAll('option')).filter(option => option.value !== '');
            const oldCity = @json(old('city'));
            let isInitialLoad = true;

            function normalize(value) {
                return (value || '').toString().trim().toLowerCase();
            }

            function refreshCityOptions() {
                const selectedState = normalize(stateSelect.value);
                citySelect.innerHTML = '';

                const firstOption = defaultOption.cloneNode(true);
                citySelect.appendChild(firstOption);

                allCityOptions.forEach(option => {
                    const cityState = normalize(option.dataset.state);

                    if (!selectedState || !cityState || cityState === selectedState) {
                        citySelect.appendChild(option.cloneNode(true));
                    }
                });

                citySelect.disabled = !selectedState;

                if (isInitialLoad && oldCity) {
                    const matchedOld = Array.from(citySelect.options).find(option => option.value === oldCity);
                    if (matchedOld) {
                        citySelect.value = oldCity;
                    }
                }

                isInitialLoad = false;
            }

            stateSelect.addEventListener('change', function() {
                citySelect.value = '';
                refreshCityOptions();
            });

            refreshCityOptions();
        })();
    </script>
@endsection
