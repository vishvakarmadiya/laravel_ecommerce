<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function prodcutAdd()
    {
        $categories = Category::all(); // Fetch all categories
        $subcategories = Subcategory::all(); // Fetch all subcategories

        return view('admin.productAdd', compact('categories', 'subcategories'));
    }


    public function productstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1|lt:mrp',
            'mrp' => 'required|numeric|min:1',

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle image upload (Old Method - Save in 'public/images/products')
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique file name
            $image->move(public_path('images/products'), $imageName); // ✅ Saves inside 'public/images/products'
            $imagePath = $imageName; // Save relative path in DB
        }

        // Create product with description
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'mrp' => $request->mrp,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'status' => $request->status,
            'image' => $imagePath, // ✅ Save correct image path
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    public function productManage()
    {
        $products = collect(DB::select("
            SELECT products.*, categories.name as category_name, subcategories.name as subcategory_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            INNER JOIN subcategories ON products.subcategory_id = subcategories.id
        "));

        return view("admin.productManage", compact('products'));
    }
    public function productEdit($id)
    {
        $categories = Category::all(); // Fetch all categories
        $subcategories = Subcategory::all();
        $products = Product::findOrFail($id);
        return view('admin.productEdite', compact('categories', 'subcategories', 'products'));;
    }
    public function product_delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            $imagePath = public_path('images/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the category
        $product->delete();
        return redirect()->route('productManage')->with('error', 'Category deleted successfully');
    }
    public function productupdate(Request $request, $id)
    {
        // Find the product
        $product = Product::findOrFail($id);

        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'mrp' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $directory = public_path('images/products');

            // Delete old image if exists
            if ($product->image) {
                $oldImagePath = $directory . '/' . $product->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save new image
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($directory, $imageName);

            $product->image = $imageName; // Update image field
        }

        // Update product details
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'mrp' => $request->mrp,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('productManage')->with('success', 'Product updated successfully!');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $product = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->orWhereHas('category', fn($q) => $q->where('name', 'LIKE', "%{$query}%"))
        ->paginate(10); // 10 रिजल्ट प्रति पेज
    
    
        $category = Category::all(); // सभी कैटेगरी प्राप्त करें
        $brand = Subcategory::all(); // सभी सबकैटेगरी प्राप्त करें
    
        return view('font.product', compact('product', 'category', 'brand'));
    }
    
}    
