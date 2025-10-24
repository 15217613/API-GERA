<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/me', [AuthController::class, 'me']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('permissions', PermissionController::class);
    Route::apiResource('roles', RoleController::class);

    Route::get('/user-info', function (Request $request) {
        $user = $request->user();

        $roles = $user->getRoleNames();
        $permissions = $user->getPermissionsViaRoles()->pluck('name');

        return response()->json([
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    });
});


