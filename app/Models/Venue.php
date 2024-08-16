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



    public function isAvailable($date, $start_time, $end_time)
    {
            // Check if any reservation overlaps with the given date and time
        $overlappingReservations = $this->reservations()
        ->where('date', $date)
        ->where(function($query) use ($start_time, $end_time) {
            $query->where(function($query) use ($start_time, $end_time) {
                $query->whereTime('start_time', '<', $end_time)
                    ->whereTime('end_time', '>', $end_time);
            })
            ->orWhere(function($query) use ($start_time, $end_time) {
                $query->whereTime('start_time', '<', $end_time)
                    ->whereTime('end_time', '>', $start_time);
            });
        })->count();

        return $overlappingReservations === 0;
    }
}

    

