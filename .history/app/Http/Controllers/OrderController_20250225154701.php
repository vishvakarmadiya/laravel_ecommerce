<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_store(Request $request)
{
    // Validate the request data
    $request->validate([
        'billing_first_name' => 'required|string|max:255',
        'billing_last_name' => 'required|string|max:255',
        'billing_email' => 'required|email',
        'billing_mobile' => 'required|numeric',
        'billing_address' => 'required|string',
        'shipping_first_name' => 'nullable|string|max:255',
        'shipping_last_name' => 'nullable|string|max:255',
        'shipping_email' => 'nullable|email',
        'shipping_mobile' => 'nullable|numeric',
        'payment_method' => 'required|string',
    ]);

    try {
        // Create an order
        $order = Order::create([
            'user_id' => auth()->id(),
            'billing_first_name' => $request->billing_first_name,
            'billing_last_name' => $request->billing_last_name,
            'billing_email' => $request->billing_email,
            'billing_mobile' => $request->billing_mobile,
            'billing_address' => $request->billing_address,
            'shipping_first_name' => $request->shipping_first_name ?? $request->billing_first_name,
            'shipping_last_name' => $request->shipping_last_name ?? $request->billing_last_name,
            'shipping_email' => $request->shipping_email ?? $request->billing_email,
            'shipping_mobile' => $request->shipping_mobile ?? $request->billing_mobile,
            'payment_method' => $request->payment_method,
            'total_amount' => getCartTotal() + 50, // Adding fixed shipping cost
            'status' => 'pending',
        ]);

        // Store order items
        foreach (getCart() as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->id,
                'product_name' => $cartItem->name,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
                'total' => $cartItem->price * $cartItem->quantity,
            ]);
        }

        // Clear the cart after successful order placement
        clearCart();

        // Redirect with success message
        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
    
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }
}

}
