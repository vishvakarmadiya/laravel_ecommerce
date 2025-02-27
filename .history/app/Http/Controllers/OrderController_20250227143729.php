<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\Cart; // Ensure you import the Cart model
use Illuminate\Support\Facades\Auth;
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

        // Fetch cart items
        $cartItems = Cart::where('user_id', Auth::id())->get(); // Fixed variable name
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate subtotal
        $subTotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingCharge = 50; // Fixed shipping cost
        $totalAmount = $subTotal + $shippingCharge;

        // Create order
        $order = Order::create([
            'user_id'          => Auth::id(),
            'sub_total'        => $subTotal,
            'payment_method'   => $validated['payment_method'],
            'shipping_charge'  => $shippingCharge,
            'total'            => $totalAmount,
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ]);

        // Store order items in bulk (fixing missing selling_price)
        $orderItems = $cartItems->map(fn($cartItem) => [
            'order_id'       => $order->id,
            'product_id'     => $cartItem->product_id,
            'quantity'       => $cartItem->quantity,
            'selling_price'          => $cartItem->price,
            'selling_price'  => $cartItem->price, // Ensuring selling_price is inserted
            'total'          => $cartItem->price * $cartItem->quantity,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ])->toArray();

        OrderDetail::insert($orderItems); // Bulk insert

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
            'country'    => $request->input('billing_country') ?? 'India', // Default to 'India'
        ]);

        // Clear the cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
    }
}
