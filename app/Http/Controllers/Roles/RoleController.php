<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function viewRoleList()
    {
        return view('admin.access-control.add-role');
    }

    public function storeRole(Request $request)
    {
        $role = new Role();
        $role->role_name = $request->input('roleName');
        $role->save();

        return response()->json(['success' => true, 'message' => 'Role added successfully.']);
    }
    public function updateRole(Request $request)
    {
        $update = Role::where('id', $request->input('roleId'))->update(['role_name' => $request->input('roleName')]);
        return response()->json(['success' => true, 'message' => 'Role details updated.']);
    }
}
