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

            'create-condicion-base',
            'view-condicion-base',
            'update-condicion-base',
            'delete-condicion-base',

            'create-condicion-detallada',
            'view-condicion-detallada',
            'update-condicion-detallada',
            'delete-condicion-detallada',

            'create-sismico-no-estructural',
            'view-sismico-no-estructural',
            'update-sismico-no-estructural',
            'delete-sismico-no-estructural',

            'create-grado-danio',
            'view-grado-danio',
            'update-grado-danio',
            'delete-grado-danio',

            'create-irregularidad-horizontal',
            'view-irregularidad-horizontal',
            'update-irregularidad-horizontal',
            'delete-irregularidad-horizontal',

            'create-irregularidad-vertical',
            'view-irregularidad-vertical',
            'update-irregularidad-vertical',
            'delete-irregularidad-vertical',

            'create-modificador',
            'view-modificador',
            'update-modificador',
            'delete-modificador',

            'create-ocupacion',
            'view-ocupacion',
            'update-ocupacion',
            'delete-ocupacion',

            'create-otro-riesgo',
            'view-otro-riesgo',
            'update-otro-riesgo',
            'delete-otro-riesgo',

            'create-porcentaje-danio',
            'view-porcentaje-danio',
            'update-porcentaje-danio',
            'delete-porcentaje-danio',

            'create-senializacion',
            'view-senializacion',
            'update-senializacion',
            'delete-senializacion',

            'create-sistema-construccion',
            'view-sistema-construccion',
            'update-sistema-construccion',
            'delete-sistema-construccion',

            'create-tipo-construccion',
            'view-tipo-construccion',
            'update-tipo-construccion',
            'delete-tipo-construccion',
        ];

        // Crear permisos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
