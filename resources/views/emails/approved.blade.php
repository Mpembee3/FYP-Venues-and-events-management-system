@component('mail::message')
# Reservation Approved

Dear {{ $user->firstname }} {{ $user->surname }},

Your reservation request has been approved!

## Event Details
- **Event:** {{ $reservation->event_id }}
- **Venue:** {{ $reservation->venue->name }}
- **Date:** {{ $reservation->date }}
- **Start Time:** {{ $reservation->start_time }}
- **End Time:** {{ $reservation->end_time }}

## Venue Location
[View on Google Maps](https://www.google.com/maps/search/?api=1&query={{ $reservation->venue->latitude }},{{ $reservation->venue->longitude }})

You can share this information with your attendees.
## Share This Event
- [Share on WhatsApp](https://api.whatsapp.com/send?text=Event:%20{{ urlencode($reservation->event_id) }}%0AVenue:%20{{ urlencode($reservation->venue->name) }}%0ADate:%20{{ urlencode($reservation->date) }}%0AStart%20Time:%20{{ urlencode($reservation->start_time) }}%0AEnd%20Time:%20{{ urlencode($reservation->end_time) }}%0ALocation:%20{{ urlencode('https://www.google.com/maps/search/?api=1&query=' . $reservation->venue->latitude . ',' . $reservation->venue->longitude) }})
- [Share on Facebook](https://www.facebook.com/sharer/sharer.php?u={{ urlencode('https://www.google.com/maps/search/?api=1&query=' . $reservation->venue->latitude . ',' . $reservation->venue->longitude) }}&quote={{ urlencode('Event: ' . $reservation->event_id . ' Venue: ' . $reservation->venue->name . ' Date: ' . $reservation->date . ' Start Time: ' . $reservation->start_time . ' End Time: ' . $reservation->end_time) }})
- [Share on Twitter](https://twitter.com/intent/tweet?text={{ urlencode('Event: ' . $reservation->event_id . ' Venue: ' . $reservation->venue->name . ' Date: ' . $reservation->date . ' Start Time: ' . $reservation->start_time . ' End Time: ' . $reservation->end_time . ' Location: https://www.google.com/maps/search/?api=1&query=' . $reservation->venue->latitude . ',' . $reservation->venue->longitude) }})


Thank you!

@endcomponent
