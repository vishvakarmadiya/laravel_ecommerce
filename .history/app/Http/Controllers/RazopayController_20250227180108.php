<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Exception;
use App\Models\Order; // Added the Order model import

class RazopayController extends Controller // Corrected the class name
{
    public function createOrder()
    {
        return response()->json(['message' => 'Order created successfully']);
    }

    public function verifyPayment(Request $request)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Update order status
            Order::where('razorpay_order_id', $request->razorpay_order_id)
                ->update(['status' => 'paid']);

            return response()->json(['success' => true, 'message' => 'Payment verified successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
