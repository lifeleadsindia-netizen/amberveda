@extends('member.layouts.main')
@section('title', 'Dashboard')
@section('container')
    @php
        $memberId = $data['memberid'];
        $levelIncome = totalLevelIncome($memberId);
        $clubIncome = totalClubIncome($memberId);
        $binaryMatchingIncome = totalBinaryMatchingIncome($memberId);
        $rewardIncome = totalRewardIncome($memberId);
        $totalTeam = totalLevelMembers($memberId);
        $salesBonusIncome = totalSalesBonusIncome($memberId);
        $fundImported = totalImportedFund($memberId);
        $withdrawAmount = totalWithdrawals($memberId);
        $todayWithdraw = todayWithdrawals($memberId);
        $totalPurchasedProducts = totalPurchasedProducts($memberId);
        $recentWalletTransfers = recentWalletTransfers($memberId, 6);
        $mainWallet = (float) ($data['wallet'] ?? 0);
        $purchaseWallet = (float) ($data['p2p_wallet'] ?? 0);
        $maxWallet = max($mainWallet, $purchaseWallet, 1);
        $profileCompletion = memberProfileCompletionPercent($data);
        $mainWalletPercent = min(100, round(($mainWallet / $maxWallet) * 100));
        $purchaseWalletPercent = min(100, round(($purchaseWallet / $maxWallet) * 100));
        $statusLabel = $data['status'] ?: 'N/A';
        $rankLabel = $data['rank'] ?: 'N/A';
        $kycStatus = $data['kyc_status'] ?: 'Not Submitted';
        $memberSince = !empty($data['created_at']) ? date('d M Y', strtotime($data['created_at'])) : '--';
        $activationDate = !empty($data['activated_at']) ? date('d M Y', strtotime($data['activated_at'])) : '--';
        $totalWallet = $mainWallet + $purchaseWallet;
        $binaryDetails = getBinaryDetails($memberId);
    @endphp
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Nunito+Sans:wght@400;600;700;800&display=swap');

        .premium-dashboard {
            font-family: 'Nunito Sans', sans-serif;
            padding: 6px 0 18px;
            margin-top: 10px;
        }

        .premium-dashboard .premium-shell {
            position: relative;
            background:
                radial-gradient(circle at 12% 10%, rgba(203, 172, 111, 0.17), transparent 42%),
                radial-gradient(circle at 89% 3%, rgba(36, 67, 112, 0.2), transparent 38%),
                linear-gradient(162deg, #f8f2e7 0%, #f5f7fb 44%, #edf3fa 100%);
            border: 1px solid #e1d6bf;
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 22px 50px rgba(8, 24, 43, 0.11);
            overflow: hidden;
        }

        .premium-dashboard .premium-shell::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(17, 35, 58, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(17, 35, 58, 0.02) 1px, transparent 1px);
            background-size: 26px 26px;
            opacity: 0.45;
            pointer-events: none;
        }

        .premium-dashboard .premium-shell>* {
            position: relative;
            z-index: 1;
        }

        .premium-dashboard .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 34px;
            line-height: 1;
            letter-spacing: 0.6px;
            color: #172b47;
            margin-bottom: 6px;
        }

        .premium-dashboard .page-subtitle {
            color: #3e536f;
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .premium-dashboard .date-pill {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #12233e, #1f3f69);
            color: #f6e9cb;
            padding: 7px 13px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .premium-dashboard .premium-announcement {
            background: #fff9eb;
            border: 1px solid #e9d7ad;
            color: #6f4a0f;
            border-radius: 12px;
            padding: 10px 14px;
            box-shadow: 0 8px 22px rgba(72, 49, 12, 0.06);
        }

        .premium-dashboard .hero-card {
            border: 0;
            border-radius: 22px;
            color: #f8eed7;
            background: linear-gradient(120deg, #0f213b 0%, #1e3a61 55%, #38557e 100%);
            box-shadow: 0 26px 46px rgba(8, 23, 43, 0.26);
            overflow: hidden;
        }

        .premium-dashboard .hero-card::before {
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

        .premium-dashboard .hero-card .card-body {
            position: relative;
            z-index: 2;
        }

        .premium-dashboard .hero-avatar {
            width: 106px;
            height: 106px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid rgba(228, 193, 117, 0.92);
            box-shadow: 0 16px 28px rgba(0, 0, 0, 0.35);
            flex-shrink: 0;
        }

        .premium-dashboard .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 34px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 5px;
            color: #fff4d8;
        }

        .premium-dashboard .hero-id {
            margin: 0 0 10px;
            color: rgba(255, 243, 214, 0.85);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .premium-dashboard .hero-chip {
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

        .premium-dashboard .hero-actions .btn {
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.02em;
            padding: 7px 14px;
        }

        .premium-dashboard .hero-actions .btn-light {
            background: #f9edd0;
            border-color: #f9edd0;
            color: #1d3153;
        }

        .premium-dashboard .hero-actions .btn-outline-light {
            color: #f9edd0;
            border-color: rgba(245, 225, 176, 0.7);
        }

        .premium-dashboard .hero-actions .btn-outline-light:hover {
            color: #1d3153;
            background: #f9edd0;
        }

        .premium-dashboard .hero-actions .btn-buy-product {
            background: linear-gradient(135deg, #f2b138 0%, #cb7d2e 50%, #7d4d1b 100%);
            color: #ffffff;
            border: 1px solid rgba(255, 198, 96, 0.4);
            box-shadow: 0 16px 30px rgba(124, 64, 12, 0.18);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .premium-dashboard .hero-actions .btn-buy-product:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 20px 36px rgba(124, 64, 12, 0.24);
            color: #fff;
        }

        .premium-dashboard .hero-actions .btn-buy-product i {
            transform: translateY(1px);
        }

        .premium-dashboard .hero-panel {
            border-radius: 16px;
            border: 1px solid rgba(235, 206, 144, 0.4);
            background: rgba(255, 239, 204, 0.08);
            padding: 15px;
        }

        .premium-dashboard .hero-panel-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(245, 228, 186, 0.24);
            padding: 7px 0;
        }

        .premium-dashboard .hero-panel-item:last-child {
            border-bottom: 0;
        }

        .premium-dashboard .hero-panel-item span {
            color: rgba(252, 242, 220, 0.86);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .premium-dashboard .hero-panel-item strong {
            color: #ffe3a4;
            font-size: 17px;
            font-weight: 800;
        }

        .premium-dashboard .hero-progress {
            margin-top: 10px;
        }

        .premium-dashboard .hero-progress-track {
            height: 7px;
            border-radius: 999px;
            background: rgba(251, 237, 203, 0.22);
            overflow: hidden;
        }

        .premium-dashboard .hero-progress-track span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, #f3d28e, #d7a552);
        }

        .premium-dashboard .kyc-alert {
            border: 0;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            box-shadow: 0 12px 28px rgba(13, 27, 45, 0.08);
        }

        .premium-dashboard .kyc-alert i {
            margin-right: 8px;
            font-size: 18px;
        }

        .premium-dashboard .kyc-alert-success {
            background: #ebf8ef;
            color: #1f6b3a;
        }

        .premium-dashboard .kyc-alert-info {
            background: #ebf3fb;
            color: #22577f;
        }

        .premium-dashboard .kyc-alert-danger {
            background: #fceff0;
            color: #8d2c38;
        }

        .premium-dashboard .metric-card {
            height: 100%;
            background: #ffffff;
            border: 1px solid #e6dac3;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 12px 26px rgba(14, 31, 50, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .premium-dashboard .metric-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 32px rgba(14, 31, 50, 0.14);
        }

        .premium-dashboard .metric-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #435974;
            font-size: 13px;
            font-weight: 700;
        }

        .premium-dashboard .metric-head i {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f2f6fc;
            color: #1e3a61;
            font-size: 17px;
        }

        .premium-dashboard .metric-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 31px;
            line-height: 1;
            color: #1a2f4e;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .premium-dashboard .metric-progress {
            height: 6px;
            border-radius: 999px;
            background: #ecf1f8;
            overflow: hidden;
        }

        .premium-dashboard .metric-progress span {
            display: block;
            height: 100%;
            border-radius: 999px;
        }

        .premium-dashboard .metric-progress .tone-1 {
            background: linear-gradient(90deg, #213a62, #2d568f);
        }

        .premium-dashboard .metric-progress .tone-2 {
            background: linear-gradient(90deg, #c38b2f, #f1c56f);
        }

        .premium-dashboard .metric-progress .tone-3 {
            background: linear-gradient(90deg, #0f7f5f, #3ab786);
        }

        .premium-dashboard .metric-progress .tone-4 {
            background: linear-gradient(90deg, #6d4a93, #9f7bc7);
        }

        .premium-dashboard .premium-card {
            height: 100%;
            border: 1px solid #e6d9c5;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 14px 30px rgba(11, 28, 49, 0.08);
            overflow: hidden;
        }

        .premium-dashboard .premium-card .card-header {
            border-bottom: 1px solid #ebdfcc;
            background: linear-gradient(180deg, #fffaf1 0%, #f7fbff 100%);
            padding: 13px 16px;
        }

        .premium-dashboard .premium-card .card-header h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px;
            color: #173152;
            margin: 0;
            letter-spacing: 0.03em;
        }

        .premium-dashboard .summary-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .premium-dashboard .summary-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #edf2f8;
            font-size: 13px;
            color: #3f5773;
            font-weight: 700;
        }

        .premium-dashboard .summary-list li:last-child {
            border-bottom: 0;
        }

        .premium-dashboard .summary-list strong {
            color: #1a2f4f;
            font-weight: 800;
        }

        .premium-dashboard .money-block {
            border: 1px solid #e8dcc8;
            border-radius: 13px;
            padding: 12px 13px;
            margin-bottom: 12px;
            background: #fffdf8;
        }

        .premium-dashboard .money-block:last-child {
            margin-bottom: 0;
        }

        .premium-dashboard .money-label {
            display: block;
            margin-bottom: 2px;
            color: #516683;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .premium-dashboard .money-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 29px;
            color: #1b3151;
            line-height: 1;
        }

        .premium-dashboard .money-value.text-profit {
            color: #20714a;
        }

        .premium-dashboard .money-value.text-loss {
            color: #9b3443;
        }

        .premium-dashboard .signal-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .premium-dashboard .signal-card {
            border: 1px solid #eadcc7;
            border-radius: 13px;
            background: #ffffff;
            padding: 14px;
        }

        .premium-dashboard .signal-title {
            color: #49607d;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .premium-dashboard .signal-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 29px;
            line-height: 1;
            color: #1a3151;
            margin: 0;
        }

        .premium-dashboard .action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .premium-dashboard .action-link {
            text-decoration: none;
            color: #1a3355;
            background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #dfe7f2;
            border-radius: 12px;
            padding: 11px 12px;
            font-size: 13px;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            display: flex;
            align-items: center;
        }

        .premium-dashboard .action-link i {
            margin-right: 7px;
            color: #2e4e79;
            font-size: 17px;
        }

        .premium-dashboard .action-link:hover {
            transform: translateY(-2px);
            border-color: #c9aa6f;
            box-shadow: 0 10px 20px rgba(23, 44, 72, 0.1);
            color: #132743;
        }

        .premium-dashboard .health-block {
            border: 1px solid #e7dcc8;
            border-radius: 12px;
            background: #fffdf8;
            padding: 11px 12px;
            margin-bottom: 10px;
        }

        .premium-dashboard .health-block:last-child {
            margin-bottom: 0;
        }

        .premium-dashboard .health-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #435a76;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .premium-dashboard .health-head strong {
            color: #1a3050;
            font-weight: 800;
        }

        .premium-dashboard .health-progress {
            height: 6px;
            border-radius: 999px;
            background: #eaf0f8;
            overflow: hidden;
        }

        .premium-dashboard .health-progress span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, #1d3b64 0%, #c59a52 100%);
        }

        .premium-dashboard .premium-table-wrap .table {
            margin: 0;
        }

        .premium-dashboard .premium-table-wrap thead th {
            background: #f5f8fd;
            color: #48607b;
            border-bottom: 1px solid #e2eaf4;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .premium-dashboard .premium-table-wrap tbody td {
            border-bottom: 1px solid #edf2f8;
            font-size: 13px;
            color: #2d4562;
            white-space: nowrap;
            vertical-align: middle;
        }

        .premium-dashboard .premium-table-wrap tbody tr:last-child td {
            border-bottom: 0;
        }

        .premium-dashboard .premium-table-wrap tbody tr:nth-child(even) td {
            background: #fcfeff;
        }

        .premium-dashboard .referral-box {
            border: 1px dashed #cfb07a;
            background: #fff9ec;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .premium-dashboard #code {
            color: #17304f;
            font-size: 13px;
            font-weight: 700;
            word-break: break-all;
        }

        .premium-dashboard #copyButtonId2 {
            flex-shrink: 0;
            background: linear-gradient(135deg, #173255 0%, #294d7e 100%);
            color: #f8e7bf;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.03em;
            cursor: pointer;
            border: 1px solid #24446f;
        }

        .premium-dashboard #copyButtonId {
            flex-shrink: 0;
            background: linear-gradient(135deg, #173255 0%, #294d7e 100%);
            color: #f8e7bf;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.03em;
            cursor: pointer;
            border: 1px solid #24446f;
        }

        .premium-dashboard .binary-card {
            border: 1px solid #e6d9c5;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 14px 30px rgba(11, 28, 49, 0.08);
            padding: 20px;
            margin-bottom: 24px;
        }

        .premium-dashboard .binary-card h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px;
            color: #173152;
            margin-bottom: 16px;
            letter-spacing: 0.03em;
        }

        .premium-dashboard .binary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .premium-dashboard .binary-item {
            border: 1px solid #eadcc7;
            border-radius: 13px;
            background: linear-gradient(135deg, #fffaf1 0%, #f7fbff 100%);
            padding: 18px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .premium-dashboard .binary-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(11, 28, 49, 0.12);
        }

        .premium-dashboard .binary-item-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .premium-dashboard .binary-item-icon.left-count {
            background: rgba(33, 58, 98, 0.12);
            color: #213a62;
        }

        .premium-dashboard .binary-item-icon.right-count {
            background: rgba(195, 139, 47, 0.12);
            color: #c38b2f;
        }

        .premium-dashboard .binary-item-icon.left-amount {
            background: rgba(15, 127, 95, 0.12);
            color: #0f7f5f;
        }

        .premium-dashboard .binary-item-icon.right-amount {
            background: rgba(109, 74, 147, 0.12);
            color: #6d4a93;
        }

        .premium-dashboard .binary-item-label {
            display: block;
            color: #516683;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 8px;
        }

        .premium-dashboard .binary-item-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            color: #1b3151;
            line-height: 1;
            font-weight: 700;
        }

        @media (max-width: 991.98px) {
            .premium-dashboard .premium-shell {
                padding: 16px;
            }

            .premium-dashboard .hero-title {
                font-size: 29px;
            }
        }

        @media (max-width: 767.98px) {
            .premium-dashboard .page-title {
                font-size: 28px;
            }

            .premium-dashboard .hero-avatar {
                width: 92px;
                height: 92px;
            }

            .premium-dashboard .hero-title {
                font-size: 25px;
            }

            .premium-dashboard .signal-grid,
            .premium-dashboard .action-grid {
                grid-template-columns: 1fr;
            }

            .premium-dashboard .referral-box {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    <div class="container-fluid premium-dashboard">
        <div class="premium-shell">
            <div class="row align-items-center mb-3">
                <div class="col-lg-8">
                    <div class="page-title-box mb-0">
                        <h4 class="page-title">Member Dashboard</h4>
                        <p class="page-subtitle">Classic premium summary of your business, team and wallet activity.</p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-2 mt-lg-0">
                    <span class="date-pill"><i class="mdi mdi-calendar-month-outline me-1"></i>{{ date('d M Y') }}</span>
                </div>
            </div>
            @if (isset($dashMsg) && $dashMsg->count())
                <div class="premium-announcement mb-3">
                    <marquee>
                        <strong>
                            @foreach ($dashMsg as $item)
                                <span class="me-4">{{ $item['message'] }}</span>
                            @endforeach
                        </strong>
                    </marquee>
                </div>
            @endif
            <div class="card hero-card mb-4">
                <div class="card-body p-4 p-xl-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-xl-7">
                            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap">
                                @if ($data['profile_image'] != '')
                                    <img src="{{ asset('uploads') }}/{{ $data['profile_image'] }}"
                                        class="rounded-circle hero-avatar" alt="profile" width="32" />
                                @else
                                    <img src="{{ asset('uploads/avatar.jpg') }}" class="rounded-circle hero-avatar"
                                        alt="profile" width="32" />
                                @endif
                                <div class="ms-sm-4 mt-3 mt-sm-0">
                                    <h2 class="hero-title">{{ $data['name'] }}</h2>
                                    <p class="hero-id">Member ID: {{ $data['memberid'] }}</p>
                                    <div class="d-flex flex-wrap">
                                        <span class="hero-chip"><i class="mdi mdi-account-check-outline me-1"></i>Status:
                                            {{ $statusLabel }}</span>
                                        <span class="hero-chip"><i class="mdi mdi-medal-outline me-1"></i>Rank:
                                            {{ $rankLabel }}</span>
                                        <span class="hero-chip"><i class="mdi mdi-shield-check-outline me-1"></i>KYC:
                                            {{ $kycStatus }}</span>
                                        <span class="hero-chip"><i class="mdi mdi-account-cog-outline me-1"></i>Profile:
                                            {{ $profileCompletion }}%</span>
                                    </div>
                                    <div class="hero-actions mt-2">
                                        <a href="{{ url('/member/profile/profile-details') }}"
                                            class="btn btn-light btn-sm me-2 mb-2">
                                            <i class="mdi mdi-account-edit-outline me-1"></i>Edit Profile
                                        </a>
                                        <a href="{{ url('/member/member-kyc') }}"
                                            class="btn btn-outline-light btn-sm me-2 mb-2">
                                            <i class="mdi mdi-file-document-edit-outline me-1"></i>Update KYC
                                        </a>
                                        <a href="{{ url('/member/account-activation') }}"
                                            class="btn btn-buy-product btn-sm mb-2">
                                            <i class="mdi mdi-cart-outline me-1"></i>Buy Products
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="hero-panel">
                                <div class="hero-panel-item">
                                    <span>Total Wallet</span>
                                    <strong>Rs. {{ number_format($totalWallet, 2) }}</strong>
                                </div>
                                <div class="hero-panel-item">
                                    <span>Member Since</span>
                                    <strong>{{ $memberSince }}</strong>
                                </div>
                                <div class="hero-panel-item">
                                    <span>Activated On</span>
                                    <strong>{{ $activationDate }}</strong>
                                </div>
                                <div class="hero-progress">
                                    <div class="d-flex justify-content-between mb-1"
                                        style="font-size:12px;font-weight:700;color:#f8e4b4;">
                                        <span>Profile Completion</span>
                                        <span>{{ $profileCompletion }}%</span>
                                    </div>
                                    <div class="hero-progress-track">
                                        <span style="width: {{ $profileCompletion }}%;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($data['kyc_status'] == 'Verified')
                <div class="kyc-alert kyc-alert-success mb-4">
                    <i class="mdi mdi-check-decagram-outline"></i>
                    Your KYC has been verified and your compliance profile is complete.
                </div>
            @elseif ($data['kyc_status'] == 'Submitted')
                <div class="kyc-alert kyc-alert-info mb-4">
                    <i class="mdi mdi-timer-sand-empty"></i>
                    Your KYC has been submitted and is currently under review.
                </div>
            @else
                <div class="kyc-alert kyc-alert-danger mb-4">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    Your KYC is pending. Submit your documents to unlock smooth withdrawals and upgrades.
                </div>
            @endif
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>Main Wallet</span>
                            <i class="mdi mdi-wallet-outline"></i>
                        </div>
                        <h3 class="metric-value">Rs. {{ number_format($mainWallet, 2) }}</h3>
                        <div class="metric-progress"><span class="tone-1" style="width: {{ $mainWalletPercent }}%;"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>Purchase Wallet</span>
                            <i class="mdi mdi-cart-outline"></i>
                        </div>
                        <h3 class="metric-value">Rs. {{ number_format($purchaseWallet, 2) }}</h3>
                        <div class="metric-progress"><span class="tone-2"
                                style="width: {{ $purchaseWalletPercent }}%;"></span></div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>My Directs</span>
                            <i class="mdi mdi-account-multiple-outline"></i>
                        </div>
                        <h3 class="metric-value">{{ $data['downline'] }}</h3>
                        <div class="metric-progress"><span class="tone-3"
                                style="width: {{ min(100, ($data['downline'] ?? 0) * 10) }}%;"></span></div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card">
                        <div class="metric-head">
                            <span>Total Team</span>
                            <i class="mdi mdi-family-tree"></i>
                        </div>
                        <h3 class="metric-value">{{ $totalTeam }}</h3>
                        <div class="metric-progress"><span class="tone-4"
                                style="width: {{ $totalTeam > 0 ? 100 : 0 }}%;"></span></div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-xl-7">
                    <div class="card premium-card">
                        <div class="card-header">
                            <h5>Member Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="summary-list">
                                <li><span>Member ID</span><strong>{{ $data['memberid'] }}</strong></li>
                                <li><span>Sponsor ID</span><strong>{{ $data['sponsorid'] }}</strong></li>
                                <li><span>Rank</span><strong>{{ $rankLabel }}</strong></li>
                                <li><span>Club</span><strong>Club {{ $data['club_status'] ?? '---' }}</strong></li>
                                <li><span>Package</span><strong>{{ $data['package'] ?: 0 }}</strong></li>
                                <li><span>My Team</span><strong>{{ $totalTeam }}</strong></li>
                                <li><span>Joining Date</span><strong>{{ $memberSince }}</strong></li>
                                <li><span>Activation Date</span><strong>{{ $activationDate }}</strong></li>
                                <li><span>My Business</span><strong>Rs.
                                        {{ number_format((float) $data['self_biz'], 2) }}</strong></li>
                                <li><span>Team Business</span><strong>Rs.
                                        {{ number_format($data['team_biz'], 2) }}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card premium-card">
                        <div class="card-header">
                            <h5>Cash Movement</h5>
                        </div>
                        <div class="card-body">
                            <div class="money-block">
                                <span class="money-label">Fund Imported</span>
                                <h4 class="money-value">Rs. {{ number_format((float) $fundImported, 2) }}</h4>
                            </div>
                            <div class="money-block">
                                <span class="money-label">Total Withdrawal</span>
                                <h4 class="money-value text-loss">Rs. {{ number_format((float) $withdrawAmount, 2) }}</h4>
                            </div>
                            <div class="money-block">
                                <span class="money-label">Today Withdrawal</span>
                                <h4 class="money-value text-loss">Rs. {{ number_format((float) $todayWithdraw, 2) }}</h4>
                            </div>
                            <div class="money-block">
                                <span class="money-label">Total Purchased Product</span>
                                <h4 class="money-value">
                                    {{ number_format((int) $totalPurchasedProducts) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="binary-card">
                <h5><i class="mdi mdi-sitemap me-2"></i>Binary Structure</h5>
                <div class="binary-grid">
                    <div class="binary-item">
                        <div class="binary-item-icon left-count">
                            <i class="mdi mdi-account-arrow-left"></i>
                        </div>
                        <span class="binary-item-label">Left Count</span>
                        <div class="binary-item-value">{{ $binaryDetails['left_count'] }}</div>
                    </div>
                    <div class="binary-item">
                        <div class="binary-item-icon right-count">
                            <i class="mdi mdi-account-arrow-right"></i>
                        </div>
                        <span class="binary-item-label">Right Count</span>
                        <div class="binary-item-value">{{ $binaryDetails['right_count'] }}</div>
                    </div>
                    <div class="binary-item">
                        <div class="binary-item-icon left-amount">
                            <i class="mdi mdi-cash-multiple"></i>
                        </div>
                        <span class="binary-item-label">Left SP</span>
                        <div class="binary-item-value"> {{ $binaryDetails['left_amount'] }}
                        </div>
                    </div>
                    <div class="binary-item">
                        <div class="binary-item-icon right-amount">
                            <i class="mdi mdi-cash-multiple"></i>
                        </div>
                        <span class="binary-item-label">Right SP</span>
                        <div class="binary-item-value"> {{ $binaryDetails['right_amount'] }}
                        </div>
                    </div>
                </div>
            </div>
            <h3>Income Summary</h3>
            <div class="row g-3 mb-4">
                <!--<div class="col-md-6 col-xl-4">-->
                <!--    <div class="signal-card">-->
                <!--        <div class="signal-title">Level Income</div>-->
                <!--        <p class="signal-value">₹ {{ number_format((float) levelIncomeSum($memberId), 2) }}</p>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-md-6 col-xl-6">
                    <div class="signal-card">
                        <div class="signal-title">Binary Matching Income</div>
                        <p class="signal-value">₹ {{ number_format((float) binaryIncomeSum($memberId), 2) }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="signal-card">
                        <div class="signal-title">Sales Bonus Income</div>
                        <p class="signal-value">₹ {{ number_format((float) salesBonusIncomeSum($memberId), 2) }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="signal-card">
                        <div class="signal-title">Club Income</div>
                        <p class="signal-value">₹ {{ number_format((float) clubIncomeSum($memberId)) }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="signal-card">
                        <div class="signal-title">Total Reward</div>
                        <p class="signal-value">{{ totalRewardIncome($data['memberid']) }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="signal-card">
                        <div class="signal-title"> Total Travel Fund</div>
                        <p class="signal-value">{{ memTotTravelFund($data['memberid']) }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-xl-7">
                    <div class="card premium-card">
                        <div class="card-header">
                            <h5>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="action-grid">
                                <a class="action-link" href="{{ url('member/account-activation') }}"><i
                                        class="mdi mdi-flash"></i>Account Activation</a>
                                <a class="action-link" href="{{ url('member/deposit/fund-requests') }}"><i
                                        class="mdi mdi-bank-transfer-in"></i>Add Fund Request</a>
                                <!--<a class="action-link" href="{{ url('member/wallet/main-wallet') }}"><i-->
                                <!--        class="mdi mdi-wallet-plus-outline"></i>Wallet / Withdraw</a>-->
                                <a class="action-link" href="{{ url('member/team/direct-partner') }}"><i
                                        class="mdi mdi-account-group-outline"></i>Direct Team</a>
                                <a class="action-link" href="{{ url('member/team/geneology') }}"><i
                                        class="mdi mdi-graph-outline"></i>Geneology</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="card premium-card">
                        <div class="card-header">
                            <h5>Account Health</h5>
                        </div>
                        <div class="card-body">
                            <div class="health-block">
                                <div class="health-head">
                                    <span>Profile Completion</span>
                                    <strong>{{ $profileCompletion }}%</strong>
                                </div>
                                <div class="health-progress">
                                    <span style="width: {{ $profileCompletion }}%;"></span>
                                </div>
                            </div>
                            <div class="health-block">
                                <div class="health-head">
                                    <span>KYC Status</span>
                                    <strong>{{ $kycStatus }}</strong>
                                </div>
                            </div>
                            <div class="health-block">
                                <div class="health-head">
                                    <span>Member Status</span>
                                    <strong>{{ $statusLabel }}</strong>
                                </div>
                            </div>
                            <div class="health-block">
                                <div class="health-head">
                                    <span>Activation Date</span>
                                    <strong>{{ $activationDate }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card premium-card mb-4">
                <div class="card-header">
                    <h5>Recent Wallet Activity</h5>
                </div>
                <div class="card-body table-responsive premium-table-wrap">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Wallet Type</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Particular</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentWalletTransfers as $wallet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $wallet->walletType ?: '-' }}</td>
                                    <td>Rs. {{ number_format((float) $wallet->debit, 2) }}</td>
                                    <td>Rs. {{ number_format((float) $wallet->credit, 2) }}</td>
                                    <td>Rs. {{ number_format((float) $wallet->balance, 2) }}</td>
                                    <td>{{ $wallet->particular ?: '-' }}</td>
                                    <td>{{ !empty($wallet->created_at) ? date('d-m-Y h:i A', strtotime($wallet->created_at)) : '--' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-3">No wallet activity found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card premium-card">
                <div class="card-header">
                    <h5>Referral Link</h5>
                </div>
                <div class="card-body">
                    <div class="alert bg-success text-white text-center" role="alert" style="display:none"
                        id="rcode">
                        <strong>Copied!</strong> Referral link copied successfully
                    </div>
                    <div class="referral-box">
                        <span id="code">{{ url('member/register/' . $data['memberid'] . '/Left') }}</span>
                        <span id="copyButtonId">
                            <i class="mdi mdi-content-copy me-1"></i>
                            <span id="msgText">Copy Text</span>
                        </span>
                    </div>
                    <div class="referral-box mt-3">
                        <span id="code2">{{ url('member/register/' . $data['memberid'] . '/Right') }}</span>
                        <span id="copyButtonId2">
                            <i class="mdi mdi-content-copy me-1"></i>
                            <span id="msgText2">Copy Text</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
