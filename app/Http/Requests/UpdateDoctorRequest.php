<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'email' => ['required', "max:255",'email', Rule::unique('users')->ignore($this->getDoctorIdInUser())],
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

    public function getDoctorIdInUser() {
        $user =  User::where('userable_id', $this->doctor)
            ->where('userable_type', 'App\Models\Doctor')
            ->get();
        return $user->first()->id;
    }
}
