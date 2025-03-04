<?php

namespace App\Http\Controllers;

use App\Models\OrderAddress;
use App\Models\User;
use Illuminate\Http\Request;

class UserDiatilsController extends Controller
{
    public function userDiatils()
    {
        $users = User::where('role', 'user')->get();
        // Store the data in a variable
        return view('admin.user', compact('users')); // Pass the correct variable
    }
    public function updateAccount(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'order_mobile' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pin_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user profile
        $user->update([
            'name' => $request->name,
        ]);

        // Update address if provided
        if ($request->id) {
            $address = UserOrderAddress::find($request->id);

            if ($address) {
                $address->update([
                    'name' => $request->full_name,
                    'mobile' => $request->order_mobile,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pin_code' => $request->pin_code,
                    'country' => $request->country,
                ]);
            }
        } else {
            // Create new address if no ID is found
            OrderAddress::create([
                'user_id' => $user->id,
                'name' => $request->full_name,
                'mobile' => $request->order_mobile,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pin_code' => $request->pin_code,
                'country' => $request->country,
            ]);
        }

        return redirect()->back()->with('success', 'Account updated successfully.');
    }
}
