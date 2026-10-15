<?php

use App\Models\BonusLevelIncome;
use App\Models\ClubIncome;
use App\Models\DirectIncome;
use App\Models\ImportFund;
use App\Models\FundRequest;
use App\Models\LevelIncome;
use App\Models\MemberDetail;
use App\Models\OrderDetail;
use App\Models\RewardIncome;
use App\Models\AssuredBonus;
use App\Models\TravelFundDetail;
use App\Models\BinaryIncome;
use App\Models\StakingIncome;
use App\Models\TicketText;
use App\Models\UplineMember;
use App\Models\SalesBonusIncome;
use App\Models\WalletTransfer;
use App\Models\FranchiseDetail;
use App\Models\IssueInventorie;
use App\Models\MentorshipIncome;
use App\Models\WithdrawalRequest;

function userId()
{
    $userid = "AMV" . rand(100000, 999999);
    $member = MemberDetail::where('memberid', $userid)->count();
    if ($member > 0) {
        userId();
    } else {
        return $userid;
    }
}

function AdmUnread($ticketid)
{
    $count = TicketText::where([['ticket_id', $ticketid], ['written_by', 'Admin'], ['status', 'Unread']])->count();
    if ($count > 0) {
        return $count;
    } else {
        return 0;
    }
}

function userUnread($ticketid)
{
    $count = TicketText::where([['ticket_id', $ticketid], ['written_by', 'Member'], ['status', 'Unread']])->count();
    if ($count > 0) {
        return $count;
    } else {
        return 0;
    }
}

function updateDownline($placementid)
{
    if ($placementid != 'Root') {

        $var = MemberDetail::where('memberid', $placementid)->first();
        $var->downline += 1;
        $var->save();
    }
}

function getSponsorid($memberid)
{
    $var = MemberDetail::where('memberid', $memberid)->first();
    return $var['sponsorid'];
}

function getName($memberid)
{
    $var = MemberDetail::where('memberid', $memberid)->first();
    return $var['name'];
}

function updateUpline($sponsorid, $memberid)
{
    if ($memberid != 'AMV123456') {
        $pool = UplineMember::where('memberid', $sponsorid)->first();
        $var = new UplineMember();
        $var->memberid = $memberid;
        $var->upline_1 = $pool->memberid;
        $var->upline_2 = $pool->upline_1;
        $var->upline_3 = $pool->upline_2;
        $var->upline_4 = $pool->upline_3;
        $var->upline_5 = $pool->upline_4;
        $var->upline_6 = $pool->upline_5;
        $var->upline_7 = $pool->upline_6;
        $var->upline_8 = $pool->upline_7;
        $var->upline_9 = $pool->upline_8;
        $var->upline_10 = $pool->upline_9;
        $var->upline_11 = $pool->upline_10;
        $var->upline_12 = $pool->upline_11;
        $var->upline_13 = $pool->upline_12;
        $var->upline_14 = $pool->upline_13;
        $var->upline_15 = $pool->upline_14;
        $var->upline_16 = $pool->upline_15;
        $var->upline_17 = $pool->upline_16;
        $var->upline_18 = $pool->upline_17;
        $var->save();
    }
}

function getUserData($memberid)
{
    $udata = MemberDetail::where('memberid', $memberid)->first();
    return $udata;
}

function totalWithdrawals($memberid)
{
    $var = WithdrawalRequest::where('memberid', $memberid)->whereIn('status', ['Approved', 'PENDING'])->sum('gross_amount');
    return $var;
}

function todayWithdrawals($memberid)
{
    $var = WithdrawalRequest::where('memberid', $memberid)->whereIn('status', ['Approved', 'PENDING'])->whereDate('created_at', date('Y-m-d'))->sum('gross_amount');
    return $var;
}

function totalImportedFund($memberid)
{
    $sum = FundRequest::where([['memberid', $memberid],['status','Accepted']])->sum('amount');
    return $sum;
}

function totalPurchasedProducts($memberid)
{
    return (int) OrderDetail::where('memberid', $memberid)
        ->where('status', '!=', 'Temp')
        ->sum('quantity');
}

function getAllData($memberid)
{
    $var = MemberDetail::where('memberid', $memberid)->first();
    return $var;
}

function totalMembers($memberid)
{
    $count = MemberDetail::where('status', 'Active')->count();
    return $count;
}

