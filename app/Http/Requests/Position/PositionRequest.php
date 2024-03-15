<?php

namespace App\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
                'pid' => ['required'],
                'name' => ['required', 'unique:positions,name'],
            ],
            'PUT' => [
                'pid' => ['required'],
                'name' => ['required',  \Illuminate\Validation\Rule::unique('positions')->ignore($this->position)],
            ]
        };
    }

    public function messages()
    {
        return [
            'name.unique' => 'Position has already been exist'
        ];
    }
}
