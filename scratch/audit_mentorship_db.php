<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== CHECKING mentorship_incomes TABLE ===\n";

if (!Schema::hasTable('mentorship_incomes')) {
    echo "TABLE 'mentorship_incomes' DOES NOT EXIST!\n";
    
    // Check tables with similar names
    $tables = DB::select('SHOW TABLES');
    $dbName = DB::getDatabaseName();
    $key = "Tables_in_" . $dbName;
    echo "Searching for similar tables in $dbName:\n";
    foreach ($tables as $t) {
        $tableName = $t->$key;
        if (stripos($tableName, 'mentor') !== false || stripos($tableName, 'income') !== false) {
            echo " - $tableName\n";
        }
    }
    exit(0);
}

echo "TABLE 'mentorship_incomes' EXISTS!\n\n";

// 1. Column details
echo "--- COLUMNS (DESCRIBE mentorship_incomes) ---\n";
$columns = DB::select('DESCRIBE mentorship_incomes');
foreach ($columns as $col) {
    echo sprintf(
        "Field: %-25s | Type: %-20s | Null: %-4s | Key: %-4s | Default: %-15s | Extra: %s\n",
        $col->Field,
        $col->Type,
        $col->Null,
        $col->Key,
        var_export($col->Default, true),
        $col->Extra
    );
}

// 2. Indexes
echo "\n--- INDEXES (SHOW INDEX FROM mentorship_incomes) ---\n";
$indexes = DB::select('SHOW INDEX FROM mentorship_incomes');
foreach ($indexes as $idx) {
    echo sprintf(
        "Key_name: %-25s | Column_name: %-20s | Non_unique: %d | Index_type: %s\n",
        $idx->Key_name,
        $idx->Column_name,
        $idx->Non_unique,
        $idx->Index_type
    );
}

// 3. Foreign Keys
echo "\n--- FOREIGN KEYS ---\n";
$fks = DB::select("
    SELECT 
        TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
    FROM
        INFORMATION_SCHEMA.KEY_COLUMN_USAGE
    WHERE
        TABLE_SCHEMA = ? AND TABLE_NAME = 'mentorship_incomes' AND REFERENCED_TABLE_NAME IS NOT NULL
", [DB::getDatabaseName()]);

if (empty($fks)) {
    echo "No explicit foreign key constraints defined in Information Schema.\n";
} else {
    foreach ($fks as $fk) {
        echo "Constraint: {$fk->CONSTRAINT_NAME} | Column: {$fk->COLUMN_NAME} -> References {$fk->REFERENCED_TABLE_NAME}({$fk->REFERENCED_COLUMN_NAME})\n";
    }
}

// 4. Record count & Sample data
$count = DB::table('mentorship_incomes')->count();
echo "\n--- RECORD COUNT: $count ---\n";

if ($count > 0) {
    echo "\n--- SAMPLE RECORDS (First 3) ---\n";
    $samples = DB::table('mentorship_incomes')->take(3)->get();
    foreach ($samples as $i => $row) {
        echo "Record #$i:\n";
        print_r($row);
    }
} else {
    echo "No records currently in mentorship_incomes.\n";
}
