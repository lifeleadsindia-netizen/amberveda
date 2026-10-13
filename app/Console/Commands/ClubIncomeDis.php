<?php

namespace App\Console\Commands;

use App\Models\ClubIncome;
use App\Models\MemberDetail;
use Illuminate\Console\Command;

class ClubIncomeDis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:club-income-dis';

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
        // first cto
        $cto = monthlyCTO();
        $members = MemberDetail::where([['status', 'Active'], ['club_status', 1]])->get();
        $membersCount = count($members);
        if ($cto > 0 && $membersCount > 0) {
            $total_amount = $cto / 100 * 2;
            $amount = $total_amount / $membersCount;
            foreach ($members as $value) {
                $memberid = $value->memberid;

                $insert = new ClubIncome;
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

                $insert = new ClubIncome;
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

                $insert = new ClubIncome;
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
