<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\Venue;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;



class ReservationController extends Controller
{
        
            //method for user to make reservation
            public function create(Request $request)
            {
                $venueId = $request->input('venue_id');
                $date = $request->input('date');
                $start_time = $request->input('start_time');
                $end_time = $request->input('end_time');
                $user = Auth::user();
                $venue = Venue::findOrFail($venueId);
                $events = $venue->event_list;
                // Assuming 'events' is the relationship between Venue and Event
            
                return view('reservations.create', compact('user','venue', 'date','events','start_time','end_time'));
            }
            

            //method to store user's reservation
            public function store(Request $request)
            {
                $request->validate([
                    'venue_id' => 'required|exists:venues,id',
                    'date' => 'required|date',
                    'event_id' => 'required',
                    'start_time' => 'required|date_format:H:i',
                    'end_time' => 'required|date_format:H:i|after:start_time',
                    // Add other validation rules for the reservation form fields
                ]);
            
                $reservation = new Reservation();
                $reservation->user_id = Auth::id();
                $reservation->venue_id = $request->input('venue_id');
                $reservation->date = $request->input('date');
                $reservation->status = 'pending';
                $reservation->event_id = $request->input('event_id');
                $reservation->date = $request->input('date');
                $reservation->start_time = $request->input('start_time');
                $reservation->end_time = $request->input('end_time');
                $reservation->save();
                
                return redirect()->route('venue_view', ['id' => $reservation->venue_id])->with('success', 'Reservation requested successfully.');
            
            }

            //checking user's reservations
            public function userReservations(Request $request)
            {
                $user = $request->user();
                $reservations = Reservation::where('user_id', $user->id)->get();

                return view('reservations.user', compact('reservations'));
            }


            //payment issues
            public function withdraw($id)
            {
                $reservation = Reservation::findOrFail($id);

                if ($reservation->admin_approval == 'pending' || $reservation->dvc_approval == 'pending') {
                    $reservation->status = 'withdrawn';
                    $reservation->save();
                    return redirect()->route('reservations.user')->with('success', 'Reservation withdrawn successfully.');
                }

                return redirect()->route('user.reservations')->with('error', 'Reservation cannot be withdrawn.');
            }





            //reservation approving process admin, DVC, PRO(payment for event)

        public function approve(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        $user1 = Auth::user();
        $user = $reservation->user;

        if ($reservation->date . ' ' . $reservation-> end_time < now() ){
            $reservation->status = 'expired';
            $reservation->admin_approval = ' ';
            $reservation->dvc_approval = ' ';
        }
        if ($user1->role == 'admin') {
            $reservation->admin_approval = 'approved';
        } elseif ($user1->role == 'DVC') {
            $reservation->dvc_approval = 'approved';

        }

        // Check if both admin and DVC approvals are completed
        if ($reservation->admin_approval == 'approved' && $reservation->dvc_approval == 'approved' ) {
            $reservation->status = 'payment_required';
            $reservation->save();
            Mail::to($user->email)->send(new \App\Mail\Payment_required($user, $reservation));
          // Redirect to PaymentController to create a payment
            return redirect()->route('payments.create', $reservation->id)->with('success', 'Reservation approved successfully. Payment creation initiated.');
            } else {
                $reservation->save();
            }  
         

        


        return back()->with('success', 'Reservation approved successfully.');
        
    }

    public function reject(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $user1 = Auth::user();

        if ($user1->role == 'admin') {
            $reservation->admin_approval = 'rejected';
        } elseif ($user1->role == 'DVC') {
            $reservation->dvc_approval = 'rejected';
        
         }
     
        $reservation->status = 'rejected'; // Set status as rejected
        $user = $reservation->user;
        Mail::to($user->email)->send(new \App\Mail\Rejected_reservation($user, $reservation));
        $reservation->save();

        return back()->with('error', 'Reservation rejected.');
       
    }


        public function index(Request $request)
    {
        $user = Auth::user();
        $reservations = Reservation::all();
      
    
        return view('reservations.list', compact('reservations', 'user'));
    }    
    
    
}
