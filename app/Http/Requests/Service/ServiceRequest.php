<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'name' => ['required', 'unique:services,name'],
                'description' => ['required'],
                'fee' => ['required'],
            ],
            'PUT' => [
                'name' => ['required',  \Illuminate\Validation\Rule::unique('services')->ignore($this->service)],
                'description' => ['required'],
                'fee' => ['required'],
            ]
        };
    }

    public function messages()
    {
        return [
            'name.unique' => 'Service has already been exist'
        ];
    }
}
