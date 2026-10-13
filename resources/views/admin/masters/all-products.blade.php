@extends('admin.layouts.main')
@section('title', 'All Products')
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
                            <h5>{{ __('All Products') }}</h5>
                            <span>{{ __('All Products') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('All Products') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('All Products Details') }}</h3>
                    </div>
                    <div class="card-body px-5">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('S.No') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Distributor Price') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><img src="{{ asset('uploads') }}/{{ $list['image'] }}" alt=""
                                                width="50"> </td>
                                        <td>{{ __(categoryName($list['cat_id'])) }}</td>
                                        <td>{{ __($list['product']) }}</td>
                                        <td>{{ __($list['quantity']) }}</td>
                                        <td>₹{{ __($list['distributor_price']) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center" style="gap: 6px;">
                                                <a class="btn btn-primary"
                                                    href="{{ url('admin/update-products') }}/{{ $list['id'] }}">Edit
                                                    /View</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/form-components.js') }}"></script>
        <script>
            // getting product data
            $('#category').change(function() {
                var cat_id = $('#category').val();
                let token = $('#csrf').val();
                $.ajax({
                    url: '/getBrand',
                    type: 'post',
                    data: {
                        '_token': token,
                        'cat_id': cat_id
                    },
                    success: function(result) {
                        $('#brand').html(result);
                    },
                    error: function() {
                        alert('error');
                    }
                });
            });
        </script>
    @endpush

@endsection
