<?php

namespace App\Console\Commands;

use App\Models\MemberDetail;
use App\Models\WithdrawalRequest;
use Illuminate\Console\Command;

class WeeklyPayouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:weekly-payouts';

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
        if (date('D') == 'Mon') {
            ini_set('max_execution_time', 120);
            $members = MemberDetail::where([['status', 'Active'], ['kyc_status', 'Verified'], ['wallet', '>=', 500]])->get();
            if (count($members) > 0) {
                foreach ($members as $key) {
                    $memberid = $key->memberid;
                    $amount = $key->wallet;
                    $date = date('Y-m-d H:i:s');
                    $requestId = $memberid.time();

                    $var = new WithdrawalRequest;
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

                    walletTransfer($memberid, $amount, 'credit', $wallet, 'Withdrawal', ' ₹ '.$amount.' have been withdrawn by Member from wallet. Payment Id-'.$requestId);
                }
            }
        }
    }
}
