<?php

namespace App\Http\Requests\Purok;

use Illuminate\Foundation\Http\FormRequest;

class PurokRequest extends FormRequest
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
                'name' => ['required', 'unique:puroks,name'],
            ],
            'PUT' => [
                'name' => ['required',  \Illuminate\Validation\Rule::unique('puroks')->ignore($this->purok)],
            ]
        };
    }

    public function messages()
    {
        return [
            'name.unique' => 'Purok has already been exist'
        ];
    }
}
