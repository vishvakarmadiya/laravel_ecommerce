<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;

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

        // Retrieve Cart Items from Session
        $cartItems = session()->get('cart', []);

        if (empty(getcart())) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Use database transaction for safety
        DB::beginTransaction();

        try {
            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'billing_first_name' => $validated['billing_first_name'],
                'billing_last_name' => $validated['billing_last_name'],
                'billing_email' => $validated['billing_email'],
                'billing_mobile' => $validated['billing_mobile'],
                'billing_address' => $validated['billing_address'],
                'billing_city' => $validated['billing_city'],
                'billing_state' => $validated['billing_state'],
                'billing_zip' => $validated['billing_zip'],
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'shipping_charge'=>50,
                'sub_total' => collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['price']), // Calculate subtotal
            ]);
            

            // Insert Order Items
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['quantity'], // Ensure correct key
                    'selling_price' => $item['price'], // Ensure correct key
                ]);
            }

            // Commit transaction
            DB::commit();

            // Clear the cart after order is placed
            session()->forget('cart');

            return redirect()->route('order.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
        
    }
}
