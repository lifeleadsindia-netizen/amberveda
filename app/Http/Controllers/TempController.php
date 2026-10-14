<?php

namespace App\Http\Controllers;

use App\Models\LevelIncome;
use App\Models\AssuredBonus;
use App\Models\BinaryIncome;
use App\Models\ClubIncome;
use App\Models\DeliveryIncome;
use App\Models\FranchiseDetail;
use App\Models\MemberDetail;
use App\Models\MentorshipIncome;
use App\Models\UplineMember;
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
        $members = MemberDetail::where([['status', 'Active'], ['left_balance', '>=', 30], ['right_balance', '>=', 30]])->get();
        foreach ($members as $member) {
            $left = $member['left_balance'];
            $right = $member['right_balance'];

            if ($left != 0 && $right != 0) {

                $left_balance = 0;
                $right_balance = 0;

                if ($left > $right) {
                    $matching = $right;
                    $left_balance = $left - $right;
                    $right_balance = 0;
                } elseif ($right > $left) {
                    $matching = $left;
                    $right_balance = $right - $left;
                    $left_balance = 0;
                } elseif ($right == $left) {
                    $matching = $left;
                    $left_balance = 0;
                    $right_balance = 0;
                }
                $memberid = $member['memberid'];

                if ($matching > 0) {
                    $rate = 10;

                    $c_amount = $rate * $matching;

                    if ($c_amount > 3000) {
                        $amount = 3000;
                        $flushout = $c_amount - 3000;
                    } else {
                        $amount = $c_amount;
                        $flushout = 0;
                    }

                    $frd_left = checkForwarded($memberid, 'Left');
                    $frd_right =  checkForwarded($memberid, 'Right');

                    $var = new BinaryIncome();
                    $var->memberid = $memberid;
                    $var->left_forwarded = $frd_left;
                    $var->left_new = $left - $frd_left;
                    $var->total_left = $left;
                    $var->right_forwarded = $frd_right;
                    $var->right_new = $right - $frd_right;
                    $var->total_right = $right;
                    $var->matching = $matching;
                    $var->total_amount = $c_amount;
                    $var->flushout = $flushout;
                    $var->amount = $amount;
                    $var->forward_left = $left_balance;
                    $var->forward_right = $right_balance;
                    $var->status = 'Paid';
                    $var->save();

                    $qry = MemberDetail::find($member['id']);
                    $qry->left_balance = $left_balance;
                    $qry->right_balance = $right_balance;
                    $wallet = $qry->wallet;
                    $qry->wallet += $amount;
                    $qry->save();

                    walletTransfer($memberid, $amount, 'debit', $wallet, 'Binary Income', 'Binary Income Amount Added into wallet.');
                }
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

    public function mentorshipIncomeDiss()
    {
        $members = MemberDetail::where('status', 'Active')
            ->where('downline', '>=', 2)
            ->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $downline = (int) $value->downline;

            if ($memberid != 'Root') {
                $limit = 5;
                for ($i = 1; $i < $limit; $i++) {
                    $level = $i;
                    $levelData = montorshipLevelRate($level);
                    $requiredDirects = (int) ($levelData['direct'] ?? 2);
                    $rate = (int) ($levelData['rate'] ?? 2);

                    if ($downline < $requiredDirects) {
                        break;
                    }

                    $downlineMemberIds = UplineMember::where('upline_' . $level, $memberid)->pluck('memberid')->toArray();
                    if (count($downlineMemberIds) == 0) {
                        break;
                    }
                    $sum = BinaryIncome::whereIn('memberid', $downlineMemberIds)->whereDate('created_at', date('Y-m-d'))->sum('amount');
                    $share = $sum / count($downlineMemberIds);

                    $amount = $share * $rate / 100;

                    if ($amount > 0) {

                        $new = new MentorshipIncome();
                        $new->memberid = $memberid;
                        $new->level = $level;
                        $new->total_members = count($downlineMemberIds);
                        $new->rate = $rate;
                        $new->downline = $downline;
                        $new->total_matching = $sum;
                        $new->share = $share;
                        $new->amount = $amount;
                        $new->type = 'Mentorship Income';
                        $new->status = 'Paid';
                        $new->save();

                        $wallet = $value->wallet;
                        $value->wallet += $amount;
                        $value->save();

                        walletTransfer(
                            $memberid,
                            $amount,
                            'debit',
                            $wallet,
                            'Mentorship Income',
                            'Level ' . $level . ' Mentorship Income Amount Added into wallet.'
                        );
                    }
                }
            }
        }
    }
}
