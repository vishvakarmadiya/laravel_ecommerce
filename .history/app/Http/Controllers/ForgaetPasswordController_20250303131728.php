<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Str;

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
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

public function showResetForm($token)
{
    return view('auth.reset-password', ['token' => $token]);
}

public function resetPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required'
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $reset = DB::table('password_resets')->where('token', $request->token)->first();
    if (!$reset || $reset->email !== $request->email) {
        return back()->with('error', 'Invalid token or email');
    }

    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->with('error', 'User not found');
    }

    $user->password = Hash::make($request->password);
    $user->save();

    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect('/login')->with('message', 'Password has been reset successfully.');
}

}
