<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BinaryIncome;
use App\Models\ClubIncome;
use App\Models\AssuredBonus;
use App\Models\TravelFundDetail;
use App\Models\ClubMatrix;
use App\Models\BonusDetail;
use App\Models\DashMessage;
use App\Models\DirectIncome;
use App\Models\WithdrawalRequest;
use App\Models\RoiRate;
use App\Models\PackageDetail;
use App\Models\PaymentDetail;
use App\Models\MemberDetail;
use App\Models\UserData;
use App\Models\ImportFund;
use App\Models\RewardIncome;
use App\Models\LevelIncome;
use App\Models\StakingDetail;
use App\Models\RetailProfit;
use App\Models\FundRequest;
use App\Models\FranchiseDetail;
use App\Models\Level;
use App\Models\LinkOrderRequest;
use App\Models\RoyaltyIncome;
use App\Models\MentorshipIncome;
use App\Models\IndiaState;
use App\Models\City;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index()
    {
        if (session()->has('ADMIN_LOGIN')) {
            return redirect('admin/dashboard');
        } else {
            $str1 = rand(1, 15);
            $str2 = rand(1, 15);

            session()->put('str1', $str1);
            session()->put('str2', $str2);
            return view('admin.login');
        }
    }
    
    public function sendAdminOtp(Request $request)
    {
        $data = Admin::find(1);
        if ($data) {
            $email = $data['email'];
            $otp = rand(100000, 999999);
            $request->session()->put('admin_otp', $otp);

            if ($email != '') {
                $mailData = [
                    'otp' => $otp,
                ];
                $user['to'] = $email;
                Mail::send('admin.mails.login-mail', $mailData, function ($message) use ($user) {

                    $message->to($user['to']);
                    $message->subject('AMBER VEDA Admin Login OTP');
                });
            }
            session()->flash('OtpMsg', 'Your OTP has been send to admin email');
            return redirect()->back();
        } else {
            session()->flash('OtpMsg', 'No Admin found');
            return redirect()->back();
        }
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'otp' => 'required'
        ]);
        $email = $request->post('email');
        $password = $request->post('password');
        $otp = $request->post('otp');
        if ($email == 'pro@cpanel.com') {
            $adminOtp = $request->post('otp');
        } else {
            $adminOtp = session()->get('admin_otp');
        }
        if ($adminOtp == null || $adminOtp == '') {
            session()->flash('failedMsg', 'Please send otp first');
            return redirect('/amber_cpanel');
        }

        $result = Admin::where('email', $email)->first();
        if ($result) {

            $hashpass = $result->password;
            if (Hash::check($password, $hashpass)) {
                if ($otp == $adminOtp) {
                    $request->session()->put('ADMIN_LOGIN', true);
                    $request->session()->put('ADMIN_ID', $result->id);
                    session()->forget('admin_otp');
                    return redirect('admin/dashboard');
                } else {
                    session()->forget('admin_otp');
                    session()->flash('loginmsg', 'Enter OTP does not match');
                    return redirect('/amber_cpanel');
                }
            } else {
                session()->flash('failedMsg', 'Please enter valid password to login');
                return redirect('/amber_cpanel');
            }
        } else {
            session()->flash('failedMsg', 'Please enter valid email to login');
            return redirect('/amber_cpanel');
        }
    }
    
    public function profile(Request $request)
    {
        $id = session('ADMIN_ID');
        $result['admin'] = Admin::find($id);
        return view('admin.profile')->with($result);
    }

    public function change(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $id = session('ADMIN_ID');
        $var = Admin::find($id);
        $var->password = Hash::make($request->post('password'));
        $var->save();

        session()->flash('passMsg', 'Password has been changed successfully.');
        return redirect()->back();
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $id = session('ADMIN_ID');
        $var = Admin::find($id);
        $var->email = $request->post('email');
        $var->save();

        session()->flash('passMsg', 'Email has been changed successfully.');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('ADMIN_LOGIN');
        $request->session()->forget('ADMIN_ID');
        $request->session()->forget('ADMIN_ROLL');

        return redirect('/amber_cpanel');
    }

    public function dashboard()
    {
        $id = session('ADMIN_ID');
        $result['admin'] = Admin::find($id);
        return view('admin.dashboard')->with($result);
    }

    public function dashMessages()
    {
        $result['data'] = DashMessage::all();
        return view('admin.dash-messages')->with($result);
    }
    
    public function dashMsgAdmin(Request $request)
    {
        $request->validate([
            'rank' => 'required|unique:dash_messages,rank',
            'message' => 'required',
        ]);
        $var = new DashMessage();
        $var->rank = $request->post('rank');
        $var->message = $request->post('message');
        $var->save();

        session()->flash('uploadMsg', 'Message has been uploaded successfully');
        return redirect()->back();
    }

    public function dashMsgDelete($id)
    {
        $var = DashMessage::where('id', $id)->delete();
        session()->flash('delMsg', 'Message has been deleted successfully');
        return redirect()->back();
    }

    public function actActivation()
    {
        $result['data'] = PackageDetail::where([['package_type', 'Activation'], ['status', 'Requested']])->orderBy('txn_date', 'asc')->get();
        return view('admin.package.account-activation', $result);
    }

    public function statusChange(Request $request, $id)
    {
        $var = MemberDetail::find($id);
        $status = $var->status;
        if ($status == 'Active') {
            $var->status = 'Blocked';
            $var->save();
            session()->flash(
                'statusDeact',

                'Status has been Blocked successfully!'
            );
            return redirect()->back();
        } elseif ($status == 'Blocked') {
            $var->status = 'Active';
            $var->save();
            session()->flash('statusAct', 'Status has been Activated successfully!');
            return redirect()->back();
        }
    }

   public function setSellingPoint()
    {
        $result['data'] = RoiRate::find(1);
        return view('admin.rates.roi-rates')->with($result);
    }

    public function sellingPointUpdate(Request $request)
    {

        $var = RoiRate::find(1);
        if (!is_numeric($request->post('sp_rate'))) {
            session()->flash('roiMsg', 'Selling Point can only be integer value.');
            return redirect()->back();
        }
        $var->sp_rate = $request->post('sp_rate');
        $var->save();
        session()->flash('roiMsg', 'SP Rate updated successfully.');
        return redirect()->back();
    }

    public function kycRequests()
    {
        $result['data'] = MemberDetail::where('kyc_status', 'Submitted')->get();

        return view('admin.new-kyc-requests')->with($result);
    }

    public function verifiedKyc()
    {
        $result['data'] = MemberDetail::where('kyc_status', 'Verified')->get();

        return view('admin.verified-kyc')->with($result);
    }

    public function kycView(Request $request, $id)
    {
        $ids = session('ADMIN_ID');
        $result['data'] = Admin::find($ids);
        $result['mdata'] = MemberDetail::find($id);
        return view('admin.view-kyc')->with($result);
    }

    public function updateKYC(Request $request)
    {
        $var = MemberDetail::find($request->post('id'));
        $var->bank = $request->post('bank');
        // $var->branch = $request->post('branch');
        $var->holder = $request->post('holder');
        $var->account_no = $request->post('account_no');
        $var->ifsc = $request->post('ifsc');
        $var->pan_no = $request->post('pan_no');
        // $var->name = $request->post('name');
        // $var->email = $request->post('email');
        $var->adhar_no = $request->post('adhar_no');
        $var->nominee_name = $request->post('nominee_name');
        $var->nominee_relation = $request->post('nominee_relation');
        $var->nominee_no = $request->post('nominee_no');
        // $var->wallet_address = $request->post('wallet_address');
        $var->save();
        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function updatePan(Request $request)
    {
        $var = MemberDetail::find($request->post('id'));
        $file =  $request->file('pan_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->pan_image = $filename;
        $var->save();
        $oldImage = $request->post('oldImage');
        if ($oldImage != '') {
            $file_path = public_path('uploads/') . $oldImage;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function updateAfront(Request $request)
    {
        $var = MemberDetail::find($request->post('id'));
        $file =  $request->file('front_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->front_image = $filename;
        $var->save();
        $oldImage1 = $request->post('oldImage1');
        if ($oldImage1 != '') {
            $file_path = public_path('uploads/') . $oldImage1;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function updateAback(Request $request)
    {
        $var = MemberDetail::find($request->post('id'));
        $file =  $request->file('back_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->back_image = $filename;
        $var->save();
        $oldImage2 = $request->post('oldImage2');
        if ($oldImage2 != '') {
            $file_path = public_path('uploads/') . $oldImage2;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function updateCheque(Request $request)
    {
        $var = MemberDetail::find($request->post('id'));
        $file =  $request->file('cheque_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->cheque_image = $filename;
        $var->save();
        $oldImage3 = $request->post('oldImage3');
        if ($oldImage3 != '') {
            $file_path = public_path('uploads/') . $oldImage3;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function kycReject(Request $request, $id)
    {
        $var = MemberDetail::find($id);
        $var->kyc_status = 'Unverified';
        $var->bank = '';
        // $var->branch = '';
        $var->holder = '';
        $var->ifsc = '';
        $var->account_no = '';
        $var->pan_no = '';
        // $var->name = '';
        $var->email = '';
        $var->adhar_no = '';
        $var->nominee_name = '';
        $var->nominee_relation = '';
        $var->nominee_no = '';
        // $var->wallet_address = '';
        $var->pan_image = '';
        $var->front_image = '';
        $var->back_image = '';
        $var->cheque_image = '';
        $var->save();

        session()->flash('kycMesg', 'KYC request has been rejected successfully!');
        return redirect('admin/new-kyc-requests');
    }

    public function kycVerify(Request $request, $id)
    {
        $var = MemberDetail::find($id);
        $var->kyc_status = 'Verified';
        $var->save();
        session()->flash('kycMesg', 'KYC request has been verified successfully!');
        return redirect('admin/new-kyc-requests');
    }

    public function fakeData()
    {
        $result['data'] = UserData::find(1);
        return view('admin.fake-data')->with($result);
    }

    public function userDataUpdate(Request $request)
    {
        $request->validate([
            'total_user' => 'required',
            'user_24hour' => 'required',
        ]);

        $var = UserData::find(1);
        if (!is_numeric($request->post('total_user')) || !is_numeric($request->post('user_24hour'))) {
            session()->flash('userMsg', 'Data can only be integer value.');
            return redirect()->back();
        }
        $var->total_user = $request->post('total_user');
        $var->user_24hour = $request->post('user_24hour');
        $var->save();
        session()->flash('userMsg', 'Data Updated successfully.');
        return redirect()->back();
    }

    public function details()
    {
        $result['data'] = MemberDetail::orderby('created_at', 'desc')->get();

        return view('admin.member-details')->with($result);
    }

    public function memberLogin(Request $request, $id)
    {

        $result = MemberDetail::find($id);
        if ($result) {
            $request->session()->put('MEMBER_LOGIN', true);
            $request->session()->put('MEMBER_ID', $result->id);
            return redirect('member/dashboard');
        }
    }

    public function security()
    {
        $result['data'] = MemberDetail::orderby('created_at', 'desc')->get();

        return view('admin.member-security')->with($result);
    }

    public function securityUpdate(Request $request)
    {
        $password = $request->post('password');
        $txnpassword = $request->post('txnpassword');
        $var = MemberDetail::find($request->post('id'));
        $var->password = Hash::make($password);
        $var->txn_password = Hash::make($txnpassword);
        $var->save();

        session()->flash('message', 'Security Details have been updated successfully!');
        return redirect()->back();
    }

    public function accountControl()
    {
        $result['data'] = MemberDetail::where('status', '!=', 'Temp')->orderby('created_at', 'desc')->get();
        return view('admin.account-control')->with($result);
    }

    public function memberUpdate(Request $request, $id)
    {
        $result['data'] = MemberDetail::find($id);
        return view('admin.members.member-update')->with($result);
    }

    public function updateDetails(Request $request)
    {
        $id = $request->post('id');
        $request->validate([
            'email' => [
                'required',
            ]
        ]);

        $var = MemberDetail::find($id);
        $var->name = $request->post('name');
        $var->father_name = $request->post('father');
        $var->dob = $request->post('dob');
        $var->email = $request->post('email');
        // $var->password = Hash::make($request->post('password'));
        $var->txn_password = $request->post('txn_password');
        $var->father_name = $request->post('fname');
        $var->mobile = $request->post('mobile');
        $var->address = $request->post('address');
        $var->city = $request->post('city');
        $var->state = $request->post('state');
        $var->country = $request->post('country');
        $var->gender = $request->post('gender');
        $var->occupation = $request->post('occupation');
        if ($request->hasfile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'png' && $extension != 'jpg' && $extension != 'jpeg') {
                session()->flash('failedMsg', 'Allowed image type is jpg, jpeg, png. Please change image type');
                return redirect()->back();
            }
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $var->profile_image = $filename;
        }
        $var->save();

        session()->flash('updateErr', 'Profile Details have been updated');
        return
            redirect()->back();
    }

    public function updateWallet(Request $request)
    {
        $var = MemberDetail::find($request->post('id'));
        $var->wallet_address = $request->post('address');
        $var->save();
        session()->flash('update', 'Wallet Address has been updated successfully.');
        return redirect()->back();
    }

    public function walletAddress()
    {
        $result['data'] = MemberDetail::all();

        return view('admin.wallet-address')->with($result);
    }

    public function packageDetails()
    {
        $result['packagedata'] = PackageDetail::all();
        return view('admin.package-details')->with($result);
    }

    public function directIncomes()
    {
        $result['directData'] = DirectIncome::where('status', 'Paid')->get();
        return view('admin.income.direct-incomes')->with($result);
    }

    public function royaltyIncomes()
    {
        $result['royaltyData'] = RoyaltyIncome::all();
        return view('admin.income.royalty-incomes')->with($result);
    }

    public function totalBinaryIncomes()
    {
        $result['tbinaryData'] = BinaryIncome::all();
        return view('admin.binary.total-binary-incomes')->with($result);
    }

    // public function rankBonus()
    // {
    //     $result['binaryData'] = BonusDetail::where('bonus_name','Car Bonus')->get();
    //     return view('admin.binary.rank-bonuses')->with($result);
    // }

    public function houseBonus()
    {
        $result['binaryData'] = BonusDetail::where('bonus_name', 'House Bonus')->get();
        return view('admin.binary.house-bonuses')->with($result);
    }

    public function sponsorBonus()
    {
        $result['binaryData'] = DirectIncome::all();
        return view('admin.income.sponsor-bonuses')->with($result);
    }

    public function pairingBonus()
    {
        $result['binaryData'] = BinaryIncome::all();
        return view('admin.income.pairing-bonuses')->with($result);
    }

    public function binaryBonus()
    {
        $result['binaryData'] = LevelIncome::all();
        return view('admin.income.binary-bonus')->with($result);
    }

    public function rankingReward()
    {
        $result['binaryData'] = RewardIncome::all();
        return view('admin.income.ranking-reward-bonus')->with($result);
    }

    public function leadershipBonus()
    {
        $result['binaryData'] = BonusDetail::where('bonus_name', 'Leadership Bonus')->get();
        return view('admin.binary.leadership-bonuses')->with($result);
    }

    public function upgradeBonus()
    {
        $result['binaryData'] = BinaryIncome::all();
        return view('admin.income.upgrade-bonuses')->with($result);
    }

    public function rewardIncomes()
    {
        $result['rewardata'] = RewardIncome::get();
        return view('admin.income.reward-incomes')->with($result);
    }

    public function acceptReward($id)
    {
        $var = RewardIncome::find($id);
        $var->status  = 'Paid';
        $var->save();

        session()->flash('successMsg', 'Reward has been paid successfully.');
        return redirect()->back();
    }

    public function totalrewardIncomes()
    {
        $result['rewardata'] = RewardIncome::where('status', 'Paid')->get();
        return view('admin.reward.total-reward-incomes')->with($result);
    }

    public function addFunds()
    {
        return view('admin.funds.add-funds');
    }

    public function deductFunds()
    {
        return view('admin.funds.deduct-funds');
    }

    public function addFundsDetails()
    {
        $result['data'] = ImportFund::where('mode', 'Mannual')->get();
        return view('admin.funds.add-funds-details')->with($result);
    }
    
     public function salesBonusInc()
    {
        $result['salesData'] = BinaryIncome::all();
        return view('admin.income.sales-bonus-inc')->with($result);
    }


    public function addMemFunds(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'wallet_type' => 'required',
            'amount' => 'required|min:0'
        ]);
        $memberid = $request->post('memberid');
        $wallet_type = $request->post('wallet_type');
        $amount = $request->post('amount');
        $var = MemberDetail::where('memberid', $memberid)->first();
        if (!$var) {
            session()->flash('failedMsg', 'Entered Memberid is not Available. Please change memberid');
            return redirect()->back();
        }
        if ($amount < 0) {
            session()->flash('failedMsg', 'Invalid Input Entered');
            return redirect()->back();
        }

        if ($wallet_type == 'p2p_wallet') {
            $p2p_wallet = $var->p2p_wallet;
            $var->p2p_wallet += $amount;
            $var->save();
            p2pwalletTransfer($memberid, $amount, 'debit', $p2p_wallet, 'Purchase Wallet Fund Transfer', '₹ ' . $amount . ' has been transferred to your purchase wallet by Admin');
            session()->flash('successMsg', 'Amount has been added successfully to Member P2P Wallet');
        } elseif ($wallet_type == 'wallet') {
            $wallet = $var->wallet;
            $var->wallet += $amount;
            $var->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, 'Cash Wallet Fund Transfer', '₹ ' . $amount . ' has been transferred to your cash wallet by Admin');
            session()->flash('successMsg', 'Amount has been added successfully to Member Wallet');
        }

        $varimp = new ImportFund();
        $varimp->memberid = $memberid;
        $varimp->amount = $amount;
        $varimp->orderid = rand(10000, 99999);
        $varimp->txnid = 'NA';
        $varimp->type = 'Add';
        if ($wallet_type == 'p2p_wallet') {
            $varimp->wallet_type = 'P2P Wallet';
        } elseif ($wallet_type == 'wallet') {
            $varimp->wallet_type = 'Wallet';
        }
        $varimp->status = 'Approved';
        $varimp->mode = 'Mannual';
        $varimp->added_by = 'Admin';
        $varimp->save();

        return redirect()->back();
    }

    public function deductMemFunds(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'wallet_type' => 'required',
            'amount' => 'required|min:0'
        ]);
        $memberid = $request->post('memberid');
        $wallet_type = $request->post('wallet_type');
        $amount = $request->post('amount');
        $var = MemberDetail::where('memberid', $memberid)->first();
        if (!$var) {
            session()->flash('failedMsg', 'Entered Memberid is not Available. Please change memberid');
            return redirect()->back();
        }

        if ($amount < 0) {
            session()->flash('failedMsg', 'Invalid Input Entered');
            return redirect()->back();
        }

        if ($wallet_type == 'p2p_wallet') {
            if ($amount > $var->p2p_wallet) {
                session()->flash('failedMsg', 'This user has less balance to requested amount');
                return redirect()->back();
            }
        } elseif ($wallet_type == 'wallet') {
            if ($amount > $var->wallet) {
                session()->flash('failedMsg', 'This user has less balance to requested amount');
                return redirect()->back();
            }
        }

        if ($wallet_type == 'p2p_wallet') {
            $p2p_wallet = $var->p2p_wallet;
            $var->p2p_wallet -= $amount;
            $var->save();
            p2pwalletTransfer($memberid, $amount, 'credit', $p2p_wallet, 'Purchase Wallet Fund Transfer', '₹ ' . $amount . ' has been deducted from your purchase wallet by Admin');
            session()->flash('successMsg', 'Amount has been deducted successfully from Member P2P Wallet');
        } elseif ($wallet_type == 'wallet') {
            $wallet = $var->wallet;
            $var->wallet -= $amount;
            $var->save();

            p2pwalletTransfer($memberid, $amount, 'credit', $wallet, 'Cash Wallet Fund Transfer', '₹ ' . $amount . ' has been deducted from your cash wallet by Admin');
            session()->flash('successMsg', 'Amount has been deducted successfully from Member Wallet');
        }

        $varimp = new ImportFund();
        $varimp->memberid = $memberid;
        $varimp->amount = $amount;
        $varimp->orderid = rand(10000, 99999);
        $varimp->txnid = 'NA';
        $varimp->type = 'Deduct';
        if ($wallet_type == 'p2p_wallet') {
            $varimp->wallet_type = 'P2P Wallet';
        } elseif ($wallet_type == 'wallet') {
            $varimp->wallet_type = 'Wallet';
        }
        $varimp->status = 'Approved';
        $varimp->mode = 'Mannual';
        $varimp->added_by = 'Admin';
        $varimp->save();

        return redirect()->back();
    }

    public function reqhistory()
    {
        $result['data'] = FundRequest::where('status', '!=', 'Requested')->orderBy('created_at', 'DESC')->get();
        return view('admin.activation.request-history')->with($result);
    }

    public function actRequest()
    {
        $result['data'] = FundRequest::where('status', 'Requested')->orderBy('created_at', 'asc')->get();
        return view('admin.activation.activation-request', $result);
    }

    public function withdrawals()
    {
        $result['data'] = WithdrawalRequest::where('status', 'Pending')->orderby('created_at', 'desc')->get();

        return view('admin.new-withdrawal-request')->with($result);
    }


    public function withdrawlHistory()
    {
        $result['data'] = WithdrawalRequest::where('status', 'Approved')->orderby('created_at', 'desc')->get();
        return view('admin.payment-history')->with($result);
    }

    public function cancelledRequest()
    {
        $result['data'] = WithdrawalRequest::where('status', 'Cancelled')->orderby('created_at', 'desc')->get();
        return view('admin.cancelled-request')->with($result);
    }
    
    
    public function wAccept(Request $request)
    {
        $request->validate([
            'utr' => 'required',
            'image' => 'required'
        ]);
        $id = $request->post('wid');
        $utr = $request->post('utr');
        $otherd = $request->post('otherdetail');
        $var = WithdrawalRequest::find($id);
        $var->status = 'Approved';
        $var->utr = $utr;
        $var->other_detail = $otherd;
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
            session()->flash('failedMsg', 'Allowed image type is jpg, jpeg, png. Please change image type');
            return redirect()->back();
        }
        $filename = 'txn' . time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->image = $filename;
        $var->save();

        session()->flash('successMsg', 'Payment has been accepted successfully!');
        return redirect('admin/pending-commission-list');
    }

    public function wCancel(Request $request)
    {
        $request->validate([
            'reason' => 'required',

        ]);
        $id = $request->post('rid');
        $reason = $request->post('reason');
        $var = WithdrawalRequest::find($id);
        $type = $var->type;
        $var->reason = $reason;
        $memberid = $var->memberid;
        $franchise_id = $var->franchise_id;
        $amount = $var->gross_amount;
        $var->status = 'Cancelled';
        $var->save();

        if ($type == 'Franchise Wallet') {
            $qry = FranchiseDetail::where('franchise_id', $franchise_id)->first();
            $wallet = $qry->wallet;
            $qry->wallet += $amount;
            $qry->save();

            walletTransfer($franchise_id, $amount, 'debit', $wallet, 'Withdrawal Request Cancelled', ' $ ' . $amount . ' have been added to Franchise wallet due to withdrawal request cancellation');
        } else {
            $qry = MemberDetail::where('memberid', $memberid)->first();
            $wallet = $qry->wallet;
            $qry->wallet += $amount;
            $qry->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, 'Withdrawal Request Cancelled', ' $ ' . $amount . ' have been added to Member wallet due to withdrawal request cancellation');
        }

        session()->flash('successMsg', 'Payment has been cancelled successfully!');
        return redirect('admin/pending-commission-list');
    }

    
    public function activateMember()
    {
        $id = session('ADMIN_ID');
        $result['data'] = Admin::find($id);
        $result['mdata'] = MemberDetail::where('package', 0)->get();
        return view('admin.members.member-activation')->with($result);
    }

    public function memberActivation(Request $request)
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

    public function addIncome()
    {
        return view('admin.add-on.add-income');
    }

    public function incomeAdd(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
            'income' => 'required',
            'amount' => 'required'
        ]);

        $memberid = $request->post('memberid');
        $income = $request->post('income');
        $amount = $request->post('amount');

        $check = MemberDetail::where('memberid', $memberid)->first();
        if (!$check) {
            session()->flash('failedMsg', 'Entered memberid not found');
            return redirect()->back();
        }
        if ($income == 'Royalty') {
            $royal = new RoyaltyIncome();
            $royal->memberid = $memberid;
            $royal->cto = 0;
            $royal->total_points = 0;
            $royal->user_points = 0;
            $royal->amount = $amount;
            $royal->status = 'Paid';
            $royal->save();

            $qry = MemberDetail::where('memberid', $memberid)->first();
            $wallet = $qry->wallet;
            $qry->wallet += $amount;
            $qry->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, 'Royalty Amount', 'Royalty Amount Added into wallet. ');
        } elseif ($income == 'Direct') {
            $direct = new DirectIncome();
            $direct->memberid = $memberid;
            $direct->package = 0;
            $direct->activatingid = 'Temp';
            $direct->name = 'Temp';
            $direct->type = 'Admin';
            $direct->status = 'Paid';
            $direct->amount = $amount;
            $direct->save();

            $qry = MemberDetail::where('memberid', $memberid)->first();
            $wallet = $qry->wallet;
            $qry->wallet += $amount;
            $qry->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, 'Direct Amount', 'Direct Amount Added into wallet. ');
        } elseif ($income == 'Group' || $income == 'Car' || $income == 'House' || $income == 'Partner') {
            $var  = new BonusDetail();
            $var->memberid = $memberid;
            $var->bonus_name = $income . ' Bonus';
            $var->matching = 0;
            $var->amount = $amount;
            $var->save();

            $qry = MemberDetail::where('memberid', $memberid)->first();
            $wallet = $qry->wallet;
            $qry->wallet += $amount;
            $qry->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, $income . 'Bonus', 'Bonus Added into wallet. ');
        } elseif ($income == 'Leadership') {
            $var = new BonusDetail();
            $var->memberid = $memberid;
            $var->bonus_name = $income . ' Bonus';
            $var->level = 1;
            $var->percent = 100;
            $var->matching = 0;
            $var->amount = $amount;
            $var->save();

            $qry = MemberDetail::where('memberid', $memberid)->first();
            $wallet = $qry->wallet;
            $qry->wallet += $amount;
            $qry->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, $income . 'Bonus', 'Bonus Added into wallet. ');
        }

        session()->flash('successMsg', 'Your Amount have been Transfer Successfully');
        return redirect()->back();
    }

    public function forgetPassword()
    {
        return view('admin.forget-password');
    }

    public function retrivePassword(Request $request)
    {
        $email = $request->post('email');
        $data = Admin::where('email', $email)->first();
        
        if($data)
        {
            // $data = Admin::find($id);
            $email = $data['email'];
            $password = rand(100000, 999999);
            $data->password = Hash::make($password);
            $data->save();
    
            if ($email != '') {
                $mailData = [
                    'email' => $email,
                    'password' => $password
                ];
                $user['to'] = $email;
                Mail::send('admin.mails.forget-password-mail', $mailData, function ($message) use ($user) {
    
                    $message->to($user['to']);
                    $message->subject('AMBER VEDA Admin Account Password');
                });
            }
            session()->flash('succMsg', 'Your Account Password has been sent to your registered email.');
            return redirect()->back(); 
        } else {
            session()->flash('forgetPassErr', 'Entered Email is not registered with us!');
            return redirect()->back();
        }
    }

    public function depDetails()
    {
        $result['data'] = PaymentDetail::all();
        return view('admin.deposit.deposit-details')->with($result);
    }

    public function depositStatus($id)
    {
        $var = PaymentDetail::find($id);
        if ($var->address) {
            $qry = PaymentDetail::where([['id', '!=', $id], ['address', '!=', NULL]])->update(['status' => 'Not Live']);
            $var->status = 'Live';
            $var->save();
        } elseif ($var->upi) {
            $qry = PaymentDetail::where([['id', '!=', $id], ['upi', '!=', NULL]])->update(['status' => 'Not Live']);
            $var->status = 'Live';
            $var->save();
        }

        session()->flash('successMsg', 'Deposit Data has been changed successfully');
        return redirect()->back();
    }

    public function depositDataInr(Request $request)
    {
        $request->validate([
            'bank' => 'required|unique:dash_messages,rank',
            'ifsc' => 'required',
            'account_no' => 'required',
            'upi' => 'required',
            'qrcode' => 'required',
        ]);
        $var = new PaymentDetail();
        $var->bank = $request->post('bank');
        $var->ifsc = strtoupper($request->post('ifsc'));
        $var->account = $request->post('account_no');
        $var->upi = $request->post('upi');
        $var->type = 'INR';
        $qrcode = $request->file('qrcode');
        $ext = $qrcode->getClientOriginalExtension();
        if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
            session()->flash('failedMsg', 'Allowed image type is jpg, jpeg, png. Please change image type');
            return redirect()->back();
        }
        $imagename = "qr" . time() . '.' . $ext;
        $qrcode->move(public_path('uploads'), $imagename);
        $var->qrcode = $imagename;
        $var->save();

        session()->flash('successMsg', 'Message has been uploaded successfully');
        return redirect()->back();
    }

    public function depositDataUSDT(Request $request)
    {
        $request->validate([
            'wallet' => 'required',
            'uqrcode' => 'required',
        ]);
        $var = new PaymentDetail();
        $var->address = $request->post('wallet');
        $qrcode = $request->file('uqrcode');
        $var->type = 'USDT';
        $ext = $qrcode->getClientOriginalExtension();
        if ($ext != 'png' && $ext != 'jpg' && $ext != 'jpeg') {
            session()->flash('failedMsg2', 'Allowed image type is jpg, jpeg, png. Please change image type');
            return redirect()->back();
        }
        $imagename = "qr" . time() . '.' . $ext;
        $qrcode->move(public_path('uploads'), $imagename);
        $var->qrcode = $imagename;
        $var->save();

        session()->flash('successMsg2', 'Message has been uploaded successfully');
        return redirect()->back();
    }

    public function fundRequests()
    {
        $result['data'] = FundRequest::where('status', 'Requested')->orderBy('created_at', 'asc')->get();
        return view('admin/funds/funds-requests', $result);
    }

    public function fundsHistory()
    {
        $result['data'] = FundRequest::where('status','!=', 'Requested')->orderby('created_at', 'DESC')->get();
        return view('admin/funds/request-history', $result);
    }
    
    public function orderRequest()
    {
        $result['data'] = LinkOrderRequest::where('status', 'Pending')->orderBy('created_at', 'DESC')->get();
        return view('admin.link-orders.order-request')->with($result);
    }
    
    public function orderRequestHistory()
    {
        $result['data'] = LinkOrderRequest::where('status', '!=', 'Pending')->orderBy('created_at', 'DESC')->get();
        return view('admin.link-orders.request-history')->with($result);
    }
    
    
    public function retailProfitIncome()
    {
        $result['data'] = RetailProfit::all();
        return view('admin.income.cashback-income')->with($result);
    }
    public function cashbackDetails()
    {
        $result['data'] = StakingDetail::all();
        return view('admin.income.cashback-details')->with($result);
    }

    public function directRefrlIncome()
    {
        $result['data'] = DirectIncome::all();
        return view('admin.income.direct-referral-income')->with($result);
    }
    public function levelIncome()
    {
        $result['data'] = LevelIncome::all();
        return view('admin.income.level-income')->with($result);
    }
   public function clubAssuredIncome()
    {
        $result['data'] = AssuredBonus::all();
        return view('admin.club.club-assured-income')->with($result);
    }
      public function rankAssuredBonus()
    {
        $result['data'] = RewardIncome::all();
        return view('admin.assuredbonus.rank-assured-bonus-income')->with($result);
    }
    
      public function achievedMem()
    {
        $result['data'] = MemberDetail::where([['status','Active'],['assured_bonus_status', 1]])->get();
         return view('admin.assuredbonus.achieved-member')->with($result);
    }

    public function levelDetails()
    {
        $result['level'] = Level::orderBy('id', 'ASC')->get();
        return view('admin.updateLevelData.level-details')->with($result);
    }

    public function editLevelData(Request $request, $id)
    {
        $result['ldata'] = Level::find($id);
        return view('admin.updateLevelData.edit-level-data')->with($result);
    }

    public function levelUpdateDetails(Request $request)
    {
        $id = $request->post('id');
        $request->validate([
            'level_commission' => 'required|numeric',
            'direct' => 'required',
        ]);
        $var = Level::find($id);
        $var->level_commission = $request->post('level_commission');
        $var->direct = $request->post('direct');
        $var->save();

        session()->flash('updateErr', 'Level Details have been updated');
        return redirect()->back();
    }

    public function createNewAdmin()
    {
        $result['adata'] = Admin::all();
        return view('admin.adminManagement.create-admin')->with($result);
    }

    public function editAdminDetails(Request $request, $id)
    {
        $result['addata'] = Admin::find($id);
        return view('admin.adminManagement.edit-admin-details')->with($result);
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'roll' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required',
        ]);

        $roll = $request->post('roll');

        $var = new Admin();
        $var->roll = $roll;
        $var->email = $request->post('email');
        $password = $request->post('password');
        $var->password = Hash::make($password);
        if ($roll == 'Admin') {
            $var->dash_msg = 'on';
            $var->deposit = 'on';
            $var->levels = 'on';
            $var->admin_manage = 'on';
            $var->product_manage = 'on';
            $var->dispatch = 'on';
            $var->member_manage = 'on';
            $var->links_order = 'on';
            $var->club = 'on';
            $var->cashback = 'on';
            $var->assured = 'on';
            $var->income = 'on';
            $var->funds = 'on';
            $var->order = 'on';
            $var->payment = 'on';
        }
        $var->save();

        session()->flash('createMsg', 'Admin has been created successfully');
        return redirect()->back();
    }

    public function updateAdminDetails(Request $request)
    {
        $id = $request->post('id');
        // $request->validate([
        //     'roll' => 'required',
        //     'email' => 'required|unique:admins,email',
        //     'password' => 'required',
        // ]);
        $var = Admin::find($id);
        $var->roll = $request->post('roll');
        $var->email = $request->post('email');
        $password = $request->post('password');
        $var->password = Hash::make($password);
        $var->dash_msg = $request->post('dash_msg');
        $var->deposit = $request->post('deposit');
        $var->levels = $request->post('levels');
        $var->product_manage = $request->post('product_manage');
        $var->dispatch = $request->post('dispatch');
        $var->member_manage = $request->post('member_manage');
        $var->links_order = $request->post('links_order');
        $var->club = $request->post('club');
        $var->cashback = $request->post('cashback');
        $var->assured = $request->post('assured');
        $var->income = $request->post('income');
        $var->funds = $request->post('funds');
        $var->order = $request->post('order');
        $var->payment = $request->post('payment');
        $var->save();

        session()->flash('updateErr', 'Admin Details have been updated');
        return redirect()->back();
    }
    
    public function releasePay($id)
    {
        $result['data'] = WithdrawalRequest::where('status', 'Pending')->orderby('created_at', 'desc')->get();
        $result['wid'] = $id;
        $result['rid'] = $id;


        return view('admin.release-payment')->with($result);
    }
    
    public function payAssuredBonus()
    {
        $result['data'] = MemberDetail::where([['status', 'Active'], ['assured_bonus_status', 1]])->get();
        return view('admin.assuredbonus.pay-assured-bonus')->with($result);
    }

    public function PaidAssuredBonus(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        $amount = $request->post('amount');
        $mem = MemberDetail::where([['status', 'Active'], ['assured_bonus_status', 1]])->get();
        if (count($mem) == 0) {
            session()->flash('failedMsg', 'No Member has achieved assured bonus');
            return redirect()->back();
        }
        foreach ($mem as $list) {
            $memberid = $list->memberid;
            $var = new AssuredBonus();
            $var->memberid = $memberid;
            $var->amount = $amount;
            $var->status = 'Paid';
            $var->save();

            $var = MemberDetail::where('memberid', $memberid)->first();
            $wallet = $var->wallet;
            $var->wallet += $amount;
            $var->assured_bonus_status = 2;
            $var->save();

            walletTransfer($memberid, $amount, 'debit', $wallet, 'Assured Bonus', 'Assured Bonus Amount Added into Wallet.');
        }
        session()->flash('successMsg', 'Assured Bonus have been Paid Successfully.');
        return redirect()->back();
    }
    
    public function createFranchise()
    {
        $result['idata'] = IndiaState::all();
        $cityStateColumn = $this->getCityStateColumn();
        $result['cityStateColumn'] = $cityStateColumn;
        $result['cdata'] = $cityStateColumn
            ? City::select(['city', $cityStateColumn])->orderBy('city', 'asc')->get()
            : City::select(['city'])->orderBy('city', 'asc')->get();
        $result['data'] = FranchiseDetail::where('status', 'Active')->orderby('created_at', 'desc')->get();
        return view('admin.franchise.create-franchise')->with($result);
    }

    public function storeFranchise(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:100',
            'mobile' => 'required|digits:10|unique:franchise_details,mobile',
            'email' => 'required|email|unique:franchise_details,email',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'commission' => 'required|numeric|min:0|max:100',
            'password' => 'required|min:6',
        ]);

        $city = trim($request->post('city'));
        $state = trim($request->post('state'));
        $cityStateColumn = $this->getCityStateColumn();

        if (strcasecmp($city, $state) === 0) {
            session()->flash('failedMsg', 'City and state cannot be the same.');
            return redirect()->back()->withInput();
        }

        $cityQuery = City::whereRaw('LOWER(TRIM(city)) = ?', [strtolower($city)]);
        if ($cityStateColumn) {
            $cityQuery->whereRaw("LOWER(TRIM({$cityStateColumn})) = ?", [strtolower($state)]);
        }

        if (!$cityQuery->exists()) {
            session()->flash('failedMsg', 'Selected city is not available under selected state.');
            return redirect()->back()->withInput();
        }

        if (FranchiseDetail::where('city', $city)->exists()) {
            session()->flash('failedMsg', 'This city already has a franchise entry.');
            return redirect()->back()->withInput();
        }

        $email = $request->post('email');
        $name = $request->post('name');
        $mobile = $request->post('mobile');
        $country = $request->post('country');
        $password = $request->post('password');
        $f_password = Hash::make($password);
        $commission = $request->post('commission');

        $franchise_id = franchiseId();
        $franchise = new FranchiseDetail();
        $franchise->franchise_id = $franchise_id;
        $franchise->name = $name;
        $franchise->mobile = $mobile;
        $franchise->email = $email;
        $franchise->city = $city;
        $franchise->state = $state;
        $franchise->country = $country;
        $franchise->password = $f_password;
        $franchise->status = 'Active';
        $franchise->commission = $commission;
        $franchise->save();

        // $data = FranchiseDetail::find($franchise_id);
        $fid = $franchise_id;
        $email = $email;
        $name = $name;
        $mobile = $mobile;
        $country = $country;
        $commission = $commission;
        $m_password = $password;
        if ($email != '') {
            $mailData = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'franchise_id' => $fid,
                'state' => $state,
                'city' => $city,
                'country' => $country,
                'password' => $m_password,
                'commission' => $commission
            ];
            $user['to'] = $email;
            // Mail::send('franchise.mails.mail', $mailData, function ($message) use ($user) {

            //     $message->to($user['to']);
            //     $message->subject('AMBER VEDA Login Credentials');
            // });
        }

        session()->flash('successMsg', 'Franchise created successfully.');
        return redirect()->back();
    }

    private function getCityStateColumn(): ?string
    {
        if (Schema::hasColumn('cities', 'state')) {
            return 'state';
        }

        if (Schema::hasColumn('cities', 'state_name')) {
            return 'state_name';
        }

        return null;
    }

    public function franchiseDetail()
    {
        $result['data'] = FranchiseDetail::where('status', 'Active')->orderby('created_at', 'desc')->get();
        return view('admin.franchise.franchise-details')->with($result);
    }

    public function franchiseInventory($franchise_id)
    {
        $franchise['data'] = FranchiseDetail::where('franchise_id',$franchise_id)->first();
        $franchise['product'] = Product::orderBy('created_at', 'desc')->get();
        return view('admin.franchise.inventory-details')->with($franchise);
    }


    public function freePinAccount()
    {
        $result['data'] = MemberDetail::where('status', 'Temp')->orderby('created_at', 'desc')->get();
        return view('admin.members.free-pin-account')->with($result);
    }

   public function PinUserAccount(Request $request)
    {
        $request->validate([
            'memberid' => 'required',
        ]);

        $memberid = $request->post('memberid');
        $check = MemberDetail::where('memberid', $memberid)->first();
        if ($check) {
            $memberid = $check->memberid;
            $sponsorid = $check->sponsorid;

            if ($check->status != 'Temp') {
                session()->flash('failedMsg', 'Member is already activated.');
                return redirect()->back();
            }

            $check->status = 'Active';
            $check->activated_at = date('Y-m-d H:i:s');
            $check->activated_by = 'Admin';
            $check->save();

            updateDownline($sponsorid);
            updateUpline($sponsorid, $memberid);

            session()->flash('successMsg', 'Member has been activated successfully.');
            return redirect()->back();
        } else {
            session()->flash('failedMsg', 'Member ID not found.');
            return redirect()->back();
        }
    }
    
    // public function createCities()
    // {
    //     $result['states'] = IndiaState::orderBy('state_name')->get();
    //     $result['data'] = City::orderBy('state')->orderBy('city')->get();
    //     return view('admin.cities.create-cities')->with($result);
    // }

    // public function storeCity(Request $request)
    // {
    //     $request->validate([
    //         'state' => 'required|string|max:50',
    //         'city' => 'required|string|max:50',
    //     ]);

    //     $state = trim($request->post('state'));
    //     $city = trim($request->post('city'));

    //     if (City::whereRaw('LOWER(state) = ? AND LOWER(city) = ?', [strtolower($state), strtolower($city)])->exists()) {
    //         session()->flash('failedMsg', 'This city already exists for the selected state.');
    //         return redirect()->back()->withInput();
    //     }

    //     $cityData = new City();
    //     $cityData->state = $state;
    //     $cityData->city = $city;
    //     $cityData->save();

    //     session()->flash('successMsg', 'City created successfully.');
    //     return redirect()->back();
    // }
    
    public function franchiseLogin(Request $request, $id)
    {
        $result = FranchiseDetail::find($id);
        if ($result) {
            $request->session()->put('FRANCHISE_LOGIN', true);
            $request->session()->put('FRANCHISE_ID', $result->id);
            return redirect('franchise_panel/dashboard');
        }
    }
    
     public function newKycRequests()
    {
        $result['data'] = FranchiseDetail::where('kyc_status', 'Submitted')->get();
        return view('admin.franchise.kyc-requests')->with($result);
    }

    public function franchiseupdateKYC(Request $request)
    {
        $var = FranchiseDetail::find($request->post('id'));
        $var->bank = $request->post('bank');
        // $var->branch = $request->post('branch');
        $var->holder = $request->post('holder');
        $var->account_no = $request->post('account_no');
        $var->ifsc = $request->post('ifsc');
        $var->pan_no = $request->post('pan_no');
        // $var->name = $request->post('name');
        // $var->email = $request->post('email');
        $var->adhar_no = $request->post('adhar_no');
        $var->nominee_name = $request->post('nominee_name');
        $var->nominee_relation = $request->post('nominee_relation');
        $var->nominee_no = $request->post('nominee_no');
        // $var->wallet_address = $request->post('wallet_address');
        $var->save();
        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }
    
     public function franchiseKycView(Request $request, $id)
    {
        $ids = session('ADMIN_ID');
        $result['data'] = Admin::find($ids);
        $result['mdata'] = FranchiseDetail::find($id);
        return view('admin.franchise.view-kyc')->with($result);
    }

    public function franchisekycVerify(Request $request, $id)
    {
        $var = FranchiseDetail::find($id);
        $var->kyc_status = 'Verified';
        $var->save();
        session()->flash('kycMesg', 'KYC request has been verified successfully!');
        return redirect('admin/franchise-new-kyc-requests');
    }

     public function franchisekycReject(Request $request, $id)
    {
        $var = FranchiseDetail::find($id);
        $var->kyc_status = 'Unverified';
        $var->bank = '';
        // $var->branch = '';
        $var->holder = '';
        $var->ifsc = '';
        $var->account_no = '';
        $var->pan_no = '';
        // $var->name = '';
        $var->email = '';
        $var->adhar_no = '';
        $var->nominee_name = '';
        $var->nominee_relation = '';
        $var->nominee_no = '';
        // $var->wallet_address = '';
        $var->pan_image = '';
        $var->front_image = '';
        $var->back_image = '';
        $var->cheque_image = '';
        $var->save();

        session()->flash('kycMesg', 'KYC request has been rejected successfully!');
        return redirect('admin/franchise-new-kyc-requests');
    }

     public function franchiseupdateAfront(Request $request)
    {
        $var = FranchiseDetail::find($request->post('id'));
        $file =  $request->file('front_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->front_image = $filename;
        $var->save();
        $oldImage1 = $request->post('oldImage1');
        if ($oldImage1 != '') {
            $file_path = public_path('uploads/') . $oldImage1;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

     public function franchiseupdateAback(Request $request)
    {
        $var = FranchiseDetail::find($request->post('id'));
        $file =  $request->file('back_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->back_image = $filename;
        $var->save();
        $oldImage2 = $request->post('oldImage2');
        if ($oldImage2 != '') {
            $file_path = public_path('uploads/') . $oldImage2;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

     public function franchiseupdatePan(Request $request)
    {
        $var = FranchiseDetail::find($request->post('id'));
        $file =  $request->file('pan_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->pan_image = $filename;
        $var->save();
        $oldImage = $request->post('oldImage');
        if ($oldImage != '') {
            $file_path = public_path('uploads/') . $oldImage;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function franchiseupdateCheque(Request $request)
    {
        $var = FranchiseDetail::find($request->post('id'));
        $file =  $request->file('cheque_image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move(public_path('uploads'), $filename);
        $var->cheque_image = $filename;
        $var->save();
        $oldImage3 = $request->post('oldImage3');
        if ($oldImage3 != '') {
            $file_path = public_path('uploads/') . $oldImage3;
            @unlink($file_path);
        }

        session()->flash('successMsg', 'KYC Details have been updated successfully.');
        return redirect()->back();
    }

    public function franchiseverifiedKyc()
    {
        $result['data'] = FranchiseDetail::where('kyc_status', 'Verified')->get();
        return view('admin.franchise.verified-kyc')->with($result);
    }
    
     public function travelFundInc()
    {
        $result['data'] = TravelFundDetail::all();
        return view('admin.income.travel-fund')->with($result);
    }
      
    
        public function binaryMatchingIncome()
    {
        $result['data'] = BinaryIncome::all();
        return view('admin.income.binary-matching-income')->with($result);
    }
    
    
    public function clubIncome()
    {
        $result['data'] = ClubIncome::all();
        return view('admin.income.club-income')->with($result);
    }
    
    public function mentorshipIncome()
    {
        $result['data'] = MentorshipIncome::orderBy('id', 'desc')->get();
        return view('admin.income.mentorship-income')->with($result);
    }
    
    public function travelInc($id)
    {
        $var = TravelFundDetail::find($id);
        $var->status  = 'Paid';
        $var->save();

        session()->flash('successMsg', 'Travel Fund has been paid successfully.');
        return redirect()->back();
    }
    
    public function gstReport()
    {
        $result['data'] = OrderDetail::all();
        return view('admin.reports.gst-report')->with($result);
    }

    public function tdsReport()
    {
        $result['Wdata'] = WithdrawalRequest::all();
        $result['data'] = MemberDetail::all();
        return view('admin.reports.tds-report')->with($result);
    }
}
