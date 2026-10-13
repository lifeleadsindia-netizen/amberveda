@extends('member.layouts.main')
@section('title', 'Support Ticket')
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
                                        style="text-decoration: none">Support Ticket</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Support Ticket</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($support as $list)
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Support Ticket') }}</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">ID : {{ $list['ticket_id'] }} <span class="float-end "><a
                                        href="{{ url('member/support/view-support-ticket') }}/{{ $list['ticket_id'] }}"
                                        class="btn btn-sm btn-warning">View</a></span> </h5>
                            <p class="card-description p-0 m-0">Subject : {{ $list['subject'] }}</p>
                            <p class="card-description p-0 m-0">Created Date :
                                {{ date('d-M-Y', strtotime($list['created_at'])) }}</p>
                            <p class="card-description p-0 m-0">Status : {{ $list['status'] }}</p>
                            <p class="card-description p-0 m-0">Unread :
                                @if (AdmUnread($list['ticket_id']) == 0)
                                    <span class="btn btn-dark px-2 py-0">{{ AdmUnread($list['ticket_id']) }}</span>
                                @else
                                    <span class="btn btn-danger px-2 py-0">{{ AdmUnread($list['ticket_id']) }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