function myDirects($memberid)
{
    $var = MemberDetail::where('memberid', $memberid)->first();
    return $var->downline;
}

function capping($memberid)
{
    $var = MemberDetail::where('memberid', $memberid)->first();
    $package = $var->package;
    $r_status = $var->reward_status;
    if ($package >= 10 && $package < 50 ) {
        $capping = 2500;
    }elseif ($package >= 50 && $package < 100 ) {
        $capping = 10000;
    }elseif ($package >= 100  ) {
        $capping = 25000;
    }
    return $capping;
}

function totalIncome($memberid)
{
    $var =  totalLevelIncome($memberid);
    return $var;
}

function getTotalBonus($memberid)
{
    $total = totalDirectIncome($memberid) + totalLevelIncome($memberid);
    return $total;
}

function totalDirectIncome($memberid)
{
    $var = DirectIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $var;
}

function totalLevelIncome($memberid)
{
    $var = LevelIncome::where('memberid', $memberid)->sum('amount');
    return $var;
}
function totalClubIncome()
{
    $var = ClubIncome::where('status', 'Paid')->sum('amount');
    return $var;
}
function totalBinaryMatchingIncome($memberid)
{
    $var = BonusLevelIncome::where('status', 'Paid')->sum('amount');
    return $var;
}
function totalSalesBonusIncome($memberid)
{
    $var = SalesBonusIncome::where('status', 'Paid')->sum('amount');
    return $var;
}
function totalRewardIncome($memberid)
{
    $var = RewardIncome::where('memberid', $memberid)->count();
    return $var;
}
function memTotTravelFund($memberid)
{
    $var = TravelFundDetail::where('memberid', $memberid)->count();
    return $var;
}
function memTotMentorshipIncome($memberid)
{
    $var = MentorshipIncome::where('memberid', $memberid)->sum('amount');
    return $var;
}
function totalBonusLvlIncome($memberid)
{
    $var = BonusLevelIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $var;
}

function totalCashbackIncome($memberid)
{
    $var = StakingIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $var;
}


function recentWalletTransfers($memberid, $limit = 6)
{
    return WalletTransfer::where('memberid', $memberid)
        ->orderByDesc('id')
        ->limit($limit)
        ->get(['id', 'walletType', 'debit', 'credit', 'balance', 'particular', 'created_at']);
}


function checkTxnid($txnid)
{
    $check = ImportFund::where('txnid', $txnid)->first();
    if (!$check) {
        $check2 = FundRequest::where('tran_id', $txnid)->first();
        if (!$check2) {
            $count = 0;
        } else {
            $count = 1;
        }
    } else {
        $count = 1;
    }
    return $count;
}    

function getDirectCount($memberid)
{
     $directCount = MemberDetail::where('sponsorid', $memberid)->count();
     return $directCount;
}

function getLevelData($memberid)
{
    $directs = MemberDetail::where('sponsorid', $memberid)->get();
    return $directs;
}

function totalsingleLevel($memberid, $level)
{
    $upline = 'upline_' . $level;
    $var = UplineMember::where($upline, $memberid)->count();
    return $var;
}

function totalLeftLevelVol($memberid, $level)
{
    $upline = 'upline_' . $level;
    $members = UplineMember::where($upline, $memberid)->pluck('memberid');
    $sum = MemberDetail::whereIn('memberid', $members)->sum('left_amount');
    return $sum;
}

function totalRightLevelVol($memberid, $level)
{
    $upline = 'upline_' . $level;
    $members = UplineMember::where($upline, $memberid)->pluck('memberid');
    $sum = MemberDetail::whereIn('memberid', $members)->sum('right_amount');
    return $sum;
}

function totalLevelMembers($memberid)
{
    $members = MemberDetail::where('sponsorid', $memberid)->pluck('memberid');
    $total = count($members);
    while (count($members) != 0) {
        $members = MemberDetail::whereIn('sponsorid', $members)->pluck('memberid');
        $total += count($members);
    }

    return $total;
}

function team_biz_update($sponsorid, $amount)
{

    $limit = 26;
    for ($i = 1; $i < $limit; $i++) {
        if ($sponsorid != 'Root') {
            $query = MemberDetail::where('memberid', $sponsorid)->first();
            $query->team_biz += $amount;
            $query->save();
            $sponsorid = $query->sponsorid;
        } else {
            break;
        }
    }
}

