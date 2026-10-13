<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8" />
    <title>@yield('title') :: {{ config('detailsApp.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('logo/favicon/site.webmanifest') }}" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <!-- Datatables css -->
    <link href="{{ asset('franchise_assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('franchise_assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- third party css -->
    <link href="{{ asset('franchise_assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ asset('franchise_assets/css/geneology.css') }}" rel="stylesheet">
    <link href="{{ asset('franchise_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('franchise_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('franchise_assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />

    <!-- Daterangepicker css -->
    <link href="{{ asset('franchise_assets/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet"
        type="text/css">

    <!-- Vector Map css -->
    <link href="{{ asset('franchise_assets/vendor/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css">


    <title>@yield('title', '') | {{ config('detailsApp.name') }}</title>

    <style>
        .btn-blue {
            background-color: #727CF4;
            color: white;
        }
    </style>
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->
            <a href="{{ url('franchise_panel/dashboard') }}" class = "mt-1 logo text-center">
                <span class="logo-lg" style="background: #6B096B">
                    <img src="{{ asset('logo/logo.png') }}" alt="" width="80">
                </span>
                <span class="logo-sm" style="background: #6B096B">
                    <img src="{{ asset('logo/logo.png') }}" alt="" width="80">
                </span>
            </a>

            <!-- LOGO -->
            <a href="{{ url('franchise_panel/dashboard') }}" class="mt-1 logo text-center">
                <span class="logo-lg" style="background: #6B096B">
                    <img src="{{ asset('logo/logo.png') }}" alt="" width="80">
                </span>
                <span class="logo-sm" style="background: #6B096B">
                    <img src="{{ asset('logo/logo.png') }}" alt="" width="80">
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title side-nav-item"></li>

                    <li class="side-nav-item">
                        <a href="{{ url('franchise_panel/dashboard') }}" aria-expanded="false" class="side-nav-link">
                            <i class="uil-layers"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <hr>
                    {{-- <li class="side-nav-title side-nav-item">Management</li> --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false"
                            aria-controls="sidebarPages" class="side-nav-link">
                            <i class="uil-user-circle"></i>
                            <span>Franchise Profile</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('franchise_panel/profile/profile-details') }}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('franchise_panel/profile/security') }}">Security</a>
                                </li>
                                <li>
                                    <a href="{{ url('franchise_panel/profile/kyc-verified') }}">KYC Verified</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages1101" aria-expanded="false"
                            aria-controls="sidebarPages1101" class="side-nav-link">
                            <i class="uil-suitcase"></i>
                            <span> Inventory Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages1101">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('franchise_panel/inventory/current-inventory') }}">Current
                                        Inventory</a>
                                </li>
                                <li>
                                    <a href="{{ url('franchise_panel/inventory/received-inventory') }}">Received
                                        Inventory</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages9" aria-expanded="false"
                            aria-controls="sidebarPages9" class="side-nav-link">
                            <i class="mdi mdi-alpha-p-circle-outline"></i>
                            <span>Order Management</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages9">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('franchise_panel/order/order-details') }}">Order Details</a>
                                </li>
                                <li>
                                    <a href="{{ url('franchise_panel/order/completed-orders') }}">Completed Orders</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="side-nav-item">
                        <a href="{{ url('franchise_panel/delivery-commission') }}" aria-expanded="false" class="side-nav-link">
                            <i class="uil-layers"></i>
                            <span>Delivery Commission </span>
                        </a>
                    </li>
                    
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages7" aria-expanded="false"
                            aria-controls="sidebarPages7" class="side-nav-link">
                            <i class="mdi mdi-wallet-outline"></i>
                            <span> Wallet Section </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages7">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="{{ url('franchise_panel/wallet/main-wallet') }}">Main Wallet</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="{{ url('franchise_panel/wallet/wallet-transfer') }}">Wallet Transfer</a>-->
                                <!--</li>-->
                                <li>
                                    <a href="{{ url('franchise_panel/wallet/withdrawal-history') }}">Withdrawal History</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ url('franchise_panel/logout') }}" class="side-nav-link">
                            <i class="uil-comments-alt"></i>
                            <span> Logout </span>
                        </a>
                    </li>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    @if ($data['image'] == null)
                                        <img src="{{ asset('uploads/avatar.jpg') }}"
                                            style="border-radius:50%; width:35px; height:35px">
                                    @else
                                        <img src="{{ asset('uploads') }}/{{ $data['image'] }}"
                                            style="border-radius:50%; width:35px; height:35px">
                                    @endif
                                </span>
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0">{{ $data['name'] }}</h5>
                                    <h6 class="my-0 fw-normal">{{ $data['franchise_id'] }}</h6>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                {{-- <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome {{ $data['memberid'] }}! </h6>
                                </div> --}}

                                <!-- item-->
                                <a href="{{ url('/franchise_panel/profile/profile-details') }}"
                                    class="dropdown-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>Profile</span>
                                </a>

                                <!-- item-->
                                <!--<a href="{{ url('/franchise_panel/buy-product') }}" class="dropdown-item">-->
                                <!--    <i class="mdi mdi-account-edit me-1"></i>-->
                                <!--    <span>Order</span>-->
                                <!--</a>-->

                                <!-- item-->
                                <a href="{{ url('franchise_panel/logout') }}" class="dropdown-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>



                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <div class="d-none d-lg-block pt-2">
                        <h3>{{ config('detailsApp.name') }} / <span class="text-primary">@yield('title')</span></h3>
                    </div>
                    <!--<div class="app-search dropdown d-none d-lg-block">-->
                    <!--    <form>-->
                    <!--        <div class="input-group">-->
                    <!--            <input type="text" class="form-control dropdown-toggle" placeholder="Search..."-->
                    <!--                id="top-search">-->
                    <!--            <span class="mdi mdi-magnify search-icon"></span>-->
                    <!--            <button class="input-group-text btn-primary" type="submit">Search</button>-->
                    <!--        </div>-->
                    <!--    </form>-->

                    <!--    <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">-->
                    <!--         item-->
                    <!--        <div class="dropdown-header noti-title">-->
                    <!--            <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>-->
                    <!--        </div>-->

                    <!--         item-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                    <!--            <i class="uil-notes font-16 me-1"></i>-->
                    <!--            <span>Analytics Report</span>-->
                    <!--        </a>-->

                    <!--         item-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                    <!--            <i class="uil-life-ring font-16 me-1"></i>-->
                    <!--            <span>How can I help you?</span>-->
                    <!--        </a>-->

                    <!--         item-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                    <!--            <i class="uil-cog font-16 me-1"></i>-->
                    <!--            <span>User profile settings</span>-->
                    <!--        </a>-->

                    <!--         item-->
                    <!--        <div class="dropdown-header noti-title">-->
                    <!--            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>-->
                    <!--        </div>-->

                    <!--        <div class="notification-list">-->
                    <!--             item-->
                    <!--            <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                    <!--                <div class="d-flex">-->
                    <!--                    <img class="d-flex me-2 rounded-circle"-->
                    <!--                        src="{{ asset('franchise_assets/images/users/avatar-2.jpg') }}"-->
                    <!--                        alt="Generic placeholder image" height="32">-->
                    <!--                    <div class="w-100">-->
                    <!--                        <h5 class="m-0 font-14">Erwin Brown</h5>-->
                    <!--                        <span class="font-12 mb-0">UI Designer</span>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </a>-->

                    <!--             item-->
                    <!--            <a href="javascript:void(0);" class="dropdown-item notify-item">-->
                    <!--                <div class="d-flex">-->
                    <!--                    <img class="d-flex me-2 rounded-circle"-->
                    <!--                        src="{{ asset('franchise_assets/images/users/avatar-5.jpg') }}"-->
                    <!--                        alt="Generic placeholder image" height="32">-->
                    <!--                    <div class="w-100">-->
                    <!--                        <h5 class="m-0 font-14">Jacob Deo</h5>-->
                    <!--                        <span class="font-12 mb-0">Developer</span>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <!-- end Topbar -->
