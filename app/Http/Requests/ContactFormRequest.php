<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => strtolower(trim($this->email)),
            'message' => trim($this->message),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:3|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:500',
            'company_name_hp' => 'nullable|max:0', // This is the Honeypot field. Must be empty.
        ];

        // Only require reCAPTCHA if enabled in admin settings
        if (\App\Models\Setting::get('google_verification_enabled', '0')) {
            $rules['g-recaptcha-response'] = 'required';
        }

        return $rules;
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // 1. Honeypot check (Silent rejection if filled)
            if ($this->filled('company_name_hp')) {
                $this->logSpam('honeypot');
                $validator->errors()->add('spam', 'Bot detected.');
                return;
            }

            // 2. Disposable Email Check
            if ($this->isDisposableEmail($this->email)) {
                $this->logSpam('disposable');
                $validator->errors()->add('email', 'Temporary/Disposable email addresses are not allowed.');
                return;
            }

            // 3. Duplicate Submission Check (Hash of email + message)
            $submissionHash = md5($this->email . '|' . $this->message);
            if (Cache::has('contact_form_' . $submissionHash)) {
                $validator->errors()->add('message', 'You have already sent this message recently. Please wait a while.');
                return;
            }
            // Store hash for 10 minutes to prevent duplicates
            Cache::put('contact_form_' . $submissionHash, true, 600);

            // 4. Google reCAPTCHA Verification (Only if enabled)
            if (\App\Models\Setting::get('google_verification_enabled', '0')) {
                if (!$this->verifyRecaptcha($this->get('g-recaptcha-response'))) {
                    $this->logSpam('reCAPTCHA');
                    $validator->errors()->add('g-recaptcha-response', 'reCAPTCHA verification failed. Please try again.');
                }
            }
        });
    }

    /**
     * Check if email is from a disposable domain.
     */
    protected function isDisposableEmail($email): bool
    {
        $domain = substr(strrchr($email, "@"), 1);
        $disposableDomains = [
            'mailxw.com',
            '10minutemail.com',
            'guerrillamail.com',
            'tempmail.com',
            'throwawaymail.com',
            'mailinator.com',
            'yopmail.com',
            'sharklasers.com',
            'guerrillamail.biz'
        ];
        return in_array(strtolower($domain), $disposableDomains);
    }

    /**
     * Verify reCAPTCHA token with Google.
     */
    protected function verifyRecaptcha($token): bool
    {
        $secret = \App\Models\Setting::get('google_recaptcha_secret_key');

        if (!$secret) {
            Log::error('reCAPTCHA secret key is not set in Admin Settings.');
            return true; // Allow if not configured to avoid blocking users, but log error
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $this->ip(),
            ]);

            return $response->json('success') === true;
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Log spam attempts as requested.
     */
    protected function logSpam($reason): void
    {
        Log::warning('Spam detected', [
            'ip' => $this->ip(),
            'email' => $this->email,
            'reason' => $reason
        ]);
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'The name may only contain letters and spaces.',
            'name.min' => 'The name must be at least 3 characters.',
            'message.min' => 'The message must be at least 10 characters.',
            'message.max' => 'The message may not exceed 500 characters.',
            'company_name_hp.max' => 'Suspected bot activity.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.',
        ];
    }
}
