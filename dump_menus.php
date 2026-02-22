<?php
require 'vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$menu = App\Models\Menu::find(1);
$menu->load(['parent_items.children']);
$titles = $menu->parent_items->pluck('title')->toArray();

file_put_contents('d:\VmCore\portfolio\VmCore\menu_dump.txt', json_encode($titles, JSON_PRETTY_PRINT));
