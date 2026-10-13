@extends('admin.layouts.main')
@section('title', 'Update Admin Details')
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
                            <h5>{{ __('Update Admin Details') }}</h5>
                            <span>{{ __('Update Admin Details') }}</span>
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
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Update Admin Details') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @if (session()->has('updateErr'))
                    <div class="alert alert-primary" role="alert">
                        <span>{{ session('updateErr') }}</span>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ __('Update Admin Details') }}</h3>
                        <a href="{{ url('admin/create-new-admin') }}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body px-5">
                        <form action="{{ route('updateAdminDetails') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="example-name-input"
                                    class="col-md-12 col-form-label form-control-label">Roll</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="roll" value="{{ $addata['roll'] }}"
                                        id="roll">
                                        @if (!$addata['roll'])
                                            <option value="">Select Roll</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Sub Admin">Sub Admin</option>
                                        @elseif ($addata['roll'] == 'Admin')
                                            <option value="Admin">Admin</option>
                                            <option value="Sub Admin">Sub Admin</option>
                                        @elseif ($addata['roll'] == 'Sub Admin')
                                            <option value="Sub Admin">Sub Admin</option>
                                            <option value="Admin">Admin</option>
                                        @endif
                                    </select>
                                    @error('roll')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Email-ID</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email ID"
                                        value="{{ $addata['email'] }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-image-input"
                                    class="col-md-12 col-form-label form-control-label">Password</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class=""> --}}
                            @if ($addata['roll'] == 'Sub Admin')
                                <span type="button" class="btn btn-primary my-3">Permissions</span>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Dashboard<br>
                                                Messages</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['dash_msg'] == 'on')
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $addata['dash_msg'] }}" name="dash_msg"
                                                        id="dashboardMessages" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" name="dash_msg"
                                                        id="dashboardMessages">
                                                @endif
                                                @error('dash_msg')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Deposit<br>
                                                Details</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['deposit'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['deposit'] }}" name="deposit" id="depositDetails"
                                                        checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="deposit"
                                                        id="depositDetails">
                                                @endif
                                                @error('deposit')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Levels</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['levels'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['levels'] }}" name="levels" id="level"
                                                        checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="levels"
                                                        id="level">
                                                @endif
                                                @error('levels')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Product<br>
                                                Management</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['product_manage'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['product_manage'] }}" name="product_manage"
                                                        id="productManagement" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        name="product_manage" id="productManagement">
                                                @endif
                                                @error('product_manage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Dispatch<br>
                                                Order</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['dispatch'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['dispatch'] }}" name="dispatch"
                                                        id="dispatchOrder" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="dispatch"
                                                        id="dispatchOrder">
                                                @endif
                                                @error('dispatch')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Payment<br>
                                                Management</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['payment'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['payment'] }}" name="payment"
                                                        id="incomeSection" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="payment"
                                                        id="incomeSection">
                                                @endif
                                                @error('payment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Member<br>
                                                Management</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['member_manage'] == 'on')
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $addata['member_manage'] }}" name="member_manage"
                                                        id="memberManagement" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" name="member_manage"
                                                        id="memberManagement">
                                                @endif
                                                @error('member_manage')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Links<br> Order</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['links_order'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['links_order'] }}" name="links_order"
                                                        id="linksOrder" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        name="links_order" id="linksOrder">
                                                @endif
                                                @error('links_order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Club<br>
                                                Section</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['club'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['club'] }}" name="club" id="clubSection"
                                                        checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="club"
                                                        id="clubSection">
                                                @endif
                                                @error('club')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Cashback<br>
                                                Section</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['cashback'] == 'on')
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $addata['cashback'] }}" name="cashback"
                                                        id="cashbackSection" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" name="cashback"
                                                        id="cashbackSection">
                                                @endif
                                                @error('cashback')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Assured<br>
                                                Bonus</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['assured'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['assured'] }}" name="assured"
                                                        id="assuredBonus" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="assured"
                                                        id="assuredBonus">
                                                @endif
                                                @error('assured')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Income<br>
                                                Section</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['income'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['income'] }}" name="income"
                                                        id="incomeSection" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="income"
                                                        id="incomeSection">
                                                @endif
                                                @error('income')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Funds<br>
                                                Management</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['funds'] == 'on')
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $addata['funds'] }}" name="funds"
                                                        id="fundsManagement" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" name="funds"
                                                        id="fundsManagement">
                                                @endif
                                                @error('funds')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="example-image-input"
                                                class="col-md-12 col-form-label form-control-label">Order<br>
                                                Management</label>
                                            <div class="col-md-12 mx-4">
                                                @if ($addata['order'] == 'on')
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        value="{{ $addata['order'] }}" name="order"
                                                        id="orderManagement" checked>
                                                @else
                                                    <input class="form-check-input me-1" type="checkbox" name="order"
                                                        id="orderManagement">
                                                @endif
                                                @error('order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <hr class=" mt-4">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" value="{{ $addata['id'] }}">
                                <button class="btn btn-primary float-right">Update</button>
                            </div>
                        </form>
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
