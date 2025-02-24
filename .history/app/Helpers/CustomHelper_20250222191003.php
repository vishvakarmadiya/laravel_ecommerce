<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

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

?>