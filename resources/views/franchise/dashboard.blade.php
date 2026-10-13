@extends('franchise.layouts.main')
@section('title', 'Dashboard')
@section('container')
    @php
        $franchiseId = $data['franchise_id'] ?? '--';
        $statusLabel = $data['status'] ?: 'N/A';
        $kycStatus = $data['kyc_status'] ?: 'Not Submitted';
        $memberSince = !empty($data['created_at']) ? date('d M Y', strtotime($data['created_at'])) : '--';
        $mainWallet = (float) ($data['wallet'] ?? 0);
        $totalIncome = (float) totadeliveryIncome($franchiseId);
        $totalWithdrawal = (float) totalFranchiseWithdrawals($franchiseId);
        $pendingOrders = franchisePendingOrders($franchiseId);
        $deliveredOrders = franchiseDeliveredOrders($franchiseId);
        $undeliveredOrders = franchiseUndeliveredOrders($franchiseId);
        $totalOrders = $pendingOrders + $deliveredOrders + $undeliveredOrders;
        $maxMetric = max($mainWallet, $totalIncome, $totalWithdrawal, 1);
        $walletPercent = min(100, round(($mainWallet / $maxMetric) * 100));
        $incomePercent = min(100, round(($totalIncome / $maxMetric) * 100));
        $withdrawPercent = min(100, round(($totalWithdrawal / $maxMetric) * 100));
    @endphp
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Nunito+Sans:wght@400;600;700;800&display=swap');

        .franchise-dashboard {
            font-family: 'Nunito Sans', sans-serif;
            padding: 8px 0 20px;
        }

        .franchise-dashboard .dashboard-shell {
            position: relative;
            background:
                radial-gradient(circle at 12% 10%, rgba(203, 172, 111, 0.17), transparent 42%),
                radial-gradient(circle at 88% 4%, rgba(74, 84, 180, 0.16), transparent 34%),
                linear-gradient(162deg, #f8f2e7 0%, #f5f7fb 44%, #edf3fa 100%);
            border: 1px solid #e1d6bf;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 22px 50px rgba(8, 24, 43, 0.11);
            overflow: hidden;
        }

        .franchise-dashboard .dashboard-shell::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(17, 35, 58, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(17, 35, 58, 0.02) 1px, transparent 1px);
            background-size: 26px 26px;
            opacity: 0.45;
            pointer-events: none;
        }

        .franchise-dashboard .dashboard-shell > * {
            position: relative;
            z-index: 1;
        }

        .franchise-dashboard .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px;
            line-height: 1;
            letter-spacing: 0.6px;
            color: #172b47;
            margin-bottom: 6px;
        }

        .franchise-dashboard .page-subtitle {
            color: #3e536f;
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .franchise-dashboard .date-pill {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #12233e, #6b096b);
            color: #f6e9cb;
            padding: 7px 13px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .franchise-dashboard .announcement-bar {
            background: #fff9eb;
            border: 1px solid #e9d7ad;
            color: #6f4a0f;
            border-radius: 12px;
            padding: 10px 14px;
            box-shadow: 0 8px 22px rgba(72, 49, 12, 0.06);
        }

        .franchise-dashboard .hero-card {
            border: 0;
            border-radius: 24px;
            color: #f8eed7;
            background: linear-gradient(120deg, #0f213b 0%, #1d3153 38%, #6b096b 100%);
            box-shadow: 0 26px 46px rgba(8, 23, 43, 0.26);
            overflow: hidden;
        }

        .franchise-dashboard .hero-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -18%;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(208, 169, 90, 0.48) 0%, rgba(208, 169, 90, 0) 72%);
            pointer-events: none;
        }

        .franchise-dashboard .hero-card .card-body {
            position: relative;
            z-index: 2;
        }

        .franchise-dashboard .hero-avatar {
            width: 106px;
            height: 106px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(228, 193, 117, 0.92);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.35);
            flex-shrink: 0;
        }

        .franchise-dashboard .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 34px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 5px;
            color: #fff4d8;
        }

        .franchise-dashboard .hero-id {
            margin: 0 0 10px;
            color: rgba(255, 243, 214, 0.85);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .franchise-dashboard .hero-chip {
            display: inline-flex;
            align-items: center;
            border: 1px solid rgba(232, 201, 131, 0.42);
            background: rgba(255, 240, 207, 0.12);
            color: #fff1ca;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 700;
            margin: 0 8px 8px 0;
        }

        .franchise-dashboard .hero-actions .btn {
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.02em;
            padding: 7px 14px;
        }

        .franchise-dashboard .hero-actions .btn-light {
            background: #f9edd0;
            border-color: #f9edd0;
            color: #1d3153;
        }

        .franchise-dashboard .hero-panel {
            border-radius: 16px;
            border: 1px solid rgba(235, 206, 144, 0.4);
            background: rgba(255, 239, 204, 0.08);
            padding: 15px;
        }

        .franchise-dashboard .hero-panel-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(245, 228, 186, 0.24);
            padding: 7px 0;
        }

        .franchise-dashboard .hero-panel-item:last-child {
            border-bottom: 0;
        }

        .franchise-dashboard .hero-panel-item span {
            color: rgba(252, 242, 220, 0.86);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .franchise-dashboard .hero-panel-item strong {
            color: #ffe3a4;
            font-size: 17px;
            font-weight: 800;
        }

        .franchise-dashboard .status-alert {
            border: 0;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            box-shadow: 0 12px 28px rgba(13, 27, 45, 0.08);
        }

        .franchise-dashboard .status-alert i {
            margin-right: 8px;
            font-size: 18px;
        }

        .franchise-dashboard .status-alert-success {
            background: #ebf8ef;
            color: #1f6b3a;
        }

        .franchise-dashboard .status-alert-info {
            background: #ebf3fb;
            color: #22577f;
        }

        .franchise-dashboard .status-alert-danger {
            background: #fceff0;
            color: #8d2c38;
        }

        .franchise-dashboard .metric-card,
        .franchise-dashboard .premium-card,
        .franchise-dashboard .order-stat-card {
            border: 1px solid #e6dac3;
            border-radius: 16px;
            box-shadow: 0 12px 26px rgba(14, 31, 50, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .franchise-dashboard .metric-card:hover,
        .franchise-dashboard .premium-card:hover,
        .franchise-dashboard .order-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 32px rgba(14, 31, 50, 0.14);
        }

        .franchise-dashboard .metric-card {
            height: 100%;
            background: #ffffff;
            padding: 16px;
        }

        .franchise-dashboard .metric-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #435974;
            font-size: 13px;
            font-weight: 700;
        }

        .franchise-dashboard .metric-head i {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(107, 9, 107, 0.13), rgba(114, 124, 244, 0.18));
            color: #5c2a73;
            font-size: 19px;
        }

        .franchise-dashboard .metric-value {
            font-size: 28px;
            font-weight: 800;
            color: #172b47;
            margin-bottom: 12px;
        }

        .franchise-dashboard .metric-progress {
            height: 8px;
            border-radius: 999px;
            background: #edf2f8;
            overflow: hidden;
        }

        .franchise-dashboard .metric-progress span {
            display: block;
            height: 100%;
            border-radius: inherit;
        }

        .franchise-dashboard .tone-1 { background: linear-gradient(90deg, #6b096b, #9b4d96); }
        .franchise-dashboard .tone-2 { background: linear-gradient(90deg, #1e3a61, #4e7ebc); }
        .franchise-dashboard .tone-3 { background: linear-gradient(90deg, #db9f3b, #f2cf85); }

        .franchise-dashboard .section-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .franchise-dashboard .section-heading-badge {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6b096b, #727cf4);
            box-shadow: 0 0 0 6px rgba(114, 124, 244, 0.12);
        }

        .franchise-dashboard .section-heading-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            color: #2f3542;
        }

        .franchise-dashboard .section-heading-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(114, 124, 244, 0.28), rgba(107, 9, 107, 0));
        }

        .franchise-dashboard .order-stat-card {
            height: 100%;
            background: #fff;
        }

        .franchise-dashboard .order-stat-card .card-body {
            padding: 18px;
        }

        .franchise-dashboard .order-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .franchise-dashboard .order-value {
            color: #212529;
            font-size: 2rem;
            font-weight: 700;
        }

        .franchise-dashboard .order-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .franchise-dashboard .order-card-pending .order-icon {
            background: rgba(255, 193, 7, 0.15);
            color: #c58b00;
        }

        .franchise-dashboard .order-card-delivered .order-icon {
            background: rgba(25, 135, 84, 0.15);
            color: #198754;
        }

        .franchise-dashboard .order-card-undelivered .order-icon {
            background: rgba(220, 53, 69, 0.14);
            color: #dc3545;
        }

        .franchise-dashboard .premium-card {
            background: #ffffff;
            overflow: hidden;
        }

        .franchise-dashboard .premium-card .card-header {
            background: transparent;
            border-bottom: 1px solid #ebdfcc;
            padding: 16px 18px;
        }

        .franchise-dashboard .premium-card .card-header h5 {
            margin: 0;
            color: #172b47;
            font-size: 17px;
            font-weight: 800;
        }

        .franchise-dashboard .summary-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .franchise-dashboard .summary-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 11px 0;
            border-bottom: 1px solid #edf2f8;
            gap: 12px;
        }

        .franchise-dashboard .summary-list li:last-child {
            border-bottom: 0;
        }

        .franchise-dashboard .summary-list span {
            color: #5c718d;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .franchise-dashboard .summary-list strong {
            color: #172b47;
            font-size: 15px;
            font-weight: 800;
            text-align: right;
        }


        .franchise-dashboard .quick-note {
            border-radius: 13px;
            background: linear-gradient(135deg, #f8f1e4, #ffffff);
            border: 1px solid #eadcc7;
            padding: 14px 15px;
            color: #3b516c;
            font-weight: 700;
        }

        @media (max-width: 991.98px) {
            .franchise-dashboard .hero-title {
                font-size: 28px;
            }
        }

        @media (max-width: 575.98px) {
            .franchise-dashboard .dashboard-shell {
                padding: 16px;
                border-radius: 18px;
            }

            .franchise-dashboard .page-title {
                font-size: 30px;
            }

            .franchise-dashboard .hero-avatar {
                width: 88px;
                height: 88px;
            }

            .franchise-dashboard .hero-title {
                font-size: 24px;
            }

            .franchise-dashboard .metric-value,
            .franchise-dashboard .order-value {
                font-size: 24px;
            }

            .franchise-dashboard .summary-list li {
                align-items: flex-start;
                flex-direction: column;
            }

            .franchise-dashboard .summary-list strong {
                text-align: left;
            }
        }
    </style>

    <div class="container-fluid franchise-dashboard">
        <div class="dashboard-shell">
            <div class="row align-items-center mb-3">
                <div class="col-lg-8">
                    <div class="page-title-box mb-0">
                        <h4 class="page-title">Franchise Dashboard</h4>
                        <p class="page-subtitle">Track your wallet, order delivery flow and franchise activity from one premium summary view.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-2 mt-lg-0">
                    <span class="date-pill"><i class="mdi mdi-calendar-month-outline me-1"></i>{{ date('d M Y') }}</span>
                </div> 
            </div>

            {{-- @if (isset($dashMsg) && $dashMsg->count())
                <div class="announcement-bar mb-3">
                    <marquee>
                        <strong>
                            @foreach ($dashMsg as $item)
                                <span class="me-4">{{ $item['message'] }}</span>
                            @endforeach
                        </strong>
                    </marquee>
                </div>
            @endif --}}

            <div class="card hero-card mb-4">
                <div class="card-body p-4 p-xl-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-xl-7">
                            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap">
                                 @if ($data['image'] != '')
                                        <img src="{{ asset('uploads') }}/{{ $data['image'] }}"
                                            class="rounded-circle hero-avatar" alt="profile" width="32" />
                                    @else
                                        <img src="{{ asset('uploads/avatar.jpg') }}"
                                            class="rounded-circle hero-avatar" alt="profile" width="32" />
                                    @endif
                                <div class="ms-sm-4 mt-3 mt-sm-0">
                                    <h2 class="hero-title">{{ $data['name'] }}</h2>
                                    <p class="hero-id">Franchise ID: {{ $franchiseId }}</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="hero-chip"><i class="mdi mdi-storefront-outline me-1"></i>Status: {{ $statusLabel }}</span>
                                        <span class="hero-chip"><i class="mdi mdi-shield-check-outline me-1"></i>KYC: {{ $kycStatus }}</span>
                                        <span class="hero-chip"><i class="mdi mdi-cart-outline me-1"></i>Total Orders: {{ $totalOrders }}</span>
                                    </div>
                                    <div class="hero-actions mt-2">
                                        <a href="{{ url('/franchise_panel/profile/profile-details') }}" class="btn btn-light btn-sm me-2 mb-2">
                                            <i class="mdi mdi-account-edit-outline me-1"></i>Edit Profile
                                        </a>
                                        <a href="{{ route('franchise.order.details') }}" class="btn btn-outline-light btn-sm mb-2">
                                            <i class="mdi mdi-truck-delivery-outline me-1"></i>Manage Orders
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="hero-panel">
                                <div class="hero-panel-item">
                                    <span>Main Wallet</span>
                                    <strong>&#8377; {{ number_format($mainWallet, 2) }}</strong>
                                </div>
                                <div class="hero-panel-item">
                                    <span>Member Since</span>
                                    <strong>{{ $memberSince }}</strong>
                                </div>
                                <div class="hero-panel-item">
                                    <span>Total Delivery Commission</span>
                                    <strong>&#8377; {{ number_format($totalIncome, 2) }}</strong>
                                </div>
                                <div class="hero-panel-item">
                                    <span>Total Withdrawals</span>
                                    <strong>&#8377; {{ number_format($totalWithdrawal, 2) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($data['kyc_status'] == 'Verified')
                <div class="status-alert status-alert-success mb-4">
                    <i class="mdi mdi-check-decagram-outline"></i>
                    Your KYC has been verified and your franchise profile is fully active.
                </div>
            @elseif ($data['kyc_status'] == 'Submitted')
                <div class="status-alert status-alert-info mb-4">
                    <i class="mdi mdi-timer-sand-empty"></i>
                    Your KYC has been submitted and is currently under review.
                </div>
            @else
                <div class="status-alert status-alert-danger mb-4">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    Your KYC is pending. Submit your details to unlock full franchise operations.
                </div>
            @endif

            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>Main Wallet</span>
                            <i class="mdi mdi-wallet-outline"></i>
                        </div>
                        <h3 class="metric-value">&#8377; {{ number_format($mainWallet, 2) }}</h3>
                        <div class="metric-progress"><span class="tone-1" style="width: {{ $walletPercent }}%;"></span></div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>Total Incomes</span>
                            <i class="mdi mdi-cash-multiple"></i>
                        </div>
                        <h3 class="metric-value">&#8377; {{ number_format($totalIncome, 2) }}</h3>
                        <div class="metric-progress"><span class="tone-2" style="width: {{ $incomePercent }}%;"></span></div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>Total Withdrawal</span>
                            <i class="mdi mdi-bank-transfer-out"></i>
                        </div>
                        <h3 class="metric-value">&#8377; {{ number_format($totalWithdrawal, 2) }}</h3>
                        <div class="metric-progress"><span class="tone-3" style="width: {{ $withdrawPercent }}%;"></span></div>
                    </div>
                </div>
            </div>

            <div class="section-heading">
                <span class="section-heading-badge"></span>
                <h5 class="section-heading-title">Orders</h5>
                <span class="section-heading-line"></span>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card order-stat-card order-card-pending">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="order-label mb-1">Pending Orders</p>
                                    <h3 class="order-value mb-0">{{ $pendingOrders }}</h3>
                                </div>
                                <div class="order-icon">
                                    <i class="mdi mdi-timer-sand"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card order-stat-card order-card-delivered">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="order-label mb-1">Delivered Orders</p>
                                    <h3 class="order-value mb-0">{{ $deliveredOrders }}</h3>
                                </div>
                                <div class="order-icon">
                                    <i class="mdi mdi-truck-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card order-stat-card order-card-undelivered">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="order-label mb-1">Undelivered Orders</p>
                                    <h3 class="order-value mb-0">{{ $undeliveredOrders }}</h3>
                                </div>
                                <div class="order-icon">
                                    <i class="mdi mdi-alert-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection




