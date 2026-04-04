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
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.content.site-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Text fields
        $textFields = [
            'site_name',
            'site_tagline',
            'site_description',
            'site_email',
            'site_phone',
            'site_address',
            'footer_text',
            'copyright_text',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'google_analytics_id',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $request->$field ?? '',
                        'group' => $this->getGroup($field),
                        'type' => 'text',
                    ]
                );
            }
        }

        // File uploads
        $fileFields = ['site_logo', 'site_logo_white', 'site_favicon', 'contact_image'];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                // Delete old file
                $old = Setting::where('key', $fileField)->value('value');
                if ($old && file_exists(public_path($old))) {
                    @unlink(public_path($old));
                }

                $file = $request->file($fileField);
                $filename = $fileField . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);

                Setting::updateOrCreate(
                    ['key' => $fileField],
                    [
                        'value' => 'uploads/settings/' . $filename,
                        'group' => 'branding',
                        'type' => 'file',
                    ]
                );
            }
        }

        // Clear all caches
        Cache::forget('global_settings');
        Cache::forget('site_settings');
        Cache::forget('social_links');
        Cache::forget('theme_primary_color');
        Cache::forget('theme_font_color');
        Cache::forget('theme_bg_color');

        return back()->with('success', 'Settings updated successfully.');
    }

    private function getGroup(string $field): string
    {
        if (in_array($field, ['meta_title', 'meta_description', 'meta_keywords', 'google_analytics_id'])) {
            return 'seo';
        }
        return 'general';
    }
}
