<?php

use App\Models\Admin;
use App\Models\BonusLevelIncome;
use App\Models\ClubIncome;
use App\Models\DirectIncome;
use App\Models\MemberDetail;
use App\Models\TravelFundDetail;
use App\Models\OrderDetail;
use App\Models\PackageDetail;
use App\Models\RewardIncome;
use App\Models\RetailProfit;
use App\Models\LevelIncome;
use App\Models\StakingIncome;
use App\Models\SalesBonusIncome;
use App\Models\BinaryIncome;
use App\Models\AssuredBonus;
use App\Models\MentorshipIncome;
use App\Models\WithdrawalRequest;

function totalMembersadmin()
{
    $count = MemberDetail::all();
    return count($count);
}

function totalActiveMembers()
{
    $count = MemberDetail::where('status', 'Active')->get();
    return count($count);
}

function totalTempMembers()
{
    $count = MemberDetail::where('status', 'Temp')->count();
    return $count;
}


function totalblockedMembers()
{
    $count = MemberDetail::where('status', 'Blocked')->count();
    return $count;
}

function todaysWithdrawal()
{
    $sum = WithdrawalRequest::where('status', 'Approved')->whereDate('payment_date', date('Y-m-d'))->sum('gross_amount');
    return $sum;
}

function totalWithdrawal()
{
    $sum = WithdrawalRequest::where('status', 'Approved')->sum('gross_amount');
    return $sum;
}

function totalinWallet()
{
    $sum = MemberDetail::sum('wallet');
    return $sum;
}

function totalinp2pWallet()
{
    $sum = MemberDetail::sum('p2p_wallet');
    return $sum;
}

function totalpendingorders()
{
    $count = MemberDetail::where('status', 'Pending')->count();
    return $count;
}

function totalgrossAmount()
{
    $count = WithdrawalRequest::where('status', 'Approved')->sum('gross_amount');
    return $count;
}

function totalnetAmount()
{
    $count = WithdrawalRequest::where('status', 'Approved')->sum('net_amount');
    return $count;
}

function totaldeductions()
{
    $count = WithdrawalRequest::where('status', 'Approved')->sum('service_charge');
    return $count;
}

function getTotalBonuses()
{
    $total = 0;
    return $total;
}


//  total incomes

function totalRewardIn()
{
    $count = RewardIncome::count();
    return $count;
}
function totalTravelFundIn()
{
    $count = TravelFundDetail::count();
    return $count;
}

function totalLevelIn()
{
    $var = LevelIncome::where('status', 'Paid')->sum('amount');
    return $var;
}

function totalBinaryMatchingIn()
{
    $var = BinaryIncome::where('status', 'Paid')->sum('amount');
    return $var;
}

function totalSalesBonusIn()
{
    $var = SalesBonusIncome::where('status', 'Paid')->sum('amount');
    return $var;
}
function totalClubIn()
{
    $var = ClubIncome::where('status', 'Paid')->sum('amount');
    return $var;
}

function totalMentorshipIn()
{
    $var = MentorshipIncome::where('status', 'Paid')->sum('amount');
    return $var;
}

function totalpendingdorders()
{
    return OrderDetail::where([['status', '!=','Delivered'], ['status', '!=','Undelivered']])->count();
}

function totaldeliveredorders()
{
    return OrderDetail::where('status', 'Delivered')->count();
}

function totalundeliveredorders()
{
    return OrderDetail::where('status', 'Undelivered')->count();
}

function subadmin()
{
    $sub = Admin::find(session('ADMIN_ID'));
    return $sub;
}

function getAllBinaryDetails()
{
    $totals = MemberDetail::selectRaw('
        COALESCE(SUM(left_count), 0) as total_left_count,
        COALESCE(SUM(right_count), 0) as total_right_count,
        COALESCE(SUM(left_amount), 0) as total_left_amount,
        COALESCE(SUM(right_amount), 0) as total_right_amount
    ')->first();
    
    return [
        'left_count' => $totals->total_left_count ?? 0,
        'right_count' => $totals->total_right_count ?? 0,
        'left_amount' => $totals->total_left_amount ?? 0,
        'right_amount' => $totals->total_right_amount ?? 0
    ];
}






