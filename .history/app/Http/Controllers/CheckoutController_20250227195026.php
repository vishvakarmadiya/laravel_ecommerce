<?php

namespace App\Http\Controllers;

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
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name'  => 'required|string|max:255',
            'billing_email'      => 'required|email',
            'billing_mobile'     => 'required|numeric',
            'billing_address'    => 'required|string',
            'billing_city'       => 'required|string',
            'billing_state'      => 'required|string',
            'billing_zip'        => 'required|numeric',
        ]);
    }
    
}
