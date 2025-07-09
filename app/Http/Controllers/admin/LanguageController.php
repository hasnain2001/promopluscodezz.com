<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = language::all();
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:languages,code',
            'status' => 'required|boolean',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $language = new language();
        $language->name = $request->name;
        $language->code = $request->code;
        $language->status = $request->status ? 1 : 0; // Assuming status is a boolean

        if ($request->hasFile('flag')) {
            $flag = $request->file('flag');
            $storeNameSlug = Str::slug($request->name);
            $flagName = $storeNameSlug . '.' . $flag->getClientOriginalExtension();
            $flag->move(public_path('uploads/flags'), $flagName);
        } else {
            $flagName = null;
        }

        $language->flag = $flagName;
        $language->save();

        return redirect()->route('admin.language.index')->with('success', 'language created succesfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(language $language)
    // {
    //     return view('admin.language.show', compact('language'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, language $language)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:languages,code,' . $language->id,
            'status' => 'required|boolean',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $language->name = $request->name;
        $language->code = $request->code;
        $language->status = $request->status ? 1 : 0; // Assuming status is a boolean
         if ($request->hasFile('flag')) {
            // Delete the old flag if it exists
            if ($language->flag) {
                $oldFlagPath = public_path('uploads/flags/' . $language->flag);
                if (file_exists($oldFlagPath)) {
                    unlink($oldFlagPath);
                }
            }
            $flag = $request->file('flag');
            $storeNameSlug = Str::slug($request->name);
            $imageName = $storeNameSlug . '.' . $flag->getClientOriginalExtension();
            $flag->move(public_path('uploads/flags'), $imageName);
        } else {
            $imageName = $language->flag;
        }

        $language->flag = $imageName;

        $language->save();

        return redirect()->route('admin.language.index')->with('success', 'language updaed successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(language $language)
    {
        // Delete the flag image if it exists
        if ($language->flag) {
            $oldFlagPath = public_path('uploads/flags/' . $language->flag);
            if (file_exists($oldFlagPath)) {
                unlink($oldFlagPath);
            }
        }
        $language->delete();
        return redirect()->route('admin.language.index')->with('success', 'Language deleted successfully.');
    }
}
