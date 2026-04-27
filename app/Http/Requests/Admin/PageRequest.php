<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->route('page') ? $this->route('page')->id : null;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:pages,slug,' . $pageId],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', new Enum(StatusEnum::class)],
            'faq_schema_script' => ['nullable', 'string'],
            'meta_robots' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('title') && !$this->has('slug')) {
            $this->merge([
                'slug' => Str::slug($this->input('title'))
            ]);
        }
    }
}
