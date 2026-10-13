<?php

namespace App\Console\Commands;

use App\Models\MemberDetail;
use Illuminate\Console\Command;

class UpdateClub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-club';

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
        $members = MemberDetail::where([['status', 'Active'], ['left_amount', '>=', 100000], ['right_amount', '>=', 100000]])->get();
        foreach ($members as $value) {
            $right = $value->right_amount;
            $left = $value->left_amount;
            $club_status = 0;

            if ($right >= 1000000 && $left >= 1000000) {
                $club_status = 3;
            } elseif ($right >= 500000 && $left >= 500000 && $right < 1000000 && $left < 1000000) {
                $club_status = 2;
            } elseif ($right >= 100000 && $left >= 100000 && $right < 500000 && $left < 500000) {
                $club_status = 1;
            }
            $value->club_status = $club_status;
            $value->save();
        }
    }
}
