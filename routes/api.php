<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\OcupacionController;
use App\Http\Controllers\TipoSueloController;
use App\Http\Controllers\OtroRiesgoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\GradoDanioController;
use App\Http\Controllers\ModificadorController;
use App\Http\Controllers\EdificacionController;
use App\Http\Controllers\SenializacionController;
use App\Http\Controllers\CondicionBaseController;
use App\Http\Controllers\SNoEstructuralController;
use App\Http\Controllers\AccionRequeridaController;
use App\Http\Controllers\PorcentajeDanioController;
use App\Http\Controllers\TipoConstruccionController;
use App\Http\Controllers\CondicionDetalladaController;
use App\Http\Controllers\SistemaConstruccionController;
use App\Http\Controllers\EPresismicaDetalladaController;
use App\Http\Controllers\EvaluacionPresismicaController;
use App\Http\Controllers\EPostsismicaDetalladaController;
use App\Http\Controllers\EvaluacionPostsismicaController;
use App\Http\Controllers\IrregularidadVerticalController;
use App\Http\Controllers\CondicionNoEstructuralController;
use App\Http\Controllers\IrregularidadHorizontalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::apiResource('accion-requerida', AccionRequeridaController::class);
    Route::apiResource('condicion-no-estructural', CondicionNoEstructuralController::class);
    Route::apiResource('condicion-base', CondicionBaseController::class);
    Route::apiResource('condicion-detallada', CondicionDetalladaController::class);
    Route::apiResource('s-no-estructural', SNoEstructuralController::class);
    Route::apiResource('grado-danio', GradoDanioController::class);
    Route::apiResource('irregularidad-horizontal', IrregularidadHorizontalController::class);
    Route::apiResource('irregularidad-vertical', IrregularidadVerticalController::class);
    Route::apiResource('modificador', ModificadorController::class);
    Route::apiResource('ocupacion', OcupacionController::class);
    Route::apiResource('otro-riesgo', OtroRiesgoController::class);
    Route::apiResource('porcentaje-danio', PorcentajeDanioController::class);
    Route::apiResource('senializacion', SenializacionController::class);
    Route::apiResource('sistema-construccion', SistemaConstruccionController::class);
    Route::apiResource('tipo-construccion', TipoConstruccionController::class);
    Route::apiResource('tipo-suelo', TipoSueloController::class);
    Route::apiResource('direccion', DireccionController::class);
    Route::apiResource('edificacion', EdificacionController::class);
    Route::apiResource('evaluacion-presismica', EvaluacionPresismicaController::class);
    Route::apiResource('evaluacion-postsismica', EvaluacionPostsismicaController::class);
    Route::apiResource('e-postsismica-detallada', EPostsismicaDetalladaController::class);
    Route::apiResource('e-presismica-detallada', EPresismicaDetalladaController::class);

    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);
});


