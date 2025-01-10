<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Coupons;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

public function notfound(){
    $topCoupons = Coupons::whereIn('id', function($query) {
        $query->select(DB::raw('MAX(id)'))
              ->from('coupons')
              ->groupBy('store');
    })
    ->orderBy('created_at', 'desc')
    ->paginate(21);

    return view('errors.404',compact('topCoupons'));

}
    public function index() {
    $categories = Categories::select('title','category_image')
    ->where('authentication', 'top_stores')
    ->orderby('created_at','asc')
    ->limit(6)
    ->get();
    $blogs = Blog::select('id','category_image','title','slug')->orderBy('created_at','desc')->limit(10)->get();
    $store = Stores::select('id','store_image','name','slug',)->orderBy('created_at', 'desc')->limit(24)->get();
    $topCoupons = Coupons::whereIn('id', function($query) {
    $query->selectRaw('MAX(id) as id')
    ->from('coupons')
    ->groupBy('store');
    })
    ->orderBy('created_at', 'desc')
    ->limit(24)
    ->get();
    return view('home', compact('store', 'categories', 'blogs','topCoupons'));
    }
public function blog_home()
{
      $blogs = Blog::paginate(5);
$chunks = Stores::latest()->limit(25)->get();

    return view('blog', compact('blogs', 'chunks')); // Pass both data to the view
}

public function blog_show($slug) {
    // Decode the URL-encoded slug to a readable format
    $decodedTitle = str_replace('-', ' ', $slug);

    // Fetch the blog post by slug
    $blog = Blog::where('slug', $decodedTitle)->first();

    // If blog post not found, abort with a 404 error
    if (!$blog) {
        return redirect('404');
    }

    // Fetch latest stores
    $chunks = Stores::latest()->limit(25)->get();

    // Return the view with the blog post and stores
    return view('blog-details', compact('blog', 'chunks'));
}
public function stores(Request $request)
{
    $letter = $request->input('letter');
    $storesQuery = Stores::query();

    if ($letter) {
    $storesQuery->where('name', 'like', $letter.'%');
    }

    $stores = $storesQuery->orderBy('name')->paginate(24);
 
    return view('stores', compact('stores'));
}
    public function StoreDetails($name) {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));

        // Fetch the store
        $store = Stores::where('slug', $title)->first();


        if (!$store) {
   return redirect('404');
        }

        // Fetch related coupons and stores
        $coupons = Coupons::where('store', $title)
                          ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                          ->get();

        $relatedStores = Stores::where('category', $store->category)
                               ->where('id', '!=', $store->id)
                               ->paginate(10);

        return view('store_details', compact('store', 'coupons', 'relatedStores'));
    }


      public function categories() {
        $category = Categories::all();
        return view('categories', compact('category'));
    }


    public function RelatedCategoryStores($name) {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));

        // Fetch the store
        $category = Categories::where('title', $title)->first();


        if (!$category) {
   return redirect('404');
        }

        // Fetch related coupons and stores
        $stores = Stores::where('category', $title)->get();


        return view('related_category', compact('category', 'stores' ));
    }
}
