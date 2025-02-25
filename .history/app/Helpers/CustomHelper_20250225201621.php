<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

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
  return (Cart::where('carts.user_id', auth()->id())
    ->join('products', 'carts.product_id', '=', 'products.id')
    ->select('carts.*', 'products.name', 'products.image', 'products.price')
    ->get());
}
return $orders = Order::where('user_id', auth()->id())->get();
