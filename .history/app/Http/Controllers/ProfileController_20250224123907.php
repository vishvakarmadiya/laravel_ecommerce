<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function profile(){
    return view('font.profile');
   }
   public function profile_logout(){
    return view('font.profile');
   }
}
