<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SmtpSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'smtp')->get()->keyBy('key');

        // Decrypt password for display (or leave it empty/masked)
        $smtpPassword = '';
        if (isset($settings['smtp_password']) && $settings['smtp_password']->value) {
            try {
                $smtpPassword = Crypt::decryptString($settings['smtp_password']->value);
            } catch (DecryptException $e) {
                $smtpPassword = '';
            }
        }

        return view('admin.pages.settings.smtp', compact('settings', 'smtpPassword'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'mail_password') {
                if (!empty($value)) {
                    $value = Crypt::encryptString($value);
                } else {
                    // If empty, don't update to keep the old password
                    continue;
                }
            }

            Setting::updateOrCreate(
                ['key' => str_replace('mail_', 'smtp_', $key), 'group' => 'smtp'],
                ['value' => $value, 'type' => 'text']
            );
        }

        return back()->with('success', 'SMTP Settings updated successfully.');
    }

    public function test(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        try {
            // Apply settings temporarily just for this request if they exist in DB
            $this->applySmtpSettings();

            Mail::raw('This is a test email from your robust Laravel application to verify SMTP settings. If you received this, your configuration is working correctly.', function ($message) use ($request) {
                $message->to($request->test_email)
                    ->subject('Test SMTP Configuration');
            });

            return back()->with('success', 'Test email sent successfully! Please check your inbox.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send test email. Error: ' . $e->getMessage());
        }
    }

    private function applySmtpSettings()
    {
        $settings = Setting::where('group', 'smtp')->get()->pluck('value', 'key');

        if ($settings->isNotEmpty()) {
            try {
                $password = isset($settings['smtp_password']) ? Crypt::decryptString($settings['smtp_password']) : null;
            } catch (DecryptException $e) {
                $password = null;
            }

            $config = [
                'transport' => $settings['smtp_mailer'] ?? 'smtp',
                'host' => $settings['smtp_host'] ?? '127.0.0.1',
                'port' => $settings['smtp_port'] ?? 2525,
                'encryption' => $settings['smtp_encryption'] ?? 'tls',
                'username' => $settings['smtp_username'] ?? null,
                'password' => $password,
                'timeout' => null,
                'local_domain' => env('MAIL_EHLO_DOMAIN'),
            ];

            Config::set('mail.mailers.smtp', $config);
            Config::set('mail.default', $settings['smtp_mailer'] ?? 'smtp');

            Config::set('mail.from.address', $settings['smtp_from_address'] ?? env('MAIL_FROM_ADDRESS'));
            Config::set('mail.from.name', $settings['smtp_from_name'] ?? env('MAIL_FROM_NAME'));
        }
    }
}
