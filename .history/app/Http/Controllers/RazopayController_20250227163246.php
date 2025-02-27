<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Exception;

class RazopayController extends Controller
{
    public function createOrder()
    {
        return response()->json(['message' => 'Order created successfully']);
    }

    public function payment(Request $request)
    {
        // Validate request
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $orderData = [
                'receipt' => 'order_' . rand(1000, 9999),
                'amount' => $request->amount * 100, // Convert to paise
                'currency' => 'INR',
                'payment_capture' => 1 // Auto-capture payment
            ];

            $order = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order' => $order
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
