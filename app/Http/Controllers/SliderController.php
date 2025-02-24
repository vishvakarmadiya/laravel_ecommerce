<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider; // Assuming you have a Slider model

class SliderController extends Controller

{
    public function sliderAdd()
    {
        return view(view: "admin.sliderAdd");
    }

    public function sliderstore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        // Upload Image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/sliders'), $imageName);
        }

        // Save to database
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->image = $imageName;
        $slider->description = $request->description;
        $slider->save();

        return redirect()->route('sliderManage')->with('success', 'Slider added successfully');
    }
    public function sliderManage()
    {
        $slider = Slider::all();
        return view("admin.sliderManage", compact('slider'));
    }
}
