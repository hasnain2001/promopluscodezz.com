<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch stores matching the query for autocomplete
        $stores = Stores::where('slug', 'like', "$query%")->pluck('slug');

        // Check if there is a single store matching the query exactly
        $store = Stores::where('slug', $query)->first();

        if ($store) {
                       $formattedSlug = str_replace(' ', '-', $store->slug);

            
            return redirect()->route('admin.store.show', ['slug' => $formattedSlug ]);
        }

        // If no exact match, return JSON response for autocomplete if the request is AJAX
        if ($request->ajax()) {
            return response()->json(['stores' => $stores]);
        }

        // Otherwise, redirect to the search results page with the query
        return redirect()->route('admin.search_results', ['query' => $query]);
    }
    public function searchResults(Request $request) {
        $query = $request->input('query');

        // Fetch stores matching the query for autocomplete
        $stores = Stores::where('name', 'like', "$query%")->paginate(20);
        $stores->appends(['query' => $query]);
        // Check if there is a single store matching the query exactly
        $store = Stores::where('name', $query)->first();

        if ($store) {
            // If a single store is found, redirect to its details page
            return redirect()->route('admin.store.show', ['slug' => Str::slug($store->slug)]);
        }

        return view('admin.stores.search_results', ['stores' => $stores]);
    }
    public function searchStoresCoupons(Request $request)
    {
        $query = $request->input('query');
        $stores = Stores::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($stores);
    }
}
