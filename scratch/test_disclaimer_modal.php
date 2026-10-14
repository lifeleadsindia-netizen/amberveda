<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$allPassed = true;

echo "========================================\n";
echo "TEST 1: Homepage Disclaimer Popup Presence\n";
$req = Illuminate\Http\Request::create('/', 'GET');
$app->instance('request', $req);
$res = $kernel->handle($req);
$content = $res->getContent();

// 1. Overlay & Close Button
$checks = [
    'disclaimerModalOverlay' => 'Modal overlay element',
    'disclaimerCloseBtn' => 'Close button element',
    'fa-times' => 'Close button icon',
    'Close' => 'Close button text label',
    'DISCLAIMER <span>CLAUSE</span>' => 'Disclaimer title with span accent',
    'disclaimer-locked' => 'Scroll lock class handler',
    'disclaimer-modal-body' => 'Scrollable body container',
    'Before venturing into our website' => 'Paragraph 1: Direct selling business intro',
    'NO deposit or any charges / enrolment fees / joining fees / renewal charges' => 'Paragraph 2: No charges bold text',
    'www.ambervedawellness.com' => 'Paragraph 2: Official domain',
    'assurance or promise by the company or its Direct Sellers' => 'Paragraph 3: Income declaration',
    'general information purposes only' => 'Paragraph 4: Information purposes disclaimer',
    'indirect or consequential loss or damage' => 'Paragraph 5: Liability exclusion',
    'Through this website you are able to link to other websites' => 'Paragraph 6: Third-party link disclaimer',
    'Every effort is made to keep the website up and running smoothly' => 'Paragraph 7: Availability disclaimer',
    'NOTE :' => 'Note section header',
    'PRODUCT RETURN WITH IN 30 DAYS' => 'Note return text',
    'Terms and condition apply' => 'Note terms condition apply'
];

foreach ($checks as $needle => $label) {
    if (strpos($content, $needle) !== false) {
        echo "✅ Present: $label\n";
    } else {
        echo "❌ MISSING: $label (needle: $needle)\n";
        $allPassed = false;
    }
}

// 2. CSS Check
echo "\n--- Checking CSS Rules in Homepage ---\n";
$cssChecks = [
    '.disclaimer-modal-overlay' => 'Overlay fixed positioning',
    'z-index: 999999' => 'High z-index covering all site content',
    'overflow-y: auto' => 'Vertical scrolling in body',
    'html.disclaimer-locked' => 'Background scroll prevention rule',
    'animation: disclaimerZoomIn' => 'Smooth popup entrance animation'
];
foreach ($cssChecks as $needle => $label) {
    if (strpos($content, $needle) !== false) {
        echo "✅ CSS Rule: $label\n";
    } else {
        echo "❌ MISSING CSS: $label\n";
        $allPassed = false;
    }
}

// 3. Negative check: Modal must NOT appear on policy pages (Homepage only requirement)
echo "\n========================================\n";
echo "TEST 2: Policy Pages (Disclaimer popup must NOT appear)\n";
$policySlugs = ['privacy-policy', 'terms-of-use', 'shipping-policy', 'buyback-refund-policy', 'cooling-off-policy'];
foreach ($policySlugs as $slug) {
    $pReq = Illuminate\Http\Request::create('/?policy=' . $slug, 'GET');
    $app->instance('request', $pReq);
    $pRes = $kernel->handle($pReq);
    $pContent = $pRes->getContent();
    if (strpos($pContent, 'id="disclaimerModalOverlay"') === false) {
        echo "✅ Correctly excluded from policy page: $slug\n";
    } else {
        echo "❌ LEAK: Disclaimer popup appeared on policy page: $slug\n";
        $allPassed = false;
    }
}

// 4. Check generated file assets
echo "\n========================================\n";
echo "TEST 3: Document Assets in Public Directory\n";
$docxAsset = 'public/uploads/documents/DISCLAIMER CLAUSE (2).docx';
$pdfAsset = 'public/uploads/documents/disclaimer-clause.pdf';

if (file_exists($docxAsset) && filesize($docxAsset) > 0) {
    echo "✅ Preserved DOCX asset exists: $docxAsset (" . filesize($docxAsset) . " bytes)\n";
} else {
    echo "❌ Missing or empty DOCX asset: $docxAsset\n";
    $allPassed = false;
}

if (file_exists($pdfAsset) && filesize($pdfAsset) > 0) {
    $header = file_get_contents($pdfAsset, false, null, 0, 8);
    if (strpos($header, '%PDF-1.4') !== false) {
        echo "✅ Generated PDF asset exists and is valid: $pdfAsset (" . filesize($pdfAsset) . " bytes)\n";
    } else {
        echo "❌ PDF asset exists but is not valid PDF-1.4: $pdfAsset\n";
        $allPassed = false;
    }
} else {
    echo "❌ Missing or empty PDF asset: $pdfAsset\n";
    $allPassed = false;
}

// 5. Existing policy tests regression check
echo "\n========================================\n";
echo "TEST 4: Regression Check on All Existing Policy Views\n";
passthru('php scratch/test_policy_views.php');

echo "\n========================================\n";
if ($allPassed) {
    echo "🎉 ALL DISCLAIMER POPUP TESTS PASSED WITH 100% SUCCESS!\n";
} else {
    echo "❌ SOME TESTS FAILED.\n";
}
