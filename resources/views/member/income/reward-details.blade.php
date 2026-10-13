@extends('member.layouts.main')
@section('title', 'Reward Details')
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
                                        style="text-decoration: none">⭐ Reward Tiers & Achievements</a></li>
                            </ol>
                        </nav>

                    </div>
                    <h4 class="page-title">Your Reward Progression</h4>
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
                    <div class="card" style="zoom:110%">
                        <div class="card-header">
                            <h4>{{ __('Reward Income Details') }}</h4>
                        </div>
                        <div class="card-body px-3">
                            <div class="responsive" style="overflow: auto">
                                <table id="example" class="table  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Tier</th>
                                            <th>Rank</th>
                                            <th>Level</th>
                                            <th>Left Biz </th>
                                            <th>Right Biz</th>
                                            <th>Reward</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $tiers = [
                                                [
                                                    'num' => 1,
                                                    'name' => 'Starter',
                                                    'left_biz' => 0,
                                                    'right_biz' => 0,
                                                    'level' => '1st',
                                                    'reward' => '--', 
                                                    'status_level' => 0,
                                                ],
                                                [
                                                    'num' => 2,
                                                    'name' => 'Bronze',
                                                    'left_biz' => 250,
                                                    'right_biz' => 250,
                                                    'level' => '2nd',
                                                    'reward' => 'Suit piece + certificate', 
                                                    'status_level' => 1,
                                                ],
                                                [
                                                    'num' => 3,
                                                    'name' => 'Silver',
                                                    'left_biz' => 500,
                                                    'right_biz' => 500,
                                                    'level' => '3rd',
                                                    'reward' => 'Smart Watch',
                                                    'status_level' => 2,
                                                ],
                                                [
                                                    'num' => 4,
                                                    'name' => 'Gold',
                                                    'left_biz' => 1000,
                                                    'right_biz' => 1000,
                                                    'level' => '4th',
                                                    'reward' => 'Tablet',
                                                    'status_level' => 3,
                                                ],
                                                [
                                                    'num' => 5,
                                                    'name' => 'Ruby',
                                                    'left_biz' => 2000,
                                                    'right_biz' => 2000,
                                                    'level' => '5th',
                                                    'reward' => 'Domestic tour',
                                                    'status_level' => 4,
                                                ],
                                                [
                                                    'num' => 6,
                                                    'name' => 'Pearl',
                                                    'left_biz' => 4000,
                                                    'right_biz' => 4000,
                                                    'level' => '6th',
                                                    'reward' => '25000/- cash reward ',
                                                    'status_level' => 5,
                                                ],
                                                [
                                                    'num' => 7,
                                                    'name' => 'Sapphire',
                                                    'left_biz' => 8000,
                                                    'right_biz' => 8000,
                                                    'level' => '7th',
                                                    'reward' => 'Goa tour',
                                                    'status_level' => 6,
                                                ],
                                                [
                                                    'num' => 8,
                                                    'name' => 'Emerald',
                                                    'left_biz' => 16000,
                                                    'right_biz' => 16000,
                                                    'level' => '8th',
                                                    'reward' => '1.00 Lac bike fund',
                                                    'status_level' => 7,
                                                ],
                                                [
                                                    'num' => 9,
                                                    'name' => 'Diamond',
                                                    'left_biz' => 32000,
                                                    'right_biz' => 32000,
                                                    'level' => '9th',
                                                    'reward' => 'Thailand tour',
                                                    'status_level' => 8,
                                                ],
                                                [
                                                    'num' => 10,
                                                    'name' => 'Crown Diamond',
                                                    'left_biz' => 64000,
                                                    'right_biz' => 64000,
                                                    'level' => '10th',
                                                    'reward' => 'Tata punch base model',
                                                    'status_level' => 9,
                                                ],
                                                [
                                                    'num' => 11,
                                                    'name' => 'Royal Crown',
                                                    'left_biz' => 128000,
                                                    'right_biz' => 128000,
                                                    'level' => '11th',
                                                    'reward' => 'Sedan car',
                                                    'status_level' => 10,
                                                ],
                                                [
                                                    'num' => 12,
                                                    'name' => 'Blue Royal',
                                                    'left_biz' => 256000,
                                                    'right_biz' => 256000,
                                                    'level' => '12th',
                                                    'reward' => 'XUV700/ Tata harrier',
                                                    'status_level' => 11,
                                                ],
                                                [
                                                    'num' => 13,
                                                    'name' => 'Black Royal',
                                                    'left_biz' => 512000,
                                                    'right_biz' => 512000,
                                                    'level' => '13th',
                                                    'reward' => 'Audi A4',
                                                    'status_level' => 12,
                                                ],
                                                [
                                                    'num' => 14,
                                                    'name' => 'Ambassador',
                                                    'left_biz' => 1024000,
                                                    'right_biz' => 1024000,
                                                    'level' => '14th',
                                                    'reward' => 'BMW car + 5.0 Lac gold fund',
                                                    'status_level' => 13,
                                                ],
                                                [
                                                    'num' => 15,
                                                    'name' => 'Crown Ambassador',
                                                    'left_biz' => 2048000,
                                                    'right_biz' => 2048000,
                                                    'level' => '15th',
                                                    'reward' => 'Range rover car + 25Lac house fund + Foreign tour',
                                                    'status_level' => 14,
                                                ],
                                                [
                                                    'num' => 16,
                                                    'name' => 'Global Ambassador',
                                                    'left_biz' => 4096000,
                                                    'right_biz' => 4096000,
                                                    'level' => '16th',
                                                    'reward' => '1.5 Cr Car fund + Foreign tour + 50.0L diamond fund',
                                                    'status_level' => 15,
                                                ],
                                                [
                                                    'num' => 17,
                                                    'name' => 'International Crown',
                                                    'left_biz' => 8192000,
                                                    'right_biz' => 8192000,
                                                    'level' => '17th',
                                                    'reward' => 'Luxury car + House fund + Foreign trip',
                                                    'status_level' => 16,
                                                ],
                                                [
                                                    'num' => 18,
                                                    'name' => 'Legend Star',
                                                    'left_biz' => 16384000,
                                                    'right_biz' => 16384000,
                                                    'level' => '18th',
                                                    'reward' => '5.0Cr cash Europe trip + 25L diamond fund',
                                                    'status_level' => 17,
                                                ],
                                            ];
                                        @endphp
                                        @foreach ($tiers as $tier)
                                            @php
                                                // $count = totalsingleLevel($data->memberid, $tier['num'] + 2);

                                                $leftAchieved = $data->left_amount >= $tier['left_biz'];
                                                $rightAchieved = $data->right_amount >= $tier['right_biz'];

                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="tier-number">{{ $tier['num'] }}</div>
                                                </td>

                                                <td>
                                                    <span class="rank-name">{{ $tier['name'] }}</span>
                                                </td>

                                                <td class="text-center">
                                                    <span>{{ $tier['level'] }}</span>
                                                </td>

                                                <td class="text-center">
                                                    @php
                                                        // User's current achieved tier
                                                        $currentTier = 0;
                                                        foreach ($tiers as $t) {
                                                            if (
                                                                $data->right_amount >= $t['right_biz'] &&
                                                                $data->left_amount >= $t['left_biz']
                                                            ) {
                                                                $currentTier = $t['num'];
                                                            }
                                                        }
                                                        
                                                        // For left side
                                                        $showValue = $tier['left_biz'] . ' / ' . 0;
                                                        if ($tier['num'] <= $currentTier) {
                                                            // Achieved tiers
                                                            $showValue = $tier['left_biz'] . ' / ' . $tier['left_biz'];
                                                        } elseif ($tier['num'] == $currentTier + 1) {
                                                            // Next tier in progress
                                                            $showValue =
                                                                $tier['left_biz'] .
                                                                ' / ' .
                                                                ($showValue = $data->left_amount);
                                                        }
                                                    @endphp

                                                    {{ $showValue }}
                                                </td>

                                                <td class="text-center">
                                                    @php
                                                        // User's current achieved tier
