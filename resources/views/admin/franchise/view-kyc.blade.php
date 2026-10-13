@extends('admin.layouts.main')
@section('title', 'View KYC Deatils')
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('KYC Details') }}</h5>
                            <span>{{ __('Franchise KYC and Kyc updates') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('KYC Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if (session()->has('successMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('successMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5>KYC Details</h5>
                        @if ($mdata['kyc_status'] == 'Verified')
                        @else
                            <a href="{{ url('admin/franchise/kyc/verify') }}/{{ $mdata['id'] }}"
                                class="btn btn-sm btn-primary ml-auto mr-3">Verify KYC</a>
                            <a href="{{ url('admin/franchise/kyc/reject') }}/{{ $mdata['id'] }}"
                                class="btn btn-sm btn-danger  mr-0">Reject KYC</a>
                        @endif

                    </div>
                    <div class="card-body">
                        <form action="{{ route('franchiseupdateKYC') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" name="bank"
                                            value="{{ $mdata['bank'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Holder Name</label>
                                        <input type="text" class="form-control" name="holder"
                                            value="{{ $mdata['holder'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>IFSC</label>
                                        <input type="text" class="form-control" name="ifsc"
                                            value="{{ $mdata['ifsc'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>A/C No</label>
                                        <input type="text" class="form-control" name="account_no"
                                            value="{{ $mdata['account_no'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>PAN No </label>
                                        <input type="text" class="form-control" name="pan_no"
                                            value="{{ $mdata['pan_no'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aadhar No</label>
                                        <input type="text" class="form-control" name="adhar_no"
                                            value="{{ $mdata['adhar_no'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nominee Name</label>
                                        <input type="text" class="form-control" name="nominee_name"
                                            value="{{ $mdata['nominee_name'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nominee Relation </label>
                                        <input type="text" class="form-control" name="nominee_relation"
                                            value="{{ $mdata['nominee_relation'] }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nominee No</label>
                                        <input type="text" class="form-control" name="nominee_no"
                                            value="{{ $mdata['nominee_no'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Wallet Address</label>
                                        <input type="text" class="form-control" name="wallet_address"
                                            value="{{ $mdata['wallet_address'] }}">
                                    </div>
                                </div> --}}
                                <!--<div class="col-md-4">-->
                                <!--    <div class="form-group">-->
                                <!--        <label>Email</label>-->
                                <!--        <input type="text" class="form-control" name="email"-->
                                <!--            value="{{ $mdata['email'] }}">-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" class="form-control" name="id" value="{{ $mdata['id'] }}">
                                    <button class="btn btn-primary float-right mt-3">Update Details</button>
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row ">
                    <div class="col-md-6 col-sm-12 mb-5">
                        <div class="card shadow">
                            <div class="card-body ">
                                <div class="text-center ">
                                    @if ($mdata['pan_image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $mdata['pan_image'] }}" class="rounded"
                                            width="380" />
                                    @else
                                        <img src="{{ asset('logo/image_place.jpg') }}" class="rounded" width="380" />
                                    @endif

                                </div>
                                <h4 class="card-title mt-10">{{ __('PAN Card Image') }} ({{ $mdata['pan_no'] }})</h4>
                                <form action="{{ route('franchiseupdatePan') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="pan_image" class="form-control" required>

                                        @error('pan_image')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ $mdata['id'] }}">
                                    <input type="hidden" name="oldImage" value="{{ $mdata['pan_image'] }}">
                                    <button class="btn btn-sm btn-primary float-right mb-5">Update Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow">
                            <div class="card-body ">
                                <div class="text-center ">
                                    @if ($mdata['front_image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $mdata['front_image'] }}" class="rounded"
                                            width="380" />
                                    @else
                                        <img src="{{ asset('logo/image_place.jpg') }}" class="rounded"
                                            style="width: 460px; height: 270px" />
                                    @endif
                                </div>
                                <h4 class="card-title mt-10">{{ __('Aadhar Front Image') }}
                                </h4>
                                <form action="{{ route('franchiseupdateAfront') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="front_image" class="form-control" required>

                                        @error('front_image')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ $mdata['id'] }}">
                                    <input type="hidden" name="oldImage1" value="{{ $mdata['front_image'] }}">
                                    <button class="btn btn-sm btn-primary float-right">Update Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow">
                            <div class="card-body shadow">
                                <div class="text-center">
                                    @if ($mdata['back_image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $mdata['back_image'] }}" class="rounded"
                                            width="380" />
                                    @else
                                        <img src="{{ asset('logo/image_place.jpg') }}" class="rounded"
                                            style="width: 460px; height: 270px" />
                                    @endif
                                </div>
                                <h4 class="card-title mt-10">{{ __('Aadhar Back Image') }}</h4>
                                <form action="{{ route('franchiseupdateAback') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="back_image" class="form-control" required>

                                        @error('back_image')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ $mdata['id'] }}">
                                    <input type="hidden" name="oldImage2" value="{{ $mdata['back_image'] }}">
                                    <button class="btn btn-sm btn-primary float-right">Update Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow">
                            <div class="card-body shadow">
                                <div class="text-center">
                                    @if ($mdata['cheque_image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $mdata['cheque_image'] }}" class="rounded"
                                            width="380" />
                                    @else
                                        <img src="{{ asset('logo/image_place.jpg') }}" class="rounded"
                                            style="width: 460px; height: 270px" />
                                    @endif
                                </div>
                                <h4 class="card-title mt-10">{{ __('Cheque/Passbook Image') }}</h4>
                                <form action="{{ route('franchiseupdateCheque') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="cheque_image" class="form-control" required>

                                        @error('cheque_image')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ $mdata['id'] }}">
                                    <input type="hidden" name="oldImage3" value="{{ $mdata['cheque_image'] }}">
                                    <button class="btn btn-sm btn-primary float-right">Update Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/datatables.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/form-components.js') }}"></script>
    @endpush
@endsection
