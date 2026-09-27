<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($this->service)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'       => ['nullable', 'string'],
            'icon'              => ['nullable', 'string', 'max:100'],
            'image'             => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'button_text'        => ['nullable', 'string', 'max:100'],
            'button_url'         => ['nullable', 'url', 'max:255'],
            'position'          => ['nullable', 'integer', 'min:0'],
            'is_active'         => ['nullable', 'boolean'],
            'seo_title'         => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:255'],
        ];
    }
}