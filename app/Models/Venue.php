<?php

namespace App\Models;
use App\Models\Reservation;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;


    //connection with other models

    public function reservations()
{
    return $this->hasMany(Reservation::class);
}

    public function events()
{
    return $this->hasMany(Event::class);
}


    public function isAvailable($date)
{
    // Check if there are any reservations for the venue on the given date
    return $this->reservations()->where('date', $date)->count() == 0;
}

    public function getEventListAttribute()
    {
        return json_decode($this->event, true);
    }


    
}
