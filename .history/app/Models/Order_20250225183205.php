<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // Add this field
        'product_id',
        'quantity',
        'total_price',
        // Add other required fields
    ];
}
