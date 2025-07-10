<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\language;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $lang = null)
    {
        $languageCode = $lang ?? 'en';
        app()->setLocale($languageCode);

        // Fetch the language, or default to English
        $language = language::where('code', $languageCode)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter all models by language_id
        $stores = Store::select('id', 'name', 'slug', 'category_id', 'image')
            ->where('language_id', $language->id)
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();

        $sliders = Slider::where('status', 1)
            ->where('language_id', $language->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        $categories = Category::where('top_category', 1)
            ->where('language_id', $language->id)
            ->limit(10)
            ->get();

        $couponscode = Coupon::where('status', 1)
            ->where('language_id', $language->id)
            ->orderByRaw('CAST(`top_coupons` AS SIGNED) DESC')
            ->whereNotNull('code')
            ->orderBy('created_at','desc')
            ->limit(12)
            ->get();
        $couponsdeal = Coupon::where('status', 1)
            ->where('language_id', $language->id)
            ->orderByRaw('CAST(`top_coupons` AS SIGNED) ASC')
            ->whereNull('code')
            ->orderBy('created_at','desc')
             ->limit(12)
            ->get();
        $blogs = Blog::orderBy('created_at', 'desc')
         ->where('language_id', $language->id)
            ->take(5)
            ->get();

        return view('welcome', compact('stores', 'sliders', 'categories', 'couponscode', 'couponsdeal', 'blogs'));
    }

    public function stores(Request $request , $lang = 'en')
    {
        app()->setLocale($lang);
        // Set the locale based on the provided language code
        $language = language::where('code', $lang)->first();
        if (!$language) {
            abort(404, 'Language not found');
        }
        // Filter stores by language_id
        $stores = Store::where('language_id', $language->id)
                        ->distinct()
                        ->orderBy('created_at','desc')
                        ->paginate(10);

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
        $store = Store::with('language')->where('slug', $title)->first();

        if (!$store) {
            abort(404); // Store not found
        }

        // Check if the store has an associated language
        if (!$store->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }


        if ($lang !== $store->language->code) {
            return redirect()->route('store_details.withLang', [
                'lang' => $store->language->code,
                'slug' => $slug
            ]);
        }

        // Sorting and fetching coupons
        $sort = $request->query('sort', 'all');
        if ($sort === 'codes') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->whereNotNull('code')
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->where('language_id', $store->language_id)
                            ->get();
        } elseif ($sort === 'deals') {
            $coupons = Coupon::where('store_id', $store->id)
                            ->whereNull('code')
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->where('language_id', $store->language_id)
                            ->get();
        } else {
            $coupons = Coupon::where('store_id', $store->id)
                            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                            ->get();
        }

        // Count the number of codes and deals
        $codeCount = Coupon::where('store_id', $store->id)
                            ->whereNotNull('code')
                            ->where('language_id', $store->language_id)
                            ->count();
        $dealCount = Coupon::where('store_id', $store->id)
                            ->whereNull('code')
                            ->where('language_id', $store->language_id)
                            ->count();

        // Fetch related stores based on the same category
        $relatedStores = Store::where('category_id', $store->category_id)
                    ->where('id', '!=', $store->id)
                    ->where('language_id', $store->language_id)
                    ->orderBy('created_at','desc')
                    ->take(12)
                    ->get();

        // Fetch related blogs based on the same store
        $relatedblogs = Blog::where('store_id', $store->id)
            ->where('language_id', $store->language_id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('store_detail', compact('store', 'coupons', 'relatedStores','relatedblogs','codeCount', 'dealCount'));
    }

    public function category($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter categories by language_id
        $categories = Category::where('language_id', $language->id)->paginate(10);

        return view('category', compact('categories'));
    }


     public function category_detail($lang = 'en', $slug, Request $request)
    {
       app()->setLocale($lang);
       $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });
        $slug = Str::slug($slug);
        $title = ucwords(str_replace('-', ' ', $slug));
        $category = Category::with('language')->where('slug', $title)->first();
        if (!$category->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }
        if ($lang !== $category->language->code) {
            return redirect()->route('category.detail.withlang', [ 'lang' => $category->language->code,
                'slug' => $slug
            ]);
        }
        $relatedblogs = Blog::where('category_id', $category->id)
                 ->where('language_id', $language->id)
                 ->where('status',1)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        $stores = Store::where('category_id', $category->id)
        ->where('language_id', $category->language_id)->get();

        return view('category_detail', compact('category','relatedblogs','stores'));
    }

    public function blog($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter blogs by language_id and status
        $blogs = Blog::with('language')
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('blog', compact('blogs'));
    }


        public function blog_detail($lang = 'en', $slug, Request $request)
    {
       app()->setLocale($lang);
       $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });
        $slug = Str::slug($slug);
        $title = ucwords(str_replace('-', ' ', $slug));
        $blog = Blog::with('language')->where('slug', $title)->first();
        if (!$blog->language) {
            return response()->json(['error' => 'No language select for this store.'], 404);
        }
        if ($lang !== $blog->language->code) {
            return redirect()->route('blog-details.withLang', [ 'lang' => $blog->language->code,
                'slug' => $slug
            ]);
        }
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
                ->where('id', '!=', $blog->id)
                ->where('language_id', $language->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        $relatedstores = Store::where('category_id', $blog->category_id)
        ->where('language_id', $blog->language_id)->get();

        return view('blog_detail', compact('blog', 'relatedBlogs','relatedstores'));
    }

    public function coupons ($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter blogs by language_id and status
        $coupons = Coupon::with('language')
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->whereNotNull('code')
            ->where('status', 1)
            ->paginate(10);

            return view('coupon', compact('coupons'));
    }

    public function deal ($lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Filter blogs by language_id and status
        $coupons = Coupon::with('language')
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->whereNull('code')
            ->paginate(10);

            return view('deal', compact('coupons'));
    }

     public function coupon_detail($slug, $lang = 'en')
    {
        app()->setLocale($lang);

        // Fetch the language, or default to English
        $language = language::where('code', $lang)->firstOr(function () {
            abort(404, 'Language not found');
        });

        // Fetch the blog by slug and language_id
        $coupon = Coupon::with('language')
            ->where('slug', $slug)
            ->where('language_id', $language->id)
            ->firstOr(function () {
                abort(404, 'Blog not found');
            });
        $relatedcoupon = Blog::where('store_id', $coupon->store_id)
            ->where('id', '!=', $coupon->id)
            ->where('language_id', $language->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('coupon_detail', compact('blog', 'relatedcoupon'));
    }

}
