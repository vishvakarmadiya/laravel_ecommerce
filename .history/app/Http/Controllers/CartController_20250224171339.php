<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart (Session for guests, Database for logged-in users)
    public function addcart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        // If user is not logged in, store the cart in session
        if (!auth()->check()) {
            $cart = session()->get('cart', []);

            // Check if product is already in the session cart
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += 1;
            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart); // Store cart in session
            return redirect()->back()->with('success', 'Product added to cart! (Session)');
        }

        // If user is logged in, store cart in database
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price, 
        ]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Display cart items (Both Session and Database)
    public function showCart()
    {
        $cart = auth()->check() 
            ? Cart::where('user_id', auth()->id())->get() // Database cart for logged-in users
            : session()->get('cart', []); // Session cart for guests

        return view('cart', compact('cart'));
    }

    // Transfer session cart to database after login
    public function transferSessionCart()
    {
        if (auth()->check()) {
            $cart = session()->get('cart', []);

            foreach ($cart as $item) {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart'); // Clear session cart after transfer
        }
    }

    // Remove item from cart
    public function removeItem($id)
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->where('id', $id)->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
