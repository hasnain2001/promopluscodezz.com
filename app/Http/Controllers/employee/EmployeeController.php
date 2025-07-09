<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $users =User::where('id', '!=', Auth::id())->get();
        return view('employee.dashboard', compact('users'));
    }
}
