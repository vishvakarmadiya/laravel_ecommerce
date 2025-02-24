<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        // Define the columns that can be mass-assigned, e.g. 'product_id', 'user_id', etc.
    ];
}