function monthly_team_biz_update($sponsorid, $amount)
{

    $limit = 26;
    for ($i = 1; $i < $limit; $i++) {
        if ($sponsorid != 'Root') {
            $query = MemberDetail::where('memberid', $sponsorid)->first();
            $query->monthly_team_biz += $amount;
            $query->save();
            $sponsorid = $query->sponsorid;
        } else {
            break;
        }
    }
}

function memberProfileCompletionPercent($member)
{
    if (empty($member)) {
        return 0;
    }

    if (is_object($member) && method_exists($member, 'toArray')) {
        $member = $member->toArray();
    } elseif (is_object($member)) {
        $member = (array) $member;
    }

    $fields = [
        'name',
        'email',
        'mobile',
        'address',
        'city',
        'state',
        'country',
        'bank',
        'ifsc',
        'account_no',
        'pan_no',
        'adhar_no',
        'nominee_name',
        'nominee_relation',
    ];

    $completed = 0;

    foreach ($fields as $field) {
        if (!empty($member[$field] ?? null)) {
            $completed++;
        }
    }

    return (int) round(($completed / count($fields)) * 100);
}

// function getProductQuantity($productId, $city, $state)
// {
//     $franchise = FranchiseDetail::where([['city', $city], ['state', $state]])->first();

//     if (!$franchise || $franchise->franchise_id === null) {
//         return 0;
//     }

//     $franchieid = $franchise->franchise_id;
//     $issued = issuedInventory($franchieid, $productId) ?? 0;
//     $delivered = deliveredInventory($franchieid, $productId) ?? 0;
//     return $issued - $delivered;
// }

function addPlacementId($userid, $sponsor, $position)
{
    if ($position == 'Left') {

        $left = MemberDetail::where('memberid', $sponsor)->first();
        if ($left['left_id'] == NULL) {
            $left->left_id = $userid;
            $left->save();
            $userUpdate = MemberDetail::where('memberid', $userid)->update(['placementid' => $sponsor]);
        } else {    
            addPlacementId($userid, $left['left_id'], $position);
        }
    } elseif ($position == 'Right') {
        $right = MemberDetail::where('memberid', $sponsor)->first();
        if ($right['right_id'] == NULL) {
            $right->right_id = $userid;
            $right->save();
            $userUpdate = MemberDetail::where('memberid', $userid)->update(['placementid' => $sponsor]);
        } else {
            addPlacementId($userid, $right['right_id'], $position);
        }
    }
}

function getBinaryDetails($memberid)
{
    $member = MemberDetail::where('memberid', $memberid)->first();
    if ($member) {
        return [
            'left_count' => $member->left_count ?? 0,
            'right_count' => $member->right_count ?? 0,
            'left_amount' => $member->left_amount ?? 0,
            'right_amount' => $member->right_amount ?? 0
        ];
    }
    return [
        'left_count' => 0,
        'right_count' => 0,
        'left_amount' => 0,
        'right_amount' => 0
    ];
}

function binary_count_update($memberid, $placementid, $position)
{
    while ($placementid != 'Root') {
        if ($position == 'Left') {
            $query = MemberDetail::where('memberid', $placementid)->first();
            $query->left_count = $query->left_count + 1;
            $query->save();
            $position = $query->position;
            $placementid = $query->placementid;
        } elseif ($position == 'Right') {
            $query = MemberDetail::where('memberid', $placementid)->first();
            $query->right_count = $query->right_count + 1;
            $query->save();
            $position = $query->position;
            $placementid = $query->placementid;
        }
    }
}
function levelIncomeSum($memberid)
{
    $income = LevelIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $income;
}
function binaryIncomeSum($memberid)
{
    $income = BinaryIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $income;
}
function clubIncomeSum($memberid)
{
    $income = ClubIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $income;
}
function salesBonusIncomeSum($memberid)
{
    $income = SalesBonusIncome::where([['memberid', $memberid], ['status', 'Paid']])->sum('amount');
    return $income;
}

function rewardCount($memberid)
{
    $var = MemberDetail::where([['memberid', $memberid], ['status', 'Active']])->count('reward_status');
    return $var;
}
function travelFundCount($memberid)
{
    $var = MemberDetail::where([['memberid', $memberid], ['status', 'Active']])->count('travel_fund_status');
    return $var;
}