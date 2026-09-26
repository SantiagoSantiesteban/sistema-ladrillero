<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // La autorización se maneja por middleware/policy en el controlador
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'subtitle'    => ['nullable', 'string', 'max:255'],
            'image'       => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Máximo 2MB, MIME verificado
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url'  => ['nullable', 'url', 'max:255'],
            'position'    => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
            'starts_at'   => ['nullable', 'date'],
            'ends_at'     => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }
}