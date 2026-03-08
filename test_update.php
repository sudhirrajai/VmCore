<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::enableQueryLog();

try {
    $project = App\Models\Project::find(1);
    if ($project) {
        $project->update(['title' => 'Updated Title ' . time()]);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\nQuery log:\n";
var_dump(DB::getQueryLog());
