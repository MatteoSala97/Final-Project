<?php

namespace App\Http\Requests;

use App\Rules\ContainsNumber;
use Illuminate\Foundation\Http\FormRequest;

class AccomodationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'type' => 'required|string|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'integer|min:1',
            'bathrooms' => 'integer|min:1',
            'address' => ['required', 'string', new  ContainsNumber],
            'city' => 'required|string',
            'price_per_night' => 'required|numeric',
            'thumb' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'services' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'services.min' => 'At least one service must be selected.',
            'services.required' => 'At least one service must be selected.'
        ];
    }
}
