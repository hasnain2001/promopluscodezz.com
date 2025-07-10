<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DeleteRequest;
use Illuminate\Http\Request;

class DeleteRequestController extends Controller
{
    public function index()
    {
        $requests = DeleteRequest::with('store', 'employee')->where('status', 'pending')->get();
        // dd($requests);
        return view('admin.delete_requests.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = DeleteRequest::findOrFail($id);
        $store = $request->store;

        // Delete image
        if ($store->image && file_exists(public_path('uploads/stores/'.$store->image))) {
            unlink(public_path('uploads/stores/'.$store->image));
        }

        $store->coupons()->delete();
        $store->delete();

        $request->status = 'approved';
        $request->save();

        return back()->with('success', 'Store deleted as requested.');
    }

    public function reject($id)
    {
        $request = DeleteRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return back()->with('info', 'Delete request rejected.');
    }

}
