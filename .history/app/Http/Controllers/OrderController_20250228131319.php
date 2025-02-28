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
use Exception;

class OrderController extends Controller
{public function order_store(Request $request)
    {  
        $userId = Auth::id();
    
        // ✅ Fetch only active cart items
        $cartItems = Cart::where('user_id', $userId)
            ->where('status', 'active')
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
    
        $subTotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingCharge = 50;
        $totalAmount = $subTotal + $shippingCharge;
    
        DB::beginTransaction();
    
        // ✅ Create Order
        $order = Order::create([
            'user_id'         => $userId,
            'sub_total'       => $subTotal,
            'payment_method'  => $request->payment_method, 
            'shipping_charge' => $shippingCharge,
            'total'           => $totalAmount,
            'status'          => 1, // 1 = Placed
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    
        // ✅ Store Order Details
        $orderItems = $cartItems->map(fn($cartItem) => [
            'order_id'      => $order->id,
            'product_id'    => $cartItem->product_id,
            'qty'           => $cartItem->quantity,
            'selling_price' => $cartItem->price,
            'created_at'    => now(),
            'updated_at'    => now(),
        ])->toArray();
        OrderDetail::insert($orderItems);
    
        // ✅ If Razorpay is selected, create a Razorpay Order
        if ($request->payment_method === 'Razorpay') {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt'         => 'order_' . $order->id,
                'amount'          => $totalAmount * 100, // Convert to paise
                'currency'        => 'INR',
                'payment_capture' => 1, // Auto capture
            ]);
    
            // ✅ Save Razorpay Order ID
            $order->update(['razorpay_order_id' => $razorpayOrder['id']]);
    
            DB::commit();
    
            return response()->json([
                'success'  => true,
                'order_id' => $razorpayOrder['id'],
                'amount'   => $totalAmount,
            ]);
        }
    
        // ✅ If Cash on Delivery (COD), mark order as confirmed and clear the cart
        if ($request->payment_method === 'Cash on Delivery') {
            // Mark cart items as inactive
            Cart::where('user_id', $userId)->where('status', 'active')->update(['status' => 'inactive']);
    
            DB::commit();
    
            return redirect()->route('profile')->with('success', 'Order placed successfully! Your order is confirmed.');
        }
    
        return redirect()->route('profile')->with('success', 'Order placed successfully!');
    }
    
    
    

   
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
    Cart::where('user_id', auth()->id())
        ->where('status', 'Active') // Active items
        ->update(['status' => 'inactive']); // Set to inactive

    return redirect()->route('order_store')->with('success', 'Order placed successfully!');
}

    
    }
    


