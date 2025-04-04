<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function Roles(){
        $title = "Role";
        return view('admin.roles', compact('title'));
    }
    public function AddRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors() 
            ], 422);
        }
        
        $role = Role::create([
            'name' => $request->name,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Service added successfully!',
            'data' => $role,
        ], 201);
    }

    public function getRoles()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->orderBy('id', 'desc')->get();
        return response()->json($roles);
    }


    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors() 
            ], 422);
        }

        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Role not found!'], 404);
        }
        
        $role->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'role updated successfully!', 
        ], 201);
    }



    public function updateRoleStatus(Request $request)
    {
        $role = Role::find($request->id);
        if ($role) {
            $role->status = $request->status;
            $role->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found']);
        }
        $role->delete();
        return response()->json(['success' => true, 'message' => 'Role deleted successfully']);
    }  
}
