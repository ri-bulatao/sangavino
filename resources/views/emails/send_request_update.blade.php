{{-- blade-formatter-disable --}}
@component('mail::message')

Hi {{ $request->user->resident->full_name }},

@if ($request->status == 1)
Thank you for waiting. Your requested service has been approved and it is now ready for pick-up.<br>
@component('mail::panel')
Services Request Update <br>
Service: {{ $request->service->name }} <br>
Fee: {{ $request->service->fee }} <br>
Purpose: {{ $request->purpose }} <br>
Date Requested: {{ formatDate($request->updated_at, 'dateTime') }} <br>
Remark: {{$request->remark ?? 'N/A'}} 
@endcomponent
@endif

@if ($request->status == 2)
Thank you for waiting. Unfortunately your requested service: <b>{{ $request->service->name }}</b> has been declined. Remark: {{ $request->remark ?? "N/A" }}. For more info visit the link below.
@endif


@component('mail::button', ['url' => $url, 'color' => 'success'])
Visit
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
