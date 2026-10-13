<?php

namespace App\Console\Commands;

use App\Models\MemberDetail;
use App\Models\TravelFundDetail;
use Illuminate\Console\Command;

class TravelFund extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:travel-fund';

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
        // First Travel Reward
        $members = MemberDetail::where([
            ['status', 'Active'],
            ['right_amount', '>=', 200000],
            ['left_amount', '>=', 200000],
            ['travel_fund_status', 0],
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail;
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
            ['travel_fund_status', 1],
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail;
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
            ['travel_fund_status', 2],
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail;
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
            ['travel_fund_status', 3],
        ])->get();

        foreach ($members as $value) {
            $memberid = $value->memberid;
            $right_business = $value->right_amount;
            $left_business = $value->left_amount;

            $var = new TravelFundDetail;
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
}
