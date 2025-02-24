<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use HasFactory;

class ForntendController extends Controller
{
    public function index(Request $request, $categoryName = null)
    {
        return view('font.index');
    }
    //     public function products_listing() {
    //         $catagory = Category::orderBy('name', 'ASC')->get();
    //         $brand = Brand::orderBy('name', 'ASC')->get();
    //         $product = Product::where('status',1);

    // if(!empty($catagoryName)){
    //     $catagory=Category::where('name',"$catagoryName")->first();  
    //     $product=$product->where('category_id',$catagory->id); 
    // }

    //         $product=$product->orderBy('id','DESC');

    //         $data = [
    //             'catagory' => $catagory,
    //             'brand' => $brand,
    //             'product' => $product
    //         ];

    //         return view('font.product', $data);
    //     }
    public function products_listing(Request $request, $categoryName = null)
    {
        $category = Category::orderBy('name', 'ASC')->get();
        $brand = Subcategory::orderBy('name', 'ASC')->get();

        $productQuery = Product::where('status', 1);

        $select_cat = Category::where('name', $categoryName)->first();

        if ($select_cat) {
            $productQuery->where('category_id', $select_cat->id);
        }

        // Check for sorting condition
        if (!empty($categoryName) && $categoryName == 'low') {
            $productQuery->orderBy('price', 'ASC'); // Apply sorting
        }
        if (!empty($categoryName) && $categoryName == 'high') {
            $productQuery->orderBy('price', 'DESC'); // Apply sorting
        }

        // Finalize query with pagination
        $product = $productQuery->with(['category'])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $data['category'] = $category;
        $data['brand'] = $brand;
        $data['product'] = $product;
        return view('font.product', $data);
    }
    public function product_ditails(Request $request, $productName = null)
    {
        // Initializing product query to filter active products
        $productQuery = Product::where('status', 1);
        // Fetching categories and brands for the sidebar or filters
        $category = Category::orderBy('name', 'ASC')->get();
        $brand = Subcategory::orderBy('name', 'ASC')->get();
    
        // If a productName is provided, filter products by name
        if ($productName) {
            $productQuery->where('name', $productName);
        }
    
        // Getting the first matching product
        $product = $productQuery->first();
    
        // If no product is found, redirect to the index page with an error
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found');
        }
    
        // Fetch related products based on the product's category
        $relatedProducts = Product::where('category_id', $product->category_id)
                                    ->where('status', 1)
                                    ->get();
    
        // Pass data to the view
        return view("font.product_ditails", [
            'category' => $category,
            'brand' => $brand,
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
    
}
