<?php

namespace App\Http\Controllers;

use App\Models\MemberActivation;
use App\Models\MemberDetail;
use App\Models\PackageDetail;
use App\Models\StakingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ActivationController extends Controller
{
    public function accountActivation()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['package_data'] = PackageDetail::where([['memberid', $memberid], ['package_type', 'Activation']])->first();
        return view('member.account.account-activation', $result);
    }

    public function activateUser(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'amount' => 'required|numeric',
            'txn_password' => 'required'
        ]);

        $amount = $request->post('amount');
        $txn_pas = $request->post('txn_password');
        $type = 'Activation';

        $memUpdate = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $memUpdate->memberid;
        $sponsorid = $memUpdate->sponsorid;
        $name = $memUpdate->name;
        $p2p_wallet = $memUpdate->p2p_wallet;
        $txn_password = $memUpdate->txn_password;
        $status = $memUpdate->status;
        $type = 'Activation';

        if ($amount < 1000) {
            session()->flash('failedMsg', '*** Minimum value is ₹ 1000');
            return redirect()->back();
        }
        if ($amount % 10 != 0) {
            session()->flash('failedMsg', 'Your value is not multiple of ₹ 10');
            return redirect()->back();
        }
        if (!Hash::check($txn_pas, $txn_password)) {
            session()->flash('failedMsg', '*** Entered Transaction Password donot match');
            return redirect()->back();
        }

        if ($p2p_wallet < $amount) {
            session()->flash('failedMsg', 'There is no enough balance in your P2P wallet to activate this amount');
            return redirect()->back();
        }
       
        $pack = new PackageDetail();
        $pack->txn_date = date('Y-m-d H:i:s');
        $order_id = "OD" . time();
        $pack->order_id = $order_id;
        $pack->payment_mode = 'Online';
        $pack->memberid = $memberid;
        $pack->package_value = $amount;
        $pack->package_type = $type;
        $pack->save();

        $memUpdate->package = $amount;
        if ($status == 'Temp') {
            $memUpdate->status = 'Active';
            $memUpdate->activated_at = date('Y-m-d H:i:s');
            updateDownline($sponsorid);
            updateUpline($sponsorid, $memberid);
        }

        $memUpdate->self_biz += $amount;
        $memUpdate->team_biz += $amount;
        $p2p_wallet = $memUpdate->p2p_wallet;
        $memUpdate->p2p_wallet -= $amount;
        $memUpdate->save();

        walletTransfer($memberid, $amount, 'credit', $p2p_wallet, 'Account Activation', 'Member ' . $memberid . ' Account Activation ' . $amount . ' Amount deducted from P2P wallet');

        team_biz_update($sponsorid, $amount);
        monthly_team_biz_update($sponsorid, $amount);
        levelIncome($sponsorid, $memberid, $name, $amount);

        session()->flash('successMsg', 'Your account has been Activated successfully.');
        return redirect()->back();
    }

    public function activationUpgrade()
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::where('id', $id)->first();
        return view('member.account.upgrade-activation', $result);
    }

    public function upgradeUser(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'amount' => 'required|numeric',
            'txn_password' => 'required'
        ]);

        $amount = $request->post('amount');
        $txn_pas = $request->post('txn_password');
        $type = 'Upgrade';

        $memUpdate = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $memUpdate->memberid;
        $sponsorid = $memUpdate->sponsorid;
        $name = $memUpdate->name;
        $p2p_wallet = $memUpdate->p2p_wallet;
        $txn_password = $memUpdate->txn_password;
        // Memberid status and existence validation

        if ($amount < 1000) {
            session()->flash('failedMsg', '*** Minimum value is ₹ 1000');
            return redirect()->back();
        }
        if ($amount % 10 != 0) {
            session()->flash('failedMsg', 'Your value is not multiple of ₹ 10');
            return redirect()->back();
        }
        if (!Hash::check($txn_pas, $txn_password)) {
            session()->flash('failedMsg', '*** Entered Transaction Password donot match');
            return redirect()->back();
        }

        if ($p2p_wallet < $amount) {
            session()->flash('failedMsg', 'There is no enough balance in your P2P wallet to activate this amount');
            return redirect()->back();
        }

        $memberid = $memUpdate->memberid;
        $name = $memUpdate->name;
        $sponsorid = $memUpdate->sponsorid;
        $memUpdate->package = $amount;
        $memUpdate->self_biz += $amount;
        $p2p_wallet = $memUpdate->p2p_wallet;
        $memUpdate->p2p_wallet -= $amount;
        $memUpdate->save();

        walletTransfer($memberid, $amount, 'credit', $p2p_wallet, 'Account Upgrade', 'Member ' . $memberid . ' Account Upgrade ' . $amount . ' Amount deducted from P2P wallet');

        $pack = new PackageDetail();
        $pack->txn_date = date('Y-m-d H:i:s');
        $order_id = "OD" . time();
        $pack->order_id = $order_id;
        $pack->payment_mode = 'Online';
        $pack->memberid = $memberid;
        $pack->package_value = $amount;
        $pack->package_type = $type;
        $pack->save();

        $var2 = new StakingDetail();
        $var2->memberid = $memberid;
        $var2->invest_date = date('Y-m-d H:i:s');
        $var2->invest_amount = $amount;
        $var2->package_type = $type;
        $var2->package = $amount;
        $var2->rate = 0.25;
        $var2->save();

        // directIncome($sponsorid, $memberid, $name, $type, $amount);
        // keyinBonusIncome($sponsorid, $memberid, $name, $amount);

        session()->flash('successMsg', 'Your account has been upgraded successfully.');
        return redirect()->back();
    }

    public function packageDetails()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['package_data'] = PackageDetail::where('memberid', $memberid)->get();
        return view('member.account.packages-details', $result);
    }
    
    public function memActivation()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['package_data'] = PackageDetail::where([['memberid', $memberid], ['package_type', 'Activation']])->first();
        return view('member.account.member-activation', $result);
    }

    public function memberActivate(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'amount' => 'required|numeric',
            'txn_password' => 'required'
        ]);

        $memberid = $request->post('memberid');
        $amount = $request->post('amount');
        $txn_pas = $request->post('txn_password');
        $type = 'Activation';

        $sendUpdate = MemberDetail::find(session('MEMBER_ID'));
        $senderid = $sendUpdate->memberid;
        $memUpdate = MemberDetail::where('memberid', $memberid)->first();
        // $memberid = $memUpdate->memberid;
        $sponsorid = $memUpdate->sponsorid;
        $name = $memUpdate->name;
        $memstatus = $memUpdate->status;

        $p2p_wallet = $sendUpdate->p2p_wallet;
        $txn_password = $sendUpdate->txn_password;
        $status = $sendUpdate->status;

        if ($amount < 1000) {
            session()->flash('failedMsg', '*** Minimum value is ₹ 1000');
            return redirect()->back();
        }
        if ($amount % 10 != 0) {
            session()->flash('failedMsg', 'Your value is not multiple of ₹ 10');
            return redirect()->back();
        }
        if (!Hash::check($txn_pas, $txn_password)) {
            session()->flash('failedMsg', '*** Entered Transaction Password donot match');
            return redirect()->back();
        }

        if ($p2p_wallet < $amount) {
            session()->flash('failedMsg', 'There is no enough balance in your P2P wallet to activate this amount');
            return redirect()->back();
        }

        if ($status != 'Active') {
            session()->flash('failedMsg', 'Your id is not active to perform this action');
            return redirect()->back();
        }

        $pack = new PackageDetail();
        $pack->txn_date = date('Y-m-d H:i:s');
        $order_id = "OD" . time();
        $pack->order_id = $order_id;
        $pack->payment_mode = 'Online';
        $pack->memberid = $memberid;
        $pack->package_value = $amount;
        $pack->package_type = $type;
        $pack->save();

        $memUpdate->package = $amount;
        if ($memstatus == 'Temp') {
            $memUpdate->status = 'Active';
            $memUpdate->activated_at = date('Y-m-d H:i:s');
            updateDownline($sponsorid);
            updateUpline($sponsorid, $memberid);
        }

        $memUpdate->self_biz += $amount;
        $memUpdate->team_biz += $amount;
        $memUpdate->save();

        $p2p_wallet = $sendUpdate->p2p_wallet;
        $sendUpdate->p2p_wallet -= $amount;
        $sendUpdate->save();


        walletTransfer($senderid, $amount, 'credit', $p2p_wallet, 'Member Account Activation', 'Member ' . $memberid . ' Account Activation ' . $amount . ' Amount deducted from P2P wallet');

        team_biz_update($sponsorid, $amount);
        monthly_team_biz_update($sponsorid, $amount);
        levelIncome($sponsorid, $memberid, $name, $amount);

        session()->flash('successMsg', 'Member account has been activated successfully.');
        return redirect()->back();
    }

    public function leaderShip()
    {
        $result['ldata'] = MemberDetail::where('status', 'Temp')->orderby('created_at', 'desc')->get();
        return view('admin.leaders.leader-ship-id')->with($result);
    }

    public function leaderActivate(Request $request)
    {

        $request->validate([
            'memberid' => 'required',
            'package' => 'required'
        ]);

        $memberid = $request->memberid;
        $value = $request->package;

        $memUpdate = MemberDetail::where('memberid', $memberid)->first();

        if ($value == 25) {
            // $pv = 20;
            $qty = 1;
            $package_name = 'Boster';
        } elseif ($value == 50) {
            // $pv = 40;
            $qty = 2;
            $package_name = 'Basic';
        } elseif ($value == 100) {
            // $pv = 80;
            $qty = 4;
            $package_name = 'Premium';
        } elseif ($value == 450) {
            // $pv = 360;
            $qty = 18;
            $package_name = 'Elite';
        } elseif ($value == 900) {
            // $pv = 720;
            $qty = 36;
            $package_name = 'Platinum';
        }

        if ($value != 25 && $value != 50 && $value != 100 && $value != 450 && $value != 900) {
            session()->flash('FailedMsg', 'Your package is Invalid');
            return redirect()->back();
        }

        $memberid = $memUpdate->memberid;
        $name = $memUpdate->name;
        $sponsorid = $memUpdate->sponsorid;
        $placementid = $memUpdate->placementid;
        $position = $memUpdate->position;

        $memUpdate->status = 'Active';
        $memUpdate->package = $value;
        $memUpdate->activated_at = date('Y-m-d H:i:s');
        $memUpdate->activated_by = 'Admin';
        $memUpdate->save();

        $pack = new PackageDetail();
        $pack->txn_date = date('Y-m-d H:i:s');
        $order_id = "OD" . time();
        $pack->order_id = $order_id;
        $pack->payment_mode = 'Online';
        $pack->memberid = $memberid;
        $pack->package_value = $value;
        $pack->package_name = $package_name;
        $pack->activated_by = 'Admin';
        $pack->package_type = 'Activation';
        $pack->save();

        updateDownline($sponsorid);
        session()->flash('successMsg', 'Member account has been activated successfully.');
        return redirect()->back();
    }

    public function leaderShipDetails()
    {
        $result['pdata'] = MemberDetail::where('activated_by', 'Admin')->orderby('created_at', 'desc')->get();
        return view('admin.leaders.leader-ship-details')->with($result);
    }

    public function jumboPackActivation()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['ddata'] = MemberDetail::where([['sponsorid', $memberid], ['status', 'Temp']])->get();
        return view('member.jumbo.jumbo-package-activation')->with($result);
    }

    public function memberActivation(Request $request)
    {
        $request->validate([
            'directid' => 'required',
        ]);

        $directid = $request->post('directid');
        $memUpdate = MemberDetail::find(session('MEMBER_ID'));
        $p2p_wallet = $memUpdate->p2p_wallet;

        if ($p2p_wallet < 31000) {
            session()->flash('failedMsg', 'There is no enough balance in your P2P wallet to activate this amount');
            return redirect()->back();
        }


        $direct = MemberDetail::where('memberid', $directid)->first();
        $memberid = $direct->memberid;
        $sponsorid = $direct->sponsorid;
        $status = $direct->status;
        if ($status != 'Temp') {
            session()->flash('failedMsg', 'This memberid is already activated');
            return redirect()->back();
        }
        $direct->status = 'Active';
        $direct->activated_at = date('Y-m-d H:i:s');
        updateDownline($sponsorid);
        updateUpline($sponsorid, $memberid);

        team_biz_update($sponsorid, 1000);
        monthly_team_biz_update($sponsorid, 1000);
        $direct->self_biz += 1000;
        $direct->team_biz += 1000;
        $direct->package += 1000;
        $direct->save();

        for ($i = 0; $i < 5; $i++) {
            $new = new MemberDetail();
            $new->masterid = $direct->memberid;
            $new->memberid = userId();
            $new->sponsorid = $directid;
            $new->name = $direct['name'];
            $new->email = $direct['email'];
            $new->mobile = $direct['mobile'];
            $new->password =  $direct['password'];
            $new->txn_password = $direct['txn_password'];
            $new->country = $direct['country'];
            $new->status = 'Active';
            $new->activated_at = date('Y-m-d H:i:s');
            $new->self_biz += 1000;
            $new->team_biz += 1000;
            $new->package += 1000;

            $new->save();

            team_biz_update($directid, 1000);
            monthly_team_biz_update($directid, 1000);
            updateDownline($new->sponsorid);
            updateUpline($new->sponsorid, $new->memberid);

            $qry2 = new MemberActivation();
            $qry2->memberid = $new->memberid;
            $qry2->sponsorid =  $directid;
            $qry2->type = 'Master';
            $qry2->status = 'Open';
            $qry2->save();
        }

        $p2p_wallet = $memUpdate->p2p_wallet;
        $memUpdate->p2p_wallet -= 31000;
        $memUpdate->save();

        walletTransfer($memberid, $p2p_wallet, 'credit', $p2p_wallet, 'Account Activation', 'Member ' . $memberid . ' Account Activation ' . $p2p_wallet . ' Amount deducted from P2P wallet');
        session()->flash('successMsg', 'Your directid has been Activated successfully.');
        return redirect()->back();
    }

    public function jumboPackDetails()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['directData'] = MemberDetail::where('masterid', $memberid)->get();
        return view('member.jumbo.jumbo-package-details')->with($result);
    }

    public function jumboMemLogin(Request $request, $id)
    {
        $result = MemberDetail::find($id);
        if ($result) {
            $request->session()->put('MEMBER_LOGIN', true);
            $request->session()->put('MEMBER_ID', $result->id);
            return redirect('member/dashboard');
        }
    }
}
