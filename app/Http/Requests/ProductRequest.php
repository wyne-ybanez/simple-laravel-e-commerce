<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max: 2000'],
            'image' => ['nullable', 'image'],
            'image_1' => ['nullable', 'image'],
            'image_2' => ['nullable', 'image'],
            'image_3' => ['nullable', 'image'],
            'price' => ['required', 'numeric'],
            'category' => ['nullable', 'max: 255'],
            'description' => ['nullable', 'string'],
            'description_2' => ['nullable', 'string'],
            'color' => ['nullable', 'boolean'],
            'published' => ['nullable', 'boolean'],
        ];
    }
}
