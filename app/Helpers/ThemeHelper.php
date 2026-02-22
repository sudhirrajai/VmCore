<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class ThemeHelper
{
    /**
     * Get the primary theme color.
     *
     * @return string
     */
    public static function getPrimaryColor()
    {
        return Cache::remember('theme_primary_color', 60 * 24, function () {
            return Setting::where('key', 'theme_primary_color')->value('value') ?? '#0ea5e9'; // Default Sky Blue
        });
    }

    /**
     * Get the primary theme color in RGB format.
     *
     * @return string
     */
    public static function getPrimaryColorRgb()
    {
        $hex = self::getPrimaryColor();
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return "$r, $g, $b";
    }

    /**
     * Get the font color.
     *
     * @return string
     */
    public static function getFontColor()
    {
        return Cache::remember('theme_font_color', 60 * 24, function () {
            return Setting::where('key', 'theme_font_color')->value('value') ?? '#646e78'; // Default Gray
        });
    }

    /**
     * Get the background color.
     *
     * @return string
     */
    public static function getBackgroundColor()
    {
        return Cache::remember('theme_bg_color', 60 * 24, function () {
            return Setting::where('key', 'theme_bg_color')->value('value') ?? '#f5f5f9'; // Default Light Gray
        });
    }
}
