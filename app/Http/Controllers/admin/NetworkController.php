<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $networks = Network::with('user','updatedby')->get();
        return view('admin.network.index', compact('networks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.network.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

        ]);


        $network = new Network();
        $network->title = $request->title;
        $network->user_id = Auth::id();
        $network->save();

        return redirect()->route('admin.network.index')->with('success', 'Network created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Network $network)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Network $network)
    {
        return view('admin.network.edit', compact('network'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Network $network)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $network->title = $request->title;
        $network->updated_id = Auth::id();
        $network->save();

        return redirect()->route('admin.network.index')->with('success', 'Network updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Network $network)
    {
        $network->delete();

        return redirect()->route('admin.network.index')->with('success', 'Network deleted successfully.');
    }
}
