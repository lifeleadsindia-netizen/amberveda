@extends('member.layouts.main')
@section('title', 'View Support Tickets')
@section('container')

    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">View Support Tickets</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">View Support Tickets</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-8 col-lg-8 col-xl-12">
                @if (session()->has('createMsg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('createMsg') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <h4 class="card-title">Ticket ID : {{ $support['ticket_id'] }} </h4>
                            <p>Status : <span class="btn btn-primary px-2 py-0">{{ $support['status'] }}</span> </p>
                        </div>
                        <div class="card-body p-0 pt-3" style="height:400px;overflow:auto">
                            <ul class="conversation-list px-3 chat-conversation" >
                                @foreach ($tdata as $item)
                                    @if ($item['written_by'] == 'Member')
                                        <li class="clearfix">
                                            <div class="chat-avatar">
                                                <img src="{{asset('uploads/avatar.jpg')}}" class="rounded"
                                                    alt="Shreyu N" />
                                                <i>{{ date('d-M-y', strtotime($item['created_at'])) }}</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap" style="width: 400px">
                                                    <i>{{ getName($support['memberid']) }}</i>
                                                    <p>{{ $item['text'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="clearfix odd">
                                            <div class="chat-avatar ">
                                                <img src="{{asset('uploads/avatar.jpg')}}" class="rounded"
                                                    alt="dominic"/>
                                                <i>{{ date('d-M-y', strtotime($item['created_at'])) }}</i>
                                            </div>
                                            <div class="conversation-text">
                                                <div class="ctext-wrap" style="width: 400px">
                                                    <i>Support Team</i>
                                                    <p>{{ $item['text'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- end card-body -->

                        @if ($support['status'] != 'Closed')
                            <div class="card-body bg-light mt-2">
                                <form class="needs-validation"action="{{ route('MbReplyTicket') }}" method="post"
                                    novalidate="" name="chat-form" id="chat-form">
                                    @csrf
                                    <div class="d-flex align-items-start">
                                        <div class="w-100">
                                            {{-- <input type="text" class="form-control border-0" placeholder="Enter your text"
                                        required=""  name="reply"/> --}}
                                            <textarea type="text" placeholder="Enter your text" class="form-control border-0" name="reply" required></textarea>
                                            @error('reply')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            {{-- <div class="invalid-feedback">
                                        Please enter your messsage
                                    </div> --}}
                                        </div>

                                        <div class="btn-group mx-3 mt-2">
                                            <input type="hidden" class="form-control" value="{{ $item['ticket_id'] }}"
                                                name="ticketid">
                                            <button type="submit" class="btn btn-success chat-send">
                                                <i class="uil uil-message"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                    <!-- end card -->
                </div>
            </div>

        </div>
        <!-- container -->

    </div>
    <!-- content -->
@endsection
