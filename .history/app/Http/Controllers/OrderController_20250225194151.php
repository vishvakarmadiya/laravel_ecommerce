<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function order_store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email',
            'billing_mobile' => 'required|numeric',
            'billing_address' => 'required|string',
            'billing_city' => 'required|string',
            'billing_state' => 'required|string',
            'billing_zip' => 'required|numeric',
            'payment_method' => 'required',
        ]);

        // Retrieve Cart Items
        $cartItems = Cart::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            // Calculate Subtotal
            $subTotal = collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['price']);
            $total = $subTotal + 50; // Adding shipping charge

            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'payment_method' => $validated['payment_method'], 
                'shipping_charge' => 50,
                'sub_total' => $subTotal, 
                'total' => $total, 
            ]);

            // Create Order Address
            OrderAddress::create([
                'name' => $validated['billing_first_name'] . ' ' . $validated['billing_last_name'],
                'user_id' => auth()->id(),
                'email' => $validated['billing_email'],
                'mobile' => $validated['billing_mobile'],
                'address' => $validated['billing_address'],
                'city' => $validated['billing_city'],
                'state' => $validated['billing_state'],
                'pin_code' => $validated['billing_zip'],
                'country' => 'India',
                'order_id' => $order->id,
                'order_date' => now(),
            ]);

            // Insert Order Items
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['quantity'],
                    'selling_price' => $item['price'],
                ]);
            }

            // Remove cart items from database
            Cart::where('user_id', auth()->id())->delete();

            // Commit transaction
            DB::commit();

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('order.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
