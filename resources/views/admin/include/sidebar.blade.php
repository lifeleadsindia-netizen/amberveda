<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{ url('admin/dashboard') }}">
            <div class="logo-img text-center pl-5">
                <img height="70" width="120" style="padding-left:50px" src="{{ asset('logo/logo.png') }}"
                    class="header-brand-img ml-5" title="Admin">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
        $addata = subadmin();
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ $segment1 == 'dashboard' ? 'active' : '' }} mt-2">
                    <a href="{{ url('admin/dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>


                {{-- <div class="nav-item {{ ($segment1 == 'rest-api') ? 'active' : '' }}">
                    <a href="{{url('admin/achievers-images')}}"><i class="ik ik-image"></i><span>Achievers Images</span>
                    </a>
                </div> --}}

                    <div class="nav-item {{ $segment1 == 'rest-api' ? 'active' : '' }}">
                        <a href="{{ url('admin/dash-messages') }}"><i class="ik ik-image"></i><span>Dashboard
                                Messages</span>
                        </a>
                    </div>
                    <div class="nav-item {{ $segment1 == 'rest-api' ? 'active' : '' }}">
                        <a href="{{ url('admin/deposit-details') }}"><i class="ik ik-box"></i><span>Deposit
                                Details</span>
                        </a>
                    </div>
                    
                <div class="nav-item {{ $segment1 == 'rest-api' ? 'active' : '' }}">
                    <a href="{{ url('admin/set-selling-point') }}"><i class="ik ik-box"></i><span>Set Selling Point</span>
                    </a>
                </div>
                
                <!--<div class="nav-item {{ $segment1 == 'rest-api' ? 'active' : '' }}">-->
                <!--    <a href="{{ url('admin/create-cities') }}"><i class="ik ik-box"></i><span>Create Cities</span>-->
                <!--    </a>-->
                <!--</div>-->
                
                    <!--<div-->
                    <!--    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                    <!--    <a href="#"><i class="ik ik-server"></i><span>{{ __('Franchise Section') }}</span></a>-->
                    <!--    <div class="submenu-content">-->
                    <!--        <a href="{{ url('admin/create-franchise') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Create Franchise') }}</a>-->
                    <!--        <a href="{{ url('admin/franchise-details') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Franchise Details') }}</a>-->
                    <!--        <a href="{{ url('admin/franchise-new-kyc-requests') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('New Kyc Requests') }}</a>-->
                    <!--        <a href="{{ url('admin/franchise/verified-kyc-requests') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Verified KYCs') }}</a>-->
                    <!--    </div>-->
                    <!--</div>-->

                <!--@if (($addata['roll'] == 'Sub Admin' && $addata['admin_manage'] == 'on') || $addata['roll'] == 'Admin')-->
                <!--    <div-->
                <!--        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                <!--        <a href="#"><i class="ik ik-server"></i><span>{{ __('Admin Management') }}</span></a>-->
                <!--        <div class="submenu-content">-->
                <!--            <a href="{{ url('admin/create-new-admin') }}"-->
                <!--                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Create Admin') }}</a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--@endif-->
                
                    <div
                        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-server"></i><span>{{ __('Product Management') }}</span></a>
                        <div class="submenu-content">
                            <!--<a href="{{ url('admin/link-product') }}"-->
                            <!--    class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Add Link Product') }}</a>   -->
                            <a href="{{ url('admin/category-creation') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Category Creation') }}</a>
                            <a href="{{ url('admin/create-product') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Create Product') }}</a>
                            <a href="{{ url('admin/all-products') }}"
                                class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('All Products') }}</a>
                        </div>
                    </div>
                    
                    <!--<div-->
                    <!--    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                    <!--    <a href="#"><i class="ik ik-server"></i><span>{{ __('Dispatch Order') }}</span></a>-->
                    <!--    <div class="submenu-content">-->
                    <!--        <a href="{{ url('admin/dispatch-order') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Completed Order') }}</a>-->
                    <!--        <a href="{{ url('admin/dispatch-order-dis') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Dispatched Order') }}</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                
                    <div
                        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-users"></i><span>{{ __('Member Management') }}</span></a>
                        <div class="submenu-content">
                            <a href="{{ url('admin/member-details') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Members Details') }}</a>
                            <!--<a href="{{ url('admin/activate-member') }}" class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Account Activation') }}</a>-->
                            <!--<a href="{{ url('admin/upgrade-member') }}" class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Account Upgrade') }}</a>-->
                            <a href="{{ url('admin/account-control') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Account Control') }}</a>
                            <a href="{{ url('admin/member-security') }}"
                                class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Members Security') }}</a>
                            <a href="{{ url('admin/free-pin-account') }}"
                                class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Free Pin Activation') }}</a>
                            <a href="{{ url('admin/new-kyc-requests') }}"
                                class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('New KYC Requests') }}</a>
                            <a href="{{ url('admin/verified-kyc-requests') }}"
                                class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Verified KYCs') }}</a>
                            <!--<a href="{{ url('admin/wallet-address') }}"-->
                            <!--    class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Member Wallet Address') }}</a>-->
                        </div>
                    </div>

                    <!--<div-->
                    <!--    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                    <!--    <a href="#"><i class="ik ik-users"></i><span>{{ __('Links Order') }}</span></a>-->
                    <!--    <div class="submenu-content">-->
                    <!--         <a href="{{url('admin/member-details')}}"-->
                    <!--        class="menu-item {{ ($segment1 == 'alerts') ? 'active' : '' }}">{{ __('Members-->
                    <!--        Details')}}</a> -->
                    <!--        <a href="{{ url('admin/activate-member') }}" class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Account Activation') }}</a>-->
                    <!--        <a href="{{ url('admin/upgrade-member') }}" class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Account Upgrade') }}</a>-->
                    <!--         <a href="{{url('admin/account-control')}}"-->
                    <!--        class="menu-item {{ ($segment1 == 'alerts') ? 'active' : '' }}">{{ __('Account-->
                    <!--        Control')}}</a> -->
                    <!--        <a href="{{ url('admin/order-requests') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Order Request') }}</a>-->
                    <!--        <a href="{{ url('admin/order-request-history') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Order Request History') }}</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <!--<div-->
                    <!--    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                    <!--    <a href="#"><i class="ik ik-users"></i><span>{{ __('Club Section') }}</span></a>-->
                    <!--    <div class="submenu-content">-->
                    <!--        {{-- <a href="{{url('admin/member-details')}}"-->
                    <!--        class="menu-item {{ ($segment1 == 'alerts') ? 'active' : '' }}">{{ __('Members-->
                    <!--        Details')}}</a> --}}-->
                    <!--        <a href="{{ url('admin/activate-member') }}" class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Account Activation') }}</a>-->
                    <!--        <a href="{{ url('admin/upgrade-member') }}" class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Account Upgrade') }}</a>-->
                    <!--        {{-- <a href="{{url('admin/account-control')}}"-->
                    <!--        class="menu-item {{ ($segment1 == 'alerts') ? 'active' : '' }}">{{ __('Account-->
                    <!--        Control')}}</a> --}}-->
                    <!--        <a href="{{ url('admin/club-income') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Club Income') }}</a>-->
                    <!--        <a href="{{ url('admin/club-details') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Club Details') }}</a>-->
                    <!--             <a href="{{ url('admin/club-assured-bonus') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Club Assured Bonus') }}</a>-->
                    <!--    </div>-->
                    <!--</div>-->

                <!--@if (($addata['roll'] == 'Sub Admin' && $addata['cashback'] == 'on') || $addata['roll'] == 'Admin')-->
                <!--    <div-->
                <!--        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                <!--        <a href="#"><i class="ik ik-tag"></i><span>{{ __('Cashback Section') }}</span></a>-->
                        
                        <!--<div class="submenu-content">-->
                        <!--    <a href="{{ url('admin/income/cashback-detail') }}"-->
                        <!--        class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Cashback Details') }}</a>-->
                        <!--</div>-->

                <!--    </div>-->
                <!--@endif-->

                    <!--<div-->
                    <!--    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                    <!--    <a href="#"><i class="ik ik-tag"></i><span>{{ __('Assured Bonus') }}</span></a>-->
                    <!--    <div class="submenu-content">-->
                    <!--        <a href="{{ url('admin/assured-bonus/achieved-members') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Achieved Members') }}</a>-->
                    <!--        <a href="{{ url('admin/assured-bonus/pay-amount') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Pay Assured Bonus') }}</a>-->
                    <!--             <a href="{{ url('admin/assured-bonus/rank-assured-bonus') }}"-->
                    <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Rank Assured Bonus') }}</a>-->
                    <!--    </div>-->

                    <!--</div>-->

                    <div
                        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-list"></i><span>{{ __('Funds Management') }}</span></a>
                        <div class="submenu-content">
                            <a href="{{ url('admin/funds/add-funds') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Add Funds') }}
                                <a href="{{ url('admin/funds/deduct-funds') }}"
                                    class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Deduct Funds') }}</a>
                                <a href="{{ url('admin/funds/add-funds-details') }}"
                                    class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Funds History') }}</a>
                                <a href="{{ url('admin/fund-requests') }}"
                                    class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Fund Requests') }}</a>
                                <a href="{{ url('admin/request-history') }}"
                                    class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Requests History') }}</a>
                        </div>
                    </div>
                
                <div
                    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-database"></i><span>{{ __('Income Section') }}</span></a>

                    <div class="submenu-content">
                        <a href="{{ url('admin/income/reward-inc') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Reward Income') }}</a>
                    </div>
                    <div class="submenu-content">
                        <a href="{{ url('admin/income/binary-matching-inc') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Binary Matching Income') }}</a>
                    </div>
                    <div class="submenu-content">
                        <a href="{{ url('admin/income/sales-bonus-inc') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Sales Bonus Income') }}</a>
                    </div>
                    <!--<div class="submenu-content">-->
                    <!--    <a href="{{ url('admin/income/level-inc') }}"-->
                    <!--        class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Level Income') }}</a>-->
                    <!--</div>-->
                    <div class="submenu-content">
                        <a href="{{ url('admin/income/travel-fund-inc') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Travel Fund Income') }}</a>
                    </div>
                    <div class="submenu-content">
                        <a href="{{ url('admin/income/club-inc') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Club Income') }}</a>
                    </div>

                </div>

                <!--<div-->
                <!--    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">-->
                <!--    <a href="#"><i class="ik ik-user"></i><span>{{ __('Franchise Management') }}</span></a>-->
                <!--    <div class="submenu-content">-->
                <!--        <a href="{{ url('admin/franchise/new-requests') }}"-->
                <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('New Franchise Request') }}</a>-->
                <!--        <a href="{{ url('admin/franchise/details') }}"-->
                <!--            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Franchise Details') }}</a>-->
                <!--        <a href="{{ url('admin/franchise/fund-request') }}"-->
                <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Fund Requests') }}</a>-->
                <!--        <a href="{{ url('admin/franchise/request-history') }}"-->
                <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Fund Requests History') }}</a>-->
                <!--        <a href="{{ url('admin/new-kyc-requests') }}"-->
                <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('New KYC Requests') }}</a>-->
                <!--        <a href="{{ url('admin/verified-kyc-requests') }}"-->
                <!--            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Verified KYCs') }}</a>-->
                <!--    </div>-->
                <!--</div>-->

                    <div
                        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-user"></i><span>{{ __('Order Management') }}</span></a>
                        <div class="submenu-content">
                            <a href="{{ url('admin/all-orders') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('All Orders') }}</a>
                            <!--<a href="{{ url('admin/pending-orders') }}"-->
                            <!--    class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Pending Orders') }}</a>-->
                            <!--<a href="{{ url('admin/delivered-orders') }}"-->
                            <!--    class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Delivered Orders') }}</a>-->
                            <!--<a href="{{ url('admin/undelivered-orders') }}"-->
                            <!--    class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Undelivered Orders') }}</a>-->
                        </div>
                    </div>

                    <div
                        class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                        <a href="#"><i
                                class="ik ik-credit-card"></i><span>{{ __('Payment Management') }}</span></a>
                        <div class="submenu-content">
                            <a href="{{ url('admin/pending-commission-list') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('New Withdrawal Requests') }}</a>
                            <a href="{{ url('admin/cancelled-list') }}"
                                class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Cancelled Requests') }}</a>
                            {{-- <a href="{{url('admin/p2p-fund-transfer')}}"
                            class="menu-item {{ ($segment1 == 'badges') ? 'active' : '' }}">{{ __('P2P Fund
                            Transfer')}}</a> --}}
                            <a href="{{ url('admin/paid-commission-list') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Payment History') }}</a>
                            <a href="{{ url('admin/gst-report') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('GST Report') }}</a>
                            <a href="{{ url('admin/tds-report') }}"
                                class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('TDS Report') }}</a>

                        </div>
                    </div>

                <div
                    class="nav-item {{ $segment1 == 'alerts' || $segment1 == 'buttons' || $segment1 == 'badges' || $segment1 == 'navigation' ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-mail"></i><span>{{ __('Grievance System') }}</span></a>
                    <div class="submenu-content">
                        <a href="{{ url('admin/support/new-support-ticket') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('New Grievance Tickets') }}</a>
                        <a href="{{ url('admin/support/open-support-ticket') }}"
                            class="menu-item {{ $segment1 == 'alerts' ? 'active' : '' }}">{{ __('Open Grievance Tickets') }}</a>
                        <a href="{{ url('admin/support/close-support-ticket') }}"
                            class="menu-item {{ $segment1 == 'badges' ? 'active' : '' }}">{{ __('Closed Grievance Tickets') }}</a>
                    </div>
                </div>
                <div class="nav-item {{ $segment1 == 'rest-api' ? 'active' : '' }}">
                    <a href="{{ url('admin/logout') }}"><i class="ik ik-stop-circle"></i><span>Logout</span>
                    </a>
                </div>
                <!-- end inventory pages -->
        </div>
    </div>
</div>
