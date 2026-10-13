<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$testCases = [
    [
        'slug' => null,
        'title' => 'Homepage',
        'expectedText' => ['Two Pillars of', 'About Us', 'Send Message'],
        'notExpected' => ['7-Day Statutory Cooling Off Period', '<section class="policy-page-section']
    ],
    [
        'slug' => 'privacy-policy',
        'title' => 'Privacy Policy & Data Protection Charter',
        'expectedText' => [
            'PRIVACY POLICY &amp; DATA PROTECTION CHARTER',
            'STATUTORY DECREE &amp; LEGAL FRAMEWORK',
            'Ms.Parul Yadav',
            'grievance@ambervedawellness.com',
            'Back to Website',
            'Return to Main Website'
        ],
        'notExpected' => ['Two Pillars of', 'Empowering Health']
    ],
    [
        'slug' => 'terms-of-use',
        'title' => 'Website Terms of Use',
        'expectedText' => [
            'WEBSITE TERMS OF USE',
            'LEGAL COMPLIANCE AND ELECTRONIC RECORD NOTICE',
            '1. PRELIMINARY DEFINITIONS AND CORPORATE INFORMATION',
            '7. TERMS OF SALE',
            'Back to Website',
            'Return to Main Website'
        ],
        'notExpected' => ['Two Pillars of', 'Empowering Health']
    ],
    [
        'slug' => 'shipping-policy',
        'title' => 'Shipping Policy',
        'expectedText' => [
            'SHIPPING POLICY',
            'STATUTORY PREAMBLE &amp; COMPLIANCE ACKNOWLEDGEMENT',
            '1. MODALITIES OF ORDER PLACEMENT AND FULFILLMENT',
            'Monday through Friday: 10:00 AM to 06:00 PM',
            'Arbitration and Conciliation Act, 1996',
            'Back to Website',
            'Return to Main Website'
        ],
        'notExpected' => ['Two Pillars of', 'Empowering Health']
    ],
    [
        'slug' => 'buyback-refund-policy',
        'title' => 'Buyback / Refund / Cancellation Policy',
        'expectedText' => [
            'BUY BACK / EXCHANGE / REFUND POLICY',
            'Buyback / Refund Policy:',
            '100% of the amount as refund will be given within 10 working days',
            'Marketable refers to products that are unopened',
            'Product Return Form',
            'Back to Website',
            'Return to Main Website'
        ],
        'notExpected' => ['Two Pillars of', 'Empowering Health']
    ],
    [
        'slug' => 'cooling-off-policy',
        'title' => 'Cooling Off Policy',
        'expectedText' => [
            'COOLING OFF POLICY',
            '7 (seven) days',
            '(Ankit Yadav)',
            'Nodal Officer',
            'Back to Website',
            'Return to Main Website'
        ],
        'notExpected' => ['Two Pillars of', 'Empowering Health']
    ]
];

$allPassed = true;

foreach ($testCases as $tc) {
    $url = '/' . ($tc['slug'] ? '?policy=' . $tc['slug'] : '');
    $request = Illuminate\Http\Request::create($url, 'GET');
    $app->instance('request', $request);
    
    // Render view through kernel pipeline
    $response = $kernel->handle($request);
    $content = $response->getContent();

    echo "========================================\n";
    echo "TEST: " . ($tc['slug'] ? "Policy page [{$tc['slug']}]" : "Homepage") . "\n";
    echo "URL: $url\n";

    // 1. Check footer policy links
    $expectedSlugs = [
        'policy=privacy-policy',
        'policy=terms-of-use',
        'policy=shipping-policy',
        'policy=buyback-refund-policy',
        'policy=cooling-off-policy'
    ];
    $footerLinksOk = true;
    foreach ($expectedSlugs as $slug) {
        if (strpos($content, $slug) === false) {
            echo "❌ Missing footer link parameter: $slug\n";
            $footerLinksOk = false;
            $allPassed = false;
        }
    }
    if ($footerLinksOk) {
        echo "✅ All 5 footer policy links present in footer\n";
    }

    // 2. Check that the Policies column does NOT contain any .pdf link
    preg_match('/<h5 class="f-head">Policies<\/h5>\s*<ul class="f-links">(.*?)<\/ul>/s', $content, $footMatch);
    if (!empty($footMatch[1])) {
        if (strpos($footMatch[1], '.pdf') !== false) {
            echo "❌ Footer Policies column still contains a .pdf link!\n";
            $allPassed = false;
        } else {
            echo "✅ Footer Policies column contains 0 .pdf links (all open web pages)\n";
        }
    } else {
        echo "❌ Could not parse Policies column in footer\n";
        $allPassed = false;
    }

    // 3. Check expected content strings
    $contentOk = true;
    foreach ($tc['expectedText'] as $txt) {
        if (strpos($content, $txt) === false) {
            echo "❌ Missing expected text: '$txt'\n";
            $contentOk = false;
            $allPassed = false;
        }
    }
    if ($contentOk) {
        echo "✅ All expected content strings verified\n";
    }

    // 4. Check not expected strings (isolation)
    $notExpectedOk = true;
    foreach ($tc['notExpected'] as $nxt) {
        if (strpos($content, $nxt) !== false) {
            echo "❌ Found unexpected text: '$nxt'\n";
            $notExpectedOk = false;
            $allPassed = false;
        }
    }
    if ($notExpectedOk) {
        echo "✅ Content isolation verified (no leak of unrelated section)\n";
    }
}

// Test pre-existing routes in routes/web.php
foreach (['/privacy-policy', '/terms-condition'] as $u) {
    $request = Illuminate\Http\Request::create($u, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    $content = $response->getContent();
    echo "========================================\n";
    echo "TEST PRE-EXISTING ROUTE: $u | HTTP Status: $status\n";
    if ($status === 200 && strpos($content, 'location.replace') !== false) {
        echo "✅ Pre-existing route cleanly forwards to dedicated policy view\n";
    } else {
        echo "❌ Pre-existing route test failed\n";
        $allPassed = false;
    }
}

echo "========================================\n";
if ($allPassed) {
    echo "🎉 ALL TESTS PASSED WITH 100% SUCCESS!\n";
} else {
    echo "❌ SOME TESTS FAILED.\n";
}
