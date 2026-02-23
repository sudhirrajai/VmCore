<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class GoogleVerificationController extends Controller
{
    public function index()
    {
        return view('admin.settings.google-verification');
    }

    public function update(Request $request)
    {
        $request->validate([
            'google_verification_enabled' => 'nullable|boolean',
            'google_recaptcha_site_key' => 'nullable|required_if:google_verification_enabled,1|string',
            'google_recaptcha_secret_key' => 'nullable|required_if:google_verification_enabled,1|string',
        ]);

        $enabled = $request->has('google_verification_enabled') ? '1' : '0';

        Setting::set('google_verification_enabled', $enabled);
        Setting::set('google_recaptcha_site_key', $request->input('google_recaptcha_site_key'));
        Setting::set('google_recaptcha_secret_key', $request->input('google_recaptcha_secret_key'));

        return redirect()->back()->with('success', 'Google Verification settings updated successfully.');
    }
}
