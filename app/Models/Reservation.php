<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;
use App\Models\User;
use App\Models\Payment;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'venue_id', 'event_id', 'date', 'start_time', 'end_time', 'status', 'admin_approval', 'admin_approved_at', 'dvc_approval', 'dvc_approved_at'
    ];


    // connection with other models

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id' ,'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}
