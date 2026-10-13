@extends('member.layouts.main')
@section('title', 'Level Details')
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
                                        style="text-decoration: none">Team Section</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title"> Level Details</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Level Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="" class="table table-striped display " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Level No</th>
                                        <th>Total Members</th>
                                        <th>Total Left Volume</th>
                                        <th>Total Right Volume</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ __('1st Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '1') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '1'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '1'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '1' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>{{ __('2nd Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '2') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '2'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '2'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '2' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>{{ __('3rd Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '3') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '3'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '3'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '3' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>{{ __('4th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '4') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '4'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '4'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '4' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>{{ __('5th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '5') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '5'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '5'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '5' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>{{ __('6th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '6') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '6'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '6'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '6' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>{{ __('7th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '7') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '7'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '7'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '7' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>{{ __('8th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '8') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '8'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '8'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '8' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>{{ __('9th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '9') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '9'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '9'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '9' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>{{ __('10th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '10') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '10'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '10'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '10' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>{{ __('11th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '11') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '11'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '11'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '11' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>{{ __('12th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '12') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '12'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '12'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '12' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>{{ __('13th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '13') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '13'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '13'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '13' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>{{ __('14th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '14') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '14'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '14'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '14' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>{{ __('15th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '15') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '15'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '15'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '15' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>{{ __('16th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '16') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '16'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '16'), 2) }}SP</div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '16' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>{{ __('17th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '17') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '17'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '17'), 2) }}SP
                                            </div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '17' }}">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>{{ __('18th Level') }}</td>
                                        <td>
                                            <div class="btn btn-pill bg-success text-white">
                                                {{ totalsingleLevel($data['memberid'], '18') }}</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalLeftLevelVol($data['memberid'], '18'), 2) }}SP</div>
                                        </td>
                                        <td>
                                            <div class="mt-1">
                                                {{ number_format(totalRightLevelVol($data['memberid'], '18'), 2) }}SP
                                            </div>
                                        </td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('member/team/level-members-details') }}/{{ '18' }}">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
