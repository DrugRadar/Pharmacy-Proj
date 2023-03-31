<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegisterRequest extends FormRequest
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
    public function registerRules()
    {
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'password' => 'required|string|min:6',
        'avatar' => 'required|image|max:2048',
        'national_id' => ['required', 'string', 'regex:/^\d{14}$/'],
    ];
    }
    public function updateProfileRules()
    {   
    return [
        'name' => 'string|max:255',
        'email' => 'email|unique:users,email,' . auth()->id(),
        'password' => 'string|min:8|confirmed',
    ];
    }
    public function rules(): array
    {

        // switch ($this->route()->getName()) {
        //     case 'register':
        //         return $this->registerRules();
        //     // case 'login':
        //     //     return $this->loginRules();
        //     // case 'updateProfile':
        //     //     return $this->updateProfileRules();
        //     default:
        //         return [];
        // }
        // return [
        //     //
        // ];
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:6',
            'avatar' => 'required|image|max:2048',
            'national_id' => ['required', 'string', 'regex:/^\d{14}$/'],
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'Please enter your full name.',
        'email.required' => 'Please enter your email address.',
        'email.unique' => 'The email address is already in use.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'Your password must be at least 8 characters long.',
    
    ];

}
}
