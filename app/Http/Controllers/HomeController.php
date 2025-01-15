<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Coupons;
use App\Models\Language;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function notfound()
    {
    $Coupons  = Coupons::whereIn('id', function($query) {
    $query->select(DB::raw('MAX(id)'))
    ->from('coupons')
    ->groupBy('store');
    })
    ->orderBy('created_at', 'desc')
    ->paginate(24);
    return view('errors.404', compact('Coupons'));
    }
    public function contact($lang = null)
    {
        $languageCode = $lang ;
        app()->setLocale($languageCode);
    return view('contact', compact('Coupons'));
    }
    
    
    public function index(Request $request, $lang = null) {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);
    
        // Fetch the language, or default to English
        $language = Language::where('code', $languageCode)->firstOr(function () {
            abort(404, 'Language not found');
        });
    
        // Fetch stores for the specified language
        $stores = Stores::select('id', 'name', 'language_id', 'slug')
        ->where('language_id', $language->id)
        ->where('authentication', 'top_stores')
        ->latest() // Shortcut for orderBy('created_at', 'desc')
        ->limit(12)
        ->get()
        ->map(function ($store) use ($language) {
            $store->url_with_language = url($language->code . '/store/' . $store->id);
            return $store;
        });
    
    
        // Fetch top coupon codes for the specified language
        $topcouponcode = Coupons::select('id', 'name', 'language_id', 'created_at','name','ending_date','store','clicks','destination_url','authentication') 
        ->whereNotNull('code')
            ->where('code', '!=', '')
            ->where('language_id', $language->id)
            ->where('top_coupons', '>', 0)
            ->orderByRaw('CAST(`top_coupons` AS SIGNED) DESC')
            ->limit(8)
            ->get();
    
        // Optimize top deals query
        // Fetch top deals for the specified language
        $Couponsdeals = Coupons::select('id', 'name', 'language_id', 'created_at', 'ending_date', 'store','clicks','destination_url','authentication')
            ->where('language_id', $language->id)
            ->where(function ($query) {
                $query->where('top_coupons', '>', 0)
                      ->orWhereNull('top_coupons');
            })
            ->whereNull('code') // Ensure no coupon code
            ->orderBy('top_coupons', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
    
    
        // Return the welcome view with the required data
        return view('home', compact('stores', 'Couponsdeals', 'topcouponcode'));
    }
    
    
    public function search(Request $request) {
    $query = $request->input('query');
    $store = Stores::where('name', $query)->first();
    if ($store) {
    return redirect()->route('store.details', ['name' => $store->name]);
    }
    $stores = Stores::where('name', 'like', "$query%")->latest()->get();
    
    return view('search_results', compact('stores'));
    }
    
    
    
    public function blog_home(Request $request, $lang = null)
    {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);
        // Paginate blogs as usual
        $blogs = Blog::paginate(5);
    
        // Check if a language code is provided
        if ($lang) {
            // Find the language by the code in the URL
            $language = Language::where('code', $lang)->first();
    
            if ($language) {
                // Get stores filtered by language and paginate
                $chunks = Stores::where('language_id', $language->id)
                    ->paginate(25)
                    ->map(function($store) use ($language) {
                        // Append language code to the store's URL
                        $store->url_with_language = url($language->code . '/blog/' . $store->id);
                        return $store;
                    });
            } else {
                abort(404, 'Language not found');
            }
        } else {
            // Default to English or a fallback if no language code is provided
            $chunks = Stores::paginate(25)->map(function($store) {
                $language = Language::find($store->language_id);
                $store->url_with_language = $language ? url($language->code . '/blog/' . $store->id) : url('en/store/' . $store->id);
                return $store;
            });
        }
    
        return view('blog', compact('blogs', 'chunks'));
    }
    
    
    
    
    public function blog_show($name) {
    $slug = Str::slug($name);
    $title = ucwords(str_replace('-', ' ', $slug));
    $blog = Blog::where('slug', $title)->first();
    if (!$blog) {
    return redirect('404');
    }
    $chunks = Stores::latest()->limit(20)->get();
    
    return view('blog_details', compact('blog', 'chunks'));
    }
    
    
 public function stores(Request $request, $lang = null)
    {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);
    
        if ($lang) {
            $language = Language::where('code', $lang)->first();
    
            if ($language) {
                $stores = Stores::where('language_id', $language->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
    
                // Modify the items in the paginated collection
                $stores->getCollection()->transform(function ($store) use ($language) {
                    $store->url_with_language = url($language->code . '/store/' . $store->id);
                    return $store;
                });
            } else {
                abort(404, 'Language not found');
            }
        } else {
            $stores = Stores::paginate(10);
    
            // Modify the items in the paginated collection
            $stores->getCollection()->transform(function ($store) {
                $language = Language::find($store->language_id);
                $store->url_with_language = $language
                    ? url($language->code . '/store/' . $store->id)
                    : url('en/store/' . $store->id);
                return $store;
            });
        }
    
        return view('stores', compact('stores'));
    }
    
    
    
    
    public function StoreDetails($lang = 'en', $slug, Request $request) 
    {
        // Set the app locale to the provided language or default to 'en'
        app()->setLocale($lang);
    
        // Normalize the slug
        $slug = Str::slug($slug);
        $title = ucwords(str_replace('-', ' ', $slug));
    
        // Fetch the store by slug and eager load the language relation
        $store = Stores::with('language')->where('slug', $title)->first();
    
        if (!$store) {
            abort(404); // Store not found
        }
    
        // Check if the store has an associated language
        if (!$store->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }
    
        // Redirect if the language code doesn't match the store's language
        if ($lang !== $store->language->code) {
            return redirect()->route('store_details.withLang', [
                'lang' => $store->language->code,
                'slug' => $slug
            ]);
        }
    
        // Sorting and fetching coupons
        $sort = $request->query('sort', 'all');
        if ($sort === 'codes') {
            $coupons = Coupons::where('store', $store->slug)
                              ->whereNotNull('code')
                              ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                              ->get();
        } elseif ($sort === 'deals') {
            $coupons = Coupons::where('store', $store->slug)
                              ->whereNull('code')
                              ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                              ->get();
        } else {
            $coupons = Coupons::where('store', $store->slug)
                              ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                              ->get();
        }
    
        // Count the number of codes and deals
        $codeCount = Coupons::where('store', $store->slug)
                            ->whereNotNull('code')
                            ->count();
        $dealCount = Coupons::where('store', $store->slug)
                            ->whereNull('code')
                            ->count();
    
        // Fetch related stores based on the same category
        $relatedStores = Stores::where('category', $store->category)
                               ->where('id', '!=', $store->id)
                               ->where('language_id', $store->language_id)
                               ->get();
    
        return view('store_details', compact('store', 'coupons', 'relatedStores', 'codeCount', 'dealCount'));
    }
    
    
    
    
    
    public function categories(Request $request, $lang = null) {
    $categories = Categories::all();
    return view('categories', compact('categories', ));
    }
    
    public function viewcategory($name) {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
    
        // Fetch the store
        $category = Categories::where('slug', $title)->first();
    
    
        if (!$category) {
    return redirect('404');
        }
    
        // Fetch related coupons and stores
        $stores = Stores::where('category', $title)->get();
    
    
        return view('related_category', compact('category', 'stores' ));
    }
    
    
    
}
