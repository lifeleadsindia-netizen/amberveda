<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberDetail;
use App\Models\AchiversImages;
use App\Models\Country;
use App\Models\DashMessage;
use App\Models\BillingDetail;
use App\Models\DeliveryIncome;
use App\Models\FranchiseDetail;
use App\Models\ImportFund;
use App\Models\IssueInventorie;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\SetRate;
use App\Models\WalletTransfer;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;


class FranchiseController extends Controller
{
    public function index()
    {
        if (session()->has('FRANCHISE_LOGIN')) {
            return redirect('franchise_panel/dashboard');
        } else {
            $str1 = rand(1, 15);
            $str2 = rand(1, 15);

            session()->put('str1', $str1);
            session()->put('str2', $str2);
            return view('franchise.signin');
        }
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'franchise_id' => 'required|min:9',
            'password' => 'required'
        ]);
        $franchise_id = $request->post('franchise_id');
        $password = $request->post('password');
        $captcha = $request->post('login-captcha');

        $str1 = session('str1');
        $str2 = session('str2');
        $total = $str1 + $str2;
        if ($total != $captcha) {
            session()->flash('loginmsg', 'Invalid captcha input');
            return redirect('/franchise_panel');
        } else {
            session()->forget(['str1', 'str2']);
        }

        $result = FranchiseDetail::where('franchise_id', $franchise_id)->first();
        if ($result && Hash::check($password, $result->password)) {
            if ($result->status == 'Temp' || $result->status == 'Active' || $result->status == 'Deactive') {
                $request->session()->put('FRANCHISE_LOGIN', true);
                $request->session()->put('FRANCHISE_ID', $result->id);
                return redirect('franchise_panel/dashboard');
            } else {
                session()->flash('loginmsg', 'Your account is Blocked. Please contact admin');
                return redirect('/franchise_panel');
            }
        } else {
            session()->flash('loginmsg', 'Please enter valid Franchise ID or Password to login');
            return redirect('/franchise_panel');
        }
    }

    public function dashboard(Request $request)
    {
        $id = session('FRANCHISE_ID');
        $result['data'] = FranchiseDetail::find($id);
        $result['dashMsg'] = DashMessage::orderby('rank', 'asc')->get();
        return view('franchise.dashboard')->with($result);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('FRANCHISE_LOGIN');
        $request->session()->forget('FRANCHISE_ID');

        return redirect('/franchise_panel');
    }

    public function currentInventory()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['products'] = Product::orderBy('created_at', 'desc')->get();
        return view('franchise.inventory.current-inventory')->with($result);
    }

    public function receivedInventory()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['issues'] = IssueInventorie::orderBy('id', 'desc')->get();
        return view('franchise.inventory.received-inventory')->with($result);
    }

    public function franchiseForgetPassword()
    {
        return view('franchise.forget-password');
    }

    public function franchiseRetrievePassword(Request $request)
    {
        $franchise_id = $request->post('franchise_id');

        $data = FranchiseDetail::where('franchise_id', $franchise_id)->first();
        if ($data) {
            $name = $data['name'];
            $email = $data['email'];
            $franchise_id = $data['franchise_id'];
            $password = rand(100000, 999999);
            $data->password = Hash::make($password);
            $data->save();

            if ($email != '') {
                $mailData = [
                    'name' => $name,
                    'email' => $email,
                    'franchise_id' => $franchise_id,
                    'password' => $password
                ];
                $user['to'] = $email;
                // Mail::send('franchise.mails.forget-password-mail', $mailData, function ($message) use ($user) {

                //     $message->to($user['to']);
                //     $message->subject('AMBER VEDA Login Credentials');
                // });
            }
            session()->flash('successMsg', 'Your Account Password has been sent to your registered email.');
            return redirect()->back();
        } else {
            session()->flash('failedMsg', 'Entered franchise ID is not registered with us!');
            return redirect()->back();
        }
    }

    public function profileDetails()
    {
        $id = session('FRANCHISE_ID');
        $result['data'] = FranchiseDetail::find($id);
        return view('franchise.profile.profile-setting')->with($result);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|min:10|max:10'
        ]);
        $id = $request->post('id');

        $var = FranchiseDetail::find($id);
        $var->email = $request->post('email');
        $var->mobile = $request->post('mobile');
        $var->name = $request->post('name');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $filename = time() . '.' . $ext;
            $file->move(public_path('uploads'), $filename);
            $var->image = $filename;
        }
        $var->save();

        session()->flash('successMsg', 'Profile Details have been updated');
        return redirect()->back();
    }

    public function security()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        return view('franchise.profile.security')->with($result);
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'min:6'
        ]);
        //print_r($request->post());

        $id = $request->post('id');
        $var = FranchiseDetail::find($id);
        $var->password = Hash::make($request->post('password'));
        $var->save();

        session()->flash('confirm_pasSuccess', 'Password has been updated successfully');
        return redirect()->back();
    }
    
    public function kycVerified()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        return view('franchise.profile.kyc-verified')->with($result);
    }

    public function franchiseKyc(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:franchise_details,id',
            'bank' => 'required',
            'holder' => 'required',
            'ifsc' => 'required',
            'account_no' => 'required',
            'adhar_no' => 'required',
            'pan_no' => 'required',
            'nominee_name' => 'required',
            'nominee_relation' => 'required',
            'nominee_no' => 'required|min:10|max:10',
            'pan_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'front_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'back_image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'cheque_image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        $id = $request->post('id');
        $adhar_no = $request->post('adhar_no');
        $pan_no = strtoupper($request->post('pan_no'));

        $aadhar_check = FranchiseDetail::where('adhar_no', $adhar_no)
            ->where('id', '!=', $id)
            ->exists();
        if ($aadhar_check) {
            session()->flash('failedMsg', 'Aadhar No is already registered. Please change Aadhar No');
            return redirect()->back();
        }

        $pan_check = FranchiseDetail::where('pan_no', $pan_no)
            ->where('id', '!=', $id)
            ->count();
        if ($pan_check >= 3) {
            session()->flash('failedMsg', 'PAN No is already registered. Please change PAN No');
            return redirect()->back();
        }

        $var = FranchiseDetail::find($id);
        if (!$var) {
            session()->flash('failedMsg', 'Franchise details not found!');
            return redirect()->back();
        }

        $var->bank = $request->post('bank');
        $var->holder = $request->post('holder');
        $var->ifsc = strtoupper($request->post('ifsc'));
        $var->account_no = $request->post('account_no');
        $var->adhar_no = $adhar_no;
        $var->pan_no = $pan_no;
        $var->nominee_name = $request->post('nominee_name');
        $var->nominee_relation = $request->post('nominee_relation');
        $var->nominee_no = $request->post('nominee_no');

        if ($request->hasfile('pan_image') != '') {
            $pImage = $request->file('pan_image');
            $ext = strtolower($pImage->getClientOriginalExtension());
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $panImage = "P" . time() . '.' . $ext;
            $pImage->move(public_path('uploads'), $panImage);
            $var->pan_image = $panImage;
        }

        if ($request->hasfile('front_image') != '') {
            $fImage = $request->file('front_image');
            $ext = strtolower($fImage->getClientOriginalExtension());
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $frontImage = "F" . time() . '.' . $ext;
            $fImage->move(public_path('uploads'), $frontImage);
            $var->front_image = $frontImage;
        }

        if ($request->hasfile('back_image') != '') {
            $bImage = $request->file('back_image');
            $ext = strtolower($bImage->getClientOriginalExtension());
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $backImage = "B" . time() . '.' . $ext;
            $bImage->move(public_path('uploads'), $backImage);
            $var->back_image = $backImage;
        }

        if ($request->hasfile('cheque_image') != '') {
            $cImage = $request->file('cheque_image');
            $ext = strtolower($cImage->getClientOriginalExtension());
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $chequeImage = "C" . time() . '.' . $ext;
            $cImage->move(public_path('uploads'), $chequeImage);
            $var->cheque_image = $chequeImage;
        }

        $var->kyc_status = 'Submitted';
        $var->save();

        session()->flash('kycMsg', 'KYC Details have been updated successfully!');
        return redirect()->back();
    }

    public function orderDetails()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['products'] = Product::pluck('product', 'id');
        $result['order'] = OrderDetail::where('franchise_id', $result['data']['franchise_id'])
            ->where('status', 'Pending')
            ->orderBy('id', 'desc')
            ->get();
        return view('franchise.orders.order-details')->with($result);
    }
    
    public function deliveredOrders()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['products'] = Product::pluck('product', 'id');
        $result['order'] = OrderDetail::where('franchise_id', $result['data']['franchise_id'])
            ->orderBy('id', 'desc')
            ->get();

        return view('franchise.orders.delivered-orders')->with($result);
    }

    public function orderManagementDetails($id)
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['order'] = OrderDetail::where('id', $id)->where('franchise_id', $result['data']['franchise_id'])->first();
        if (!$result['order']) {
            return redirect()->route('franchise.order.details')->with('failedMsg', 'Order not found!');
        }

        $result['productName'] = Product::where('id', $result['order']->pro_id)->value('product');
        $result['billing'] = BillingDetail::where('memberid', $result['order']->memberid)->orderBy('id', 'desc')->first();
        $result['member'] = MemberDetail::where('memberid', $result['order']->memberid)->first();
        return view('franchise.orders.order-management-details')->with($result);
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|in:Delivered,Undelivered',
            'remark' => 'nullable|string|max:500',
        ]);

        $orderId = $request->post('order_id');
        $status = $request->post('status');
        $remark = $request->post('remark');
        $franchise = FranchiseDetail::find(session('FRANCHISE_ID'));

        $order = OrderDetail::where('id', $orderId)->where('franchise_id', $franchise->franchise_id)->first();
        if ($order) {
            
            if ($order->status == 'Delivered') {
                session()->flash('failedMsg', 'Order is already delivered. You can not change status now!');
                return redirect()->back();
            }
            
            $order->status = $status;
            $order->remark = $remark;
            $order->save();
            
            if($status == 'Delivered'){
                $income = new DeliveryIncome();
                $income->franchise_id = $franchise->franchise_id;
                $income->order_id = $orderId;
                $income->amount = $franchise->commission;
                $income->status = 'Unpaid';
                $income->save();
            }

            

            session()->flash('successMsg', 'Order ' . $status . ' successfully!');
            return redirect('franchise_panel/order/completed-orders');
        } else {
            session()->flash('failedMsg', 'Order not found!');
            return redirect()->back();
        }
    }
    
    public function mainWallets()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        return view('franchise.wallet.main-wallet')->with($result);
    }

    public function passbook()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['passdata'] = WalletTransfer::where([['franchise_id', $result['data']['franchise_id']], ['walletType', '!=', 'P2P Fund Transfer'], ['walletType', '!=', 'Wallet to p2p Transfer'], ['walletType', '!=', 'Transfer to Purchase Wallet']])->orderBy('created_at', 'desc')->get();
        return view('franchise.wallet.wallet-transfer')->with($result);
    }
    
    public function deliveryCommission()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['ddata'] = DeliveryIncome::where('franchise_id', $result['data']['franchise_id'])->get();
        return view('franchise.income.delivery-commission')->with($result);
    }

    public function withdrlHistory()
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $result['reqdata'] = WithdrawalRequest::where('franchise_id', $result['data']['franchise_id'])->orderBy('created_at', 'desc')->get();
        return view('franchise.wallet.withdrawal-history')->with($result);
    }

    public function mainWithdrawal(Request $request)
    {
        $request->validate([
            'inr_amount' => 'required',
            'password' => 'required',
        ]);
        $franchise_id = $request->post('franchise_id');
        $withAmount = $request->post('inr_amount');
        $Pass = $request->post('password');
        $franchiseData = FranchiseDetail::where('franchise_id', $franchise_id)->first();
        $Status = $franchiseData['status'];
        $wallet = $franchiseData['wallet'];
        $password = $franchiseData['password'];
        $email = $franchiseData['email'];


        if ($franchiseData['kyc_status'] != 'Verified') {
            session()->flash('failedMsg', 'Your kyc details are not verified. After kyc verification you will eligible for withdrawal');
            return redirect()->back();
        }

        if ($withAmount < 0) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be greater than ₹ 10');
            return redirect()->back();
        }

        if ($withAmount < 10) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount must be equal or greater than ₹ 10');
            return redirect()->back();
        }

        if ($withAmount > $wallet) {
            session()->flash('failedMsg', 'Invalid Amount Entered. Amount can not be greater than wallet balance');
            return redirect()->back();
        }

        if (!Hash::check($Pass, $password)) {
            session()->flash('failedMsg', 'Enter Password do not match. Please check and try again');
            return redirect()->back();
        }

        if ($Status != 'Active') {
            session()->flash('failedMsg', 'Your Account is not Active. Plase activate your account to withdraw money');
            return redirect()->back();
        }

        $service = $withAmount / 100 * 0;
        $netAmount = $withAmount - $service;
        $net_service = $netAmount / 100 * 0;
        $re_amount = $netAmount - $net_service;


        $date = date('Y-m-d H:i:s');
        $requestId = "RQ" . time();
        $qry = FranchiseDetail::where('franchise_id', $franchise_id)->first();

        $check = WithdrawalRequest::where([['franchise_id', $franchise_id], ['request_id', $requestId]])->first();
        if (!$check) {
            $var = new WithdrawalRequest();
            $var->request_date = $date;
            $var->request_id = $requestId;
            $var->franchise_id = $franchise_id;
            $var->name = $franchiseData['name'];
            $var->wallet_address = $franchiseData['wallet_address'];
            $var->bank = $franchiseData['bank'];
            $var->ifsc = $franchiseData['ifsc'];
            $var->holder = $franchiseData['holder'];
            $var->account = $franchiseData['account_no'];
            $var->gross_amount = $withAmount;
            $var->service_charge = $service;
            $var->net_amount = $net_service;
            $var->type = 'Franchise Wallet';
            $var->save();

            $wallet = $qry->wallet;
            $qry->wallet -= $withAmount;
            $qry->save();

            walletTransfer($franchise_id, $withAmount, 'credit', $wallet, 'Withdrawal', ' ₹ ' . $withAmount . ' have been withdrawn by Franchise from wallet. Payment Id-' . $requestId);

            $mailData = [
                'request_id' => $requestId,
                'email' => $qry->email,
                'franchise_id' => $franchise_id,
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
            // Mail::send('franchise.mails.withdrawal-request', $mailData, function ($message) use ($user) {

            //     $message->to($user['to']);
            //     $message->subject('AMBER VEDA Withdrawal Request');
            // });

            session()->flash('successMsg', 'Withdrawal request has been created successfully. Amount will be transfered into wallet after transaction validation');
            return redirect()->back();
        }
    }
    
    public function viewDetails($id)
    {
        $result['data'] = FranchiseDetail::find(session('FRANCHISE_ID'));
        $memberid = $result['data']['memberid'];
        $result['data'] = WithdrawalRequest::find($id);
        return view('franchise.wallet.detail-history')->with($result);
    }
}
