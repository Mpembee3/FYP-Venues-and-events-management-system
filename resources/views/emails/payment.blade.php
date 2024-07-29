@component('mail::message')
# Payment Required

Dear {{ $user->firstname }} {{ $user->surname }},

Your reservation for the event "{{ $reservation->event_id }}" at "{{ $reservation->venue->name }}" requires payment to be completed.

## Event Details
- **Event:** {{ $reservation->event_id }}
- **Venue:** {{ $reservation->venue->name }}
- **Date:** {{ $reservation->date }}
- **Start Time:** {{ $reservation->start_time }}
- **End Time:** {{ $reservation->end_time }}

Please click the button below to log in to your account and complete the payment.

@component('mail::button', ['url' => url('/login')])
Login to Complete Payment
@endcomponent

Thank you for using our reservation system.

Regards,<br>
{{ config('app.name') }}
@endcomponent
