<?php

use App\Models\IssueInventorie;
use App\Models\OrderDetail;
use App\Models\FranchiseDetail;
use App\Models\DeliveryIncome;
use App\Models\WithdrawalRequest;


function franchiseId()
{
    $userid = "AMV" . rand(100000, 999999);
    $member = FranchiseDetail::where('franchise_id', $userid)->count();
    if ($member > 0) {
        franchiseId();
    } else {
        return $userid;
    }
}

function issuedInventory($franchise_id, $proid)
{
    $issue = IssueInventorie::where([['franchise_id', $franchise_id], ['pro_id', $proid]])->sum('quantity');
    return $issue;
}

function deliveredInventory($franchise_id, $proid)
{
    $delevered = OrderDetail::where([['franchise_id', $franchise_id], ['pro_id', $proid]])->whereIn('status',['Delivered','Pending'])->sum('quantity');
    return $delevered;
}

function totalFranchiseWithdrawals($franchise_id)
{
    return WithdrawalRequest::where([
        ['franchise_id', $franchise_id],
        ['status', 'Approved'],
        ['type', 'Franchise Wallet'],
    ])->sum('gross_amount');
}

function totadeliveryIncome($franchise_id)
{
    return DeliveryIncome::where([
        ['franchise_id', $franchise_id],
        ['status', 'Paid'],
    ])->sum('amount');
}

function franchisePendingOrders($franchise_id)
{
    return OrderDetail::where('franchise_id', $franchise_id)
        ->where([['status', '!=','Delivered'], ['status', '!=','Undelivered']])
        ->count();
}

function franchiseDeliveredOrders($franchise_id)
{
    return OrderDetail::where('franchise_id', $franchise_id)
        ->where('status', 'Delivered')
        ->count();
}

function franchiseUndeliveredOrders($franchise_id)
{
    return OrderDetail::where('franchise_id', $franchise_id)
        ->where('status', 'Undelivered')
        ->count();
}