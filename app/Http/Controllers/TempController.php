<?php

namespace App\Http\Controllers;

use App\Models\LevelIncome;
use App\Models\AssuredBonus;
use App\Models\BinaryIncome;
use App\Models\ClubIncome;
use App\Models\DeliveryIncome;
use App\Models\FranchiseDetail;
use App\Models\MemberDetail;
use App\Models\RewardIncome;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\RetailProfit;
use App\Models\PackageDetail;
use App\Models\SalesBonusIncome;
use App\Models\TravelFundDetail;


class TempController extends Controller
{

    public function binaryIncomedis()
    {
        $members = MemberDetail::where('status', 'Active')->get();

        $levels = [
            ['rank' => 'Basic',             'min' => 100,      'max' => 350,       'amount' => 1000,      'status' => 1],
            ['rank' => 'Starter',           'min' => 350,      'max' => 850,       'amount' => 2500,      'status' => 2],
            ['rank' => 'Bronze',            'min' => 850,      'max' => 1850,      'amount' => 5000,      'status' => 3],
            ['rank' => 'Silver',            'min' => 1850,     'max' => 3850,      'amount' => 10000,     'status' => 4],
            ['rank' => 'Gold',              'min' => 3850,     'max' => 7850,      'amount' => 20000,     'status' => 5],
            ['rank' => 'Ruby',              'min' => 7850,     'max' => 15850,     'amount' => 40000,     'status' => 6],
            ['rank' => 'Pearl',             'min' => 15850,    'max' => 31850,     'amount' => 80000,     'status' => 7],
            ['rank' => 'Sapphire',          'min' => 31850,    'max' => 63850,     'amount' => 160000,    'status' => 8],
            ['rank' => 'Emerald',           'min' => 63850,    'max' => 127850,    'amount' => 320000,    'status' => 9],
            ['rank' => 'Diamond',           'min' => 127850,   'max' => 255850,    'amount' => 640000,    'status' => 10],
            ['rank' => 'Crown Diamond',     'min' => 255850,   'max' => 511850,    'amount' => 1280000,   'status' => 11],
            ['rank' => 'Royal Diamond',     'min' => 511850,   'max' => 1023850,   'amount' => 2560000,   'status' => 12],
            ['rank' => 'Star Diamond',      'min' => 1023850,  'max' => 2047850,   'amount' => 5120000,   'status' => 13],
            ['rank' => 'Blue Diamond',      'min' => 2047850,  'max' => 4095850,   'amount' => 10240000,  'status' => 14],
            ['rank' => 'Black Diamond',     'min' => 4095850,  'max' => 8191850,   'amount' => 20480000,  'status' => 15],
            ['rank' => 'Ambassador',        'min' => 8191850,  'max' => 16383850,  'amount' => 40960000,  'status' => 16],
            ['rank' => 'Crown Ambassador',  'min' => 16383850, 'max' => 180223850,  'amount' => 81920000,  'status' => 17],
            ['rank' => 'Royal Ambassador',  'min' => 180223850, 'max' => null,      'amount' => 163840000, 'status' => 18],
        ];

        foreach ($members as $member) {

            $memberid  = $member->memberid;
            $left  = $member->left_amount;
            $right = $member->right_amount;
            $rank = $member->rank;

            if ($left == 0 || $right == 0) {
                continue;
            }

            $amount = 0;
            $binaryStatus = $member->binary_status;
            $nextStatus = $binaryStatus + 1;

            $level = null;
            foreach ($levels as $lvl) {
                if ($lvl['status'] == $nextStatus && $lvl['rank'] == $rank) {
                    $level = $lvl;
                    break;
                }
            }

            if ($level && $left >= $level['min'] && $right >= $level['min'] && $binaryStatus < $nextStatus) {
                $amount = $level['amount'];
                $binaryStatus = $nextStatus;
            }

            if ($amount > 0) {
                $new = new BinaryIncome();
                $new->memberid = $memberid;
                $new->left_sp = $left;
                $new->right_sp = $right;
                $new->package = $member->package;
                $new->rank = $level['rank'];
                $new->amount = $amount;
                $new->total_amount = $amount;
                $new->status = 'Paid';
                $new->save();

                $wallet = $member->wallet;
                $member->wallet += $amount;
                $member->binary_status = $binaryStatus;
                $member->save();

                walletTransfer(
                    $memberid,
                    $amount,
                    'debit',
                    $wallet,
                    'Binary Income',
                    'Binary Income Amount Added into Commission wallet.'
                );
            }
        }
    }

