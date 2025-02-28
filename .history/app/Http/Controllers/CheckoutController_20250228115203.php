<?php

namespace App\Http\Controllers;

use App\Models\OrderAddress;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        return view ('font.checkout');
    }
    public function shipingAddrase(){
        return view ('font.shiping_addrass');
    }
    public function orderAddress(Request $request){
        $validated = $request->validate([
           
        ]);
        OrderAddress::create([
            
            'user_id'    => auth()->id(),
            'name'       => "{$validated['billing_first_name']} {$validated['billing_last_name']}",
            'email'      => $validated['billing_email'],
            'mobile'     => $validated['billing_mobile'],
            'address'    => $validated['billing_address'],
            'city'       => $validated['billing_city'],
            'state'      => $validated['billing_state'],
            'pin_code'   => $validated['billing_zip'],
            'country'    => $request->input('billing_country', 'India'),
        ]);
        return redirect()->route('checkout')->with('success', 'Billing address saved successfully.');

    }
    
}
