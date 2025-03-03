<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function login()
    {
        return view('admin.login');
    }

    public function Admil_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Check if the user has a valid role (admin or user)
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            } elseif ($user->role === 'user') {
                // Store user name in session
                session(['user_name' => $user->id]);
    
                return redirect()->route('index')->with('success', 'Welcome User!');
            } else {
                Auth::logout(); // Log out the user if role is invalid
                return redirect()->back()->with('error', 'Unauthorized access! Contact support.');
            }
        }
    
        return redirect()->back()->with('error', 'Invalid email or password.');
    }
    

    public function storeSessionCart(Request $request)
    {
        $cart = $request->cart;
        if ($cart) {
            session()->put('cart', $cart);
        }
        return response()->json(['success' => true]);
    }
    

    /**
     * Show the admin registration form.
     */
    public function resitorShow()
    {
        return view('admin.register');
    }

    /**
     * Store a new admin user.
     */
    public function Admin_store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Password confirmation required
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash password

        ]);
        $to=$validatedData['email'];
        $subject="Welcome to our website";
        $message="You have successfully registered";
        Mail::to($to)->send(RegisterMail($subject,$message));


        return redirect()->route('admin.login')->with('success', 'Admin user created successfully.');
    }

    /**
     * Handle admin logout.
     */
    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
