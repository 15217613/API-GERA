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
            'create permissions',
            'read permissions',
            'update permissions',
            'delete permissions',
            'create roles',
            'read roles',
            'update roles',
            'delete roles',
            'create users',
            'read users',
            'update users',
            'delete users',
        ];

        // Crear permisos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
