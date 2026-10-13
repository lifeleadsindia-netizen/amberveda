<?php

namespace App\Http\Controllers;

use App\Models\BinaryIncome;
use App\Models\BonusDetail;
use App\Models\DirectIncome;
use App\Models\KeyinIncome;
use App\Models\MemberDetail;
use App\Models\RapidRider;
use App\Models\SalesBonusIncome;
use App\Models\LevelIncome;
use App\Models\BonusLevelIncome;
use App\Models\RewardIncome;
use App\Models\RoyaltyIncome;
use App\Models\RetailProfit;
use App\Models\SponsorMatching;
use App\Models\StakingIncome;
use App\Models\StakingDetail;
use App\Models\TravelFundDetail;
use App\Models\ClubIncome;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
     public function rankAssuredBonus()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['rankData'] = RewardIncome::where('memberid', $memberid)->get();
        return view('member.assured-bonus.rank-assured-bonus-income')->with($result);
    }

    public function rankBonusDetails()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.assured-bonus.rank-bonus-details')->with($result);
    }

    public function travelIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['tData'] = TravelFundDetail::where([['memberid', $memberid], ['status', 'Paid']])->get();
        return view('member.income.travel-fund')->with($result);
    }

    public function ClubIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['clubData'] = ClubIncome::where('memberid', $memberid)->get();
        return view('member.income.club-income')->with($result);
    }
   

    public function binaryMatchingIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['bdata'] = BinaryIncome::where('memberid', $memberid)->get();
        return view('member.income.binary-matching-income')->with($result);
    }


    public function houseBonus()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['bonusData'] = BonusDetail::where([['memberid', $memberid], ['bonus_name', 'House Bonus']])->get();
        return view('member.bonus.house-bonus')->with($result);
    }


    public function levelIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['ldata'] = LevelIncome::where('memberid', $memberid)->get();
        return view('member.income.level-income')->with($result);
    }

    public function rewardDetails()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.income.reward-details')->with($result);
    }

    public function retailProfit()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['sdata'] = RetailProfit::where('memberid', $memberid)->get();
        return view('member.income.retail-profit')->with($result);
    }

    public function retailProfitDetails()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['sdata'] = RetailProfit::where('memberid', $memberid)->get();
        return view('member.income.retail-profit-details')->with($result);
    }

    public function salesBonusIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['udata'] = SalesBonusIncome::where('memberid', $memberid)->get();
        return view('member.income.sales-bonus-income')->with($result);
    }

    public function DirectBonus()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['pdata'] = DirectIncome::where('memberid', $memberid)->get();
        return view('member.income.retail-profit-income')->with($result);
    }

    public function levelBonus()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['bdata'] = LevelIncome::where('memberid', $memberid)->get();
        return view('member.income.binary-income')->with($result);
    }

    public function bonuslevelIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['kdata'] = BonusLevelIncome::where('memberid', $memberid)->get();
        return view('member.income.keyin-income')->with($result);
    }
    
     public function rewardInc()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['rdata'] = RewardIncome::where('memberid', $memberid)->get();
        return view('member.income.reward')->with($result);
    }
}
