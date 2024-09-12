<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', compact('admin'));
    }
    public function viewStaffList()
    {
        $role = UserPermission::all();
        return view('admin.staff-management.staff-list',compact('role'));
    }
    public function addNewStaff(Request $request)
    {
        dd($request->all());
        $staff = Staff::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'role' => $request->role,
            'username' => $request->firstName,  
            'salary' => $request->salary,
            'start_date' => $request->startDate,
            'address' => $request->address,
            'password' => Hash::make('staff@123'),
        ]);
    }
}
