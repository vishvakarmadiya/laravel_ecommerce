<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function createOrder()
    {
        echo "Order created successfully";
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt' => 'order_' . rand(10, 100),
            'amount' => $input['amount'] * 100, // Razorpay requires amount in paise
            'currency' => 'INR',
            'payment_capture' => 1 // Auto capture payment
        ];

        try {
            $order = $api->order->create($orderData);
            return response()->json($order);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
