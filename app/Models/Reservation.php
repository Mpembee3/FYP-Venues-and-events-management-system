<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;


    // connection with other models

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id' ,'id');
    }


}
