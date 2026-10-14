<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$cols = DB::select("DESCRIBE member_details");
echo "member_details columns:\n";
foreach ($cols as $c) {
    echo "- {$c->Field} ({$c->Type})\n";
}
$first = DB::table('member_details')->first();
echo "\nSample member row:\n";
print_r($first);
