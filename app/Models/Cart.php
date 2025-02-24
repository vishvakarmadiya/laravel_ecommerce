<?php

namespace App\Models; // Ensure the correct namespace

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory; // Optional but recommended

    protected $fillable = ['user_id', 'product_id', 'quantity', 'price'];
}
