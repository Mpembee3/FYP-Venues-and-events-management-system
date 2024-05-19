<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Venue;

class Event extends Model
{
    use HasFactory;
  
     
    //connecting other models
    public function venues()
    {
        return $this->belongsTo(Venue::class);
    }
}
