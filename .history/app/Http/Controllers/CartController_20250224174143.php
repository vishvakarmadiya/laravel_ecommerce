<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart (Session for guests, Database for logged-in users)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Get session cart
            $sessionCart = session()->get('cart', []);
    
            foreach ($sessionCart as $productId => $item) {
                $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();
    
                if ($cartItem) {
                    // If product exists, increase quantity
                    $cartItem->increment('quantity', $item['quantity']);
                } else {
                    // Otherwise, create a new cart entry
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }
            }
    
            // Clear session cart after transfer
            session()->forget('cart');
    
            return redirect()->route('home')->with('success', 'Login successful! Your cart has been saved.');
        }
    
        return redirect()->back()->with('error', 'Invalid credentials.');
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
