<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la PermissionPolicy
        $this->authorize('viewAny', Permission::class);

        $permissions = Permission::all();

        return PermissionResource::collection($permissions)->response()->setStatusCode(200);
    }

    public function show(Permission $permission)
    {
        // Policy: Llama al método 'view' de la PermissionPolicy
        $this->authorize('view', $permission);

        return PermissionResource::make($permission)->response()->setStatusCode(200);
    }

    public function store(PermissionRequest $request)
    {
        // Policy: Llama al método 'create' de la PermissionPolicy
        $this->authorize('create', Permission::class);

        $permission = Permission::create(['name' => $request->name]);

        return PermissionResource::make($permission)->response()->setStatusCode(201);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        // Policy: Llama al método 'update' de la PermissionPolicy
        $this->authorize('update', $permission);

        $permission->update(['name' => $request->name]);

        return PermissionResource::make($permission)->response()->setStatusCode(200);
    }

    public function destroy(Permission $permission)
    {
        // Policy: Llama al método 'delete' de la PermissionPolicy
        $this->authorize('delete', $permission);

        $permission->delete();

        return PermissionResource::make($permission)->response()->setStatusCode(204);
    }
}
