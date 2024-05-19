<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class reservationController extends Controller
{
    //method to display reservation requests
    public function requests(){
        $data = Reservation::all();
        return view('reservations', ["data"=>$data]);
    }


        
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




            //reservation approving process admin, dvc, pro

        public function approve(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $reservation->admin_approval = 'approved';
            $reservation->admin_approved_at = now();
        } elseif ($user->role == 'dvc') {
            $reservation->admin_approval == 'approved' ?: abort(403); // Ensure previous approval
            $reservation->dvc_approval = 'approved';
            $reservation->dvc_approved_at = now();
        } elseif ($user->role == 'pro') {
            $reservation->dvc_approval == 'approved' ?: abort(403); // Ensure previous approval
            $reservation->pro_approval = 'approved';
            $reservation->pro_approved_at = now();
        }

        $reservation->save();

        return back()->with('success', 'Reservation approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $reservation->admin_approval = 'rejected';
        } elseif ($user->role == 'dvc') {
            $reservation->dvc_approval = 'rejected';
        } elseif ($user->role == 'pro') {
            $reservation->pro_approval = 'rejected';
        }

        $reservation->save();

        return back()->with('error', 'Reservation rejected.');
    }

        
        
        


}
