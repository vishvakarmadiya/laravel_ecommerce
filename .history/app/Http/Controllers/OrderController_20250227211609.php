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
{
    public function order_store(Request $request)
    {
        try {
            
            $userId = Auth::id();

            // ✅ Fetch cart items
            $cartItems = Cart::where('user_id', $userId)->get();
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

           
            $subTotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
            $shippingCharge = 50;
            $totalAmount = $subTotal + $shippingCharge;

           
            DB::beginTransaction();

          
            $order = Order::create([
                'user_id'         => $userId,
                'sub_total'       => $subTotal,
                'payment_method'  => 'razorpay',
                'shipping_charge' => $shippingCharge,
                'total'           => $totalAmount,
                'status'          => 1, // 1 = Placed
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            // ✅ Store order items
            $orderItems = $cartItems->map(fn($cartItem) => [
                'order_id'      => $order->id,
                'product_id'    => $cartItem->product_id,
                'qty'           => $cartItem->quantity,
                'selling_price' => $cartItem->price,
                'created_at'    => now(),
                'updated_at'    => now(),
            ])->toArray();
            OrderDetail::insert($orderItems);

           

            // ✅ Generate Razorpay Order ID
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayOrder = $api->order->create([
                'receipt'         => 'order_' . $order->id,
                'amount'          => $totalAmount * 100, // Convert to paise
                'currency'        => 'INR',
                'payment_capture' => 1, // Auto capture
            ]);

            // ✅ Save Razorpay Order ID
            $order->update(['razorpay_order_id' => $razorpayOrder['id']]);

            // ✅ Commit Transaction
            DB::commit();

            return response()->json([
                'success'  => true,
                'order_id' => $razorpayOrder['id'],
                'amount'   => $totalAmount,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // ✅ Razorpay Payment Verification
    public function verifyPayment(Request $request)
    {
        try {
            $data = $request->all();
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            // ✅ Securely verify payment signature
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $data['razorpay_order_id'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_signature'  => $data['razorpay_signature'],
            ]);

            // ✅ Fetch Order
            $order = Order::where('razorpay_order_id', $data['razorpay_order_id'])->first();
            if (!$order) {
                return response()->json(['error' => 'Invalid Order'], 400);
            }

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
        } catch (Exception $e) {
            return redirect()->route('order.history')->with('error', 'Payment Verification Failed: ' . $e->getMessage());
        }
    }
}

