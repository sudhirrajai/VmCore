<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');

        return view('admin.content.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
        ]);

        foreach ($request->settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'] ?? '']
            );
        }

        // Clear all theme-related cache
        Cache::forget('theme_primary_color');
        Cache::forget('theme_font_color');
        Cache::forget('theme_bg_color');
        Cache::forget('site_settings');

        return back()->with('success', 'Settings updated successfully.');
    }

    public function updateGeneral(Request $request)
    {
        $fields = [
            'site_name',
            'site_tagline',
            'site_description',
            'site_email',
            'site_phone',
            'site_address',
            'site_logo',
            'site_favicon',
            'google_map_url',
            'footer_text',
            'copyright_text',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $request->$field,
                        'group' => 'general',
                        'type' => 'text',
                    ]
                );
            }
        }

        // Handle logo and favicon uploads
        foreach (['site_logo', 'site_favicon'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $filename = $fileField . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);

                Setting::updateOrCreate(
                    ['key' => $fileField],
                    [
                        'value' => 'uploads/settings/' . $filename,
                        'group' => 'general',
                        'type' => 'file',
                    ]
                );
            }
        }

        Cache::forget('site_settings');

        return back()->with('success', 'General settings updated successfully.');
    }
}
