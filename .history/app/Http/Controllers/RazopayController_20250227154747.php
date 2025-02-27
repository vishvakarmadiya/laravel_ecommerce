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
    public function paymet(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('
        RAZOR_KEY'), env('RAZOR_SECRET
        '));                                                        
}
}