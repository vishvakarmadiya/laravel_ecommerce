<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Payment;
use Dotenv\Validator;
use Exception;

class OrderController extends Controller
{
    
   
    public function verifyPayment(Request $request)
    {
        $data = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id'   => $data['razorpay_order_id'],
            'razorpay_payment_id' => $data['razorpay_payment_id'],
            'razorpay_signature'  => $data['razorpay_signature'],
        ]);
    
        // ✅ Fetch Order
        $order = Order::where('razorpay_order_id', $data['razorpay_order_id'])->first();
        
        // ✅ Store payment details
        Payment::create([
            'order_id'            => $order->id,
            'razorpay_order_id'   => $data['razorpay_order_id'],
            'razorpay_payment_id' => $data['razorpay_payment_id'],
            'razorpay_signature'  => $data['razorpay_signature'],
            'status'              => 'paid',
        ]);
    
        // ✅ Update order status to '2 = Processing'
        $order->update(['status' => 2]);
    
        return redirect()->route('order.history')->with('success', 'Payment Successful!');
    }
    public function cartClear()
{
   

    return redirect()->route('order_store')->with('success', 'Order placed successfully!');
}

    
    }
    


