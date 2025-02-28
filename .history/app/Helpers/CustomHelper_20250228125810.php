<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function getCtegorys()
{
  return  Category::orderBy('id', 'ASC')->get();
}
function getproduct()
{
  return  Product::orderBy('id', 'ASC')->get();
}
function getSlider()
{
  return  Slider::orderBy('id', 'ASC')->get();
}
function getFeature()
{
  return Product::orderBy('id', 'ASC')->take(5)->get();
}
function getLatestProducts()
{
  return Product::orderBy('created_at', 'DESC')->take(5)->get();
}
function getCart()
{
  return Cart::where('carts.user_id', auth()->id())
    ->join('products', 'carts.product_id', '=', 'products.id')
    ->select('carts.*', 'products.name', 'products.image', 'products.price')
    ->where('carts.status', 'active') // Specify the table name for clarity
    ->get();
}
// function getUserOrders()
// {
//     return DB::table('orders')
//         ->join('order_addresses', 'orders.id', '=', 'order_addresses.order_id') // ✅ Fix the join condition
//         ->where('orders.user_id', auth()->id())
//         ->select('orders.*', 'order_addresses.*') // ✅ Select only required columns
//         ->get();
// }

SQLSTATE[42S22]: Column not found: 1054 Unknown column 'order_addresses.order_id' in 'on clause' (Connection: mysql, SQL: select `orders`.*, `order_addresses`.* from `orders` inner join `order_addresses` on `orders`.`id` = `order_addresses`.`order_id` where `orders`.`user_id` = 1)
