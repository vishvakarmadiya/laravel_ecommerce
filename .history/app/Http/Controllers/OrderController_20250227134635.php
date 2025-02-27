<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function order_store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name'  => 'required|string|max:255',
            'billing_email'      => 'required|email',
            'billing_mobile'     => 'required|numeric',
            'billing_address'    => 'required|string',
            'billing_city'       => 'required|string',
            'billing_state'      => 'required|string',
            'billing_zip'        => 'required|numeric',
            'payment_method'     => 'required|string',
        ]);

        try {
            DB::beginTransaction(); // Start transaction

            // Fetch cart items
            $cartItems = Cart::where("user_id", Auth::id())->get();
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            // Calculate subtotal
            $subTotal = array_reduce($cartItems->toArray(), function ($total, $item) {
                return $total + ($item['price'] * $item['quantity']);
            }, 0);
            
            $shippingCharge = 50; // Fixed shipping cost
            $totalAmount = $subTotal + $shippingCharge;

            // Create order
            $order = Order::create([
                'user_id'          => Auth::id(),
                'sub_total'        => $subTotal,
                'shipping_charge'  => $shippingCharge,
                'total'            => $totalAmount,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ]);

            // Store order items in bulk
            $orderItems = $cartItems->map(function ($cartItem) use ($order) {
                return [
                    'order_id'   => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity'   => $cartItem->quantity,
                    'price'      => $cartItem->price,
                    'total'      => $cartItem->price * $cartItem->quantity,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            })->toArray();

            OrderDetail::insert($orderItems);

            // Store order address
            OrderAddress::create([
                'order_id'   => $order->id,
                'user_id'    => Auth::id(),
                'name'       => "{$validated['billing_first_name']} {$validated['billing_last_name']}",
                'email'      => $validated['billing_email'],
                'mobile'     => $validated['billing_mobile'],
                'address'    => $validated['billing_address'],
                'city'       => $validated['billing_city'],
                'state'      => $validated['billing_state'],
                'pin_code'   => $validated['billing_zip'],
                'country'    => $request->input('billing_country', 'India'), // Default to 'India'
            ]);

            // Clear the cart after order placement
            Cart::where("user_id", Auth::id())->delete();

            DB::commit(); // Commit transaction

            return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on failure
            Log::error('Order Store Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong while processing your order. Please try again later.');
        }
    }
}
