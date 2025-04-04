<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function Permission(){
        $title = "Permission";
        return view('admin.permission', compact('title'));
    }

    public function AddPermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors() 
            ], 422);
        }
        
        $permission = Permission::create([
            'name' => $request->name,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Permission added successfully!',
            'data' => $permission,
        ], 201);
    }

    public function getPermissions()
    {
        $permissions = Permission::whereNotIn('name', ['Super Admin'])->orderBy('id', 'desc')->get();
        return response()->json($permissions);
    }


    public function updatePermission(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, 
                'errors' => $validator->errors() 
            ], 422);
        }

        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['error' => 'permission not found!'], 404);
        }
        
        $permission->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Permission updated successfully!', 
        ], 201);
    }



    public function updatePermissionStatus(Request $request)
    {
        $permission = Permission::find($request->id);
        if ($permission) {
            $permission->status = $request->status;
            $permission->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['success' => false, 'message' => 'Permission not found']);
        }
        $permission->delete();
        return response()->json(['success' => true, 'message' => 'Permission deleted successfully']);
    }
}
