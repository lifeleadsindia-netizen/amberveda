<?php

namespace App\Console\Commands;

use App\Models\BinaryIncome;
use App\Models\MemberDetail;
use App\Models\MentorshipIncome;
use App\Models\UplineMember;
use Illuminate\Console\Command;

class MentorshipIncomedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mentorship-incomedis';

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
