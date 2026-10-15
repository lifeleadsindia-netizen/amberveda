<?php

namespace App\Console\Commands;

use App\Models\BinaryIncome;
use App\Models\MemberDetail;
use Illuminate\Console\Command;

class BinaryIncomedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:binary-incomedis';

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
        $members = MemberDetail::where([['status', 'Active'], ['left_balance', '>=', 30], ['right_balance', '>=', 30]])->get();
        foreach ($members as $member) {
            $selfBiz = $member['self_biz'];

            if ($selfBiz < 3000) {
                continue;
            }

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

                    if ($selfBiz >= 3000 || $selfBiz < 5000) {
                        if ($c_amount > 3000) {
                            $amount = 30000;
                            $flushout = $c_amount - 30000;
                        } else {
                            $amount = $c_amount;
                            $flushout = 0;
                        }
                    } elseif ($selfBiz >= 5000 || $selfBiz < 7500) {
                        if ($c_amount > 60000) {
                            $amount = 60000;
                            $flushout = $c_amount - 60000;
                        } else {
                            $amount = $c_amount;
                            $flushout = 0;
                        }
                    } elseif ($selfBiz >= 7500 || $selfBiz < 10000) {
                        if ($c_amount > 100000) {
                            $amount = 100000;
                            $flushout = $c_amount - 100000;
                        } else {
                            $amount = $c_amount;
                            $flushout = 0;
                        }
                    } elseif ($selfBiz >= 10000) {
                        if ($c_amount > 150000) {
                            $amount = 150000;
                            $flushout = $c_amount - 150000;
                        } else {
                            $amount = $c_amount;
                            $flushout = 0;
                        }
                    } else {
                        $amount = 0;
                        $flushout = 0;
                    }

                    // $rate = 10;

                    // $c_amount = $rate * $matching;

                    // if ($c_amount > 3000) {
                    //     $amount = 3000;
                    //     $flushout = $c_amount - 3000;
                    // } else {
                    //     $amount = $c_amount;
                    //     $flushout = 0;
                    // }

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
}
