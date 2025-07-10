<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\language;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function openCoupon($couponId)
    {
        $coupon = Coupon::find($couponId);
        if ($coupon) {
            // Increment click count
            $coupon->clicks++;
            $coupon->save();

            // Assuming you have a route named 'store.detail' that shows the store detail page
            return redirect()->route('store.detail', ['id' => $coupon->store_id]);
        }
        // Handle case where coupon is not found
        return redirect()->back()->with('error', 'Coupon not found.');
    }

    public function updateClicks(Request $request)
    {
        $couponId = $request->input('coupon_id');
        $coupon = Coupon::find($couponId);
        if ($coupon) {
            $coupon->clicks++;
            $coupon->save();
            return redirect()->back()->with('success', 'Coupon Click added');
        }
        return response()->json(['success' => false, 'message' => 'Coupon not found.']);
    }

    public function index(Request $request)
    {
        // Get distinct stores with coupons
        $stores = Coupon::with('store', 'user', 'updatedby')
                    ->select('store_id')
                    ->distinct()
                    ->get()
                    ->pluck('store')
                    ->unique()
                    ->filter();

        $selectedStore = $request->input('store_id');

        if ($request->ajax()) {
            $coupons = Coupon::with('store', 'user', 'updatedby')
                        ->when($selectedStore, function($query) use ($selectedStore) {
                            return $query->where('store_id', $selectedStore);
                        })
                        ->orderBy('store_id')
                        ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                        ->orderBy('created_at', 'desc')
                        ->limit(200)
                        ->get();

            return response()->json([
                'coupons' => $coupons,
                'html' => view('admin.coupon.partials.coupons', compact('coupons'))->render()
            ]);
        }

        // Initial page load - show all coupons or filtered if store is selected
        $coupons = Coupon::with('store', 'user', 'updatedby')
                    ->when($selectedStore, function($query) use ($selectedStore) {
                        return $query->where('store_id', $selectedStore);
                    })
                    ->orderBy('store_id')
                    ->orderByRaw('CAST(`order` AS SIGNED) ASC')
                    ->orderBy('created_at', 'desc')
                    ->limit(200)
                    ->get();

        return view('admin.coupon.index', compact('coupons', 'stores', 'selectedStore'));
    }
    public function updateOrder(Request $request)
    {
        Log::info($request->order); // see what's coming in

        try {
            foreach ($request->order as $order) {
                $coupon = Coupon::find($order['id']);
                if ($coupon) {
                    $coupon->order = $order['position'];
                    $coupon->save();
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Update Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::orderBy('created_at','desc')->get();
        $languages = language::orderBy('created_at','desc')->get();
        return view('admin.coupon.create', compact('stores', 'languages'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string|max:100',
            'ending_date' => 'nullable|date|after_or_equal:today',
            'status' => 'required|boolean',
            'authentication' => 'nullable|string',
            'authentication.*' => 'string',
            'store' => 'nullable|string|max:255',
            'top_coupons' => 'nullable|integer|min:0',
            'store_id' => 'required|exists:stores,id',
            'language_id' => 'required|exists:languages,id',
        ]);

        $coupon = new Coupon();
        $coupon->store_id = $request->store_id;
        $coupon->user_id = Auth::id();
        $coupon->language_id =  $request->language_id ?? 1;
        $coupon->name = $request->name;
        $coupon->description = $request->description;
        $coupon->code = $request->code;
        $coupon->ending_date = $request->ending_date;
        $coupon->status = $request->status;
        $coupon->top_coupons = $request->top_coupons;
        $coupon->authentication = $request->authentication;
        $coupon->save();

        return redirect()->back()->withInput()->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        $stores = Store::orderBy('created_at', 'desc')->get();
        $languages = language::orderBy('created_at', 'desc')->get();

        return view('admin.coupon.edit', compact('coupon', 'stores', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string|max:100',
            'ending_date' => 'required|date|after_or_equal:today',
            'status' => 'required|boolean',
            'authentication' => 'nullable|string',
            'authentication.*' => 'nullable|string',
            'store_id' => 'required|exists:stores,id',
            'top_coupons' => 'nullable|integer|min:0',
            'language_id' => 'required|exists:languages,id',
        ]);

        try {
            // Update coupon fields
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->code = $request->code;
            $coupon->store_id = $request->store_id ?? $coupon->store_id;
            $coupon->ending_date = $request->ending_date;
            $coupon->status = $request->status;
            $coupon->top_coupons = $request->top_coupons;
            $coupon->authentication = $request->authentication;
            $coupon->updated_id = Auth::id();
            $coupon->save();

            // Get the store (either from updated store_id or existing)
            $store = Store::find($coupon->store_id);

            if (!$store) {
                throw new \Exception('Associated store not found');
            }

            $couponName = $validated['name'] ?? 'Coupon';
            return redirect()->route('admin.store.show', ['slug' => Str::slug($store->slug)])
                ->with('success', "$couponName updated successfully");

        } catch (\Exception $e) {
            return redirect()->back()->withInput()
            ->with('error', 'Failed to update coupon: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon )
    {
    $coupon->delete();

    return redirect()->route('admin.coupon.index')->with('success', 'Coupon deleted successfully.');
    }


}
