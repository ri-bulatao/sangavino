<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
                'title' => ['required', 'unique:announcements,title'],
                'content' => ['required'],
                'has_sms' => ['required'],
                'sms_announcement' => ['required_if:has_sms,1']
            ],
            'PUT' => [
                'title' => ['required',  \Illuminate\Validation\Rule::unique('announcements')->ignore($this->announcement)],
                'content' => ['required'],
                'has_sms' => ['required'],
                'sms_announcement' => ['required_if:has_sms,1']
            ]
        };
    }

    public function messages()
    {
        return [
            'title.unique' => 'Announcement has already been exist',
            'sms_announcement.required' => 'The sms announcement field is required if you wish to send an SMS notification to the barangay officials.'
        ];
    }
}