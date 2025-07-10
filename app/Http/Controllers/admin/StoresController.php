<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\language;
use App\Models\Network;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(  )
    {

        $stores = Store::select('id','slug','name','category_id','user_id','network_id','image','created_at','status', 'updated_id','updated_at','language_id')->with('user','updatedby','language','network')
        ->orderBy('created_at','desc')
        ->get();
          return view('admin.stores.index', compact('stores', ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        return view('admin.stores.create', compact('categories', 'networks', 'languages'));
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
            'url' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'description' => 'required|string',
            'language_id' => 'required|exists:languages,id',
            'category_id' => 'required|exists:categories,id',
            'network_id' => 'nullable|exists:networks,id',
            'top_store' => 'nullable|boolean',
            'destination_url' => 'nullable|url',
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

        $store = new Store();
        $store->name = $request->name;
        $store->category_id = $request->category_id;
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
        $store->description = $request->description;
        $store->url = $request->url;
        $store->user_id = Auth::id();
        $store->language_id = $request->language_id;
        $store->save();

        return redirect()->route('admin.store.show', ['slug' => Str::slug($store->slug)])->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $store = Store::where('slug', $title)->first();

        if (!$store) {
            return redirect('404');
        }

        // Get coupons where store_id matches the store's ID
        $coupons = Coupon::with('user')
                    ->where('store_id', $store->id)  // Changed from $title to $store->id
                    ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                    ->get();

        return view('admin.stores.show', compact('store', 'coupons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $stores)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $networks = Network::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        return view('admin.stores.edit', compact('stores', 'categories', 'networks', 'languages'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $stores)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:stores,slug,' . $stores->id,
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'about' => 'nullable|string',
            'description' => 'nullable|string',
            'language_id' => 'required|exists:languages,id',
            'category_id' => 'required|exists:categories,id',
            'network_id' => 'required|exists:categories,id',
            'top_store' => 'nullable|boolean',
            'destination_url' => 'nullable|url',
            'url' => 'required|url',
        ]);
        // Check if the image is uploaded
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
        $stores->category_id = $request->category_id;
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
        $stores->language_id = $request->language_id;
        $stores->save();

        return redirect()->route('admin.store.show', ['slug' => Str::slug($stores->slug)])->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stores = Store::findOrFail($id);
        // Delete the image if it exists
        if ($stores->image && file_exists(public_path('uploads/stores/' . $stores->image))) {
            unlink(public_path('uploads/stores/' . $stores->image));
        }
        // Delete the store
        $stores->delete();
        return redirect()->route('admin.store.index')->with('success', 'Store deleted successfully.');
    }

    /**
     * Remove the selected resources from storage.
     */
     public function deleteSelected(Request $request)
        {
            $ids = $request->input('ids');
            if ($ids) {
                foreach ($ids as $id) {
                    $store = Store::findOrFail($id);
                    // Delete the image if it exists
                    if ($store->image && file_exists(public_path('uploads/stores/'.$store->image))) {
                        unlink(public_path('uploads/stores/'.$store->image));
                    }
                    // Delete related coupons
                    $store->coupons()->delete();
                    // Delete the store
                    $store->delete();
                }
                return redirect()->route('admin.store.index')->with('success', 'Selected stores deleted successfully.');
            } else {
                return redirect()->route('admin.store.index')->with('error', 'No stores selected for deletion.');
            }
        }

}
