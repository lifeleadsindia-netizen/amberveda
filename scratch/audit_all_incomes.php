<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$incomeTables = [
    'mentorship_incomes',
    'direct_incomes',
    'level_incomes',
    'club_incomes',
    'delivery_incomes',
    'reward_incomes',
    'sales_bonus_incomes'
];

foreach ($incomeTables as $table) {
    echo "====================================================\n";
    echo "TABLE: $table\n";
    echo "====================================================\n";
    try {
        $cols = DB::select("DESCRIBE $table");
        foreach ($cols as $c) {
            echo sprintf("  %-20s | %-16s | Null: %-3s | Default: %s\n", $c->Field, $c->Type, $c->Null, var_export($c->Default, true));
        }
        $count = DB::table($table)->count();
        echo "Total Rows: $count\n";
        if ($count > 0) {
            echo "Sample Row:\n";
            $sample = DB::table($table)->first();
            print_r($sample);
        }
    } catch (\Exception $e) {
        echo "Error or table missing: " . $e->getMessage() . "\n";
    }
    echo "\n";
}
