<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestInvestment extends FormRequest
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
            'investor_id' => 'required|min:0',
            'value' => 'required|numeric|min:0',
            'sold_in' => 'required|date'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'investor_id.required' => 'A name is required.',
            'investor_id.min' => 'Cannot be negative',
            'value.required' => 'A value is required.',
            'value.numeric' => 'Only numbers are accepted.',
            'value.min' => 'Value cannot be negative.',
            'sold_in.required' => 'Date sold is required.',
            'sold_in.date' => 'Only date are accepted.'
        ];
    }
}
