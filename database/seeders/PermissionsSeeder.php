<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-permissions',
            'view-permissions',
            'update-permissions',
            'delete-permissions',
            'create-roles',
            'view-roles',
            'update-roles',
            'delete-roles',
            'create-users',
            'view-users',
            'update-users',
            'delete-users',
            'create-accion-requerida',
            'view-accion-requerida',
            'update-accion-requerida',
            'delete-accion-requerida',
            'create-condicion-no-estructural',
            'view-condicion-no-estructural',
            'update-condicion-no-estructural',
            'delete-condicion-no-estructural',
        ];

        // Crear permisos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
