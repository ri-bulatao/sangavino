<?php

namespace App\Http\Requests\Blotter;

use Illuminate\Foundation\Http\FormRequest;

class BlotterRequest extends FormRequest
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
            'complainant' => ['required'],
            'respondent' => ['nullable'],
            'official_id' => ['required'],
            'location' => ['required'],
            'date_of_incident' => ['required'],
            'statement' => ['required'],
            'is_solved' => ['sometimes']
        ];
    }

    public function messages()
    {
        return [
            'official_id.required' => 'The in-charge field is required.',
        ];
    }
}