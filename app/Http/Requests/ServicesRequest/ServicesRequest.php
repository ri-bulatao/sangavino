<?php

namespace App\Http\Requests\ServicesRequest;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
        return match(auth()->user()->role->name) {
            'admin' => [
                'user_id' => ['required'],
                'service_id' => ['required'],
                'purpose' => ['required'],
                'remark' => ['sometimes'],
                'status' => ['sometimes'],
                'business_name' => ['required_if:service_id,4']
            ],
            'resident' => [
                'service_id' => ['required'],
                'purpose' => ['required'],
                'business_name' => ['required_if:service_id,4'],
                'business_type' => ['required_if:service_id,4'],
                'business_location' => ['required_if:service_id,4'],
                'terms_of_service' => ['accepted']
            ],
            'secretary' => [
                'user_id' => ['required'],
                'service_id' => ['required'],
                'purpose' => ['required']
            ]
        };
 
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The resident field is required',
            'service_id.required' => 'The service field is required',
            'business_name.required_if' => 'The business name field is required when you select the business clearance/permit.',
            'business_type.required_if' => 'The business type field is required when you select the business clearance/permit.',
            'business_location.required_if' => 'The business location field is required when you select the business clearance/permit.',
        ];
    }
}