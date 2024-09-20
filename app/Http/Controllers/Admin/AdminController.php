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
        // $staffDetails = Staff::all();
        $staffDetails = Staff::orderBy('created_at', 'desc')->get();
        return view('admin.staff-management.staff-list',compact('role', 'staffDetails'));
    }
    public function addNewStaff(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('staff_images', 'public');
        }
    
        $salary = preg_replace('/[^\d.]/', '', $request->salary);
        
    
        $staff = Staff::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'username' => $request->firstName,  
            'salary' => $salary,
            'start_date' => $request->startDate,
            'address' => $request->address,
            'password' => Hash::make('staff@123'),
            'image_url' => $imagePath,
        ]);
        return redirect()->route('admin.view-staff-list')->with('success', 'Staff added successfully');
    }

    public function getStaffDataForEdit(Request $request)
    {
       $staffId = $request->input('id');
       $staffData = Staff ::where('id', $staffId)->first();
       $role = UserPermission::all();
       $html = view('admin.staff-management.staff-edit-modal', [ 'data' => $staffData, 'role'=>$role])->render();

        return response()->json($html);

    }

    public function updateStaffData(Request $request)
    {
       
        $staff = Staff::findOrFail($request->staffId);
        $salary = preg_replace('/[^\d.]/', '', $request->salary);
        $staff->first_name = $request->firstName;
        $staff->last_name = $request->lastName;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->role = $request->role;
        $staff->salary = $salary;
        $staff->status = $request->status;
        $staff->start_date = $request->startDate;
        $staff->address = $request->address;
        $staff->save();
        return redirect()->route('admin.view-staff-list')->with('success', 'Staff member updated successfully!');
    }
    public function viewRoleList()
    {
        return view('admin.staff-management.role-and-permission');
    }
}
