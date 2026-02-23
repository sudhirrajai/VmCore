<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Register admin views path so content.* blade paths resolve
        view()->addLocation(resource_path('views/admin'));

        // ── Share global data with ALL frontend views ──────────
        View::composer('*', \App\Http\View\Composers\GlobalViewComposer::class);

        // ── Load Dynamic SMTP Config ──────────
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $smtpSettings = \App\Models\Setting::where('group', 'smtp')->get()->pluck('value', 'key');
                if ($smtpSettings->isNotEmpty()) {
                    try {
                        $password = isset($smtpSettings['smtp_password']) && $smtpSettings['smtp_password']
                            ? \Illuminate\Support\Facades\Crypt::decryptString($smtpSettings['smtp_password'])
                            : null;
                    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                        $password = null;
                    }

                    $config = [
                        'transport' => $smtpSettings['smtp_mailer'] ?? 'smtp',
                        'host' => $smtpSettings['smtp_host'] ?? '127.0.0.1',
                        'port' => $smtpSettings['smtp_port'] ?? 2525,
                        'encryption' => $smtpSettings['smtp_encryption'] ?? 'tls',
                        'username' => $smtpSettings['smtp_username'] ?? null,
                        'password' => $password,
                        'timeout' => null,
                        'local_domain' => env('MAIL_EHLO_DOMAIN'),
                    ];

                    \Illuminate\Support\Facades\Config::set('mail.mailers.smtp', $config);
                    \Illuminate\Support\Facades\Config::set('mail.default', $smtpSettings['smtp_mailer'] ?? 'smtp');
                    \Illuminate\Support\Facades\Config::set('mail.from.address', $smtpSettings['smtp_from_address'] ?? env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                    \Illuminate\Support\Facades\Config::set('mail.from.name', $smtpSettings['smtp_from_name'] ?? env('MAIL_FROM_NAME', 'Example'));
                }
            }
        } catch (\Exception $e) {
            // Ignore DB errors during deployment/migration
        }
    }
}
