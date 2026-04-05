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
     * Get the secondary theme color.
     *
     * @return string
     */
    public static function getSecondaryColor()
    {
        return Cache::remember('theme_secondary_color', 60 * 24, function () {
            return Setting::where('key', 'theme_secondary_color')->value('value') ?? '#f59e0b'; // Default Amber/Yellow
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
     * Get the secondary theme color in RGB format.
     *
     * @return string
     */
    public static function getSecondaryColorRgb()
    {
        $hex = self::getSecondaryColor();
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
        return Cache::rememberForever('theme_font_color', function () {
            return Setting::where('key', 'theme_font_color')->value('value') ?? '#646e78';
        });
    }

    public static function getFontColorRgb()
    {
        return self::hexToRgb(self::getFontColor());
    }

    public static function getCardColor()
    {
        return Cache::rememberForever('theme_card_color', function () {
            return Setting::where('key', 'theme_card_color')->value('value') ?? '#ffffff';
        });
    }

    public static function getBorderColor()
    {
        return Cache::rememberForever('theme_border_color', function () {
            return Setting::where('key', 'theme_border_color')->value('value') ?? '#f1f5f9';
        });
    }

    public static function getFooterColor()
    {
        return Cache::rememberForever('theme_footer_color', function () {
            return Setting::where('key', 'theme_footer_color')->value('value') ?? '#f2f1ed';
        });
    }

    public static function getIconBgColor()
    {
        return Cache::rememberForever('theme_icon_bg_color', function () {
            return Setting::where('key', 'theme_icon_bg_color')->value('value') ?? '#f2f1ed';
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

    private static function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return "$r, $g, $b";
    }
}
