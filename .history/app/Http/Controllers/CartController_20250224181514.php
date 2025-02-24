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
{public function addcart(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Saved in session storage!'], 200);
        }
    
        $product = Product::findOrFail($request->product_id);
    
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id);
    
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
    
        return response()->json(['message' => 'Product added to cart!'], 200);
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
    public function updateCart(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = GlobalCart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
}
