<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'street_name' => ["required" , "max:255"],
            'building_number' => ["required" , "integer" , "min:1"],
            'floor_number' => ["required" , "integer" , "min:1"],
            'flat_number' => ["required" , "integer" , "min:1"],
            'is_main' => ["required", 'in:0,1'],
            'area_id' => ["required", "exists:areas,id"],
            'client_id' => ["required", "exists:clients,id"]
        ];
    }

    public function messages()
    {
        return [
            'area_id.required' => "The area field is required.",
            'area_id.exists' => "This selected option is invalid.",
            'client_id.required' => "The client field is required.",
            'client_id.exists' => "This selected option is invalid.",
            'is_main.required' => "The Main field is required."
        ];
    }
}
