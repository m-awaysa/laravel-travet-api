<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'is_public' => ['boolean'],
            'name' => ['required', 'unique:travels'],
            'description' => ['required'],
            'number_of_days' => ['required', 'integer'],
        ];
    }


    public function messages(): array
    {
        return [
            'is_public' => "'is_public' must be boolean",
            'name' => "the name is required and unique",
            'description' => "the 'description' is required",
            'number_of_days' => "the 'number_of_days' is required as a number",
        ];
    }
}
