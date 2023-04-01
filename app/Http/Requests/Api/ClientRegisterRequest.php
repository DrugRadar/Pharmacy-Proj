<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'gender' => 'required|in:male,female',
            'password' => 'required|string|min:6',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'avatar_image' => 'required',
            'mobile_number' => 'required|string|max:20',
            'national_id' => 'required|string|max:20|unique:clients,national_id',
        ];
    }
}