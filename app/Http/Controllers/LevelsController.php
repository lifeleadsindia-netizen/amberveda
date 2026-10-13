<?php

namespace App\Http\Controllers;

use App\Models\MemberDetail;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    public function directMembers()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['directData'] = MemberDetail::where('sponsorid', $result['data']['memberid'])->get();
        return view('member.team.direct-members')->with($result);
    }

    public function geneology()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['d_data'] = MemberDetail::where('memberid', $memberid)->first();
        $leftid = $result['d_data']['left_id'];
        $rightid = $result['d_data']['right_id'];
        $result['leftdata'] = MemberDetail::where('memberid', $leftid)->first();
        if (isset($result['leftdata']['left_id'])) {
            $result['leftleft'] = MemberDetail::where('memberid', $result['leftdata']['left_id'])->first();
        } else {
            $result['leftleft'] = null;
        }

        if (isset($result['leftdata']['right_id'])) {
            $result['leftright'] = MemberDetail::where('memberid', $result['leftdata']['right_id'])->first();
        } else {
            $result['leftright'] = null;
        }

        $result['rightdata'] = MemberDetail::where('memberid', $rightid)->first();
        if (isset($result['rightdata']['left_id'])) {
            $result['rightleft'] = MemberDetail::where('memberid', $result['rightdata']['left_id'])->first();
        } else {
            $result['rightleft'] = null;
        }
        if (isset($result['rightdata']['right_id'])) {
            $result['rightright'] = MemberDetail::where('memberid', $result['rightdata']['right_id'])->first();
        } else {
            $result['rightright'] = null;
        }
        $result['directCount'] = MemberDetail::where('sponsorid', $memberid)->count();
        return view('member.team.binary-tree')->with($result);
    }

    public function ViewGeneology($did)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['d_data'] = MemberDetail::find($did);
        $leftid = $result['d_data']['left_id'];
        $rightid = $result['d_data']['right_id'];
        $result['leftdata'] = MemberDetail::where('memberid', $leftid)->first();

        if (isset($result['leftdata']['left_id'])) {
            $result['leftleft'] = MemberDetail::where('memberid', $result['leftdata']['left_id'])->first();
        } else {
            $result['leftleft'] = null;
        }

        if (isset($result['leftdata']['right_id'])) {
            $result['leftright'] = MemberDetail::where('memberid', $result['leftdata']['right_id'])->first();
        } else {
            $result['leftright'] = null;
        }

        $result['rightdata'] = MemberDetail::where('memberid', $rightid)->first();
        if (isset($result['rightdata']['left_id'])) {
            $result['rightleft'] = MemberDetail::where('memberid', $result['rightdata']['left_id'])->first();
        } else {
            $result['rightleft'] = null;
        }
        if (isset($result['rightdata']['right_id'])) {
            $result['rightright'] = MemberDetail::where('memberid', $result['rightdata']['right_id'])->first();
        } else {
            $result['rightright'] = null;
        }

        return view('member.team.view-geneology')->with($result);
    }

    public function searchGenelogy(Request $request)
    {
        $request->validate([
            'searchid' => 'required'
        ]);
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $searchid = $request->post('searchid');
        $result['d_data'] = MemberDetail::where('memberid', $searchid)->first();
        if (!$result['d_data']) {
            session()->flash('searchMsg', 'This memberid is not registered with us');
            return redirect()->to('member/team/geneology');
        }

        if ($memberid == $searchid) {
            session()->flash('searchMsg', 'You have entered your own memberid');
            return redirect()->to('member/team/geneology');
        }

        $leftid = $result['d_data']['left_id'];
        $rightid = $result['d_data']['right_id'];
        $result['leftdata'] = MemberDetail::where('memberid', $leftid)->first();
        if (isset($result['leftdata']['left_id'])) {
            $result['leftleft'] = MemberDetail::where('memberid', $result['leftdata']['left_id'])->first();
        } else {
            $result['leftleft'] = null;
        }

        if (isset($result['leftdata']['right_id'])) {
            $result['leftright'] = MemberDetail::where('memberid', $result['leftdata']['right_id'])->first();
        } else {
            $result['leftright'] = null;
        }

        $result['rightdata'] = MemberDetail::where('memberid', $rightid)->first();
        if (isset($result['rightdata']['left_id'])) {
            $result['rightleft'] = MemberDetail::where('memberid', $result['rightdata']['left_id'])->first();
        } else {
            $result['rightleft'] = null;
        }
        if (isset($result['rightdata']['right_id'])) {
            $result['rightright'] = MemberDetail::where('memberid', $result['rightdata']['right_id'])->first();
        } else {
            $result['rightright'] = null;
        }
        return view('member.team.binary-tree')->with($result);
    }

    public function lelMemTable()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.team.level-members-table')->with($result);
    }

    public function lelMemDetails($level)
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['data'] = MemberDetail::where('memberid', $memberid)->first();
        $i = 2;
        $total = 0;
        if ($level == 1) {
            $members = MemberDetail::where('sponsorid', $memberid)->pluck('memberid');
            $result['users'] = MemberDetail::whereIn('memberid', $members)->get();
        } else {
            $members = MemberDetail::where('sponsorid', $memberid)->pluck('memberid');
            while (count($members) != 0) {
                $members = MemberDetail::whereIn('sponsorid', $members)->pluck('memberid');
                $result['users'] = MemberDetail::whereIn('memberid', $members)->get();
                $total = count($members);
                if ($level == $i) {
                    break;
                }
                $i++;
            }
        }
        $result['levelNo'] = $level;

        return view('member.team.level-members-details')->with($result);
    }
}
