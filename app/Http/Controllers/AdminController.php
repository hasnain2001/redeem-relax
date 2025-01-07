<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Coupons;
use App\Models\DeleteStore;
use App\Models\Language;
use App\Models\Networks;
use App\Models\Stores;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function dashboard()
   {
       $coupons =Coupons::all();
       $blogs =Blog::all();
       $categories =Categories::all();
       $networks =Networks::all();
       $users = User::all();
       $stores =Stores::all();
       $langs =Language::all();
       return view('admin.dashboard',compact('stores','coupons','blogs','categories','networks','users','langs'));
   }

   public function index()
   {  
   $users =User::all();
   return view('admin.user.index', compact('users',));
   }
}
