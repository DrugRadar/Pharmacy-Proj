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
        return true;
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
        var_dump($this->id);
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:6',
            // 'avatar_image' => 'required|image|max:2048',
            'national_id' => 'required|string|max:20|unique:clients,national_id,'. $this->id,
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:male,female',
        ];
    }
}