    public function salesBonusInc()
    {
        $members = MemberDetail::where('status', 'Active')->get();

        $levels = [
            ['min' => 100, 'max' => 200, 'amount' => 1500, 'status' => 1, 'rank' => 'Basic'],
            ['min' => 350, 'max' => 700, 'amount' => 3750, 'status' => 2, 'rank' => 'Starter'],
            ['min' => 850, 'max' => 1700, 'amount' => 7500, 'status' => 3, 'rank' => 'Bronze'],
            ['min' => 1850, 'max' => 3700, 'amount' => 15000, 'status' => 4, 'rank' => 'Silver'],
            ['min' => 3850, 'max' => 7700, 'amount' => 30000, 'status' => 5, 'rank' => 'Gold'],
            ['min' => 7850, 'max' => 15700, 'amount' => 60000, 'status' => 6, 'rank' => 'Ruby'],
            ['min' => 15850, 'max' => 31700, 'amount' => 120000, 'status' => 7, 'rank' => 'Pearl'],
            ['min' => 31850, 'max' => 63700, 'amount' => 150000, 'status' => 8, 'rank' => 'Sapphire'],
            ['min' => 63850, 'max' => 127700, 'amount' => 480000, 'status' => 9, 'rank' => 'Emerald'],
            ['min' => 128850, 'max' => 255700, 'amount' => 300000, 'status' => 10, 'rank' => 'Diamond'],
            ['min' => 258850, 'max' => 511700, 'amount' => 700000, 'status' => 11, 'rank' => 'Crown Diamond'],
            ['min' => 518850, 'max' => 1023700, 'amount' => 1440000, 'status' => 12, 'rank' => 'Royal Diamond'],
            ['min' => 1038850, 'max' => 2047700, 'amount' => 2200000, 'status' => 13, 'rank' => 'Star Diamond'],
            ['min' => 2078850, 'max' => 4095000, 'amount' => 5760000, 'status' => 14, 'rank' => 'Blue Diamond'],
            ['min' => 4158850, 'max' => 8191700, 'amount' => 9520000, 'status' => 15, 'rank' => 'Black Diamond'],
            ['min' => 8318850, 'max' => 16383700, 'amount' => 122880000, 'status' => 16, 'rank' => 'Ambassador'],
            ['min' => 16638850, 'max' => 32767700, 'amount' => 80000000, 'status' => 17, 'rank' => 'Crown Ambassador'],
            ['min' => 33278850, 'max' => 65535700, 'amount' => 491520000, 'status' => 18, 'rank' => 'Royal Ambassador'],
        ];

        foreach ($members as $member) {

            $memberid  = $member->memberid;
            $left  = $member->left_amount;
            $right = $member->right_amount;
            $rank = $member->rank;

            if ($left == 0 || $right == 0) {
                continue;
            }

            $amount = 0;
            $bonus_status = $member->sales_bonus_status;
            $nextStatus = $bonus_status + 1;

            $level = null;
            foreach ($levels as $lvl) {
                if ($lvl['status'] == $nextStatus && $lvl['rank'] == $rank) {
                    $level = $lvl;
                    break;
                }
            }

            if (
                $level  && $bonus_status < $nextStatus &&
                (
                    ($left >= $level['min'] && $right >= $level['max']) ||
                    ($left >= $level['max'] && $right >= $level['min'])
                )
            ) {
                $amount = $level['amount'];
                $bonus_status = $nextStatus;
            }


            if ($amount > 0) {

                $var = new SalesBonusIncome();
                $var->memberid = $memberid;
                $var->left_sp = $left;
                $var->right_sp = $right;
                $var->package = $member->package;
                $var->rank = $level['rank'];
                $var->amount = $amount;
                $var->total_amount = $amount;
                $var->status = 'Paid';
                $var->save();

                $wallet = $member->wallet;
                $member->wallet += $amount;
                $member->sales_bonus_status = $bonus_status;
                $member->save();

                walletTransfer(
                    $memberid,
                    $amount,
                    'debit',
                    $wallet,
                    'Sales Bonus Income',
                    'Sales Bonus Amount Added into Wallet'
                );
            }
        }
    }

