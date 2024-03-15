<?php

namespace App\Http\Requests\Resident;

use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
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

    public function rules()
    {
        return match ($this->method()) {
            'POST' => [
                'purok_id' => ['required'],
                'first_name' => ['required'],
                'middle_name' => ['required'],
                'last_name' => ['required'],
                'gender' => ['required'],
                'birth_date' => ['required'],
                'address' => ['required'],
                'contact' => ['required', 'digits:11'],
                'civil_status' => ['required'],
                'citizenship' => ['required'],
                'is_voter' => ['required'],
                'email' => ['nullable', 'email', 'unique:users,email'],
            ],
            'PUT' => [
                'purok_id' => ['required'],
                'first_name' => ['required'],
                'middle_name' => ['required'],
                'last_name' => ['required'],
                'gender' => ['required'],
                'birth_date' => ['required'],
                'address' => ['required'],
                'contact' => ['required', 'digits:11'],
                'civil_status' => ['required'],
                'citizenship' => ['required'],
                'is_voter' => ['required'],
                'email' => ['nullable', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($this->resident->user)],
            ]
        };
    }

    public function messages()
    {
        return [
            'purok_id.required' => 'The purok field is required',
            'email.unique' => 'Email address has already been taken'
        ];
    }
}