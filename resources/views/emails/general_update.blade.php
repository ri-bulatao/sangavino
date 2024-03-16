{{-- blade-formatter-disable --}}
@component('mail::message')

Hi {{ $user }},

{{ $message_body }}


@component('mail::button', ['url' => $url, 'color' => 'success'])
Visit
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
