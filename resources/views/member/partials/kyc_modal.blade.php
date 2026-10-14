<!-- KYC VERIFICATION MODAL POPUP (STAGE 3) -->
<!-- Matches exact inputs from Member Panel Profile Section KYC (resources/views/member/profile/kyc.blade.php) -->
<div class="modal fade" id="kycModal" tabindex="-1" aria-labelledby="kycModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content kyc-modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <!-- Modal Header -->
            <div class="modal-header kyc-modal-header text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #10223d 0%, #17345b 100%); border-bottom: 2px solid #c9aa6f; padding: 18px 24px;">
                <div class="d-flex align-items-center gap-3">
                    <div class="kyc-header-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(201, 170, 111, 0.2); border: 1.5px solid #c9aa6f;">
                        <i class="fa-solid fa-address-card" style="color: #f7e2b7; font-size: 20px;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold mb-0 text-white" id="kycModalLabel" style="font-family: Georgia, serif; letter-spacing: 0.5px;">
                            KYC Verification Form
                        </h5>
                        <p class="mb-0 small text-white-50">Stage 3 of 4: Direct Seller Verification &amp; Bank Details</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseKycModal"></button>
            </div>

            <!-- Agreement Accepted Status Notice -->
            <div class="kyc-status-bar py-2 px-3 border-bottom d-flex align-items-center justify-content-between" style="background: #eef7ee; border-color: #c7e6c7 !important;">
                <div class="d-flex align-items-center gap-2 text-success small fw-semibold">
                    <i class="fa-solid fa-circle-check fs-6 text-success"></i>
                    <span>E-Contract Agreement Accepted: Direct Seller covenants recorded.</span>
                </div>
                <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 text-primary small fw-bold" id="btnReopenContractFromBar">
                    <i class="fa-solid fa-file-contract me-1"></i> View Agreement
                </button>
            </div>

            <!-- Modal Body (Scrollable Form Fields) -->
            <div class="modal-body kyc-modal-body p-3 p-md-4" style="background: #f8fafc;">
                <!-- 1. Bank Details -->
                <div class="kyc-section-card mb-3 bg-white rounded-3 shadow-sm border">
                    <div class="kyc-section-header px-3 py-2 border-bottom d-flex align-items-center gap-2" style="background: #f1f5f9;">
                        <i class="fa-solid fa-building-columns" style="color: #142947;"></i>
                        <h6 class="mb-0 fw-bold text-uppercase" style="color: #142947; font-size: 13px; letter-spacing: 0.5px;">
                            1. Bank Details
                        </h6>
                    </div>
                    <div class="p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="bank">
                                    Bank Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input" name="bank" id="bank" placeholder="Enter Bank Name" required>
                                <div class="invalid-feedback">Bank Name is required.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="holder">
                                    Holder Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input" name="holder" id="holder" placeholder="Enter Holder Name" required>
                                <div class="invalid-feedback">Holder Name is required.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="ifsc">
                                    IFSC Code <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input text-uppercase" name="ifsc" id="ifsc" maxlength="11" placeholder="Enter IFSC Code" required>
                                <div class="invalid-feedback">Valid IFSC Code is required.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="account_no">
                                    A/C No <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input" name="account_no" id="account_no" placeholder="Enter A/C No." required>
                                <div class="invalid-feedback">Valid Account Number is required.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Identification Details -->
                <div class="kyc-section-card mb-3 bg-white rounded-3 shadow-sm border">
                    <div class="kyc-section-header px-3 py-2 border-bottom d-flex align-items-center gap-2" style="background: #f1f5f9;">
                        <i class="fa-solid fa-id-card-clip" style="color: #142947;"></i>
                        <h6 class="mb-0 fw-bold text-uppercase" style="color: #142947; font-size: 13px; letter-spacing: 0.5px;">
                            2. Identification Details
                        </h6>
                    </div>
                    <div class="p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="adhar_no">
                                    Aadhar No. <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input" name="adhar_no" id="adhar_no" maxlength="12" placeholder="Enter Aadhar No" required>
                                <div class="invalid-feedback">Valid 12-digit Aadhar number is required.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="pan_no">
                                    PAN No. <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input text-uppercase" name="pan_no" id="pan_no" maxlength="10" placeholder="Enter PAN No" required>
                                <div class="invalid-feedback">Valid 10-character PAN is required.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Nominee Details -->
                <div class="kyc-section-card mb-3 bg-white rounded-3 shadow-sm border">
                    <div class="kyc-section-header px-3 py-2 border-bottom d-flex align-items-center gap-2" style="background: #f1f5f9;">
                        <i class="fa-solid fa-users" style="color: #142947;"></i>
                        <h6 class="mb-0 fw-bold text-uppercase" style="color: #142947; font-size: 13px; letter-spacing: 0.5px;">
                            3. Nominee Details
                        </h6>
                    </div>
                    <div class="p-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label kyc-label" for="nominee_name">
                                    Nominee Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input" name="nominee_name" id="nominee_name" placeholder="Enter Nominee Name" required>
                                <div class="invalid-feedback">Nominee Name is required.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label kyc-label" for="nominee_relation">
                                    Nominee Relation <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control kyc-input" name="nominee_relation" id="nominee_relation" placeholder="Enter Nominee Relation" required>
                                <div class="invalid-feedback">Nominee Relation is required.</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label kyc-label" for="nominee_no">
                                    Nominee No. <span class="text-danger">*</span>
                                </label>
                                <input type="tel" class="form-control kyc-input" name="nominee_no" id="nominee_no" maxlength="10" placeholder="Enter Nominee No" required>
                                <div class="invalid-feedback">Valid 10-digit Nominee No is required.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. KYC Document Proof Uploads -->
                <div class="kyc-section-card mb-3 bg-white rounded-3 shadow-sm border">
                    <div class="kyc-section-header px-3 py-2 border-bottom d-flex align-items-center gap-2" style="background: #f1f5f9;">
                        <i class="fa-solid fa-file-arrow-up" style="color: #142947;"></i>
                        <h6 class="mb-0 fw-bold text-uppercase" style="color: #142947; font-size: 13px; letter-spacing: 0.5px;">
                            4. KYC Document Images
                        </h6>
                    </div>
                    <div class="p-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="pan_image">
                                    PAN Image <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control kyc-file-input" name="pan_image" id="pan_image" accept=".jpg,.jpeg,.png" required>
                                <div class="form-text small text-muted">Upload PAN image (.jpg, .jpeg, .png)</div>
                                <div class="invalid-feedback">Please select PAN image.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="front_image">
                                    Aadhar Front Image <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control kyc-file-input" name="front_image" id="front_image" accept=".jpg,.jpeg,.png" required>
                                <div class="form-text small text-muted">Upload Aadhar front image (.jpg, .jpeg, .png)</div>
                                <div class="invalid-feedback">Please select Aadhar Front image.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="back_image">
                                    Aadhar Back Image <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control kyc-file-input" name="back_image" id="back_image" accept=".jpg,.jpeg,.png" required>
                                <div class="form-text small text-muted">Upload Aadhar back image (.jpg, .jpeg, .png)</div>
                                <div class="invalid-feedback">Please select Aadhar Back image.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label kyc-label" for="cheque_image">
                                    Cheque/Passbook Image (Optional)
                                </label>
                                <input type="file" class="form-control kyc-file-input" name="cheque_image" id="cheque_image" accept=".jpg,.jpeg,.png">
                                <div class="form-text small text-muted">Upload Cheque/Passbook image (.jpg, .jpeg, .png)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Terms & Conditions Agreement Checkbox -->
                <div class="kyc-section-card mb-2 bg-white rounded-3 shadow-sm border p-3">
                    <div class="form-check d-flex align-items-center gap-2">
                        <input type="checkbox" class="form-check-input mt-0" id="kyc_terms" name="kyc_terms" required checked style="width: 18px; height: 18px; cursor: pointer;">
                        <label class="form-check-label text-dark fw-semibold small mb-0" for="kyc_terms" style="cursor: pointer;">
                            I agree to all Terms &amp; Conditions
                        </label>
                    </div>
                    <div class="invalid-feedback" id="kyc_terms_feedback">You must agree to all Terms &amp; Conditions to proceed.</div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer kyc-modal-footer d-flex justify-content-between align-items-center bg-white border-top p-3 flex-wrap gap-2">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal" id="btnCancelKycModal">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back
                    </button>
                    <button type="button" class="btn btn-outline-primary px-3" id="btnReopenContractFromKyc">
                        <i class="fa-solid fa-file-contract me-1"></i> Review Agreement
                    </button>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-outline-warning px-3 fw-bold btnSkipKycAction" id="btnKycModalSkipKyc" style="border-width: 2px;">
                        <i class="fa-solid fa-forward me-1"></i> Skip KYC
                    </button>
                    <button type="button" class="btn btn-success fw-bold px-4 py-2" id="btnKycAgreeAccept">
                        <i class="fa-solid fa-check-double me-1"></i> I Agree and Accept <i class="fa-solid fa-arrow-right ms-1"></i>
                    </button>
                </div>
                <div class="alert alert-danger py-2 px-3 small w-100 d-none mt-2 mb-0" id="kycModalSkipErrorAlert"></div>
            </div>
        </div>
    </div>
</div>
<!-- END KYC VERIFICATION MODAL POPUP -->