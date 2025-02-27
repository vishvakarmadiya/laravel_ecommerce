<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazopayController extends Controller
{
    public function createOrder()
    {
        
        echo "Order created successfully";
    }
}
