<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function categoryAdd(){
        return view("admin.categoryAdd");
    }
    public function categoryStore(Request $request)
{
    // Validation rules
    $request->validate([
        "name" => 'required|min:3',
        "description" => 'required|string',
        "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Create a new category instance
    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;

    // Handle image upload
    if ($request->hasFile('image')) {
       
        $directory = public_path('images/category');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Generate a unique name for the image
        $imageName = time() . '.' . $request->file('image')->extension();

        // Move the image to the public directory
        $request->file('image')->move($directory, $imageName);

        // Save the image name to the category
        $category->image = $imageName;
    }

    // Save the category to the database
    $category->save();

    // Redirect back with a success message
    return redirect()->route('categoryAdd')->with('success', 'Category added successfully');
}

    public function categoryManage(){
        $categories = Category::all();
        return view("admin.categoryManage", compact('categories'));
    }

    public function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('admin.categoryEdit', compact('category'));;
    }

    public function catagoryDelete($id) {
        $category = Category::findOrFail($id);
    
        // Delete category image if it exists
        if ($category->image) {
            $imagePath = public_path('images/category/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        // Delete the category
        $category->delete();
    
        return redirect()->route('categoryManage')->with('error', 'Category deleted successfully');
    }

    
    public function updatecategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

    $request->validate([
        "name" => 'required|min:3',
        "description" => 'required|string',
        "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $category->name = $request->name;
    $category->description = $request->description;

    if ($request->hasFile('image')) {
        $directory = public_path('images/category');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $imageName = time() . '.' . $request->file('image')->extension();
        $request->file('image')->move($directory, $imageName);

        $category->image = $imageName;
    }

    $category->save();

    return redirect()->route('categoryManage', $category->id)->with('success', 'Category updated successfully');
    }
    
    
}
