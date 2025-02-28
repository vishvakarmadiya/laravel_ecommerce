<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDiatilsController extends Controller
{
    public function userDetails()
    {
        $users = User::all(); // Store the data in a variable
        return view('admin.user', compact('users')); // Pass the correct variable
    }
    
}
