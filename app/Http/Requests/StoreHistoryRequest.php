<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'original_text' => 'required|string',
            'language' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must not be greater than 255 characters',
            'original_text.required' => 'Original text is required',
            'original_text.string' => 'Original text must be a string',
            'language.required' => 'Language is required',
            'language.string' => 'Language must be a string',
        ];
    }
}
