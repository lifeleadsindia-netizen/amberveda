@extends('member.layouts.main')
@section('title', 'Direct Members')
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
                                        style="text-decoration: none">Direct Members</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Team Section</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Direct Members Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Image</th>
                                                <th>Joining Date</th>
                                                <th>Activation Date</th>
                                                <th>Memberid</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Left SP</th>
                                                <th>Right SP</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($directData as $list)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>
                                                        @if ($list['profile_image'] == '')
                                                            <img src="{{ asset('uploads/avatar.jpg') }}"
                                                                class="img-fluid img-thumbnail"
                                                                style="border: 1px solid rgba(0, 255, 190, .3);background-color: rgba(0, 255, 190, .1);"
                                                                width="50" alt="">
                                                        @else
                                                            <img src="{{ asset('uploads') }}/{{ $list['profile_image'] }}"
                                                                width="50" class="img-fluid img-thumbnail"
                                                                style="border: 1px solid rgba(0, 255, 190, .3);background-color: rgba(0, 255, 190, .1);"
                                                                alt="">
                                                        @endif
                                                    </td>
                                                    <td>{{ __(date('d-m-Y', strtotime($list['created_at']))) }}<br>{{ __(date('H:i:s', strtotime($list['created_at']))) }}
                                                    </td>
                                                    <td>
                                                        @if ($list['activated_at'] == null)
                                                            -- / -- / ----
                                                        @else
                                                            {{ __(date('d-m-Y', strtotime($list['activated_at']))) }}<br>{{ __(date('H:i:s', strtotime($list['activated_at']))) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ __($list['memberid']) }}</td>
                                                    <td>
                                                        @if ($list['name'] == null)
                                                            --
                                                        @else
                                                            {{ __($list['name']) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ __($list['mobile']) }}</td>
                                                    <td>{{ __($list['email']) }}</td>
                                                    <td>{{ __($list['left_amount']) }}</td>
                                                    <td>{{ __($list['right_amount']) }}</td>
                                                    <td>
                                                        @if ($list['status'] == 'Active')
                                                            <span
                                                                class="btn btn-success text-white">{{ __($list['status']) }}</span>
                                                        @elseif ($list['status'] == 'Temp')
                                                            <span class="btn btn-warning ">{{ __($list['status']) }}</span>
                                                        @elseif ($list['status'] == 'Deactive')
                                                            <span class="btn btn-primary ">{{ __($list['status']) }}</span>
                                                        @else
                                                            <span class="btn btn-danger ">{{ __($list['status']) }}</span>
                                                        @endif
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
            </div>
        </div>


    </div>
@endsection
