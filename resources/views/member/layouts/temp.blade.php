<!DOCTYPE html>

<html lang="en" data-layout="vertical" data-sidebar="dark" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" />
    <meta name="author" />

    <link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />


    <link href="{{ asset('userassets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('userassets/js/layout.js') }}"></script>
    <link href="{{ asset('userassets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('userassets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('userassets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" />
    <link href="{{ asset('userassets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('userassets/css/vanilla-dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('userassets/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/bootstrap-icons.svg">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Add JavaScript to toggle the visibility -->
    <script>
        function toggleValue() {
            var element = document.getElementById('main_lBusiness');
            var eyeIcon = document.getElementById('eye-icon');

            // If the value is currently hidden (****), show the actual value
            if (element.innerHTML === '****') {
                element.innerHTML = '{{ $data['left_amount'] }} AGV';
                eyeIcon.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Change to eye-slash icon when value is visible
            } else {
                // Otherwise, hide the value and show **** again
                element.innerHTML = '****';
                eyeIcon.innerHTML = '<i class="fas fa-eye"></i>'; // Change back to eye icon
            }
        }
    </script>
    <style>
        .baseball {
            padding: 6px 0 6px 0;
            border-radius: 0 25px 25px 0;
            background: linear-gradient(to left, #e82078, #9f219b);
        }

        .base {
            text-align: left !important;
            padding-left: 2px;
            padding-right: 0px;
            padding-top: 1px;
            background-color: white;
            border-radius: 0 25px 25px 0;
            font-size: 14px;
            font-weight: 600;
        }

        .ball {
            text-align: left !important;
            color: white;
            font-size: 14px;
        }
    </style>

    <title>@yield('title', '') | {{ config('detailsApp.name') }}</title>
    <style>
        .w-md {
            min-width: 130px !important;
        }

        .baseball {
            padding: 6px 0 6px 0;
            border-radius: 0 25px 25px 0;
            background: linear-gradient(to left, #e82078, #9f219b);
        }

        .base {
            padding-left: 2px;
            padding-right: 0px;
            padding-top: 1px;
            background-color: white;
            border-radius: 0 25px 25px 0;
            font-size: 14px;
            font-weight: 600;
        }

        .ball {
            color: white;
            font-size: 14px;
        }
    </style>
    <title>

    </title>
</head>

<body>
    <div id="layout-wrapper">
        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <a href="{{ url('member/dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="28">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="58">
                    </span>
                </a>
                <a href="{{ url('member/dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="28">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/logo.png') }}" alt="" height="58">
                    </span>
                </a>
                <button type="button"
                    class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover shadow-none"
                    id="vertical-hover">
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
                            <a class="nav-link menu-link" href="{{ url('member/dashboard') }}">
                                <i class="ti-dashboard"></i><span data-key="t-dashboards">Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Profile" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarProfile">
                                <i class="ti-user"></i><span data-key="t-layouts">Profile Section</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Profile">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('member/profile/profile-details') }}" class="nav-link"
                                            data-key="t-Profile">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('member/profile/kyc') }}" class="nav-link"
                                            data-key="t-Profile">Kyc Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('member/profile/security') }}" class="nav-link"
                                            data-key="t-Profile">Security</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link collapsed" href="#Fund" data-bs-toggle="collapse"-->
                        <!--        role="button" aria-expanded="false" aria-controls="sidebarFund">-->
                        <!--        <i class=" ti-wallet"></i><span data-key="t-layouts">Fund</span>-->
                        <!--    </a>-->
                        <!--    <div class="collapse menu-dropdown" id="Fund">-->
                        <!--        <ul class="nav nav-sm flex-column">-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="{{ url('/member/funds/add-funds') }}" class="nav-link" data-key="t-Report">Add Fund</a>-->
                        <!--            </li>-->
                        <!--            <li class="nav-item">-->
                        <!--                <a href="{{ url('/member/funds/fund-report') }}" class="nav-link" data-key="t-Report">Fund Report</a>-->
                        <!--            </li>-->
                        <!--            {{-- <li class="nav-item">-->
                        <!--                <a href="{{url('/member/funds/fund-transfer')}}" class="nav-link" data-key="t-Transfer">Fund-->
                        <!--                    Transfer</a>-->
                        <!--            </li> --}}-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <li class="menu-title"><i class="ti ti-dots"></i><span data-key="t-Components">Product</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ url('member/buy-product') }}">
                                <i class="bi bi-cart"></i><span data-key="ti-logout">Buy Product</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ url('member/order-history') }}">
                                <i class="bi bi-cart"></i><span data-key="ti-logout">Order History</span>
                            </a>
                        </li>
                        <li class="menu-title"><i class="ti ti-dots"></i><span data-key="t-Components">Income</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Income" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class="ph-money-light"></i><span data-key="t-layouts">Income Section</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Income">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{ url('member/income/matching-income') }}" class="nav-link"
                                            data-key="t-Transfer">Matching
                                            Income</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('member/income/rapid-rider') }}" class="nav-link"
                                            data-key="t-Transfer">Rapid
                                            Rider</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!--<li class="menu-title"><i class="ti ti-dots"></i><span data-key="t-Components">Reward</span></li>-->
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Reward" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class="ph-money-light"></i><span data-key="t-layouts">Reward Section</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Reward">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('/member/reward/reward-income') }}" class="nav-link"
                                            data-key="t-Transfer">Reward
                                            Income</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/member/reward/reward-details') }}" class="nav-link"
                                            data-key="t-Transfer">Reward Details</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Binary" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class="bi bi-award-fill"></i><span data-key="t-layouts">Bonus Section</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Binary">
                                <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                        <a href="{{url('member/income/instant-bonus')}}" class="nav-link" data-key="t-Report">Instant Bonus</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('member/binary/group-bonus')}}" class="nav-link" data-key="t-Report">Group Bonus</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('member/binary/car-bonus')}}" class="nav-link" data-key="t-Transfer">Car
                                            Bonus</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('member/binary/partner-bonus')}}" class="nav-link" data-key="t-Transfer">Partner
                                            Bonus</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('member/binary/house-bonus')}}" class="nav-link" data-key="t-Transfer">House
                                            Bonus</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('member/binary/ld-bonus')}}" class="nav-link" data-key="t-Transfer">LD
                                            Bonus</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Team" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class="ph-users-four-thin"></i><span data-key="t-layouts">Team Section</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Team">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('member/team/direct-partner') }}" class="nav-link"
                                            data-key="t-Report">Direct Partner</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('member/team/genealogy-tree') }}" class="nav-link"
                                            data-key="t-Transfer">Genealogy
                                            Tree</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#Wallet" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class=" ti-wallet"></i><span data-key="t-layouts">Wallet Section</span>
                            </a>
                            <div class="collapse menu-dropdown" id="Wallet">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('member/wallet/main-wallet') }}" class="nav-link"
                                            data-key="t-Report">Main Wallet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('member/wallet/wallet-transfer') }}" class="nav-link"
                                            data-key="t-Transfer">Wallet Transfer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('member/wallet/withdrawal-history') }}" class="nav-link"
                                            data-key="t-Transfer">Withdrawal History</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#support" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarFund">
                                <i class="ti-heart"></i><span data-key="t-layouts">Grievance System</span>
                            </a>
                            <div class="collapse menu-dropdown" id="support">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('/member/support/create-ticket') }}" class="nav-link"
                                             data-key="t-Report">Create New Ticket</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/member/support/support-tickets') }}" class="nav-link"
                                            data-key="t-Transfer">Grievance Ticket</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="Business" class="nav-link menu-link"><i class="ti ti-building-store"></i><span
                                    data-key="t-Bussiness">Bussiness</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="Ceynoniquepay" class="nav-link menu-link"><i class="ti ti-wallet"></i><span
                                    data-key="t-Withdraw">Withdraw</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebarReport" class="nav-link menu-link collapsed" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarReport">
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
                                        <a href="WalletTransactions?w=Income" class="nav-link"
                                            data-key="t-Income">Income Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="WalletTransactions?w=Nominee" class="nav-link"
                                            data-key="t-Nominee">Partner Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="WalletTransactions?w=Shopping" class="nav-link"
                                            data-key="t-Shoping">Purchase Transactions</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#sidebarCommunity"
                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarCommunity">
                                <i class="ti ti-user-circle"></i><span data-key="t-Community">My Group</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarCommunity">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="TeamDirect" class="nav-link" role="button" data-key="t-Myzone">My
                                            Direct Partners</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="BinaryTree2" class="nav-link" role="button"
                                            data-key="t-Tree">Business Tree</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="GroupA" class="nav-link" role="button" data-key="t-Zone-A">Group
                                            A Partners</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="GroupB" class="nav-link" role="button" data-key="t-Zone-B">Group
                                            B Partners</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="Notification">
                                <i class="ti ti-bell-ringing"></i><span data-key="t-Notification">Notification</span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ url('member/logout') }}">
                                <i class="ph-door-thin"></i><span data-key="ti-logout">Logout</span>
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
                                    <img src="{{ asset('userassets/img/favicon.png') }}" alt=""
                                        height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('userassets/img/white.png') }}" alt=""
                                        height="56">
                                </span>
                            </a>


                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                        <a href="Default" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('userassets/img/logo.png') }}" alt="" height="32"
                                    style="margin-top: -5px; background:#ffffff;">
                            </span>
                        </a>
                        <a href="Default" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('userassets/img/white.png') }}" alt="" height="56">
                            </span>
                        </a>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <a type="button" href="{{ url('/member/cart') }}"
                                class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text">
                                <i class='ti-shopping-cart fs-3xl'></i>
                                <span id="CartQty"></span>
                                <span class="bg-danger rounded px-1 mb-3" style="font-size: 10px"
                                    id="countCart">{{ countcart() }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 product-list"
                                aria-labelledby="page-header-cart-dropdown">
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
                                                        <img src="{{ asset('userassets/images/products/img-1.png') }}"
                                                            class="avatar-xs" alt="user-pic">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1 fs-sm text-muted">Fashion</p>
                                                    <h6 class="mt-0 mb-3 fs-md">
                                                        <a href="#!" class="text-reset">Blive Printed Men Round
                                                            Neck</a>
                                                    </h6>
                                                    <div class="text-muted fw-medium d-none">$<span
                                                            class="product-price">327.49</span></div>
                                                    <div class="input-step">
                                                        <button type="button" class="minus">–</button>
                                                        <input type="number" class="product-quantity" value="2"
                                                            min="0" max="100" readonly>
                                                        <button type="button" class="plus">+</button>
                                                    </div>
                                                </div>
                                                <div
                                                    class="ps-2 d-flex flex-column justify-content-between align-items-end">
                                                    <button type="button"
                                                        class="btn btn-icon btn-sm btn-ghost-primary remove-cart-btn"
                                                        data-bs-toggle="modal" data-bs-target="#removeCartModal"><i
                                                            class="ri-close-fill fs-lg"></i></button>
                                                    <h6 class="mb-0">$ <span
                                                            class="product-line-price">654.98</span></h6>
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
                                <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border"
                                    id="checkout-elem">
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
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text"
                                data-toggle="fullscreen">
                                <i class='bi bi-arrows-fullscreen '></i>
                            </button>
                        </div>
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text mode-layout"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-sun align-middle "></i>
                            </button>
                            <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                                <a href="#!" class="dropdown-item" data-mode="light"><i
                                        class="bi bi-sun align-middle me-2"></i>Default (light mode)</a>
                                <a href="#!" class="dropdown-item" data-mode="dark"><i
                                        class="bi bi-moon align-middle me-2"></i>Dark</a>
                                <a href="#!" class="dropdown-item" data-mode="auto"><i
                                        class="bi bi-moon-stars align-middle me-2"></i>Auto (system default)</a>
                            </div>
                        </div>


                        <div class="dropdown ms-sm-3 topbar-head-dropdown dropdown-hover-end header-item topbar-user">
                            <button type="button" class="btn shadow-none btn-icon" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    @if ($data['profile_image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $data['profile_image'] }}"
                                            class="rounded-circle header-profile-user" alt="profile" />
                                    @else
                                        <img src="{{ asset('uploads/avatar.jpg') }}"
                                            class="rounded-circle header-profile-user" alt="profile" />
                                    @endif
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Welcome {{ $data['memberid'] }}! </h6>
                                <a class="dropdown-item fs-sm" href="{{ url('/member/profile/profile-details') }}"><i
                                        class="bi bi-person-circle text-muted align-middle me-1"></i><span
                                        class="align-middle">Profile</span></a>
                                <a class="dropdown-item fs-sm" href="{{ url('/member/buy-product') }}"><i
                                        class="bi bi-cart4 text-muted align-middle me-1"></i><span
                                        class="align-middle">Order</span></a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item fs-sm" href="{{ url('member/logout') }}"><i
                                        class="bi bi-box-arrow-right text-muted align-middle me-1"></i><span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="wrapper"></div>
