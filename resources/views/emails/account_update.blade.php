{{-- blade-formatter-disable --}}
@component('mail::message')

Dear {{ $user->resident->full_name }},

@if($user->is_activated == 0)
Unfortunately, there are circumstances that you did not totally comply and the E-Barangay System chooses to deactivate your account.
@endif

@if($user->is_activated == 1)
Your account is now re-activated. You can now use our platform just click the button below to redirect.
@endif

@component('mail::button', ['url' => $url, 'color' => 'success'])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

