<?php

namespace App\Services;

use App\Models\Menu;
use App\Enums\MenuLocationEnum;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    /**
     * Get menu items by location, eager loading nested children recursively.
     */
    public function getMenuByLocation(MenuLocationEnum $location)
    {
        $menu = Menu::where('location', $location)->first();
        if (!$menu) {
            return collect([]);
        }

        // parent_items gets root items. The children relationship is eager loaded recursively.
        return $menu->parent_items()->where('is_active', true)->get();
    }

    /**
     * Clear all menu caches.
     */
    public function clearCache()
    {
        foreach (MenuLocationEnum::cases() as $location) {
            Cache::forget('menu_' . $location->value);
        }
    }
}
