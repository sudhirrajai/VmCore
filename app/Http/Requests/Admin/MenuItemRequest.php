<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_id' => ['required', 'exists:menus,id'],
            'parent_id' => ['nullable', 'exists:menu_items,id'],
            'title' => ['required', 'string', 'max:255'],
            'page_id' => ['nullable', 'exists:pages,id'],
            'custom_url' => ['nullable', 'url', 'max:255'],
            'target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }
}
