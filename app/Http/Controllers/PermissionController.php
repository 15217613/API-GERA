<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return PermissionResource::collection($permissions)->response()->setStatusCode(200);
    }

    public function show(Permission $permission)
    {
        return PermissionResource::make($permission)->response()->setStatusCode(200);
    }

    public function store(PermissionRequest $request)
    {
        $permission = Permission::create(['name' => $request->name]);

        return PermissionResource::make($permission)->response()->setStatusCode(201);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);

        return PermissionResource::make($permission)->response()->setStatusCode(200);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return PermissionResource::make($permission)->response()->setStatusCode(204);
    }
}
