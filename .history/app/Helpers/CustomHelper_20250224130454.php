<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

function getCtegorys(){
  return  Category::orderBy('id','ASC')->get();
}
function getproduct(){
  return  Product::orderBy('id','ASC')->get();
}
function getSlider(){
  return  Slider::orderBy('id','ASC')->get();
}
function getFeature() {
    return Product::orderBy('id', 'ASC')->take(5)->get();
}
function getLatestProducts() {
  return Product::orderBy('created_at', 'DESC')->take(5)->get();
}
function getCart(){
  return Cart::where('user_id',Auth::id())->count();
}

?>