$currentTier = 0;
foreach ($tiers as $t) {
    if (
        $data->right_amount >= $t['right_biz'] &&
        $data->left_amount >= $t['left_biz']
    ) {
        $currentTier = $t['num'];
    }
}

// For Right side
$showValue = $tier['right_biz'] . ' / ' . 0;
if ($tier['num'] <= $currentTier) {
    // Achieved tiers
    $showValue =
        $tier['right_biz'] . ' / ' . $tier['right_biz'];
} elseif ($tier['num'] == $currentTier + 1) {
    // Next tier in progress
    $showValue =
        $tier['right_biz'] .
        ' / ' .
                                                                ($showValue = $data->right_amount);
                                                        }
                                                    @endphp

                                                    {{ $showValue }}
                                                </td>

                                                <td>
                                                    <span class="reward-amount">{{ $tier['reward'] }}</span>
                                                </td>

                                                <td>
                                                    @if ($leftAchieved && $rightAchieved)
                                                        <span class="btn btn-sm btn-primary status-achieved">
                                                            <i class="fa fa-check-circle"></i> Achieved
                                                        </span>
                                                    @else
                                                        <span class="btn btn-sm btn-warning  status-not-achieved">
                                                            <i class="fa fa-clock"></i> In Progress
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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


    <!-- content -->


@endsection
