<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function index()
    {
        // Policy: Llama al método 'viewAny' de la PermissionPolicy
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();

        return RoleResource::collection($roles)->response()->setStatusCode(200);
    }

    public function show(Role $role)
    {
        // Policy: Llama al método 'view' de la PermissionPolicy
        $this->authorize('view', $role);

        return RoleResource::make($role)->response()->setStatusCode(200);
    }

    public function store(RoleRequest $request)
    {
        // Policy: Llama al método 'create' de la PermissionPolicy
        $this->authorize('create', Role::class);

        // Obtenemos los permisos
        $permissions = $request->permissions ?? [];

        $role = Role::create(['name' => $request->name]);

        // Asignamos los permisos al rol
        $role->givePermissionTo($permissions);

        return RoleResource::make($role)->response()->setStatusCode(201);
    }

    public function update(RoleRequest $request, Role $role)
    {
        // Policy: Llama al método 'update' de la PermissionPolicy
        $this->authorize('update', $role);

        // Obtenemos los permisos
        $permissions = $request->permissions ?? [];

        $role->update(['name' => $request->name]);

        // Sincronizamos los permisos
        $role->syncPermissions($permissions);

        return RoleResource::make($role)->response()->setStatusCode(200);
    }

    public function destroy(Role $role)
    {
        // Policy: Llama al método 'delete' de la PermissionPolicy
        $this->authorize('delete', $role);

        $role->delete();

        return RoleResource::make($role)->response()->setStatusCode(204);
    }
}
