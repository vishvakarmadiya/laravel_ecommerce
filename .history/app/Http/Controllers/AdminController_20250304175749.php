<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index_login()
    {
        $today = Carbon::today();

        $total_sell = DB::table('orders')
            ->whereDate('created_at', $today)
            ->sum('total');

        $orders_count = DB::table('order_details')
            ->whereDate('created_at', $today)
            ->count();
        $total_sell = DB::table('orders')->sum('total');


        $orders_count = DB::table('order_details')->count();

        return view("admin.index", compact('total_sell', 'orders_count'));
    }

    public function resitorShow()
    {
        return view("admin.register");
    }
}
