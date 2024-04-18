<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class reservationController extends Controller
{
    //method to display reservation requests
    public function requests(){
        $data = Reservation::all();
        return view('reservations', ["data"=>$data]);
    }
}
