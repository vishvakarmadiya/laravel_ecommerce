<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Cart as GlobalCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addcartshow()
    {

        return view('font.add_cart');
    }
    public function addcart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        // If user is NOT logged in, store cart in SESSION
        if (!auth()->check()) {
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                // Increase quantity if product exists
                $cart[$product->id]['quantity'] += 1;
            } else {
                // Add new product to cart
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart); // Save updated cart in session
            return redirect()->back()->with('success', 'Product added to cart! (Session)');
        }

        // If user is logged in, store cart in DATABASE
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->where('status', 'active') // 1 = active
            ->first();

        if ($cartItem) {
            // If product exists, increment quantity
            $cartItem->increment('quantity');
        } else {
            // Otherwise, create a new cart entry
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Product removed from cart!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    // Update cart item quantity
    public function cart_update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        \Log::info('Received quantity:', ['quantity' => $request->quantity]); // Debugging
        \Log::info('Received quantity:', ['quantity' => $request->quantity]); // Debugging

        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
}
