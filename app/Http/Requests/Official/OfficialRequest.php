<?php

namespace App\Http\Requests\Official;

use Illuminate\Foundation\Http\FormRequest;

class OfficialRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'position_id' => ['sometimes'],
            'name' => ['sometimes'],
            'contact' => ['sometimes'],
            'is_active' => ['sometimes']
        ];
    }
}