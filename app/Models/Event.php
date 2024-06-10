<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Payment;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'payment_id', 'status'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    // protected $fillable = [
    //     'user_id',
    //     'venue_id',
    //     'event_id',
    //     'reservation_date',
    //     'start_time',
    //     'end_time',
    //     'status'
    // ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

   
     
    // //connecting other models
    // public function venue()
    // {
    //     return $this->belongsTo(Venue::class);
    // }
}
