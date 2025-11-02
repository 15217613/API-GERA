<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CondicionBaseController;
use App\Http\Controllers\AccionRequeridaController;
use App\Http\Controllers\CondicionDetalladaController;
use App\Http\Controllers\CondicionNoEstructuralController;

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

    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);
});


