<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\language;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Exports\SlidersExport;
use App\Models\Store;
use Maatwebsite\Excel\Facades\Excel;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Slider::with('language')
            ->orderBy('sort_order', 'asc');

        // Status filter
        if ($request->has('status')) {
            $status = $request->status === 'active' ? 1 : 0;
            $query->where('status', $status);
        }

        // Language filter
        if ($request->has('language')) {
            $query->whereHas('language', function($q) use ($request) {
                $q->where('code', $request->language);
            });
        }

        // Get all languages for filter dropdown
        $languages = Language::all();

        // Paginate results (15 items per page by default)
        $sliders = $query->paginate($request->per_page ?? 15)
            ->appends($request->query());

        return view('admin.slider.index', compact('sliders', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = language::orderBy('created_at','desc')->get();
        $stores = Store::orderBy('created_at','desc')->get();
        return view('admin.slider.create',compact('languages','stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:2255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
            'sort_order' => 'required|integer',
            'button_text' => 'nullable|string|max:50',
            'store_id' => 'required|exists:stores,id',
             'language_id' => 'required|exists:languages,id',
        ]);
 if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storeNameSlug = Str::slug($request->title);
            $imageName = $storeNameSlug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $imageName);
        } else {
            $imageName = null;
        }
        $request->merge(['image' => $imageName]);

        $slider = new Slider();
        $slider->language_id = $request->language_id;
        $slider->store_id = $request->store_id;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->link = $request->link;
        $slider->status = $request->status;
        $slider->sort_order = $request->sort_order;
        $slider->button_text = $request->button_text;
        $slider->image = $imageName;
        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Slider $slider)
    // {
    //     return view('admin.slider.show', compact('slider'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        $languages = language::orderBy('created_at', 'desc')->get();
        $stores = Store::orderBy('created_at','desc')->get();
        return view('admin.slider.edit', compact('slider', 'languages','stores'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
            'sort_order' => 'required|integer',
            'button_text' => 'nullable|string|max:50',
            'store_id' => 'required|exists:stores,id',
            'language_id' => 'required|exists:languages,id',
        ]);

        // Update the slider attributes
        $slider->language_id = $request->language_id ?? $slider->language_id;
        $slider->store_id = $request->store_id ?? $slider->store_id;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->link = $request->link;
        $slider->status = $request->status;
        $slider->sort_order = $request->sort_order;
        $slider->button_text = $request->button_text;

        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($slider->image) {
                $oldImagePath = public_path('uploads/slider/' . $slider->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store the new image
            $image = $request->file('image');
            $storeNameSlug = Str::slug($request->name);
            $imageName = time() . '_' . $storeNameSlug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $imageName);
            $slider->image = $imageName;
        }

        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // Delete the image file if it exists
        if ($slider->image) {
            $oldImagePath = public_path('uploads/slider/' . $slider->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider deleted successfully.');
    }


    public function export(Request $request)
    {
        $query = Slider::query();

        // Apply filters same as index method
        if ($request->has('status')) {
            $status = $request->status === 'active' ? 1 : 0;
            $query->where('status', $status);
        }

        if ($request->has('language')) {
            $query->whereHas('language', function($q) use ($request) {
                $q->where('code', $request->language);
            });
        }

        $sliders = $query->get();

        $fileName = 'sliders-'.now()->format('Y-m-d').'.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID',
            'Title',
            'Image',
            'Status',
            'Link',
            'Sort Order',
            'Language',
            'Created At'
        ];

        $callback = function() use($sliders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sliders as $slider) {
                fputcsv($file, [
                    $slider->id,
                    $slider->title,
                    $slider->image ? asset('uploads/slider/'.$slider->image) : 'No Image',
                    $slider->status ? 'Active' : 'Inactive',
                    $slider->link,
                    $slider->sort_order,
                    $slider->language->name ?? 'N/A',
                    $slider->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
