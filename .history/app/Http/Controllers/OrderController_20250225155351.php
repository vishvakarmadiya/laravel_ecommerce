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
            // Calculate subtotal
            $subTotal = 0;
            foreach (getCart() as $cartItem) {
                $subTotal += $cartItem->price * $cartItem->quantity;
            }
    
            $shippingCharge = 50; // Fixed shipping cost
            $totalAmount = $subTotal + $shippingCharge;
    
            // Create an order
            $order = Order::create([
                'user_id' => auth()->id(),
                'sub_total' => $subTotal,
                'shipping_charge' => $shippingCharge,
                'payment_method' => $request->payment_method,
                'total' => $totalAmount,
                'status' => 1, // Order placed
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
    
            // Store shipping/billing details in order_address table
            OrderAddress::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'name' => $request->billing_first_name . ' ' . $request->billing_last_name,
                'email' => $request->billing_email,
                'mobile' => $request->billing_mobile,
                'address' => $request->billing_address,
                'city' => $request->billing_city ?? null,
                'state' => $request->billing_state ?? null,
                'pin_code' => $request->billing_zip ?? null,
                'country' => $request->billing_country ?? null,
            ]);
    
            // Clear the cart after successful order placement
            clearCart();
    
            // Redirect with success message
            return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
    

}
