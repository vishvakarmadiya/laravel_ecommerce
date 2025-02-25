<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    // If the table name is not the plural form of the model name,
    // you can specify the table name like this:
    // protected $table = 'order_addresses';

    protected $fillable = [
        'name',
        'user_id',
        'email',
        'mobile',
        'address',
        'city',
        'state',
        'pin_code',
        'country',
        'order_id',
        'order_date',
    ];

    // If 'order_date' is a datetime field, ensure that it's cast to a Carbon instance
    protected $casts = [
        'order_date' => 'datetime',
    ];
}
