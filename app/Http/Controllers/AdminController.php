<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function dashboard()
   {
         $users = User::all();
    
       return view('admin.dashboard',compact('users'));
   }

   public function index()
   {  
   $users =User::all();
   return view('admin.user.index', compact('users',));
   }
}
