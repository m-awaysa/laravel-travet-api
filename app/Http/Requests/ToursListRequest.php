<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ToursListRequest extends FormRequest
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
            
                'dateFrom'=>'date',
                'dateTo'=>'date',
                'priceFrom'=>'numeric',
                'priceTo'=>'numeric',
                'sortBy'=>Rule::in(['price']),
                'sortOrder'=>Rule::in(['asc','desc']),
            
        ];
    }

    public function messages():array
    {
        return [
                'dateFrom'=>"the 'dateFrom' must be date",
                'dateTo'=>"the 'dateTo' must be date",
                'sortBy'=>"the 'sortBy' parameter accepts only price",
                'sortOrder'=>"the 'sortBy' parameter accepts only asc and desc",   
        ];
    }
}
