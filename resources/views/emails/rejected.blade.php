@component('mail::message')
# Reservation Rejected

Dear {{ $user->firstname }} {{ $user->surname }},

We regret to inform you that your reservation request has been rejected.

## Event Details
- **Event:** {{ $reservation->event_id }}
- **Venue:** {{ $reservation->venue->name }}
- **Date:** {{ $reservation->date }}
- **Start Time:** {{ $reservation->start_time }}
- **End Time:** {{ $reservation->end_time }}

Thank you for your understanding.

@endcomponent
