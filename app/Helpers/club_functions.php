<?php

use App\Models\ClubIncome;
use App\Models\ClubMatrix;
use App\Models\ClubMember;
use App\Models\MemberDetail;
use App\Models\AssuredBonus;
use App\Models\OrderDetail;
use App\Models\PackageDetail;
use App\Models\RewardIncome;
use App\Models\StakingDetail;



function monthlyCTO()
{
    $start = date('Y-m-01 00:01:00', strtotime('last Month'));
    $last = date('Y-m-t 23:59:59', strtotime('last Month'));
    $sum = OrderDetail::whereBetween('created_at', [$start, $last])->sum('total_amount');
    return $sum;
}