    public function rewardsGen()
    {
        $rewards = [
            1  => ['rank' => 'Starter', 'reward' => null],
            2  => ['rank' => 'Bronze', 'reward' => 'Suit piece + certificate'],
            3  => ['rank' => 'Silver', 'reward' => 'Smart watch'],
            4  => ['rank' => 'Gold', 'reward' => 'Tablet'],
            5  => ['rank' => 'Ruby', 'reward' => 'Domestic tour'],
            6  => ['rank' => 'Pearl', 'reward' => '25000/- cash reward'],
            7  => ['rank' => 'Sapphire', 'reward' => 'Goa tour'],
            8  => ['rank' => 'Emerald', 'reward' => '1.00 Lac bike fund'],
            9  => ['rank' => 'Diamond', 'reward' => 'Thailand tour'],
            10 => ['rank' => 'Crown Diamond', 'reward' => 'Tata punch base model'],
            11 => ['rank' => 'Royal Diamond', 'reward' => 'Sedan car'],
            12 => ['rank' => 'Star Diamond', 'reward' => 'XUV700/ Tata harrier'],
            13 => ['rank' => 'Blue Diamond', 'reward' => 'Audi A4'],
            14 => ['rank' => 'Black Diamond', 'reward' => 'BMW car + 5.0 Lac gold fund'],
            15 => ['rank' => 'Ambassador', 'reward' => 'Range rover car + 25Lac house fund + Foreign tour'],
            16 => ['rank' => 'Crown Ambassador', 'reward' => '1.5 Cr Car fund + Foreign tour + 50.0L diamond fund'],
            17 => ['rank' => 'Royal Ambassador', 'reward' => 'Luxury car + House fund + Foreign trip'],
            18 => ['rank' => 'Global Ambassador', 'reward' => '5.0Cr cash Europe trip + 25L diamond fund'],
        ];

        foreach ($rewards as $level => $data) {
            $members = MemberDetail::where([
                ['status', 'Active'],
                ['binary_status', $level],
                ['sales_bonus_status', $level],
                ['reward_status', $level - 1],
            ])->get();
            
            foreach ($members as $member) {
               
                if ($data['reward']) {
                    
                    $var = new RewardIncome();
                    $var->memberid = $member->memberid;
                    $var->reward =  $data['reward'];
                    $var->status = 'Unpaid';
                    $var->save();
                }

                $member->rank = $data['rank'];
                $member->reward_status += 1;
                $member->save();
            }
        }
    }
    
    public function weeklyPayouts()
    {
        
        // if (date('D') == 'Mon') {
            ini_set('max_execution_time', 120);
            $members = MemberDetail::where([['status', 'Active'], ['kyc_status', 'Verified'], ['wallet', '>=', 500]])->get();
            if (count($members) > 0) {
                foreach ($members as $key) {
                    $memberid = $key->memberid;
                    $amount = $key->wallet;
                    $date = date('Y-m-d H:i:s');
                    $requestId = $memberid . time();
    
                    $var = new WithdrawalRequest();
                    $var->request_date = $date;
                    $var->request_id = $requestId;
                    $var->memberid = $memberid;
                    $var->name = $key['name'];
                    $var->bank = $key['bank'];
                    $var->ifsc = $key['ifsc'];
                    $var->holder = $key['holder'];
                    $var->account = $key['account_no'];
                    $var->gross_amount = $amount;
                    $service = $amount / 100 * 5;
                    $var->service_charge = $service;
                    $tds_charge = $amount / 100 * 2;
                    $var->tds = $tds_charge;
                    $total_charge = $service + $tds_charge;
                    $netAmount = $amount - $total_charge;
                    $var->net_amount = $netAmount;
                    $var->save();
                    
                    $qry = MemberDetail::find($key->id);
                    $wallet = $qry->wallet;
                    $qry->wallet -= $amount;
                    $qry->save();
    
                    walletTransfer($memberid, $amount, 'credit', $wallet, 'Withdrawal', ' ₹ ' . $amount . ' have been withdrawn by Member from wallet. Payment Id-' . $requestId);
                }
            }
        // }
    }
    
