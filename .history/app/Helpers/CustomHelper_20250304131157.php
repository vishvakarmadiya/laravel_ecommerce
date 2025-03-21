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
function getUserOrders()
{
  return DB::table('orders')
  ->join('users', 'orders.user_id', '=', 'users.id')
  ->where('orders.user_id', auth()->id())
  ->select('orders.*', 'users.name as name', 'users.email as user_email')
  ->orderBy('orders.created_at', 'desc') // Orders latest first
  ->get();
}
function getUserOrdersAdress()
{

  $address = OrderAddress::whereHas('order', function ($query) {
    $query->where('user_id', Auth::id());
})->first();

}
