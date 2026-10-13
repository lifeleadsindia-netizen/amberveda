<?php

namespace App\Http\Controllers;

use App\Models\MemberDetail;
use App\Models\SetRate;
use App\Models\WithdrawalRequest;
use App\Models\WalletTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WithdrawalController extends Controller
{
    public function createPayouts()
    {
        $result['data'] = MemberDetail::where([['status', 'Active'], ['wallet', '>', 100]])->get();
        return view('admin.create-payouts')->with($result);
    }

    public function createMemPayouts()
    {
        ini_set('max_execution_time', 120);
        $members = MemberDetail::where([['status', 'Active'], ['kyc_status', 'Verified'], ['wallet', '>=', 100]])->get();
        if (count($members) > 0) {
            foreach ($members as $key) {
                $memberid = $key->memberid;
                $amount = $key->wallet;
                $date = date('Y-m-d H:i:s');
                $requestId = $memberid . time();

                $var = new WithdrawalRequest();
                $var->request_date = $date;
                $var->request_id = $requestId;
                $var->memberid = $memberid;
                $var->name = $key['name'];
                $var->bank = $key['bank'];
                $var->ifsc = $key['ifsc'];
                $var->holder = $key['holder'];
                $var->account = $key['account_no'];
                $var->gross_amount = $amount;
                $var->service_charge = $amount / 100 * 5;
                $var->net_amount = $amount / 100 * 95;
                $var->save();

                $qry = MemberDetail::find($key->id);
                $wallet = $qry->wallet;
                $qry->wallet -= $amount;
                $qry->save();

                walletTransfer($memberid, $amount, 'credit', $wallet, 'Withdrawal', ' ₹ ' . $amount . ' have been withdrawn by Member from wallet. Payment Id-' . $requestId);
            }

            session()->flash('successMsg', 'Withdrawal requests have been created successfully');
            return redirect()->back();
        } else {
            session()->flash('failedMsg', 'No member found to create withdrawals');
            return redirect()->back();
        }
    }

    public function mainWallets()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['rate'] = SetRate::find(1);
        return view('member.wallet.main-wallet')->with($result);
    }

    public function passbook()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['passdata'] = WalletTransfer::where([['memberid', $result['data']['memberid']], ['walletType', '!=', 'P2P Fund Transfer'], ['walletType', '!=', 'Wallet to p2p Transfer'], ['walletType', '!=', 'Transfer to Purchase Wallet']])->orderBy('created_at', 'desc')->get();
        return view('member.wallet.wallet-transfer')->with($result);
    }

    public function withdrlHistory()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['reqdata'] = WithdrawalRequest::where('memberid', $result['data']['memberid'])->orderBy('created_at', 'desc')->get();
        return view('member.wallet.withdrawal-history')->with($result);
    }

    public function initWithdrawal(Request $request)
    {
        $request->validate([
            // 'type' => 'required',
            'inr_amount' => 'required',
            'txn_password' => 'required',
        ]);
        $memberid = $request->post('memberid');
        $withAmount = $request->post('inr_amount');
    
        $txnPass = $request->post('txn_password');
        $memberData = MemberDetail::where('memberid', $memberid)->first();
        $Status = $memberData['status'];
        $wallet = $memberData['wallet'];
        $tPassword = $memberData['txn_password'];
        $email = $memberData['email'];
 
        if ($memberData['kyc_status'] != 'Verified') {
            session()->flash('failedMsg', 'Your kyc details are not verified. After kyc verification you will eligible for withdrawl');
            return redirect()->back();
        }

        if ($withAmount < 0) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be greater than ₹ 500');
            return redirect()->back();
        }

        if ($withAmount < 500) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be equal or greater than ₹ 500');
            return redirect()->back();
        }

        if ($withAmount > $wallet) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount can not be greater than wallet balance');
            return redirect()->back();
        }

        if (!Hash::check($txnPass, $tPassword)) {
            session()->flash('failedMsg', 'Enter Transaction password do not match. Please check and try again');
            return redirect()->back();
        }

        if ($Status != 'Active') {
            session()->flash('failedMsg', 'Your Account is not Active. Plase activate your account to withdraw money');
            return redirect()->back();
        }

        $service = $withAmount / 100 * 5;
        $tds_charge = $withAmount / 100 * 2;
        $total_charge = $service + $tds_charge;
        $netAmount = $withAmount - $total_charge;
        $net_service = $netAmount / 100 * 0;
        $re_amount = $netAmount - $net_service;
                
        $date = date('Y-m-d H:i:s');
        $requestId = "RQ" . time();
        $qry = MemberDetail::where('memberid', $memberid)->first();

        $check = WithdrawalRequest::where([['memberid', $memberid], ['request_id', $requestId]])->first();
        if (!$check) {
            $var = new WithdrawalRequest();
            $var->request_date = $date;
            $var->request_id = $requestId;
            $var->memberid = $memberid;
            $var->name = $memberData['name'];
            $var->wallet_address = $memberData['wallet_address'];
            $var->bank = $memberData['bank'];
            $var->ifsc = $memberData['ifsc'];
            $var->holder = $memberData['holder'];   
            $var->account = $memberData['account_no'];
            $var->gross_amount = $withAmount;
            $var->service_charge = $service;
            $var->tds = $tds_charge;
            $var->net_amount = $netAmount;
            $var->type = 'Member Wallet';
            $var->save();

            $wallet = $qry->wallet;
            $qry->wallet -= $withAmount;
            $qry->save();

            walletTransfer($memberid, $withAmount, 'credit', $wallet, 'Withdrawal', ' ₹ ' . $withAmount . ' have been withdrawn by Member from wallet. Payment Id-' . $requestId);

            $mailData = [
                'request_id' => $requestId,
                'email' => $qry->email,
                'memberid' => $memberid,
                'gross' => $var->gross_amount,
                'service' => $var->service_charge,
                'social' => $var->social_service,
                'support' => $var->support,
                'net' => $var->net_amount,
                'date' => date('Y-m-d H:i:s'),
                'name' => $qry->name,
                'wallet' => $qry->wallet_address,
                'type' => 'Wallet'
            ];

            $user['to'] = $email;
            // Mail::send('member.mails.withdrawal-request', $mailData, function ($message) use ($user) {

            //     $message->to($user['to']);
            //     $message->subject('AMBER VEDA Member Withdrawal Request');
            // });

            session()->flash('successMsg', 'Withdrawal request has been created successfully. Amount will be transfered into wallet after transaction validation');
            return redirect()->back();
        }
    }

    public function p2pWalletTransfer()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        return view('member.p2pWallet.p2p-transfer')->with($result);
    }

    public function transBvWalletToP2P(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'memberid' => 'required',
            'txn_password' => 'required',
        ]);
        $memberid = strtoupper($request->post('memberid'));
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $senderid = $result['data']['memberid'];
        $type = $request->post('p2p_wallet');
        $amount = $request->post('amount');
        $txn_password = $request->post('txn_password');
        $memberData = MemberDetail::where('memberid', $senderid)->first();
        $Status = $memberData['status'];
        $wallet = $memberData['wallet'];
        $p2p_wallet = $memberData['p2p_wallet'];
        $tPassword = $memberData['txn_password'];

        if ($amount < 0) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be grater than ₹ 100');
            return redirect()->back();
        }

        if ($amount < 100) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be equal or grater than ₹ 100');
            return redirect()->back();
        }

        if ($amount > $p2p_wallet) {
            session()->flash('failedMsg', 'Invalid Amount Entered. You do not have enough balance to transfer');
            return redirect()->back();
        }
       
        if (!Hash::check($txn_password, $tPassword)) {
            session()->flash('failedMsg', 'Enter Transaction password do not match. Please check and try again');
            return redirect()->back();
        }

        if ($Status != 'Active') {
            session()->flash('failedMsg', 'Your Account is not Active. Plase activate your account to withdraw money');
            return redirect()->back();
        }

        if ($memberid == $senderid) {
            session()->flash('failedMsg', 'You can not transfer money to your own account');
            return redirect()->back();
        }

        $service = $amount / 100 * 0;
        $netAmount = $amount - $service;

        $qry = MemberDetail::where('memberid', $memberid)->first();
        if (!$qry) {
            session()->flash('failedMsg', 'Entered Memberid is not registered with us');
            return redirect()->back();
        }
        // $extraAmount = $amount / 100 * 110;
        $p2p_wallet = $qry->p2p_wallet;
        $qry->p2p_wallet += $netAmount;
        $qry->save();
        p2pwalletTransfer($memberid, $netAmount, 'debit', $p2p_wallet, 'Transfer to P2P Wallet', $netAmount . ' Amount has been transferred in P2P Wallet by ' . $senderid . '');

        $query = MemberDetail::where('memberid', $senderid)->first();

        $senderwallet = $query->p2p_wallet;
        $query->p2p_wallet -= $amount;
        $query->save();
        p2pwalletTransfer($senderid, $amount, 'credit', $senderwallet, 'Transfer to P2P Wallet', $amount . ' Amount has been transferred from P2P wallet by you to ' . $memberid . ' P2P wallet');
       
        session()->flash('successMsg', 'Amount has been transferred successfully');
        return redirect()->back();
    }

    public function p2pTransHistory()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['passdata'] = WalletTransfer::where([['memberid', $result['data']['memberid']], ['walletType', 'Transfer to P2P Wallet']])->orderBy('created_at', 'desc')->get();
        return view('member.p2pWallet.p2p-transfer-history')->with($result);
    }
       public function viewDetail($id)
    {  
         $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $result['data'] = WithdrawalRequest::find($id);
       
        return view('member.wallet.detail-history')->with($result);
    }

}
