@extends('member.layouts.main')
@section('title', 'Rank Bonus Details')
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
                                    style="text-decoration: none">Rank Bonus Details</a></li>
                        </ol>
                    </nav>

                </div>
                <h4 class="page-title">Rank Bonus Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                @if (session()->has('wMessage'))
                <div class="alert alert-primary">{{ session('wMessage') }}</div>
                @endif
                <div class="card" style="zoom:90%">
                    <div class="card-header">
                        <h4>{{ __('Rank Bonus Details') }}</h4>
                    </div>
                    <div class="card-body px-3">
                        @php
                        $first = firstLegBiz($data['memberid']);
                        $second = secondLegBiz($data['memberid']);
                        $third = thirdLegBiz($data['memberid']);
                        $fourth = fourthLegBiz($data['memberid']);
                        @endphp
                        <!-- Income Cards -->
                        <div class="row mb-4">
                            <div class="col-12 col-sm-6 col-md-3 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">First Leg</h6>
                                        <h3 class="mb-0">{{ number_format($first) }}</h3>
                                        <small class="card-text">Total PV</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">Second Leg</h6>
                                        <h3 class="mb-0">{{ number_format($second) }}</h3>
                                        <small class="card-text">Total PV</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">Third Leg</h6>
                                        <h3 class="mb-0">{{ number_format($third) }}</h3>
                                        <small class="card-text">Total PV</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 mb-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">Rest Leg</h6>
                                        <h3 class="mb-0">{{ number_format($fourth) }}</h3>
                                        <small class="card-text">Total PV</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Income Cards -->
                        <div class="responsive" style="overflow: auto">
                            <table id="example" class="table  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Rank</th>
                                        <th>First Leg</th>
                                        <th>Second Leg</th>
                                        <th>Third Leg</th>
                                        <th>Rest Leg</th>
                                        <th>Reward</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><strong class="text-primary">Diamond</strong></td>
                                        <td>100000 PV</td>
                                        <td>75000 PV</td>
                                        <td>50000 PV</td>
                                        <td>25000 PV</td>
                                        <td>₹5,00,000</td>
                                        <td>
                                            @if ($first >= 100000 && $second >= 75000 && $third >= 50000 && $fourth >= 25000)
                                            <span class="btn btn-primary">Achieved</span>
                                            @else
                                            <span class="btn btn-danger">Not Achieved</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><strong class="text-primary">Green Diamond</strong></td>
                                        <td>500000 PV</td>
                                        <td>375000 PV</td>
                                        <td>250000 PV</td>
                                        <td>125000 PV</td>
                                        <td>₹25,00,000</td>
                                        <td>
                                            @if ($first >= 600000 && $second >= 450000 && $third >= 300000 && $fourth >= 150000)
                                            <span class="btn btn-primary">Achieved</span>
                                            @else
                                            <span class="btn btn-danger">Not Achieved</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><strong class="text-primary">Black Diamond</strong></td>
                                        <td>1000000 PV</td>
                                        <td>750000 PV</td>
                                        <td>500000 PV</td>
                                        <td>250000 PV</td>
                                        <td>₹50,00,000</td>
                                        <td>
                                            @if ($first >= 1600000 && $second >= 1200000 && $third >= 800000 && $fourth >= 400000)
                                            <span class="btn btn-primary">Achieved</span>
                                            @else
                                            <span class="btn btn-danger">Not Achieved</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><strong class="text-primary">Ambassador</strong></td>
                                        <td>15,00000 PV</td>
                                        <td>11,25000 PV</td>
                                        <td>75,0000 PV</td>
                                        <td>37,5000 PV</td>
                                        <td>₹75,00,000</td>
                                        <td>
                                            @if ($first >= 3100000 && $second >= 2325000 && $third >= 1550000 && $fourth >= 775000)
                                            <span class="btn btn-primary">Achieved</span>
                                            @else
                                            <span class="btn btn-danger">Not Achieved</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><strong class="text-primary">Royal Ambassador</strong></td>
                                        <td>20,00000 PV</td>
                                        <td>15,00000 PV</td>
                                        <td>10,00000 PV</td>
                                        <td>5,00000 PV</td>
                                        <td>₹1,00,00,000</td>
                                        <td>
                                            @if ($first >= 5100000 && $second >= 3825000 && $third >= 2550000 && $fourth >= 1275000)
                                            <span class="btn btn-primary">Achieved</span>
                                            @else
                                            <span class="btn btn-danger">Not Achieved</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div>
    <!-- end row -->
</div>
<!-- container -->
</div>
<!-- content -->


@endsection