{{-- Direct Seller E-Contract Agreement Modal Popup --}}
<div class="modal fade contract-modal" id="contractModal" tabindex="-1" aria-labelledby="contractModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content contract-modal-content">
            <!-- Modal Header -->
            <div class="modal-header contract-modal-header text-white flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2 flex-grow-1">
                    <img src="{{ asset('logo/favicon/favicon-96x96.png') }}" alt="Amberveda" class="contract-header-logo" style="width: 28px; height: 28px;">
                    <div>
                        <h6 class="modal-title mb-0 text-white fw-bold" id="contractModalLabel" style="font-size: 1.05rem;">
                            Direct Seller E-Contract Agreement
                        </h6>
                        <div class="contract-subtitle text-white-50 d-none d-sm-block" style="font-size: 0.75rem;">
                            Amberveda Wellness Private Limited &bull; Official Legal Deed (12 Pages)
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="contractModalCloseBtn"></button>
                
                <div class="d-flex align-items-center justify-content-between w-100 mt-1 pt-1 border-top border-secondary border-opacity-25 flex-wrap gap-2">
                    <!-- Document Status Badges -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-warning text-dark px-2 py-1 fw-bold"><i class="fa-solid fa-file-contract me-1"></i> Complete Legal Agreement</span>
                        <span class="badge bg-secondary px-2 py-1">12 Pages &bull; Clauses 1 to 39</span>
                    </div>

                    <!-- Jump to page dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="jumpPageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-book-open me-1"></i> Jump to Page
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow contract-jump-menu" aria-labelledby="jumpPageDropdown" style="max-height: 280px; overflow-y: auto;">
                            @for ($p = 1; $p <= 12; $p++)
                                <li><a class="dropdown-item py-1 contract-jump-link" href="#contract-page-{{ $p }}">Page {{ $p }} of 12</a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Reading Notice / Progress Banner -->
            <div class="contract-notice-bar py-2 px-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center text-dark small">
                    <i class="fa-solid fa-circle-info text-primary me-2"></i>
                    <span>Please review the entire agreement (all 12 pages) below before giving your consent.</span>
                </div>
                <div class="badge bg-primary text-white contract-page-indicator">
                    Total: 12 Pages
                </div>
            </div>

            <!-- Modal Body (Scrollable document container) -->
            <div class="modal-body contract-modal-body p-2 p-md-4" id="contractModalBody">

                <!-- 1. TEXT VIEW (Formatted Document) -->
                <div id="contractTextView" class="contract-view-section">

                    <!-- PAGE 1 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-1">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 1 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <div class="contract-doc-header text-center mb-3">
                            <img src="{{ asset('mem_assets/contract/header_page_1.png') }}" alt="Amberveda Wellness Letterhead" class="img-fluid contract-letterhead-img" style="max-height: 120px; width: 100%; object-fit: contain;">
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <div class="contract-date-line"><strong>Date.</strong> ........................</div>
                        </div>

                        <div class="text-center my-3">
                            <h4 class="contract-title text-uppercase fw-bold text-decoration-underline" style="letter-spacing: 0.5px; color: #142947;">DIRECT SELLER E-CONTRACT AGREEMENT</h4>
                        </div>

                        <p class="contract-para text-justify">
                            This agreement is agreed and accepted electronically &amp; online by and between the executing parties (Hereinafter mentioned and referred to as Direct Seller and the Direct selling Entity which expressions shall mean and include their respective legal heirs, assigns, successors, administrators and undertakers).
                        </p>

                        <p class="contract-para text-justify">
                            Be known that this Contract agreement is executed and entered into in accordance with the provisions of India Contract Act and Consumer Protection (Direct selling) Rules, 2021 (Hereinafter referred to as the Rules)
                        </p>

                        <p class="contract-para text-justify">
                            WHEREAS the Direct Seller has voluntarily out of his / her own accord, sweet will and without any coercion whatsoever, mental or physical, offered to join the Direct Selling Network business of the Direct selling entity named Amberveda Wellness Private Limited, (registered under the Companies Act, 2013 having Registration No. U21003UW2026PTC253557 and Registered Office at B-129, Apex City, Meerut City-250002, Uttar Pradesh, India.
                        </p>

                        <p class="contract-para text-justify">
                            AND WHEREAS the Direct selling entity is engaged in &ldquo;Direct selling business&rdquo; which means marketing, distribution and sale of goods or providing of services through a network of Direct Sellers at Multi-levels as per its prescribed Business / Compensation Plan (Which many be read as part and parcel of this agreement as the same is not being reproduced here for the sake of brevity) not falling under the Pyramid or Money circulation scheme.
                        </p>

                        <p class="contract-para text-justify">
                            AND WHEREAS the Direct seller, named below along with his/her KYC particulars therein has, after being explained all the provisions of the said Business/Compensation Plan, product details and the present E-contract Agreement in the vernacular language known to him by Sh. <span class="contract-fill-blank fw-bold text-primary" id="contractIntroducerName">________________________</span>, ID No.<span class="contract-fill-blank fw-bold text-primary" id="contractIntroducerId">________________</span>, duly ascertained and satisfied by visiting the Direct Selling entity's website: <a href="https://www.ambervedawellness.com" target="_blank" class="text-primary text-decoration-underline">www.ambervedawellness.com</a>, has voluntarily offered to join the business of the Direct Selling entity and resolved to enter into this E-contract agreement, hence this deed.
                        </p>

                        <p class="contract-para text-justify fw-bold mt-3">
                            NOW THEREFORE THIS DEED COVENANTS AS UNDER:
                        </p>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_page_1.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 110px;">
                            </div>
                        </div>

                        {{-- <div class="contract-doc-footer mt-4">
                            <img src="{{ asset('mem_assets/contract/footer_page_1.png') }}" alt="Amberveda Wellness Footer" class="img-fluid contract-footer-img" style="width: 100%;">
                        </div> --}}
                    </div>

                    <!-- PAGE 2 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-2">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 2 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol class="contract-clause-list" start="1">
                            <li>
                                The Direct selling entity hereby declares that it is fully compliant to the Consumer Protection Act, 2019, Consumer Protection (Direct Selling) Rules, 2021, Legal Meteorology Act, 2009, E-commerce Rules, 2009 and all other Rules and laws applicable to an Indian Direct Selling Entity.
                            </li>
                            <li>
                                The Direct selling entity assures and the Direct seller agrees that this E-contract agreement has no provision that a Direct seller will receive remuneration or incentive for the recruitment / enrolment only of new participants.
                            </li>
                            <li>
                                The Direct selling entity also assures and the Direct Seller agrees that it does not require a participant to purchase goods or services for a amount that exceeds the amount for which such goods or services can be expected to be sold or resold to consumers.
                            </li>
                            <li>
                                The Direct selling entity also assures and the Direct Seller agrees that it does not require a participant to pay any entry / registration fee, cost of sales demonstration equipment and materials or other fees relating to participation in the Direct selling entity&rsquo;s Direct selling business.
                            </li>
                            <li>
                                That the Direct seller here in assures that it has ascertained from the Business/Compensation plan provided by the Direct selling entity (The same many be read as part and parcel of this E-contract agreement as the same is not being reproduced here for the sake of brevity), the stipulated amount of any or all types of Incentives, rewards, etc. including financial and non-financial benefits payable to the Direct seller are calculated only and only on the basis of effective sale, marketing and distribution of products and in no way on the basis of recruiting / sponsoring / introducing another Direct seller.
                            </li>
                            <li>
                                <strong>Cooling Off Policy:</strong> That the Direct selling entity allows or provides to the Direct seller herein a reasonable cooling off period in accordance with clause 3 (b) of the Rules, as per Cooling Off policy annexed herewith which many be read as part and parcel of these covenants as the same is not being reproduced here for the sake of brevity.
                            </li>
                            <li>
                                <strong>Buyback Policy:</strong> That the Direct selling entity allows or provides for a buy back or repurchase policy for &ldquo;currently marketable&rdquo; products sold to the participant at the request of the participant , as per &ldquo;Buy-back Mechanism&rdquo; annexed which many be read as part and parcel of these covenants as the same is not being reproduced here for the sake of brevity.,
                            </li>
                            <li>
                                That the Direct seller here in agrees that the Direct selling entity has established a &ldquo;Grievance Redressal Mechanism&rdquo; for consumers and Direct sellers to redress their grievances and complaints, annexed here with which many be read as part and parcel of these covenants as the same is not being reproduced here for the sake of brevity.
                            </li>
                            <li>
                                The Direct selling entity herein declares and the Direct seller herein accepts that the entity does not require, invite or solicit a Prospect or would be Direct seller to invest money in any form whatsoever to participate in its Direct selling business. The Direct seller shall however be required to bear the cost of products purchased by him / her and does not include any provision that the Direct seller herein will receive compensation for the recruitment of other participants to participate. That he / she will receive compensation derived only and only from the sale, marketing and distribution of products, in
                            </li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 3 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-3">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 3 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <p class="contract-para text-justify">
                            accordance with the business/compensation plan provided and prescribed by the Direct selling entity, to which the Direct seller hereby agrees to whole of this covenant in letter and spirit.
                        </p>

                        <ol class="contract-clause-list" start="10">
                            <li>
                                That the Direct selling entity will provide all support to the Direct seller in delivery of the products through Franchisee / Pick-up centers / Available Courier/Transport or any other Logistics Service for maintaining effective support system.
                            </li>
                            <li>
                                That by accepting the Offer of the Direct Seller herein the Direct Selling entity requires him / her to do and complete the following steps. An Individual / Firm / entity eligible to enter into a contract as per the provisions of the India Contact Act, 1872 and wish to become a Direct seller of the Direct selling business of the entity herein, can apply to become a Direct seller for marketing and selling of Direct selling entity&rsquo;s product on pan India basis, in prescribed form through online method.
                                <ol type="a" class="contract-subclause-list mt-2">
                                    <li>Fill the application form online and upload self-attested scanned KYC documents.</li>
                                    <li>Accept the terms and condition of this E-contract agreement by clicking on &ldquo;I AGREE AND ACCEPT&rdquo; button below.</li>
                                    <li>On the completion of the above process, the Direct Seller can take a printout of this agreement.</li>
                                    <li>Upon the execution of this agreement and after the verification of all the KYC documents uploaded through the above process, the applicant shall be accepted as a Direct seller of the Direct selling entity&rsquo;s business and a Unique Identification number and password shall be allotted to the applicant, to allow him / her to log on to access his/ her own personal account maintained by the company on its website.</li>
                                    <li>That the Direct seller shall submit the following self-attested documents in hard copy to the Direct selling entity within SEVEN days&rsquo; from the date of execution of this Agreement (Including the acceptance of terms of this agreement) already accepted and agreed upon by clicking on &ldquo;I AGREE AND ACCEPT &rdquo; button at the bottom of these presents (agreement)</li>
                                    <li>That the Direct selling entity upon scrutiny and verification of the Application and KYC particulars may re-consider its decision and reject application of the Direct seller herein, to which the Direct seller hereby agrees. The Direct selling entity shall have sole discretion and shall be at liberty to reject his / her direct selling unique ID number, if the KYC and other documents in hard copy are found unsatisfactory, mollified. Forged or not conforming to Government guidelines prescribed for this purpose.</li>
                                    <li>That the KYC shall include but not limited to verified proof of address, proof of identity, and PAN as per the provisions of the Income Tax Act, 1961, as follows, duly issued by the Government of India or a State/UT government.
                                        <ol type="i" class="contract-sub-subclause-list mt-1">
                                            <li>Aadhaar Car</li>
                                            <li>Voter ID Card</li>
                                            <li>Passport</li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 4 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-4">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 4 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol type="i" class="contract-sub-subclause-list" start="4">
                            <li>Ration card</li>
                            <li>Any other identity document issued by the State/UT or central government which can be verified online.</li>
                            <li>Additional Documents required for Applicant in case of a company or firm:
                                <ol type="1" class="contract-company-docs-list mt-1">
                                    <li>CIN or Registration Certificate, MOA &amp; AOA or Partnership Deed, as the case any be;</li>
                                    <li>PAN, GSTIN, FSSAI (wherever applicable)</li>
                                    <li>List of Directors/Partners of the applicant entity</li>
                                    <li>Board Resolution/Authorization in favour of the Director/Partner signing and executing this E-Contract agreement and Application</li>
                                </ol>
                            </li>
                        </ol>

                        <p class="contract-para text-justify mt-3" style="text-indent: 0;">
                            <strong>h)</strong> The Direct seller herein declares that he/they has/have not been declared a bankrupt by a competent court of law as provided under clause (3) of section 79 of the Insolvency and Bankruptcy Code, 2016 and that he/she is neither in litigation nor convicted by any court of law in preceding five years&rdquo; of the date of joining the Direct selling entity&rsquo;s business herein.
                        </p>

                        <div class="contract-section-heading fw-bold mt-3 mb-2" style="font-size: 1.05rem; color: #142947;">
                            12. Scope of the Work:
                        </div>
                        <ol type="a" class="contract-subclause-list">
                            <li>That the Direct seller shall market, distribute and sell the products of the Direct selling entity using word of mouth publicity, display and demonstration of the products, distribution of pamphlets, and door to door selling to consumers and prospective Direct sellers.</li>
                            <li>That the Direct selling entity shall be exclusive owner of the name and logo of the Direct selling entity. The Direct seller shall not use the trademark, logo type and design anywhere without prior written permission from the Direct selling entity. This permission, if given, can be withdrawn at any time by the Direct selling entity. Violations if any, shall be termed as violation of this agreement and many result in termination of this agreement and Direct seller-ship of the Direct seller, penal actions under the prevailing IPR laws and Rules at the sole discretion of the entity herein to which the Direct seller herein agrees.</li>
                            <li>That the Direct seller shall not manipulate, alter, amend, add or delete any provisions of the Entity herein Business Plan, pricing of products, SP points etc., in any way whatsoever and shall not send, transmit or otherwise communicate any messages to anybody on behalf of the Direct selling entity, contrary to entity&rsquo;s policies, principal, instructions and prescriptions without prior written authorization and permission for the same by the Direct selling entity.</li>
                            <li>That the Direct seller will get specified percentage / points (PV) based Incentives pertaining to the sales for selling the Direct selling entity&rsquo;s products directly or indirectly under this E-contract Agreement.</li>
                            <li>That the Direct selling entity hereby covenants that it shall provide to the Direct seller with complete instruction book(s), catalogue, pamphlets for promoting sales, marketing and distribution and shall provide mandatory orientation training.</li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 5 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-5">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 5 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol type="a" class="contract-subclause-list" start="6">
                            <li>That the Direct selling entity shall issue photo identity cards to Direct seller. This photo identity card shall be returned by the Direct seller to the Direct selling entity at the expiry / termination / revocation of this agreement and/or shall be destroyed but shall not be misused in any way or form whatsoever. The identity card shall contain the Name &amp; Unique ID number (FSSAI Number, if applicable) of the Direct seller.</li>
                            <li>The Direct seller will not be authorized to collect any type of cash/cheque/ demand draft in his own name, on behalf of the Direct selling entity. All cheque / demand drafts etc. should be drawn in the name of the Direct selling entity only and the same should be deposited with the Direct selling entity&rsquo;s office or other offices as many be specified by the Direct selling entity, within 24 hours of the time of receipt. Direct seller shall hold the said cash collection / cheque / DD in trust for and on behalf of the Direct selling entity. Upon failure to deposit the said cash collection / cheque / DD, Direct seller shall be liable to pay damages / compensation and Mesne-profit, if any. The receipt / invoice issued by the Direct selling entity only would be valid documentary evidence in the hand of the consumer. It means Direct seller would not be authorized to issue any receipt / invoice on behalf of the Direct selling entity.</li>
                            <li>That the Direct selling entity may open following facilities for sale of its products:
                                <ol type="i" class="contract-sub-subclause-list mt-1">
                                    <li>Online Portal / E-commerce</li>
                                    <li>Stores (Retail Outlets)</li>
                                    <li>Authorized Sales Point / Pickup Centre</li>
                                </ol>
                            </li>
                            <li>That a Direct seller is not authorized to sell any product of the Direct selling entity herein one-commerce platform / marketplace., without prior written consent, permission or authorization of the entity herein The Direct seller is also prohibited from listing, marketing, advertising, promoting, discussing, or selling any product, or the business opportunity on any website or online forum that offers auction as a mode of selling.</li>
                        </ol>

                        <div class="contract-section-heading fw-bold mt-3 mb-2" style="font-size: 1.05rem; color: #142947;">
                            13. Sales Incentives / Commission Structure or other Benefit: The Direct seller shall be eligible for the following financial incentives and/or privileges:
                        </div>
                        <ol type="a" class="contract-subclause-list">
                            <li>Incentives on the sales, marketing and distribution of products and/or services by the Direct Seller and his/her team or network of Direct Sellers, as per the Business/ Compensation Plan of the entity herein, annexed herewith but not being reproduced here for the sake of brevity.</li>
                            <li>Direct seller can Market, sell or distribute Direct selling entity here in&rsquo;s Products on Pan India basis. There is no territorial restriction or limit to sell the products.</li>
                            <li>He / she can always check and inspect his / her account on the Direct selling entity&rsquo;s website by using his/her Unique ID and Password allotted to him / her by the Direct selling entity.</li>
                            <li>That the Direct selling entity reserves the right to restrict the list of products for a particular area / region.</li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 6 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-6">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 6 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol type="a" class="contract-subclause-list" start="5">
                            <li>That price revisions, Government directives, market forces etc., many tend and force the entity herein to change the Direct selling entity&rsquo;s Sales Incentive policy and the Direct selling entity&rsquo;s decision in this regard will be final and binding. In all such cases, the amendments will be notified on the Direct selling entity&rsquo;s website and such notifications shall be binding on the Direct seller. However, if any Direct seller does not agree to be bound by such amendment, he / she many terminate this agreement within 30 days of such publication by giving a written notice communicating his / her objections, if any, to the Direct selling entity. Without submission of the objection for modification etc., if a Direct seller continues the Direct Selling business and activities of the entity herein then it will be deemed and presumed that he / she has accepted all modifications and amendments in the terms &amp; conditions for future.</li>
                            <li>That all payments and transactions shall be valued in India Rupees (INR).</li>
                            <li>That the Direct selling entity does not guarantee / assure / promise or offer any facilitation fees or any amount or quantum of income whatsoever to the Direct seller on account of becoming a Direct seller of the Direct selling entity.</li>
                            <li>That Sales Incentives to the Direct seller shall be subject to all statutory deductions as applicable like TDS etc.</li>
                            <li>That Sales Incentive accrued and paid to the Direct seller is inclusive of all taxes.</li>
                        </ol>

                        <ol class="contract-clause-list" start="14">
                            <li>
                                That the Direct selling entity shall provide accurate and complete information to prospective and existing Direct sellers concerning the reasonable amount of earning opportunity and related rights and obligations.
                            </li>
                            <li>
                                That the Direct selling entity shall pay all dues to the Direct seller and make with holdings, if any, in a commercially reasonable manner.
                            </li>
                            <li>
                                That Direct selling entity does not require a Direct seller to maintain an office or establishment in furtherance of his / her entrepreneurship and if a Direct seller does so then he / she himself / herself will be responsible to bear such expenses and the Direct selling entity will in no way be responsible to refund or reimburse the same.
                            </li>
                            <li>
                                That Direct seller covenants with the Direct selling entity that it will exclusively engage in the sale of the Direct selling entity&rsquo;s products and shall not indulge in the sale of similar / identical products of any other entity/brand whatsoever.
                            </li>
                            <li>
                                That Unique Identification Number will have to be quoted by the Direct seller in all his / her transactions and correspondence with the Direct selling entity. The Unique Identification Number once allotted cannot be altered at any point of time. That No communication will be entertained without Unique Identification Number and password. Direct seller shall preserve the Unique Identification Number and Password properly as it is must for logging on to the website of the entity herein.
                            </li>
                            <li>
                                That the Direct seller shall be faithful to the Direct selling entity and shall uphold the integrity and decorum to the Direct selling entity and shall maintain good relations with other Direct seller and customers also.
                            </li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 7 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-7">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 7 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol class="contract-clause-list" start="20">
                            <li>
                                That the Direct seller shall abide with policies, procedures, rules and regulations prescribed by the Direct selling entity as well as all laws, rules, regulations, directives and Guideline issued by Government of India, a State Government, a Local body, a Court of Law and local administration, from time to time. A Direct seller will also not indulge in any deceptive or unlawful trade practices such as Mis-selling or Unfair Trade Practices as mentioned in clauses 3(f, g, and i) as defined in the Rules and Clause 2(1), (18), (20) (41) to 4(43) and (47) of the Consumer Protection Act, 2019 and if does so then he / she shall be only and solely responsible for the consequences and perils thereof.
                            </li>
                            <li>
                                That the Direct seller shall be liable to produce / show / explain the Business/Compensation Plan to the prospects as has been received by him / her. If the Direct selling entity notices that the Direct seller is working in a way not permitted / authorized, then the Direct selling entity shall have exclusive powers to terminate or bar him / her from the Direct selling entity&rsquo;s Direct selling business with or without giving a show cause notice.
                            </li>
                            <li>
                                That the Direct seller cannot conduct or announce personal level business promotion activities by offering cash rewards, trips, valuables, etc.
                            </li>
                            <li>
                                That the Direct seller is personally liable for delivery of goods to its customers. He is also liable to collect products from where it reaches last by the transporter/courier.
                            </li>
                            <li>
                                That the Direct seller is prohibited from mentioning / posting / telecasting any inappropriate or defaming content about the Direct selling entity, its products, etc. in any social media platforms. If he / she does any act in contravention to this clause, then this contract agreement will be deemed terminated and the Direct selling entity reserves rights to initiate appropriate legal action against him / her.
                            </li>
                            <li>
                                That only one Direct seller-ship code shall be issued on one PAN Card.
                            </li>
                            <li>
                                That the Direct seller hereby undertakes not to compel or induce or mislead any person with any false statement / promise to purchase products from the Direct selling entity or to become Direct seller of the Direct selling entity.
                            </li>
                            <li>
                                All statutory changes will be in force with immediate effect or as per the law prescribed.
                            </li>
                            <li>
                                Any notice or correspondence/s addressed and sent to the Direct seller&rsquo;s registered address, E-mail ID and Mobile Number mentioned in the Application Form for registration as Direct seller by registered post or a Courier Service or E-mail or What&rsquo;s-app message shall be construed as legally delivered to the addressee. However, it is advisable that every Direct seller shall immediately inform the Direct selling entity about the change in his / her address, E-mail ID and Mobile Number failing which the Direct seller&rsquo;s non-deliverance claim shall not be tenable at any cost whatsoever.
                            </li>
                            <li>
                                The term of this E-contract agreement is at will, subject to earlier termination in accordance with this E-contract agreement or in accordance with law. If this E- Contract Agreement is terminated for any reason whatsoever, the Direct seller understands that his / her right to sell the products and receiving incentives with respect of his/her activities as a Direct seller will cease immediately. Direct selling entity reserves the right to terminate this E-
                            </li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 8 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-8">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 8 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <p class="contract-para text-justify">
                            contract agreement if any condition(s) of this E- Contract Agreement are violated by a Direct seller.
                        </p>

                        <ol class="contract-clause-list" start="30">
                            <li>
                                <strong>Limitation of Action:</strong> If a Direct seller wishes to bring any grievance to the notice of the Direct selling entity he can do so as per the &ldquo;Grievance Redressal Mechanism&rdquo; annexed to this agreement many be read as part and parcel of this agreement as the same is not being reproduced here for the sake of brevity.
                            </li>
                            <li>
                                The Direct seller herein declares that neither he has been convicted nor faced any litigation or has been declared Bankrupt by a competent court of law during the five years preceding to entering into this contract agreement.
                            </li>
                            <li>
                                <strong>Indemnification:</strong> That the Direct seller agrees to protect, defend, indemnify and hold harmless Direct selling entity and its employees, officers, directors, agents or representatives from and against any and all liabilities, damages, fines, penalties and costs (including legal costs and disbursements)arising from or relating to:
                                <ul class="contract-bullet-list mt-2">
                                    <li>Any breach of any statute, regulation, direction, orders or standards notified by any governmental body, agency, or regulator applicable to the Direct Seller including payment and deposit of taxes; on account of Income tax, GST, Trade tax, Professional Tax, whenever applicable and shall obtain necessary registrations/licenses whenever applicable and required under law.</li>
                                    <li>Any breach of the terms and conditions of this E-contract agreement by the Direct seller,</li>
                                    <li>Any claim of any infringement of any intellectual property right or any other right of any third party or of law by the Direct seller; or</li>
                                    <li>Against all matters of embezzlement, misappropriation or misapplications of collection / moneys which many from time to time during the continuance of the Agreement come into his / her / its possession / control.</li>
                                </ul>
                            </li>
                            <li>
                                <strong>Relationship:</strong> That the Direct seller understands that it is an independently owned business entity and this Agreement does not make it, Direct selling entity&rsquo;s employee, associate or agent or legal representative for any purpose whatsoever. The Direct seller does not possess any express or implied right or authority to assume or to undertake any obligation in respect of or on behalf of or in the name of the Direct selling entity or to bind the Direct selling entity in any manner whatsoever. In case, a Direct seller violates this provision in any manner whatsoever then he / she shall be responsible for all types of consequences be it financial, statutory, civil or criminal.
                            </li>
                            <li>
                                <strong>Suspension, Revocation or Termination of this E-contract agreement:</strong><br>
                                <strong>a.</strong> That the Direct selling entity reserves the right to suspend the operation of this E-contract agreement, at any time, due to change in its own license conditions or upon directions from the competent government authorities. In such a situation, Direct selling entity shall not be
                            </li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 9 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-9">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 9 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <p class="contract-para text-justify">
                            responsible for any damage or loss caused or arisen out of aforesaid action.
                        </p>

                        <p class="contract-para text-justify">
                            <strong>b.</strong> That in case of violation of any of the provisions of this agreement stated here-in-before and agreed upon by the Direct seller, the Direct selling entity may, without prejudice to any other remedy available, issue a Fifteen days&rsquo; written notice and call upon the Direct seller to explain his/her conduct in writing failing which or if the explanation is found unsatisfactory and unacceptable in the ordinary course of business, suspend / block / terminate the Direct seller from further conducting the business of the Direct selling entity. The violations of this agreement and grounds of termination of the services of of a Direct seller, not limited to, shall be as under
                        </p>

                        <ul class="contract-arrow-list list-unstyled ps-3">
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct Seller is found to be spreading derogatory remarks, unfounded allegations, (orally or electronically or online) against the entity or its Directors or the Business Plan prescribed by the entity or its products.</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct seller is found to be mis-selling</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct seller is found to be indulging in Unfair Trade practices as provided under the Consumer Protection Act, 2019</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct seller is indulging in any action whatsoever which may harm the business of his/her fellow Direct sellers or the entity, as the case may be</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct seller is found to be non-complying with the provisions of E-commerce Rules, 2020</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct seller is found to be violating the taxation laws or any other law, in force.</li>
                        </ul>

                        <p class="contract-para text-justify">
                            detrimental to the business interests of the Direct selling entity.
                        </p>

                        <p class="contract-para text-justify">
                            <strong>c.</strong> That the Direct seller may terminate this agreement at any time by giving a written notice of Fifteen days&rsquo; to the Direct selling entity at the Registered Office/Head Office address of the Direct selling entity.
                        </p>

                        <ul class="contract-arrow-list list-unstyled ps-3">
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct selling entity is found to be violating any clause of this contract agreement</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct selling entity fails to pay the commission entitlements of a Direct seller within prescribed time</li>
                            <li><span class="text-primary me-2">&#10148;</span> If the Direct selling entity is found to be violating the taxation laws or any other law, in force detrimental to the business of the Direct seller.</li>
                        </ul>

                        <div class="contract-section-heading fw-bold mt-3 mb-2" style="font-size: 1.05rem; color: #142947;">
                            35.Actions pursuant to Suspension / Blocking / Termination of this E-contract agreement: That notwithstanding any other rights and remedies provided else wherein the agreement, upon termination of this agreement:
                        </div>
                        <ol type="a" class="contract-subclause-list">
                            <li>The Direct seller shall not represent the Direct selling entity in any of its dealings.</li>
                        </ol>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 10 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-10">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 10 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol type="a" class="contract-subclause-list" start="2">
                            <li>The Direct seller shall not intentionally or otherwise commit any act(s) as would keep a third party to believe that the Direct selling entity is still having Direct selling agreement with the Direct seller.</li>
                            <li>The Direct seller shall stop using the Direct selling entity&rsquo;s name, trademark, logo, etc., in any audio or visual form.</li>
                            <li>All obligations and liabilities of such Direct seller to the Direct selling entity existing on the date having accrued during the validity of this Agreement will have to be fulfilled, met and satisfied by the Direct seller in every manner whatsoever.</li>
                        </ol>

                        <div class="contract-section-heading fw-bold mt-3 mb-2" style="font-size: 1.05rem; color: #142947;">
                            36.Governing Laws and Regulations:
                        </div>
                        <ol type="a" class="contract-subclause-list">
                            <li>That this Agreements shall be governed by the provisions of the India Contract Act, 1872, the Consumer Protection Act, 2019, Consumer Protection (Direct Selling} Rules, 2021 or other laws of the land.</li>
                        </ol>

                        <div class="contract-section-heading fw-bold mt-3 mb-2" style="font-size: 1.05rem; color: #142947;">
                            37.Dispute Settlement
                        </div>
                        <p class="contract-para text-justify">
                            The Direct seller herein agrees and accepts that the remedial action available to him/her in the event of any interpretation of any question of law, dispute or difference arising under this agreement or in connection there-with (except as to the matters, the decision to which is specifically provided under this agreement), the same shall be as under:
                        </p>
                        <ol type="a" class="contract-subclause-list">
                            <li>As per4 the Grievance Redressal Mechanism offered by the entity herein and forming part of this contract agreement;</li>
                            <li>Thereafter, the dispute if any shall be referred to National Consumer Helpline or State consumer Helpline for effective Mediation;</li>
                            <li>Disputes if any shall be resolved in accordance with the provisions of the India Arbitration and Reconciliation Act and mediation provisions of Consumer Protection Act, 2019<br><strong class="d-block text-center my-2">OR</strong></li>
                            <li>Referred to a legal forum dealing with consumer disputes having jurisdiction in the District of Delhi/ jurisdiction in the District of Meerut (U.P).</li>
                        </ol>

                        <div class="contract-section-heading fw-bold mt-3 mb-2" style="font-size: 1.05rem; color: #142947;">
                            38.Force- Majeure
                        </div>
                        <p class="contract-para text-justify">
                            That if at any time, during the continuance of this agreement, the performance in whole or in part, by the Direct selling entity, of any obligation under this ais prevented or delayed, by reason of war, or hostility, acts of the public enemy, civic commotion, sabotage, Act of State or direction from Statutory Authority, explosion, epidemic, quarantine restriction, strikes and lockouts, fire, floods, natural calamities / Disaster or any act of God (hereinafter referred to asevent), neither party shall, by reason of such event, be entitled to terminate this agreement, nor shall either party have any such claims for damages against the other, in respect of such non-performance or delay in performance. Provided that the Services under this agreement shall be resumed as soon as practicable, after such event comes to a end or ceases to exist.
                        </p>

                        <p class="contract-para text-justify fw-bold mt-3 mb-0">
                            39.The Direct seller hereby covenants as under:
                        </p>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 11 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-11">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 11 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <ol type="a" class="contract-subclause-list">
                            <li>That he / she has clearly understood the application form, Business/Compensation Plan of the Direct Selling Entity, its limitations and conditions and he / she is not relying upon any representation or promises that are not set out in this E-contract agreement.</li>
                            <li>That relation between the Direct selling entity and the Direct seller and all his / her activities here under shall be governed in addition to this agreement, by the rules / procedures contained in the Business/Compensation available on website. The Direct seller confirms that he / she has readout and/or has been read out in the vernacular language known to him/her by the person named herein above, all the terms &amp; conditions thereof and agrees to be bound by them.</li>
                            <li>That Direct seller, hereby declares that all the information furnished by him / her to the Direct selling entity are true and correct. Direct selling entity shall be at sole discretion and liberty to take any action against the Direct seller in the event, it is discovered that the Direct seller furnished any wrong / false information to the Direct selling entity.</li>
                            <li>The Direct seller herein very well understands that violation of this contract agreement in any way whatsoever may result in termination of this agreement as per procedure laid down therein.</li>
                        </ol>

                        <div class="contract-token-box p-3 my-4 text-center fw-bold text-uppercase border border-secondary" style="background-color: #f8f9fa;">
                            IN TOKEN OF HIS / HER AGREEING TO AND ACCEPTING ALL PROVISIONS OF THIS CONTRACT AGREEMENT SET HEREINABOVE, HE / SHE IS CLICKING ON THE &ldquo;I AGREE&rdquo; BUTTON GIVEN HEREIN.
                        </div>

                        <div class="text-center my-3">
                            <span class="btn btn-outline-dark px-4 py-2 fw-bold text-uppercase" style="letter-spacing: 1px;">I AGREE&amp; ACCEPT</span>
                        </div>

                        <div class="d-flex justify-content-end my-3">
                            <div class="contract-stamp-container text-center">
                                <img src="{{ asset('mem_assets/contract/stamp_pages_2_11.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 100px;">
                            </div>
                        </div>

                        <div class="contract-signature-lines mt-4 pt-2">
                            <div class="row">
                                <div class="col-sm-6 mb-2">
                                    <strong>Name:</strong> <span class="contract-fill-blank fw-bold text-primary" id="contractDirectSellerName">______________________</span>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <strong>S/D/W Of Sh</strong> <span class="contract-fill-blank fw-bold text-primary" id="contractFatherName">______________________</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PAGE 12 -->
                    <div class="contract-page-card shadow-sm mb-4" id="contract-page-12">
                        <div class="contract-page-header d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <span class="badge bg-secondary">Page 12 of 12</span>
                            <span class="text-muted small">Direct Seller E-Contract Agreement</span>
                        </div>

                        <div class="contract-particulars-notice p-3 border border-secondary rounded mb-4 bg-light">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa-solid fa-circle-info text-primary"></i>
                                <strong class="text-uppercase small">Direct Seller Particulars &amp; Bank Account Declaration</strong>
                            </div>
                            <p class="mb-0 text-muted small">
                                Direct Seller KYC particulars (Residential Address, State, PIN, PAN, Aadhaar Number, and Banking Details) are captured and verified in <strong>Stage 4: KYC Details &amp; Application Form</strong> pursuant to Clause 39 and the Direct Selling Rules, 2021.
                            </p>
                        </div>

                        <div class="text-center my-4">
                            <span class="btn btn-outline-dark px-4 py-2 fw-bold text-uppercase" id="btnBottomAgreeAccept" style="letter-spacing: 1px; cursor: pointer;">AGREE &amp; ACCEPT</span>
                        </div>

                        <div class="my-4 pt-2" id="contractBottomSentinel">
                            <p class="fw-bold mb-3 text-uppercase">
                                ANKIT YADAV, NODAL OFFICER, AMBERVEDA WELLNESS PRIVATE LIMITED
                            </p>
                            <div class="d-flex justify-content-end">
                                <div class="contract-stamp-container text-center">
                                    <img src="{{ asset('mem_assets/contract/stamp_page_12.png') }}" alt="Amberveda Signature & Stamp" class="contract-stamp-img" style="max-height: 110px;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END TEXT VIEW -->

                

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer contract-modal-footer bg-light d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="contract-consent-acknowledgement text-muted small" id="contractConsentNotice">
                    <span id="contractScrollNotice">
                        <i class="fa-solid fa-arrow-down text-warning me-1"></i>
                        Please scroll through all 12 pages to the bottom to unlock the agreement options.
                    </span>
                    <span id="contractUnlockedNotice" class="text-success fw-semibold" style="display: none;">
                        <i class="fa-solid fa-circle-check me-1"></i>
                        Agreement reviewed completely. Click <strong>&ldquo;Accept Agreement &amp; Proceed to KYC&rdquo;</strong> to continue, or <strong>&ldquo;Skip KYC&rdquo;</strong>.
                    </span>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <!-- Scroll to bottom indicator badge (shown before reaching bottom) -->
                    <span id="contractScrollBadge" class="badge bg-warning text-dark py-2 px-3 fw-semibold">
                        <i class="fa-solid fa-arrow-down me-1"></i> Scroll to Bottom to Unlock
                    </span>
                    <!-- Buttons hidden until user scrolls to bottom of agreement -->
                    <button type="button" class="btn btn-outline-warning px-3 fw-bold btnSkipKycAction" id="btnContractSkipKyc" style="border-width: 2px; display: none;">
                        <i class="fa-solid fa-forward me-1"></i> Skip KYC
                    </button>
                    <button type="button" class="btn btn-success px-4 fw-bold" id="btnContractAccept" style="display: none;">
                        <i class="fa-solid fa-check-circle me-1"></i> Accept Agreement &amp; Proceed to KYC <i class="fa-solid fa-arrow-right ms-1"></i>
                    </button>
                </div>
                <div class="alert alert-danger py-2 px-3 small w-100 d-none mt-2 mb-0" id="contractSkipKycErrorAlert"></div>
            </div>
        </div>
    </div>
</div>
