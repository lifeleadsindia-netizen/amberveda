<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\MemberDetail;
use App\Models\Country;
use App\Models\DashMessage;
use App\Models\IndianStates;
use App\Models\IndiaState;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Services\SmsService;

class MemberDetailController extends Controller
{
    public function index()
    {
        if (session()->has('MEMBER_LOGIN')) {
            return redirect('member/dashboard');
        } else {
            $str1 = rand(1, 15);
            $str2 = rand(1, 15);

            session()->put('str1', $str1);
            session()->put('str2', $str2);
            return view('member.signin');
        }
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'memberid' => 'required|min:9',
            'password' => 'required'
        ]);
        $memberid = $request->post('memberid');
        $password = $request->post('password');
        $captcha = $request->post('login-captcha');

        $str1 = session('str1');
        $str2 = session('str2');
        $total = $str1 + $str2;
        if ($total != $captcha) {
            session()->flash('loginmsg', 'Invalid captcha input');
            return redirect('/member');
        } else {
            session()->forget(['str1', 'str2']);
        }

        $result = MemberDetail::where('memberid', $memberid)->first();
        if ($result && Hash::check($password, $result->password)) {
            if ($result->status == 'Temp' || $result->status == 'Active' || $result->status == 'Deactive') {
                $request->session()->put('MEMBER_LOGIN', true);
                $request->session()->put('MEMBER_ID', $result->id);
                return redirect('member/dashboard');
            } else {
                session()->flash('loginmsg', 'Your account is Blocked. Please contact admin');
                return redirect('/member');
            }
        } else {
            session()->flash('loginmsg', 'Please enter valid Memberid or Password to login');
            return redirect('/member');
        }
    }

    public function signup($id, $side)
    {
        $sponsorid['sdata'] = $id;
        $sponsorid['side'] = $side;
        $sponsorid['countries'] = Country::all();
        $sponsorid['states'] = IndiaState::all();
        $sponsorid['introducer'] = null;
        if ($id != 1) {
            session()->put('sponsorid', $id);
            $sponsorid['introducer'] = MemberDetail::where('memberid', $id)->first();
        }
        return view('member.signup')->with($sponsorid);
    }

        public function sendRegistrationOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = trim($request->post('email'));
        $name = trim($request->post('name') ?: 'Direct Seller');

        // Check if email already registered
        $emailExists = MemberDetail::where('email', $email)->exists();
        if ($emailExists) {
            return response()->json([
                'success' => false,
                'message' => 'This email has already been used. Please use another email.'
            ], 422);
        }

        // Generate secure 6-digit OTP
        $otp = (string) rand(100000, 999999);

        // Store OTP in session
        session()->put('registration_otp', $otp);
        session()->put('registration_otp_email', $email);
        session()->put('registration_otp_time', now());

        session()->put('distributor_otp', $otp);
        session()->put('distributor_otp_sponsor', $request->post('sponsor'));
        session()->put('distributor_otp_time', now());

        // DEMO OTP MODE: Disable this condition to restore normal OTP delivery.
        $isDemoOtpMode = env('DEMO_OTP_MODE', true) && (config('app.debug') || app()->environment('local', 'development'));

        if (!$isDemoOtpMode) {
            // Dispatch OTP to registrant's email
            $mailData = [
                'name' => $name,
                'email' => $email,
                'otp' => $otp,
            ];

            try {
                Mail::send('member.mails.registration-otp', $mailData, function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('AMBER VEDA - Registration Verification OTP');
                });
                Log::info("[EmailService] Registration OTP dispatched to email", [
                    'email' => $email,
                    'otp' => $otp,
                    'timestamp' => now()->toDateTimeString()
                ]);
            } catch (\Exception $e) {
                Log::warning("[EmailService] SMTP Dispatch notice", [
                    'email' => $email,
                    'otp' => $otp,
                    'error' => $e->getMessage()
                ]);
            }
        } else {
            Log::info("[DemoOtpMode] Registration Demo OTP generated (Email delivery bypassed)", [
                'email' => $email,
                'otp' => $otp,
                'timestamp' => now()->toDateTimeString()
            ]);
        }

        // Mask email for display (e.g. ro***@gmail.com)
        $parts = explode('@', $email);
        $userPart = $parts[0];
        $domainPart = $parts[1] ?? '';
        $maskedUser = strlen($userPart) > 2 ? substr($userPart, 0, 2) . '***' : $userPart . '***';
        $maskedEmail = $maskedUser . '@' . $domainPart;

        $response = [
            'success' => true,
            'message' => $isDemoOtpMode ? 'Demo OTP generated successfully for testing.' : 'Verification OTP has been sent to your registered email address.',
            'masked_email' => $maskedEmail,
            'email' => $email
        ];

        if ($isDemoOtpMode) {
            $response['demo_otp'] = $otp;
        }

        return response()->json($response);
    }

    public function sendDistributorOtp(Request $request)
    {
        if ($request->filled('email')) {
            return $this->sendRegistrationOtp($request);
        }

        $request->validate([
            'sponsor' => 'required',
        ]);

        $sponsorId = $request->post('sponsor');
        $distributor = MemberDetail::where('memberid', $sponsorId)->first();

        if (!$distributor) {
            return response()->json([
                'success' => false,
                'message' => 'Introducer ID not found in system.'
            ], 404);
        }

        $distributorMobile = trim($distributor->mobile ?? '');
        if (empty($distributorMobile)) {
            return response()->json([
                'success' => false,
                'message' => 'Registered distributor does not have a registered mobile number.'
            ], 422);
        }

        // Generate secure 6-digit OTP
        $otp = (string) rand(100000, 999999);

        // Store OTP in session with sponsor ID and creation timestamp
        session()->put('distributor_otp', $otp);
        session()->put('distributor_otp_sponsor', $sponsorId);
        session()->put('distributor_otp_time', now());

        // DEMO OTP MODE: Disable this condition to restore normal OTP delivery.
        $isDemoOtpMode = env('DEMO_OTP_MODE', true) && (config('app.debug') || app()->environment('local', 'development'));

        $smsStatus = 'bypassed_demo_mode';
        if (!$isDemoOtpMode) {
            // Dispatch via SmsService to the registered distributor's mobile
            $smsResult = SmsService::sendDistributorOtp($distributorMobile, $otp, $distributor->name);
            $smsStatus = $smsResult['status'] ?? 'sent';
        } else {
            Log::info("[DemoOtpMode] Distributor Mobile Demo OTP generated (SMS bypassed)", [
                'mobile' => $distributorMobile,
                'otp' => $otp,
                'timestamp' => now()->toDateTimeString()
            ]);
        }

        // Mask distributor mobile (e.g. ******5891)
        $len = strlen($distributorMobile);
        $maskedMobile = $len > 4 
            ? str_repeat('*', max(0, $len - 4)) . substr($distributorMobile, -4)
            : '****';

        $response = [
            'success' => true,
            'message' => $isDemoOtpMode ? 'Demo OTP generated successfully for testing.' : 'OTP sent to registered distributor mobile number.',
            'masked_mobile' => $maskedMobile,
            'distributor_name' => $distributor->name,
            'sms_status' => $smsStatus
        ];

        if ($isDemoOtpMode) {
            $response['demo_otp'] = $otp;
        }

        return response()->json($response);
    }

    public function register(Request $request)
    {
        $request->validate([
            'sponsor' => 'required',
            'name' => 'required|string',
            'position' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits_between:10,15',
            'country' => 'required',
            'password' => 'required|min:6',
        ]);

        // Check if KYC was skipped
        $isKycSkipped = $request->boolean('skip_kyc') || $request->post('skip_kyc') === '1' || $request->input('skip_kyc') == '1' || $request->filled('skip_kyc');

        if (!$isKycSkipped) {
            // 1. Verify Verification OTP (sent to registrant's email) only when KYC is required
            $otp = $request->post('distributor_otp') ?: ($request->post('registration_otp') ?: $request->post('otp'));
            $sessionOtp = session()->get('registration_otp') ?: session()->get('distributor_otp');
            $sessionEmail = session()->get('registration_otp_email');
            $otpTime = session()->get('registration_otp_time') ?: session()->get('distributor_otp_time');

            if (empty($otp)) {
                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Please enter the verification OTP sent to your registered email.'], 422);
                }
                session()->flash('failedMsg', 'Please enter the verification OTP sent to your registered email.');
                return redirect()->back()->withInput();
            }

            if (empty($sessionOtp) || ($sessionEmail && $sessionEmail != $request->post('email'))) {
                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'OTP has expired or was not requested. Please request a new OTP.'], 422);
                }
                session()->flash('failedMsg', 'OTP has expired or was not requested. Please request a new OTP.');
                return redirect()->back()->withInput();
            }

            // Expire after 10 minutes (600 seconds)
            if ($otpTime && now()->diffInSeconds($otpTime) > 600) {
                session()->forget(['registration_otp', 'registration_otp_email', 'registration_otp_time', 'distributor_otp', 'distributor_otp_sponsor', 'distributor_otp_time']);
                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'OTP has expired. Please request a new OTP.'], 422);
                }
                session()->flash('failedMsg', 'OTP has expired. Please request a new OTP.');
                return redirect()->back()->withInput();
            }

            // Verify OTP value match
            if (trim((string)$otp) !== trim((string)$sessionOtp)) {
                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Entered OTP does not match. Please check and try again.'], 422);
                }
                session()->flash('failedMsg', 'Entered OTP does not match. Please check and try again.');
                return redirect()->back()->withInput();
            }

            // OTP verified successfully: invalidate immediately to prevent reuse
            session()->forget(['registration_otp', 'registration_otp_email', 'registration_otp_time', 'distributor_otp', 'distributor_otp_sponsor', 'distributor_otp_time']);
        }

        // 2. Validate sponsor, email, and mobile uniqueness
        $sponsorExists = MemberDetail::where('memberid', $request->post('sponsor'))->exists();
        if (!$sponsorExists) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Sponsor ID does not exist.'], 422);
            }
            session()->flash('failedMsg', 'Sponsor ID does not exist.');
            return redirect()->back()->withInput();
        }

        $emailExists = MemberDetail::where('email', $request->post('email'))->exists();
        if ($emailExists) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'This email has already been used. Please use another email.'], 422);
            }
            session()->flash('failedMsg', 'This email has already been used. Please use another email.');
            return redirect()->back()->withInput();
        }

        $mobileExists = MemberDetail::where('mobile', $request->post('mobile'))->exists();
        if ($mobileExists) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'This mobile number has already been used. Please use another mobile number.'], 422);
            }
            session()->flash('failedMsg', 'This mobile number has already been used. Please use another mobile number.');
            return redirect()->back()->withInput();
        }

        $sponsorid = $request->post('sponsor');
        $position = $request->post('position');
        $email = $request->post('email');
        $country = $request->post('country');
        $mobile = $request->post('mobile');
        $password = $request->post('password');

        $var = new MemberDetail();
        $var->memberid = userId();
        $var->sponsorid = $sponsorid;
        $var->name = $request->post('name');
        $var->email = $email;
        $var->mobile = $mobile;
        $var->password = Hash::make($password);
        $var->country = $country;
        $var->position = $position;

        $var->kyc_status = 'Unverified';
        $var->save();

        // Connect to existing member panel profile section KYC backend function (memKyc) only if KYC not skipped
        if (!$isKycSkipped && ($request->filled('bank') || $request->filled('adhar_no') || $request->hasFile('pan_image'))) {
            $request->request->set('id', $var->id);
            $request->merge(['id' => $var->id]);
            $this->memKyc($request);
        }

        addPlacementId($var->memberid, $sponsorid, $position);
        updateUpline($sponsorid, $var->memberid);

        $data = MemberDetail::find($var->id);
        $userid = $data->memberid;
        $email = $data->email;
        $name = $data->name;
        $mobile = $data->country_code . ' ' . $data->mobile;
        $placementid = $data->placementid;
        binary_count_update($userid, $placementid, $position);

        if ($email != '') {
            $mailData = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'memberid' => $userid,
                'password' => $password,
            ];
            $user['to'] = $email;
            try {
                Mail::send('member.mails.mail', $mailData, function ($message) use ($user) {
                    $message->to($user['to']);
                    $message->subject('AMBER VEDA Member Login Credentials');
                });
            } catch (\Exception $e) {
                // Email failure should not crash registration completion
            }
        }

        $request->session()->put('name', $request->post('name'));
        $request->session()->put('memberid', $userid);
        $request->session()->put('email', $email);
        $request->session()->put('mobile', $mobile);
        $request->session()->put('country', $country);
        $request->session()->put('password', $request->post('password'));
        session()->flash('successMsg', 'Account has been created Successfully!.');

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration completed successfully!',
                'redirect' => url('member/account-created')
            ]);
        }
        return redirect('member/account-created');
    }

    public function accountCreated()
    {
        return view('member.account-created');
    }

    public function dashboard(Request $request)
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        // $result['images'] = AchiversImages::orderby('rank', 'asc')->get();
        $result['dashMsg'] = DashMessage::orderby('rank', 'asc')->get();
        return view('member.dashboard')->with($result);
    }

    public function profileDetails()
    {
        $id = session('MEMBER_ID');
        $result['data'] = MemberDetail::find($id);
        $result['idata'] = IndiaState::all();
        $cityStateColumn = $this->getCityStateColumn();
        $result['cityStateColumn'] = $cityStateColumn;
        $result['cdata'] = $cityStateColumn
            ? City::select(['city', $cityStateColumn])->orderBy('city', 'asc')->get()
            : City::select(['city'])->orderBy('city', 'asc')->get();
        return view('member.profile.profile-setting')->with($result);
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


    // public function notification()
    // {
    //     return view('member.notification');
    // }

    // public function updateNominee()
    // {
    //     return view('member.profile.update-nominee');
    // }

    // public function kycDetails()
    // {
    //     return view('member.profile.kyc-details');
    // }

    public function logout(Request $request)
    {
        $request->session()->forget('MEMBER_LOGIN');
        $request->session()->forget('MEMBER_ID');

        return redirect('/member');
    }

    public function KYC()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.profile.kyc')->with($result);
    }

    public function security()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.profile.security')->with($result);
    }

    public function getSponname(Request $request)
    {
        $sponsorid = $request->post('sponsorid');
        if ($sponsorid != '') {
            $data = MemberDetail::where('memberid', $sponsorid)->first();
            if ($data) {

                // if ($data['status'] == 'Temp') {
                //     return response()->json([
                //         'code' => 0,
                //         'data' => '<span class="text-danger">This Sponsor Id is not active. Please change sponsor id</span>'
                //     ]);
                // } elseif ($data['status'] == 'Deactive') {
                //     return response()->json([
                //         'code' => 0,
                //         'data' => '<span class="text-danger">This Sponsor Id is Deactive. Please change sponsor id</span>'
                //     ]);
                // } elseif ($data['status'] == 'Active') {
                return response()->json([
                    'code' => 1,
                    'data' => '<span class="text-success">Introducer Name :' . $data['name'] . '</span>'
                ]);
                // }
            } else {
                return response()->json([
                    'code' => 1,
                    'data' => '<span class="text-danger">No Data Found with this Id</span>'
                ]);
            }
        } else {
            return response()->json([
                'code' => 1,
                'data' => ''
            ]);
        }
    }

    public function getMember(Request $request)
    {
        $memberid = $request->post('memberid');
        if ($memberid != '') {
            $data = MemberDetail::where('memberid', $memberid)->first();
            if ($data) {
                return response()->json([
                    'code' => 1,
                    'data' => '<span class="text-success">Member Name :' . $data['name'] . '</span>'
                ]);
            } else {
                return response()->json([
                    'code' => 0,
                    'data' => '<span class="text-danger">No Data Found with this Id</span>'
                ]);
            }
        } else {
            return response()->json([
                'code' => 0,
                'data' => ''
            ]);
        }
    }

    public function updateKycData(Request $request)
    {
        $id = $request->post('id');
        $adhar_no = $request->post('id_no');
        $pan_no = $request->post('panno');

        $aadhar_check = MemberDetail::where('adhar_no', $adhar_no)->first();
        if ($aadhar_check) {
            session()->flash('failedMsg', 'Aadhar No is already registered. Please change Aadhar No');
            return redirect()->back();
        }

        $pan_check = MemberDetail::where('pan_no', $pan_no)->count();
        if ($pan_check >= 3) {
            session()->flash('failedMsg', 'PAN No is already registered. Please change PAN No');
            return redirect()->back();
        }

        $var = MemberDetail::find($id);
        $var->bank = $request->post('bank');
        $var->branch = $request->post('branch');
        $var->holder = $request->post('holder');
        $var->ifsc = $request->post('ifsc');
        $var->account_no = $request->post('account');
        $var->adhar_no = $request->post('id_no');
        $var->pan_no = $request->post('panno');
        $var->n_dob = $request->post('n_dob');
        $var->nominee = $request->post('nominee');
        $var->relation = $request->post('relation');

        if ($request->hasfile('pan_image') != '') {

            $pImage = $request->file('pan_image');
            $ext = $pImage->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $panImage = "P" . time() . '.' . $ext;
            $pImage->move(public_path('uploads'), $panImage);
            $var->pan_image = $panImage;
        }
        if ($request->hasfile('front_image') != '') {

            $pImage = $request->file('front_image');
            $ext = $pImage->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $panImage = "F" . time() . '.' . $ext;
            $pImage->move(public_path('uploads'), $panImage);
            $var->front_image = $panImage;
        }
        if ($request->hasfile('back_image') != '') {

            $pImage = $request->file('back_image');
            $ext = $pImage->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $panImage = "B" . time() . '.' . $ext;
            $pImage->move(public_path('uploads'), $panImage);
            $var->back_image = $panImage;
        }
        if ($request->hasfile('nominee_adhar') != '') {

            $nImage = $request->file('nominee_adhar');
            $ext = $nImage->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $nadharImage = "NM" . time() . '.' . $ext;
            $nImage->move(public_path('uploads'), $nadharImage);
            $var->nominee_adhar = $nadharImage;
        }


        $var->kyc_status = 'Submitted';
        $var->save();

        session()->flash('successMsg', 'KYC Details have been updated successfully!');
        return redirect()->back();
    }

    public function insertPdata(Request $request)
    {
        $request->validate([
            'state' => 'required',
            'mobile' => 'required|min:10|max:10'
        ]);
        $id = $request->post('id');

        $var = MemberDetail::find($id);
        $var->email = $request->post('email');
        $var->mobile = $request->post('mobile');
        $var->address = $request->post('address');
        $var->name = $request->post('name');
        $var->state = $request->post('state');
        $var->city = $request->post('city');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $filename = time() . '.' . $ext;
            $file->move(public_path('uploads'), $filename);
            $var->profile_image = $filename;
        }
        $var->save();

        session()->flash('successMsg', 'Profile Details have been updated');
        return redirect()->back();
    }

    public function passChange(Request $request)
    {
        $request->validate([
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'min:6'
        ]);
        //print_r($request->post());

        $id = $request->post('id');
        $var = MemberDetail::find($id);
        $var->password = Hash::make($request->post('password'));
        $var->save();

        session()->flash('confirm_pasSuccess', 'Password has been updated successfully');
        return redirect()->back();
    }

    public function txnpassChange(Request $request)
    {
        $request->validate([
            'txn_password' => 'required|required_with:password_confirm|same:txn_password_confirm|min:6',
            'txn_password_confirm' => 'min:6'
        ]);

        $id = $request->post('id');
        $var = MemberDetail::find($id);
        $var->txn_password = Hash::make($request->post('txn_password'));
        $var->save();

        session()->flash('successMsg', 'Transaction Password has been updated successfully');
        return redirect()->back();
    }

    public function searchGenelogy(Request $request)
    {
        $request->validate([
            'searchid' => 'required'
        ]);
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        $searchid = $request->post('searchid');
        $result['data'] = MemberDetail::where('memberid', $searchid)->first();
        if (!$result['data']) {
            session()->flash('searchMsg', 'This memberid is not registered with ACSWAY Group');
            return redirect()->to('member/team/binary-tree');
        }

        if ($memberid == $searchid) {
            session()->flash('searchMsg', 'You have entered your own memberid');
            return redirect()->to('member/team/binary-tree');
        }

        $leftid = $result['data']['left_id'];
        $rightid = $result['data']['right_id'];
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


    public function ViewGeneology($id)
    {

        $result['data'] = MemberDetail::find($id);
        $leftid = $result['data']['left_id'];
        $rightid = $result['data']['right_id'];
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

        return view('member.team.view-binary-tree')->with($result);
    }

    public function memforgetPassword()
    {
        return view('member.forget-password');
    }

    public function memretrivePassword(Request $request)
    {
        $memberid = $request->post('memberid');

        $data = MemberDetail::where('memberid', $memberid)->first();
        if ($data) {
            $name = $data['name'];
            $email = $data['email'];
            $memberid = $data['memberid'];
            $password = rand(100000, 999999);
            $data->password = Hash::make($password);
            $data->save();

            if ($email != '') {
                $mailData = [
                    'name' => $name,
                    'email' => $email,
                    'memberid' => $memberid,
                    'password' => $password
                ];
                $user['to'] = $email;
                Mail::send('member.mails.forget-password-mail', $mailData, function ($message) use ($user) {

                    $message->to($user['to']);
                    $message->subject('AMBER VEDA Member Login Credentials');
                });
                
                session()->flash('successMsg', 'Your Account Password has been sent to your registered email.');
                return redirect()->back();
            } else {
                session()->flash('failedMsg', 'This memberid does not have an email.');
                return redirect()->back();
            }
           
        } else {
            session()->flash('failedMsg', 'Entered memberid is not registered with us!');
            return redirect()->back();
        }
    }

    public function walletAddress()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        return view('member.profile.wallet-address')->with($result);
    }

    public function insertWalletAddress(Request $request)
    {
        $request->validate([
            // 'walletaddress_otp' => 'required',
            'wallet_address' => 'required',
            'txn_password' => 'required'
        ]);

        $id = $request->post('id');
        $txn_password = $request->post('txn_password');
        $var = MemberDetail::find($id);
        if ($var->wallet_address != NULL) {
            session()->flash('failedMsg', 'Wallet Address can not be change');
            return redirect()->back();
        }
        if (!Hash::check($txn_password, $var->txn_password)) {
            session()->flash('failedMsg', 'Enter Transaction password do not match. Please check and try again');
            return redirect()->back();
        }

        // $fill_otp = $request->post('walletaddress_otp');
        // $session_otp = session()->get('walletaddress_otp');
        // if ($fill_otp != $session_otp) {
        //     session()->flash('failedMsg', 'Entered OTP donot match.Please check and try again');
        //     return redirect()->back();
        // }
        $var->wallet_address = $request->post('wallet_address');
        $var->kyc_status = 'Submitted';
        $var->save();

        session()->flash('successMsg', 'Wallet Address have been inserted successfully!');
        return redirect()->back();
    }

    public function franRegis()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        $memberid = $result['data']['memberid'];
        // $result['countries'] = Country::all();
        return view('member.franchise.registration-kyc')->with($result);
    }

    public function franRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'whatsapp_no' => 'required',
            'mobile' => 'required|min:10|max:10',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required|integer',
            'wallet_address' => 'required',
            'qr_code' => 'required'
        ]);

        $id = $request->post('id');

        $var = MemberDetail::find($id);
        $var->name = $request->post('name');
        $var->whatsapp_no = $request->post('whatsapp_no');
        $var->mobile = $request->post('mobile');
        $var->address = $request->post('address');
        $var->city = $request->post('city');
        $var->state = $request->post('state');
        $var->pin_code = $request->post('pin_code');
        $var->wallet_address = $request->post('wallet_address');
        $var->qr_code = $request->post('qr_code');
        $var->save();

        session()->flash('successMsg', 'Congratulations!  You are now franchise member');
        return redirect()->back();
    }

    // public function franKyc(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'adhar_no' => 'required|min:12|max:12',
    //         'pan_no' => 'required|min:10|max:10',
    //         'pan_image' => 'required',
    //         'front_image' => 'required',
    //         'back_image' => 'required',
    //     ]);

    //     $id = $request->post('id');
    //     $adhar_no = $request->post('adhar_no');
    //     $pan_no = $request->post('pan_no');

    //     $aadhar_check = MemberDetail::where('adhar_no', $adhar_no)->first();
    //     if ($aadhar_check) {
    //         session()->flash('failedMsg', 'Aadhar No is already registered. Please change Aadhar No');
    //         return redirect()->back();
    //     }

    //     $pan_check = MemberDetail::where('pan_no', $pan_no)->count();
    //     if ($pan_check >= 3) {
    //         session()->flash('failedMsg', 'PAN No is already registered. Please change PAN No');
    //         return redirect()->back();
    //     }
    //     $var = MemberDetail::find($id);
    //     $var->name = $request->post('name');
    //     $var->email = $request->post('email');
    //     $var->adhar_no = $request->post('adhar_no');
    //     $var->pan_no = $request->post('pan_no');
    //     if ($request->hasfile('pan_image')) {
    //         $file = $request->file('pan_image');
    //         $ext = $file->getClientOriginalExtension();
    //         if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
    //             session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
    //             return redirect()->back();
    //         }
    //         $filename = time() . '.' . $ext;
    //         $file->move(public_path('uploads'), $filename);
    //         $var->pan_image = $filename;
    //     }
    //     if ($request->hasfile('front_image')) {
    //         $file = $request->file('front_image');
    //         $ext = $file->getClientOriginalExtension();
    //         if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
    //             session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
    //             return redirect()->back();
    //         }
    //         $filename = time() . '.' . $ext;
    //         $file->move(public_path('uploads'), $filename);
    //         $var->front_image = $filename;
    //     }
    //     if ($request->hasfile('back_image')) {
    //         $file = $request->file('back_image');
    //         $ext = $file->getClientOriginalExtension();
    //         if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
    //             session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
    //             return redirect()->back();
    //         }
    //         $filename = time() . '.' . $ext;
    //         $file->move(public_path('uploads'), $filename);
    //         $var->back_image = $filename;
    //     }
    //     $var->save();

    //     session()->flash('kycMsg', 'KYC Details have been updated successfully!');
    //     return redirect()->back();
    // }

    public function memberKYC()
    {
        $result['data'] = MemberDetail::find(session('MEMBER_ID'));
        return view('member.profile.kyc')->with($result);
    }

    public function memKyc(Request $request)
    {
        $request->validate([
            'bank' => 'required',
            'holder' => 'required',
            'ifsc' => 'required',
            'account_no' => 'required|numeric',
            // 'name' => 'required',
            // 'email' => 'required',
            'adhar_no' => 'required|min:12|max:12',
            'pan_no' => 'required|min:10|max:10',
            'nominee_name' => 'required',
            'nominee_relation' => 'required',
            'nominee_no' => 'required|min:10|max:10',
            'pan_image' => 'required',
            'front_image' => 'required',
            'back_image' => 'required',
            // 'wallet_address' => 'required',
            // 'qr_code' => 'required'
        ]);

        $id = $request->post('id');
        $adhar_no = $request->post('adhar_no');
        $pan_no = $request->post('pan_no');
        // $wallet_address = $request->post('wallet_address');

        // $aadhar_check = MemberDetail::where('adhar_no', $adhar_no)->first();
        // if ($aadhar_check) {
        //     session()->flash('failedMsg', 'Aadhar No is already registered. Please change Aadhar No');
        //     return redirect()->back();
        // }

        // $pan_check = MemberDetail::where('pan_no', $pan_no)->count();
        // if ($pan_check >= 3) {
        //     session()->flash('failedMsg', 'PAN No is already registered. Please change PAN No');
        //     return redirect()->back();
        // }

        // $walletAddress = MemberDetail::where('wallet_address', $wallet_address)->count();
        // if ($walletAddress) {
        //     session()->flash('failedMsg', 'Wallet address is already registered. Please change Wallet address');
        //     return redirect()->back();
        // }

        $var = MemberDetail::find($id);
        $var->bank = $request->post('bank');
        $var->holder = $request->post('holder');
        $var->ifsc = $request->post('ifsc');
        $var->account_no = $request->post('account_no');
        // $var->name = $request->post('name');
        // $var->email = $request->post('email');
        $var->adhar_no = $request->post('adhar_no');
        $var->pan_no = $request->post('pan_no');
        $var->nominee_name = $request->post('nominee_name');
        $var->nominee_relation = $request->post('nominee_relation');
        $var->nominee_no = $request->post('nominee_no');
        // $var->wallet_address = $request->post('wallet_address');
        // if ($request->hasfile('qr_code')) {
        //     $file = $request->file('qr_code');
        //     $ext = $file->getClientOriginalExtension();
        //     if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
        //         session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
        //         return redirect()->back();
        //     }
        //     $filename = time() . '.' . $ext;
        //     $file->move(public_path('uploads'), $filename);
        //     $var->qr_code = $filename;
        // }
        if ($request->hasfile('pan_image')) {
            $file = $request->file('pan_image');
            $ext = $file->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $filename = "P". time() . '.' . $ext;
            $file->move(public_path('uploads'), $filename);
            $var->pan_image = $filename;
        }
        if ($request->hasfile('front_image')) {
            $file = $request->file('front_image');
            $ext = $file->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $filename = "F". time() . '.' . $ext;
            $file->move(public_path('uploads'), $filename);
            $var->front_image = $filename;
        }
        if ($request->hasfile('back_image')) {
            $file = $request->file('back_image');
            $ext = $file->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $filename = "B". time() . '.' . $ext;
            $file->move(public_path('uploads'), $filename);
            $var->back_image = $filename;
        }
        if ($request->hasfile('cheque_image')) {
            $file = $request->file('cheque_image');
            $ext = $file->getClientOriginalExtension();
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg') {
                session()->flash('failedMsg', 'This file type is not allowed. Image must be jpg, jpeg or png!');
                return redirect()->back();
            }
            $filename = "C". time() . '.' . $ext;
            $file->move(public_path('uploads'), $filename);
            $var->cheque_image = $filename;
        }
        $var->kyc_status = 'Submitted';
        $var->save();

        session()->flash('kycMsg', 'KYC Details have been submitted successfully!');
        return redirect()->back();
    }

    /**
     * Document list configuration for Member Panel Downloads
     */
    private function getDownloadDocumentsList()
    {
        return [
            [
                'id' => 1,
                'order' => 1,
                'slug' => 'business-plan',
                'title' => 'BUSINESS PLAN',
                'description' => 'Comprehensive Amberveda Wellness business plan, compensation structure, and company profile.',
                'file_name' => 'business-plan.pdf',
                'download_name' => 'BUSINESS-PLAN-AMBERVEDA.pdf',
                'file_type' => 'PDF',
                'icon' => 'mdi-file-pdf-box',
                'icon_color' => '#dc2626',
                'badge_color' => '#fef2f2',
            ],
            [
                'id' => 2,
                'order' => 2,
                'slug' => 'direct-seller-contract',
                'title' => 'DIRECT SELLER CONTRACT',
                'description' => 'Official Direct Seller E-Contract Agreement governing direct seller terms and compliance.',
                'file_name' => 'direct-seller-contract.pdf',
                'download_name' => 'Direct-Seller-Contract-Agreement.pdf',
                'file_type' => 'PDF',
                'icon' => 'mdi-file-document-outline',
                'icon_color' => '#2563eb',
                'badge_color' => '#eff6ff',
            ],
            [
                'id' => 3,
                'order' => 3,
                'slug' => 'product-brochure',
                'title' => 'PRODUCT BROCHURE',
                'description' => 'Complete catalog and product overview highlighting high-rated Ayurvedic wellness formulations.',
                'file_name' => 'product-brochure.pdf',
                'download_name' => 'Amberveda-Product-Brochure.pdf',
                'file_type' => 'PDF',
                'icon' => 'mdi-book-open-page-variant',
                'icon_color' => '#059669',
                'badge_color' => '#f0fdf4',
            ],
            [
                'id' => 4,
                'order' => 4,
                'slug' => 'order-form-consumer',
                'title' => 'ORDER FORM CONSUMER',
                'description' => 'Standard retail consumer purchase order form for direct product ordering.',
                'file_name' => 'order-form-consumer.pdf',
                'download_name' => 'Purchase-Order-Form-By-Consumer.pdf',
                'file_type' => 'PDF',
                'icon' => 'mdi-file-table-outline',
                'icon_color' => '#d97706',
                'badge_color' => '#fffbeb',
            ],
            [
                'id' => 5,
                'order' => 5,
                'slug' => 'order-form-direct-seller',
                'title' => 'ORDER FORM DIRECT SELLER',
                'description' => 'Official direct seller replenishment and distribution product order form.',
                'file_name' => 'order-form-direct-seller.pdf',
                'download_name' => 'Purchase-Order-Form-Direct-Seller.pdf',
                'file_type' => 'PDF',
                'icon' => 'mdi-clipboard-text-outline',
                'icon_color' => '#7c3aed',
                'badge_color' => '#f5f3ff',
            ],
            [
                'id' => 6,
                'order' => 6,
                'slug' => 'price-list-with-sp',
                'title' => 'PRICE LIST WITH SP',
                'description' => 'Official price schedule detailing MRP, DP, SP value, and GST breakdown for all products.',
                'file_name' => 'price-list-with-sp.pdf',
                'download_name' => 'Price-List-With-SP.pdf',
                'file_type' => 'PDF',
                'icon' => 'mdi-tag-text-outline',
                'icon_color' => '#0d9488',
                'badge_color' => '#f0fdfa',
            ],
            [
                'id' => 7,
                'order' => 7,
                'slug' => 'any-other-product-leaflet-if-any',
                'title' => 'ANY OTHER PRODUCT LEAFLET IF ANY',
                'description' => 'Supplementary marketing leaflets, product monographs, and promotional literature.',
                'file_name' => null,
                'download_name' => null,
                'file_type' => 'PDF',
                'icon' => 'mdi-file-multiple-outline',
                'icon_color' => '#475569',
                'badge_color' => '#f8fafc',
            ],
        ];
    }

    /**
     * Display Opportunity page in Member Panel
     */
    public function opportunity(Request $request)
    {
        $data = MemberDetail::find(session('MEMBER_ID'));

        // English Business Plan check
        $enFileName = 'business-plan.pdf';
        $enPath = public_path('uploads/documents/downloads/' . $enFileName);
        $enAvailable = file_exists($enPath);
        $enSize = null;
        if ($enAvailable) {
            $bytes = filesize($enPath);
            $enSize = $bytes >= 1048576 ? number_format($bytes / 1048576, 1) . ' MB' : ($bytes >= 1024 ? number_format($bytes / 1024, 0) . ' KB' : $bytes . ' B');
        }

        // Hindi Business Plan check
        $hiFiles = ['business-plan-hindi.pdf', 'business-plan-hi.pdf', 'Amberveda-Business-Plan-Hindi.pdf'];
        $hiFileName = null;
        $hiAvailable = false;
        $hiSize = null;
        foreach ($hiFiles as $hf) {
            $hp = public_path('uploads/documents/downloads/' . $hf);
            if (file_exists($hp)) {
                $hiFileName = $hf;
                $hiAvailable = true;
                $bytes = filesize($hp);
                $hiSize = $bytes >= 1048576 ? number_format($bytes / 1048576, 1) . ' MB' : ($bytes >= 1024 ? number_format($bytes / 1024, 0) . ' KB' : $bytes . ' B');
                break;
            }
        }

        $opportunity = [
            'en' => [
                'title' => 'English Business Plan',
                'file_name' => $enFileName,
                'is_available' => $enAvailable,
                'file_size' => $enSize,
                'view_url' => $enAvailable ? route('member.viewDocument', 'business-plan') : '#',
            ],
            'hi' => [
                'title' => 'Hindi Business Plan',
                'file_name' => $hiFileName,
                'is_available' => $hiAvailable,
                'file_size' => $hiSize,
                'view_url' => $hiAvailable ? route('member.viewDocument', 'business-plan-hindi') : '#',
            ],
        ];

        return view('member.opportunity', compact('data', 'opportunity'));
    }

    /**
     * Display Downloads Document page in Member Panel
     */
    public function downloadsDocument(Request $request)
    {
        $data = MemberDetail::find(session('MEMBER_ID'));
        $rawDocs = $this->getDownloadDocumentsList();
        $documents = [];

        foreach ($rawDocs as $doc) {
            $isUploaded = false;
            $fileSize = null;
            if (!empty($doc['file_name'])) {
                $filePath = public_path('uploads/documents/downloads/' . $doc['file_name']);
                if (file_exists($filePath)) {
                    $isUploaded = true;
                    $bytes = filesize($filePath);
                    if ($bytes >= 1048576) {
                        $fileSize = number_format($bytes / 1048576, 1) . ' MB';
                    } elseif ($bytes >= 1024) {
                        $fileSize = number_format($bytes / 1024, 0) . ' KB';
                    } else {
                        $fileSize = $bytes . ' B';
                    }
                }
            }
            $doc['is_uploaded'] =  $isUploaded;
            $doc['file_size'] = $fileSize;
            $documents[] = $doc;
        }

        return view('member.downloads-document', compact('data', 'documents'));
    }

    /**
     * View document inline in browser tab
     */
    public function viewDocument($slug)
    {
        // Special alias check for Opportunity Hindi Business Plan
        if ($slug === 'business-plan-hindi' || $slug === 'business-plan-hi') {
            $hiFiles = ['business-plan-hindi.pdf', 'business-plan-hi.pdf', 'Amberveda-Business-Plan-Hindi.pdf'];
            $targetFile = null;
            foreach ($hiFiles as $hf) {
                if (file_exists(public_path('uploads/documents/downloads/' . $hf))) {
                    $targetFile = $hf;
                    break;
                }
            }

            if (!$targetFile) {
                session()->flash('failedMsg', 'Hindi Business Plan document has not been uploaded yet.');
                return redirect()->back();
            }

            $filePath = public_path('uploads/documents/downloads/' . $targetFile);
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="Amberveda-Business-Plan-Hindi.pdf"',
            ];
            return response()->file($filePath, $headers);
        }

        $docs = $this->getDownloadDocumentsList();
        $target = null;
        foreach ($docs as $doc) {
            if ($doc['slug'] === $slug) {
                $target = $doc;
                break;
            }
        }

        if (!$target || empty($target['file_name'])) {
            session()->flash('failedMsg', 'This document has not been uploaded yet.');
            return redirect()->back();
        }

        $filePath = public_path('uploads/documents/downloads/' . $target['file_name']);
        if (!file_exists($filePath)) {
            session()->flash('failedMsg', 'Document file was not found on the server.');
            return redirect()->back();
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mime = 'application/pdf';
        if ($extension === 'docx') {
            $mime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        } elseif ($extension === 'doc') {
            $mime = 'application/msword';
        }

        $headers = [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . ($target['download_name'] ?? $target['file_name']) . '"',
        ];

        return response()->file($filePath, $headers);
    }

    /**
     * Download original document file preserving filename
     */
    public function downloadDocument($slug)
    {
        $docs = $this->getDownloadDocumentsList();
        $target = null;
        foreach ($docs as $doc) {
            if ($doc['slug'] === $slug) {
                $target = $doc;
                break;
            }
        }

        if (!$target || empty($target['file_name'])) {
            session()->flash('failedMsg', 'This document has not been uploaded yet.');
            return redirect()->back();
        }

        $filePath = public_path('uploads/documents/downloads/' . $target['file_name']);
        if (!file_exists($filePath)) {
            session()->flash('failedMsg', 'Document file was not found on the server.');
            return redirect()->back();
        }

        return response()->download($filePath, $target['download_name'] ?? $target['file_name']);
    }
}
