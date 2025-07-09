<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return response()->json([
            'success' => true,
            'data' => $languages
        ]);
    }
    public function creat()
    {
        return view('language.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:languages',
            'code' => 'required|string|unique:languages|max:10',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'direction' => 'nullable|string|in:ltr,rtl',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

             $flagPath = null;
            if ($request->hasFile('flag')) {
                $file = $request->file('flag');
                $filename = preg_replace('/\s+/', '_', strtolower($request->name)) . '.' . $file->getClientOriginalExtension();
                $flagPath = $file->storeAs('uploads/flags', $filename, 'public');
            }

        $language = Language::create([
            'name' => $request->name,
            'code' => $request->code,
            'flag' => $flagPath,
            'direction' => $request->direction ?? 'ltr',
            'status' => $request->status ?? true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Language created successfully',
            'data' => $language
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Language $language) // Fixed parameter name
    {
        return response()->json([
            'success' => true,
            'data' => $language
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:languages,name,' . $language->id,
            'code' => 'required|string|unique:languages,code,' . $language->id . '|max:10',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'direction' => 'nullable|string|in:ltr,rtl',
            'status' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('flag')) {
            if ($language->flag && Storage::disk('public')->exists($language->flag)) {
            Storage::disk('public')->delete($language->flag);
            }
            $language->flag = $request->file('flag')->store('uploads/flags', 'public');
        } else {
            // Keep previous flag value if no new image uploaded
            $language->flag = $language->flag;
        }


        $language->name = $request->name;
        $language->code = $request->code;
        $language->direction = $request->direction ?? 'ltr';
        $language->status = $request->status ?? true;
        $language->save();

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully',
            'data' => $language
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        if ($language->flag && Storage::disk('public')->exists($language->flag)) {
            Storage::disk('public')->delete($language->flag);
        }
        $language->delete();

        return response()->json(['success' => true, 'message' => 'Language deleted']);
    }

}
