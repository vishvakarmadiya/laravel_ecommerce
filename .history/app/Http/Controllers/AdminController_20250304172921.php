<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{use Illuminate\Support\Facades\DB;

    public function index_login()
    {
        $total_sell = DB::table('orders')->sum('total');
    
        // यहाँ '=' ऑपरेटर का उपयोग करके वैरिएबल को असाइन करें
        $orders_count = DB::table('order_details')->count();
    
        return view("admin.index", compact('total_sell', 'orders_count'));
    }
    
    public function resitorShow(){
        return view("admin.register");
    }  
   
}
