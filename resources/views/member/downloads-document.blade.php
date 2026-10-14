@extends('member.layouts.main')
@section('title', 'Downloads Document')
@section('container')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('member/dashboard') }}" style="text-decoration: none">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Downloads Document</li>
                            </ol>
                        </nav>
                    </div>
                    <h4 class="page-title">Downloads Document</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if (session('failedMsg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline me-2"></i> {{ session('failedMsg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Hero Banner Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 14px; box-shadow: 0 4px 16px rgba(0,0,0,0.04) !important;">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px; border-radius: 12px; background: rgba(11, 78, 57, 0.08); color: #0b4e39; font-size: 24px;">
                                        <i class="uil-file-download-alt"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold mb-0" style="font-family: Cormorant Garamond, Georgia, serif; font-size: 1.65rem; color: #0e1e2d !important; letter-spacing: 0.3px;">
                                            Official Member Documents &amp; Resources
                                        </h4>
                                        <span class="small" style="color: #64748b !important; font-weight: 500;">Amberveda Wellness Official Document Repository</span>
                                    </div>
                                </div>
                                <p class="mb-0 ps-1" style="font-size: 0.93rem; line-height: 1.5; color: #475569 !important;">
                                    Access, review, and download official Amberveda corporate documents, business compensation models, contracts, and product literature.
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <span class="badge px-3 py-2" style="background: rgba(212, 175, 55, 0.12) !important; color: #996515 !important; border: 1px solid rgba(212, 175, 55, 0.35) !important; font-size: 0.85rem; border-radius: 30px; font-weight: 600;">
                                    <i class="mdi mdi-shield-check-outline me-1"></i> Amberveda Certified
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Cards Grid -->
        <div class="row">
            @foreach ($documents as $doc)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100 border shadow-sm document-card" style="border-radius: 14px; border: 1px solid #e2e8f0 !important; background: #ffffff !important; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        <div class="card-body d-flex flex-column p-4">
                            <!-- Card Header: Icon & Status Badge -->
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="doc-icon-box d-flex align-items-center justify-content-center"
                                     style="width: 54px; height: 54px; border-radius: 12px; background: {{ $doc['badge_color'] ?? '#f8fafc' }}; color: {{ $doc['icon_color'] ?? '#475569' }}; font-size:26px; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.04);">
                                    <i class="mdi {{ $doc['icon'] }}"></i>
                                </div>
                                <div>
                                    @if ($doc['is_uploaded'])
                                       <span class="badge px-2.5 py-1" style="background: #dcfce7 !important; color: #15803d !important; border: 1px solid #bbf7d0 !important; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                           <i class="mdi mdi-check-circle me-1"></i>Available
                                       </span>
                                    @else
                                       <span class="badge px-2.5 py-1" style="background: #fef3c7 !important; color: #b45309 !important; border: 1px solid #fde68a !important; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                           <i class="mdi mdi-clock-alert-outline me-1"></i>Document Not Uploaded Yet
                                       </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Document Order & Title -->
                            <div class="mb-2">
                                <span class="fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.6px; color: #94a388 !important;">DOCUMENT #{{ $doc['order'] }}</span>
                               <h5 class="fw-bold mt-1 mb-2" style="font-size: 1.15rem; line-height: 1.35; color: #0e1e2d !important;">
                                    {{ $doc['title'] }}
                               </h5>
                               <p class="small mb-3" style="line-height: 1.5; min-height: 42px; color: #64748b !important;">
                                   {{ $doc['description'] }}
                               </p>
                            </div>

                            <!-- Meta Info Row -->
                            <div class="p-2 mb-3 rounded-2" style="background: #f8fafc !important; border: 1px solid #edf2f7 !important; font-size: 0.8rem;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span style="color: #64748b !important;"><i class="mdi mdi-file-outline me-1"></i> Format: <strong style="color: #334155 !important;">{{ $doc['file_type'] }}</strong></span>
                                    @if ($doc['is_uploaded'] && !empty($doc['file_size']))
                                       <span style="color: #64748b !important;"><i class="mdi mdi-harddisk me-1"></i> Size: <strong style="color: #334155 !important;">{{ $doc['file_size'] }}</strong></span>
                                    @else
                                       <span style="color: #d97706 !important; font-weight: 600;"><i class="mdi mdi-cloud-upload-outline me-1"></i> Pending Upload</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Action Buttons -->
                            <div class="mt-auto pt-2 border-top">
                                <div class="d-flex gap-2">
                                    @if ($doc['is_uploaded'])
                                       <a href="{{ route('member.viewDocument', $doc['slug']) }}"
                                          target="_blank"
                                          class="btn btn-outline-primary btn-sm flex-fill fw-semibold py-2 d-inline-flex align-items-center justify-content-center"
                                          style="border-radius: 8px;">
                                           <i class="mdi mdi-eye-outline me-1"></i> View
                                       </a>
                                       <a href="{{ route('member.downloadDocument', $doc['slug']) }}"
                                          class="btn btn-primary btn-sm flex-fill fw-semibold py-2 text-white d-inline-flex align-items-center justify-content-center"
                                          style="border-radius: 8px; background-color: #0b4e39 !important; border-color: #0b4e39 !important;">
                                           <i class="mdi mdi-download-outline me-1"></i> Download
                                       </a>
                                    @else
                                       <button type="button"
                                               class="btn btn-outline-secondary btn-sm flex-fill fw-semibold py-2"
                                               style="border-radius: 8px; opacity: 0.6; cursor: not-allowed;"
                                              disabled
                                              title="Document not uploaded yet">
                                           <i class="mdi mdi-eye-off-outline me-1"></i> View
                                       </button>
                                       <button type="button"
                                               class="btn btn-secondary btn-sm flex-fill fw-semibold py-2"
                                               style="border-radius: 8px; opacity: 0.6; cursor: not-allowed;"
                                              disabled
                                              title="Document not uploaded yet">
                                           <i class="mdi mdi-download-off-outline me-1"></i> Download
                                       </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

<style>
    .document-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        border-color: #cbd5e1 !important;
    }
</style>
@endsection
