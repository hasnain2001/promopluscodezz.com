<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\CheckInOut;
use App\Models\Coupon;
use App\Models\language;
use App\Models\Network;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $coupons = Coupon::count();
        $categories =Category::count();
        $networks =Network::count();
        $users = User::count();
        $user =User::where('id', '!=', Auth::id())->get();
        $stores =Store::count();
        $languge = language ::count();
        $blogs = Blog::count();
        return view('admin.dashboard',compact('stores','coupons','categories','networks','users','user','languge','blogs'));
    }
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));

    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,user,employee',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,user,employee',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->role = $request->role ?? $user->role;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }





    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $selectedMonth = $request->input('month');

        $query = CheckInOut::where('user_id', $user->id)->orderBy('check_in_at', 'desc');

        if ($selectedMonth) {
            $monthCarbon = Carbon::parse($selectedMonth);
            $checkins = $query->whereMonth('check_in_at', $monthCarbon->month)
                              ->whereYear('check_in_at', $monthCarbon->year)
                              ->get();
        } else {
            $checkins = $query->get()->groupBy(function ($item) {
                return Carbon::parse($item->check_in_at)
                    ->timezone('Asia/Karachi')
                    ->format('F Y'); // Group label e.g., "May 2025"
            });
        }

        return view('admin.user.show', compact('user', 'checkins', 'selectedMonth'));
    }




    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();

        return view('admin.user.index', compact('users'));
    }
    public function filter(Request $request)
    {
        $role = $request->input('role');
        $users = User::where('role', $role)->get();

        return view('admin.user.index', compact('users'));
    }





}
