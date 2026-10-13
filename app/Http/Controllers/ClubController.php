<?php

namespace App\Http\Controllers;
use App\Models\AssuredBonus;
use Illuminate\Http\Request;
use App\Models\ClubIncome;
use App\Models\ClubAssuredIncome;
use App\Models\ClubMatrix;
use App\Models\ClubMember;
use App\Models\MemberDetail;

class ClubController extends Controller
{
    public function clubIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['kdata'] = ClubIncome::where('memberid', $memberid)->get();
        return view('member.club.club-income')->with($result);
    }
    
    public function clubDetails($id)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $array = [];
        $income = [];
        $amount = getPoolAmount($id);
        for ($i = 1; $i < 3; $i++) {
            $upline = 'upline_' . $i;
            $array[$i] = ClubMember::where([['club_no', $id], [$upline, $memberid]])->count();
            if ($array[$i] > 0) {
                $income[$i] =  $array[$i] * $amount;
            } else {
                $income[$i] = 0;
            }
        }

        $result['array'] = $array;
        $result['color'] = ['#eb2240', '#fbb03b', '#7ac943',  '#00a99d', '#2e3192',' #f8218cff'];
        $result['amount'] = $income;
        $result['club'] = $id;
        return view('member.club.club-details')->with($result);
    }

    public function clubMembers($club)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $array = [];
        $income = [];
        $amount = getPoolAmount($club);
        for ($i = 1; $i < 3; $i++) {
            $upline = 'upline_' . $i;
            $array[$i] = ClubMember::where([['club_no', $club], [$upline, $memberid]])->count();
            if ($array[$i] > 0) {
                $income[$i] =  $array[$i] * $amount;
            } else {
                $income[$i] = 0;
            }
        }
        $result['array'] = $array;
        $result['color'] = ['#eb2240', '#fbb03b', '#7ac943',  '#00a99d', '#2e3192',' #f8218cff'];
        $result['club_data'] = ClubMember::where([['upline_1', $memberid],['club_no', $club]])->get();
        $result['club'] = $club;
        return view('member.club.club-member')->with($result);
    }
    
     public function clubAssuredIncome()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['kdata'] = AssuredBonus::where('memberid', $memberid)->get();
        return view('member.club.assured-income')->with($result);
    }
}
