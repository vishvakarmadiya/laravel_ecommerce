<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{

    public function brandAdd()
    {
        return view(view: "admin.brandAdd");
    }
    public function brandManage()
{
    $brands = Brand::all(); // Use a plural variable name for better clarity
    return view('admin.brandManage', compact('brands'));
}

    public function bradstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;

       
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/brands'), $filename);
            $brand->image = $filename;

        $brand->save();

        return redirect()->back()->with('success', 'Brand added successfully.');
    }
    public function brandEdit($id)
{
    $brand = Brand::find($id); // Fetch brand by ID
    
    if (!$brand) {
        return redirect()->route('brandManage')->with('error', 'Brand not found');
    }

    return view('admin.brandEdit', compact('brand')); // Return view with brand data
}
public function brand_update(Request $request, $id) {
    // Find the existing brand
    $brand = Brand::findOrFail($id); 
    
    // Validation
    $request->validate([

        "name" => 'required|min:3',
        "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update fields
   
    $brand->name = $request->name;

    // Handle Image Upload
    if ($request->hasFile('image')) {
        $directory = public_path('images/brands');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $imageName = time() . '.' . $request->file('image')->extension();
        $request->file('image')->move($directory, $imageName);
        
        // Delete old image (if exists)
        if ($brand->image) {
            $oldImagePath = $directory . '/' . $brand->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $brand->image = $imageName;
    }

    // Save updated brand
    $brand->save();

    return redirect()->route('brandManage')->with('success', 'Brand updated successfully');
}
public function brand_delete($id) {
    $brand = Brand::findOrFail($id);

    // Delete brand image if it exists
    if ($brand->image) {
        $imagePath = public_path('images/brand/' . $brand->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the brand
    $brand->delete();

    return redirect()->route('brandManage')->with('error', 'brand deleted successfully');
}

    
}

