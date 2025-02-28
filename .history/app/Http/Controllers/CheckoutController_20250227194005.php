<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        return view ('font.checkout');
    }
    public function payment(){
        return view ('font.shiping_addrass');
    }
}
