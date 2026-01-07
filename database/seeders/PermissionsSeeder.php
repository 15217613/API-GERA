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

            'create-tipo-suelo',
            'view-tipo-suelo',
            'update-tipo-suelo',
            'delete-tipo-suelo',

            'create-direccion',
            'view-direccion',
            'update-direccion',
            'delete-direccion',

            'create-edificacion',
            'view-edificacion',
            'update-edificacion',
            'delete-edificacion',

            'create-evaluacion-presismica',
            'view-evaluacion-presismica',
            'update-evaluacion-presismica',
            'delete-evaluacion-presismica',

            'create-evaluacion-postsismica',
            'view-evaluacion-postsismica',
            'update-evaluacion-postsismica',
            'delete-evaluacion-postsismica',

            'create-e-postsismica-detallada',
            'view-e-postsismica-detallada',
            'update-e-postsismica-detallada',
            'delete-e-postsismica-detallada',

            'create-e-presismica-detallada',
            'view-e-presismica-detallada',
            'update-e-presismica-detallada',
            'delete-e-presismica-detallada',

            'create-riesgo-no-estructural',
            'view-riesgo-no-estructural',
            'update-riesgo-no-estructural',
            'delete-riesgo-no-estructural',

            'create-c-observada-base',
            'view-c-observada-base',
            'update-c-observada-base',
            'delete-c-observada-base',

            'create-c-observada-det',
            'view-c-observada-det',
            'update-c-observada-det',
            'delete-c-observada-det',

            'create-evaluacion-presismica-c-no-estructural',
            'view-evaluacion-presismica-c-no-estructural',
            'update-evaluacion-presismica-c-no-estructural',
            'delete-evaluacion-presismica-c-no-estructural',

            'create-evaluacion-presismica-detallada-modificador',
            'view-evaluacion-presismica-detallada-modificador',
            'update-evaluacion-presismica-detallada-modificador',
            'delete-evaluacion-presismica-detallada-modificador',

            'create-evaluacion-presismica-accion-requerida',
            'view-evaluacion-presismica-accion-requerida',
            'update-evaluacion-presismica-accion-requerida',
            'delete-evaluacion-presismica-accion-requerida',

            'create-evaluacion-presismica-evaluacion-detallada',
            'view-evaluacion-presismica-evaluacion-detallada',
            'update-evaluacion-presismica-evaluacion-detallada',
            'delete-evaluacion-presismica-evaluacion-detallada',

            'create-evaluacion-presismica-irregularidad-horizontal',
            'view-evaluacion-presismica-irregularidad-horizontal',
            'update-evaluacion-presismica-irregularidad-horizontal',
            'delete-evaluacion-presismica-irregularidad-horizontal',    

            'create-evaluacion-presismica-irregularidad-vertical',
            'view-evaluacion-presismica-irregularidad-vertical',
            'update-evaluacion-presismica-irregularidad-vertical',
            'delete-evaluacion-presismica-irregularidad-vertical',

            'create-evaluacion-presismica-otro-riesgo',
            'view-evaluacion-presismica-otro-riesgo',
            'update-evaluacion-presismica-otro-riesgo',
            'delete-evaluacion-presismica-otro-riesgo',
    ];

        // Crear permisos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
