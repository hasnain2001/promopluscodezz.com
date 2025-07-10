<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\language;
use App\Models\Store;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('language','updatedby')->orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at', 'desc')->get();
        return view('admin.blog.create', compact('categories', 'languages', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
            'language_id' => 'nullable|exists:languages,id',
            'store_id' => 'nullable|exists:stores,id',


        ]);
       if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storeNameSlug = Str::slug($request->name);
            $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
        } else {
            $imageName = null;
        }
        $blog = new Blog();
        $blog->user_id =Auth::id();
        $blog->language_id = $request->input('language_id', 1);
        $blog->store_id = $request->input('store_id', 1);
        $blog->name = $request->input('name');
        $blog->slug = $request->input('slug');
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keyword = $request->input('meta_keyword');
        $blog->status = $request->input('status', 0);
        $blog->image = $imageName;
        $blog->category_id = $request->input('category_id');
        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
  public function show($name)
    {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $blog = Blog::where('slug', $title)->first();

        if (!$blog) {
            return redirect('404');
        }

        // Get store$store where store_id matches the store's ID
        $store = Store::with('user')
                    ->where('category_id', $blog->category_id)  // Changed from $title to $store->id
                    ->get();

        return view('admin.blog.show', compact('blog', 'store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
         $categories = Category::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at', 'desc')->get();
        return view('admin.blog.edit', compact('blog', 'categories', 'languages', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',

        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storeNameSlug = Str::slug($request->name);
            $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
        } else {
            $imageName = $blog->image;
        }
        $blog->updated_id =Auth::id();
        $blog->language_id = $request->language_id ?? $blog->language_id;
        $blog->store_id = $request->store_id ?? $blog->store_id;
        $blog->name = $request->input('name');
        $blog->slug = $request->input('slug');
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->content = $request->content ?? $blog->content;
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keyword = $request->input('meta_keyword');
        $blog->status = $request->input('status', 0);
        $blog->image = $imageName;
        $blog->category_id = $request->input('category_id');
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete the image file if it exists
        if ($blog->image) {
            $oldImagePath = public_path('uploads/blogs/' . $blog->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully.');
    }
}
