@extends('admin.layouts.main')
@section('title', 'Create Cities')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-map-pin bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Create Cities') }}</h5>
                            <span>{{ __('Add and manage cities') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Cities') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                @if (session()->has('successMsg'))
                    <div class="alert alert-success">{{ session('successMsg') }}</div>
                @endif
                @if (session()->has('failedMsg'))
                    <div class="alert alert-danger">{{ session('failedMsg') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Create City') }}</h3>
                    </div>
                    <div class="card-body px-4">
                        <form action="{{ route('storeCity') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="state">{{ __('State') }} <span class="text-danger">*</span></label>
                                <select class="form-control @error('state') is-invalid @enderror" id="state"
                                    name="state">
                                    <option value="">{{ __('Select state') }}</option>
                                    @foreach ($states as $state)
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
                                <label for="city">{{ __('City') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city" name="city" value="{{ old('city') }}"
                                    placeholder="Enter city name">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary float-right">{{ __('Create City') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('All Cities') }}</h3>
                    </div>
                    <div class="card-body px-5" style="overflow: auto">
                        <div class="responsive">
                            <table id="data_table" class="table">
                                <thead>
                                    <tr>
                                        <th width="80">{{ __('S.No') }}</th>
                                        <th>{{ __('State') }}</th>
                                        <th>{{ __('City') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $list)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $list['state'] }}</td>
                                            <td>{{ $list['city'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">{{ __('No cities found.') }}</td>
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
