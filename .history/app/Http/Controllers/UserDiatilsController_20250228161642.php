<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDiatilsController extends Controller
{
    public function userDiatils()
    {
        User::all();
        return view('admin.user',compact('user'));
    }
}
