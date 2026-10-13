@extends('member.layouts.main')
@section('title', 'View Genealogy Tree')
@section('container')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                        style="text-decoration: none">View Genealogy Tree</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">View Genealogy Tree</h4>
                </div>
            </div>
        </div>
        <div class="containner">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="card">

                            @php
                                function activeDate($member)
                                {
                                    return empty($member['activated_at'])
                                        ? '00, 00, 0000'
                                        : date('d M, Y', strtotime($member['activated_at']));
                                }

                                function profileImage($member)
                                {
                                    return empty($member['profile_image'])
                                        ? asset('uploads/avatar.jpg')
                                        : asset('uploads/' . $member['profile_image']);
                                }
                            @endphp
                            <div class="card-body mt-4" style="overflow: auto">

                                {{-- Main Member --}}
                                <div class="row justify-content-center">
                                    <div class="col-md-4 text-center">

                                        <div class="profile-pic mb-20">
                                            <img src="{{ profileImage($d_data) }}" class="shadow img-sm rounded-circle"
                                                alt="" height="100" width="100">
                                        </div>

                                        @php $date = activeDate($d_data); @endphp

                                        <div class="btn btn-primary my-2 p-2 mt-3" data-bs-toggle="popover"
                                            data-bs-html="true" data-bs-placement="right"
                                            title="Hi ! {{ $d_data['name'] ?? '' }}"
                                            data-bs-content="
                                            Activation Date : {{ $date }}<br>
                                            Left Count : {{ $d_data['left_count'] ?? 0 }}<br>
                                            Left Business : {{ $d_data['left_amount'] ?? 0 }}<br>
                                            Right Count : {{ $d_data['right_count'] ?? 0 }}<br>
                                            Right Business : {{ $d_data['right_amount'] ?? 0 }}<br>
                                            Sponsor Id : {{ $d_data['sponsorid'] ?? '' }}">
                                            ID : {{ $d_data['memberid'] ?? '' }}
                                        </div>

                                    </div>
                                </div>

                                {{-- Level 1 --}}
                                <div class="row justify-content-center text-center mt-5">
                                    @foreach ([$leftdata, $rightdata] as $member)
                                        <div class="col-6">
                                            @if ($member == null)
                                                <img src="{{ asset('uploads/avatar.jpg') }}"
                                                    class="shadow img-sm rounded-circle" alt="" height="100"
                                                    width="100">
                                                <br>
                                                <h6 class="mt-3 btn btn-primary my-2 p-2">No Member</h6>
                                            @else
                                                <div class="profile-pic mb-20">
                                                    <a href="{{ url('member/team/view-geneology') }}/{{ $member['id'] }}">
                                                        <img src="{{ profileImage($member) }}"
                                                            class="shadow img-sm rounded-circle" alt=""
                                                            height="100" width="100">
                                                    </a>
                                                </div>

                                                @php $date = activeDate($member); @endphp

                                                <div class="btn btn-primary my-2 p-2 mt-3" data-bs-container="body"
                                                    data-bs-toggle="popover" data-bs-html="true" data-bs-placement="right"
                                                    title="Hi ! {{ $member['name'] ?? '' }}"
                                                    data-bs-content="
                                                    Activation Date : {{ $date }}<br>
                                                    Left Count : {{ $member['left_count'] ?? 0 }}<br>
                                                    Left Business : {{ $member['left_amount'] ?? 0 }}<br>
                                                    Right Count : {{ $member['right_count'] ?? 0 }}<br>
                                                    Right Business : {{ $member['right_amount'] ?? 0 }}<br>
                                                    Sponsor Id : {{ $member['sponsorid'] ?? '' }}">
                                                    ID : {{ $member['memberid'] ?? '' }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Level 2 --}}
                                <div class="row justify-content-center text-center mt-5">
                                    @foreach ([$leftleft, $leftright, $rightleft, $rightright] as $member)
                                        <div class="col-3">
                                            @if ($member == null)
                                                <img src="{{ asset('uploads/avatar.jpg') }}"
                                                    class="shadow img-sm rounded-circle" alt="" height="100"
                                                    width="100">
                                                <br>
                                                <h6 class="mt-3 btn btn-primary my-2 p-2">No Member</h6>
                                            @else
                                                <div class="profile-pic mb-20">
                                                    <a href="{{ url('member/team/view-geneology') }}/{{ $member['id'] }}">
                                                        <img src="{{ profileImage($member) }}"
                                                            class="shadow img-sm rounded-circle" alt=""
                                                            height="100" width="100">
                                                    </a>
                                                </div>

                                                @php $date = activeDate($member); @endphp

                                                <div class="btn btn-primary my-2 p-2 mt-3" data-bs-container="body"
                                                    data-bs-toggle="popover" data-bs-html="true" data-bs-placement="right"
                                                    title="Hi ! {{ $member['name'] ?? '' }}"
                                                    data-bs-content="
                                                        Activation Date : {{ $date }}<br>
                                                        Left Count : {{ $member['left_count'] ?? 0 }}<br>
                                                        Left Business : {{ $member['left_amount'] ?? 0 }}<br>
                                                        Right Count : {{ $member['right_count'] ?? 0 }}<br>
                                                        Right Business : {{ $member['right_amount'] ?? 0 }}<br>
                                                        Sponsor Id : {{ $member['sponsorid'] ?? '' }}">
                                                    ID : {{ $member['memberid'] ?? '' }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function(el) {
                new bootstrap.Popover(el);
            });
        });
    </script>
@endsection
