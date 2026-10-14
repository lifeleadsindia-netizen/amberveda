<?php


use App\Http\Controllers\ActivationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MemberDetailController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\WithdrawalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index']);
Route::get('/download-app', [MemberDetailController::class, 'downloadApp']);
Route::get('/register/{id}', [FrontendController::class, 'regis']);
Route::get('/aboutus', [FrontendController::class, 'aboutus']);
Route::get('/contactus', [FrontendController::class, 'contactus']);
Route::post('/contact-submit', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/features', [FrontendController::class, 'features']);
Route::get('/privacy-policy', [FrontendController::class, 'privacy']);
Route::get('/terms-condition', [FrontendController::class, 'terms']);
Route::get('/amber_cpanel', [AdminController::class, 'index']);
Route::get('/send-admin-otp', [AdminController::class, 'sendAdminOtp']);
Route::post('adminLogin', [AdminController::class, 'authenticate'])->name('adminLogin');

//forget password
Route::get('/forget-password', [AdminController::class, 'forgetPassword']);
Route::post('/retrivePassword', [AdminController::class, 'retrivePassword'])->name('retrivePassword');

Route::group(['prefix' => 'admin', 'middleware' => 'AdminAuth'], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::get('/member-details', [AdminController::class, 'details']);
    Route::get('/logout', [AdminController::class, 'logout']);


    //POST ROUTES
    Route::post('/dashMsgAdmin', [AdminController::class, 'dashMsgAdmin'])->name('dashMsgAdmin');
    Route::post('/changePassword', [AdminController::class, 'change'])->name('changePassword');
    Route::post('/changeEmail', [AdminController::class, 'changeEmail'])->name('changeEmail');
    Route::post('/updateWallet', [AdminController::class, 'updateWallet'])->name('updateWallet');
    Route::post('/acheivImage', [AdminController::class, 'acheivImage'])->name('acheivImage');

    //Free Pin Activation
    Route::get('/free-pin-account', [AdminController::class, 'freePinAccount']);
    Route::post('/PinUserAccount', [AdminController::class, 'PinUserAccount'])->name('PinUserAccount');
    
     // franchise 
    // Route::get('/create-franchise', [AdminController::class, 'createFranchise']);
    // Route::post('/create-franchise', [AdminController::class, 'storeFranchise'])->name('storeFranchise');
    // Route::get('/franchise-details', [AdminController::class, 'franchiseDetail']);
    // Route::get('franchise/inventory-details/{franchise_id}', [AdminController::class, 'franchiseInventory']);
    // Route::get('/franchise-login/{id}', [AdminController::class, 'franchiseLogin']);
    
    // Cities Routes
    
    // Route::get('/create-cities', [AdminController::class, 'createCities']);
    // Route::post('/create-cities', [AdminController::class, 'storeCity'])->name('storeCity');

    // Member KYC Management
    Route::get('/new-kyc-requests', [AdminController::class, 'kycRequests']);
    Route::get('/verified-kyc-requests', [AdminController::class, 'verifiedKyc']);
    Route::post('updateKYC', [AdminController::class, 'updateKYC'])->name('updateKYC');
    Route::post('updatePan', [AdminController::class, 'updatePan'])->name('updatePan');
    Route::post('updateAfront', [AdminController::class, 'updateAfront'])->name('updateAfront');
    Route::post('updateAback', [AdminController::class, 'updateAback'])->name('updateAback');
    Route::post('updateCheque', [AdminController::class, 'updateCheque'])->name('updateCheque');
    
     // franchise kyc 
    // Route::get('/franchise-new-kyc-requests', [AdminController::class, 'newKycRequests']);
    // Route::get('/franchise/KYC/view/{id}', [AdminController::class, 'franchiseKycView']);
    // Route::get('/franchise/kyc/verify/{id}', [AdminController::class, 'franchisekycVerify']);
    // Route::get('/franchise/kyc/reject/{id}', [AdminController::class, 'franchisekycReject']);
    // Route::get('/franchise/verified-kyc-requests', [AdminController::class, 'franchiseverifiedKyc']);

    Route::post('franchiseupdatePan', [AdminController::class, 'franchiseupdatePan'])->name('franchiseupdatePan');
    Route::post('franchiseupdateKYC', [AdminController::class, 'franchiseupdateKYC'])->name('franchiseupdateKYC');
    Route::post('/franchiseupdateAfront', [AdminController::class, 'franchiseupdateAfront'])->name('franchiseupdateAfront');
    Route::post('/franchiseupdateAback', [AdminController::class, 'franchiseupdateAback'])->name('franchiseupdateAback');
    Route::post('franchiseupdateCheque', [AdminController::class, 'franchiseupdateCheque'])->name('franchiseupdateCheque');


    //Payment Management
    Route::get('/create-payouts', [WithdrawalController::class, 'createPayouts']);
    Route::get('/create-member-payouts', [WithdrawalController::class, 'createMemPayouts']);
    Route::get('/pending-commission-list', [AdminController::class, 'withdrawals']);
    Route::get('/cancelled-list', [AdminController::class, 'cancelledRequest']);
    Route::get('/paid-commission-list', [AdminController::class, 'withdrawlHistory']);
    Route::get('/release-payment/{id}', [AdminController::class, 'releasePay']);
    Route::post('wAccept', [AdminController::class, 'wAccept'])->name('wAccept');
    Route::post('wCancel', [AdminController::class, 'wCancel'])->name('wCancel');
    
    Route::get('/gst-report', [AdminController::class, 'gstReport']);
    Route::get('/tds-report', [AdminController::class, 'tdsReport']);

    // deposit details
    Route::get('/deposit-details', [AdminController::class, 'depDetails']);
    Route::get('/deposit-status/{id}', [AdminController::class, 'depositStatus']);
    Route::post('/depositDataInr', [AdminController::class, 'depositDataInr'])->name('depositDataInr');
    Route::post('/depositDataUSDT', [AdminController::class, 'depositDataUSDT'])->name('depositDataUSDT');

     // Income Section
    Route::get('/income/travel-fund-inc', [AdminController::class, 'travelFundInc']);
    Route::get('/travel/accept-travel/{id}', [AdminController::class, 'travelInc']);
    // Route::get('/income/level-inc', [AdminController::class, 'levelIncome']);
    Route::get('/income/club-inc', [AdminController::class, 'clubIncome']);
    Route::get('/income/binary-matching-inc', [AdminController::class, 'binaryMatchingIncome']);
    Route::get('/income/sales-bonus-inc', [AdminController::class, 'salesBonusInc']);
    Route::get('/assured-bonus/achieved-members', [AdminController::class, 'achievedMem']);
    Route::get('/assured-bonus/pay-amount', [AdminController::class, 'payAssuredBonus']);
    Route::post('/paidAssuredBonus', [AdminController::class, 'paidAssuredBonus'])->name('paidAssuredBonus');
    Route::get('/assured-bonus/rank-assured-bonus', [AdminController::class, 'rankAssuredBonus']);

    //Product Management//
    Route::get('/category-creation', [ProductController::class, 'category']);
    Route::post('/createCat', [ProductController::class, 'createCat'])->name('createCat');

    Route::get('/create-product', [ProductController::class, 'createProduct']);
    Route::post('/productInsert', [ProductController::class, 'productInsert'])->name('productInsert');
    Route::get('/all-products', [ProductController::class, 'products']);
    Route::get('/update-products/{sid}', [ProductController::class, 'updateProduct']);
    Route::post('/editProduct', [ProductController::class, 'editProduct'])->name('editProduct');
    Route::get('/issue-inventory/{sid}', [ProductController::class, 'issueInventory']);
    Route::post('/issue-inventory-store', [ProductController::class, 'issueInventoryStore'])->name('issueInventoryStore');

    // Dispatch Order
    Route::get('/dispatch-order', [ProductController::class, 'dispatchOrder']);
    Route::get('/dispatch-order-form/{id}', [ProductController::class, 'dispatchOrderForm']);
    Route::post('/dispatchOrderP', [ProductController::class, 'dispatchOrderP'])->name('dispatchOrderP');
    Route::get('/dispatch-order-dis', [ProductController::class, 'dispatchOrderDis']);

    //orders management
    Route::get('/all-orders', [ProductController::class, 'allOrders']);
    // Route::get('/undelivered-orders', [ProductController::class, 'undeliveredOrders']);
    // Route::get('/delivered-orders', [ProductController::class, 'completedOrders']);
    Route::get('/order/address/{id}', [ProductController::class, 'orderAddress']);
    Route::get('/complete-orders/{id}', [ProductController::class, 'completeOrders']);
    
    // Route::get('/pending-orders', [ProductController::class, 'pendingOrders']);
    Route::get('/add-franchise/{sid}', [ProductController::class, 'addFranchise']);
    Route::post('/add-franchise-store', [ProductController::class, 'addFranchiseStore'])->name('addFranchiseStore');

    Route::post('/updateAfront', [AdminController::class, 'updateAfront'])->name('updateAfront');
    Route::post('/updateAback', [AdminController::class, 'updateAback'])->name('updateAback');
    Route::post('/updatePassImage', [AdminController::class, 'updatePassImage'])->name('updatePassImage');
    Route::post('updateKYC', [AdminController::class, 'updateKYC'])->name('updateKYC');
    Route::post('updatePan', [AdminController::class, 'updatePan'])->name('updatePan');
    Route::get('/KYC/view/{id}', [AdminController::class, 'kycView']);
    Route::get('/kyc/verify/{id}', [AdminController::class, 'kycVerify']);
    Route::get('/kyc/reject/{id}', [AdminController::class, 'kycReject']);
    // dashboard message section
    Route::get('/dash-messages', [AdminController::class, 'dashMessages']);
    Route::get('/dash-messages/delete/{id}', [AdminController::class, 'dashMsgDelete']);
    //ROI Routes
    Route::get('/set-selling-point', [AdminController::class, 'setSellingPoint']);
    Route::get('/user-data', [AdminController::class, 'fakeData']);
    Route::post('/sellingPointUpdate', [AdminController::class, 'sellingPointUpdate'])->name('sellingPointUpdate');
    Route::post('/userDataUpdate', [AdminController::class, 'userDataUpdate'])->name('userDataUpdate');

    //wallet address update
    Route::get('/wallet-address', [AdminController::class, 'walletAddress']);

    Route::get('/funds/add-funds', [AdminController::class, 'addFunds']);
    Route::get('/funds/deduct-funds', [AdminController::class, 'deductFunds']);
    Route::post('addMemFunds', [AdminController::class, 'addMemFunds'])->name('addMemFunds');
    Route::post('deductMemFunds', [AdminController::class, 'deductMemFunds'])->name('deductMemFunds');
    Route::get('/funds/add-funds-details', [AdminController::class, 'addFundsDetails']);
    Route::get('/activation/activation-requests', [AdminController::class, 'actRequest']);
    Route::get('/accept-fundrequest/{id}', [FundController::class, 'acceptReq']);
    Route::get('/reject-fundrequest/{id}', [FundController::class, 'rejectReq']);
    Route::get('/request-history', [AdminController::class, 'fundsHistory']);
    Route::get('/fund-requests', [AdminController::class, 'fundRequests']);

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::get('/member-details', [AdminController::class, 'details']);
    // Route::post('/getMember', [MemberDetailController::class, 'getMember']);
    //member account control update
    Route::get('/account-control', [AdminController::class, 'accountControl']);
    Route::get('/account-control/{id}', [AdminController::class, 'statusChange']);

    // Links Order
    Route::get('/order-requests', [AdminController::class, 'orderRequest']);
    Route::get('/order-request-history', [AdminController::class, 'orderRequestHistory']);
    Route::get('/accept-order-request/{id}', [LinkController::class, 'acceptOrderReq']);
    Route::get('/reject-order-request/{id}', [LinkController::class, 'rejectOrderReq']);


    //Account Upgrde
    Route::get('/upgrade-member', [AdminController::class, 'upgradeMember']);
    Route::post('/upgradeMember', [AdminController::class, 'memberUpgrade'])->name('upgradeMember');

    //member security update
    Route::get('/member-security', [AdminController::class, 'security']);
    Route::post('securityUpdate', [AdminController::class, 'securityUpdate'])->name('securityUpdate');
    //member details update
    Route::get('/members/member-update/{id}', [AdminController::class, 'memberUpdate']);
    Route::post('/updateDetails', [AdminController::class, 'updateDetails'])->name('updateDetails');
    Route::get('/member-details', [AdminController::class, 'details']);
    Route::get('/member-login/{id}', [AdminController::class, 'memberLogin']);
    //wallet address update
    Route::get('/wallet-address', [AdminController::class, 'walletAddress']);

    // Route::get('/payment-history', [AdminController::class, 'paymentHistory']);

    // Route::get('/double/double-incomes', [DoubleController::class, 'doubleIncomeData']);
    // Route::get('/income/direct-incomes', [AdminController::class, 'directIncomes']);
    // Route::get('/income/royalty-incomes', [AdminController::class, 'royaltyIncomes']);
    // Route::get('/package-details', [AdminController::class, 'packageDetails']);

    // Route::get('/binary/house-bonus', [AdminController::class, 'houseBonus']);
    // Route::get('/binary/leadership-bonus', [AdminController::class, 'leadershipBonus']);
    Route::get('/income/upgrade-bonus', [AdminController::class, 'upgradeBonus']);
    Route::get('/income/pairing-bonus', [AdminController::class, 'pairingBonus']);
    Route::get('/income/sponsor-bonus', [AdminController::class, 'sponsorBonus']);
    Route::get('/income/binary-bonus', [AdminController::class, 'binaryBonus']);
    Route::get('/income/keyin-bonus', [AdminController::class, 'keyinBonus']);
    Route::get('/income/ranking-reward', [AdminController::class, 'rankingReward']);
    

    //level details & Update
    Route::get('/level-details', [AdminController::class, 'levelDetails']);
    Route::get('/edit-level-data/{id}', [AdminController::class, 'editLevelData']);
    Route::post('/levelUpdateDetails', [AdminController::class, 'levelUpdateDetails'])->name('levelUpdateDetails');

    //link product
    Route::get('/link-product', [ProductController::class, 'linkProduct']);
    Route::get('/edit-link-product/{id}', [ProductController::class, 'editLinkPro']);
    Route::get('/product-status/{id}', [ProductController::class, 'productStatus']);
    Route::post('/createLink', [ProductController::class, 'createLink'])->name('createLink');
    Route::post('/updateLinkProduct', [ProductController::class, 'updateLinkProduct'])->name('updateLinkProduct');

    //admin management
    // Route::get('/create-new-admin', [AdminController::class, 'createNewAdmin']);
    Route::get('/edit-admin-details/{id}', [AdminController::class, 'editAdminDetails']);
    Route::post('/createAdmin', [AdminController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/updateAdminDetails', [AdminController::class, 'updateAdminDetails'])->name('updateAdminDetails');

    //Reward Section
    Route::get('/income/reward-inc', [AdminController::class, 'rewardIncomes']);
    Route::get('/reward/accept-reward/{id}', [AdminController::class, 'acceptReward']);

    // sales bonus inc 
    Route::get('/income/sales-bonus-inc', [AdminController::class, 'salesBonusInc']);
    
    Route::get('/reward/paid-rewards', [AdminController::class, 'totalrewardIncomes']);

    //support ticket sections
    Route::get('/support/new-support-ticket', [SupportController::class, 'newSupport']);
    Route::get('/support/open-support-ticket', [SupportController::class, 'openSupport']);
    Route::get('/support/close-support-ticket', [SupportController::class, 'closeSupport']);
    Route::get('/support/view-support-ticket/{id}', [SupportController::class, 'viewSupport']);
    Route::get('/support/view-closed-ticket/{id}', [SupportController::class, 'viewClosed']);
    Route::get('/closed-ticket/{id}', [SupportController::class, 'closedTicket']);
    Route::post('/Ticket', [SupportController::class, 'Ticket'])->name('Ticket');
});

Route::post('/getBrand', [ProductController::class, 'getBrand']);
Route::post('/getProduct', [ProductController::class, 'getProduct']);
Route::post('/addToCart', [ProductController::class, 'addToCart']);
Route::post('/updateCartQuantity', [ProductController::class, 'updateCartQuantity']);
Route::post('/getCart', [ProductController::class, 'getCart']);
Route::post('/deleteCartItem', [ProductController::class, 'deleteCartItem']);
Route::post('/finalCheckout', [ProductController::class, 'finalCheckout']);
// member routes
Route::get('/member', [MemberDetailController::class, 'index']);
Route::get('/member/register/{id}/{side}', [MemberDetailController::class, 'signup']);
Route::get('/member/account-created', [MemberDetailController::class, 'accountCreated']);
Route::post('/userLogin', [MemberDetailController::class, 'authenticate'])->name('userLogin');
Route::post('/userRegister', [MemberDetailController::class, 'register'])->name('userRegister');
Route::post('/sendDistributorOtp', [MemberDetailController::class, 'sendDistributorOtp'])->name('sendDistributorOtp');
Route::post('/sendRegistrationOtp', [MemberDetailController::class, 'sendRegistrationOtp'])->name('sendRegistrationOtp');
Route::post('/getSponname', [MemberDetailController::class, 'getSponname']);
Route::post('/getMember', [MemberDetailController::class, 'getMember']);
Route::post('/getUserid', [MemberDetailController::class, 'getUserid']);
// Route::get('member/download/business-plan', [MemberDetailController::class, 'downloads']);
Route::get('/member-forget-password', [MemberDetailController::class, 'memforgetPassword']);
Route::post('/memretrivePassword', [MemberDetailController::class, 'memretrivePassword'])->name('memretrivePassword');

Route::group(['prefix' => 'member', 'middleware' => 'MemberAuth'], function () {

    Route::get('/dashboard', [MemberDetailController::class, 'dashboard']);

    // Downloads Document routes
    Route::get('/downloads-document', [MemberDetailController::class, 'downloadsDocument'])->name('member.downloadsDocument');
    Route::get('/downloads-document/view/{slug}', [MemberDetailController::class, 'viewDocument'])->name('member.viewDocument');
    Route::get('/downloads-document/download/{slug}', [MemberDetailController::class, 'downloadDocument'])->name('member.downloadDocument');
    Route::get('/logout', [MemberDetailController::class, 'logout']);
    Route::get('/cheakout-step1', [MemberDetailController::class, 'CheackoutStep1']);
    Route::get('/cheakout-step2', [MemberDetailController::class, 'CheackoutStep2']);
    Route::get('/cheakout-step-final', [MemberDetailController::class, 'CheackoutStepFinal']);


    // profile section
    Route::get('/profile/profile-details', [MemberDetailController::class, 'profileDetails']);
    Route::get('/profile/bank-details', [MemberDetailController::class, 'bankDetails']);
    Route::get('/profile/change-passward', [MemberDetailController::class, 'changePassward']);
    // Route::get('/profile/kyc', [MemberDetailController::class, 'KYC']);
    Route::get('/profile/security', [MemberDetailController::class, 'security']);
    Route::get('/profile/update-nominee', [MemberDetailController::class, 'updateNominee']);
    Route::get('/member-kyc', [MemberDetailController::class, 'memberKYC']);
    Route::post('/memKyc', [MemberDetailController::class, 'memKyc'])->name('memKyc');
    Route::post('updateKyc', [MemberDetailController::class, 'updateKycData'])->name('updateKyc');
    Route::post('insertProfile', [MemberDetailController::class, 'insertPdata'])->name('insertProfile');
    Route::post('passChange', [MemberDetailController::class, 'passChange'])->name('passChange');
    Route::post('txnpassChange', [MemberDetailController::class, 'txnpassChange'])->name('txnpassChange');
    Route::get('/profile/walletAddress', [MemberDetailController::class, 'walletAddress']);
    Route::post('insertWalletAddress', [MemberDetailController::class, 'insertWalletAddress'])->name('insertWalletAddress');


    //Link orders routes
    Route::get('/orders/create-requests', [LinkController::class, 'createRequest']);
    Route::get('/orders/request-details', [LinkController::class, 'requestDetails']);
    Route::post('/linkordrDetails', [LinkController::class, 'linkordrDetails'])->name('linkordrDetails');

    // Club routes
    Route::get('/club/club-income', [ClubController::class, 'clubIncome']);
    Route::get('/club/club-details/{id}', [ClubController::class, 'clubDetails']);
    Route::get('/club/club-members/{pool}', [ClubController::class, 'clubMembers']);
    Route::get('/club/club-assured-bonus', [ClubController::class, 'clubAssuredIncome']);

    // import route
    Route::get('/deposit/fund-requests', [FundController::class, 'fundRequest']);
    Route::get('/deposit/franchise-details', [FundController::class, 'franchiseDetl']);
    Route::get('/deposit/request-history', [FundController::class, 'requestHistory']);
    Route::post('FundReq', [FundController::class, 'FundReq'])->name('FundReq');


    // fund sections
    // Route::get('funds/add-fund/{pid}', [FundController::class, 'addfunds']);
    // Route::get('funds/fund-report', [FundController::class, 'fundReport']);
    // Route::get('funds/fund-transfer', [FundController::class, 'fundTransfer']);
    // Route::post('FundReq', [FundController::class, 'FundReq'])->name('FundReq');

    //Activation Routes
    // Route::get('/activation/activation-status', [ActivationController::class, 'activationStatus']);
    Route::get('/account/activation', [ActivationController::class, 'accountActivation']);
    Route::post('statusAccount', [ActivationController::class, 'statusAccount'])->name('statusAccount');
    Route::get('/account/account-detail', [ActivationController::class, 'acountDetail']);
    Route::get('/account/account-created', [ActivationController::class, 'activationAcountCreated']);
    Route::post('activateUser', [ActivationController::class, 'activateUser'])->name('activateUser');
    Route::get('/account/upgrade-activation', [ActivationController::class, 'activationUpgrade']);
    Route::post('upgradeUser', [ActivationController::class, 'upgradeUser'])->name('upgradeUser');
    Route::get('/account/packages-details', [ActivationController::class, 'packageDetails']);
    Route::get('/account/member-activation', [ActivationController::class, 'memActivation']);
    Route::post('memberActivate', [ActivationController::class, 'memberActivate'])->name('memberActivate');

    // buy product section
    Route::get('/product', [MemberDetailController::class, 'proDuct']);

    // business section
    Route::get('/business', [MemberDetailController::class, 'Business']);

    // withdraw section
    Route::get('/Ceynoniquepay', [WithdrawalController::class, 'Ceynoniquepay']);

    // report section
    Route::get('/income-transactions', [MemberDetailController::class, 'incomeTransactions']);
    Route::get('/partner-transactions', [MemberDetailController::class, 'partnerTransactions']);
    Route::get('/purchase-transactions', [MemberDetailController::class, 'purchaseTransactions']);
    Route::get('/my-order', [MemberDetailController::class, 'myOrder']);
    Route::get('/my-bonus', [MemberDetailController::class, 'myBonus']);
    Route::get('/withdraw', [MemberDetailController::class, 'withDraw']);

    //Product Route
    Route::get('/cart', [ProductController::class, 'myCart']);
    Route::get('/account-activation', [ProductController::class, 'buyProduct']);
    Route::get('/product-details/{id}', [ProductController::class, 'productDetails']);
    Route::get('/view-product/{id}', [ProductController::class, 'viewProduct']);
    Route::get('/order-history', [ProductController::class, 'orderHistory']);
    Route::get('/product/order-details/{id}', [ProductController::class, 'orderDetails']);
    // Route::get('/dispatched-order', [ProductController::class, 'dispatchedOrder']);
    Route::post('/getOrderHistory', [ProductController::class, 'getOrderHistory'])->name('getOrderHistory');
    Route::post('/getDispatchedOrder', [ProductController::class, 'getDispatchedOrder'])->name('getDispatchedOrder');
    Route::get('/checkout', [ProductController::class, 'checkout']);
    Route::get('/print-invoice/{id}', [ProductController::class, 'printInvoice']);

    Route::post('/addToCart', [ProductController::class, 'addToCart'])->name('addToCart');
    Route::post('/updateCartQuantity', [ProductController::class, 'updateCartQuantity']);
    Route::post('/getCart', [ProductController::class, 'getCart']);
    Route::post('/deleteCartItem', [ProductController::class, 'deleteCartItem']);
    Route::post('/finalCheckout', [ProductController::class, 'finalCheckout']);

    Route::post('/getProducts', [LinkController::class, 'getProducts'])->name('getProducts');

    //link product
    Route::get('/buy-link-product/amazon', [ProductController::class, 'linkProductAmazon']);
    Route::get('/buy-link-product/flipkart', [ProductController::class, 'linkProductFlipkart']);

    //jumbo package
    Route::get('/jumbo-package-activation', [ActivationController::class, 'jumboPackActivation']);
    Route::get('/jumbo-member-details', [ActivationController::class, 'jumboPackDetails']);
    Route::get('/jumbomember-login/{id}', [ActivationController::class, 'jumboMemLogin']);
    Route::post('/memberActivation', [ActivationController::class, 'memberActivation'])->name('memberActivation');

    //Direct and geneology
    Route::get('/team/geneology', [LevelsController::class, 'geneology']);
    Route::get('/team/view-geneology/{id}', [LevelsController::class, 'ViewGeneology']);
    Route::post('/searchGenelogy', [LevelsController::class, 'searchGenelogy'])->name('searchGenelogy');
    Route::get('/team/direct-members', [LevelsController::class, 'directMembers']);
    Route::get('/team/level-members-table', [LevelsController::class, 'lelMemTable']);
    Route::get('/team/level-members-details/{levels}', [LevelsController::class, 'lelMemDetails']);

    //wallet section
    // Route::get('/wallet/main-wallet', [WithdrawalController::class, 'mainWallets']);
    Route::get('/wallet/wallet-transfer', [WithdrawalController::class, 'passbook']);
    Route::get('/wallet/withdrawal-history', [WithdrawalController::class, 'withdrlHistory']);
    Route::post('initWithdrawal', [WithdrawalController::class, 'initWithdrawal'])->name('initWithdrawal');
    Route::get('/p2p-transfer', [WithdrawalController::class, 'p2pWalletTransfer']);
    Route::post('transBvWalletToP2P', [WithdrawalController::class, 'transBvWalletToP2P'])->name('transBvWalletToP2P');
    Route::get('/p2p-transfer-hisory', [WithdrawalController::class, 'p2pTransHistory']);

    Route::get('/view-detail/{id}', [WithdrawalController::class, 'viewDetail']);

    //Support Route
    Route::get('/support/create-ticket', [SupportController::class, 'createTick']);
    Route::get('/support/support-tickets', [SupportController::class, 'supportTickets']);
    Route::get('/support/view-support-ticket/{tid}', [SupportController::class, 'ViewsupportTickets']);
    Route::post('/createTicket', [SupportController::class, 'createTicket'])->name('createTicket');
    Route::post('/MbReplyTicket', [SupportController::class, 'MbReplyTicket'])->name('MbReplyTicket');

     // Income Section
    Route::get('/income/travel-fund-income', [IncomeController::class, 'travelIncome']);
    // Route::get('/income/level-income', [IncomeController::class, 'levelIncome']);
    Route::get('/income/sales-bonus-income', [IncomeController::class, 'salesBonusIncome']);
    Route::get('/income/club-income', [IncomeController::class, 'ClubIncome']);
    Route::get('/income/binary-matching-income', [IncomeController::class, 'binaryMatchingIncome']);
    Route::get('/assured-bonus/rank-assured-bonus', [IncomeController::class, 'rankAssuredBonus']);
    Route::get('/assured-bonus/rank-assured-details', [IncomeController::class, 'rankBonusDetails']);
    Route::get('/income/reward-income', [IncomeController::class, 'rewardInc']);
    Route::get('/income/reward-details', [IncomeController::class, 'rewardDetails']);

    //Team Routes
    Route::get('/team/direct-partner', [LevelsController::class, 'directMembers']);
    Route::get('/team/genealogy-tree', [MemberDetailController::class, 'binaryTree']);
});

// member routes
Route::get('/franchise_panel', [FranchiseController::class, 'index']);
Route::post('/franchiseLogin', [FranchiseController::class, 'authenticate'])->name('franchiseLogin');
Route::get('/franchise-forget-password', [FranchiseController::class, 'franchiseForgetPassword']);
Route::post('/franchiseRetrievePassword', [FranchiseController::class, 'franchiseRetrievePassword'])->name('franchiseRetrievePassword');

Route::group(['prefix' => 'franchise_panel', 'middleware' => 'FranchiseAuth'], function () {

    Route::get('/dashboard', [FranchiseController::class, 'dashboard']);
    Route::get('/logout', [FranchiseController::class, 'logout']);
    
    // Inventory Routes
    Route::get('/inventory/current-inventory', [FranchiseController::class, 'currentInventory']);
    Route::get('/inventory/received-inventory', [FranchiseController::class, 'receivedInventory']);
    
    // Profile Routes
    Route::get('/profile/profile-details', [FranchiseController::class, 'profileDetails']);
    Route::post('updateProfile', [FranchiseController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/profile/security', [FranchiseController::class, 'security']);
    Route::post('passwordChange', [FranchiseController::class, 'passwordChange'])->name('passwordChange');
    Route::get('/profile/kyc-verified', [FranchiseController::class, 'kycVerified']);
    Route::post('franchiseKyc', [FranchiseController::class, 'franchiseKyc'])->name('franchiseKyc');
    
    // Order Management
    Route::get('/order/order-details', [FranchiseController::class, 'orderDetails'])->name('franchise.order.details');
    Route::get('/order/completed-orders', [FranchiseController::class, 'deliveredOrders'])->name('franchise.order.delivered');
    Route::get('/order/order-management-details/{id}', [FranchiseController::class, 'orderManagementDetails'])->name('franchise.order.management.details');
    Route::post('/order/update-order-status', [FranchiseController::class, 'updateOrderStatus'])->name('franchise.update.order.status');
    
    //wallet section
    Route::get('/wallet/main-wallet', [FranchiseController::class, 'mainWallets']);
    Route::get('/wallet/wallet-transfer', [FranchiseController::class, 'passbook']);
    Route::get('/wallet/withdrawal-history', [FranchiseController::class, 'withdrlHistory']);
    Route::post('mainWithdrawal', [FranchiseController::class, 'mainWithdrawal'])->name('mainWithdrawal');
    Route::get('/view-detail/{id}', [FranchiseController::class, 'viewDetails']);
    
     // income
    Route::get('/delivery-commission', [FranchiseController::class, 'deliveryCommission']);
    
});

Route::fallback(function () {
    return view('member.error_404');
});

Route::get('/binaryIncomedis', [TempController::class, 'binaryIncomedis']);
Route::get('/salesBonusInc', [TempController::class, 'salesBonusInc']);
Route::get('/updateClub', [TempController::class, 'updateClub']);
Route::get('/rewardsGen', [TempController::class, 'rewardsGen']);
Route::get('/weeklyPayouts', [TempController::class, 'weeklyPayouts']);
Route::get('/travelFund', [TempController::class, 'travelFund']);
Route::get('/clubIncomeDis', [TempController::class, 'clubIncomeDis']);




// Route::get('/temp', function () {
//      getTotalDownline('AGL123456', 1);
// });

// Route::get('/addTempMembers/{sponsorid}', [TempController::class, 'addTempMembers']);
// Route::get('/PaidIncome', [TempController::class, 'PaidIncome']);
