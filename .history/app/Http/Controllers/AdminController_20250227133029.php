<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index_login(){
        return view("admin.index");
    }  
   
    public function resitorShow(){
        return view("admin.register");
    }  
   
}
