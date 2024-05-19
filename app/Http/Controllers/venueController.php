<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use Carbon\Carbon;

class venueController extends Controller
{
    //ADMIN PART
    //method to register venue
    public function create(Request $request){
        $venue = new Venue();
        $venue->name = $request->name;
        $venue->event = $request->event;
        $venue->capacity = $request->capacity;
        $venue->latitude = $request->latitude;
        $venue->longitude = $request->longitude;
        $venue->Other_description = $request->description;
        $venue->Price = $request->price;
       

        //method to handle and display images      
        // Handle image upload
        // Check if a file is uploaded
        if ($request->hasFile('image')) {
            // Store the image in the public storage directory
            $imagePath = $request->file('image')->store('public/images');
            // Get the public URL of the stored image
            $venue->image = str_replace('public', 'storage', $imagePath);
        }

        $venue->save();

        return redirect()->route('index_venues')->with('success', 'Venue added successfully!');
    }



    //method to edit and update venue
        public function edit($id){
        $venue = Venue::find($id);

        if (!$venue) {
            abort(404);
        }

        return view('venues.venue_edit', compact('venue'));
    }


    public function update(Request $request, $id)
    {
        $venue = Venue::find($id);

        if (!$venue) {
            abort(404);
        }

        $venue->name = $request->name;
        $venue->event = $request->event;
        $venue->capacity = $request->capacity;
        $venue->latitude = $request->latitude;
        $venue->longitude = $request->longitude;
        $venue->Other_description = $request->description;
        $venue->Price = $request->price;
        
        
        //image handling        
        if ($request->hasFile('image')) {
            // Store the image in the public storage directory
            $imagePath = $request->file('image')->store('public/images');
            // Get the public URL of the stored image
            $venue->image = str_replace('public', 'storage', $imagePath);
        }

        $venue->save();

        return redirect()->route('index_venues')->with('success', 'Venue updated successfully!');
    }


    //method to delete venues
    public function delete($id){
        $venue = Venue::findOrFail($id);
        $venue->delete();
        
        return redirect()->route('index_venues')->with('success', 'Venue deleted successfully!');
    }



    //method to display venue information
    public function profile($id){
        $venue = Venue::find($id);

        if (!$venue) {
            abort(404);
        }

        return view('venues.venue_profile', compact('venue'));
    }

  
    //method to display all registered venue
    public function index(){
        $data = Venue::all();
        return view('venues.venue', ["data"=>$data]);
    }

    



    //USER PART
    
    //method to display venue profile to user
    public function view($id){
        $venue = Venue::findorFail($id);

        if (!$venue) {
            abort(404);
        }

        return view('venue_view', compact('venue'));
    }


        //method to display all registered venue
        public function explorer(Request $request)
        {
            $query = Venue::query();
            if ($request->filled('capacity')) {
                $query->where('capacity', '>=', $request->capacity);
            }
        
            if ($request->filled('event')) {
                $query->where('event', $request->event);
            }
        
            $venues = $query->get();
        
            // If neither capacity nor event is filled, display all venues
            if (!$request->filled('capacity') && !$request->filled('event')) {
                $venues = Venue::all();
            }
        
            return view('venue_explorer', compact('venues'));       
            
        }


       // Method to check venue availability
        



       public function checkAvailability(Request $request, $id)
       {
           $venue = Venue::findOrFail($id);
           $date = request()->query('date');
           $start_time = $request->input('start_time');
           $end_time = $request->input('end_time');
       
           if (!$venue->isAvailable($date, $start_time, $end_time)) {
            $availabilityMessage = 'Venue is not available for the selected date and time.';
            return view('venue_view', compact('venue', 'availabilityMessage', 'date', 'start_time', 'end_time'));
        }
    
        $availabilityMessage = 'Venue is available for the selected date and time.';
        return view('venue_view', compact('venue', 'availabilityMessage', 'date', 'start_time', 'end_time'));
    }
        
}
