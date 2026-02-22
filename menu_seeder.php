<?php

use App\Models\Menu;
use App\Models\MenuItem;
use App\Enums\MenuLocationEnum;

$headerMenu = Menu::create([
    'name' => 'Main Navbar',
    'location' => MenuLocationEnum::HEADER
]);

$items = [
    ['title' => 'Home', 'custom_url' => '/', 'sort_order' => 1],
    ['title' => 'About', 'custom_url' => '/about', 'sort_order' => 2],
    ['title' => 'Services', 'custom_url' => '/services', 'sort_order' => 3],
    ['title' => 'Portfolio', 'custom_url' => '/portfolio', 'sort_order' => 4],
    ['title' => 'Blog', 'custom_url' => '/blog', 'sort_order' => 5],
    ['title' => 'Contact', 'custom_url' => '/contact', 'sort_order' => 6],
];

foreach ($items as $item) {
    $headerMenu->items()->create(array_merge($item, ['is_active' => true, 'target' => '_self']));
}

$footerMenu = Menu::create([
    'name' => 'Footer Links',
    'location' => MenuLocationEnum::FOOTER
]);

foreach ($items as $item) {
    if ($item['title'] !== 'Contact') {
        $footerMenu->items()->create(array_merge($item, ['is_active' => true, 'target' => '_self']));
    }
}

echo "Menus seeded successfully!\n";
