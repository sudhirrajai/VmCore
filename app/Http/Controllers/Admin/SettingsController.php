<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        $primaryColor = Setting::where('key', 'theme_primary_color')->value('value') ?? '#0ea5e9';
        $secondaryColor = Setting::where('key', 'theme_secondary_color')->value('value') ?? '#f59e0b';
        $fontColor = Setting::where('key', 'theme_font_color')->value('value') ?? '#646e78';
        $bgColor = Setting::where('key', 'theme_bg_color')->value('value') ?? '#f5f5f9';
        $cardColor = Setting::where('key', 'theme_card_color')->value('value') ?? '#ffffff';
        $borderColor = Setting::where('key', 'theme_border_color')->value('value') ?? '#f1f5f9';
        $footerColor = Setting::where('key', 'theme_footer_color')->value('value') ?? '#f2f1ed';
        $iconBgColor = Setting::where('key', 'theme_icon_bg_color')->value('value') ?? '#f2f1ed';

        return view('admin.settings.index', compact('primaryColor', 'secondaryColor', 'fontColor', 'bgColor', 'cardColor', 'borderColor', 'footerColor', 'iconBgColor'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'theme_primary_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'theme_secondary_color' => 'nullable|string',
            'theme_font_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'theme_bg_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'theme_card_color' => 'nullable|string',
            'theme_border_color' => 'nullable|string',
            'theme_footer_color' => 'nullable|string',
            'theme_icon_bg_color' => 'nullable|string',
        ]);

        $settings = [
            'theme_primary_color' => $request->theme_primary_color,
            'theme_secondary_color' => $request->theme_secondary_color,
            'theme_font_color' => $request->theme_font_color,
            'theme_bg_color' => $request->theme_bg_color,
            'theme_card_color' => $request->theme_card_color,
            'theme_border_color' => $request->theme_border_color,
            'theme_footer_color' => $request->theme_footer_color,
            'theme_icon_bg_color' => $request->theme_icon_bg_color,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget($key);
        }

        return redirect()->back()->with('success', 'Theme settings updated successfully.');
    }
}
