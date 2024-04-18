<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class paymentController extends Controller
{
    //method to display payments done
    public function status(){
        $data = Payment::all();
        return view('payments', ["data"=>$data]);
    }
}
