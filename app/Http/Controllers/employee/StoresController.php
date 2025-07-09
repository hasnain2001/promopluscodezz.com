<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Language;
use App\Models\DeleteRequest;
use App\Models\Network;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
   use Illuminate\Auth\Access\AuthorizationException;

class StoresController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(  )
    {

        $stores = Stores::with('language','network')->select('id','slug','name','category_id','image','created_at','status','network_id','language_id')
        ->orderBy('created_at','desc')
        ->get();
          return view('employee.stores.index', compact('stores', ));
    }
       public function Store_detail($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $store = Stores::where('slug', $title)->first();

        if (!$store) {
            return redirect('404');
        }

        // Get coupons where store_id matches the store's ID
        $coupons = Coupon::with('user')
                    ->where('store_id', $store->id)  // Changed from $title to $store->id
                    ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                    ->get();

        return view('employee.stores.detail', compact('store', 'coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = Language::orderBy('created_at', 'desc')->get();
        return view('employee.stores.create', compact('categories', 'networks', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:stores,slug',
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'language_id' => 'required|integer',
            'category_id' => 'required|integer',
             'network_id' => 'required|integer',
            'destination_url' => 'required|url',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'url' => 'required|url',
        ]);
        if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $storeNameSlug = Str::slug($request->name);
                    $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/stores'), $imageName);
                } else {
                    $imageName = null;
                }
        $request->merge(['image' => $imageName]);

        $store = new Stores();
        $store->language_id = $request->language_id;
        $store->user_id = Auth::id();
        $store->category_id = $request->category_id;
        $store->name = $request->name;
        $store->network_id = $request->network_id;
        $store->top_store = $request->top_store;
        $store->destination_url = $request->destination_url;
        $store->slug = $request->slug;
        $store->status = $request->status;
        $store->image = $imageName;
        $store->title = $request->title;
        $store->meta_keyword = $request->meta_keyword;
        $store->meta_description = $request->meta_description;
        $store->content = $request->content;
        $store->about = $request->about;
        $store->url = $request->url;
        $store->save();

        return redirect()->route('employee.store.show',['slug' => Str::slug($store->slug)],)->withInput()->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $store = Stores::where('slug', $title)->first();

        if (!$store) {
            return redirect('404');
        }

        // Get coupons where store_id matches the store's ID
        $coupons = Coupon::with('user')
                    ->where('store_id', $store->id)  // Changed from $title to $store->id
                    ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                    ->get();

        return view('employee.stores.show', compact('store', 'coupons'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stores $stores)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = Language::orderBy('created_at', 'desc')->get();
        return view('employee.stores.edit', compact('stores', 'categories', 'networks', 'languages'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stores $stores)
    {
        $request->validate([
           'name' => 'required|string|max:255',
           'slug' => 'required|string|max:255|unique:stores,slug,' . $stores->id,
           'status' => 'required|boolean',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
           'meta_description' => 'required|string|max:255',
           'title' => 'nullable|string|max:255',
           'meta_keyword' => 'nullable|string|max:255',
           'meta_description' => 'nullable|string|max:255',
           'language_id' => 'required|integer',
           'category_id' => 'required|integer',
           'network_id' => 'required|integer',
           'destination_url' => 'required|url',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'url' => 'nullable|url',
        ]);
        // Check if the image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($stores->image) {
            $oldImagePath = public_path('uploads/stores/' . $stores->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            }
            $image = $request->file('image');
            $storeNameSlug = Str::slug($request->name);
            $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/stores'), $imageName);
        } else {
            $imageName = $stores->image;
        }
        $request->merge(['image' => $imageName]);

        $stores->name = $request->name;
        $stores->description = $request->description;
        $stores->about = $request->about;
        $stores->network_id = $request->network_id;
        $stores->top_store = $request->top_store;
        $stores->url = $request->url;
        $stores->destination_url = $request->destination_url;
        $stores->slug = $request->slug;
        $stores->status = $request->status;
        $stores->image = $imageName;
        $stores->title = $request->title;
        $stores->meta_keyword = $request->meta_keyword;
        $stores->meta_description = $request->meta_description;
        $stores->content = $request->content;
        $stores->updated_id = Auth::id();
        $stores->category_id = $request->category_id;
        $stores->language_id = $request->language_id ?? $stores->language_id;
        $stores->save();

        return redirect()->route('employee.store.index')->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy($id)
        {
            $store = Stores::findOrFail($id);

            // Example: If you want to always create a delete request, remove the if statement
            // Create a delete request
            DeleteRequest::create([
                'store_id' => $store->id,
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Delete request sent to admin for approval.');

     $this->authorize('delete', $store);

            // Delete the image if it exists
            if ($store->image && file_exists(public_path('uploads/stores/'.$store->image))) {
                unlink(public_path('uploads/stores/'.$store->image));
            }

            // Delete related coupons
            $store->coupons()->delete();

            // Delete the store
            $store->delete();

            return redirect()->route('employee.store.index')->with('success', 'Store deleted successfully.');
        }

        public function deleteSelected(Request $request)
        {
            $ids = $request->input('ids');
            if ($ids) {
                foreach ($ids as $id) {
                    $store = Stores::findOrFail($id);
                    // Delete the image if it exists
                    if ($store->image && file_exists(public_path('uploads/stores/'.$store->image))) {
                        unlink(public_path('uploads/stores/'.$store->image));
                    }
                    // Delete related coupons
                    $store->coupons()->delete();
                    // Delete the store
                    $store->delete();
                }
                return redirect()->route('employee.store.index')->with('success', 'Selected stores deleted successfully.');
            } else {
                return redirect()->route('employee.store.index')->with('error', 'No stores selected for deletion.');
            }
        }



}
