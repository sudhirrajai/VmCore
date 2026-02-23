<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:255',
            'template_id' => 'nullable|exists:newsletter_templates,id',
            'content' => 'required|string',
            'scheduled_at' => 'nullable|date|after_or_equal:now',
            'action' => 'required|in:draft,send_now,schedule',
        ];
    }
}
