<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgaetPasswordController extends Controller
{
    public function forgetPasswordshow()
    {
        return view('auth.paswordFoegot.blade.php');
    }
}
