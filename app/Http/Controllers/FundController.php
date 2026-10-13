<?php

namespace App\Http\Controllers;

use App\Models\FundRequest;
use App\Models\MemberDetail;
use App\Models\PaymentDetail;
use App\Models\SetRate;
use App\Models\WalletTransfer;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FundController extends Controller
{
    // public function addfunds(Request $request , $pid)
    // {
    //     $id = session('MEMBER_ID');
    //     $result['data'] = MemberDetail::find($id);
    //     $result['proData'] = Product::find($pid);
    //     $result['addfundData'] = ImportFund::where('memberid', $result['data']['memberid'])->get();
    //     return view('member.funds.add-fund')->with($result);
    // }

    public function addfunds()
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        // $result['proData'] = Product::find($pid);
        $result['addfundData'] = PaymentDetail::where([['status', 'Live']])->first();
        return view('member.funds.add-fund')->with($result);
    }

    public function fundReport(Request $request)
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        $result['passdata'] = FundRequest::where('memberid', $result['data']['memberid'])->get();
        return view('member.funds.fund-report')->with($result);
    }

    public function fundTransfer(Request $request)
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        // $result['addfundData'] = ImportFund::where('memberid', $result['data']['memberid'])->get();
        return view('member.funds.fund-transfer')->with($result);
    }

    public function mainWallet()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.wallet.main-wallet')->with($result);
    }

    public function withdrawalReq(Request $request)
    {
        $mem = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $mem->memberid;
        $amount = $request->post('amount');
        $requestId = $request->post('requestid');

        // $txnPass = $request->post('txn_password');
        $memberData = MemberDetail::where('memberid', $memberid)->first();
        $Status = $memberData['status'];
        $wallet = $memberData['wallet'];
        $tPassword = $memberData['txn_password'];

        if ($memberData['kyc_status'] != 'Verified') {
            return response()->json([
                'code' => 0,
                'data' => 'Your Kyc is not verified.',
            ]);
        }

        // if ($amount < 0) {
        //     return response()->json([
        //         'code' => 0,
        //         'data' => 'Invalid Amount Entered. Amount must be grater than $10',
        //     ]);
        // }

        // if ($amount < 10) {
        //     return response()->json([
        //         'code' => 0,
        //         'data' => 'Invalid Amount Entered. Amount must be equal or grater than $10',
        //     ]);
        // }

        // if ($amount > $wallet) {
        //      return response()->json([
        //         'code' => 0,
        //         'data' => 'Invalid Amount Entered. Amount can not be greater than wallet balance',
        //     ]);
        // }

        // if (!Hash::check($txnPass, $tPassword)) {
        //     session()->flash('failedMsg', 'Enter Transaction password do not match. Please check and try again');
        //     return redirect()->back();
        // }

        if ($Status != 'Active') {
            return response()->json([
                'code' => 0,
                'data' => 'Your Account is not Active. Please activate your account to withdraw money',
            ]);
        }

        $service = $amount / 100 * 10;
        $netAmount = $amount - $service;
        $date = date('Y-m-d H:i:s');
        $qry = MemberDetail::where('memberid', $memberid)->first();

        $check = WithdrawalRequest::where([['memberid', $memberid], ['request_id', $requestId]])->first();
        if (!$check) {
            $var = new WithdrawalRequest();
            $var->request_date = $date;
            $var->request_id = $requestId;
            $var->memberid = $memberid;
            $var->txnid = '';
            $var->name = $qry['name'];
            // $var->bank = $qry['bank'];
            // $var->holder = $qry['holder'];
            // $var->ifsc = $qry['ifsc'];
            // $var->account = $qry['account_no'];
            $var->wallet_address = '';
            $var->gross_amount = $amount;
            $var->service_charge = $service / 2;
            //  $var->tds = $service / 2;
            $var->net_amount = $netAmount;
            $var->type = 'Wallet';
            $var->status = 'Pending';
            $var->save();

            $wallet = $qry->wallet;
            $qry->wallet -= $amount;
            $qry->save();

            walletTransfer($memberid, $amount, 'credit', $wallet, 'Withdrawal', ' $ ' . $amount . ' have been withdrawn by Member from wallet.');

            return response()->json([
                'code' => 1,
                'data' => 'Withdrawal request has been created successfully. Amount will be transfered into wallet after transaction validation',
            ]);
        }
    }

    public function walletTransfer()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['passdata'] = WalletTransfer::where('memberid', $result['data']['memberid'])->orderBy('created_at', 'desc')->get();
        return view('member/wallet/wallet-transfer')->with($result);
    }

    public function walletP2pTransfer(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'memberid' => 'required',
            'txn_password' => 'required'
        ]);

        $memberid = strtoupper($request->post('memberid'));
        $senderid = $request->post('sender');
        $var = MemberDetail::where('memberid', $senderid)->first();
        $balance = $var->wallet;
        $txn_password = $request->post('txn_password');
        $amount = $request->post('amount');

        // $ded = Deduction::find(1);
        // $rate = $ded->p2p;
        // $net_rate = 100 - $rate;
        // $netAmount = $amount / 100 * $net_rate;
        // $deduction = $amount / 100 * $rate;

        // if ($memberid == $senderid) {
        //     session()->flash('failedMsg', 'Amount can not be transferred to same wallet ');
        //     return redirect()->back();
        // }

        if ($amount > $balance) {
            session()->flash('failedMsg', 'You do not have enough balance to transfer this amount ');
            return redirect()->back();
        } elseif ($amount < 0) {
            session()->flash('failedMsg', 'Negative value is not allowed');
            return redirect()->back();
        }

        $txnpassword = $var->txn_password;
        if (Hash::check($txn_password, $txnpassword)) {
            //sending Money
            $qry = MemberDetail::where('memberid', $memberid)->first();
            if ($qry) {

                $p2p_wallet = $qry->p2p_wallet;
                $qry->p2p_wallet += $amount;
                $qry->save();
                p2pwalletTransfer($memberid, $amount, 'debit', $p2p_wallet, 'P2P Fund Transfer', '₹ ' . $amount . ' has been transferred to your wallet by ' . $senderid . '');
                // $p2p_wallet = $qry->p2p_wallet + $deduction;
                // p2pwalletTransfer($memberid, $deduction, 'credit', $p2p_wallet, 'P2P Fund Deduction', '$ ' . $deduction . ' has been deducted for transfer charges');

                $query = MemberDetail::where('memberid', $senderid)->first();
                $senderwallet = $query->wallet;
                $query->wallet -= $amount;
                $query->save();

                walletTransfer($senderid, $amount, 'credit', $senderwallet, 'Wallet to p2p Transfer', '₹ ' . $amount . ' has been transferred by you to ' . $memberid . '  wallet');

                session()->flash('successMsg', 'Amount has been transferred successfully');
                return redirect()->back();
            } else {
                session()->flash('failedMsg', 'Entered Memberid is not unavailable');
                return redirect()->back();
            }
        } else {
            session()->flash('failedMsg', 'Entered Transaction Password donot match');
            return redirect()->back();
        }
    }

    public function withdrawalHistory()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['reqdata'] = WithdrawalRequest::where('memberid', $result['data']['memberid'])->get();
        return view('member.wallet.withdrawal-history')->with($result);
    }

    // public function activateUser(Request $request, $id)
    // {
    //     $var = FundRequest::find($id);
    //     $memberid = $var->memberid;
    //     $product = 'CELVIVA';
    //     $amount = $var->amount;
    //     $rate = $var->rate;
    //     $usdt = $var->usdt;
    //     if ($usdt == 25) {
    //       $pv = 20;
    //       $qty = 1;
    //       $package_name = 'Boster';
    //     } elseif ($usdt == 50) {
    //       $pv = 40;
    //       $qty = 2;
    //       $package_name = 'Basic';
    //     } elseif ($usdt == 100) {
    //       $pv = 80;
    //       $qty = 4;
    //       $package_name = 'Premium';
    //     } elseif ($usdt == 450) {
    //       $pv = 360;
    //       $qty = 18;
    //       $package_name = 'Elite';
    //     } elseif ($usdt == 900) {
    //       $pv = 720;
    //       $qty = 36;
    //       $package_name = 'Platinum';
    //     }

    //     $memUpdate = MemberDetail::where('memberid', $memberid)->first();
    //     $sponsorid = $memUpdate->sponsorid;
    //     $placementid = $memUpdate->placementid;
    //     $position = $memUpdate->position;
    //     $name = $memUpdate->name;
    //     $p2p_wallet = $memUpdate->p2p_wallet;
    //     $status = $memUpdate->status;
        
    //     // if ($memUpdate->status != 'Temp') {
    //     //     session()->flash('failedMsg', 'Id is already activated');
    //     //     return redirect()->back();
    //     // }

    //     $var->status = 'Accepted';
    //     $var->save();

    //     $pack = new PackageDetail();
    //     $pack->txn_date = date('Y-m-d H:i:s');
    //     $order_id = "OD" . time();
    //     $pack->order_id = $order_id;
    //     $pack->payment_mode = 'Online';
    //     $pack->memberid = $memberid;
    //     $pack->package_value = $usdt;
    //     $pack->package_name = $package_name;
    //     if ($status == 'Temp') {
    //         $pack->package_type = 'Activation';
    //     } else {
    //         $pack->package_type = 'Upgade';
    //     }

    //     $pack->save();

    //     $var2 = new OrderDetail();
    //     $var2->memberid = $memberid;
    //     $var2->product = $product;
    //     $var2->order_id = $order_id;
    //     $var2->quantity = $qty;
    //     $var2->pv = $pv;
    //     $var2->price = $usdt;
    //     $var2->status = 'Pending';
    //     $var2->save();

    //     $memUpdate->package = $usdt;
    //     if ($status == 'Temp') {
    //         $memUpdate->status = 'Active';
    //         $memUpdate->activated_at = date('Y-m-d H:i:s');
    //         updateDownline($sponsorid);
    //         directIncome($sponsorid, $memberid, $name, $usdt);
    //     }
    //     $memUpdate->save();

    //     binary_biz_update($memberid, $placementid, $position, $pv);

    //     session()->flash('successMsg', 'User account has been activated successfully.');
    //     return redirect()->back();
    // }

     public function fundRequest()
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        $result['rate'] = SetRate::find(1);
        $result['inr_data'] = PaymentDetail::where([['upi', '!='," "], ['status', 'Live']])->first();
        return view('member.funds.fund-request')->with($result);
    }

    public function requestHistory()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['imdata'] = FundRequest::where([['status', '!=', 'Pending'], ['memberid', $result['data']['memberid']]])->orderBy('created_at', 'DESC')->get();
        return view('member.funds.request-history')->with($result);
    }

    public function FundReq(Request $request)
    {
        $request->validate([
            'amount' => 'required|int',
            'txnid' => 'required',
            'image' => 'required'
        ]);

        $amount = $request->post('amount');
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $type = 'INR';

        if ($amount < 0) {
            session()->flash('failedMsg', 'Invalid amount input. Please change amount value');
            return redirect()->back();
        }

        if ($amount < 100) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be equal or grater than ₹ 100');
            return redirect()->back();
        }

        if (checkTxnid($request->post('txnid')) == 1) {
            session()->flash('failedMsg', 'This transaction id has already been used. Please change transaction id');
            return redirect()->back();
        }

        $var = new FundRequest();
        $var->memberid = $memberid;
        $var->date = date('Y-m-d');
        $var->amount = $amount;
        $var->inr_amount = $amount;
        $var->type = $type;
        $var->tran_id = $request->post('txnid');
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
            session()->flash('failedMsg', 'Allowed image type is jpg, jpeg, png. Please change image type');
            return redirect()->back();
        }
        $filename = 'txn' . time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->image = $filename;
        $var->status = 'Requested';
        $var->save();

        session()->flash('successMsg', 'Your request has been created successfully.');
        return redirect()->back();
    }
    
    public function franchiseDetl()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $result['imdata'] = MemberDetail::where([['fran_status', '!=', '0'], ['package', 900]])->orderBy('created_at', 'DESC')->get();
        return view('member.funds.franchise-details')->with($result);
    }
    
    public function acceptReq(Request $request, $id)
    {
        $var = FundRequest::find($id);
        $memberid = $var->memberid;
        $amount = $var->amount;
        $var->status = 'Accepted';
        $var->save();


        $qry = MemberDetail::where('memberid', $memberid)->first();
        $p2pwallet = $qry->p2p_wallet;
        $qry->p2p_wallet += $amount;
        $qry->save();

        p2pwalletTransfer($memberid, $amount, 'debit', $p2pwallet, 'P2P Fund Transfer', 'Fund requested transfered into user fund wallet');
        session()->flash('successMsg', 'Requested Amount has been transfered to member wallet');
        return redirect()->back();
    }

    public function rejectReq(Request $request, $id)
    {
        $var = FundRequest::find($id);
        $var->status = 'Cancelled';
        $var->save();

        session()->flash('successMsg', 'Fund request has been rejected successfully');
        return redirect()->back();
    }
    
}
