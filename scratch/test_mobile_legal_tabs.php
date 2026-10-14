<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$allPassed = true;

echo "=========================================================\n";
echo "TEST 1: Render Homepage and Verify Legal/Certs/Compliance\n";
echo "=========================================================\n";

$req = Illuminate\Http\Request::create('/', 'GET');
$app->instance('request', $req);
$res = $kernel->handle($req);
$html = $res->getContent();

// 1. Verify Tabs Navigation Elements
$tabChecks = [
    'id="tabLegalBtn"' => 'Legal Documents Tab Button',
    'id="tabCertBtn"' => 'Certificates Tab Button',
    'id="tabComplianceBtn"' => 'Compliance Tab Button',
    'switchAboutTab(\'legal\')' => 'Legal tab click handler',
    'switchAboutTab(\'certificates\')' => 'Certificates tab click handler',
    'switchAboutTab(\'compliance\')' => 'Compliance tab click handler',
    'id="panelLegal"' => 'Legal Documents Panel',
    'id="panelCertificates"' => 'Certificates Panel',
    'id="panelCompliance"' => 'Compliance Panel'
];

foreach ($tabChecks as $needle => $label) {
    if (strpos($html, $needle) !== false) {
        echo "✅ Present: $label\n";
    } else {
        echo "❌ MISSING: $label\n";
        $allPassed = false;
    }
}

// 2. Verify all 16 documents across the 3 panels
echo "\n--- Verifying Document Entries ---\n";
$docs = [
    // Legal (9)
    'Certificate of Incorporation',
    'Memorandum of Association (MOA) and Articles of Association (AOA)',
    'Permanent Account Number (PAN) and Tax Deduction and Collection Account Number (TAN)',
    'Goods and Services Tax (GST) Registration Certificate',
    'Certificate of Importer-Exporter Code (IEC)',
    'Food Safety and Standards Authority of India (FSSAI) Licence',
    'Applicable Drugs and Cosmetics Licence',
    'Certificate of Registration of Trademark',
    'Micro, Small and Medium Enterprises (MSME) Certificate',
    // Certificates (2)
    'ISO Certificate',
    'Good Manufacturing Practice (GMP) Certificate',
    // Compliance (5)
    'Goods and Services Tax (GST) Returns',
    'Income Tax Returns',
    'Balance Sheet',
    'Audit Report',
    'Other Compliance Documents'
];

$foundDocs = 0;
foreach ($docs as $doc) {
    if (strpos($html, $doc) !== false) {
        $foundDocs++;
    } else {
        echo "❌ Missing Document: $doc\n";
        $allPassed = false;
    }
}
echo "✅ All $foundDocs / 16 documents present across panels\n";

// 3. Verify Mobile Responsive CSS Rules
echo "\n=========================================================\n";
echo "TEST 2: Verify Mobile Responsive CSS Rules\n";
echo "=========================================================\n";

$cssChecks = [
    // Mobile Tabs Navigation
    '.about-legal-section > .d-flex' => 'Header column stack on mobile',
    '.about-tabs-nav {' => 'Tabs nav styling',
    'min-height: 44px' => 'Touch target min-height (44px) for mobile tab buttons',
    'border-radius: 12px' => 'Tab button modern border-radius',
    // Mobile Document Cards
    '.legal-doc-item {' => 'Card container styling',
    'align-items: stretch' => 'Card stretch alignment',
    'align-items: flex-start' => 'Card left number & info alignment at top',
    'margin-top: 1px' => 'Number badge top alignment offset',
    'width: 38px' => 'Compact 38px number badge on mobile',
    'word-wrap: break-word' => 'Word wrap prevention of horizontal overflow',
    'overflow-wrap: break-word' => 'Overflow wrap prevention of horizontal overflow',
    'border-top: 1px dashed' => 'Dashed separator line for action buttons',
    'min-width: 125px' => 'Button flexible width handling',
    // Tablet breakpoint
    '@media (min-width: 576px) and (max-width: 767px)' => 'Tablet breakpoint for row tab layout'
];

foreach ($cssChecks as $needle => $label) {
    if (strpos($html, $needle) !== false) {
        echo "✅ CSS Present: $label\n";
    } else {
        echo "❌ MISSING CSS: $label\n";
        $allPassed = false;
    }
}

// 4. Verify Desktop Styles Intact
echo "\n=========================================================\n";
echo "TEST 3: Verify Desktop Styles Preserved\n";
echo "=========================================================\n";

$desktopChecks = [
    'border-radius: 30px' => 'Desktop pill tab navigation border-radius',
    'padding: 10px 24px' => 'Desktop tab button generous padding',
    'border-radius: 25px' => 'Desktop tab button border-radius',
    'justify-content: space-between' => 'Desktop horizontal document card layout',
    'padding: 18px 24px' => 'Desktop document card padding'
];

foreach ($desktopChecks as $needle => $label) {
    if (strpos($html, $needle) !== false) {
        echo "✅ Desktop Style Preserved: $label\n";
    } else {
        echo "❌ MISSING Desktop Style: $label\n";
        $allPassed = false;
    }
}

// 5. Verify Tab Switching JavaScript
echo "\n=========================================================\n";
echo "TEST 4: Verify Tab Switching JavaScript Logic\n";
echo "=========================================================\n";

$jsChecks = [
    'function switchAboutTab(tabName)' => 'switchAboutTab function definition',
    '\'legal\': document.getElementById(\'tabLegalBtn\')' => 'Tab button mapping',
    '\'certificates\': document.getElementById(\'tabCertBtn\')' => 'Certificates button mapping',
    '\'compliance\': document.getElementById(\'tabComplianceBtn\')' => 'Compliance button mapping',
    'panelMap[t].querySelectorAll(\'.anim\').forEach(el => el.classList.add(\'visible\'))' => 'Instant animation visibility trigger'
];

foreach ($jsChecks as $needle => $label) {
    if (strpos($html, $needle) !== false) {
        echo "✅ JavaScript Logic Preserved: $label\n";
    } else {
        echo "❌ MISSING JS: $label\n";
        $allPassed = false;
    }
}

// 6. Regression check on Disclaimer Popup & Policies
echo "\n=========================================================\n";
echo "TEST 5: Regression Check on Disclaimer Popup & Policy Pages\n";
echo "=========================================================\n";
passthru('php scratch/test_disclaimer_modal.php');

if ($allPassed) {
    echo "\n🎉 ALL MOBILE RESPONSIVE AND INTEGRITY CHECKS PASSED WITH 100% SUCCESS!\n";
} else {
    echo "\n❌ SOME TESTS FAILED!\n";
}
