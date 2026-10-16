@extends('member.layouts.main')
@section('title', 'Opportunity')
@section('container')

    <div class="container-fluid px-2 px-sm-3 px-md-4">
        <!-- Page Title & Breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('member/dashboard') }}" style="text-decoration: none">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Opportunity</li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Opportunity</h4>
                </div>
            </div>
        </div>

        @if (session('failedMsg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline me-2"></i> {{ session('failedMsg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Hero Banner Header -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 14px; box-shadow: 0 4px 16px rgba(0,0,0,0.04) !important;">
                    <div class="card-body p-3 p-sm-4">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-7 col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-2 me-sm-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border-radius: 12px; background: rgba(11, 78, 57, 0.08); color: #0b4e39; font-size: 22px;">
                                        <i class="uil-briefcase-alt"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="fw-bold mb-0 text-break" style="font-family: Cormorant Garamond, Georgia, serif; font-size: clamp(1.2rem, 3.5vw, 1.65rem); color: #0e1e2d !important; letter-spacing: 0.3px; line-height: 1.25;">
                                            Business Opportunity &amp; Compensation Model
                                        </h4>
                                        <span class="small" style="color: #64748b !important; font-weight: 500; font-size: clamp(0.75rem, 2vw, 0.85rem);">Official Direct Selling Earning Blueprint</span>
                                    </div>
                                </div>
                                <p class="mb-0 ps-1" style="font-size: clamp(0.85rem, 2vw, 0.93rem); line-height: 1.55; color: #475569 !important;">
                                    Discover the rewarding Amberveda Wellness direct selling compensation plan. Review rank recognition, sales point matching, retail profit margins, and leadership incentives in your preferred language.
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-5 col-12 text-md-end mt-3 mt-md-0">
                                <span class="badge px-3 py-2 text-wrap" style="background: rgba(212, 175, 55, 0.12) !important; color: #996515 !important; border: 1px solid rgba(212, 175, 55, 0.35) !important; font-size: 0.82rem; border-radius: 30px; font-weight: 600;">
                                    <i class="mdi mdi-shield-check-outline me-1"></i> Amberveda Official Plan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business Plan Main Professional Card -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11 col-12">
                <div class="card border-0 shadow-sm opportunity-card" style="border-radius: 16px; border: 1px solid #e2e8f0 !important; background: #ffffff !important; overflow: hidden; box-shadow: 0 8px 24px rgba(14, 30, 45, 0.06) !important;">
                    
                    <!-- Decorative Top Header Strip -->
                    <div style="height: 6px; background: linear-gradient(90deg, #0b4e39 0%, #1e3a63 50%, #c9aa6f 100%);"></div>

                    <div class="card-body p-3 p-sm-4 p-md-5">
                        <!-- Card Header & Badge -->
                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
                            <div class="d-flex align-items-center gap-2 gap-sm-3 min-w-0">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px; border-radius: 14px; background: rgba(220, 38, 38, 0.08); color: #dc2626; font-size: 28px; border: 1px solid rgba(220, 38, 38, 0.18);">
                                    <i class="mdi mdi-file-pdf-box"></i>
                                </div>
                                <div class="min-w-0">
                                    <span class="text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.8px; color: #94a388 !important;">OPPORTUNITY RESOURCE</span>
                                    <h3 class="fw-bold mb-1 text-break" style="color: #0e1e2d; font-family: Cormorant Garamond, Georgia, serif; font-size: clamp(1.35rem, 4vw, 1.75rem); letter-spacing: 0.3px;">
                                        Business Plan
                                    </h3>
                                    <span class="text-muted small d-block" style="font-size: clamp(0.75rem, 2vw, 0.82rem);">Official Amberveda Wellness Private Limited Business Compensation Plan</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                @if ($opportunity['en']['is_available'] && $opportunity['hi']['is_available'])
                                    <span class="badge px-3 py-2" style="background: #dcfce7 !important; color: #15803d !important; border: 1px solid #bbf7d0 !important; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                        <i class="mdi mdi-check-circle me-1"></i> Available in 2 Languages
                                    </span>
                                @else
                                    <span class="badge px-3 py-2" style="background: #eff6ff !important; color: #1d4ed8 !important; border: 1px solid #bfdbfe !important; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                        <i class="mdi mdi-translate me-1"></i> Multilingual Opportunity
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Short Clean Presentation -->
                        <div class="mb-4">
                            <p class="text-secondary" style="font-size: clamp(0.88rem, 2vw, 0.98rem); line-height: 1.65; color: #475569 !important;">
                                Welcome to the Amberveda Business Plan presentation. This document provides direct sellers with a comprehensive overview of our business philosophy, retail profit margins (up to 25%), mentorship incentives, Sales Point (SP) binary matching bonuses, rank recognition achievements, and monthly royalty clubs.
                            </p>

                            <!-- Plan Highlights Feature Grid -->
                            <div class="row g-2 g-sm-3 my-2">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="p-3 rounded-3 h-100" style="background: #f8fafc; border: 1px solid #edf2f7;">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <i class="mdi mdi-checkbox-marked-circle-outline text-success fs-5 flex-shrink-0"></i>
                                            <strong class="text-dark small">Retail Profits &amp; DP</strong>
                                        </div>
                                        <p class="mb-0 text-muted" style="font-size: 0.8rem; line-height: 1.4;">
                                            Lucrative margins on authentic Ayurvedic formulations.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="p-3 rounded-3 h-100" style="background: #f8fafc; border: 1px solid #edf2f7;">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <i class="mdi mdi-chart-timeline-variant-shimmer text-primary fs-5 flex-shrink-0"></i>
                                            <strong class="text-dark small">SP Matching Incentive</strong>
                                        </div>
                                        <p class="mb-0 text-muted" style="font-size: 0.8rem; line-height: 1.4;">
                                            Structured 1:2 and 2:1 ratio binary sales point compensation.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="p-3 rounded-3 h-100" style="background: #f8fafc; border: 1px solid #edf2f7;">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <i class="mdi mdi-crown-outline text-warning fs-5 flex-shrink-0"></i>
                                            <strong class="text-dark small">Royalty &amp; Leadership</strong>
                                        </div>
                                        <p class="mb-0 text-muted" style="font-size: 0.8rem; line-height: 1.4;">
                                            Turnover-based monthly club rewards for top performers.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Language Selection & Action Buttons Section -->
                        <div class="p-3 p-sm-4 rounded-3 mb-2" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px;">
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-3">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark" style="font-size: clamp(0.95rem, 2.5vw, 1.05rem);">
                                        <i class="mdi mdi-book-open-page-variant me-1 text-primary"></i>
                                        Select Business Plan Language
                                    </h6>
                                    <span class="text-muted small" style="font-size: clamp(0.75rem, 2vw, 0.82rem);">
                                        Click below to view the official PDF document in a new browser tab.
                                    </span>
                                </div>
                                <div class="text-sm-end flex-shrink-0">
                                    <span class="badge" style="background: rgba(11, 78, 57, 0.1); color: #0b4e39; font-size: 0.78rem; font-weight: 600;">
                                        <i class="mdi mdi-eye-check-outline me-1"></i> In-Browser Document Viewer
                                    </span>
                                </div>
                            </div>

                            <!-- The Two Requested Language Buttons / Cards -->
                            <div class="row g-3">
                                <!-- 1. English Business Plan -->
                                <div class="col-12 col-md-6">
                                    <div class="card h-100 border shadow-none mb-0 opportunity-lang-card" style="border-radius: 12px; border: 1px solid #e2e8f0 !important; background: #ffffff;">
                                        <div class="card-body p-3 p-sm-4 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                                    <div class="d-flex align-items-center min-w-0 flex-grow-1">
                                                        <div class="flex-shrink-0 me-2.5 me-sm-3 d-flex align-items-center justify-content-center"
                                                             style="width: 44px; height: 44px; border-radius: 10px; background: rgba(11, 78, 57, 0.08); color: #0b4e39; font-size: 22px;">
                                                            <i class="mdi mdi-file-pdf-box"></i>
                                                        </div>
                                                        <div class="min-w-0">
                                                            <h5 class="fw-bold mb-0 text-dark" style="font-size: clamp(0.95rem, 2.2vw, 1.05rem); line-height: 1.3;">English Business Plan</h5>
                                                            <span class="text-muted small" style="font-size: 0.78rem;">English Language Edition</span>
                                                        </div>
                                                    </div>
                                                    @if ($opportunity['en']['is_available'])
                                                        <span class="badge px-2.5 py-1.5 flex-shrink-0" style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                            <i class="mdi mdi-check-circle me-1"></i> Ready
                                                        </span>
                                                    @else
                                                        <span class="badge px-2.5 py-1.5 flex-shrink-0" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                            <i class="mdi mdi-clock-outline me-1"></i> Pending
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="p-2 p-sm-2.5 mb-3 rounded-2" style="background: #f8fafc; border: 1px solid #edf2f7; font-size: 0.8rem; color: #64748b;">
                                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                                        <span><i class="mdi mdi-file-document-outline me-1 text-primary"></i> Format: <strong class="text-dark">PDF Document</strong></span>
                                                        <span><i class="mdi mdi-harddisk me-1 text-primary"></i> Size: <strong class="text-dark">{{ $opportunity['en']['file_size'] ?? '223 KB' }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                @if ($opportunity['en']['is_available'])
                                                    <a href="{{ $opportunity['en']['view_url'] }}"
                                                       target="_blank"
                                                       rel="noopener noreferrer"
                                                       class="btn w-100 py-2.5 px-3 fw-semibold d-flex align-items-center justify-content-center text-white lang-action-btn"
                                                       style="background-color: #0b4e39 !important; border-color: #0b4e39 !important; border-radius: 8px; font-size: clamp(0.88rem, 2vw, 0.95rem); min-height: 44px; box-shadow: 0 2px 6px rgba(11, 78, 57, 0.2);">
                                                        <i class="mdi mdi-eye-outline me-2 fs-5 flex-shrink-0"></i>
                                                        <span>English Business Plan</span>
                                                        <i class="mdi mdi-open-in-new ms-2 small flex-shrink-0"></i>
                                                    </a>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-secondary w-100 py-2.5 px-3 fw-semibold d-flex align-items-center justify-content-center"
                                                            style="border-radius: 8px; opacity: 0.7; cursor: not-allowed; font-size: clamp(0.85rem, 2vw, 0.92rem); min-height: 44px;"
                                                            disabled>
                                                        <i class="mdi mdi-clock-alert-outline me-1 flex-shrink-0"></i> Document Not Uploaded Yet
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Hindi Business Plan -->
                                <div class="col-12 col-md-6">
                                    <div class="card h-100 border shadow-none mb-0 opportunity-lang-card" style="border-radius: 12px; border: 1px solid #e2e8f0 !important; background: #ffffff;">
                                        <div class="card-body p-3 p-sm-4 d-flex flex-column justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                                    <div class="d-flex align-items-center min-w-0 flex-grow-1">
                                                        <div class="flex-shrink-0 me-2.5 me-sm-3 d-flex align-items-center justify-content-center"
                                                             style="width: 44px; height: 44px; border-radius: 10px; background: rgba(20, 41, 71, 0.08); color: #142947; font-size: 22px;">
                                                            <i class="mdi mdi-translate"></i>
                                                        </div>
                                                        <div class="min-w-0">
                                                            <h5 class="fw-bold mb-0 text-dark" style="font-size: clamp(0.95rem, 2.2vw, 1.05rem); line-height: 1.3;">Hindi Business Plan</h5>
                                                            <span class="text-muted small" style="font-size: 0.78rem;">हिंदी संस्करण</span>
                                                        </div>
                                                    </div>
                                                    @if ($opportunity['hi']['is_available'])
                                                        <span class="badge px-2.5 py-1.5 flex-shrink-0" style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                            <i class="mdi mdi-check-circle me-1"></i> Ready
                                                        </span>
                                                    @else
                                                        <span class="badge px-2.5 py-1.5 flex-shrink-0" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                            <i class="mdi mdi-clock-outline me-1"></i> Pending
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="p-2 p-sm-2.5 mb-3 rounded-2" style="background: #f8fafc; border: 1px solid #edf2f7; font-size: 0.8rem; color: #64748b;">
                                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                                        <span><i class="mdi mdi-file-document-outline me-1 text-primary"></i> Format: <strong class="text-dark">PDF Document</strong></span>
                                                        <span><i class="mdi mdi-harddisk me-1 text-primary"></i> Size: <strong class="text-dark">{{ $opportunity['hi']['file_size'] ?? '270 KB' }}</strong></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                @if ($opportunity['hi']['is_available'])
                                                    <a href="{{ $opportunity['hi']['view_url'] }}"
                                                       target="_blank"
                                                       rel="noopener noreferrer"
                                                       class="btn w-100 py-2.5 px-3 fw-semibold d-flex align-items-center justify-content-center text-white lang-action-btn"
                                                       style="background-color: #142947 !important; border-color: #142947 !important; border-radius: 8px; font-size: clamp(0.88rem, 2vw, 0.95rem); min-height: 44px; box-shadow: 0 2px 6px rgba(20, 41, 71, 0.2);">
                                                        <i class="mdi mdi-eye-outline me-2 fs-5 flex-shrink-0"></i>
                                                        <span>Hindi Business Plan</span>
                                                        <i class="mdi mdi-open-in-new ms-2 small flex-shrink-0"></i>
                                                    </a>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-secondary w-100 py-2.5 px-3 fw-semibold d-flex align-items-center justify-content-center"
                                                            style="border-radius: 8px; opacity: 0.7; cursor: not-allowed; font-size: clamp(0.85rem, 2vw, 0.92rem); min-height: 44px;"
                                                            disabled>
                                                        <i class="mdi mdi-clock-alert-outline me-1 flex-shrink-0"></i> Document Not Uploaded Yet
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 pt-2 border-top d-flex align-items-center justify-content-between flex-wrap gap-2 text-muted" style="font-size: 0.78rem;">
                                <div>
                                    <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                    Clicking an available language button opens the document in a new browser tab for viewing without forced download.
                                </div>
                                <div class="text-muted">
                                    Format: <strong>PDF Document</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

<style>
    .opportunity-card {
        max-width: 1100px;
        margin: 0 auto;
        box-shadow: 0 8px 24px rgba(14, 30, 45, 0.06) !important;
    }
    .opportunity-lang-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .opportunity-lang-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06) !important;
        border-color: #cbd5e1 !important;
    }
    .lang-action-btn {
        transition: opacity 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }
    .lang-action-btn:hover {
        opacity: 0.92;
        transform: translateY(-1px);
    }
    .lang-action-btn:active {
        transform: translateY(0);
    }

    /* Responsive adjustments across mobile, tablet, laptop & desktop */
    @media (max-width: 575.98px) {
        .page-title-box {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        .page-title-box .page-title-right {
            float: none !important;
            width: 100%;
        }
        .page-title-box .breadcrumb {
            font-size: 0.78rem;
        }
        .opportunity-lang-card .card-body {
            padding: 0.85rem !important;
        }
        .lang-action-btn {
            font-size: 0.88rem !important;
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }

    @media (min-width: 576px) and (max-width: 767.98px) {
        .lang-action-btn {
            font-size: 0.92rem !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        /* Tablet Portrait: Ensure clean layout side by side */
        .opportunity-lang-card .card-body {
            padding: 1rem !important;
        }
        .lang-action-btn {
            font-size: 0.88rem !important;
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }

    @media (min-width: 992px) {
        /* Laptop & Desktop */
        .lang-action-btn {
            font-size: 0.95rem !important;
        }
    }
</style>
@endsection
