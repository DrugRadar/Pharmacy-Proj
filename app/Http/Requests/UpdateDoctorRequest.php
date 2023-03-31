<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UpdateDoctorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', "max:255"],
            'email' => ['required', "max:255",'email', Rule::unique('users')->ignore($this->id)],
            'password' => ['required', "max:255",'min:6'],
            'national_id' => ['required','integer','digits:14', Rule::unique('doctors')->ignore($this->doctor)],
            'avatar_image' => ['image', "max:255",'mimes:jpeg,jpg,png'],
            'pharmacy_id' => ["required", "exists:pharmacies,id"],
        ];
    }

    public function messages()
    {
        return [
            'pharmacy_id.exists' => "This pharmacy is invalid.",
            'pharmacy_id.required' => "The pharmacy is required.",
        ];
    }
}
