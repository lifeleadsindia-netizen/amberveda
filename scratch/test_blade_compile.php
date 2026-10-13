<?php
require __DIR__ . '/../../../../../../xampp/htdocs/Amberveda/vendor/autoload.php';
$app = require __DIR__ . '/../../../../../../xampp/htdocs/Amberveda/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$blade = app('blade.compiler');
$viewContent = file_get_contents(__DIR__ . '/../../../../../../xampp/htdocs/Amberveda/resources/views/frontend/index.blade.php');
$compiled = $blade->compileString($viewContent);

// Test for the HTML markup of Business Plan (not CSS classes)
$bpMarkupFound = strpos($compiled, 'id="business-plan"') !== false;
$bpTextFound1 = strpos($compiled, 'Types of <span>Incentives</span>') !== false;
$bpTextFound2 = strpos($compiled, 'LEGEND STAR') !== false;
$bpTextFound3 = strpos($compiled, 'Selling products directly to the customers is the first step') !== false;

$profileFound = strpos($compiled, 'about-profile-card') !== false;
$mgmtFound = strpos($compiled, 'about-mgmt-wrapper') !== false;
$legalFound = strpos($compiled, 'about-legal-section') !== false;
$footerPolicies = strpos($compiled, 'uploads/policies/privacy-policy.pdf') !== false;

echo "--- COMPILED OUTPUT VERIFICATION ---\n";
echo "Business Plan HTML markup hidden: " . (!$bpMarkupFound ? "YES (CONFIRMED HIDDEN)" : "NO (FAILED)") . "\n";
echo "Incentives text hidden: " . (!$bpTextFound1 ? "YES (CONFIRMED HIDDEN)" : "NO (FAILED)") . "\n";
echo "18 Ranks text (LEGEND STAR) hidden: " . (!$bpTextFound2 ? "YES (CONFIRMED HIDDEN)" : "NO (FAILED)") . "\n";
echo "Retail profit text hidden: " . (!$bpTextFound3 ? "YES (CONFIRMED HIDDEN)" : "NO (FAILED)") . "\n";
echo "Company Profile visible: " . ($profileFound ? "YES (CONFIRMED)" : "NO (FAILED)") . "\n";
echo "Management Details visible: " . ($mgmtFound ? "YES (CONFIRMED)" : "NO (FAILED)") . "\n";
echo "Legal Documents visible: " . ($legalFound ? "YES (CONFIRMED)" : "NO (FAILED)") . "\n";
echo "Footer Policies visible: " . ($footerPolicies ? "YES (CONFIRMED)" : "NO (FAILED)") . "\n";
