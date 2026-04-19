<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // Default robots.txt content if not set
        if (!isset($settings['robots_txt'])) {
            $settings['robots_txt'] = "User-agent: *\nAllow: /\n\nSitemap: " . route('sitemap');
        }

        return view('admin.settings.seo', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'robots_txt' => 'nullable|string',
            'sitemap_enabled' => 'nullable|string',
        ]);

        $fields = [
            'robots_txt',
            'sitemap_enabled',
        ];

        foreach ($fields as $field) {
            Setting::updateOrCreate(
                ['key' => $field],
                ['value' => $request->input($field, ($field === 'sitemap_enabled' ? '0' : ''))]
            );
        }

        $this->settingService->clearCache();

        return back()->with('success', 'SEO Settings updated successfully.');
    }
}
