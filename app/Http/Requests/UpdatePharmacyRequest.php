<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyRequest extends FormRequest
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
    public function rules()
    {
        $id = $this->headers->get('upgrade-insecure-requests');
        // dd($id);
        return [
            'name' => ['required', "max:255"],
            'email' => ['required', "max:255", 'email', Rule::unique('users')->ignore($this->getDoctorIdInUser($id))],
            'password' => ['required', "max:255",'min:6'],
            'national_id' => ['required','integer','digits:14', Rule::unique('pharmacies')->ignore($id)],
            'avatar_image' => ['image',"max:255",'mimes:jpeg,jpg,png'],
            'area_id' => ["required", "exists:areas,id"],
            // 'priority' => ['required', 'in:0,1']
        ];
    }

    public function messages()
    {
        return [
            'area_id.exists' => "This area is invalid.",
            'area_id.required' => "The area is required."
        ];
    }

    public function getDoctorIdInUser($id) {
        $user = User::where('userable_id', $id)
            ->where('userable_type', 'App\Models\Pharmacy')
            ->get();
        return $user->first()->id;
    }
}
