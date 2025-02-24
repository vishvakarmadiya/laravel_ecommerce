<?php 
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
class SubcategoryController extends Controller
{
    public function subCategoryAdd() {
        $categories = Category::all(); // Fetch all categories
        return view("admin.subCategoryAdd", compact('categories'));
    }
    
    public function subcategoryStore(Request $request)
    {
        // Validation
        $request->validate([
            "category_id" => 'required|exists:categories,id',
            "name" => 'required|min:3',
            "description" => 'required|string',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Create new Subcategory instance
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $directory = public_path('images/subcategory');
    
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
    
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move($directory, $imageName);
            $subcategory->image = $imageName;
        }
    
        $subcategory->save();
    
        return redirect()->route('subCategoryAdd')->with('success', 'Subcategory added successfully');
    }
    
    public function subCategoryManage(){
        $subcategories = DB::table('subcategories')
        ->join('categories', 'subcategories.category_id', '=', 'categories.id')
        ->select('subcategories.*', 'categories.name as category_name')
        ->get();
        return view("admin.subCategoryManage", compact('subcategories'));
    }
    public function subcategoryEdit($id) {
        $subcategory = Subcategory::findOrFail($id); // Fetch the subcategory
        $categories = Category::all(); // Fetch all categories for dropdown
    
        return view('admin.subcategoryEdit', compact('subcategory', 'categories'));
    }
    public function SubCategoryUpdate(Request $request, $id) {
        // Find the existing subcategory
        $subcategory = Subcategory::findOrFail($id); 
        
        // Validation
        $request->validate([
            "category_id" => 'required|exists:categories,id',
            "name" => 'required|min:3',
            "description" => 'required|string',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Update fields
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
    
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $directory = public_path('images/subcategory');
    
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
    
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move($directory, $imageName);
            
            // Delete old image (if exists)
            if ($subcategory->image) {
                $oldImagePath = $directory . '/' . $subcategory->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $subcategory->image = $imageName;
        }
    
        // Save updated subcategory
        $subcategory->save();
    
        return redirect()->route('subCategoryManage')->with('success', 'Subcategory updated successfully');
    }
    public function sub_category_destroy($id)
    {
        $subcategory = SubCategory::find($id);
    
        if ($subcategory) {
            $subcategory->delete();
            return redirect()->back()->with('success', 'Subcategory deleted successfully.');
        }
    
        return redirect()->back()->with('error', 'Subcategory not found.');
    }
    
}