    public function travelFund()
    {
        // First Travel Reward
        $members = MemberDetail::where([
            ['status', 'Active'],
            ['right_amount', '>=', 200000],
            ['left_amount', '>=', 200000],
            ['travel_fund_status', 0]
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail();
            $var->memberid = $memberid;
            $var->right_business_achievement = $right_business;
            $var->left_business_achievement = $left_business;
            $var->travel_reward = 'Domestic Trip Fund';
            $var->status = 'Unpaid';
            $var->save();

            $value->travel_fund_status += 1;
            $value->save();
        }

        // Second Travel Reward
        $members = MemberDetail::where([
            ['status', 'Active'],
            ['right_amount', '>=', 1000000],
            ['left_amount', '>=', 1000000],
            ['travel_fund_status', 1]
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail();
            $var->memberid = $memberid;
            $var->right_business_achievement = $right_business;
            $var->left_business_achievement = $left_business;
            $var->travel_reward = 'International Trip Fund';
            $var->status = 'Unpaid';
            $var->save();

            $value->travel_fund_status += 1;
            $value->save();
        }

        // Third Travel Reward
        $members = MemberDetail::where([
            ['status', 'Active'],
            ['right_amount', '>=', 2500000],
            ['left_amount', '>=', 2500000],
            ['travel_fund_status', 2]
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail();
            $var->memberid = $memberid;
            $var->right_business_achievement = $right_business;
            $var->left_business_achievement = $left_business;
            $var->travel_reward = 'Family Vacation Fund';
            $var->status = 'Unpaid';
            $var->save();

            $value->travel_fund_status += 1;
            $value->save();
        }

        // Fourth Travel Reward
        $members = MemberDetail::where([
            ['status', 'Active'],
            ['right_amount', '>=', 10000000],
            ['left_amount', '>=', 10000000],
            ['travel_fund_status', 3]
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail();
            $var->memberid = $memberid;
            $var->right_business_achievement = $right_business;
            $var->left_business_achievement = $left_business;
            $var->travel_reward = 'Luxury World Tour Fund';
            $var->status = 'Unpaid';
            $var->save();

            $value->travel_fund_status += 1;
            $value->save();
        }
    }
    
    public function updateClub()
    {
        $members = MemberDetail::where([['status', 'Active'], ['left_amount', '>=', 100000], ['right_amount', '>=', 100000]])->get();
        foreach ($members as $value) {
            $right = $value->right_amount;
            $left = $value->left_amount;
            $club_status = 0;

            if ($right >= 1000000 && $left >= 1000000) {
                $club_status = 3;
            } else if ($right >= 500000 && $left >= 500000 && $right < 1000000 && $left < 1000000) {
                $club_status = 2;
            } else if ($right >= 100000 && $left >= 100000 && $right < 500000 && $left < 500000) {
                $club_status = 1;
            }
            $value->club_status = $club_status;
            $value->save();
        }
    }
    
    public function clubIncomeDis()
    {
        // first cto
        $cto = monthlyCTO();
        $members = MemberDetail::where([['status', 'Active'], ['club_status', 1]])->get();
        $membersCount = count($members);
        if ($cto > 0 && $membersCount > 0) {
            $total_amount = $cto / 100 * 2;
            $amount = $total_amount / $membersCount;
            foreach ($members as $value) {
                $memberid = $value->memberid;
                                              
                $insert = new ClubIncome();
                $insert->memberid = $memberid;
                $insert->monthly_cto = $cto;
                $insert->members = $membersCount;
                $insert->total_amount = $total_amount;
                $insert->amount = $amount;
                $insert->club_rank = 'Silver Club';
                $insert->status = 'Paid';
                $insert->save();

                $wallet = $value->wallet;
                $value->wallet += $amount;
                $value->save();

                walletTransfer($memberid, $amount, 'debit', $wallet, 'Club Income', 'Club Income amount has been transfered into wallet.');
            }
        }

        // second cto
        $cto = monthlyCTO();
        $members = MemberDetail::where([['status', 'Active'], ['club_status', 2]])->get();
        $membersCount = count($members);
        if ($cto > 0 && $membersCount > 0) {
            $total_amount = $cto / 100 * 3;
            $amount = $total_amount / $membersCount;
            foreach ($members as $value) {
                $memberid = $value->memberid;
                
                $insert = new ClubIncome();
                $insert->memberid = $memberid;
                $insert->monthly_cto = $cto;
                $insert->members = $membersCount;
                $insert->total_amount = $total_amount;
                $insert->amount = $amount;
                $insert->club_rank = 'Gold Club';
                $insert->status = 'Paid';
                $insert->save();

                $wallet = $value->wallet;
                $value->wallet += $amount;
                $value->save();

                walletTransfer($memberid, $amount, 'debit', $wallet, 'Club Income', 'Club Income amount has been transfered into wallet.');
            }
        }

        // third cto
         $cto = monthlyCTO();
        $members = MemberDetail::where([['status', 'Active'], ['club_status', 3]])->get();
        $membersCount = count($members);
        if ($cto > 0 && $membersCount > 0) {
            $total_amount = $cto / 100 * 5;
            $amount = $total_amount / $membersCount;
            foreach ($members as $value) {
                $memberid = $value->memberid;
                
                $insert = new ClubIncome();
                $insert->memberid = $memberid;
                $insert->monthly_cto = $cto;
                $insert->members = $membersCount;
                $insert->total_amount = $total_amount;
                $insert->amount = $amount;
                $insert->club_rank = 'Diamond Club';
                $insert->status = 'Paid';
                $insert->save();

                $wallet = $value->wallet;
                $value->wallet += $amount;
                $value->save();

                walletTransfer($memberid, $amount, 'debit', $wallet, 'Club Income', 'Club Income amount has been transfered into wallet.');
            }
        }
    }
}
