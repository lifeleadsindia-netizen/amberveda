

<!DOCTYPE html>

<html lang="en" data-layout="vertical" data-sidebar="dark" data-bs-theme="light">
<head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /><meta name="description" /><meta name="author" /><link rel="icon" href="..img/favicon.png" /><link href="userassets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <script src="userassets/js/layout.js"></script>
    <link href="userassets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /><link href="userassets/css/icons.min.css" rel="stylesheet" type="text/css" /><link href="userassets/css/app.min.css" rel="stylesheet" type="text/css" /><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" /><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" /><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" /><link href="userassets/css/custom.min.css" rel="stylesheet" type="text/css" /><link href="../css/vanilla-dataTables.min.css" rel="stylesheet" /><link href="userassets/css/custom.css" rel="stylesheet" />
    <style>
        .baseball {
            padding: 6px 0 6px 0;
            border-radius: 0 25px 25px 0;
            background: linear-gradient(to left, #37015f, #9000ff82);
        }

        .base {
            text-align:left !important;
            padding-left: 2px;
            padding-right: 0px;
            padding-top: 1px;
            background-color: white;
            border-radius: 0 25px 25px 0;
            font-size: 14px;
            font-weight: 600;
        }

        .ball {
            text-align:left !important;
            color: white;
            font-size: 14px;
        }
    </style>
    
    <title>evinnkoglobal | Bank Upload</title>
<title>

</title></head>
<body>
    <div id="layout-wrapper">
        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <a href="Default" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="img/favicon.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="img/white.png" alt="" height="56">
                    </span>
                </a>
                <a href="Default" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="img/favicon.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="img/white.png" alt="" height="56">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover shadow-none" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="Default">
                                <i class="ti ti-brand-google-home"></i><span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Profile" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProfile">
                                <i class="bi bi-gear"></i><span data-key="t-layouts">Profile Setting</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Profile">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ProfileSetting" class="nav-link" data-key="t-Profile">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="UpdateNominee" class="nav-link" data-key="t-Nominee">My Partner</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="KYC" class="nav-link" data-key="t-Kyc">Kyc</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="Bank" class="nav-link" data-key="t-Bank">Bank</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ChangePassword" class="nav-link" data-key="t-Change">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Fund" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class="ti ti-users-group"></i><span data-key="t-layouts">Fund</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Fund">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="AddFund" class="nav-link" data-key="t-Report">Add Fund</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="FundReport" class="nav-link" data-key="t-Report">Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="FundTransfer" class="nav-link" data-key="t-Transfer">Fund Transfer</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-title"><i class="ti ti-dots"></i><span data-key="t-Components">Components</span></li>
                        <li class="nav-item">
                            <a href="Product" class="nav-link menu-link"><i class="ti ti-shopping-cart"></i><span data-key="t-Buy">Buy Product</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="Business" class="nav-link menu-link"><i class="ti ti-building-store"></i><span data-key="t-Bussiness">Bussiness</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="Ceynoniquepay" class="nav-link menu-link"><i class="ti ti-wallet"></i><span data-key="t-Withdraw">Withdraw</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebarReport" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReport">
                                <i class="ti ti-file-invoice"></i><span data-key="t-Report">Report</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarReport">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="Order" class="nav-link" data-key="t-Order">My Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="Bonus" class="nav-link" data-key="t-Bonus">My Bonus</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="WithdrawReport" class="nav-link" data-key="t-Withdraw">Withdraw</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="WalletTransactions?w=Income" class="nav-link" data-key="t-Income">Income Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="WalletTransactions?w=Nominee" class="nav-link" data-key="t-Nominee">Partner Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="WalletTransactions?w=Shopping" class="nav-link" data-key="t-Shoping">Purchase Transactions</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#sidebarCommunity" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCommunity">
                                <i class="ti ti-user-circle"></i><span data-key="t-Community">My Group</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarCommunity">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="TeamDirect" class="nav-link" role="button" data-key="t-Myzone">My Direct Partners</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="BinaryTree2" class="nav-link" role="button" data-key="t-Tree">Business Tree</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="GroupA" class="nav-link" role="button" data-key="t-Zone-A">Group A Partners</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="GroupB" class="nav-link" role="button" data-key="t-Zone-B">Group B Partners</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="Notification">
                                <i class="ti ti-bell-ringing"></i><span data-key="t-Notification">Notification</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="/signin">
                                <i class="ti ti-power"></i><span data-key="t-Logout">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay"></div>
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="Default" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="img/favicon.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="img/white.png" alt="" height="56">
                                </span>
                            </a>


                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                        <a href="Default" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="img/logo.png" alt="" height="32" style="margin-top: -5px;">
                            </span>
                        </a>
                        <a href="Default" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="img/white.png" alt="" height="56">
                            </span>
                        </a>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <a type="button" href="ucart" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text">
                                <i class='ti ti-shopping-cart fs-3xl'></i>
                                <span id="CartQty"></span>
                                
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 product-list" aria-labelledby="page-header-cart-dropdown">
                                <div class="p-3 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fs-lg fw-semibold">My Cart</h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!">View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div style="max-height: 300px;">
                                    <div class="p-3">
                                        <div class="text-center empty-cart" id="empty-cart">
                                            <div class="avatar-md mx-auto my-3">
                                                <div class="avatar-title bg-info-subtle text-info fs-2 rounded-circle">
                                                    <i class='bx bx-cart'></i>
                                                </div>
                                            </div>
                                            <h6 class="mb-3">Your Cart is Empty!</h6>
                                            <a href="#!" class="btn btn-success w-md mb-3">Shop Now</a>
                                        </div>

                                        <div class="d-block dropdown-item product text-wrap p-2">
                                            <div class="d-flex">
                                                <div class="avatar-sm me-3 flex-shrink-0">
                                                    <div class="avatar-title bg-light rounded">
                                                        <img src="userassets/images/products/img-1.png" class="avatar-xs" alt="user-pic">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1 fs-sm text-muted">Fashion</p>
                                                    <h6 class="mt-0 mb-3 fs-md">
                                                        <a href="#!" class="text-reset">Blive Printed Men Round Neck</a>
                                                    </h6>
                                                    <div class="text-muted fw-medium d-none">$<span class="product-price">327.49</span></div>
                                                    <div class="input-step">
                                                        <button type="button" class="minus">–</button>
                                                        <input type="number" class="product-quantity" value="2" min="0" max="100" readonly>
                                                        <button type="button" class="plus">+</button>
                                                    </div>
                                                </div>
                                                <div class="ps-2 d-flex flex-column justify-content-between align-items-end">
                                                    <button type="button" class="btn btn-icon btn-sm btn-ghost-primary remove-cart-btn" data-bs-toggle="modal" data-bs-target="#removeCartModal"><i class="ri-close-fill fs-lg"></i></button>
                                                    <h6 class="mb-0">$ <span class="product-line-price">654.98</span></h6>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="count-table">
                                            <table class="table table-borderless mb-0  fw-semibold">
                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total :</td>
                                                        <td class="text-end cart-subtotal">$1306.52</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount <span class="text-muted">(VIXON30)</span>:</td>
                                                        <td class="text-end cart-discount">- $195.98</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td class="text-end cart-shipping">$65.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax (12.5%) : </td>
                                                        <td class="text-end cart-tax">$163.31</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                                    <div class="d-flex justify-content-between align-items-center pb-3">
                                        <h6 class="m-0 text-muted">Total:</h6>
                                        <div class="px-2">
                                            <h6 class="m-0 cart-total">$1338.86</h6>
                                        </div>
                                    </div>
                                    <a href="#!" class="btn btn-info text-center w-100">Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text" data-toggle="fullscreen">
                                <i class='ti ti-arrows-maximize fs-3xl'></i>
                            </button>
                        </div>
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text mode-layout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-sun align-middle fs-3xl"></i>
                            </button>
                            <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                                <a href="#!" class="dropdown-item" data-mode="light"><i class="bi bi-sun align-middle me-2"></i>Default (light mode)</a>
                                <a href="#!" class="dropdown-item" data-mode="dark"><i class="bi bi-moon align-middle me-2"></i>Dark</a>
                                <a href="#!" class="dropdown-item" data-mode="auto"><i class="bi bi-moon-stars align-middle me-2"></i>Auto (system default)</a>
                            </div>
                        </div>


                        <div class="dropdown ms-sm-3 topbar-head-dropdown dropdown-hover-end header-item topbar-user">
                            <button type="button" class="btn shadow-none btn-icon" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="img/user.png">
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Welcome EV542770! </h6>
                                <a class="dropdown-item fs-sm" href="ProfileSetting"><i class="bi bi-person-circle text-muted align-middle me-1"></i><span class="align-middle">Profile</span></a>
                                <a class="dropdown-item fs-sm" href="Order"><i class="bi bi-cart4 text-muted align-middle me-1"></i><span class="align-middle">Order</span></a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item fs-sm" href="/uLogout"><i class="bi bi-box-arrow-right text-muted align-middle me-1"></i><span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="wrapper"></div>
        <div class="main-content">
            
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Bank Upload</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-custom-outline nav-info gap-2 flex-grow-1 mb-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link fs-md active" data-bs-toggle="tab" href="#BankDetails" role="tab" aria-selected="true">Update Bank Info</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link fs-md" data-bs-toggle="tab" href="#BankDetailsView" role="tab" aria-selected="false" tabindex="-1">View Update Bank</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="BankDetails" role="tabpanel">
                                
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Account Number</label>
                                                    <input name="ctl00$main$accountno" type="text" id="main_accountno" class="form-control mb-1" placeholder="Enter Account Number" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Bank Name</label>
                                                    <input name="ctl00$main$bankname" type="text" id="main_bankname" class="form-control mb-1" placeholder="Enter Bank Name" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">IFSC Code</label>
                                                    <input name="ctl00$main$ifsc" type="text" id="main_ifsc" class="form-control mb-1" placeholder="Enter IFSC Code" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Branch Name</label>
                                                    <input name="ctl00$main$Branch" type="text" id="main_Branch" class="form-control mb-1" placeholder="Enter Branch Name" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary" id="bbtn1" onclick="changeaccount()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="BankDetailsView" role="tabpanel">
                                
                                <div class="card-body">
                                    <div>
                                        <div class="row g-2 justify-content-lg-between align-items-center">
                                            <div class="table-responsive">
                                                <table class="table table-bordered caption-top">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Bank Name</b></td>
                                                            <td id="main_mbankname">Sarva Haryana Gramin Bank</td>

                                                        </tr>
                                                        <tr>
                                                            <td><b>Account Number</b></td>
                                                            <td id="main_maccountno">80150100115730</td>

                                                        </tr>
                                                        <tr>
                                                            <td><b>IFSC Code</b></td>
                                                            <td id="main_mifsccode">PUNB0HGB001</td>

                                                        </tr>
                                                        <tr>
                                                            <td><b>Branch Name</b></td>
                                                            <td id="main_mBranch">Bawani khera</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



        </div>
    </div>
    <button class="btn btn-dark btn-icon" id="back-to-top">
        <i class="bi bi-caret-up fs-3xl"></i>
    </button>

    <script src="userassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="userassets/libs/simplebar/simplebar.min.js"></script>
    <script src="userassets/js/plugins.js"></script>
    <script src="userassets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="userassets/libs/list.js/list.min.js"></script>
    <script src="userassets/libs/swiper/swiper-bundle.min.js"></script>
    <script src="userassets/js/pages/dashboard-analytics.init.js"></script>
    <script src="userassets/js/pages/dashboard-ecommerce.init.js"></script>

    <script src="userassets/libs/prismjs/prism.js"></script>
    <script src="userassets/js/pages/swiper.init.js"></script>
    <script src="userassets/js/app.js"></script>


    <script src="userassets/js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="userassets/js/custom.js"></script>
    <script>
        CartQty();
        function CartQty() {
            (document.querySelector(".hamburger-icon").classList.remove("open"))
            $('#CartQty')
                .html('<i class="fa fa-spin fa-spinner" style="font-size:10px !important"></i>').load("services/CartQty.ashx");
        }
        function cLogout() {
            $('#logoutModal').modal('show');
        }
        function logout() {
            window.location.href = '/uLogout';
        }
    </script>

    
    <script>
    
        function changeaccount() {
           
            if ($("#main_accountno").val() == '') {
                toastr('Account Number is mandatory.', 'w');
                return;
            }
            if ($("#main_bankname").val() == '') {
                toastr('Bank Name is mandatory.', 'w');
                return;
            }
            if ($("#main_ifsc").val() == '') {
                toastr('IFSC code is mandatory.', 'w');
                return;
            }
            if ($("#main_Branch").val() == '') {
                toastr('Branch name is mandatory.', 'w');
                return;
            }
            var loginFrm = new FormData();
            loginFrm.append("ifsc", $("#main_ifsc").val());
            loginFrm.append("bank", $("#main_bankname").val());
            loginFrm.append("accountno", $("#main_accountno").val());
            loginFrm.append("branch", $("#main_Branch").val());
            $('#bbtn1').html('<i class="fa fa-spin fa-spinner"></i> Please Wait...').attr('disabled', true);
            $.ajax({
                url: "services/UpdateAccount.ashx",
                type: "POST",
                contentType: false,
                processData: false,
                data: loginFrm,
                dataType: "json",
                success: function (Response) {
                    if (Response.Success) {
                        $('#bbtn1').html('<i class="far fa-save"></i>Save Change').attr('disabled', false);
                        $("[id*=main_ifsc]").val('');
                        $("[id*=main_bankname]").val('');
                        $("[id*=main_accountno]").val('');
                        $("[id*=main_Branch]").val('');
                        toastr(Response.Message, 's');
                    }
                    else {
                        $('#bbtn1').html('<i class="far fa-save"></i>Save Change').attr('disabled', false);
                        toastr(Response.Message, 'w');

                    }
                },
                error: function (err) {
                    $('#bbtn1').html('<i class="far fa-save"></i>Save Change').attr('disabled', false);
                    toastr(err.statusText, 's');

                }
            });
        }
    </script>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script>
                    © My Evinnko Global (P) Limited.
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
