<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController
{
    public function index()
    {
        return response()->json(Role::all());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles']);
        $role = Role::create(['name' => $request->name]);
        return response()->json($role, 201);
    }

    public function assignPermission(Request $request, Role $role)
    {
        $permission = Permission::findByName($request->permission);
        $role->givePermissionTo($permission);
        return response()->json(['message' => 'Permission assigned!']);
    }
}
