<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$blade = $app['blade.compiler'];
$viewPath = resource_path('views/frontend/index.blade.php');
$content = file_get_contents($viewPath);
$compiled = $blade->compileString($content);

preg_match('/<ul class="navbar-nav[^"]*">(.*?)<\/ul>/s', $compiled, $navMatch);
echo "1. Navbar #mission visible in compiled output: " . (isset($navMatch[1]) && strpos($navMatch[1], 'href="#mission"') !== false ? 'YES (FAIL)' : 'NO (PASS)') . PHP_EOL;

echo "2. About Us contains moved mission block: " . (strpos($compiled, 'MISSION & VISION SECTION (Moved into About Us)') !== false ? 'YES (PASS)' : 'NO (FAIL)') . PHP_EOL;

echo "3. Standalone original section rendered: " . (strpos($compiled, 'ORIGINAL STANDALONE MISSION & VISION SECTION') !== false ? 'YES (FAIL)' : 'NO (PASS)') . PHP_EOL;

preg_match_all('/class="mv-card[^"]*"/i', $compiled, $matches);
echo "4. Rendered mv-card count: " . count($matches[0]) . " (Expected: 5)" . PHP_EOL;

$cards = ["Our <span>Vision</span>", "Our <span>Mission</span>", "Nature First", "Science Backed", "Community Driven"];
foreach ($cards as $c) {
    echo "5. Card present ($c): " . (strpos($compiled, $c) !== false ? 'YES (PASS)' : 'NO (FAIL)') . PHP_EOL;
}
