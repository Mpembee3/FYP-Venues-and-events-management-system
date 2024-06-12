<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Event;

class Payment extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'reservation_id',
        'control_number',
        'payment_status',
        'pro_approval'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function event()
    {
        return $this->hasOne(Event::class);
    }
}
