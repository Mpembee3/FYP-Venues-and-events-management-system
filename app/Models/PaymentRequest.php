<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service',
        'amount',
        'reference_number',
        'status',
        'admin_status',
        'dvc_status',
        'pro_status',
    ];
}
