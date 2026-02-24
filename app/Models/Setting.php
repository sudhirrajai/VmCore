<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Services\SettingService;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group', 'type'];

    /**
     * Get a setting by key, wrapper around cache service.
     */
    public static function get($key, $default = null)
    {
        if (app()->bound(SettingService::class)) {
            return app(SettingService::class)->get($key, $default);
        }

        // Fallback caching
        $settings = Cache::rememberForever('global_settings', function () {
            return self::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting by key and clear cache.
     */
    public static function set($key, $value)
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);

        if (app()->bound(SettingService::class)) {
            app(SettingService::class)->clearCache();
        } else {
            Cache::forget('global_settings');
        }
    }
}
