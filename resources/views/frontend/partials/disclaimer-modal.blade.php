<!-- DISCLAIMER CLAUSE POPUP MODAL (Homepage Only) -->
<div class="disclaimer-modal-overlay" id="disclaimerModalOverlay" role="dialog" aria-modal="true" aria-labelledby="disclaimerModalTitle">
    <div class="disclaimer-modal-dialog">
        <!-- Fixed Header with Title and Close (×) Button -->
        <div class="disclaimer-modal-header">
            <div class="disclaimer-header-content">
                <span class="disclaimer-modal-badge">🌿 Official Advisory</span>
                <h2 class="disclaimer-modal-title" id="disclaimerModalTitle">DISCLAIMER <span>CLAUSE</span></h2>
                <p class="disclaimer-modal-sub">Amberveda Wellness Private Limited • Statutory Public Notice</p>
            </div>
            <button type="button" class="disclaimer-modal-close-btn" id="disclaimerCloseBtn" aria-label="Close Disclaimer">
                <i class="fas fa-times" aria-hidden="true"></i> Close
            </button>
        </div>

        <!-- Vertically Scrollable Content Area -->
        <div class="disclaimer-modal-body">
            <p>Before venturing into our website, it is hereby informed to the general public that our company is engaged into the business of direct selling through its direct seller and retail outlets and in other business activities as stated in the object clauses of memorandum of association of the company and we are also engaging in the marketing or sales of goods directly to the end user consumer on M.R.P/D.P. using word of mouth, publicity, display and / or demonstrations of the goods / products, and /or distribution of pamphlets. We do not indulge in any kind of financial investment or float any investment scheme or chit fund entrepreneurship.</p>

            <p>An individual /firm /company who is able to do contract as per the provision of the Indian contact act, 1872 and wish to become direct seller of the company, can apply to be appointed as a direct seller to marketing and selling of company’s product in whole of  India , in prescribed form through online / manual. There is <strong>NO deposit or any charges / enrolment fees / joining fees / renewal charges</strong> for becoming a direct seller of the company. Our company shall not be responsible for any promises made by any individual/independent advisor/entity/direct seller/distributor on its behalf accept any promise which is mentioned in the authentic brochure or on website: <strong>www.ambervedawellness.com</strong>.</p>

            <p>We also declare that we have not been given any assurance or promise by the company or its Direct Sellers as to any income on account of the product purchase made by customer. However direct seller will be eligible for sales &amp; marketing incentive depending upon the volume of business done by him / her as per terms and condition of the company.</p>

            <p>The information contained in this website is for general information purposes only. the information is provided by Amberveda Wellness Private Limited and while we Endeavour to keep the information up to date and correct, we make no representation or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>

            <p>In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage or any loss or damage whatsoever arising from loss of data or profits arise out of or in correction with the use of this website.</p>

            <p>Through this website you are able to link to other websites which are not under the control of Amberveda Wellness Private Limited we have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.</p>

            <p>Every effort is made to keep the website up and running smoothly. However Amberveda Wellness Private Limited takes no responsibility for and will not be liable for the website being temporarily unavailable due to technical issues beyond our control.</p>

            <div class="disclaimer-note-card">
                <strong>NOTE :</strong>
                <p>PRODUCT RETURN WITH IN 30 DAYS. &nbsp;&nbsp;&nbsp;&nbsp; Terms and condition apply</p>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        function openDisclaimer() {
            var overlay = document.getElementById('disclaimerModalOverlay');
            if (overlay) {
                overlay.classList.remove('hidden');
                document.body.classList.add('disclaimer-locked');
                document.documentElement.classList.add('disclaimer-locked');
            }
        }

        function closeDisclaimer() {
            var overlay = document.getElementById('disclaimerModalOverlay');
            if (overlay) {
                overlay.classList.add('hidden');
                document.body.classList.remove('disclaimer-locked');
                document.documentElement.classList.remove('disclaimer-locked');
            }
        }

        // Show automatically on page load / reload
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initDisclaimer);
        } else {
            initDisclaimer();
        }

        function initDisclaimer() {
            openDisclaimer();
            var closeBtn = document.getElementById('disclaimerCloseBtn');
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeDisclaimer();
                });
            }
        }
    })();
</script>
