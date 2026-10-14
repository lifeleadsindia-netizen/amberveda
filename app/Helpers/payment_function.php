<?php

use App\Models\BinaryIncome;
use App\Models\BonusLevelIncome;
use App\Models\DirectIncome;
use App\Models\InvoiceTable;
use App\Models\LevelIncome;
use App\Models\Level;
use App\Models\MemberDetail;
use App\Models\OrderDetail;
use App\Models\WalletTransfer;

function walletTransfer($memberid, $amount, $type, $wallet, $walletType, $text)
{
    if ($type == 'debit') {
        $ins = new WalletTransfer();
        $ins->memberid = $memberid;
        $ins->walletType = $walletType;
        $ins->debit = $amount;
        $ins->balance = $wallet + $amount;
        $ins->particular = $text;
        $ins->save();
    } elseif ($type == 'credit') {
        $ins = new WalletTransfer();
        $ins->memberid = $memberid;
        $ins->walletType = $walletType;
        $ins->credit = $amount;
        $ins->balance = $wallet - $amount;
        $ins->particular = $text;
        $ins->save();
    }
}

function p2pwalletTransfer($memberid, $amount, $type, $p2pwallet, $walletType, $text)
{
    if ($type == 'debit') {
        $ins = new walletTransfer();
        $ins->memberid = $memberid;
        $ins->walletType = $walletType;
        $ins->debit = $amount;
        $ins->balance = $p2pwallet + $amount;
        $ins->particular = $text;
        $ins->save();
    } elseif ($type == 'credit') {
        $ins = new WalletTransfer();
        $ins->memberid = $memberid;
        $ins->walletType = $walletType;
        $ins->credit = $amount;
        $ins->balance = $p2pwallet - $amount;
        $ins->particular = $text;
        $ins->save();
    }
}

function getPV($package, $type)
{
    if ($type == 'Activation') {
        if ($package == 25) {
            $pv = 20;
        } elseif ($package == 50) {
            $pv = 40;
        } elseif ($package == 100) {
            $pv = 80;
        } elseif ($package == 450) {
            $pv = 360;
        } elseif ($package == 900) {
            $pv = 720;
        }
    } elseif ($type == 'Upgrade') {
        if ($package == 25) {
            $pv = 20;
        } elseif ($package == 50) {
            $pv = 40;
        } elseif ($package == 75) {
            $pv = 60;
        } elseif ($package == 350) {
            $pv = 240;
        } elseif ($package == 400) {
            $pv = 320;
        } elseif ($package == 425) {
            $pv = 340;
        } elseif ($package == 450) {
            $pv = 360;
        } elseif ($package == 800) {
            $pv = 640;
        } elseif ($package == 850) {
            $pv = 680;
        } elseif ($package == 875) {
            $pv = 700;
        }
    }
    return $pv;
}

//Direct Income functions
function directIncome($sponsorid, $memberid, $name, $type, $value)
{
    $amount = $value / 100 * 2.5;

    if ($sponsorid != 'Root') {
        $var = MemberDetail::where('memberid', $sponsorid)->first();

        $insert = new DirectIncome();
        $insert->memberid = $sponsorid;
        $insert->amount = $amount;
        // $insert->pack_amount = $value / 20;
        $insert->activatingId = $memberid;
        $insert->name = $name;
        $insert->package = $value;
        $insert->type = $type;
        $insert->status = 'Paid';
        $insert->save();

        $wallet = $var->wallet;
        $var->wallet += $amount;
        $var->save();

        walletTransfer($sponsorid, $amount, 'debit', $wallet, 'Direct Income', 'Direct Income Amount Added into Wallet. Payment Id-' . $insert->id);
    }
}

function downlinePackage($sponsorid, $package)
{
    $count = MemberDetail::where([['sponsorid', $sponsorid], ['package', '>=', $package]])->count();
    return $count;
}

function levelIncome($sponsorid, $memberid, $name, $package)
{
    $limit = 19;
    for ($i = 1; $i < $limit; $i++) {
        $level = $i;
        $rate = levelRate($level);
        $amount = $package * $rate / 100;

        $var = MemberDetail::where('memberid', $sponsorid)->first();
        if ($sponsorid != 'Root') {

            $insert = new LevelIncome();
            $insert->memberid = $sponsorid;
            $insert->level = $level;
            $insert->amount = $amount;
            $insert->rate = $rate;
            $insert->level_id = $memberid;
            $insert->name = $name;
            $insert->package = $package;
            $insert->status = 'Paid';
            $insert->save();

            $wallet = $var->wallet;
            $var->wallet += $amount;
            $var->save();

            walletTransfer($sponsorid, $amount, 'debit', $wallet, 'Level Income', '' . $i . ' Level Income Amount Added into Wallet.');

            $sponsorid = $var['sponsorid'];
        } else {
            break;
        }
    }
}

function levelRate($level)
{
    if ($level == 1) {
        $rate = 10;
    } elseif ($level == 2) {
        $rate = 5;
    } elseif ($level == 3) {
        $rate = 3;
    } elseif ($level >= 4 && $level <= 5) {
        $rate = 2;
    } elseif ($level >= 6 && $level <= 10) {
        $rate = 1;
    } elseif ($level >= 11 && $level <= 15) {
        $rate = 0.5;
    } elseif ($level >= 16 && $level <= 18) {
        $rate = 0.25;
    } else {
        $rate = 0;
    }

    return $rate;
}

