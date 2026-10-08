<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'subtitle'     => ['nullable', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'section_type' => ['required', 'string', 'max:50'],
            'position'     => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable', 'boolean'],
        ];
    }
}