<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgaetPasswordController extends Controller
{
    public function forgetPasswordshow()
    {
        return view('auth.paswordFoegot');
    }
    public function forgetPassword(Request $request)
    {
        // Validate Email Input
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
    
        $email = $request->email;
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // Generate Unique Token
            $token = Str::random(64);
    
            // Delete existing tokens for the user
            DB::table('password_resets')->where('email', $email)->delete();
    
            // Store Reset Token
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
    
            // Send Reset Email
            Mail::to($email)->send(new ForgetPasswordMail($token));
    
            return back()->with('message', 'Password reset link has been sent to your email.');
        }
    
        return back()->with('error', 'Email not found.');
    }
}
