@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adm_assets/assets/plugins/chartist/dist/chartist.min.css') }}">
        <style>
            .order-stat-card {
                border: 1px solid #e9edf3;
                border-radius: 12px;
                box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
            }

            .order-label {
                color: #6b7280;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 0.2px;
            }

            .order-value {
                color: #111827;
                font-weight: 700;
            }

            .order-icon {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            .order-card-completed .order-icon {
                background: #e9fbe9;
                color: #1f9d55;
            }

            .order-card-delivered .order-icon {
                background: #eaf2ff;
                color: #2563eb;
            }

            .order-card-undelivered .order-icon {
                background: #fff4e5;
                color: #d97706;
            }

            .wallet-stat-card {
                border: 1px solid #e8edf5;
                border-radius: 12px;
                box-shadow: 0 10px 24px rgba(17, 24, 39, 0.08);
            }

            .wallet-label {
                color: #6b7280;
                font-size: 13px;
                font-weight: 600;
            }

            .wallet-value {
                color: #111827;
                font-weight: 700;
            }

            .wallet-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            .wallet-card-main .wallet-icon {
                background: #ecfeff;
                color: #0891b2;
            }

            .wallet-card-fund .wallet-icon {
                background: #eef2ff;
                color: #4f46e5;
            }

            .withdraw-stat-card {
                border: 1px solid #e8edf5;
                border-radius: 12px;
                box-shadow: 0 10px 24px rgba(17, 24, 39, 0.08);
            }

            .withdraw-label {
                color: #6b7280;
                font-size: 13px;
                font-weight: 600;
            }

            .withdraw-value {
                color: #111827;
                font-weight: 700;
            }

            .withdraw-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            .withdraw-card-today .withdraw-icon {
                background: #e8fff7;
                color: #0f766e;
            }

            .withdraw-card-total .withdraw-icon {
                background: #fff7ed;
                color: #c2410c;
            }

            .income-stat-card {
                border: 1px solid #e8edf5;
                border-radius: 12px;
                box-shadow: 0 10px 24px rgba(17, 24, 39, 0.08);
            }

            .income-label {
                color: #6b7280;
                font-size: 13px;
                font-weight: 600;
            }

            .income-value {
                color: #111827;
                font-weight: 700;
            }

            .income-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            .income-card-reward .income-icon {
                background: #fef3c7;
                color: #b45309;
            }

            .income-card-level .income-icon {
                background: #ede9fe;
                color: #6d28d9;
            }

            .section-heading {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 14px;
            }

            .section-heading-badge {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                flex: 0 0 10px;
            }

            .section-heading-title {
                margin: 0;
                font-size: 18px;
                font-weight: 700;
                color: #111827;
            }

            .section-heading-line {
                height: 1px;
                flex: 1;
                background: linear-gradient(90deg, rgba(148, 163, 184, 0.55), rgba(148, 163, 184, 0));
            }

            .section-heading-income .section-heading-badge {
                background: #b45309;
            }

            .section-heading-orders .section-heading-badge {
                background: #2563eb;
            }

            .binary-stat-card {
                border: 1px solid #e8edf5;
                border-radius: 12px;
                box-shadow: 0 10px 24px rgba(17, 24, 39, 0.08);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .binary-stat-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 14px 30px rgba(17, 24, 39, 0.12);
            }

            .binary-label {
                color: #6b7280;
                font-size: 13px;
                font-weight: 600;
            }

            .binary-value {
                color: #111827;
                font-weight: 700;
                font-size: 24px;
                margin: 8px 0 0 0;
            }

            .binary-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            .binary-card-left-count .binary-icon {
                background: rgba(33, 58, 98, 0.12);
                color: #213a62;
            }

            .binary-card-right-count .binary-icon {
                background: rgba(195, 139, 47, 0.12);
                color: #c38b2f;
            }

            .binary-card-left-amount .binary-icon {
                background: rgba(15, 127, 95, 0.12);
                color: #0f7f5f;
            }

            .binary-card-right-amount .binary-icon {
                background: rgba(109, 74, 147, 0.12);
                color: #6d4a93;
            }
        </style>
    @endpush

    <div class="container-fluid">
        <div class="row">
            <!-- page statustic chart start -->

            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ totalMembersadmin() }}</h4>
                                <p class="mb-0">Total Members</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-users f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ totalActiveMembers() }}</h4>
                                <p class="mb-0">Total Active </p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ totalTempMembers() }}</h4>
                                <p class="mb-0">Total Inactive </p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="mb-0">{{ totalblockedMembers() }}</h4>
                                <p class="mb-0">Total Blocked</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card withdraw-stat-card withdraw-card-today">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="withdraw-label mb-1">Today's Withdrawal</p>
                                <h3 class="withdraw-value mb-0">₹ {{ number_format(todaysWithdrawal(), 2) }}</h3>
                            </div>
                            <div class="withdraw-icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card withdraw-stat-card withdraw-card-total">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="withdraw-label mb-1">Total Withdrawal</p>
                                <h3 class="withdraw-value mb-0">₹ {{ number_format(totalWithdrawal(), 2) }}</h3>
                            </div>
                            <div class="withdraw-icon">
                                <i class="ik ik-activity"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card wallet-stat-card wallet-card-main">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="wallet-label mb-1">Main Wallet</p>
                                <h3 class="wallet-value mb-0">₹ {{ number_format(totalinWallet(), 2) }}</h3>
                            </div>
                            <div class="wallet-icon">
                                <i class="ik ik-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card wallet-stat-card wallet-card-fund">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="wallet-label mb-1">Fund Wallet</p>
                                <h3 class="wallet-value mb-0">₹ {{ number_format(totalinp2pWallet(), 2) }}</h3>
                            </div>
                            <div class="wallet-icon">
                                <i class="ik ik-layers"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="section-heading section-heading-income">
                    <span class="section-heading-badge"></span>
                    <h5 class="section-heading-title">Incomes</h5>
                    <span class="section-heading-line"></span>
                </div>
            </div>
            <!--<div class="col-lg-6 col-md-6 col-sm-12">-->
            <!--    <div class="card income-stat-card income-card-reward">-->
            <!--        <div class="card-block py-3">-->
            <!--            <div class="d-flex justify-content-between align-items-center">-->
            <!--                <div>-->
            <!--                    <p class="income-label mb-1">Level Income</p>-->
            <!--                    <h3 class="income-value mb-0">₹ {{ number_format(totalLevelIn(), 2) }}</h3>-->
            <!--                </div>-->
            <!--                <div class="income-icon">-->
            <!--                    <i class="ik ik-award"></i>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card income-stat-card income-card-reward">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="income-label mb-1">Club Income</p>
                                <h3 class="income-value mb-0">₹ {{ number_format(totalClubIn()) }}</h3>
                            </div>
                            <div class="income-icon">
                                <i class="ik ik-zap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card income-stat-card income-card-level">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="income-label mb-1">Binary Matching Income</p>
                                <h3 class="income-value mb-0">₹ {{ number_format(totalBinaryMatchingIn(), 2) }}</h3>
                            </div>
                            <div class="income-icon">
                                <i class="ik ik-award"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card income-stat-card income-card-level">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="income-label mb-1">Sales Bonus Income</p>
                                <h3 class="income-value mb-0">₹ {{ number_format(totalSalesBonusIn(), 2) }}</h3>
                            </div>
                            <div class="income-icon">
                                <i class="ik ik-zap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card income-stat-card income-card-level">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="income-label mb-1">Mentorship Income</p>
                                <h3 class="income-value mb-0">₹ {{ number_format(totalMentorshipIn(), 2) }}</h3>
                            </div>
                            <div class="income-icon">
                                <i class="ik ik-zap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card income-stat-card income-card-reward">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="income-label mb-1">Total Reward <b style="color:green">{PAID}</b> </p>
                                <h3 class="income-value mb-0">{{ totalRewardIn() }}</h3>
                            </div>
                            <div class="income-icon">
                                <i class="ik ik-zap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card income-stat-card income-card-level">
                    <div class="card-block py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="income-label mb-1">Total Travel Fund <b style="color:green">{PAID}</b> </p>
                                <h3 class="income-value mb-0">{{ totalTravelFundIn() }}</h3>
                            </div>
                            <div class="income-icon">
                                <i class="ik ik-award"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="section-heading section-heading-orders">
                    <span class="section-heading-badge"></span>
                    <h5 class="section-heading-title"></h5>
                    <span class="section-heading-line"></span>
                </div>
            </div>
            <!--<div class="col-xl-4 col-md-6">-->
            <!--    <div class="card order-stat-card order-card-completed">-->
            <!--        <div class="card-block py-3">-->
            <!--            <div class="d-flex justify-content-between align-items-center">-->
            <!--                <div>-->
            <!--                    <p class="order-label mb-1">Pending Orders</p>-->
            <!--                    <h3 class="order-value mb-0">₹ {{ totalpendingdorders() }}</h3>-->
            <!--                </div>-->
            <!--                <div class="order-icon">-->
            <!--                    <i class="ik ik-clock"></i>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-xl-4 col-md-6">-->
            <!--    <div class="card order-stat-card order-card-delivered">-->
            <!--        <div class="card-block py-3">-->
            <!--            <div class="d-flex justify-content-between align-items-center">-->
            <!--                <div>-->
            <!--                    <p class="order-label mb-1">Delivered Orders</p>-->
            <!--                    <h3 class="order-value mb-0">₹ {{ totaldeliveredorders() }}</h3>-->
            <!--                </div>-->
            <!--                <div class="order-icon">-->
            <!--                    <i class="ik ik-truck"></i>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-xl-4 col-md-6">-->
            <!--    <div class="card order-stat-card order-card-undelivered">-->
            <!--        <div class="card-block py-3">-->
            <!--            <div class="d-flex justify-content-between align-items-center">-->
            <!--                <div>-->
            <!--                    <p class="order-label mb-1">Undelivered Orders</p>-->
            <!--                    <h3 class="order-value mb-0">₹ {{ totalundeliveredorders() }}</h3>-->
            <!--                </div>-->
            <!--                <div class="order-icon">-->
            <!--                    <i class="ik ik-alert-circle"></i>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-xl-4 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="mb-0">₹ {{ totalgrossAmount() }}</h4>
                                <p class="mb-0">Withdrawal Gross Amount</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="ik ik-grid f-30"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="mb-0">₹ {{ totalnetAmount() }}</h4>
                                <p class="mb-0">Withdrawal Net Amount</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="ik ik-database f-30"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="mb-0">₹ {{ totaldeductions() }}</h4>
                                <p class="mb-0">Deduction on Withdrawal</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="ik ik-tag f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- page statustic chart end -->

        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('adm_assets/assets/plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('adm_assets/assets/plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('adm_assets/assets/plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/plugins/amcharts/themes/light.js') }}"></script>


        <script src="{{ asset('adm_assets/assets/js/widget-statistic.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/widget-data.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/dashboard-charts.js') }}"></script>
        <script src="{{ asset('adm_assets/assets/js/widgets.js') }}"></script>
    @endpush
@endsection
