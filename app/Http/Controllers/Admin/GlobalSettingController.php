<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class GlobalSettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.global', compact('settings'));
    }

    public function update(Request $request)
    {
        $textFields = [
            'site_name',
            'footer_text',
            'contact_email',
            'phone',
            'address',
            'default_meta_title',
            'default_meta_description',
            'meta_keywords',
            'header_code',
            'footer_code',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $request->$field ?? '']
                );
            }
        }

        // Deal with social links (json list)
        if ($request->has('social_links')) {
            $linksConfig = $request->input('social_links');
            $validLinks = [];
            foreach ($linksConfig as $link) {
                if (!empty($link['url']) && !empty($link['icon_class'])) {
                    $validLinks[] = $link;
                }
            }
            Setting::updateOrCreate(
                ['key' => 'social_links'],
                ['value' => json_encode($validLinks)]
            );
        }

        // File uploads
        $fileFields = ['logo', 'favicon', 'footer_logo', 'logo_white'];

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
                    ['value' => 'uploads/settings/' . $filename]
                );
            }
        }

        $this->settingService->clearCache();

        return back()->with('success', 'Global Settings updated successfully.');
    }
}