function financialyear()
{
    if (date('m') <= 4) {
        $financial_year = (date('Y') - 1) . '-' . date('Y');
    } else {
        $financial_year = (date('Y') . '-' . date('Y') + 1);
    }
    return $financial_year;
}

function getinvoiceno()
{
    $check = InvoiceTable::orderby('created_at', 'DESC')->first();
    if ($check) {
        $series = $check->invoice_series + 1;
        $invoice = getseries($series);
    } else {
        $invoice = '000001';
    }
    return $invoice;
}

function getinvoiceseries()
{
    $check = InvoiceTable::orderby('created_at', 'DESC')->first();
    if ($check) {
        $series = $check->invoice_series + 1;
    } else {
        $series = 1;
    }
    return $series;
}

function getSeries($series)
{
    if ($series < 10) {
        $invoice = '00000' . $series;
    } elseif ($series > 9  && $series < 100) {
        $invoice = '0000' . $series;
    } elseif ($series > 99  && $series < 1000) {
        $invoice = '000' . $series;
    } elseif ($series > 999  && $series < 10000) {
        $invoice = '00' . $series;
    } elseif ($series > 9999  && $series < 10000) {
        $invoice = '0' . $series;
    } elseif ($series > 99999) {
        $invoice = $series;
    }

    return $invoice;
}

function getCompanyTurnover()
{
    $first = date('Y-m-1', strtotime('- 1 month'));
    $last = date('Y-m-t', strtotime('- 1 month'));
    $turnover = OrderDetail::where('status', 'Completed')->whereBetween('created_at', [$first, $last])->sum('value');
    return $turnover / 100 * 5;
}

function firstLegBiz($memberid)
{
    $directs = MemberDetail::where('sponsorid', $memberid)->orderBy('team_biz', 'desc')->get();

    if ($directs) {
        $biz = (int) $directs->pluck('team_biz')->first();
    } else {
        $biz = 0;
    }
    return $biz;
}

function secondLegBiz($memberid)
{

    $directs = MemberDetail::where('sponsorid', $memberid)->orderBy('team_biz', 'desc')->get();
    $firstTeam = (int) $directs->pluck('team_biz')->first();
    if ($firstTeam) {
        $secondTeam = (int) $directs->slice(1)->pluck('team_biz')->first();
        $biz = $secondTeam;
    } else {
        $biz = 0;
    }

    return $biz;
}

function thirdLegBiz($memberid)
{

    $directs = MemberDetail::where('sponsorid', $memberid)->orderBy('team_biz', 'desc')->get();
    $firstTeam = (int) $directs->pluck('team_biz')->first();
    if ($firstTeam) {
        $secondTeam = (int) $directs->slice(1)->pluck('team_biz')->first();
        if ($secondTeam) {
            $thirdTeam = (int) $directs->slice(2)->pluck('team_biz')->first();
            $biz = $thirdTeam;
        } else {
            $biz = 0;
        }
    } else {
        $biz = 0;
    }

    return $biz;
}


function fourthLegBiz($memberid)
{
    $directs = MemberDetail::where('sponsorid', $memberid)->orderBy('team_biz', 'desc')->get();
    $firstTeam = (int) $directs->pluck('team_biz')->first();
    if ($firstTeam) {
        $secondTeam = (int) $directs->slice(1)->pluck('team_biz')->first();
        if ($secondTeam) {
            $thirdTeam = (int) $directs->slice(2)->pluck('team_biz')->first();
            if ($thirdTeam) {
                $remaining = $directs->slice(3);
                $fourthTeam = (int) $remaining->sum('team_biz');
                $biz = $fourthTeam;
            } else {
                $biz = 0;
            }
        } else {
            $biz = 0;
        }
    } else {
        $biz = 0;
    }

    return $biz;
}

function binary_biz_update($memberid, $placementid, $position, $value)
{
    while ($placementid != 'Root') {
        if ($position == 'Left') {
            $query = MemberDetail::where('memberid', $placementid)->first();
            $query->left_amount +=  $value;
            $query->left_balance +=  $value;
            // $query->left_bonus +=  $value;
            $query->save();
            $position = $query->position;
            $placementid = $query->placementid;
        } elseif ($position == 'Right') {
            $query = MemberDetail::where('memberid', $placementid)->first();
            $query->right_amount +=  $value;
            $query->right_balance +=  $value;
            // $query->right_bonus +=  $value;
            $query->save();
            $position = $query->position;
            $placementid = $query->placementid;
        }
    }
}


function checkForwarded($memberid, $side)
{
    $var = BinaryIncome::where('memberid', $memberid)->latest()->first();

    if ($var) {
        if ($side == 'Left') {
            $forward = $var->forward_left;
        } elseif ($side == 'Right') {
            $forward = $var->forward_right;
        }
        return $forward;
    } else {
        return 0;
    }
}
function montorshipLevelRate($level)
{

    if ($level == 1) {
        $rate = 10;
        $direct = 2;
    } elseif ($level == 2) {
        $rate = 5;
        $direct = 3;
    } elseif ($level == 3) {
        $rate = 3;
        $direct = 4;
    } elseif ($level == 4) {
        $rate = 2;
        $direct = 5;
    } else {
        $rate = 0;
        $direct = 0;
    }

    return [
        'rate' => $rate,
        'direct' => $direct,
    ];
}
