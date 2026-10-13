<?php

namespace App\Console\Commands;

use App\Models\MemberDetail;
use App\Models\RewardIncome;
use Illuminate\Console\Command;

class RewardsGen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rewards-gen';

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
        $rewards = [
            1 => ['rank' => 'Starter', 'reward' => null],
            2 => ['rank' => 'Bronze', 'reward' => 'Suit piece + certificate'],
            3 => ['rank' => 'Silver', 'reward' => 'Smart watch'],
            4 => ['rank' => 'Gold', 'reward' => 'Tablet'],
            5 => ['rank' => 'Ruby', 'reward' => 'Domestic tour'],
            6 => ['rank' => 'Pearl', 'reward' => '25000/- cash reward'],
            7 => ['rank' => 'Sapphire', 'reward' => 'Goa tour'],
            8 => ['rank' => 'Emerald', 'reward' => '1.00 Lac bike fund'],
            9 => ['rank' => 'Diamond', 'reward' => 'Thailand tour'],
            10 => ['rank' => 'Crown Diamond', 'reward' => 'Tata punch base model'],
            11 => ['rank' => 'Royal Crown', 'reward' => 'Sedan car'],
            12 => ['rank' => 'Blue Royal', 'reward' => 'XUV700/ Tata harrier'],
            13 => ['rank' => 'Black Royal', 'reward' => 'Audi A4'],
            14 => ['rank' => 'Ambassador', 'reward' => 'BMW car + 5.0 Lac gold fund'],
            15 => ['rank' => 'Crown Ambassado', 'reward' => 'Range rover car + 25Lac house fund + Foreign tour'],
            16 => ['rank' => 'Global Ambassador', 'reward' => '1.5 Cr Car fund + Foreign tour + 50.0L diamond fund'],
            17 => ['rank' => 'International Crown', 'reward' => 'Luxury car + House fund + Foreign trip'],
            18 => ['rank' => 'Legend Star', 'reward' => '5.0Cr cash Europe trip + 25L diamond fund'],
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

                    $var = new RewardIncome;
                    $var->memberid = $member->memberid;
                    $var->reward = $data['reward'];
                    $var->status = 'Unpaid';
                    $var->save();
                }

                $member->rank = $data['rank'];
                $member->reward_status += 1;
                $member->save();
            }
        }
    }
}
