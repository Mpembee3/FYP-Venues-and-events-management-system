<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class venueController extends Controller
{

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
     // $venue->image = $request->image;
        $venue->save();
        return redirect()->back()->with('success', 'Venue added successfully!');
    }



    //method to edit and update venue
        public function edit($id){
        $venue = Venue::find($id);

        if (!$venue) {
            abort(404);
        }

        return view('venue_edit', compact('venue'));
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
        // $venue->image = $request->image;
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

        return view('venue_profile', compact('venue'));
    }

  
    //method to display all registered venue
    public function index(){
        $data = Venue::all();
        return view('venue', ["data"=>$data]);
    }

    





    // public function update(Request $request){
    //     $venue->update($request->all());
    //     return redirect()->back()->with('success', 'Venue updated successfully!');
    // }
}
