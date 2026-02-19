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
        $fontColor = Setting::where('key', 'theme_font_color')->value('value') ?? '#646e78';
        $bgColor = Setting::where('key', 'theme_bg_color')->value('value') ?? '#f5f5f9';

        return view('admin.settings.index', compact('primaryColor', 'fontColor', 'bgColor'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'theme_primary_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'theme_font_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'theme_bg_color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
        ]);

        $settings = [
            'theme_primary_color' => $request->theme_primary_color,
            'theme_font_color' => $request->theme_font_color,
            'theme_bg_color' => $request->theme_bg_color,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget($key);
        }

        return redirect()->back()->with('success', 'Theme settings updated successfully.');
    }
}
