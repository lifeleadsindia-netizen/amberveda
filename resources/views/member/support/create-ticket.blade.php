@extends('member.layouts.main')
@section('title', 'Create Grievance Ticket')
@section('container')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">Create Grievance Ticket</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Create Grievance Ticket</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6">
                @if (session()->has('createMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('createMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Create New Grievance Ticket</h4>
                        <form class="forms-sample" method="post" action="{{ route('createTicket') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1">Memberid</label>
                                <input type="text" class="form-control " name="userid" value="{{ $data['memberid'] }}"
                                    readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputPassword1">Subject</label>
                                <input type="text" class="form-control " name="subject" placeholder="Enter Subject">
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputUsername1">Particular</label>
                                <textarea class="form-control " name="issue" placeholder="Enter Your Issue" rows="5"></textarea>
                                @error('issue')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary me-2 float-end">Submit Grievance</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
