<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    /**
     * Get a setting by key, from cache or DB.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $settings = Cache::rememberForever('global_settings', function () {
            // Fetch all settings and pluck key => value
            return Setting::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Clear the cache when settings are updated.
     */
    public function clearCache()
    {
        Cache::forget('global_settings');
    }
}
