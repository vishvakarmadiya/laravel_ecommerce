<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'sub_total',
        'shipping_charge',
        'payment_method',
        'total',
        'status', // add the status as it's important for order processing
    ];

    // Optionally, you can also define relationships like user or order items if needed.
}
