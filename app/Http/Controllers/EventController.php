<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Payment;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Update event statuses
        $events = Event::with(['payment.reservation'])
            ->get()
            ->each(function ($event) {
                $now = now();
                $reservation = $event->payment->reservation;
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservation->date . ' ' . $reservation->start_time);
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservation->date . ' ' . $reservation->end_time);

                if ($startDateTime > $now) {
                    $event->status = 'upcoming';
                } elseif ($startDateTime <= $now && $endDateTime >= $now) {
                    $event->status = 'ongoing';
                } else {
                    $event->status = 'completed';
                }

                $event->save();
            });


        if ($user->role == 'user') {       

        $events = Event::whereHas('payment.reservation', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // Fetch events for other users with limited details
            $otherEvents = Event::whereHas('payment.reservation', function ($query) use ($user) {
                $query->where('user_id', '!=', $user->id);
            })->get();

                return view('events.users', compact('events', 'otherEvents'));
            } 

            else{

            }

            $events = Event::all();
            // with(['payment.reservation.venue', 'payment.reservation.user'])->get();
    
                return view('events.index', compact('events'));
        }
    // $user = Auth::user();
    // $events = Event::with('payment.reservation.venue')->get();

    // return view('events.index', compact('events', 'user'));

    //  }
    
    }


   
        
    



