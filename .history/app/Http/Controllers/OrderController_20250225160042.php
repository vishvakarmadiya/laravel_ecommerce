<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\DB;

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
            'billing_city' => 'nullable|string|max:255',
            'billing_state' => 'nullable|string|max:255',
            'billing_zip' => 'nullable|string|max:10',
            'billing_country' => 'nullable|string|max:255',
            'shipping_first_name' => 'nullable|string|max:255',
            'shipping_last_name' => 'nullable|string|max:255',
            'shipping_email' => 'nullable|email',
            'shipping_mobile' => 'nullable|numeric',
            'payment_method' => 'required|string|in:Direct Bank Transfer,Cash on Delivery',
        ]);

        try {
            DB::beginTransaction(); // Start transaction

            // Check if cart is empty
            $cartItems = getCart();
            if (!$cartItems || count($cartItems) === 0) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            // Calculate subtotal
            $subTotal = collect($cartItems)->sum(fn($item) => $item->price * $item->quantity);
            $shippingCharge = 50; // Fixed shipping cost
            $totalAmount = $subTotal + $shippingCharge;

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'sub_total' => $subTotal,
                'shipping_charge' => $shippingCharge,
                'payment_method' => $validated['payment_method'],
                'total' => $totalAmount,
                'status' => 1, // Order placed
            ]);

            // Store order items in bulk
            $orderItems = array_map(fn($cartItem) => [
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id, // Ensure this matches your product model
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
                'total' => $cartItem->price * $cartItem->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ], $cartItems);

            OrderItem::insert($orderItems);

            // Store order address
            OrderAddress::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'name' => "{$validated['billing_first_name']} {$validated['billing_last_name']}",
                'email' => $validated['billing_email'],
                'mobile' => $validated['billing_mobile'],
                'address' => $validated['billing_address'],
                'city' => $validated['billing_city'] ?? null,
                'state' => $validated['billing_state'] ?? null,
                'pin_code' => $validated['billing_zip'] ?? null,
                'country' => $validated['billing_country'] ?? null,
            ]);

            // Clear the cart
            clearCart();

            DB::commit(); // Commit transaction

            return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on failure
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
