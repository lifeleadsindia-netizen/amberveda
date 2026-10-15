<?php

namespace App\Console\Commands;

use App\Models\MemberDetail;
use App\Models\SalesBonusIncome;
use Illuminate\Console\Command;

class SalesBonusInc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sales-bonus-inc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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
            ['min' => 518850, 'max' => 1023700, 'amount' => 1440000, 'status' => 12, 'rank' => 'Royal Crown'],
            ['min' => 1038850, 'max' => 2047700, 'amount' => 2200000, 'status' => 13, 'rank' => 'Blue Royal'],
            ['min' => 2078850, 'max' => 4095000, 'amount' => 5760000, 'status' => 14, 'rank' => 'Black Royal'],
            ['min' => 4158850, 'max' => 8191700, 'amount' => 9520000, 'status' => 15, 'rank' => 'Ambassador'],
            ['min' => 8318850, 'max' => 16383700, 'amount' => 122880000, 'status' => 16, 'rank' => 'Crown Ambassador'],
            ['min' => 16638850, 'max' => 32767700, 'amount' => 80000000, 'status' => 17, 'rank' => 'Global Ambassador'],
            ['min' => 33278850, 'max' => 65535700, 'amount' => 491520000, 'status' => 18, 'rank' => 'International Crown'],
        ];

        foreach ($members as $member) {

            $memberid = $member->memberid;
            $left = $member->left_amount;
            $right = $member->right_amount;
            $rank = $member->rank;
            $selfBiz = $member['self_biz'];

            if ($selfBiz < 3000) {
                continue;
            }

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
                $level && $bonus_status < $nextStatus &&
                (
                    ($left >= $level['min'] && $right >= $level['max']) ||
                    ($left >= $level['max'] && $right >= $level['min'])
                )
            ) {
                $amount = $level['amount'];
                $bonus_status = $nextStatus;
            }

            if ($amount > 0) {

                $var = new SalesBonusIncome;
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
}
